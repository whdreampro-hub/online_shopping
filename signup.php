<?php
declare(strict_types=1);

require __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Method not allowed.');
}

$username = trim((string) ($_POST['username'] ?? ''));
$email = trim((string) ($_POST['email'] ?? ''));
$password = $_POST['password'] ?? '';

if ($username === '' || strlen($username) > 50) {
    http_response_code(400);
    exit('Username is required and must be 50 characters or fewer.');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 254) {
    http_response_code(400);
    exit('Enter a valid email address.');
}

if (!is_string($password) || strlen($password) < 12 || strlen($password) > 72) {
    http_response_code(400);
    exit('Password must be between 12 and 72 bytes.');
}

$hash = password_hash($password, PASSWORD_DEFAULT);
if ($hash === false) {
    http_response_code(500);
    error_log('Signup password hashing failed.');
    exit('Unable to create the account right now.');
}

// Public registration must never grant administrator privileges.
$role = 'User';
$stmt = mysqli_prepare(
    $conn,
    'INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)'
);

if ($stmt === false) {
    http_response_code(500);
    error_log('Signup statement preparation failed: ' . mysqli_error($conn));
    exit('Unable to create the account right now.');
}

mysqli_stmt_bind_param($stmt, 'ssss', $username, $email, $hash, $role);

if (mysqli_stmt_execute($stmt)) {
    http_response_code(201);
    echo 'Signup successful!';
} elseif (mysqli_stmt_errno($stmt) === 1062) {
    http_response_code(409);
    echo 'That username or email is already registered.';
} else {
    http_response_code(500);
    error_log('Signup insert failed: ' . mysqli_stmt_error($stmt));
    echo 'Unable to create the account right now.';
}

mysqli_stmt_close($stmt);
