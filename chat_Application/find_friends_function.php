<?Php

include_once("connection.php");
$username="";
function search_user(){
    global $conn, $username;
    if(isset($_GET['search_btn']) and isset($_GET['search_query'])){
        
        $search_query = htmlentities($_GET['search_query']);
        $get_user = "SELECT * FROM user_register WHERE username LIKE '%$search_query%'";

    }else{
        $get_user = "SELECT * FROM user_register order by username DESC LIMIT 5";
    }
    $run_user = mysqli_query ($conn, $get_user);
    while($row_user = mysqli_fetch_array($run_user)){
        $username = $row_user['username'];
        $user_profile = $row_user['user_profile'];
        $user_gender = $row_user['user_gender'];


        echo"
        
        <div class='card'>
        <img src='images/$user_profile'>
        <h1> $username</h1>
        <p>$user_gender</p>

        <button name='add'> <a href='homepage.php?username=$username'>Chat with $username</a></button>
        
        
        </div><br><br>
        
        ";
        if(isset($_POST['add'])){
            echo" <script> window.open('homepage.php?username=$username', '_self')</script>";
        }
    }
}

?>