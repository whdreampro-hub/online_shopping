<?php
declare(strict_types=1);

require __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Method not allowed.');
}

$usernameInput = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

if (!is_string($usernameInput) || !is_string($password)) {
    http_response_code(400);
    exit('Please provide a valid username and password.');
}

$username = trim($usernameInput);
if ($username === '' || strlen($username) > 50 || $password === '' || strlen($password) > 72) {
    http_response_code(400);
    exit('Please provide a valid username and password.');
}

$stmt = mysqli_prepare($conn, 'SELECT username, password FROM users WHERE username = ? LIMIT 1');
if ($stmt === false) {
    error_log('Login statement preparation failed: ' . mysqli_error($conn));
    http_response_code(500);
    exit('Unable to sign in right now. Please try again later.');
}

mysqli_stmt_bind_param($stmt, 's', $username);
if (!mysqli_stmt_execute($stmt)) {
    error_log('Login query failed: ' . mysqli_stmt_error($stmt));
    mysqli_stmt_close($stmt);
    http_response_code(500);
    exit('Unable to sign in right now. Please try again later.');
}

mysqli_stmt_bind_result($stmt, $storedUsername, $passwordHash);
$found = mysqli_stmt_fetch($stmt);
mysqli_stmt_close($stmt);

if ($found === true && is_string($passwordHash) && password_verify($password, $passwordHash)) {
    echo 'Login successful! Welcome ' . htmlspecialchars($storedUsername, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    exit();
}

http_response_code(401);
echo 'Invalid username or password.';
