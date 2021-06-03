<?php


include_once('connection.php');

// include_once('registerprocess.php');
//include_once('get_users_data.php');
session_start();
//redirect user to login page if they have not login
if (!isset($_SESSION['logged_user']) || !$_SESSION['logged_user']) {
    header("location:index.php");
}

$my_username = $_SESSION['logged_user']['username'];
$my_email = $_SESSION['logged_user']['email'];
$my_image = $_SESSION['logged_user']['user_profile'];


if (isset($_GET['act']) and $_GET['act'] == "logout") {
    $my_id = $_SESSION['logged_user']['user_ID'];
    $update_msg = mysqli_query($conn, "UPDATE user_register SET log_in = 'offline' WHERE user_ID = '$my_id'");
    if ($qr) {
        // redirect user to chat page
        header("location: homepage.php");
    } else {
        echo "unable to update user login status";
    }
    session_destroy();
    $_SESSION = [];


    header("location:index.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title> MY CHAT HOME</title>
    <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/jquery.js" defer></script>
    <script src="js/popper.js" defer></script>
    <script src="js/bootstrap.min.js" defer></script>

    <style>
        .main_section {
            border: 1px solid #000;
            width: 100%;
        }

        .left_sidebar {
            height: 100vh;
            background-color: #3A3A3A;
            position: relative;
            overflow-y: scroll;
            padding: 0px;
        }

        .searchbox {
            /* width: 30%; */
            /* height: 100px; */
            /* float: left; */
            padding: 27px 10px;
            border-bottom: 2px solid#000;
        }

        .form_control,
        .search_icon,
        .search_icon:hover {
            background-color: #6a6c75;
            border: 1px solid #fff;
            color: #fff;
            box-shadow: none;
        }

        .form_control:focus {
            border: 1px solid #fff;
        }

        .chat_left_img,
        .chat_left_detail {
            float: left;
        }

        .left_chat {
            overflow: auto;

        }

        .lefty {
            width: 30%;
            margin-top: 90px;
            position: fixed;
            float: left;
        }

        .left_chat ul {
            overflow: hidden;
            padding: 0px;
        }

        .left_chat ul li {
            list-style: none;
            width: 100%;
            float: left;
            margin: 10px 0px 8px 15px;
        }

        .chat_left_img img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            text-align: left;
            float: fixed;
            border: 3px solid #686f79;
        }

        .chat_left_detail {
            margin: 10px;
        }

        .chat_left_detail p {
            margin: 0px;
            color: #fff;
            padding: 7px 0px 0px;
        }

        .chat_left_detail span {
            color: #888AC3;
        }

        .chat_left_detail span i {
            color: #868871;
            font-size: 10px;
        }

        .chat_left_detail .orange {
            color: #E38968;
        }

        .right_sidebar {
           
            height: 100vh;
            z-index: 20;
            border-left: 2px solid #000;
            /* background-color: #3a3a3a; */
        }

        .right_header {
            border-bottom: 2px solid #000;
            margin: 0px;
            padding: 20px;
            float: right;
            width: 70%;
            height: 100px;
            background-color: #3A3A3A;
        }

        .right_header_img img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            border: 3px solid #61BC71;
            margin-right: 10px;
        }


        .right_header_detail p {
            margin: 0px;
            color: #fff;
            font-weight: bold;
            padding-top: 5px;

        }

        .right_header_detail span {
            color: #9FA5AF;
            font-size: 12px;
        }

        .rightside_left_chat,
        .rightside_left_chat {
            float: left;
            width: 80%;
            position: relative;
        }

        .rightside_right_chat {
            float: right;
            margin: 35px;

        }

        .right_header_contentchat {
            overflow-y: auto;
            position: relative;
            background-color: #FFFFFF;
        }

        .right_header_contentchat ul li {
            list-style: none;
            margin-top: 20px;
        }

        .right_header_contentchat .rightside_left_chat p,
        .right_header_contentchat .rightside_right_chat p {
            background-color: #868871;
            padding: 15px;
            border-radius: 8px;
            color: #fff;
        }

        .right_header_contentchat .rightside_right_chat p {
            background-color: #94c2ED;
        }

        .right_chat_textbox {
            padding: 15px 30px;
            /* width: 70%; */
            /* float: right; */
            /* z-index: 10; */
            position: relative;
            background-color: #3A3A3A;
        }

        .right_chat_textbox input {
            width: 70%;
            height: 40px;
            margin: 5px;
            border: 2px solid #3d85ca;
            /* float: left; */
            border-radius: 5px;
            padding: 0px 10px;
            border: 1px solid#c1c1c1;
        }

        .right_chat_textbox button {
            height: 40px;
            /* float: left; */
            width: 90px;

            /* margin: 5px 5px 5px 20px; */
        }

        .rightside_left_chat span i,
        .rightside_right_chat span i {
            color: #868871;
            font-size: 12px;
        }

        .rightside_right_chat span i {
            color: #94c2ED;
        }

        .rightside_right_chat span {
            float: right;
        }

        .rightside_right_chat span small,
        .rightside_left_chat span small {
            color: #8080c2;
        }

        .rightside_left_chat:before {
            content: "";
            position: absolute;
            top: 14px;
            left: 15px;
            bottom: 150px;
            border: 15px solid transparent;
            border-bottom-color: #868871;
            z-index: 1;
        }

        .rightside_right_chat:before {
            content: "";
            position: absolute;
            top: 14px;
            left: 15px;
            bottom: 150px;
            border: 15px solid transparent;
            border-bottom-color: #94c2ED;
        }

        /* .header{
           
        } */
        #scrolling_to_bottom {
            position: relative;
            font-family: cursive;
            font-size: 18px;
        }
        .messages{
            padding: 0;
        }

        @media only screen and (max-width:320px) {
            .main_section {
                display: none;
            }
        }
    </style>
</head>

<body>


    <!-- Main body -->
    <div class="container-fluid main_section position-fixed">

        <!-- Haeder -->
        <div class="header row bg-dark">


            <div class="input_group searchbox col-lg-3 col-md-12">
                <div class="input_group_btn">
                    <center>
                        <a href="find_friends.php">
                        
                            <button class="btn btn_default search_icon" name="search_user" type="submit"> Add New User</button>
                        </a>
                    </center>

                </div>

            </div>



            <!-- getting the user data on which suer click-->
            <?php
            global  $username;
            $username =  $username;
            if (isset($_GET['username'])) {
                global $conn;

                $get_user_name = $_GET['username'];

                $get_user = "SELECT * FROM user_register WHERE username = '$get_user_name'";

                $run_user = mysqli_query($conn, $get_user);


                $row_user = mysqli_fetch_array($run_user);

                $username = $row_user['username'];
                // $user_id = $row_user['user_ID'];

            }

            $total_message = "SELECT * FROM myapp WHERE(sender_username = '$my_username' AND receiver_username = '$username') OR (receiver_username = '$my_username' AND sender_username = '$username')";
            $run_message = mysqli_query($conn, $total_message);
            $total = mysqli_num_rows($run_message);
            ?>
            <div class="col-lg-9 col-md-12 right_header">
                <div class="right_header_img d-inline-block pb-2">
                    <img class="img-rounded" src='<?php echo "images/$my_image" ?>'>
                </div>
                <div class="right_header_detail d-inline-block">
                    <p class="d-inline"> <?php echo "$my_username"; ?></p><br>
                    <span class="d-inline"> <?php echo $total; ?> messages</span>&nbsp; &nbsp;
                    <!-- <button name="logout" class="btn btn-danger">  -->
                    <a class="btn btn-danger text-white d-inline" href="?act=logout"> logout</a>
                    <!-- </button> -->

                </div>
            </div>

        </div>


        <div class="row">

            <div class="col-mid-3 col-sm-3 col-xs-12 left_sidebar">

                <div class="left_chat">
                    <ul>
                        <?php include("get_users_data.php");
                        ?>
                    </ul>

                </div>

            </div>




            <div class="col-md-9 col-xs-12 right_sidebar vh-100">
                <div class="row right_header_contentchat h-75">
                    <div id="scrolling_to_bottom" class="col-md-12">
                        <?php
                        $update_msg = mysqli_query($conn, "UPDATE myapp SET message_status = 'read' WHERE receiver_username = '$my_username'");

                        $sel_msg = "SELECT * FROM myapp WHERE (sender_username = '$my_username' AND  receiver_username = '$username') OR (receiver_username = '$my_username' AND sender_username = '$username') ORDER by 1 ASC";
                        $run_msg = mysqli_query($conn, $sel_msg);
                        // print_r($run_msg);
                        while ($row = mysqli_fetch_array($run_msg, $update_msg)) {
                            $sender_username = $row['sender_username'];
                            $receiver_username = $row['receiver_username'];
                            $message_content = $row['message_content'];
                            $message_date = $row['message_date'];
                            //$message_status = $row['message_status'];


                        ?>
                            <ul class="messages">
                                <?php
                                if ($my_username == $sender_username and $username == $receiver_username) {
                                    echo "
        <li  class='rightside_chat d-block ml-5 text-right text-white'>
        <div class='rightside_chats bg-success d-inline-block border rounded p-2'>
        <span> $my_username <small>";
                                    echo date("Y-m-d g:ia", strtotime($message_date));

                                    echo "</small></span>
        <p> $message_content</p>


        </div>

        </li>

        ";
                                } else if ($my_username == $receiver_username and $username == $sender_username) {
                                    echo "
        <li class='leftside_chat d-block mr-5 text-white'>
        <div class='rightside_chats bg-info d-inline-block border rounded p-2'>
        <span> $username  <small>$message_date</small></span>
        <p> $message_content</p>


        </div>

        </li>

        ";
                                }

                                ?>

                            </ul>
                        <?php
                        }
                        ?>

                    </div>

                </div>
            <!-- </div> -->

            <div class="col-md-12 right_chat_textbox bg-dark">
                <form method="POST" class="clearfix">

                    <input type="text" name="message_content" placeholder="write your message ......" autocomplete="off">
                    <button class="btn" name="submit"> <i class="fa fa-telegram" aria-hidden="true">send</i></button>
                </form>
            </div>
                        
        </div>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        $msg = htmlentities($_POST['message_content']);

        if ($msg == "") {
            echo " <div class='alert alert-danger'>
        <strong><center>Messsage was unable to send </center></strong>
        
        </div>";
        // } else if (strlen($msg) > 100) {
        //     echo "
        // <div class='alert alert-danger'>
        // <strong><center> Message is too long !. Use only 100 character.</center></strong>
        // </div>
        // ";
        } else {
            $insert = " INSERT INTO myapp (sender_username, receiver_username, message_content, message_status, message_date) VALUES ('$my_username', '$username', '$msg', 'unread', NOW())";
            $run_insert = mysqli_query($conn, $insert);
        }
    }

    ?>

</body>
</head>

</html>