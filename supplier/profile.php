<?php 
include 'includes/header.php' ;
include 'includes/config.php' ;

$supplier_id = $_SESSION['supplier_id'];

$result = $conn->query("select * from supplier where id = '$supplier_id'");

$array = mysqli_fetch_assoc($result);

?>

<main class="d-flex">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-container">
        <h3 class="page-title">Update Profile</h3>
        <form id="update_details" class="col-sm-12 col-md-6">
            <div class="mb-3">
                <label class="form-label">Company Name</label>
                <input value="<?php echo $array['name']; ?>" type="text" name="companyname" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Company Email</label>
                <input value="<?php echo $array['email']; ?>" readonly type="email" name="companyemail" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Company Phone</label>
                <input value="<?php echo $array['phone']; ?>" type="text" name="companyphone" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Company Type</label>
                <select name="companytype" class="form-control">
                    <option>Select Type</option>
                    <option value="private"<?php echo $array['type'] == "private" ? "selected":""; ?>>Private</option>
                    <option value="public" <?php echo $array['type'] == "public" ? "selected":""; ?>>Public</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Started in (year)</label>
                <input <?php if($array['startyear'] > 0){ echo "readonly";} ?> min="1900" value="<?php if($array['startyear'] > 0){ echo $array['startyear'];} ?>" type="number" name="companystart" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Describe your company</label>
                <textarea type="text" name="description" class="form-control"><?php echo $array['description']; ?></textarea>
            </div>
            <button type="submit" id="updateprofile" class="btn btn-primary">Update</button>
        </form>
    </section>
</main>

<script>
    const form = document.querySelector("#update_details"),
    updateProfileBtn = form.querySelector("#updateprofile");

    form.onsubmit = (e) => {
    e.preventDefault();
    };

    updateProfileBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "utils/update_details.php", true);
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