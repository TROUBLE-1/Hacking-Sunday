<?php 
session_start();
if(isset($_SESSION['jwt'])){
  //  header('location: home.php');
}

?>
<!DOCTYPE html>
<html>
<body>
    
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="./style/style.css" rel="stylesheet">

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div style="padding:30px">
    <a href="./report.php"><button>Submit your writeup</button></a>
</div>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <div class="fadeIn first">
      <img src="image/t1.JPG" id="icon" alt="User Icon" />
    </div>


   
      <input type="text" id="email" class="fadeIn second" name="email" placeholder="username">
      <input type="text" id="pass" class="fadeIn third" name="pass" placeholder="password">
      <input type="submit" class="fadeIn fourth" value="Log In" onclick="login()">
      <h5 style="color:red" id="result"></h5>
    <!-- Remind Passowrd -->
    <div id="formFooter">
      <a class="underlineHover" href="signup.php">Don't have an account?</a>
    </div>

  </div>
</div>
    
    
    
<script>
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