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
<title> Change Profile Picture</title>
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js" defer></script>
    <script src="js/popper.js" defer></script>
    <script src="js/bootstrap.min.js" defer></script>
    </head>
    <style>
    .card{
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        max-width: 400px;
        margin: auto;
        text-align: center;
        font-family: arial;
    }
    .card img{
        height: 300px;
    }
    .title{
        color: grey;
        font-size: 18px;
    }
    button{
        border: none;
        outline: 0;
        display: inline-block;
        padding: 11px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 400px;
        font-size: 18px;
        height: 50px;
    }
    #update_profile{
        position: absolute;
        cursor: pointer;
        padding: 10px;
        border-radius: 4px;
        color: white;
        background-color: #000;
    }
    label{
        padding: 7px;
        display: table;
        color: #fff;
    }
    input[type="file"]{
        display: none;
    }
    
    </style>
    <body>
    <?php
    
    $this_user = ($_SESSION['logged_user']['username']) ? ($_SESSION['logged_user']['username']) : $username;

$get_user = "SELECT * FROM user_register WHERE username = '$this_user'";
$run_user = mysqli_query($conn, $get_user);
$row = mysqli_fetch_array($run_user);
if($row){
    $username = $row['username'];
    $user_profile = $row['user_profile'];


    echo"
        
        <div class='card'>
        <img src='images/$user_profile'>
        <h1> $username</h1>
        <form method='POST' enctype='multipart/form-data'>
        
        <label id='update_profile'><i class='fa fa-circle-o' aria-hidden='true'></i>Select Profile
        <input type='file' name='u_image' size='120' >
        </label>

        <button id='button_profile' name='update'>&nbsp&nbsp&nbsp&nbsp<i class='fa fa-heart' aria-hidden='true'></i> Update Profile</button>

        </form>
        </div><br><br>
        
        ";
        if(isset($_POST['update'])){
            $u_image = $_FILES['u_image']['name'];
            $image_tmp = $_FILES['u_image']['tmp_name'];
            $random_number = rand(1,100);

            if($u_image==''){
                echo"<script>Alert('Please Select Profile')</script>";
                echo"<script>window.open('upload.php','_self')</script>";
                exit();
            }else{
                move_uploaded_file($image_tmp, "images/$u_image.$random_number");
                $update = "UPDATE user_register SET user_profile='$u_image.$random_number' WHERE username = '$this_user'";
                $run = mysqli_query($conn,$update);
                if($run){
                    echo"<script>alert('Your Profile Is Updated')</script>";
                echo"<script>window.open('upload.php', '_self')</script>";
                }else{
                    echo" error occured";                }
            }
        }
}
    ?>
    </body>
</html>