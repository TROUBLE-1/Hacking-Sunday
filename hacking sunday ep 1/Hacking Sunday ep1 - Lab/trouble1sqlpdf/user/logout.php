<?php
include('../../config.php');   
include('session.php');
session_start();

        
        if(isset($_POST['deactivate'])){
	$login_session = $_SESSION['login_user'];

            $sql = "DELETE FROM users WHERE username = '$login_session'";

            $res = mysqli_query($db, $sql);
            $sql1 = "DELETE FROM posts WHERE username = '$login_session'";
            $res1 = mysqli_query($db, $sql1);
            $sql2 = "DELETE FROM contacts WHERE username = '$login_session'";
            $res2 = mysqli_query($db, $sql2);
            
        }
        


$user = $_SESSION['login_user'];

   if(session_destroy()) {
       
       $sql = "UPDATE USERS SET active='' where username='$user'";
              
        $result = mysqli_query($db,$sql);
       
        header("Location: ../");
       
   }
?>
