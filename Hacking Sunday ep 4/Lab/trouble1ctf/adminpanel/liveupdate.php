<?php

if($_SERVER['HTTP_HOST'] === "localhost" and (strpos($_SERVER['HTTP_REFERER'], "//localhost") !== false)){
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'user');
   define('DB_PASSWORD', 'password');
   define('DB_DATABASE', 'trouble1');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


       if(isset($_REQUEST['submit'])){
           
	   if(!isset($_REQUEST['message'])){
		echo "no message found";
		exit();	
		}
           $msg = $_REQUEST['message'];
           $sector_array = array('hr', 'sales', 'manager', 'it'); 
	  if(!isset($_REQUEST['department'])){
		echo "Department not used";
		exit();	
		}
           $sector = strtolower($_REQUEST['department']);

           if (!in_array($sector, $sector_array)){
            echo "invalid department!";
          }else{

               $query = "UPDATE msg SET message = '$msg' WHERE department = '$sector'";
               $result = mysqli_query($db, $query);
               $count = mysqli_affected_rows($db);
               if($count !== 0 and $count > 0){
                   $query = "select * from msg WHERE department = '$sector'";
                   $result = mysqli_query($db, $query);
                   $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                   echo 'Message for ' .$sector .' department.<br>Message: ' .$row['message'];
               }else{
                   echo "Not updated!";
               }
           }

       }else{
           echo "something went wrong!<br>submit not found!";
       }
}else{
    echo "Request is not from admin side!";
    header("location: error.html");
    exit();
}




?>
