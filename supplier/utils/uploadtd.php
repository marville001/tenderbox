<?php
    session_start();
    include_once "../includes/config.php";

    $tenderid = mysqli_real_escape_string($conn, $_POST['tenderid']);
    $supplierid = mysqli_real_escape_string($conn, $_POST['supplierid']);
    $tenderdoc = $_FILES['tenderdocument'];

    if($tenderdoc['error'] <=0 ){
        $file_name = $tenderdoc['name'];
        $tmp_name = $tenderdoc['tmp_name'];
        $file_explode = explode('.',$file_name);
        $file_ext = end($file_explode);

        $extensions = ["pdf", "doc", "docx"];
        if(in_array($file_ext, $extensions) === true){
            $time = time();
            $new_file_name = $time.$file_name;
            if(move_uploaded_file($tmp_name,"../../uploads/".$new_file_name)){
                $sql = "INSERT INTO tenderdocs (doc, tender_id, supplier_id) 
                VALUES ('$new_file_name', $tenderid, $supplierid)";
                $insert_query = mysqli_query($conn, $sql) or die($conn->error);
                if($insert_query){
                    echo "success";
                }else{
                    echo "Something went wrong. Please try again!";
                }
            }else{
                echo "Could not upload document. Please try again later";
            }
        }else{
            echo "Please upload a document file - pdf, doc, docx";
        }
    }else{
        echo "The Tender Document Is Required";
    }

?>
