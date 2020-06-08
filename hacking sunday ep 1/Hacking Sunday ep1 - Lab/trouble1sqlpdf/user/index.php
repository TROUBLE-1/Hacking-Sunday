<?php include('headers.php');
   include('session.php'); 


$date = strtolower( str_replace( " ", "_", date("Y-m-d h:i:sa") ) );
$date = strtolower( str_replace( ":", "_", date("Y-m-d h:i:sa") ) );

if(isset($_POST['post']))
{ 

    $username = $_SESSION['login_user'];

    $extension = strtolower(pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION));

    $location = '_'.$date.'.'.$extension;


    if($extension=='jpg' || $extension=='jpeg' || $extension=='png' || $extension=='gif'){
     move_uploaded_file($_FILES["file"]["tmp_name"], "../images/posts/".$location) ;

    $profile = $username.'_profile.'.$extension;


     $sql = "insert into posts (username, posts, profile ) values('$username', '$location', '$profile')";
     $result = mysqli_query($db,$sql);

}
else
{
echo "<script>alert('File is not image')</script>";
}
}


function chech_follow($db, $post ){
   $sql = "select * from users where username='".$_SESSION['login_user']."'";

    $res = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $followers = $row['following'];
    if(strpos($followers, $post) != false){
        return 'Unfollow';
    }else{
        return 'Follow';
    }
}

if(isset($_POST['request'])){

    $name = $_POST['request'];
    
    $sql = "select * from users where username='".$_SESSION['login_user']."'";


    $res = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $followers = $row['following'];

    if(strpos($followers, $name) == false){
        $name = mysqli_real_escape_string($db,$_POST['request']);
        $sql = "update users set following= ('$followers:$name') where username='".$_SESSION['login_user']."'" ;
        mysqli_query($db, $sql);
    }else{
	
        $value = str_replace($name, '', $followers);
        
         $sql = "update users set following= ('$value') where username='".$_SESSION['login_user']."'" ;
        mysqli_query($db, $sql);
        
    }
   
    
    
}



?>
<head>
   <link rel="stylesheet" href="../styles/style.home.scroll.css">
   <style type="text/css">
      #userprofile {
      height: 45px;
      width: 45px;
      border-radius: 50%
      }
      #post {
      width: 450px; /* width of container */
      height: 600px; /* height of container */
      object-fit: fill;
      object-position: 20% 0px; 
      border: 5px solid black;
      }
   </style>
</head>
<body class="container">
   <center>
      <div class="row">
         <div class="col-sm">
            <div class="card example-1 scrollbar-ripe-malinka" style="width:550px; height:700px;color:white; margin-left:50px">

           <?php     
               $sql = 'select * from posts ORDER BY id DESC';
                $res=$db->query($sql);
                
                
                   while($post = mysqli_fetch_array($res)) {   
                       $username = mysqli_real_escape_string($db,$post['username']);
			
                       $sql1 = "select profile from users where username ='$username'";
                        $res1=$db->query($sql1);
                       $row1 = mysqli_fetch_array($res1, MYSQLI_ASSOC);
                      
                ?>            
                         
                    <h4>
                        <br>
                      <strong style="float:left;margin-left:40px"><img id="userprofile" src="../images/profiles/<?php echo $row1['profile']; ?>">
                        
                      <a href="#" style="color:white;"><?php echo htmlentities($post['username']); ?></a>
                      </strong>
                        <?php 
                        
			$post['username'] = mysqli_real_escape_string($db,$post['username']);
                            if($_SESSION['login_user'] !== ($post['username'])){
                        
                        ?>
                        <form action="index.php" method="POST">
                        <button style="float:right;margin-right:45px" type="submit" class="btn btn-light" name="request" value="<?php echo htmlentities($post['username']); ?>" ><?php 
                       
                       echo chech_follow($db, $username); ?></button>
                        </form>    
                        <?php } ?>
                   </h4>
                   <div>
                      <img src="../images/posts/<?php echo $post['posts']; ?>" id="post">
                   </div>
                     <hr>
            <?php 
                      
                   }  
                ?>
                
                
               <br>
               <br>
               <hr>
            </div>
            <div class="card" style="width:550px; height:auto;color:white; margin-left:50px">
               <div style="margin:10px">
                   
                  <form action="index.php" enctype="multipart/form-data" method="post">
                      <h3>Upload a post</h3>
                     <div class="input-group form-group" style="width:280px;float:left">
                        <div class="input-group-prepend">
                           <span class="input-group-text"><i class="fas fa-image"></i></span>
                        </div>
                        <input type="file" name="file" class="form-control">
                     </div>
                     <div class="form-group">
                        <input type="submit" value="Send" name="post" class="btn float-left login_btn" style="margin-left:20px">
                         
                     </div>
                  </form>
               </div>
            </div>
         </div>
         <div class="col-sm">
            <div class="card example-1 scrollbar-ripe-malinka" style="width:250px; height:700px;color:white">
               <h4><?php echo $_SESSION['login_user']; ?></h4>
                <?php 
                $username = $_SESSION['login_user'];
                $sql = "select profile from users where username='$username' limit 1";
                $res= mysqli_query($db, $sql);
                $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

                ?>
               <img src="../images/profiles/<?php echo ($row['profile']); ?>" width="200px">
               <br>
               <div style="text-align:left;margin-left:30px">
                  <strong>
                      Username: <?php echo htmlentities($_SESSION['login_user']); ?><br>
                      Followers: 56
                      Following: 50
                  <br>
                      Rating: 3.5/5
                  <hr>
                
                  Friends list</strong><br><br>
                    <?php   
                  $sql = "select * from users where username='".$_SESSION['login_user']."'" ;
                    $res = mysqli_query($db, $sql);
                   $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                   $friend = $row['following'];
                    
                   
                    $str_arr = explode(":", $friend);  
                    foreach($str_arr as $item){
                         $item =  str_replace(' ', '',$item);
			 $item = mysqli_real_escape_string($db,$item);
                        if($item !== ''){
                        $sql = "select * from users where username='$item'";
                        $res = mysqli_query($db, $sql);
                        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                        $pic = $row['profile'];
                        
                   
                   
                ?> 
                 
                  <img id="userprofile" src="../images/profiles/<?php echo $pic; ?>"> <a href="#" style="color:white;"><?php echo $item; ?></a><br><br>
                   
                <?php }
                    }?>  
                  
               </div>
            </div>
         </div>
      </div>
   </center>
</body>


