<?php

function getBids()
{
    include 'includes/config.php';

    $tender_id = $_GET['tender_id'];
    $bids = array();

    $query = "SELECT t.tendername tendername,t.id tenderid,bd.id bidid, bd.amount,t.minbudget,t.maxbudget, bd.status, bd.duration, s.name suppliername, s.email supplieremail, s.id supplierid, td.doc tenderdocument, tmd.kra_pin, tmd.coi, tmd.cor, tmd.tcc, tmd.c_act, tmd.ctl FROM tender t INNER JOIN bid_details bd ON t.id = bd.tender_id INNER join supplier s ON bd.supplier_id = s.id INNER join tenderdocs td ON bd.tender_id = td.tender_id and bd.supplier_id= td.supplier_id INNER join tendermdocs tmd ON bd.tender_id = tmd.tender_id and bd.supplier_id= tmd.supplier_id where t.id = '$tender_id'";
    $bidsres = $conn->query($query);

    if(mysqli_num_rows($bidsres)>0){
        while($row=mysqli_fetch_assoc($bidsres)){
            array_push($bids, $row);
        }
    }

    $finalArray = array();

    

    foreach($bids as $bid){
        $tid = $bid["tenderid"];
        $sid = $bid["supplierid"];

        $bidres = $conn->query("SELECT * FROM bid_details where tender_id = $tid and supplier_id=$sid ") or die($conn->error);
        $bidrow=mysqli_fetch_assoc($bidres);
        $bid['bid'] = $bidrow['id'];

        $requireddocs = $conn->query("SELECT * FROM required_documents where tender_id = $tid");

        $totaldocmarks = 0;

        if(mysqli_num_rows($requireddocs) == 0 ){
            $totaldocmarks = 100;
        }else{
            while($row=mysqli_fetch_assoc($requireddocs)){
                $totaldocmarks+=$row['marks'];
            }
        }
        $bid["totaldocmarks"] = $totaldocmarks;
        $reqdocssize =  mysqli_num_rows($requireddocs);
        if($reqdocssize <= 0 ){
            $bid["documentmarks"] = 100;
            array_push($finalArray, $bid);
        }else{
            $submitteddocs = $conn->query("SELECT * FROM otherdocs where tender_id = $tid and supplier_id=$sid ");
            $submitteddocssize =  mysqli_num_rows($submitteddocs);
            if($submitteddocssize <= 0 ){
                $bid["documentmarks"] = 0;
                array_push($finalArray, $bid);
            }else{
                $marks = 0;
                while($row=mysqli_fetch_assoc($submitteddocs)){
                    $n_array =  explode("_",$row['name']);
                    $d_name = strtolower(implode(" ",$n_array));

                    $marksres = $conn->query("SELECT * FROM required_documents where tender_id = $tid and document = '$d_name'");
                    $marksarr = mysqli_fetch_assoc($marksres);

                    $marks+=$marksarr['marks'];
                }
                $bid["documentmarks"] = $marks;
                array_push($finalArray, $bid);
            }
        }
    }

    

    $scoredarray = array();

    foreach ($finalArray as $array) {
        $fscorepercentage = 0;
        $tscorepercentage = 0;
        
        if($array['amount']< $array['minbudget'] || $array['amount']> $array['maxbudget']){
            $fscorepercentage = 0;
        }else{
            $fscorepercentage = ($array['minbudget']/$array['amount'] + $array['amount']/$array['maxbudget'])/2;
            $fscorepercentage = number_format((float) $fscorepercentage, 4) * 100;
        }
        
        $tscorepercentage = $totaldocmarks > 0 ?($array['documentmarks']/$totaldocmarks) : 0;
        $tscorepercentage = number_format((float) $tscorepercentage, 4) * 100;
        $score = 0;
        if($tscorepercentage > 75){
            $score = ($fscorepercentage * 20+ $tscorepercentage * 80)/100;
            $array['score'] = $score;

            array_push($scoredarray, $array);
        }
    }

    $score_ = array_column($scoredarray, 'score');
    array_multisort($score_, SORT_DESC, $scoredarray);

    return $scoredarray;
}

function getBid()
{
    include 'includes/config.php';

    $tid = $_GET['tender_id'];
    $sid = $_GET['supplier_id'];

    $query = "SELECT t.tendername tendername,t.id tenderid,bd.id bidid, bd.amount,t.minbudget,t.maxbudget, bd.status, bd.duration, s.name suppliername, s.email supplieremail, s.id supplierid, td.doc tenderdocument, tmd.kra_pin, tmd.coi, tmd.cor, tmd.tcc, tmd.c_act, tmd.ctl FROM tender t INNER JOIN bid_details bd ON t.id = bd.tender_id INNER join supplier s ON bd.supplier_id = s.id INNER join tenderdocs td ON bd.tender_id = td.tender_id and bd.supplier_id= td.supplier_id INNER join tendermdocs tmd ON bd.tender_id = tmd.tender_id and bd.supplier_id= tmd.supplier_id where t.id = '$tid' and s.id= $sid";
    $bidsres = $conn->query($query);

    $bid = mysqli_fetch_assoc($bidsres);
    //here

    $bidres = $conn->query("SELECT * FROM bid_details where tender_id = $tid and supplier_id=$sid ") or die($conn->error);
    $bidrow=mysqli_fetch_assoc($bidres);
    $bid['bid'] = $bidrow['id'];

    $requireddocs = $conn->query("SELECT * FROM required_documents where tender_id = $tid");

    $totaldocmarks = 0;

    if(mysqli_num_rows($requireddocs) == 0 ){
        $totaldocmarks = 100;
    }else{
        while($row=mysqli_fetch_assoc($requireddocs)){
            $totaldocmarks+=$row['marks'];
        }
    }
    $bid["totaldocmarks"] = $totaldocmarks;
    $reqdocssize =  mysqli_num_rows($requireddocs);
    if($reqdocssize <= 0 ){
        $bid["documentmarks"] = 100;
    }else{
        $submitteddocs = $conn->query("SELECT * FROM otherdocs where tender_id = $tid and supplier_id=$sid ");
        $submitteddocssize =  mysqli_num_rows($submitteddocs);
        if($submitteddocssize <= 0 ){
            $bid["documentmarks"] = 0;
        }else{
            $marks = 0;
            while($row=mysqli_fetch_assoc($submitteddocs)){
                $n_array =  explode("_",$row['name']);
                $d_name = strtolower(implode(" ",$n_array));

                $marksres = $conn->query("SELECT * FROM required_documents where tender_id = $tid and document = '$d_name'");
                $marksarr = mysqli_fetch_assoc($marksres);

                $marks+=$marksarr['marks'];

                $bid[$row['name']] = $row['document'];
            }
            $bid["documentmarks"] = $marks;
        }
    }
        $fscorepercentage = 0;
        $tscorepercentage = 0;
        
        if($bid['amount']< $bid['minbudget'] || $bid['amount']> $bid['maxbudget']){
            $fscorepercentage = 0;
        }else{
            $fscorepercentage = ($bid['minbudget']/$bid['amount'] + $bid['amount']/$bid['maxbudget'])/2;
            $fscorepercentage = number_format((float) $fscorepercentage, 4) * 100;
        }
        
        $tscorepercentage = $totaldocmarks > 0 ?($bid['documentmarks']/$totaldocmarks) : 0;
        $tscorepercentage = number_format((float) $tscorepercentage, 4) * 100;
        $score = 0;
        if($tscorepercentage > 75){
            $score = ($fscorepercentage * 20+ $tscorepercentage * 80)/100;
            $bid['score'] = $score;
        }
    return $bid;
}












?>