<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>online shopping</title>
    <link rel="stylesheet" href="home.css">
</head>

<body>
    <div class="main">
        <nav>
            <span class="logo">Online Shopping</span>
            <a class="href" href="#">Login</a>
            <a class="href" href="#">Sign Up</a>
        </nav>

        <div class="form">
            <form action="signup.php" method="post">
                <h4>Signup Form don't have an account</h4>
                <input type="text" name="username" placeholder="enter your username"><br>
                <input type="email" name="email" placeholder="enter email"><br>
                <input type="password" name="password" placeholder="enter password"><br>
                <select name="role">
                    <option></option>
                    <option>User</option>
                    <option>Admin</option>
                </select>
                <button type="submit" name="signup" title="submit data">Sign Up</button>
            </form>
            <br>

            <h4>Login Form have an account</h4>
            <form action="login.php" method="post">
                <input type="text" name="username" placeholder="enter your username"><br>
                <input type="password" name="password" placeholder="enter your password"><br>
                <button type="submit" name="login" title="make login">Login</button>
            </form>

            <footer>all right reselved 2026-2027</footer>

        </div>
    </div>
</body>

</html>