<?php 
include 'includes/header.php'; 

$date = date("Y-m-d");
$time = time();

$ran = random_int(51, 199);
$alps = ['A','B',"C",'D','E',"F",'G','H',"I",'J','K',"L",'M','N',"O","P","Q","R","S","T","U","V","W","X","Y","Z"];

$rand_str = $alps[random_int(0,25)];

$tenderno = "T".$ran."-".$rand_str."-".$date."-".$time;

?>

<main class="d-flex">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-container">
        <h3 class="page-title">Post Tender</h3>
        <form id="post_tender" class="row" method="POST" enctype="multipart/form-data">
          <div class="col col-6">
              <div class="mb-3">
                  <input hidden type="text" name="tenderno" value="<?php echo $tenderno; ?>" class="form-control">
              </div>
              <div class="mb-3">
                  <label class="form-label">Tender Name</label>
                  <input type="text" name="tendername" class="form-control">
              </div>
              <div class="mb-3">
                  <label class="form-label">Budget</label>
                  <div class="d-flex">
                      <input type="text" name="minBudget" placeholder="Min" class="form-control mr-2">
                      -
                      <input type="text" name="maxBudget" placeholder="Max" class="form-control ml-2">
                  </div>
              </div>
              <div class="mb-3">
                    <label class="form-label">Opening Date</label>
                    <input type="date"  name="opendate" class="form-control">
                </div>              
                <div class="mb-3">
                    <label class="form-label">Closing Date</label>
                    <input type="date" name="closedate" class="form-control">
                </div>
                <div class="mb-3">
                      <label class="form-label">Tender Period (Months)</label>
                      <input type="number" name="tenderperiod" min="1" max = "2220" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Tender End Date</label>
                    <input type="date" name="enddate" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Sector</label>
                    <select id="sector-filter" name="sector" class="form-control filter-item">
                        <option value="">Select a Sector...</option>
                        <option value="Private">Private</option>
                        <option value="NGO">NGO</option>
                        <option value="Public">Public</option>
                        <option value="Institution">Institution</option>
                        <option value="Parastatal">Parastatal</option>
                        <option value="Church">Church</option>
                        <option value="Sacco">Sacco</option>
                        <option value="Water-Company">Water-Company</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Category</label>
                    <select id="category" name="category" class="form-control filter-item">
                        <option value="">Select a Category...</option>
                        <option value="Multiple">Multiple</option>
                        <option value="Agriculture-and-related-services">Agriculture-and-related-services</option>
                        <option value="Banking,-Finance,-Insurance-AND-Securities-(BFIS)">Banking,-Finance,-Insurance-AND-Securities-(BFIS)</option>
                        <option value="BFIS---Insurance">BFIS---Insurance</option>
                        <option value="BFIS---Merger-AND-Acquisition">BFIS---Merger-AND-Acquisition</option>
                        <option value="BFIS---Auditing">BFIS---Auditing</option>
                        <option value="Business-Processing-Organisation-(BPO)">Business-Processing-Organisation-(BPO)</option>
                        <option value="Consultancy">Consultancy</option>
                        <option value="Consultancy---Architectural">Consultancy---Architectural</option>
                        <option value="Consultancy---Education">Consultancy---Education</option>
                        <option value="Consultancy---Engineering">Consultancy---Engineering</option>
                        <option value="Consultancy---Financial">Consultancy---Financial</option>
                        <option value="Consultancy--Health">Consultancy--Health</option>
                        <option value="Consultancy--HR">Consultancy--HR</option>
                        <option value="Consultancy--IT">Consultancy--IT</option>
                        <option value="Consultancy--Law">Consultancy--Law</option>
                        <option value="Consultancy--Management">Consultancy--Management</option>
                        <option value="Consultancy--Oil-AND-Gas">Consultancy--Oil-AND-Gas</option>
                        <option value="Consultancy--Security">Consultancy--Security</option>
                        <option value="Consultancy--Tourism">Consultancy--Tourism</option>
                        <option value="Defence">Defence</option>
                        <option value="Education">Education</option>
                        <option value="Energy,Power-AND-Electrical">Energy,Power-AND-Electrical</option>
                        <option value="Energy-AND-Power-Industrial-Automation">Energy-AND-Power-Industrial-Automation</option>
                        <option value="Energy-AND-Power-Non-Renewable-Energy">Energy-AND-Power-Non-Renewable-Energy</option>
                        <option value="Energy-AND-Power-Renewable-Energy">Energy-AND-Power-Renewable-Energy</option>
                        <option value="Engineering-Procurement-AND-Construction">Engineering-Procurement-AND-Construction</option>
                        <option value="Environment-AND-Pollution">Environment-AND-Pollution</option>
                        <option value="Export-AND-Trade">Export-AND-Trade</option>
                        <option value="Healthcare-AND-Medical">Healthcare-AND-Medical</option>
                        <option value="Industry">Industry</option>
                        <option value="Industry-Automobiles">Industry-Automobiles</option>
                        <option value="Industry-Cement">Industry-Cement</option>
                        <option value="Industry-Chemicals-AND-Fertilisers">Industry-Chemicals-AND-Fertilisers</option>
                        <option value="Industry---Fire--safety-AND-Security">Industry---Fire--safety-AND-Security</option>
                        <option value="Industry---Furniture">Industry---Furniture</option>
                        <option value="Industry---Leather">Industry---Leather</option>
                        <option value="Industry---Machinery">Industry---Machinery</option>
                        <option value="Industry-Minerals-AND-Metals">Industry-Minerals-AND-Metals</option>
                        <option value="Industry---Mining">Industry---Mining</option>
                        <option value="Industry---Paper-AND-Packaging">Industry---Paper-AND-Packaging</option>
                        <option value="Industry---Plastic-AND-Rubber">Industry---Plastic-AND-Rubber</option>
                        <option value="Industry-Printing-AND-Publishing">Industry-Printing-AND-Publishing</option>
                        <option value="Industry-Textiles">Industry-Textiles</option>
                        <option value="Infrastructure-and-Construction">Infrastructure-and-Construction</option>
                        <option value="Infrastructure-Airports">Infrastructure-Airports</option>
                        <option value="Infrastucture-Bridges">Infrastucture-Bridges</option>
                        <option value="Infrastructure--Roads-and-Highways">Infrastructure--Roads-and-Highways</option>
                        <option value="Infrastructure-Tunnels">Infrastructure-Tunnels</option>
                        <option value="Infrastructure-Building">Infrastructure-Building</option>
                        <option value="Information-Technology(IT)">Information-Technology(IT)</option>
                        <option value="IT-AccesContol">IT-AccesContol</option>
                        <option value="IT-GIS-GPS-Webmapping">IT-GIS-GPS-Webmapping</option>
                        <option value="Oil-and-Gas">Oil-and-Gas</option>
                        <option value="Privatisation">Privatisation</option>
                        <option value="Public-Private-Partnership">Public-Private-Partnership</option>
                        <option value="Real-Estate">Real-Estate</option>
                        <option value="Rehabilitation">Rehabilitation</option>
                        <option value="Research-AND-Development">Research-AND-Development</option>
                        <option value="Retail">Retail</option>
                        <option value="Science-and-Technology">Science-and-Technology</option>
                        <option value="Services">Services</option>
                        <option value="Services-Entertainment-AND-Media">Services-Entertainment-AND-Media</option>
                        <option value="Services-Postal-and-Telegram">Services-Postal-and-Telegram</option>
                        <option value="Services-Survey-AND-Mapping">Services-Survey-AND-Mapping</option>
                        <option value="Sports">Sports</option>
                        <option value="Telecommunications">Telecommunications</option>
                        <option value="Transportation">Transportation</option>
                        <option value="Transportation-Airports-and-Aviatio">Transportation-Airports-and-Aviatio</option>
                        <option value="Transportation-Ports,Waterways">Transportation-Ports,Waterways</option>
                        <option value="Transport-Railways">Transport-Railways</option>
                        <option value="Transport-Roads-and-Highways">Transport-Roads-and-Highways</option>
                        <option value="Water-and-Sanitation">Water-and-Sanitation</option>
                        <option value="Other">Other</option>
                        <option value="sale-of-goods">sale-of-goods</option>
                        <option value="Disposal-of-goods">Disposal-of-goods</option>
                        <option value="Air-ticketing">Air-ticketing</option>
                        <option value="Tours-and-travel">Tours-and-travel</option>
                        <option value="Food,-Catering,-Hospitality-and-Related-Services">Food,-Catering,-Hospitality-and-Related-Services</option>
                    </select>
                </div>
              <div class="mb-3">
                  <label class="form-label">Tender Document</label>
                  <input type="file" name="tenderdoc" class="form-control" />
              </div>
              <div class="mb-3">
                  <label class="form-label">Description</label>
                  <textarea type="text" name="description" class="form-control"></textarea>
              </div>
              <button type="submit" id="addtender" class="btn btn-primary">Post Tender</button>
          </div>
        </form>

    </section>
</main>

<script>
      const form = document.querySelector("#post_tender"),
      addtenderBtn = form.querySelector("#addtender"),
      errorText = form.querySelector(".error-text");

      form.onsubmit = (e) => {
        e.preventDefault();
      };

      addtenderBtn.onclick = () => {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "utils/add_tender.php", true);
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