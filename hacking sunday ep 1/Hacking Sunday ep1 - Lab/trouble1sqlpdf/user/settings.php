<?php 


include('session.php'); 
$bio = $_SESSION['bio'];
if(isset($_POST['download'])){
    $sql = "select * from users where username='$login_session'";
     
    $res = mysqli_query($db, $sql);

    $row = @mysqli_fetch_array($res, MYSQLI_ASSOC);

    $bio = $row['bio'];



    $myfile = fopen("./user_data/"."user_".$row['ID'].".html", "w");

    $data = "";
    
    $data = "<h2>Username: ".$_SESSION['login_user']."</h2>";

    $data .= "<h3>Bio: </h3>";

    $data .= "$bio<br>";

    $data .= "<h3>Email: </h3>";

    $data .= $row['emailId'];

    fwrite($myfile, $data);

    fclose($myfile);
    
    $html = "./user_data/"."user_".$row['ID'].".html";
    $pdf = "./user_data/"."user_".$row['ID'].".pdf";


    echo system('weasyprint '. "$html $pdf");

    $file1 = "./user_data/"."user_".$row['ID'].".pdf";

    if (file_exists($file1)) {
        
        header('Content-Disposition: attachment; filename="'.basename($file1).'"');
        readfile($file1);
        exit; 
    
  }
    
}

include('headers.php');
?>  

<body class="container">
    
<div class="card example-1 scrollbar-ripe-malinka" style="width:600px; height:800px;color:white">
    <br>
    <div style="text-align:left;margin-left:30px">
                
        <form style="margin:10px">
            <h2>Change Password</h2>
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input name="password" type="email" class="form-control" placeholder="current password">
						
					</div>
            
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input name="password" type="email" class="form-control" placeholder="New password">
						
					</div>
            
					<div class="form-group" style="margin-right:65px">
						<input type="submit" name="changebio" value="Change Password" class="btn float-left login_btn" style="width:auto">
					</div>
				</form>
         <br><br><br>
        <form style="margin:10px" method="post" action="settings.php">
           <h2>Download Users Data</h2>
            
					<div class="form-group" style="margin-right:65px">
						<input type="submit" name="download" value="Download Data" class="btn float-left login_btn" style="width:auto">
					</div>
				</form>
        
       
        <br><br>
        
        <form style="margin:10px" method="post" action="logout.php">
           <h2>Deactivate account</h2>
            
					<div class="form-group" style="margin-right:65px">
						<input type="submit" name="deactivate" value="deactivate" class="btn float-left login_btn" style="width:auto">
					</div>
				</form>
        
        </div>   
    </div>
</body>

