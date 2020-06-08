
<html>
    <title>Let's chat</title>
    <head>
        <link rel="stylesheet" href="../styles/bootstrap/bootstrap.min.css" >
        <link rel="stylesheet" type="text/css" href="../styles/style.index.css">
             
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" >
    </head>
    
    <style>
ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: rgba(0,0,0,0.5) !important;
}

li {
    padding-right: 10px;
  float: right;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
    
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #000000;
}
</style>

<ul>
          <li><a href="logout.php">Logout?</a></li>
          <li><a href="index.php">Home</a></li>
          <li><a href="profile.php">Profile</a></li>
          <li><a href="news.php">News</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="settings.php">Settings</a></li>
         
        
    </ul>
 <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script>
   $(document).on('click', 'ul li', function(){
       $(this).addClass('active').siblings().removeClass('active')
   })

</script>

