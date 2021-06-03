<?php

session_start();
include_once('connection.php');

if (isset($_POST['login'])) {

    if (isset($_POST['username']) and isset($_POST['password'])) {

        $username= $_POST['username'];
        $password = md5($_POST['password']);

        $query = mysqli_query($conn, "SELECT * FROM user_register WHERE username='$username' and password='$password'");

        if (mysqli_num_rows($query) >= 1) {
            //save user info
           
            $this_user = mysqli_fetch_assoc($query);
            $_SESSION['logged_user']  = $this_user;
            $this_user_id = $this_user["user_ID"];
        
            //update user login status
            $sql = "UPDATE user_register SET log_in = 'online' WHERE user_ID ='$this_user_id'";
            $qr = mysqli_query($conn, $sql);
  
            if($qr){
            // redirect user to chat page
                header("location: homepage.php");

            }
            else{
                echo "unable to update user login status";
            }
             
        } else {
            echo 'invalid email or password! <a href="login.php">try again</a>';
        }
    }
}
?>

