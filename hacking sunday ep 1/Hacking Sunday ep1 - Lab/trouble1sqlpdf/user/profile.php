<?php include('headers.php');

include('session.php'); 

$username = $_SESSION['login_user'];
$bio = $_SESSION['bio'];
$sql = "select id from users where username='$username'";
$result = mysqli_query($db,$sql); 
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['id'];

if(isset($_POST['Submit1'])) 
{ 

$extension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));

if($extension=='jpg' || $extension=='jpeg' || $extension=='png' || $extension=='gif'){
 move_uploaded_file($_FILES["file"]["tmp_name"], "../images/profiles/".$id.'_profile.'.$extension) ;
     
$profile = $id.'_profile.'.$extension;
    
 $sql = "UPDATE users SET profile = '$profile' where username='$username'";
    
 $result = mysqli_query($db,$sql);
    
$row = @mysqli_fetch_array($result, MYSQLI_ASSOC);
    

}
else
{
echo "File is not image";
}
}
 $sql1 = "select *  from users where username='$username'";
    
 $result1 = mysqli_query($db,$sql1);
 $row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
 


?>  

<body class="container">
     <div class="col-sm" >
         <div class="card example-1 scrollbar-ripe-malinka" style="width:600px; height:800px;color:white">
    <h3 style="margin-left:20px;">User Profile</h3>
        <img src="../images/profiles/<?php echo $row1['profile'];?>" width="200px" style="margin-left:20px;">

    <br>
    <div style="text-align:left;margin-left:30px">
        
<form action="profile.php" enctype="multipart/form-data" method="post">
Select image :
<input type="file" name="file"><br/>
<input type="submit" value="Upload" name="Submit1">

</form>
        
    <strong>
        Username: <?php echo $_SESSION['login_user']; ?><br>
        Followers: 56 Following: 50
        <br>
    Rating: 3.5/5  
    </strong><br><br>
        
        <?php 
            if(isset($_POST['changebio'])){
                
                $bio = mysqli_real_escape_string($db, $_POST['bio']);
                $sql = "update users set bio= '$bio' where username = '$username'";
                $res = mysqli_query($db, $sql);
                if($res){echo "<script>alert('Bio updated')</script>";}
            }
        
        ?>
        <form action="profile.php" method="post" style="margin:10px">
    	<div class="input-group form-group" style="width:500px;">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-id-card icon"></i></span>
						</div>
						<input name="bio" class="form-control" placeholder="" maxlength="500">
					</div>
					<div class="form-group" style="margin-right:65px">
						<input type="submit" name="changebio" value="Change Bio" class="btn float-right login_btn">
					</div>
				</form>
        <strong>Bio: <?php echo htmlentities($bio); ?></strong>
        </div>   
    </div>
      </div>
</body>
