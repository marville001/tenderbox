<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
include "../functions.php";
include "../includes/config.php";

$tender_id = $_GET['tender_id'];
$supplier_id = $_GET['supplier_id'];
$supemail = $_GET['supemail'];

$to = $supemail;
$subject = 'Tender Application Approved';
$from = 'martinmwangi1904@outlook.com';
$pass = 'outlook@1904???';

$mail = new PHPMailer(true);

$query1 = "UPDATE `bid_details` SET `status`='approved' WHERE tender_id='$tender_id' and supplier_id=$supplier_id";

$bids_query = "select * from `bid_details` WHERE tender_id='$tender_id' and supplier_id=$supplier_id";

$query2 = "UPDATE `bid_details` SET `status`='rejected' WHERE tender_id='$tender_id' and supplier_id != $supplier_id";

$bids_res = mysqli_query($conn, $bids_query) or die($conn->error);
$row= mysqli_fetch_assoc($bids_res);

$exec1 = mysqli_query($conn, $query1) or die($conn->error);
$exec2 = mysqli_query($conn, $query2) or die($conn->error);

if($exec1 && $exec2){
    try {
        $mail->isSMTP();  //Send using SMTP
        $mail->Host       = 'smtp.outlook.com';//Set the SMTP server to send through
        $mail->SMTPAuth   = true;  //Enable SMTP authentication
        $mail->Username   = $from;
        $mail->Password   = $pass;
        $mail->Port       = 587; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom($from);
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = emailTemplate($row['id']);
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'success';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>