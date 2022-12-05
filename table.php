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
</head>
<body>
<?php include 'header.php'; ?>


<?php
$con=mysqli_connect("localhost","root","","shop_db");
// Check connection
if (mysqli_connect_errno())
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$result = mysqli_query($con,"SELECT * FROM form");
// $con->close();


$mysqli = new mysqli('localhost', 'root', '', 'shop_db') or die(mysqli_error($mysqli));

if(isset($_GET['delete'])){
    $id =$_GET['delete'];
    $mysqli->query("DELETE FROM form WHERE id=$id") or die($mysqli->error());
}

echo "<div class=row justify-content-center>";
echo "<table border=1>
<thead>
<tr style=padding:10px>
<th style=padding:10px>Firstname</th>
<th style=padding:10px>Lastname</th>
<th style=padding:10px>email</th>
<th style=padding:10px>textdata</th>
<th style=padding:10px;width=100px>confirm/cancel</th>

</tr>
</thead>";


while($row = mysqli_fetch_array($result))
{

echo "<tr >";
echo "<td style=padding:10px>" . $row['firstname'] . "</td>";
echo "<td style=padding:10px>" . $row['lastname'] . "</td>";
echo "<td style=padding:10px>" . $row['email'] . "</td>";
echo "<td style=padding:10px> " . $row['textdata'] . "</td>";
// echo "<td>" . $row['confirmation'] . "</td>";
echo "<td><button type=button id=button1><a class='btn btn-primary' href=message.php?edit=" .$row['id'] . ">edit</a></button>
<button><a class='btn btn-primary' href=message.php?delete=" .$row['id'] . ">delete</a></button><td>" ;

 
echo "</tr>";
}
echo "</table>";
echo "</div>";
mysqli_close($con);
?>

<?php include 'footer.php'; ?>

</body>
</html>