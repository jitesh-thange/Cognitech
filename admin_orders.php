<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_GET['confirm_order'])){

   $order_update_id = $_GET['confirm_order'];
    mysqli_query($conn, "UPDATE `form` SET status = 'Y' WHERE id = $order_update_id") or die('query failed');
   $message[] = 'status has been updated!';
   if(isset($_GET['price'])){

      $price = $_GET['price'];
       mysqli_query($conn, "UPDATE `form` SET price = $price WHERE id = $order_update_id") or die('query failed');
     // $message[] = 'status has been updated!';
   
   }
}


if(isset($_GET['cancel'])){
   $order_update_id = $_GET['cancel'];
  
   $data_filter = mysqli_query($conn, "SELECT * FROM `form` WHERE id=$order_update_id ") or die('query failed333');
   if(mysqli_num_rows($data_filter) > 0){
      while($fetch_data = mysqli_fetch_assoc($data_filter)){

   if($fetch_data['status']=='Y' && $fetch_data['price']>0){
      mysqli_query($conn, "UPDATE `form` SET status = 'C' WHERE id = $order_update_id") or die('query failed111');
      $message[] = 'status has been updated!';
   }
   else{
      mysqli_query($conn, "UPDATE `form` SET status = 'N' WHERE id = $order_update_id") or die('query failed123');
      $message[] = 'status has been updated!';
   }
      }

}
  
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
   <link rel="stylesheet" href="css/admin_style.css">


   <style>
   {box-sizing: border-box;}

/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}


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
   
<?php include 'admin_header.php'; ?>

<section class="orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">
      <?php
     $id=0;
      $select_orders = mysqli_query($conn, "SELECT * FROM `form`") or die('query failed');
      if(mysqli_num_rows($select_orders) > 0){
         while($fetch_orders = mysqli_fetch_assoc($select_orders)){
      ?>
      <div class="box">
      <p> user id : <span><?php echo $fetch_orders['id']; ?></span> </p>
         <!-- <p> placed on : <span><?php //echo $fetch_orders['placed_on']; ?></span> </p> -->
         <p> name : <span><?php echo $fetch_orders['firstname']; ?></span> </p>
         <!-- <p> number : <span><?php //echo $fetch_orders['number']; ?></span> </p> -->
         <p> last name : <span><?php echo $fetch_orders['lastname']; ?></span> </p>
         <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Service : <span><?php echo $fetch_orders['textdata']; ?></span> </p>
         <p> Category : <span><?php echo $fetch_orders['typecat']; ?></span> </p>
         <p> price : <span><?php echo $fetch_orders['price']; ?></span> </p>
         <?php
         if($fetch_orders['b_Cancel_Request']==0){
            echo "<p> Cancel Request : <span>No</span> </p>";
         }else if($fetch_orders['b_Cancel_Request']==1){
            echo "<p> Cancel Request : <span>Yes</span> </p>";
         }
         ?>

         <!-- <p> total products : <span><?php //echo $fetch_orders['total_products']; ?></span> </p> -->
         <!-- <p> total price : <span>$<?php //echo $fetch_orders['total_price']; ?>/-</span> </p>
         <p> payment method : <span><?php //echo $fetch_orders['method']; ?></span> </p> -->
         <form action="conf" method="post">
            <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
            <!-- <select name="update_payment">
               <option value="" selected disabled><?php //echo $fetch_orders['payment_status']; ?></option>
               <option value="pending">pending</option>
               <option value="completed">completed</option>
            </select> -->
            <?php
            if($fetch_orders['status']=='Y'){
               echo "<a style='opacity:0.3;' id='disable-btn'>Confirm</a>";
            }else{
               $id=$fetch_orders['id'];
               echo "<a  onclick=openForm($id)  class='delete-btn'>Confirm</a>"; 
            }
            ?>
            <a href="admin_orders.php?cancel=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('cancel this order?');" class="delete-btn">cancel</a>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      ?>
   </div>


   <div class="form-popup" id="myForm">
  <form action="admin_orders.php" method="POST" class="form-container">
    <h1>Price</h1>

    <label for="price"><b>Price</b></label>
    <input type="text" placeholder="Enter Price"  id="price" name="price" required>
    <!-- <input type="text" placeholder="OrderId" name="Order"id="OrderId" value=" "> -->
  
   
    <a id="OrderId" href=" " onclick="return data();" class="delete-btn">Submit</a>
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>
</section>

<script src="js/admin_script.js"></script>
<script>
function openForm(id) {
    document.getElementById("myForm").style.display = "block";
  document.getElementById("OrderId").setAttribute('href','admin_orders.php?confirm_order='+id+'&price=');
//document.getElementById("OrderId").setAttribute('value',id);
  //document.getElementById("price").getAttribute('price')
  //orderid(id);
}
function data(){

   document.getElementById("OrderId").setAttribute('href',document.getElementById("OrderId").getAttribute('href')+document.querySelector('#price').value);
 
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
</script>


<script>

   fucntion sumfun(){

   }
   </script>
</body>
</html>