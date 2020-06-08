<?php
   include('../config.php');

   session_start();
   
    if(!isset($_SESSION['login_user'])){

        header("location: ../../index.php");
        exit();
    }

   $user_check = $_SESSION['login_user'];
  
   $ses_sql = mysqli_query($db,"select * from users where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
 
    $_SESSION['bio'] = $row['bio'];

   $login_session = $row['username'];

    if(!isset($login_session)){

        header("location: ../../index.php");

    }

?>