<?php 
include 'includes/config.php' ;
include 'includes/header.php' ;
include './functions_.php' ;

$tender_id = $_GET['tender_id'];
$supplier_id = $_GET['supplier_id'];

$result = $conn->query("select supplier.*, bid.tender_id, bid.supplier_id, bid.status from supplier INNER JOIN bid on supplier.id = bid.supplier_id where bid.tender_id = '$tender_id'");

$query = "SELECT t.tendername tendername,t.id tenderid, bd.amount,t.minbudget,t.maxbudget, bd.status, bd.duration, s.name suppliername, s.startyear, s.type,s.email,s.phone,s.description, s.id supplierid, td.doc tenderdocument, tmd.kra_pin, tmd.coi, tmd.cor, tmd.tcc, tmd.c_act, tmd.ctl FROM tender t INNER JOIN bid_details bd ON t.id = bd.tender_id INNER join supplier s ON bd.supplier_id = s.id INNER join tenderdocs td ON bd.tender_id = td.tender_id and bd.supplier_id= td.supplier_id INNER join tendermdocs tmd ON bd.tender_id = tmd.tender_id and bd.supplier_id= tmd.supplier_id where t.id = '$tender_id' and s.id= $supplier_id";
$bidsres = $conn->query($query);

$row= mysqli_fetch_assoc($bidsres);

$bid = getBid();
$submitteddocs = $conn->query("SELECT * FROM otherdocs where tender_id = $tender_id and supplier_id=$supplier_id ");
$submitteddocssize =  mysqli_num_rows($submitteddocs);
        
?>

<main class="d-flex">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-container">
        <h3 class="page-title">Approve Bid</h3>
        <div class="row">
            <div class="col col-12 col-md-4 my-2 card p-3 px-2">
                <h4>Bid Condition</h4>
                <hr>
                <h5>Amount : <?php echo $row['amount'] ?></h5>
                <h5>Within Budget : <?php
                if($row['amount'] >= $row['minbudget'] && $row['amount'] <= $row['maxbudget']){
                    echo "<span class=\"btn btn-success\">YES</span>";
                }else{
                    echo "<span class=\"btn btn-danger\">NO</span>";
                }
                ?></h5>
                <h5>Supplier Since : <?php echo $row['startyear'] ?> </h5>
                <h5>Supplier Type: <?php echo $row['type'] ?>  </h5>
                
                <hr>
                <h3>Other Details</h3>
                <p class="my-1 mx-2"><?php echo $row['email'] ?> </p>
                <p class="my-1 mx-2"><?php echo $row['phone'] ?> </p>
                <p class="my-2 mx-2"><?php echo $row['description'] ?> </p>
            </div>
            <div class="col col-12 col-md-7 mx-4 p-4 card">
                <h4>Approve / Reject order</h4>
                <hr>
                <?php 
                    if($row['status']=='open'){?>
                        <form method="post" class="approve-form">
                            <div id="loading" class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <button id="approveBtn" class="btn btn-primary my-3 btn-block">Approve</button>
                            <button id="rejectBrn" class="btn  btn-block btn-danger my-3">Reject</button>
                        </form>
                    <?php }else if($row['status']=="approved"){
                         ?>
                            <h4 class="text-white bg-success p-5">Order Approved</h4>
                            <?php }else {?>
                                <h4 class="text-warning bg-secondary p-5">Order Rejected</h4>
                         <?php } ?>
            </div>
        </div>

        <div class="row my-2">
            <div class="card mr-3">
                <div class="card-header">
                    <h2>Documents</h2>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h3>Mandatory Documents</h3>
                            <div class="card-header my-2">
                                <h5 style="text-transform: capitalize;">KRA CERTIFICATE (PIN)</h5>
                                <a href="../uploads/<?php echo $bid['kra_pin']; ?>"><?php echo $bid['kra_pin']; ?></a>
                            </div>
                            <div class="card-header my-2">
                                <h5 style="text-transform: capitalize;">Certificate Of Incorporation</h5>
                                <a href="../uploads/<?php echo $bid['coi']; ?>"><?php echo $bid['coi']; ?></a>
                            </div>
                            <div class="card-header my-2">
                                <h5 style="text-transform: capitalize;">Certificate Of Registration</h5>
                                <a href="../uploads/<?php echo $bid['cor']; ?>"><?php echo $bid['cor']; ?></a>
                            </div>
                            <div class="card-header my-2">
                                <h5 style="text-transform: capitalize;">Tax Compliance Certificate</h5>
                                <a href="../uploads/<?php echo $bid['tcc']; ?>"><?php echo $bid['tcc']; ?></a>
                            </div>
                            <div class="card-header my-2">
                                <h5 style="text-transform: capitalize;">Companies Act</h5>
                                <a href="../uploads/<?php echo $bid['c_act']; ?>"><?php echo $bid['c_act']; ?></a>
                            </div>
                            <div class="card-header my-2">
                                <h5 style="text-transform: capitalize;">Current Trade License</h5>
                                <a href="../uploads/<?php echo $bid['ctl']; ?>"><?php echo $bid['ctl']; ?></a>
                            </div>
                        </div>
                        <div class="col-6">
                            <h3>Other Documents</h3>
                            <?php
                            if($submitteddocssize <= 0 ){
                                ?>
                                    <h4 class="text-center">No other document was required</h4>
                                <?php
                            }else{
                                while($row=mysqli_fetch_assoc($submitteddocs)){
                                    $n_array =  explode("_",$row['name']);
                                    $d_name = strtolower(implode(" ",$n_array));
                                    ?>
                                        <div class="card-header my-2">
                                            <h5 style="text-transform: capitalize;"><?php echo $d_name; ?></h5>
                                            <a href="../uploads/<?php echo $bid[$row['name']] ?>"><?php echo $bid[$row['name']]; ?></a>
                                        </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>
</main>
<script>
    const form = document.querySelector(".approve-form");
    const approveBtn = form.querySelector("#approveBtn");
    const rejectBrn = form.querySelector("#rejectBrn");
    const loading = document.querySelector("#loading");
    const errorText = form.querySelector(".error-text");

    form.onsubmit = (e) => {
        e.preventDefault();
    };

    loading.style.display= "none";

    approveBtn.onclick = () => {
        let searchQuery = location.search;
        loading.style.display= "block";
        let xhr = new XMLHttpRequest();
        xhr.open("POST", `utils/approveBid.php?tender_id=<?php echo $tender_id; ?>&supplier_id=<?php echo $supplier_id ?>&supemail=<?php echo $row['email']?>`, true);
        xhr.onload = () => {
            if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                if (data === "success") {
                alert("Bid approved successfully. an email has been sent to the supplier");
                location.href=location.href;
            } else {
                location.href=location.href;
                alert(data)
            }
            loading.style.display= "none";
            }
            }
        };
        let formData = new FormData(form);
        xhr.send(formData);
    };
</script>

<?php include 'includes/footer.php' ?>