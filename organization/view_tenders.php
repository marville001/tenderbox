<?php 
include 'includes/config.php' ;
include 'includes/header.php' ;
include 'includes/components.php' ;

$org_id = $_SESSION['org_id'];
$result = $conn->query("select * from tender where org_id = '$org_id' ");

?>

<main class="d-flex">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-container">
        <h3 class="page-title">All Tenders</h3>
        <div class="d-flex justify-content-end my-2">
            <a href="pdfs/alltenders.php" target="_blank" class="mx-2 btn btn-warning"><i class="fa fa-pdf" aria-hidden="true"></i>Export All Tenders</a> 
            <a href="pdfs/opentenders.php" target="_blank" class="mx-3 btn btn-success"><i class="fa fa-pdf" aria-hidden="true"></i>Export Open Tenders</a> 
            <a href="pdfs/closedtenders.php" target="_blank" class="btn btn-primary"><i class="fa fa-pdf" aria-hidden="true"></i>Export Closed Tenders</a> 
        </div>
        <div class="row">
            <table class="table col-6">
                <thead>
                    <tr>
                        <th>Tender No</th>
                        <th>Tender Name</th>
                        <th>Open Date</th>
                        <th>Close Date</th>
                        <th>Period</th>
                        <th>End Date</th>
                        <th>Sector</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Bids</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $count =0;
                    while($row = mysqli_fetch_assoc($result) and $count<10){
                        $count ++;
                        $d1 = strtotime($row['closedate']);
                        $d = strtotime(date("Y-m-d"));
                        $diff =  $d1 - ($d);
                    ?>
                    <tr>
                        <td>
                            <a href="view_tender.php?tender_id=<?php echo $row['tenderno']; ?>">
                                <?php echo substr($row['tenderno'], 0,6)."..."; ?>
                            </a>
                        </td>
                        <td><?php echo substr($row['tendername'], 0,6)."..."; ?></td>
                        <td><?php echo $row['opendate']; ?></td>
                        <td><?php echo $row['closedate']; ?></td>
                        <td><?php echo $row['period']; ?></td>
                        <td><?php echo $row['enddate']; ?></td>
                        <td><?php echo $row['sector']; ?></td>
                        <td><?php echo substr($row['category'], 0,6)."..."; ?></td>
                        <td>
                            <?php 
                                if($diff < 0){
                                    ?>
                                    <div class="status-closed">closed</div>
                                    <?php
                                }else{
                                    ?>
                                    <div class="status-won">Open</div>
                                    <?php
                                }
                            ?>
                        </td>
                        <td><a style="padding:2px 10px;" href="bids.php?tender_id=<?php echo $row['id']; ?>" class="status-won">Bids</div></td>
                    </tr>
                    <?php
                    }
                ?>
                </tbody>
            </table> 
    </section>
</main>

<?php include 'includes/footer.php' ?>