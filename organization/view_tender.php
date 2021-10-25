<?php 
include 'includes/config.php' ;
include 'includes/header.php' ;
include 'includes/components.php' ;

$org_id = $_SESSION['org_id'];

if(!isset($_GET['tender_id'])){
    header("location: view_tenders.php");
}
$tender_id = $_GET['tender_id'];

$result = $conn->query(
    "select organisation.*, tender.*, tender.id tid from organisation INNER JOIN tender on organisation.id = tender.org_id where organisation.id = '$org_id' and tender.tenderno = '$tender_id'");



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
                    <table class="table col col-6">
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
                    <div class="row">
                        <div class="col col-6">
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
                        </div> 

                        <?php
                            $t_docs_result = $conn->query("select * from required_documents where tender_id = $data[tid]");
                        ?>
                        <div class="col col-6">
                            <h2>List of Required Documents</h2>
                            <form class="row" id="form_add_doc" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="tender_id" value="<?php echo $data['tid'] ?>">
                                <div class="col col-5">
                                    <input type="text" placeholder="Document Name" class="form-control" name="document">
                                </div>    
                                <div class="col col-3">
                                    <input type="number" min="1" placeholder="Marks" class="form-control" name="marks">
                                </div>
                                <div class="col col-2">
                                    <button class="btn btn-primary" id="btn_add_doc" type="sumbit">Add</button>
                                </div>                
                            </form>
                            <div class="bg-gray my-4 p-3 row">
                                    <?php
                                    if(mysqli_num_rows($t_docs_result) > 0){
                                        while($docs = mysqli_fetch_assoc($t_docs_result)){
                                            ?>
                                                <div class="col"> 
                                                    <h3><?php echo $docs['document'] ?></h3>
                                                </div>
                                                <div class="col"> 
                                                    <h5 class="text-success" ><?php echo $docs['marks'] ?> marks</h5>
                                                </div>
                                                <hr>
                                            <?php
                                        }
                                    }else{
                                        ?>
                                            <h4>No document yet</h4>
                                        <?php
                                    }

                                    ?>
                                
                            </div>
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

<script>
      const form = document.querySelector("#form_add_doc"),
      addtenderBtn = form.querySelector("#btn_add_doc");

      form.onsubmit = (e) => {
        e.preventDefault();
      };

      addtenderBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "utils/add_tender_doc.php", true);
        xhr.onload = () => {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              let data = xhr.response;
              if (data === "success") {
                alert("Added successfully");
                location.href=location.href;
              } else {
                alert(data)
              }
            }
          }
        };
        let formData = new FormData(form);
        xhr.send(formData);
      };
    </script>

<?php include 'includes/footer.php' ?>