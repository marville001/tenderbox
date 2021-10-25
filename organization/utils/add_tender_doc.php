<?php
    session_start();
    include_once "../includes/config.php";

    $tender_id = mysqli_real_escape_string($conn, $_POST['tender_id']);
    $document = mysqli_real_escape_string($conn, $_POST['document']);
    $marks = mysqli_real_escape_string($conn, $_POST['marks']);

    if(!empty($tender_id) && !empty($document) && !empty($marks)){
        $sql = "INSERT INTO required_documents (tender_id, document, marks) VALUES ($tender_id,'$document',$marks)";
        $queried = mysqli_query($conn, $sql) or die($conn->error);
        if($queried){
            echo "success";
        }
    }else{
        echo "All fields are required";
    }

?>
