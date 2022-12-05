<?php

include 'config.php';

session_start();

 $id = $_SESSION['user_id'];

if(!isset($id)){
   header('location:login.php');
}


if(isset($_GET['cancel_order'])){

   $order_update_id = $_GET['cancel_order'];
    mysqli_query($conn, "UPDATE `form` SET b_Cancel_Request = 1 WHERE id = $order_update_id") or die('query failed');
   $message[] = ' Cancel Request Sent Successfully!';
   
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="css/style.css">
   <style>

#disable-btn{
   
   display: inline-block;
   margin-top: 1rem;
   padding:1rem 3rem;
   cursor: pointer;
   color:var(--white);
   margin-top: 0;
   font-size: 1.8rem;
   border-radius: .5rem;
   text-transform: capitalize;
   background-color: var(--red);
}
      </style>
</head>
<body>
   
<?php include 'header.php'; ?>

<div class="heading">
   <h3 style="background-color: white;"  >your bookings</h3>
   <p> <a href="home.php">home</a> / bookings </p>
</div>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">
  
      <?php
         $order_query = mysqli_query($conn, "SELECT * FROM `form` WHERE user_id = $id") or die('query failed');
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
      ?>
       <div class="box">
       <p> Id : <span><?php echo $fetch_orders['id']; ?></span> </p>
         <p> First Name : <span><?php echo $fetch_orders['firstname']; ?></span> </p>
         <p> Last Name : <span><?php echo $fetch_orders['lastname']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Service : <span><?php echo $fetch_orders['textdata']; ?></span> </p>
         <p> Price : <span><?php echo $fetch_orders['price']; ?></span> </p>
         <p> Category : <span><?php echo $fetch_orders['typecat']; ?></span> </p>
         <?php 
         if($fetch_orders['payment_status']==0 && $fetch_orders['b_Cancel_Request']==0 && $fetch_orders['status']=='Y' ){
            echo "<p> Status : <span>Payment Pending </span></p>";
         }else if($fetch_orders['payment_status']==1 && $fetch_orders['b_Cancel_Request']==1 && $fetch_orders['status']=='Y' ){
            echo "<p> Status : <span>Cancel Request Pending </span></p>";
         }else if($fetch_orders['status']=='C' && $fetch_orders['b_Cancel_Request']==1 ){
            echo "<p> Status : <span>Order Cancelled </span></p>";
         }else if($fetch_orders['status']=='Y' && $fetch_orders['payment_status']=='1'){
            echo "<p> Status : Order Successful <span></p>";
         }else if($fetch_orders['status']=='' && $fetch_orders['payment_status']=='0'){
            echo "<p> Status : <span>Reqeust Pending <span></p>";
         }
         ?>
         
         <?php
            if($fetch_orders['status']=='Y' && $fetch_orders['payment_status']== 0){
               $oid=$fetch_orders['id'];
               echo "<a href='payment.php?confirm_order=$oid' onclick='return confirm('Are you sure on booking?')' class='delete-btn'>Make Payment</a>&nbsp;&nbsp;";
               if($fetch_orders['b_Cancel_Request']== 0 && $fetch_orders['payment_status']== 1){ ?>
                   <a href='orders.php?cancel_order=<?php echo $fetch_orders['id']; ?>' class='delete-btn'>Cancel Payment</a>;
            <?php
               }
               else{
                  echo "<a style='opacity:0.3;' id='disable-btn'>Cancel Payment</a>";
               }
            }else if($fetch_orders['status']=='Y' && $fetch_orders['payment_status']== 1){
               $oid=$fetch_orders['id'];
               echo "<a style='opacity:0.3;' id='disable-btn'>Make Payment</a>&nbsp;&nbsp;";
               if($fetch_orders['b_Cancel_Request']== 1 && $fetch_orders['payment_status']== 1){ 
                  echo "<a style='opacity:0.3;' id='disable-btn'>Cancel Payment</a>";
               }
                  else{
               echo "<a href='orders.php?cancel_order=$oid' onclick='return confirm('Are you sure on cancelling?')' class='delete-btn'>Cancel Payment</a>";
                  }
            }
            else{
               echo "<a style='opacity:0.3;' id='disable-btn'>Make Payment</a>";
            }
         ?>
         
         <!-- <p> address : <span><?php //echo $fetch_orders['address']; ?></span> </p>
         <p> payment method : <span><?php //echo $fetch_orders['method']; ?></span> </p>
         <p> your orders : <span><?php //echo $fetch_orders['total_products']; ?></span> </p>
         <p> total price : <span>$<?php //echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> payment status : <span style="color:<?php //if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php //echo $fetch_orders['payment_status']; ?></span> </p>-->
         </div>  
      <?php
       }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
       
   </div>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>