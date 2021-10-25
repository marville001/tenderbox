<?php 

include 'includes/config.php';
include 'includes/header.php';

$supplier_id = $_SESSION['supplier_id'];
if(!isset($_GET['tenderid'])){
  header("location: index.php");
}
$tender_id = $_GET['tenderid'];

$result = $conn->query("select * from tender where id = '$tender_id'");
$row = mysqli_fetch_assoc($result);

$org_id = $row['org_id'];
$supresult = $conn->query("select * from supplier where id = '$supplier_id'");
$suprow = mysqli_fetch_assoc($supresult);

$docresult = $conn->query("select * from tenderdocs where tender_id = '$tender_id' and supplier_id = '$supplier_id'");
$docsize = mysqli_num_rows($docresult);

?>

<main class="d-flex">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-container">
        <h3 class="page-title">Document Upload</h3>
        <form id="submitForm" class="col col-sm-12 col-8" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="tenderid" value="<?php echo $tender_id ?>">
          <input type="hidden" name="supplierid" value="<?php echo $supplier_id ?>">

          <div class="border p-4">
              <label for="t_doc" class="form-label">Tender Document <span class="text-success"><?php echo $docsize>0?"Document Already Uploaded":""; ?></span></label>
              <input <?php echo $docsize>0?"disabled":""; ?> type="file" name="tenderdocument" class="form-control">
          </div>
          <button <?php echo $docsize>0?"disabled":""; ?> id="submitBtn" class="btn-success btn my-2" style="width: 240px;">Submit</button>
        </form>
        <br>
        <hr>
        <div class="form-group">
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
    location.href = "supplier_details_confirm.php?tenderid=<?php echo $tender_id; ?>";
  }

  nextBtn.onclick = ()=>{
    location.href = "required_doc_upload.php?tenderid=<?php echo $tender_id; ?>";
  }

  form.onsubmit = e=>{
      e.preventDefault();
  }

  submitBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/uploadtd.php", true);
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