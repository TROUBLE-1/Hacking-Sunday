<?php include ('headers.php');
include ('config.php'); ?>


<?php

function displayError($error){
            echo '<center><div class="alert alert-warning" role="alert">';
            echo '<strong>'.$error.'</strong>';
            echo '</div></center>';
}

function displayMsg($msg){
            echo '<center><div class="alert alert-primary" role="alert">';
            echo '<strong>'.$msg.'</strong>';
            echo '</div></center>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // username and password sent from form
    if (isset($_POST['SignUp']))
    {

        $username = mysqli_real_escape_string($db, $_POST['username']);
	$username = str_replace(' ', '_', $username);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = md5(mysqli_real_escape_string($db, $_POST['password']));
        $password1 = md5(mysqli_real_escape_string($db, $_POST['password1']));

        if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error = "Invalid email format";
            
        }
        else
        {

            if ($password === $password1)
            {
                if ($username == null)
                {
                    $error = "username required";
                }
                else
                {

                    $sql = "select * from users where username = '$username'";
                    $result = mysqli_query($db, $sql);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    $count = mysqli_num_rows($result);

                    if ($count != 0)
                    {
                        $error = "Username already taken";
                    }
                    else
                    {

                        $sql = "INSERT INTO users (emailId, username, password, profile) VALUES ('$email','$username','$password1', 'default.jpg')";
                        $result = mysqli_query($db, $sql);
                        $msg = "Registered";

                        $sql1 = "INSERT INTO posts (username,profile, posts) VALUES ('$username', 'default.jpg','default.jpg')";
                        $result1 = mysqli_query($db, $sql1);
                        

                    }
                }
            }
            else
            {
                $error = 'Password Not matched!';
            }
        }
    }
}
?>


<div class="d-flex justify-content-center h-100" id="signin">
    
		<div class="card" style="height:auto">
         <?php if(isset($error)){
                displayError($error);
                }
                
                if(isset($msg)){
                displayMsg($msg);
                }
            ?>
			<div class="card-header">
				<h3>Sign Up</h3>
				
			</div>

            
			<div class="card-body">
				<form action="" method="post">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input name="username" type="text" class="form-control" placeholder="username">
						
					</div>
                    
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input name="email" type="email" class="form-control" placeholder="Email Address">
						
					</div>
                    
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-key icon"></i></span>
						</div>
						<input name="password" type="password" class="form-control" placeholder="Password">
					</div>
                    
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-key icon"></i></span>
						</div>
						<input name="password1" type="password" class="form-control" placeholder="Confirm Password">
					</div>
                    
					
					<div class="form-group">
						<input type="submit" name="SignUp" value="SignUp" class="btn float-right login_btn">
					</div>
                    <br>
                   
                    
                    
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					Already have an account?<a href="index.php" style="color:orange">Sign In</a>
				</div>
				<div class="d-flex justify-content-center">
					<a href="forgetpassword.php" style="color:orange">Forgot your password?</a>
				</div>
			</div>
		</div>
	</div>
