<?php session_start();
if ($_SESSION['is_admin'] == null or $_SESSION['is_admin'] == '' or !isset($_SESSION['is_admin'])){
    header("location: ./");
}
?>
<html style="background-color:#ad7b7b">
<form>
    <input type="submit" name="logout" value="log out">
</form>
<input type="hidden" value="<?php echo $_SESSION['jwt']; ?>">
<?php 
if(isset($_SESSION['jwt'])){
    if($_SESSION['jwt'] != ''){
        include('verifier.php');
    }else{
     header("location: ./");
        exit;
    
    }
}
    
if(isset($_REQUEST['logout'])){
    session_destroy();
    header("location: ./");
}


if($_SESSION['is_admin'] == 1 ){
    
?>



    <input type="numer" id="id" placeholder="Give customer id" >
    <input type="submit" onclick="showdetails()" value="Get details">

<strong>
<p id="cutomerName">cutomerName: </p>
<p id="email">email: </p>
<p id="mobile">mobile: </p>
<p id="address">address: </p>
<p id="createdBy">createdBy: </p>
<p id="lastUpdatedBy">lastUpdatedBy: </p>

</strong>
<script type="application/javascript">
    
function showdetails() {
    
    var id = document.getElementById("id").value;
    var json = '{"name":"getcustomerdetails", "param":{"customerId":' + id + '}}';    
    

    var token = '<?php echo $_SESSION['jwt']; ?>';

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        
        var obj = JSON.parse(this.response);
        
      document.getElementById("cutomerName").innerHTML = "cutomerName: " + obj.cutomerName;
      document.getElementById("email").innerHTML = "email: " + obj.email;
      document.getElementById("mobile").innerHTML = "mobile: " + obj.mobile;
      document.getElementById("address").innerHTML = "address: " + obj.address;
      document.getElementById("createdBy").innerHTML = "createdBy: " + obj.createdBy;
      document.getElementById("lastUpdatedBy").innerHTML = "lastUpdatedBy: " + obj.lastUpdatedBy;
      
      
    }
    };
    xhttp.open("POST", "main.php", true);
    xhttp.setRequestHeader("Content-type", "application/json");
    xhttp.setRequestHeader("Authorization", "Bearer " + token);
    xhttp.send(json);
}


</script>


<?php 
}else{
    ?>
    <div style="color:white">
    <strong><center><h1>You are not an admin :(</h1></center></strong>
    <strong><center><h4>you have to become admin to see your customers details :)</h4></center></strong>
    </div>
<?php    
}
?>
    
</html>