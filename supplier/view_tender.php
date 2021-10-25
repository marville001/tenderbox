<?php 
include 'includes/config.php' ;
include 'includes/header.php' ;
include 'includes/components.php' ;

if(!isset($_GET['tender_id'])){
    header("location: view_tenders.php");
}
$tender_id = $_GET['tender_id'];

$result = $conn->query(
    "select organisation.name, organisation.email, tender.* from organisation INNER JOIN tender on organisation.id = tender.org_id where tender.tenderno = '$tender_id'");


?>


<main class="d-flex">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-container">
        <h3 class="page-title">Tender Details </h3>
        <div class="row tenders-container">
        <?php 
            if(mysqli_num_rows($result) > 0){
                $data = mysqli_fetch_assoc($result);
                $d1 = strtotime($data['closedate']);
                $d = strtotime(date("Y-m-d"));
                $diff =  $d1 - ($d);
                ?>
                    <h3 class="text-success"><?php echo $data['tendername'] ?></h3>
                    <div class="row">
                        <div class="col-md-4">
                            <hr>
                            <h5><?php echo $data['name'] ?></h5>
                            <span class="bg-primary px-3 py-1 my-2 text-white">Public</span>
                            <hr>
                            <h5 class="text-gray">Category</h5>
                            <p><?php echo $data['category'] ?></p>
                            <hr>
                            <h5 class="text-gray">Sector</h5>
                            <p><?php echo $data['sector'] ?></p>
                            <hr>
                            <h5 class="text-gray">Closing Date</h5>
                            <p><?php echo $data['closedate'] ?></p>
                            <hr>
                            <p><?php echo $data['description'] ?></p>
                            <hr>
                            <div class="row">
                                <a href="#" class="btn col btn-sm btn-success">Send Email</a>
                                <a href="#" class="btn col btn-sm btn-success mx-1">Share</a>
                                <a target="_blank" href="../uploads/<?php echo $data['tenderdoc']; ?>" class="btn col btn-sm btn-success">Download</a>
                            </div>
                            <div class="row my-4">
                                <a href="bid.php?tenderid=<?php echo $data['id'] ?>" class="btn btn-outline-success">Place Bid</a>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <iframe src="../uploads/<?php echo $data['tenderdoc']; ?>" frameborder="0" width="100%" height="600px">hfghfgh</iframe>
                        </div>
                    </div>
                <?php

            }else{
                ?>
                    <h3>The Tender is not available</h3>
                <?php
            }
        ?>
        </div>
                
    </section>
</main>

<?php include 'includes/footer.php' ?>