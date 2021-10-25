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

$docresult = $conn->query("select * from tendermdocs where tender_id = '$tender_id' and supplier_id = '$supplier_id'");
$docsize = mysqli_num_rows($docresult);

?>

<main class="d-flex">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-container">
        <h3 class="page-title">Mandatory Documents Upload</h3>
        <h4 class="text-success my-2"><?php echo $docsize>0?"Documents already Uploaded":""; ?></h4>
        <form id="submitForm" class="row" method="POST" enctype="multipart/form-data">
          <input type="hidden" name="tenderid" value="<?php echo $tender_id ?>">
          <input type="hidden" name="supplierid" value="<?php echo $supplier_id ?>">

          <div class="border p-4 col-6">
              <label for="kra_pin" class="form-label">KRA CERTIFICATE (PIN)</label>
              <input <?php echo $docsize>0?"disabled":""; ?> type="file" id="kra_pin" name="kra_pin" class="form-control">
          </div>
          <div class="border p-4 col-6">
              <label for="coi" class="form-label">Certificate Of Incorporation</label>
              <input <?php echo $docsize>0?"disabled":""; ?> type="file" id="coi" name="coi" class="form-control">
          </div>
          <div class="border p-4 col-6">
              <label for="cor" class="form-label">Certificate Of Registration</label>
              <input <?php echo $docsize>0?"disabled":""; ?> type="file" id="cor" name="cor" class="form-control">
          </div>
          <div class="border p-4 col-6">
              <label for="tcc" class="form-label">Tax Compliance Certificate</label>
              <input <?php echo $docsize>0?"disabled":""; ?> type="file" id="tcc" name="tcc" class="form-control">
          </div>
          <div class="border p-4 col-6">
              <label for="c_act" class="form-label">Companies Act</label>
              <input <?php echo $docsize>0?"disabled":""; ?> type="file" id="c_act" name="c_act" class="form-control">
          </div>
          <div class="border p-4 col-6">
              <label for="ctl" class="form-label">Current Trade License</label>
              <input <?php echo $docsize>0?"disabled":""; ?> type="file" id="ctl" name="ctl" class="form-control">
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
    location.href = "tender_doc_upload.php?tenderid=<?php echo $tender_id; ?>";
  }

  nextBtn.onclick = ()=>{
    location.href = "other_docs_upload.php?tenderid=<?php echo $tender_id; ?>";
  }

  form.onsubmit = e=>{
      e.preventDefault();
  }

  submitBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/uploaddocs1.php", true);
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