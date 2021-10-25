<?php 

include 'includes/config.php';
include 'includes/header.php';

$supplier_id = $_SESSION['supplier_id'];
if(!isset($_GET['tenderid'])){
  header("location: index.php");
}
$tender_id = $_GET['tenderid'];

$req_docresult = $conn->query("select * from required_documents where tender_id = '$tender_id'");
$req_docsize = mysqli_num_rows($req_docresult);

$amount_res = $conn->query("select * from bid_details where tender_id = '$tender_id' and supplier_id='$supplier_id'");
$amount_size = mysqli_num_rows($amount_res);

$arr = array();

if($amount_size>0){
  $arr = mysqli_fetch_assoc($amount_res);
}

?>

<main class="d-flex">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-container">
        <h3 class="page-title">Your Bid Details</h3>
        <h4 class="my-2"><span class="text-success"><?php echo $amount_size>0?"Details Already Submitted":""; ?></span></h4>
        <form id="submitForm" method="POST" class="row" enctype="multipart/form-data">
          <input type="hidden" name="tenderid" value="<?php echo $tender_id ?>">
          <input type="hidden" name="supplierid" value="<?php echo $supplier_id ?>">
          <div class="p-2 col-6">
            <label for="amount" class="form-label"> Bid Amount </label>
            <input 
              placeholder="Enter your bid amount" <?php echo $amount_size>0?"disabled":""; ?> type="number" 
              id="amount" 
              name="amount" class="form-control" 
              value="<?php echo $amount_size>0? $arr['amount'] :""; ?>" />
          </div>
          <div class="col-12"></div>
          <div class="p-2 col-6">
            <label for="duration" class="form-label"> Bid Duration</label>
            <input 
            placeholder="Enter duration eg 12 months, 2 years...." <?php echo $amount_size>0?"disabled":""; ?> 
            type="text" id="duration" name="duration" class="form-control"
            value="<?php echo $amount_size>0? $arr['duration'] :""; ?>" />
          </div>
          <div class="col-12"></div>
          <button <?php echo $amount_size>0?"disabled":""; ?> id="submitBtn" class="btn-success btn my-2" style="width: 240px;">Submit</button>
        </form>
        <br>
        <hr>
        <div class="form-group">
        <button id="backBtn" class="btn btn-secondary px-5">Back</button>
        <button id="finishBtn" class="btn btn-primary px-5">Finish</button>
        </div>
    </section>
</main>

<script>
  const finishBtn = document.getElementById("finishBtn");
  const backBtn = document.getElementById("backBtn");
  const form = document.getElementById('submitForm');
  const submitBtn = document.getElementById("submitBtn");

  backBtn.onclick = ()=>{
    location.href = "required_doc_upload.php?tenderid=<?php echo $tender_id; ?>";
  }

  finishBtn.onclick = ()=>{
    location.href = "view_bids.php";
  }

  form.onsubmit = e=>{
      e.preventDefault();
  }


  submitBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/place_bid.php", true);
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