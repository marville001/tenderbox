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
$orgresult = $conn->query("select * from organisation where id = '$org_id'");
$orgrow = mysqli_fetch_assoc($orgresult);

?>

<main class="d-flex">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-container">
        <h3 class="page-title">Place Bid</h3>
        <table class="table">
            <tbody>
                <tr>
                    <td>Organization Name</td>
                    <td><?php echo $orgrow['name'] ?></td>
                </tr>
                <tr>
                    <td>Tender name</td>
                    <td><?php echo $row['tendername'] ?></td>
                </tr>
                <tr>
                    <td>Budget</td>
                    <td><?php echo $row['minbudget']. " - ".$row['maxbudget']  ?></td>
                </tr>
                <tr>
                    <td>Period</td>
                    <td><?php echo $row['period'] ?> months</td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><?php echo $row['description'] ?></td>
                </tr>
            </tbody>
        </table>
        <br>
        <hr>

        <h4>Terms and Conditions</h4>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi ut atque facilis.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio magni ratione explicabo molestias assumenda quis libero, eaque nobis quo consequuntur eos possimus dignissimos esse sequi illum repudiandae doloremque voluptatibus necessitatibus.</p>
       
        <div class="form-group">
        <input id="checkInput" type="checkbox" class="mx-2" name="" id="">
        <label for="checkInput">Accept Terms and Conditions</label>
        <button id="nextBtn" class="btn btn-primary mx-5">Next</button>
        </div>
    </section>
</main>

<script>
  const checkInput = document.getElementById("checkInput");
  const nextBtn = document.getElementById("nextBtn");

  nextBtn.disabled = true;

  checkInput.onchange = (e)=>{
    const checked = (e.target.checked);
    nextBtn.disabled = checked?false:true
  }

  nextBtn.onclick = ()=>{
    console.log("Going....");
    location.href = "supplier_details_confirm.php?tenderid=<?php echo $tender_id; ?>";
  }

</script>
<?php include 'includes/footer.php' ?>