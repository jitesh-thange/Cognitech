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


   </head>
  <body>
  <?php include 'header.php'; ?>
<?php
	
	
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$email = $_POST['email'];
	$textdata = $_POST['textdata'];
	$status = "";
	$price = 0;
	$pay_orderid = "O";
	$pay_status = "0";
	$b_C_R = "0";
	$user_id=$_SESSION['user_id'];
	$type_category=$_POST['typedata'];
	$date=$_POST['date1'];


	// Database connection
	$conn = new mysqli('localhost','root','','shop_db');
	if($conn->connect_error){
		echo "$conn->connect_error";
		die("Connection Failed : ". $conn->connect_error);
	} else {

		$select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND id = $user_id") ;

   if(mysqli_num_rows($select_users) > 0){

      $row = mysqli_fetch_assoc($select_users);

	  if($row['id'] == $user_id && $row['email'] == $email ){
		$stmt = $conn->prepare("insert into form(user_id,firstName, lastName, email, textdata,date,status,typecat,price,b_Cancel_Request,payment_orderid,payment_status) values(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");


		
		$stmt->bind_param("ssssssssssss", $user_id,$firstName, $lastName, $email, $textdata,$date,$status, $type_category,$price,$b_C_R,$pay_orderid,$pay_status);
		$execval = $stmt->execute();
		
		echo '<div style="font-size:25px ;color:red ;text-align: center; padding:10px">Registration successfully </div>';
		
	  }
	 }
	 else{
	  	


		die('<div style="font-size:25px ;color:red ;text-align: center; padding:10px">Please Enter Valid Email  </div>');
		
			  }
   
		
	

	 


		// $stmt->close();
		// $conn->close();
	}


	

?>


<?php include 'footer.php'; ?>
  </body>
</html>
