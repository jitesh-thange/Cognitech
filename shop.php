<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}

if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
      $message[] = 'already added to cart!';
   }else{
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
      $message[] = 'product added to cart!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">

   <style>
         .button {
            background-color: purple;
            color: white;
            text-align: center;
            font-size: 20px;
         }
         .headings{
            font-size: 50px;
         }
      </style>

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3 style="background-color: white;" >Explore</h3>
   <p> <a href="home.php">home</a> / Explore </p>
</div>

<section class="products">

<!-- 
   <h1 class="title">latest products</h1>

   <div class="box-container">

      <?php  
         $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['name']; ?></div>
      <div class="price">₹<?php echo $fetch_products['price']; ?>/-</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
      <input type="submit" value="add to cart" name="add_to_cart" class="btn">
     </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div> -->

   <!-- <div class = "container">
   <p class="options"> 
      <h3>Select catagory:</h3>
        <select id="select1">
          <option value="Swimming class">Swimming Classes</option>
          <option value="gym">Gym</option>
          <option value="computer class">Computer Classes</option>
          <option value="Karate school">Karate</option>
          <option value="Karate school">Karate</option>
          <option value="Karate school">Karate</option>
          <option value="Karate school">Karate</option>
        </select>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <button  onclick="location.href = 'map.php';">Find My State</button>
        &nbsp;&nbsp;&nbsp;&nbsp;
        <button id = "more" >Find More Place</button>
        <div> -->
         <!-- <?php
         // $result = $_GET['data'];
         // echo $result;
        ?> -->
        <!-- </div> -->

        <h1 class="headings">Select catagory:</h1>
        <button class="button" onclick="location.href = 'map.php';" style="width: 50%; height: 100px;">Monthly subscription</button>
        &nbsp;&nbsp;&nbsp;&nbsp;<br><br><br>
        <button class="button" onclick="location.href = 'map1.php';" style="width: 50%; height: 100px;">One time use services</button>
      
      <br>
      <br>
      
      
      
      
          
        <!-- <span class="output"></span>  -->
     
    
   



</section>
<script src = "js/main.js" > </script>
    <script async defer

    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBSspcZ85m3XMMJX8ExRItJlwaoOPocxYE&libraries=places">
    
    </script>
<script src="js/script.js"></script>
<?php include 'footer.php'; ?>

</body>
</html>