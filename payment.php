<?php
$API="rzp_test_gzNuOcVwUXY9Jl";
include 'config.php';

session_start();

 $id = $_SESSION['user_id'];

if(!isset($id)){
   header('location:login.php');
}

$oid=0;

if(isset($_GET['confirm_order'])){
    $oid=$_GET['confirm_order'];

}
$email = $_SESSION['user_email'];

$order_query = mysqli_query($conn, "SELECT * FROM `form` WHERE user_id = $id and id=$oid ") or die('query failed');

if(mysqli_num_rows($order_query) > 0){
    $fetch_orders = mysqli_fetch_assoc($order_query);


}
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
    </head>

<body>
   
<header class="header">
<div class="header-2">
      <div class="flex">
         <a href="home.php" class="logo">Cognitech</a>
         <nav class="navbar"></nav>
</div>
</div>


</header>
<section class="placed-orders">

   <h1 class="title">Make Payment</h1>
</section>
<?php $id= intval($fetch_orders['price']); ?>
<form  action="sucess.php"method="POST">
<script 
    style="
        display: inline-block;
        padding-right:630px"
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="<?php echo $API; ?>"  
    data-amount=<?php echo $id*100 ;?>
    data-currency="INR"
    data-id="order_"
    data-buttontext="Pay with Razorpay"
    data-name="Cognitech"
    data-description="A Wild Sheep Chase is the third novel by Japanese author Haruki Murakami"
    data-image="https://example.com/your_logo.jpg"
    data-prefill.name="<?php $fetch_orders['firstname']; ?>"
    data-prefill.email="<?php echo $email; ?>"
    data-theme.color="#c85ce6"
></script>


<input   type="hidden" name="abc" id="nameofid" value=" ">
<script>

var scripts = document.getElementsByTagName('script');
for (var i = 0; i < scripts.length; i++) {
    var script = scripts[i];
    // you might consider using a regex here
    if (script.getAttribute('data-name') == 'Cognitech') {
        // we've got a match
        var dataId = script.getAttribute('data-id');
        var d = new Date();
        document.getElementById("nameofid").setAttribute('value',dataId+'<?php echo $fetch_orders['id']; ?>'+(d.getMonth()+1)+d.getDate()+d.getFullYear());
        
    }

}

</script>


</form>
<script>
    var scripts = document.getElementsByTagName('script');
for (var i = 0; i < scripts.length; i++) {
    var script = scripts[i];
    // you might consider using a regex here
    if (script.getAttribute('data-name') == 'Cognitech') {
        // we've got a match
       // var dataId = script.getAttribute('data-buttontext');
        script.getAttribute('data-buttontext').setAttribute('Pay with razor').style.fontSize = "x-large";
        document.getElementById("nameofid").setAttribute('value',dataId+'<?php echo $fetch_orders['id']; ?>'+(d.getMonth()+1)+d.getDate()+d.getFullYear());
        
    }

}
</script>


</body>
</html>