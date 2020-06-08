
<?php 

include('headers.php');
include('config.php');

session_start();

if(isset($_SESSION['login_user']) == true ){
    header('location: ./user/');
    exit();
}

      if(isset($_POST['login'])){

          $myusername = mysqli_real_escape_string($db,$_POST['username']);
	  $myusername = str_replace(' ', '_', $myusername);
          $mypassword = md5(mysqli_real_escape_string($db,$_POST['password'])); 
  
          $sql = "SELECT id FROM users WHERE username = '$myusername' and password = '$mypassword'" ;
          
          $result = mysqli_query($db,$sql);

          $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   
          $count = mysqli_num_rows($result);

          if($count == 1) {  
   		
             $_SESSION['login_user'] = $myusername;
              
             $session_user  = $_SESSION['login_user'];
              
	         $sql = "UPDATE USERS SET active='ACTIVE' where username='$myusername'";
              
             $result = mysqli_query($db,$sql);
              
             $sql = "SELECT * FROM users WHERE username = '$session_user'" ;
              
            $result = mysqli_query($db,$sql);
              
             $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
              
             $active = $row['active'];
           
            header("location: ./user/index.php");   
   
          }else {
   
             $error = "Your Login Name or Password is invalid";
   
          } 
   
      }
   
?>

<head>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<div class="d-flex justify-content-center h-100" id="signin">
		<div class="card" style="height:auto">
			<div class="card-header">
				<h3>Sign In</h3>
				
			</div>
			<div class="card-body">
				<form action="index.php" method="POST">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" placeholder="username" name="username">
                        
						
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-key icon"></i></span>
						</div>
						<input type="password" class="form-control" placeholder="password" id="password" name="password">
                        
					</div>
					
					<div class="form-group">
						<input type="submit" value="Login" name="login" class="btn float-right login_btn">
					</div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Don't have an account?<a href="signup.php" style="color:orange">Sign Up</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="forgetpassword.php" style="color:orange">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
