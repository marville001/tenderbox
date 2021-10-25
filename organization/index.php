<?php 
include 'includes/header.php';

$org_id = $_SESSION['org_id'];
$result1 = $conn->query("select * from tender where org_id = '$org_id' ");


$open=0;
$closed=0;
while($row11 = mysqli_fetch_array($result1)){
    $d11 = strtotime($row11['closedate']);
    $d1 = strtotime(date("Y-m-d"));
    $diff1 =  $d11 - ($d1);
    if($diff1 < 0){
        $closed ++;
    }else{
        $open ++;
    }
}

$result = $conn->query("select * from tender where org_id = '$org_id' ");
?>

<main class="d-flex">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-container">
        <h3 class="page-title">Dashboard</h3>
        <div class="info-cards">
            <div class="info-card">
                <div class="icon"><i class="fas fa-clone"></i></div>
                <div class="card-content">
                    <h2><?php echo mysqli_num_rows($result); ?></h2>
                    <h5>Total Tenders</h5>
                </div>
            </div>            
            <div class="info-card">
                <div class="icon"><i class="fas fa-archive"></i></div>
                <div class="card-content">
                    <h2><?php echo $closed; ?></h2>
                    <h5>Closed Tenders</h5>
                </div>
            </div>
            <div class="info-card">
                <div class="icon"><i class="fas fa-check-circle"></i></div>
                <div class="card-content">
                    <h2><?php echo $open; ?></h2>
                    <h5>Open Tenders</h5>
                </div>
            </div>
        </div>

        <!-- All Opprtunities -->
        <div class="tenders-title">
            <h3 class="all-tenders">All Tenders</h3>
            <a href="post_tender.php" class="btn add-tender-btn">Add New Tender</a>
        </div>
        <div class="d-flex justify-content-end">
            <a href="pdfs/alltenders.php" target="_blank" class="mx-2 btn btn-warning"><i class="fa fa-pdf" aria-hidden="true"></i>Export All Tenders</a> 
            <a href="pdfs/closedtenders.php" target="_blank" class="mx-3 btn btn-success"><i class="fa fa-pdf" aria-hidden="true"></i>Export Open Tenders</a> 
            <a href="pdfs/opentenders.php" target="_blank" class="btn btn-primary"><i class="fa fa-pdf" aria-hidden="true"></i>Export Closed Tenders</a> 
        </div>
        <table class="table table-responsive">
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
                $count = 0;
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
        <?php
        
        if(mysqli_num_rows($result)>10){
            ?>
                <a href="view_tenders.php" class="btn btn-success">View More</a>
            <?php
        }
        ?>
    </section>
</main>

<?php include 'includes/footer.php' ?>