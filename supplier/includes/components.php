<?php
    function renderTenderCard($id,$name, $comp, $cdate, $odate, $sec, $cat, $doc){
        echo "<div class=\"card py-2 bg-gray m-1\">
                <p class=\"text-secondary my-1\"><span class=\"text-primary\">Tender Number:</span> $id</p>
                <h5>$name</h5>
                <div class=\"d-flex justify-content-start\">
                    <span class=\"text-primary\">
                        <i class=\"fa fa-industry\"></i>Company: 
                    </span> &nbsp;
                    <h5 class=\"text-success\"> $comp</h5>
                </div>
                <div class=\"row\">
                    <div class=\"col col-6 d-flex justify-content-start\">
                        <span class=\"text-primary\">
                            <i class=\"fa fa-industry\"></i>Opening date: 
                        </span> &nbsp;
                        <h5 class=\"text-success\">$odate</h5>
                    </div>
                    <div class=\"col col-6 d-flex justify-content-start\">
                        <span class=\"text-primary\">
                            <i class=\"fa fa-industry\"></i>Closing date: 
                        </span> &nbsp;
                        <h5 class=\"text-success\">$cdate</h5>
                    </div>
                </div>
                <div class=\"row\">
                    <div class=\"col col-6 d-flex justify-content-start\">
                        <span class=\"text-primary\">
                            <i class=\"fa fa-industry\"></i>Sector: 
                        </span> &nbsp;
                        <h5 class=\"text-success\">$sec</h5>
                    </div>
                    <div class=\"col col-6 d-flex justify-content-start\">
                        <span class=\"text-primary\">
                            <i class=\"fa fa-industry\"></i>Category: 
                        </span> &nbsp;
                        <h5 class=\"text-success\">$cat</h5>
                    </div>
                </div>
                <div class=\"row align-items-center px-2\">
                    <div class=\"col col-8 d-flex bg-white br-4\">
                        <a href=\"../uploads/$doc\" target=\"_blank\">$doc</a>
                    </div>
                    <div class=\"col col-4 d-flex\">
                        <a class=\"btn btn-primary btn-sm px-5\" href=\"view_tender.php?tno=$id\">View</a>
                    </div>
                </div>
            </div>
        ";
    }
?>