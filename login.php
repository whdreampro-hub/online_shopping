<?php
include "db.php";

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

if($row){
  if(password_verify($password, $row['password'])){
    echo "Login successful! Welcome " . $row['username'];
  } else {
    echo "Wrong password!";
  }
}else{
  echo "User not found!";
}
?>
