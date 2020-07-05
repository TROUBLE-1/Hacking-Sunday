<?php 
session_start();
if(isset($_SESSION['jwt'])){
  //  header('location: home.php');
}
    

   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'user');
   define('DB_PASSWORD', 'password');
   define('DB_DATABASE', 'jwt');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    // username and password sent from form
    if (isset($_POST['signup']))
    {

        $name = mysqli_real_escape_string($db, $_POST['name']);
        $email = mysqli_real_escape_string($db, $_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['pass']);

            if ($name == null)
            {
                $error = "username required";
            }
            else
            {

                $sql = "select * from users where email = '$email'";
                $result = mysqli_query($db, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                $count = mysqli_num_rows($result);

                if ($count != 0)
                {
                    $error = "Username already taken";
                }
                else
                {

                    $sql = "INSERT INTO users (name, email, password, active, is_admin) VALUES ('$name','$email','$password', 1,0)";
                    $result = mysqli_query($db, $sql);
                    $error = "Registered";

                }
            }
        }
        
        
    }


?>
<!DOCTYPE html>
<html>
<body>
    
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="./style/style.css" rel="stylesheet">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
      <img src="image/t1.JPG" id="icon" alt="User Icon" />
    </div>

    <!-- Login Form -->
   <form method="post">
      <input type="text" id="name" class="fadeIn second" name="name" placeholder="name">
      <input type="text" id="email" class="fadeIn second" name="email" placeholder="username">
      <input type="text" id="pass" class="fadeIn third" name="pass" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In" name="signup">
      <h5 style="color:red" id="result"></h5>
    </form>
    <div id="formFooter">
        <p style="color:red"> <?php if(isset($error)){echo $error; }?></p>
      <a class="underlineHover" href="./">Already have an account?</a>
        
    </div>

  </div>
</div>
  <script type="application/javascript">
      function login() {
    var email = document.getElementById("email").value;
    var pass = document.getElementById("pass").value;

    var json = '{"name":"generateToken", "param":{"email":"' + email + '", "pass":"' + pass +'"}}';    
    
  
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var result = document.getElementById("result").innerHTML = this.responseText;
        if(this.response == ''){
            window.location.href = './home.php';

        }
   
    }
    };
    xhttp.open("POST", "main.php", true);
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.send(json);
}
    
    
    </script>  
    
    

</body>
</html>
