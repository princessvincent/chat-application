<?php
// include('loginprocess.php');
?>

<!DOCTYPE html>
<html>
<head>
    <style>
body{
    color: burlywood;
    background-size: cover;
    font-family: serif;
}
.login1{
    border-radius: 24px;
    background: cadetblue;
    color: burlywood;
    height: 350px;
    width: 600px;
}

.l-cont{
    height: 100vh;
}
    </style>

<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="js/jquery.js" defer></script>
<script src="js/popper.js" defer></script>
<script src="js/bootstrap.min.js" defer></script>

</head>
<body >
    <div class="l-cont d-flex align-items-center justify-content-center">
    <div class="login1">
        <center>
        <h1 id="log">Login Page</h1>

        <form action="loginprocess.php" method="POST">

            <div class="l">
                Username: <br><input type="text" name="username" placeholder="input Username" required="">
            </div><br>

            <div>
                password: <br><input type="password" name="password" placeholder="password" required="">
            </div><br>

            <input type="checkbox" id="check">
            <span> Remember me </span>

            <button type="submit" name="login" value="Login">login Here</button><r><br><br>
            <p>Forgot Password?<a href="forgot_password.php">click Here</a></p>


            <p><a href="index.php"> Register Here</a></p>
            
        </form>
        </center>
    </div>
    </div>

</body>

</html>