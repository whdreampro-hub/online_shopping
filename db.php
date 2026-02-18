<?php
$conn = mysqli_connect("localhost", "root", "", "online_shop");

if(!$conn){
  die("Connection failed: " . mysqli_connect_error());
}

?>