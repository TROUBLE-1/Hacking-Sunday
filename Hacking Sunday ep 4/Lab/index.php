<?php
include('config.php');

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      if(isset($_POST['username'])){
   
          
          $username = mysqli_real_escape_string($db, $_POST['username']);

          $password = mysqli_real_escape_string($db, $_POST['password']); 
        
          $sql = "SELECT * FROM users WHERE username = '$username' and password='$password'";
   
          $result = mysqli_query($db,$sql);
   
          $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
         
          $count = mysqli_num_rows($result);
        
          if($count == 1) {  
   		
             $_SESSION['login_user'] = $row['username'];
              
             header("location: securitybyte/home.php");   
   
          }else {
   
             $error = "Your Login Name or Password is invalid";
   
          } 
   
      }
   
   }
?>
<!DOCTYPE html>
<html>
    <head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="./css/index.css" rel="stylesheet">
    </head>

<body>

<div class="sidenav">
         <div class="login-main-text">
            <h2>Trouble1<br> Hacking Sunday ep 4</h2>
             
	
            
		  Lab is based on real life attack scenario

                 
                 
             
             <br><br>
             <h3>Links:</h3>
                 Youtube: <a href="https://www.youtube.com/channel/UCkJ_sEF8iUDXPCI3UL0DAcg">trouble1</a><br>
                 GitHub: <a href="http://github.com/TROUBLE-1/">TROUBLE-1</a><br>
                 
             
	
                  
		<br>
            
    </div>
      </div>
      <div class="main">
         <div class="col-md-6 col-sm-12">
            
            <div class="login-form">
               <form action="index.php" method="post">
                  <div class="form-group">
                     <label>User Name</label>
                     <input name="username" type="text" class="form-control" placeholder="User Name">
                  </div>
                  <div class="form-group">
                     <label>Password</label>
                     <input name="password" type="password" class="form-control" placeholder="Password">
                  </div>
                  <button type="submit" class="btn btn-black">Login</button>
               </form>
                <p style="color:red"><?php if(isset($error)){echo $error;} ?></p>
            </div>
         </div>
      </div>

</body>
</html>
