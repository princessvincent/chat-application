<?php

session_start();

//redirect user to login page if they have not login
if (!isset($_SESSION['logged_user']) || !$_SESSION['logged_user']) {
    header("location:index.php");
}

include_once("connection.php");
include_once("file.php");
?>

<!DOCTYPE html>
<html>

<head>
<title> account Setting</title>
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js" defer></script>
    <script src="js/popper.js" defer></script>
    <script src="js/bootstrap.min.js" defer></script>
    </head>
<body>

<div class="row">
    <div class="col-sm-2">
    </div>
<?php
$this_user_id = $_SESSION['logged_user']['user_ID'];
$username = "";
if(isset($_POST['update'])){
 
    $username = htmlentities($_POST['u_name']);
    $oldusern = $_SESSION['logged_user']['username'];
    $email= htmlentities($_POST['u_email']);
    $u_gender = htmlentities($_POST['u_gender']);

    $sql = "UPDATE user_register SET username = '$username', email = '$email', user_gender = '$u_gender' WHERE user_ID = '$this_user_id'" ;

    $update = "UPDATE myapp SET sender_username='$username' WHERE sender_username='$oldusern';";

    $update .= "UPDATE myapp SET receiver_username='$username' WHERE receiver_username='$oldusern'";
    $run = mysqli_query($conn, $sql);
   
    if($run){
        //update $_SESSION['logged_user']['username'] to new username and email
        $_SESSION['logged_user']['username'] = $username;
        $_SESSION['logged_user']['email'] = $email;

        // update username inside myapp table
        $run2 = mysqli_multi_query($conn, $update);
    
        echo "<script>window.open('account_setting.php', '_self')</script>";
    }
    else{
        echo mysqli_error($conn);
    }

}



// Get logged In user information
$this_user = ($_SESSION['logged_user']['username']) ? ($_SESSION['logged_user']['username']) : $username;

$get_user = "SELECT * FROM user_register WHERE username = '$this_user'";
$run_user = mysqli_query($conn, $get_user);
$row = mysqli_fetch_array($run_user);
if($row){
    $username = $row['username'];
    $email = $row['email'];
    $password = $row['password'];
    $user_profile = $row['user_profile'];
    $user_gender = $row['user_gender'];
}
?>
<div class="col-sm-8">
<form action="" method="POST" enctype="multipart/form-data">
<table class="table table-bordered table-hover">
<tr align="center">
<td colspan="6" class="active">
<h2> Change Account Settings</h2>
</td>

</tr>
<tr>
<td style="font-weight: bold;">Change Your username</td>
<td>
<input type="text" name="u_name" class="form_control"  value="<?php echo $username;?>" required/>
</td>
</tr>
<tr><td></td><td><a class="btn btn-default" style="text-decoration: none; font-size: 15px;" href="upload.php"> <i class="fa fa-user" aria-hidden="true"></i> Change Profile</a></td></tr>

<tr>
<td style="font-weight: bold;">Change Your Email</td>
<td>
<input type="text" name="u_email" class="form_control"  value="<?php echo $email;?>" required/>
</td>
</tr>

<tr>
<td style="font-weight: bold;"> Gender</td>

<td>
<select class="form-control" name="u_gender">
<option value="male" <?php echo ($user_gender== "male" ? "selected" : "" )?>>Male</option>
<option value="female" <?php echo ($user_gender== "female" ? "selected" : "" )?>>Female</option>
</select>
</td>
</tr>

<tr>
<td style="font-weight: bold;">Forgotten password</td>
<td>
<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">Forgotten Password</button>
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body">
<form action="recovery.php?id=<?php echo $user_ID; ?>" method="POST" id="f">

<strong>What is your favourite food?</strong>
<textarea class="form-control" cols="83" rows="4" name="content" placeholder="input your favourite food"></textarea><br>
<input type="submit" class="btn btn-default" name="sub" value="submit" style="width: 100px;"><br><br>
<pre> Answer the above question we will ask you this question if you forgot your <br> password</pre> <br><br>


</form>
</td>
<?php
if(isset($_POST['sub'])){
    $bfn = htmlentities($_POST['content']);

    if($bfn == ''){
        echo" <script> alert('Please enter something.')</script>";
        echo" <script>window.open('account_setting.php', '_self')</script>";
        exit();
    }else{
        $update= "UPDATE user_register SET forgotten_answer='$bfn' WHERE username = '$username'";
        

        $run = mysqli_query($conn,$update);
        if($run){
            echo" <script> alert('working...')</script>";
        echo" <script>window.open('account_setting.php', '_self')</script>";
        }else{
            echo" <script> alert('error while updating information.')</script>";
        echo" <script>window.open('account_setting.php', '_self')</script>";
        }
        
    }
}
?>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal"> Close</button>
</div>

</div>
</div>

</div>

</tr>
<tr><td></td><td><a class="btn btn-default" style="text-decoration: none; font: size 15px;" href="change_password.php"><i class="fa fa-key fa-fw" aria-hidden="true"></i> Change password</a></td></tr>
<tr align="center">
<td colspan="6">
<input type="submit" value="Update" name="update" class="btn btn-info">
</td>
</tr>
</table>
</form>
</div>
<div class="col-sm-2">

</div>
</div>
</body>

</html>