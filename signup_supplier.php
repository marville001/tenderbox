<?php 
 include "includes/header.php"
?>
<body>
<div class="container">
      <nav>
        <a href="#" class="logo">Tenderbox</a>
        <ul>
          <li><a href="#">How It Works</a></li>
          <li><a href="#">About Us</a></li>
          <li><a href="#">Find Tenders</a></li>
          <li><a href="#">FAQs</a></li>
        </ul>
      </nav>
  <div class="wrapper">
    <section class="form signup">
      <header>
        <h2 ><a href="signup_org.php">Organization</a></h2>
        <h2 class="active"><a href="#">Supplier</a></h2>
      </header>
      <h3 style="text-align: center;">Supplier Register</h3>
      <form action="#" method="POST" enctype="multipart/form-data" autocomplete="off">
        <div class="error-text"></div>
        <div class="field input">
          <label>Name</label>
          <input type="text" name="name" placeholder="Enter supplier name" required>
        </div>
        <div class="field input">
          <label>Email Address</label>
          <input type="text" name="email" placeholder="Enter your email" required>
        </div>
        <div class="field input">
          <label>Password</label>
          <input type="password" name="password" placeholder="Enter new password" required>
          <i class="fas fa-eye"></i>
        </div>
        <div class="field button">
          <input type="submit" name="submit" value="Continue">
        </div>
      </form>
      <div class="link">Already signed up? <a href="login_supplier.php">Login now</a></div>
    </section>
  </div>
  </div>

  <script src="js/password-show-hide.js"></script>
  <script>
    const form = document.querySelector(".signup form"),
    continueBtn = form.querySelector(".button input"),
    errorText = form.querySelector(".error-text");

    form.onsubmit = (e) => {
      e.preventDefault();
    };

    continueBtn.onclick = () => {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "utils/signup_supplier.php", true);
      xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            let data = xhr.response;
            if (data === "success") {
              location.href = "supplier/index.php";
              errorText.style.display = "none";
            } else {
              errorText.style.display = "block";
              errorText.textContent = data;
            }
          }
        }
      };
      let formData = new FormData(form);
      xhr.send(formData);
    };
  </script>

</body>
</html>
