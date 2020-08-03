<?php 
session_start();

include('config.php');

 $randvalue = 'gasdga4485asda3245r42'; 

function checkuser($username,$db){
    if($username == ''){
      		  echo "Invalid username";
		return false;	
	}
    $username = mysqli_real_escape_string($db, $username);
    $query = "select * from users where username = '$username'";
    $result = mysqli_query($db, $query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if($row['username'] == $username){
   return  $_SESSION['username'] = $row['username'];       
        
    }else{
        echo "Invalid username";
    }
}

function validate_login($code, $randvalue, $username, $db){
    if($code == $randvalue){
	
	return true;
        
    }else{
        echo "Code not matched!";
        session_destroy();
    }
}


if(isset($_SERVER['CONTENT_TYPE']) and $_SERVER['CONTENT_TYPE'] === 'application/json') {
    $data = file_get_contents('php://input');
    if($data !== ''){
        $data = json_decode($data,true);
        $code = $data['code'];
        $username = $data['username'];
    }
    if(checkuser($username,$db) == false){
        exit();
    }
  $validate_login =  validate_login($code, $randvalue, $username, $db);
	if($validate_login == true){
		
    		header('location: trouble1ctf/index.php');
	}
    exit();
}



if(isset($_REQUEST['username']) or isset($_REQUEST['code'])){
    $username = $_REQUEST['username'];
    $code = $_REQUEST['code']; 
    if(checkuser($username,$db) == false){
        exit();
    }
  
 $validate_login =   validate_login($code, $randvalue, $username, $db);
	if($validate_login == true){

    		header('location: trouble1ctf/index.php');
	}
}else{
	echo "values missing!";exit();
}
 


?> 
