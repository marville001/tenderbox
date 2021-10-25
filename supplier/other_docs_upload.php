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

?>

<main class="d-flex">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-container">
        <h3 class="page-title">Other Documents Upload </h3>
        <p>NB: These documents are required specifically by the organization.</p>
        <?php if($req_docsize <= 0 ): ?>
          <div class="py-5 text-center">
            <h4 class="text-primary">No Other document is required</h4>
          </div>
        <?php else: ?>
          <div class="row">          
            <?php while($row = mysqli_fetch_assoc($req_docresult)): 
              $n_array =  explode(" ",$row['document']);
              $d_name = strtolower(implode("_",$n_array));

              $docresult = $conn->query("select * from otherdocs where tender_id = '$tender_id' and supplier_id = '$supplier_id' and name= '$d_name'");
              $docsize = mysqli_num_rows($docresult);
            ?>
              <form method="POST" class="col col-6 submitForm" enctype="multipart/form-data">
                  <input type="hidden" name="tenderid" value="<?php echo $tender_id ?>">
                  <input type="hidden" name="supplierid" value="<?php echo $supplier_id ?>">
                    <div class="border p-2">
                        <label for="<?php echo $d_name ?>" class="form-label">
                          <?php echo $row['document'] ?>
                          <span class="text-success"><?php echo $docsize>0?"Document Already Uploaded":""; ?></span>
                        </label>
                        <input <?php echo $docsize>0?"disabled":""; ?> type="file" name="<?php echo $d_name ?>" class="form-control">
                        <button <?php echo $docsize>0?"disabled":""; ?> id="submitBtn" class="btn-success btn my-2" style="width: 240px;">Upload</button>
                    </div>
              </form>
            <?php endwhile ?>
          </div>
        <?php endif ?>
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
  const forms = document.getElementsByClassName('submitForm');

  backBtn.onclick = ()=>{
    location.href = "required_doc_upload.php?tenderid=<?php echo $tender_id; ?>";
  }

  nextBtn.onclick = ()=>{
    location.href = "bid_amount.php?tenderid=<?php echo $tender_id; ?>";
  }

  const submitBtn = document.getElementById("submitBtn");

  for(let form of forms){
    form.onsubmit = e=>{
      e.preventDefault();
      const value = form.querySelector('.form-label').attributes.for.value;
      console.log({value});
      let xhr = new XMLHttpRequest();
      xhr.open("POST", `utils/uploadotherdocs.php?value=${value}`, true);
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
    }
  }


  submitBtn.onclick = () => {
    // let xhr = new XMLHttpRequest();
    // xhr.open("POST", "utils/uploaddocs1.php", true);
    // xhr.onload = () => {
    //   if (xhr.readyState === XMLHttpRequest.DONE) {
    //     if (xhr.status === 200) {
    //       let data = xhr.response;
    //       if (data === "success") {
    //         alert("Submitted successfully. click next to continue");
    //         location.href=location.href;
    //       } else {
    //         alert(data)
    //       }
    //     }
    //   }
    // };
    // let formData = new FormData(form);
    // xhr.send(formData);
  };



</script>
<?php include 'includes/footer.php' ?>