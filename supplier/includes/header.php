<?php
session_start();
if(!isset($_SESSION['supplier_id'])){
    header("location: ../index.html");
}
include 'config.php';

$supplier_id =$_SESSION['supplier_id'];
$supresult = $conn->query("SELECT * FROM supplier where id ='$supplier_id'");

$array = mysqli_fetch_assoc($supresult);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Tender Box</title>
</head>
<body>
    <nav class="nav">
        <h1 class="navbar-brand">Tenderbox</h1>
        <div class="nav-bar">
            <h5><?php echo $array['name'] ?></h5>
            <a href="logout.php" class="btn logout-btn" type="submit">Logout</a>
        </div>
    </nav>