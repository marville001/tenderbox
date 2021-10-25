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
                    <h3>Organization details</h3>
                    <table class="table">
                        <tbody>
                            <tr>
                                <th scope="row">Name</th>
                                <td><?php echo $data['name'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Email</th>
                                <td><?php echo $data['email'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <h3>Tender details</h3>
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">Tender No</th>
                                <td><?php echo $data['tenderno'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Name</th>
                                <td><?php echo $data['tendername'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Budget</th>
                                <td><?php echo $data['minbudget'] ." - ".$data['maxbudget'] ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Period</th>
                                <td><?php echo $data['period'] ." months" ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Open Date</th>
                                <td><?php echo $data['opendate']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Close Date</th>
                                <td><?php echo $data['closedate']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Valid Till (End of Tender)</th>
                                <td><?php echo $data['enddate']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Sector</th>
                                <td><?php echo $data['sector']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Category</th>
                                <td><?php echo $data['category']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Document</th>
                                <td>
                                    <a target="_blank" href="../uploads/<?php echo $data['tenderdoc']; ?>">
                                        <?php echo $data['tenderdoc']; ?>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Description</th>
                                <td><?php echo $data['description']; ?></td>
                            </tr>
                            <tr>
                                <th scope="row">Status</th>
                                <td>
                                <?php 
                                    if($diff < 0){
                                        ?>
                                        <div class="status-closed" style="width: 200px">closed</div>
                                        <?php
                                    }else{
                                        ?>
                                        <div class="status-won" style="width: 200px">Open</div>
                                        <?php
                                    }
                                ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <a href="bid.php?tenderid=<?php echo $data['id'] ?>" class="btn btn-success">Place Bid</a>
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