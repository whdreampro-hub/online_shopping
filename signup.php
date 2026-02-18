<?php
include "db.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

$hash = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users(username,email,password,role) VALUES('$username','$email','$hash','$role')";

if(mysqli_query($conn, $sql)){
  echo "Signup successful!";
} else {
  echo "Error: " . mysqli_error($conn);
}
?>
