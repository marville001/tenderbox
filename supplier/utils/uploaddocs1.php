<?php
    session_start();
    include_once "../includes/config.php";

    $tenderid = mysqli_real_escape_string($conn, $_POST['tenderid']);
    $supplierid = mysqli_real_escape_string($conn, $_POST['supplierid']);
    $kra_pin = $_FILES['kra_pin'];
    $coi = $_FILES['coi'];
    $cor = $_FILES['cor'];
    $tcc = $_FILES['tcc'];
    $c_act = $_FILES['c_act'];
    $ctl = $_FILES['ctl'];

    if( 
        $kra_pin['error'] <=0 &&
        $coi['error'] <=0 &&
        $cor['error'] <=0 &&
        $tcc['error'] <=0 &&
        $c_act['error'] <=0 &&
        $ctl['error'] <=0 
    ){
        $kra_pin_file_name = $kra_pin['name'];
        $coi_file_name = $coi['name'];
        $cor_file_name = $cor['name'];
        $tcc_file_name = $tcc['name'];
        $c_act_file_name = $c_act['name'];
        $ctl_file_name = $ctl['name'];

        $kra_pin_tmp_name = $kra_pin['tmp_name'];
        $coi_tmp_name = $coi['tmp_name'];
        $cor_tmp_name = $cor['tmp_name'];
        $tcc_tmp_name = $tcc['tmp_name'];
        $c_act_tmp_name = $c_act['tmp_name'];
        $ctl_tmp_name = $ctl['tmp_name'];

        $kra_pin_file_explode = explode('.',$kra_pin_file_name);
        $coi_file_explode = explode('.',$coi_file_name);
        $cor_file_explode = explode('.',$cor_file_name);
        $tcc_file_explode = explode('.',$tcc_file_name);
        $c_act_file_explode = explode('.',$c_act_file_name);
        $ctl_file_explode = explode('.',$ctl_file_name);

        $kra_pin_file_ext = end($kra_pin_file_explode);
        $coi_file_ext = end($coi_file_explode);
        $cor_file_ext = end($cor_file_explode);
        $tcc_file_ext = end($tcc_file_explode);
        $c_act_file_ext = end($c_act_file_explode);
        $ctl_file_ext = end($ctl_file_explode);

        $extensions = ["pdf", "doc", "docx"];
        if(
            in_array($kra_pin_file_ext, $extensions) === true &&
            in_array($coi_file_ext, $extensions) === true &&
            in_array($cor_file_ext, $extensions) === true &&
            in_array($tcc_file_ext, $extensions) === true &&
            in_array($c_act_file_ext, $extensions) === true &&
            in_array($ctl_file_ext, $extensions) === true
        ){
            $time = time();
            $kra_pin_new_file_name = $time.$kra_pin_file_name;
            $coi_new_file_name = $time.$coi_file_name;
            $cor_new_file_name = $time.$cor_file_name;
            $tcc_new_file_name = $time.$tcc_file_name;
            $c_act_new_file_name = $time.$c_act_file_name;
            $ctl_new_file_name = $time.$ctl_file_name;
            if(
                move_uploaded_file($tcc_tmp_name, "../../uploads/".$tcc_new_file_name)&&
                move_uploaded_file($c_act_tmp_name, "../../uploads/".$c_act_new_file_name) &&
                move_uploaded_file($ctl_tmp_name, "../../uploads/".$ctl_new_file_name)&&
                move_uploaded_file($kra_pin_tmp_name, "../../uploads/".$kra_pin_new_file_name) &&
                move_uploaded_file($coi_tmp_name, "../../uploads/".$coi_new_file_name) &&
                move_uploaded_file($cor_tmp_name, "../../uploads/".$cor_new_file_name)
            ){
                $sql = "INSERT INTO tendermdocs 
                (kra_pin, coi, cor, tcc, c_act, ctl, tender_id, supplier_id) 
                VALUES ('$kra_pin_new_file_name','$coi_new_file_name', '$cor_new_file_name', '$tcc_new_file_name', '$c_act_new_file_name', '$ctl_new_file_name', $tenderid, $supplierid)";
                $insert_query = mysqli_query($conn, $sql) or die($conn->error);
                if($insert_query){
                    echo "success";
                }else{
                    echo "Something went wrong. Please try again!";
                }
            }else{
                echo "Could not upload documents. Please try again later";
            }
        }else{
            echo "Please ensure all documents are of type - pdf or doc or docx";
        }
    }else{
        echo "All Documents are Required";
    }

?>
