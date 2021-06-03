<?php
session_start();

//redirect user to login page if they have not login
if (!isset($_SESSION['logged_user']) || !$_SESSION['logged_user']) {
    header("location:index.php");
}

include_once('connection.php');
include_once('find_friends_function.php');
//  include_once('find.css');
?>

<!DOCTYPE html>
<html>

<head>
<title> search for friends</title>

<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/find.css">
<script src="js/jquery.js" defer></script>
<script src="js/popper.js" defer></script>
<script src="js/bootstrap.min.js" defer></script>
</head>
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../css/find.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/booststrap/4.1.3/js/bootstrap.min.js"></script> -->

<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

<a class="navbar_brand" href="#" >


<a class=' navbar_brand' href="homepage.php<?php echo $username ? "?username=$username" : "" ?>"> MyChat </a>
<?php
// if(isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['username']) and isset($_POST['email']) and isset ($_POST['phone']) and isset($_POST['password']) and isset($_POST['register'])){

//      $first_name = ($_POST['first_name']);
//      $last_name = ($_POST['last_name']);
//      $username=($_POST['username']);
//      $email=($_POST['email']);
//      $phone=($_POST['phone']);
//      $password=($_POST['password']);

//    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
//  $email_error = 'invalid email addres';

//      }
   

// $user  = $_POST['username'];
// $get_user = "SELECT * FROM user_register WHERE username = '$user";
// $run_user = mysqli_query($conn, $get_user);
// $result = mysqli_fetch_array($run_user);

// $username = $row['username'];
// echo" <a class=' navbar_brand' href='homepage.php?username=$username'> MyChat </a>";
// } 
?>
</a>

<ul class="navbar_nav">

<li> <a style="color: white; text-decoration:none; font: size 20px;" href="account_setting.php">  Setting </a></li>
</ul>
</nav> <br>

<div class="row">

<div class="col-sm-4">
</div>

<div class="col-sm-4">
<form class="search_form" action="" method="GET">
    <input type="text" name="search_query" placeholder="search friends" autocomplete="off" required="">
    <button class="btn text-white mx-2" type="submit" name="search_btn">search</button>


</form>
</div>
<div class="col-sm--4">
</div>

</div><br><br>

<?php search_user();?>
</body>


</html>