<?php
include_once('connection.php');
// session_start();

if(isset($_POST['register'])){
    if(isset($_POST['first_name']) and isset($_POST['last_name']) and isset($_POST['username']) and isset($_POST['email']) and isset ($_POST['phone']) and isset($_POST['password']) and isset($_POST['register'])){
  
        $first_name = ($_POST['first_name']);
        $last_name = ($_POST['last_name']);
        $username=($_POST['username']);
        $email=($_POST['email']);
        $phone=($_POST['phone']);
        $password=($_POST['password']);
        // $rand = rand(1,2, 3);

    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_error = 'invalid email addres';

    }
$sql_u = "SELECT * FROM user_register WHERE username = '$username'";
$sql_e = "SELECT * FROM user_register WHERE email = '$email'";
$sql_p = "SELECT * FROM user_register WHERE password = '$password'";
$res_u = mysqli_query($conn, $sql_u);
$res_e = mysqli_query($conn, $sql_e);
$res_p = mysqli_query($conn, $sql_p);

if (mysqli_num_rows($res_u) == 1){
    $name_error = "sorry.... username already exist";

}else if(mysqli_num_rows($res_e) ==1){
    $email_error = "sorry.... email already exist";
}else if(mysqli_num_rows($res_p) >8){
    $password_error = "password should be minimum of 8 characters!";
}


else{
    $sql = "INSERT INTO user_register (first_name, last_name, username, email, phone, password, user_profile) VALUES ('$first_name', '$last_name', '$username', '$email', '$phone', md5('$password'), '$user_profile')";
    $result = mysqli_query($conn ,$sql);
    echo "Registration successful!";

    header("location:login.php");
    exit();
}
    
    }


}





?>