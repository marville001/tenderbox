<?php 
include 'includes/header.php' ;
include 'includes/config.php' ;

$supplier_id = $_SESSION['supplier_id'];

$result = $conn->query("select * from bid where supplier_id = '$supplier_id'");

$query = "SELECT t.tendername tendername,t.id tenderid, bd.amount,t.minbudget,t.maxbudget, bd.status, bd.duration, s.name suppliername, s.id supplierid, td.doc tenderdocument, tmd.kra_pin, tmd.coi, tmd.cor, tmd.tcc, tmd.c_act, tmd.ctl FROM tender t INNER JOIN bid_details bd ON t.id = bd.tender_id INNER join supplier s ON bd.supplier_id = s.id INNER join tenderdocs td ON bd.tender_id = td.tender_id and bd.supplier_id= td.supplier_id INNER join tendermdocs tmd ON bd.tender_id = tmd.tender_id and bd.supplier_id= tmd.supplier_id where s.id = '$supplier_id'";

$bids_result =  $conn->query($query) or die($conn->error);

?>

<main class="d-flex" style="overflow-x: hidden;">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-csontainer mx-3" style="width: 100%">
        <h3 class="page-title">Tender Bids</h3>
        <div style="width: 100%;overflow: auto;">
            <table class="table table-sm">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Organisation</th>
                    <th scope="col">Tender Name</th>
                    <th scope="col">Budget of Tender</th>
                    <th scope="col">Tender Document</th>
                    <th scope="col">Amount Bidded</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $count = 0;
                    while($row = mysqli_fetch_assoc($bids_result)):
                        $tender_id = $row['tenderid'];
                        $org_res = $conn->query("SELECT o.name org_name from tender t INNER join organisation o on t.org_id = o.id where t.id = '$tender_id' ") or die($conn->error);

                        $org_name = mysqli_fetch_assoc($org_res)['org_name'];

                        // $tenderresult = $conn->query("select * from tender where id = '$tender_id'");
                        // $tenderrow = mysqli_fetch_assoc($tenderresult);

                        // $org_id = $tenderrow['org_id'];
                        // $orgresult = $conn->query("select * from organisation where id = '$org_id'");
                        // $orgrow = mysqli_fetch_assoc($orgresult);

                        $count ++;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $count ?></th>
                            <td><?php echo substr($org_name, 0,15)."..."; ?></td>
                            <td><?php echo $row['tendername'] ?></td>
                            <td><?php echo $row['minbudget']. " - ".$row['maxbudget']  ?></td>
                            <td><?php echo substr($row['tenderdocument'], -1,15)."..."; ?></td>
                            <td><?php echo $row['amount'] ?></td>
                            <td><?php echo $row['duration'] ?></td>
                            <td>
                                <?php 
                                    if($row['status'] == "open"){
                                        echo "<button class=\"btn btn-block btn-secondary\">Open</button>";
                                    }else if($row['status'] == "approved"){
                                        echo "<button class=\"btn btn-block btn-primary\">Approved</button>";
                                    }else{
                                        echo "<button class=\"btn btn-block btn-danger\">Rejected</button>";
                                    }
                                ?>
                            </td>
                        </tr>
                        <?php endwhile ?>
                </tbody>
            </table>
        </div>
    </section>
</main>

<?php include 'includes/footer.php' ?>