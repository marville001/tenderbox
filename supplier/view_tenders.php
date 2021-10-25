<?php 
include 'includes/config.php' ;
include 'includes/header.php' ;
include 'includes/components.php';


$query = "select organisation.name, organisation.email, tender.* from organisation INNER JOIN tender on organisation.id = tender.org_id where organisation.id = tender.org_id";


if(isset($_GET['sector']) && isset($_GET['category'])){
    if(!empty($_GET['sector']) && !empty($_GET['category'])){
        $query=" select organisation.name, organisation.email, tender.* from organisation INNER JOIN tender on organisation.id = tender.org_id where organisation.id = tender.org_id and sector = '$_GET[sector]' and category = '$_GET[category]'";
    }else if(!empty($_GET['sector']) && empty($_GET['category'])){
        $query=" select organisation.name, organisation.email, tender.* from organisation INNER JOIN tender on organisation.id = tender.org_id where organisation.id = tender.org_id and sector = '$_GET[sector]'";
    }else if(empty($_GET['sector']) && !empty($_GET['category'])){
        $query=" select organisation.name, organisation.email, tender.* from organisation INNER JOIN tender on organisation.id = tender.org_id where organisation.id = tender.org_id and category = '$_GET[category]'";
    }
}

$result = $conn->query($query);

// $result = $conn->query("select * from tender"); 
?>


<main class="d-flex">
    <?php include 'includes/sidebar.php' ?>
    <section class="page-container">
        <div class="row tenders-container">
        <div class="jumbotron my-4">
            <h1 class="text-center">Find Tenders</h1>
            <p class="text-center">Got other tenders? Upload to Apply using our digitized process.</p>
        </div>
        <form class="row my-3 align-items-end">
            <div class="col col-3">
                  <label class="mb-2">Sector</label>
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
            <div class="col col-3">
                  <label class="mb-2">Category</label>
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
              <!-- <div class="col col-3">
                  <label class="mb-2">Budget</label>
                  <div class="row">
                    <div class="row col col-6">
                      <input name="min" type="number" class="form-control">
                    </div>
                    -
                    <div class="row col col-6">
                      <input name="max" type="number" class="form-control">
                    </div>
                  </div>
              </div> -->
            <button type="submit" class="btn btn-primary col-2 py-2">Search</button>
        </form>
        <hr>
        <p> <span class="text-primary mr-3"><?php echo mysqli_num_rows($result);  ?></span> tenders found</p>
        <div class="tender-cards"> 
        <?php 
            if(mysqli_num_rows($result) > 0){
                while($data = mysqli_fetch_assoc($result)){
                    $d1 = strtotime($data['closedate']);
                    $d = strtotime(date("Y-m-d"));
                    $diff =  $d1 - ($d);
                ?>
                        <div class="tender-card mt-2">
                            <h3 class="tender-name"><?php echo $data['tendername']. " - ". $data['tenderno'] ?></h3>
                            <div class="tender-des">
                                <div class="left">
                                    <div class="q <?php echo $diff>0?'':"bg-warning" ?>"><?php echo $diff>0?'Open':"Closed" ?> Tender</div>
                                    <h4><i class="fas fa-industry"></i> <?php echo $data['name'] ?></h4>
                                </div>
                                <div class="right">
                                    <h4><i class="fas fa-calendar"></i> <?php echo $data['closedate'] ?></h4>
                                    <div class="bg-<?php echo $diff>0?"primary":"danger"?> text-white px-2 py-1 mx-1"><?php echo $diff>0?($diff/3600/24).'days from now':"Closed" ?> </div>
                                    <div class="icons d-flex cursor-pointer">
                                        <a href="view_tender.php?tender_id=<?php echo $data['tenderno']; ?>">
                                            <i class="fas fa-share-alt mx-2"></i>
                                        </a> 
                                        <a href="view_tender.php?tender_id=<?php echo $data['tenderno']; ?>">
                                            <i class="fas fa-eye mx-2"></i>
                                        </a>    
                                    </div>
                                    <a href="bid.php?tenderid=<?php echo $data['id']; ?>" class="bg-success apply-link px-3 py-2">Apply <i class="fas fa-chevron-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php
                        // Lorem ipsum dolor sit amet consectetur adipisicing elit. Eos temporibus similique consequuntur nobis deleniti illum aliquid numquam reiciendis commodi ipsam.
                }
            }else{
                ?>
                    <h3>No tender found... try searching other sectors or categories</h3>
                    <?php
            }
            ?>
            </div>
        </div>
                
    </section>
</main>

<?php include 'includes/footer.php' ?>