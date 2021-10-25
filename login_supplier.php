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
        <section class="form login">
          <header>
              <h2 ><a href="login_org.php">Organization</a></h2>
              <h2 class="active"><a href="#">Supplier</a></h2>
          </header>
          <h3 style="text-align: center;">Supplier Login</h3>
          <form action="#">
            <div class="error-text">Error</div>
            <div class="field input">
              <label for="">Email Address</label>
              <input type="email" name="email" placeholder="Enter your email" />
            </div>
            <div class="field input">
              <label for="">Password</label>
              <input type="password" name="password" placeholder="Enter your password" />
              <i class="fas fa-eye"></i>
            </div>
            <div class="field button">
              <input type="submit" name="" value="Continue" />
            </div>
          </form>
          <div class="link">Not yet signed up? <a href="signup_supplier.php">Signup now</a></div>
          
        </section>
      </div>
    </div>

    <script src="js/password-show-hide.js"></script>
    <script>
      const form = document.querySelector(".login form"),
      continueBtn = form.querySelector(".button input"),
      errorText = form.querySelector(".error-text");

      form.onsubmit = (e) => {
        e.preventDefault();
      };

      continueBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "utils/login_supplier.php", true);
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
