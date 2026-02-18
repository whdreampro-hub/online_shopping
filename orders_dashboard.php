<?php
include "db.php";

/* DELETE ORDER */
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    mysqli_query($conn,"DELETE FROM orders WHERE id=$id");
}

/* FETCH ORDERS */
$result = mysqli_query($conn,"SELECT * FROM orders");
?>

<!DOCTYPE html>
<html>
<head>
<title>Orders Dashboard</title>
<style>
table{
width:90%;
margin:20px auto;
border-collapse:collapse;
}
th,td{
border:1px solid #333;
padding:8px;
text-align:center;
}
th{
background:#333;
color:white;
}
h2{text-align:center;}
</style>
</head>
<body>

<h2> Customer Orders (Admin)</h2>

<table>
<tr>
<th>ID</th>
<th>Customer Name</th>
<th>Email</th>
<th>Product</th>
<th>Quantity</th>
<th>Location</th>
<th>Date</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
<td><?php echo $row['product']; ?></td>
<td><?php echo $row['quantity']; ?></td>
<td><?php echo $row['location']; ?></td>
<td><?php echo $row['created_at']; ?></td>
<td>
<a href="orders_dashboard.php?delete=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this order?')">Delete</a>
</td>
</tr>
<?php } ?>

<a href="dashboard.php" style="font-size: large; font-family:'Times New Roman', Times, serif;">back to dashboard</a>

</table>

</body>
</html>
