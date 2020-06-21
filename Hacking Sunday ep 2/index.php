<?php 
include('serialize.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Simple CTF Lab To Learn</title>

    <!-- Icons font CSS-->
    <link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="./css/google.css" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-01 p-t-180 p-b-100 font-poppins">       
        <center style="margin-top:-100px">
        <h1 style="color:white">Hacking Sunday ep 2: Simple Deserialization</h1>
            
</center>
        <div class="wrapper wrapper--w780">
            <div class="card card-3" >
                <div class="card-heading"></div>
                <div class="card-body" >
                    <h2 class="title">Save your details</h2>
                    <form method="POST" action="index.php">
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Name" name="name">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3 js-datepicker" type="text" placeholder="Birthdate" name="birthday">
                            <i class="zmdi zmdi-calendar-note input-icon js-btn-calendar"></i>
                        </div>
                        <div class="input-group">
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="gender">
                                    <option disabled="disabled" selected="selected">Gender</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                    <option>Other</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="email" placeholder="Email" name="email">
                        </div>
                        <div class="input-group">
                            <input class="input--style-3" type="text" placeholder="Phone" name="phone">
                        </div>
                        <div class="p-t-10">
                            <button name="submit" class="btn btn--pill btn--green" type="submit">Submit</button>
                        </div>
                        </form>
                    <form action="index.php" method="post" enctype="multipart/form-data">
                         <h3 style="color:white">Or <br>upload a file</h3>
                        <div class="p-t-10" >
                            <input style="background-color:#00d800;border-radius:20px" name="file" type="file" class="custom-file-input " id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                        <div class="p-t-10">
                            <button name="serial" class="btn btn--pill btn--green" type="submit">Submit</button><br><br>
                            <a href="data.php" style="color:white">Get your detail</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            <center>
                
              <h1 style="color:white"><a href="https://github.com/TROUBLE-1/">My Github profile</a></h1>
        </center>
    </div>

    <!-- Vendor JS-->
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/datepicker/moment.min.js"></script>
    <script src="vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="js/global.js"></script>

</body><!-- serialize.bak -->

</html>
<!-- end document-->

