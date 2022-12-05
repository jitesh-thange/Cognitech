<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang = " en " >
  <head>
    <meta charset = " UTF - 8 "/>
    <meta http - equiv = " X - UA - Compatible " content = " IE = edge "/>
    <meta name = " viewport " content = " width = device - width , initial - scale = 1.0 "/>
    
    <title> Document </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

    <style>
      #map {
        height: 600px;
        width: 100%;
       }
       #more{
        
        background-color: var(--purple);
        display: inline-block;
    margin-top: 1rem;
    padding: 1rem 3rem;
    cursor: pointer;
    color: var(--white);
    font-size: 1.8rem;
    border-radius: 0.5rem;
    text-transform: capitalize;
    padding-bottom: 42px;
       }
       .options{
        
        background-color: var(--purple);
        display: inline-block;
    margin-top: 1rem;
    padding: 1rem 3rem;
    cursor: pointer;
    color: var(--white);
    font-size: 1.8rem;
    border-radius: 0.5rem;
    text-transform: capitalize;
       }
       #select1{
        
        background-color: var(--purple);
        display: inline-block;
    margin-top: 1rem;
    padding: 1rem 3rem;
    cursor: pointer;
    color: var(--white);
    font-size: 1.8rem;
    border-radius: 0.5rem;
    text-transform: capitalize;
       }
       .find-state{
        
        background-color: var(--purple);
        display: inline-block;
    margin-top: 1rem;
    padding: 1rem 3rem;
    cursor: pointer;
    color: var(--white);
    font-size: 1.8rem;
    border-radius: 0.5rem;
    text-transform: capitalize;
    padding-bottom: 42px;
       }
       
    </style>
  </head>
  <body>
  <?php include 'header.php'; ?>
    <div class = "container">
      <h1 class = "status"> </h1>
      
      
      <p style="float: left;" class="options"> Select one from the given options:
        <select id="select1">
          <option value="restaurant">Restaurant</option>
          
          <option value="hair_care">Salon</option>
          <option value="car_wash">Car wash center</option>
        </select>
      </p>
      &nbsp;&nbsp;&nbsp;
      <button style="float: none";  class = "find-state" onclick="getOption()">Find My State</button>
      <button style="float: right";  id = "more" >Find More Place</button>

        <!-- <button onclick="getOption()">Search</button>  
        <span class="output"></span>  -->
      <div id="map"></div>
    </div>
    
    <script src = "js/mymain1.js" > </script>
    <script async defer
    src=
"https://maps.googleapis.com/maps/api/js?key=AIzaSyBSspcZ85m3XMMJX8ExRItJlwaoOPocxYE&libraries=places">
    </script>

<?php include 'footer.php'; ?>
  </body>
</html>