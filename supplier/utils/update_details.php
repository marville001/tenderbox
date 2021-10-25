<?php
    session_start();
    include_once "../includes/config.php";
    
    $tender_id = mysqli_real_escape_string($conn, $_POST['tender_id']);
    $supplier_id = mysqli_real_escape_string($conn, $_POST['supplier_id']);
    $sup_name = mysqli_real_escape_string($conn, $_POST['sup_name']);
    $sup_email = mysqli_real_escape_string($conn, $_POST['sup_email']);
    $sup_contact = mysqli_real_escape_string($conn, $_POST['sup_contact']);
    $sup_location = mysqli_real_escape_string($conn, $_POST['sup_location']);
    $sup_address = mysqli_real_escape_string($conn, $_POST['sup_address']);
    $sup_desc = mysqli_real_escape_string($conn, $_POST['sup_desc']);
    
    if(
        !empty($sup_name) && !empty($sup_email) && !empty($sup_contact) && 
        !empty($sup_location) && !empty($sup_address) && !empty($sup_desc)
        ){
        $sql = "INSERT INTO bid (tender_id, supplier_id, supplier_name, supplier_email, supplier_location, supplier_address, supplier_desc, supplier_contact) VALUES 
        ('$tender_id','$supplier_id', '$sup_name', '$sup_email', '$sup_location', '$sup_address', '$sup_desc', '$sup_contact')";
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