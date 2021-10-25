<?php
    session_start();
    include_once "../includes/config.php";
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    if(!empty($email) && !empty($password)){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = mysqli_query($conn, "SELECT * FROM organisation WHERE email = '{$email}'");
            if(mysqli_num_rows($sql) < 1){
                echo "Account does not exist!";
            }else{
                $result = mysqli_fetch_assoc($sql);

                $enc_pass = md5($password);

                if($enc_pass == $result['password']){
                    $id =  $result['id'];
                    $_SESSION['org_id'] = $id;
                    echo "success";
                }else{
                    echo "Invalid credentials";
                }
            }
        }else{
            echo "$email is not a valid email!";
        }
    }else{
        echo "All input fields are required!";
    }
?>