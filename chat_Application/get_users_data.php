<?php
include_once('connection.php');

               //include_once('homepage.php');



$user = "SELECT * FROM user_register";

$run_user = mysqli_query($conn, $user);


while ($row_user = mysqli_fetch_array($run_user)){
    
    $user_ID = $row_user['user_ID'];
    $usern= $row_user['username'];
    $user_profile = $row_user['user_profile'];
    $login = $row_user['log_in'];


    echo "<li>"; 
    if($login == strtolower('online'))
    echo "<div class='chat_left_img'><img class='border-success' src='images/$user_profile'></div>";
    else
    echo "<div class='chat_left_img'><img class='border-danger' src='images/$user_profile'></div>";
   
  echo "<div class='chat_left_detail'>
   
   <p><a href='homepage.php?username=$usern'>";
   echo $usern .'</a></p>';

   if($login == strtolower('online')){
       echo '<span><i class="fa fa-circle text-success" aria-hidden="true"></i> Online </span>';
   }else{
       echo '<span><i class="fa fa-circle-o text-danger" aria-hidden="true"></i> Offline </span>';
   }
  echo "  </div>   
   </li>";
} 
?> 