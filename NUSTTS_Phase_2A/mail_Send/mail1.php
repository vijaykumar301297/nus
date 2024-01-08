<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
    require 'includes/PHPMailer.php';
    require 'includes/SMTP.php';
    require 'includes/Exception.php';

//Load Composer's autoloader
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$emailid = "balaji.s@qualesce.com";

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


$mail->isSMTP();
$mail->isHTML(True);

echo "<pre>";

$mail->Host = "smtp.office365.com";
$mail->SMTPAuth = "true";
$mail->SMTPSecure = "STARTSSL";
$mail->Port = "587";
$mail->Username = "invite@nustradetrack.com";
$mail->Password = "drskjhdwpnlbvxvf";
$mail->Subject = "NUS user Created";
$mail->setFrom("invite@nustradetrack.com", 'NUS');
$mail->Body = 'Hi, Checking';
$mail->addAddress($emailid);
$mail->addBCC('tradetrack@nusconsulting.com');

    if($mail->send()) {
        echo 'Message has been sent';
    } else {
        echo 'Message has not been sent';
    }

$mail->smtpClose();
    
?>