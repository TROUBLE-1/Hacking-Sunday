<?php include('headers.php');
    include('session.php');

if(isset($_POST['send'])){
    
    if($_POST['email'] != '' and $_POST['message'] != '' ){

        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            $msg = "Invalid email format";
            
        }else{

        $email = mysqli_real_escape_string($db, $_POST['email']);

        $message = mysqli_real_escape_string($db, $_POST['message']);

        $sql = "insert into contacts(emailId, message) values ('$email', '$message')";

        $res = mysqli_query($db, $sql);

        echo "<script>alert('Message sent!')</script>";
    }
        
    }
    
    
    if(($_FILES["file"]["name"]) !== ''){
        $extension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));

        if($extension=='docx' || $extension=='txt' || $extension=='pdf' || $extension=='xlsx'){
         move_uploaded_file($_FILES["file"]["tmp_name"], "../tmp/".$_SESSION['login_user'].'_profile.'.$extension) ;

        $file_name = $_SESSION['login_user'].'_profile.'.$extension;

         
        }else{
            $msg = "Invalid file";
        }
    }
}

?>

<body class="container">
<div class="d-flex justify-content-center h-100" id="signin">
		<div class="card" style="height:auto;width:800px">
			<div class="card-header">
				<h3>Contact us now</h3>
				
			</div>
			<div class="card-body">
				<form action="contact.php" method="post" enctype="multipart/form-data">
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input name="email" type="text" class="form-control" placeholder="Email Address" required>

					</div>
                    
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-file icon"></i></span>
						</div>
						<textarea name="message" style="height:200px" class="form-control" required placeholder="Write your Message here" maxlength="500"></textarea>
					</div>
                    
                    <div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fa fa-box icon"></i></span>
						</div>
						<input type="file" class="form-file" name="file" placeholder="Email Address">
					</div>
                    
					<div class="form-group">
						<input name="send" type="submit" value="Send" class="btn float-right login_btn">
					</div>
                    
                    <strong style="color:white"><?php  if(isset($msg)){ echo $msg;}?></strong>
				</form>
			</div>
			
		</div>
	</div>
    
</body>




