<?php
    session_start();
    include_once "../includes/config.php";

    $org_id = $_SESSION['org_id'];
    $ran_id = rand(time(), 999999999999999);

    $tendername = mysqli_real_escape_string($conn, $_POST['tendername']);
    $tenderno = mysqli_real_escape_string($conn, $_POST['tenderno']);
    $minBudget = mysqli_real_escape_string($conn, $_POST['minBudget']);
    $maxBudget = mysqli_real_escape_string($conn, $_POST['maxBudget']);
    $tenderperiod = mysqli_real_escape_string($conn, $_POST['tenderperiod']);
    $opendate = mysqli_real_escape_string($conn, $_POST['opendate']);
    $closedate = mysqli_real_escape_string($conn, $_POST['closedate']);
    $enddate = mysqli_real_escape_string($conn, $_POST['enddate']);
    $tenderdoc =  $_FILES['tenderdoc'];
    $sector = mysqli_real_escape_string($conn, $_POST['sector']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    
    if(
        !empty($tendername) && 
        !empty($tenderno) && 
        !empty($minBudget) && 
        !empty($maxBudget)&& 
        !empty($tenderperiod) && 
        !empty($opendate)&& 
        !empty($closedate) && 
        !empty($enddate) && 
        !empty($tenderdoc)&& 
        !empty($sector) && 
        !empty($category)){
        $file_name = $tenderdoc['name'];
        $file_type = $tenderdoc['type'];
        $tmp_name = $tenderdoc['tmp_name'];
        
        $file_explode = explode('.',$file_name);
        $file_ext = end($file_explode);

        $extensions = ["pdf", "doc", "docx"];
        if(in_array($file_ext, $extensions) === true){
            $time = time();
            $new_file_name = $time.$file_name;
            if(move_uploaded_file($tmp_name,"../../uploads/".$new_file_name)){
                $sql = "INSERT INTO tender (org_id, tendername, minbudget, maxbudget, period,description, tenderno, opendate, closedate, tenderdoc, sector, category, enddate) VALUES ('$org_id', '$tendername', '$minBudget', '$maxBudget', '$tenderperiod','$description', '$tenderno', '$opendate', '$closedate','$new_file_name', '$sector','$category','$enddate')";
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
        echo "All input fields are required!";
    }
?>
