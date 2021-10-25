<?php
include 'config.php';

$supplier_id = $_SESSION['supplier_id'];

$supresult = $conn->query("SELECT * FROM supplier where id ='$supplier_id'");

$array = mysqli_fetch_assoc($supresult);
?>
<section class="sidebar">
    <a href="index.php"><i class="fas fa-home"></i> Dashboard</a>
    <a href="view_tenders.php"><i class="fas fa-list-alt"></i> View Tenders</a>
    <a href="view_bids.php"><i class="fas fa-plus-square"></i> View Bids</a>
    <a href="profile.php"><i class="fas fa-user"></i> Profile</a>
</section>