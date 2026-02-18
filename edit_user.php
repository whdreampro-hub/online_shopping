<?php
include "db.php";
$id = $_GET['id'];

if(isset($_POST['update'])){
  $username = $_POST['username'];
  $email = $_POST['email'];

  mysqli_query($conn,"UPDATE users SET username='$username', email='$email' WHERE id=$id");
  header("Location: dashboard.php");
}

$result = mysqli_query($conn,"SELECT * FROM users WHERE id=$id");
$user = mysqli_fetch_assoc($result);
?>

<form method="post">
<input type="text" name="username" value="<?= $user['username'] ?>"><br>
<input type="email" name="email" value="<?= $user['email'] ?>"><br><br>
<button type="submit" name="update">Update</button>
</form>
