<?php 
session_start();

if(isset($_SESSION['data'])){
    echo "Save this data to a .txt file. This will help to fill data quickly. <br><br>";
    echo $_SESSION['data'];
}






session_destroy()

?>
<br><br>
<a href="index.php">Return to home page..</a>