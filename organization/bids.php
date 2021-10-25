<?php 
include 'includes/config.php' ;
include 'includes/header.php' ;
include 'functions_.php';

$tender_id = $_GET['tender_id'];

$result = $conn->query("select * from bid where tender_id = '$tender_id'");
$result2 = $conn->query("select * from bid_details where tender_id = '$tender_id'");

$query = "SELECT t.tendername tendername,t.id tenderid, bd.amount,t.minbudget,t.maxbudget, bd.status, bd.duration, s.name suppliername, s.id supplierid, td.doc tenderdocument, tmd.kra_pin, tmd.coi, tmd.cor, tmd.tcc, tmd.c_act, tmd.ctl FROM tender t INNER JOIN bid_details bd ON t.id = bd.tender_id INNER join supplier s ON bd.supplier_id = s.id INNER join tenderdocs td ON bd.tender_id = td.tender_id and bd.supplier_id= td.supplier_id INNER join tendermdocs tmd ON bd.tender_id = tmd.tender_id and bd.supplier_id= tmd.supplier_id";
$bidsres = $conn->query($query);

$scoredbids = getBids();

?>

<main class="d-flex">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-container">
        <h3 class="page-title">Bids </h3>
        <div class="info-cards my-5">
            <div class="info-card">
                <div class="icon"><i class="fas fa-clone"></i></div>
                <div class="card-content">
                    <h2><?php echo mysqli_num_rows($result2) ?></h2>
                    <h5>Total Bids</h5>
                </div>
            </div>
            <div class="info-card">
                <div class="icon"><i class="fas fa-clone"></i></div>
                <div class="card-content">
                    <h2><?php echo count($scoredbids) ?></h2>
                    <h5>Passed Bids</h5>
                </div>
            </div>
            <div class="info-card">
                <div class="icon"><i class="fas fa-binoculars"></i></div>
                <div class="card-content">
                    <h2><?php echo mysqli_num_rows($result2)-count($scoredbids) ?></h2>
                    <h5 class="my-0">Failed Bids</h5>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <a href="pdfs/allbids.php?tender_id=<?php echo $tender_id?>" target="_blank" class="mx-2 btn btn-warning"><i class="fa fa-pdf" aria-hidden="true"></i>Export All Bids</a> 
            <a href="pdfs/passbids.php?tender_id=<?php echo $tender_id?>" target="_blank" class="btn btn-success"><i class="fa fa-pdf" aria-hidden="true"></i>Export Pass Bids</a> 
        </div>
        <table class="table" style="min-width: 420px;">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">View</th>
                <th scope="col">Supplier Name</th>
                <th scope="col">Supplier Email</th>
                <th scope="col">Amount Bidded</th>
                <th scope="col">Score</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if($scoredbids>0){
                    $count = 0;
                    foreach($scoredbids as $row):
                        $count ++;
                        $supresult = $conn->query("select * from supplier where id = '$row[supplierid]' ");
                        $suparray = mysqli_fetch_assoc($supresult);
                ?>
                    <tr>
                        <th scope="row"><?php echo $count; ?></th>
                        <td><a href="approvebid.php?tender_id=<?php echo $row['tenderid']; ?>&supplier_id=<?php echo $row['supplierid']; ?>" class="">View</a></td>
                        <td><?php echo $suparray['name'] ?></td>
                        <td><?php echo $suparray['email'] ?></td>
                        <td><?php echo $row['amount'] ?></td>
                        <td><?php echo $row['score']. "%" ?></td>
                        <td><a href="approvebid.php?tender_id=<?php echo $row['tenderid']; ?>&supplier_id=<?php echo $row['supplierid']; ?>" class="btn btn-success">Approve</a></td>
                     </tr>
                <?php endforeach; ?>
                <?php }else{
                    ?>
                    <tr>
                        <td colspan="6">
                            <h4 class="my-5">No bid for this tender</h4>
                        </td>
                    </tr>
                <?php
                }
                    ?>
            </tbody>
        </table>
    </section>
</main>

<?php include 'includes/footer.php' ?>