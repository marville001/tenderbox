<?php
    session_start();
    include_once "../includes/config.php";

    $value = $_GET['value'];

    $tenderid = mysqli_real_escape_string($conn, $_POST['tenderid']);
    $supplierid = mysqli_real_escape_string($conn, $_POST['supplierid']);
    $doc = $_FILES[$value];

    if($doc['error'] <=0 ){
        $file_name = $doc['name'];
        $tmp_name = $doc['tmp_name'];
        $file_explode = explode('.',$file_name);
        $file_ext = end($file_explode);

        $extensions = ["pdf", "doc", "docx"];
        if(in_array($file_ext, $extensions) === true){
            $time = time();
            $new_file_name = $time.$file_name;
            if(move_uploaded_file($tmp_name,"../../uploads/".$new_file_name)){
                $sql = "INSERT INTO otherdocs (document, tender_id, supplier_id, name) 
                VALUES ('$new_file_name', $tenderid, $supplierid, '$value')";
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
        echo "The Document Is Required";
    }

?>
