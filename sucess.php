<?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">

    <script language="javascript"  type="text/javascript">
        window.history.forword();
        </script>

        <style>
            .sus{
                text-align: center;
                color: var(--green);
                font-size: 2.8rem;
                color: #2bbd2b;
            }

        </style>
</head>
<body>
<?php include 'header.php'; ?>
    <h1 class="sus">Payment success</h1>

    <?php
    include 'config.php';
    $oid=$_POST['abc'];
    echo "<p style='color:purple;text-align: center;font-size: 2rem;'>" . $oid . "</p>";
    $oidup=substr($oid,6,2);
    mysqli_query($conn, "UPDATE `form` SET payment_status = 1 , payment_orderid='$oid' WHERE id = $oidup") or die('query failed');
    ?>


</body>
</html>