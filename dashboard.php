<?php
include "db.php";

// Delete user
if(isset($_GET['delete'])){
  $id = $_GET['delete'];
  mysqli_query($conn, "DELETE FROM users WHERE id=$id");
}

// Add product
if(isset($_POST['add_product'])){
  $name = $_POST['product_name'];
  $price = $_POST['price'];

  $image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];
  move_uploaded_file($tmp,"uploads/".$image);

  mysqli_query($conn,"INSERT INTO products(product_name,price,image)
  VALUES('$name','$price','$image')");
}

// Fetch users
$users = mysqli_query($conn,"SELECT * FROM users");

// Fetch products
$products = mysqli_query($conn,"SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<style>
table{border-collapse:collapse;width:80%;margin:20px auto;}
th,td{border:1px solid black;padding:8px;text-align:center;}
form{width:400px;margin:auto;background:#f4f4f4;padding:20px;}
</style>
</head>
<body>

<h2 align="center">ADMIN DASHBOARD</h2>

<h3 align="center">All Users</h3>
<table>
<tr>
<th>ID</th><th>Username</th><th>Email</th><th>Action</th>
</tr>

<?php while($u=mysqli_fetch_assoc($users)){ ?>
<tr>
<td><?= $u['id'] ?></td>
<td><?= $u['username'] ?></td>
<td><?= $u['email'] ?></td>
<td>
<a href="edit_user.php?id=<?= $u['id'] ?>">Edit</a> |
<a href="dashboard.php?delete=<?= $u['id'] ?>">Delete</a>
</td>
</tr>
<?php } ?>
</table>

<hr>

<h3 align="center">Upload Product</h3>

<form method="post" enctype="multipart/form-data">
<input type="text" name="product_name" placeholder="Product Name" required><br>
<input type="text" name="price" placeholder="Price" required><br>
<input type="file" name="image" required><br><br>
<button type="submit" name="add_product">Upload Product</button>
</form>

<h3 align="center">All Products</h3>

<a href="orders_dashboard.php">View Customer Orders</a>


<table>
<tr>
<th>ID</th><th>Name</th><th>Price</th><th>Image</th>
</tr>

<?php while($p=mysqli_fetch_assoc($products)){ ?>
<tr>
<td><?= $p['id'] ?></td>
<td><?= $p['product_name'] ?></td>
<td><?= $p['price'] ?></td>
<td><img src="uploads/<?= $p['image'] ?>" width="60"></td>
</tr>
<?php } ?>
</table>

</body>
</html>
