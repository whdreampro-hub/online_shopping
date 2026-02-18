<?php
include "db.php";

//handle order submit
if(isset($_POST['order'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $product = $_POST['product'];
    $quantity = $_POST['number'];
    $location = $_POST['location'];

    $sql = "INSERT INTO orders(name,email,product,quantity,location)
            VALUES('$name','$email','$product','$quantity','$location')";

    if(mysqli_query($conn, $sql)){
        echo "<script>alert('Order sent successfully!');</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

//i am going to fetch data from database
$result = mysqli_query($conn,"SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
<title>Products</title>
<style>
.product-box{
display:grid;
grid-template-columns:repeat(4,1fr);
gap:15px;
margin:20px;
}
.card{
border:1px solid #ccc;
padding:10px;
text-align:center;
}
form{
width:400px;
margin:30px auto;
padding:20px;
border:1px solid #ccc;
}

input,button{
width:100%;
padding:8px;
margin:5px 0;
}
</style>
</head>
<body>

<h2 align="center">Our Products</h2>

<div class="product-box">
<?php while($row=mysqli_fetch_assoc($result)){ ?>
<div class="card">
<img src="uploads/<?php echo $row['image']; ?>" width="150"><br>
<b><?php echo $row['product_name']; ?></b><br>
Price: <?php echo $row['price']; ?>
</div>
<?php } ?>
</div>

<hr>

<h3 align="center">Make Order</h3>

<form method="post">
<input type="text" name="name" placeholder="Enter your name" required>
<input type="email" name="email" placeholder="Enter email" required>
<input type="text" name="product" placeholder="Enter product name" required>
<input type="number" name="number" placeholder="Enter quantity" required>
<input type="text" name="location" placeholder="Enter your location" required>

<button type="submit" name="order">Send Order</button>
</form>

</body>
</html>
