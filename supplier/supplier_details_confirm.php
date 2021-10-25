<?php 

include 'includes/config.php';
include 'includes/header.php';

$supplier_id = $_SESSION['supplier_id'];
if(!isset($_GET['tenderid'])){
  header("location: index.php");
}
$tender_id = $_GET['tenderid'];


$sup_name = "";
$sup_email = "";
$sup_desc = "";
$sup_location = "";
$sup_address = "";
$sup_contact = "";

$result = $conn->query("select * from tender where id = '$tender_id'");
$row = mysqli_fetch_assoc($result);
$supresult = $conn->query("select * from supplier where id = '$supplier_id'");
$suprow = mysqli_fetch_assoc($supresult);

$org_id = $row['org_id'];
$supbidresult = $conn->query("select * from bid where tender_id = '$tender_id' and supplier_id = $supplier_id");


if(mysqli_num_rows($supbidresult) > 0){
    $supbidrow = mysqli_fetch_assoc($supbidresult);

    $sup_name = $supbidrow["supplier_name"];
    $sup_email = $supbidrow["supplier_email"];
    $sup_desc = $supbidrow["supplier_desc"];
    $sup_location = $supbidrow["supplier_location"];
    $sup_address = $supbidrow["supplier_address"];
    $sup_contact = $supbidrow["supplier_contact"];
}else{
    $sup_name = $suprow['name'];
    $sup_email = $suprow['email'];
    $sup_desc = $suprow['description'];
    $sup_location = "";
    $sup_address = "";
    $sup_contact = $suprow['phone'];
}


?>

<main class="d-flex">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-container">
        <h3 class="page-title">Please Confirm These Details</h3>
        <form id="submitForm" class="col col-sm-12 col-8">
            <input type="hidden" value="<?php echo $supplier_id; ?>" name="supplier_id" class="form-control">
            <input type="hidden" value="<?php echo $tender_id; ?>" name="tender_id" class="form-control">
            <div class="form-group my-3">
                <label class="form-label">Supplier Name</label>
                <input type="text" value="<?php echo $sup_name; ?>" name="sup_name" class="form-control">
            </div>
            <div class="form-group my-3">
                <label class="form-label">Supplier Email</label>
                <input type="text" value="<?php echo $sup_email; ?>" name="sup_email" class="form-control">
            </div>
            <div class="form-group my-3">
                <label class="form-label">Supplier Contact</label>
                <input type="text" value="<?php echo $sup_contact; ?>" name="sup_contact" class="form-control">
            </div>
            <div class="form-group my-3">
                <label class="form-label">Supplier Location</label>
                <input type="text" value="<?php echo $sup_location; ?>" name="sup_location"  class="form-control">
            </div>
            <div class="form-group my-3">
                <label class="form-label">Supplier Address</label>
                <input type="text" value="<?php echo $sup_address; ?>" name="sup_address" class="form-control">
            </div>
            <div class="form-group my-3">
                <label class="form-label">Supplier Description</label>
                <textarea type="text" class="form-control" value="<?php echo $sup_desc; ?>" name="sup_desc"><?php echo $sup_desc ?></textarea>
            </div> 
            <button <?php if(mysqli_num_rows($supbidresult) > 0){echo "disabled";} ?> id="submitBtn" class="btn btn-success" style="width: 240px;">Submit</button>
        </form>
        <br>
        <hr>
        <div class="form-group my-3">
        <button id="backBtn" class="btn btn-secondary px-5">Back</button>
        <button id="nextBtn" class="btn btn-primary px-5">Next</button>
        </div>
    </section>
</main>

<script>
  const nextBtn = document.getElementById("nextBtn");
  const backBtn = document.getElementById("backBtn");
  const submitBtn = document.getElementById("submitBtn");
  const form = document.getElementById("submitForm");

  backBtn.onclick = ()=>{
    location.href = "bid.php?tenderid=<?php echo $tender_id; ?>";
  }

  nextBtn.onclick = ()=>{
    location.href = "tender_doc_upload.php?tenderid=<?php echo $tender_id; ?>";
  }

  form.onsubmit = e=>{
      e.preventDefault();
  }

  submitBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "utils/update_details.php", true);
        xhr.onload = () => {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              let data = xhr.response;
              if (data === "success") {
                alert("Submitted successfully. click next to continue");
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