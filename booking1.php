<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang=" en ">

<head>
    <meta charset=" UTF - 8 " />
    <meta http - equiv=" X - UA - Compatible " content=" IE = edge " />
    <meta name=" viewport " content=" width = device - width , initial - scale = 1.0 " />

    <title> Document </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">


    <style>
    .panel-body {
        border-style: solid;
        width: 50%;
        text-align: center;
        
        
    }

    .form-dta {
        font-size: 25px;

    }

    .nform {
        width: 100%;

    }

    .cal {
        font-size: 25px;
    }

    .container{
        padding-left: 450px;
    }
    </style>

</head>

<body>
    <?php include 'header.php'; ?>
    <div class="heading">
   <h3 style="background-color: white;"  >Registration</h3>
   <p> <a href="home.php">home</a> / registration form </p>
</div>

    <div class="container">
        <div class="row col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">
                    <h1 >Registration Form</h1><br><br>
                </div>
                <div class="panel-body">
                    <form  class="nform" action="connect.php" method="post">
                        <div class="form-dta">
                            <label style="float: left" for="firstName">First Name :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input style="background-color:powderblue; border-style: ridge;" type="text" class="form-control" id="firstName" name="firstName" required />
                        </div><br>
                        <div class="form-dta">
                            <label style="float: left" for="lastName">Last Name :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input style="background-color:powderblue; border-style: ridge;" type="text" class="form-control" id="lastName" name="lastName" required />
                        </div><br>


                        <div class="form-dta">
                            <label  style="float: left" for="email">Email :</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input style="background-color:powderblue; border-style: ridge;" type="email" class="form-control" id="email" name="email" required />
                        </div><br>
                        <div class="form-dta">
                            <label style="float: left" for="textarea">Location name :</label>&nbsp;
                            <textarea style="background-color:powderblue; border-style: ridge;" readonly name="textdata" id="textdata" class="box"
                                placeholder="enter your message" id="textdata"  rows="1" value=$result>
              <?php
 if (isset($_GET["p1"])) {
  $p3 = $_GET["p1"] ;
  $output = str_replace('%', ' ', $p3);
  //Replace  the _ with space
  echo $output;
 }
  ?> 


</textarea>
                            <br>


                            <div class="form-dta">
                                <label style="float: left" for="type">Type of Service :</label>
                                <textarea style="background-color:powderblue; border-style: ridge;" readonly name="typedata" id="typedata" class="box" id="typedata"  value='month'
                                    rows="1">One Time service</textarea>
                            </div>
                            <br> 
                            <label style="float: left" for="date">Select the Date to start</label>
                            <input type="date" class="cal" required name="date1" min="<?= date('Y-m-d'); ?>">


                        </div>
                        <input type="submit" class="btn btn-primary" />
                    </form>
                </div>
                <div class="panel-footer text-right">

                </div>
            </div>
        </div>
    </div>
        <br><br>



    </div>
    <script src="js/main.js"> </script>
    <?php include 'footer.php'; ?>