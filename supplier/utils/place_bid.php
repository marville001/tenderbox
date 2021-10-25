<?php
    session_start();
    include_once "../includes/config.php";
    
    $tender_id = mysqli_real_escape_string($conn, $_POST['tenderid']);
    $supplier_id = mysqli_real_escape_string($conn, $_POST['supplierid']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $duration = mysqli_real_escape_string($conn, $_POST['duration']);
    
    if(
        !empty($amount) && !empty($duration) && !empty($amount) && 
        !empty($duration)
        ){
        $sql = "INSERT INTO bid_details (tender_id, supplier_id, amount, duration) VALUES 
        ('$tender_id','$supplier_id', '$amount', '$duration')";
        $insert_query = mysqli_query($conn, $sql) or die($conn->error);
        if($insert_query){
            echo "success";
        }else{
            echo "Something went wrong. Please try again!";
        } 
    }else{
        echo "All input fields are required!";
    }
?>