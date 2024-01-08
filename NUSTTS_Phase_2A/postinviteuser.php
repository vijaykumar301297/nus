<?php

include "dbconn.php";

$username = $_POST["username"];
$emailid = $_POST["emailId"];
$role = $_POST["role"];
if (empty($_POST["parentcompany"])) {
    $r = '';
    $a = '';
} else {
    $r = $_POST["parentcompany"];
    $a = '';
    if($role == 'NUS User') {
        $r = $_POST["parentcompany"];
        $parent = '';
        foreach ($r as $p) {
            $parent .= "$p ";
        }
        $a  = $parent;
    }
   
}
// print_r($r);


if (empty($_POST["bussinessunit"])) {
    $e = '';
} else {
    $e = $_POST["bussinessunit"];
}
// $password = $_POST["password"];
$password = 'zw2UaeT$$b?7~zV;';
// $hash = password_hash($password, PASSWORD_DEFAULT);

$hash = password_hash($password, PASSWORD_ARGON2I);

$sqlOneQuery = "SELECT * FROM nususerdata WHERE emailId = '$emailid' OR username = '$username';";
$resOneQuery = mysqli_query($conn, $sqlOneQuery);
$rowCount = mysqli_num_rows($resOneQuery);




if ($rowCount === 1) {
    echo "<script>;
            alert('User already exists!'); 
            window.location='table.php';
        </script>";
} else if ($r == '' && $e == '') {
    $sql = "INSERT INTO nususerdata(username, emailId, role, accountstatus, parentcompany, password, bussinessunit)
            VALUES('$username', '$emailid', '$role', 'Invited','', '$hash', '')";
} else if (($a != '') && ($e == '')) {
    $sql = "INSERT INTO nususerdata(username, emailId, role, accountstatus, parentcompany, password, bussinessunit)
VALUES('$username', '$emailid', '$role', 'Invited','$a', '$hash', '')";
} else if ($e == '') {
    $sql = "INSERT INTO nususerdata(username, emailId, role, accountstatus, parentcompany, password, bussinessunit)
            VALUES('$username', '$emailid', '$role', 'Invited','$r', '$hash', '')";
} else {
    $sqlValues = '';
    foreach ($e as $bu) {
        $sqlValues .= "$bu ";
    }
    $multiselect = $sqlValues;





    // echo $multiselect;


    $sql = "INSERT INTO nususerdata(username, emailId, role, accountstatus, parentcompany, password, bussinessunit)
VALUES('$username', '$emailid', '$role', 'Invited','$r', '$hash', '$multiselect')";
}

$encodedUser = base64_encode($username);
$resVar = base64_encode("no");
$finalUserres = "?id=" . $encodedUser . "&reset=" . $resVar;

$query = mysqli_query($conn, $sql);
// echo $role;
// echo $sql;



require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();

$mail->isSMTP();
$mail->isHTML(True);

$mail->Host = "smtp.office365.com";
$mail->SMTPAuth = "true";
$mail->SMTPSecure = "STARTTLS";
$mail->Port = "587";
// $mail->Username = "balaji.s@qualesce.com";
// $mail->Password = "nycfddwjmmsbghnb";
// $mail->Subject = "NUS TTS User Created";
// $mail->setFrom("balaji.s@qualesce.com", 'NUS');
$mail->Username = "invite@nustradetrack.com";
$mail->Password = "drskjhdwpnlbvxvf";
$mail->Subject = "NUS TTS User Created";
$mail->setFrom("invite@nustradetrack.com", 'NUS');
$mail->addBCC("tradetrack@nusconsulting.com");
$mail->Body = '
     <html xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"
 xmlns:w="urn:schemas-microsoft-com:office:word" xmlns:m="http://schemas.microsoft.com/office/2004/12/omml"
 xmlns="http://www.w3.org/TR/REC-html40">

<head>

 <meta name="Generator" content="Microsoft Word 15 (filtered medium)">
 <!--[if !mso]><style>v\:* {behavior:url(#default#VML);}
 o\:* {behavior:url(#default#VML);}
 w\:* {behavior:url(#default#VML);}
 .shape {behavior:url(#default#VML);}
 </style><![endif]-->
 <title>Email Checking</title>
 <style>
     <!--
     /* Font Definitions */
     @font-face {
         font-family: "Cambria Math";
         panose-1: 2 4 5 3 5 4 6 3 2 4;
     }

     @font-face {
         font-family: Calibri;
         panose-1: 2 15 5 2 2 2 4 3 2 4;
     }

     @font-face {
         font-family: "Segoe UI";
         panose-1: 2 11 5 2 4 2 4 2 2 3;
     }

     @font-face {
         font-family: "Segoe UI Semibold";
         panose-1: 2 11 7 2 4 2 4 2 2 3;
     }

     /* Style Definitions */
     p.MsoNormal,
     li.MsoNormal,
     div.MsoNormal {
         margin: 0in;
         font-size: 11.0pt;
         font-family: "Calibri", sans-serif;
     }

     h1 {
         mso-style-priority: 9;
         mso-style-link: "Heading 1 Char";
         mso-margin-top-alt: auto;
         margin-right: 0in;
         mso-margin-bottom-alt: auto;
         margin-left: 0in;
         font-size: 24.0pt;
         font-family: "Calibri", sans-serif;
         font-weight: bold;
     }

     a:link,
     span.MsoHyperlink {
         mso-style-priority: 99;
         color: blue;
         text-decoration: underline;
     }

     span.Heading1Char {
         mso-style-name: "Heading 1 Char";
         mso-style-priority: 9;
         mso-style-link: "Heading 1";
         font-family: "Calibri Light", sans-serif;
         color: #2F5496;
     }

     span.apple-link {
         mso-style-name: apple-link;
     }

     span.EmailStyle21 {
         mso-style-type: personal-reply;
         font-family: "Segoe UI", sans-serif;
         color: windowtext;
     }

     .MsoChpDefault {
         mso-style-type: export-only;
         font-size: 10.0pt;
     }

     @page WordSection1 {
         size: 8.5in 11.0in;
         margin: 1.0in 1.0in 1.0in 1.0in;
     }

     div.WordSection1 {
         page: WordSection1;
     }
     -->
 </style>
 <!--[if gte mso 9]><xml>
 <o:shapedefaults v:ext="edit" spidmax="1026" />
 </xml><![endif]-->
 <!--[if gte mso 9]><xml>
 <o:shapelayout v:ext="edit">
 <o:idmap v:ext="edit" data="1" />
 </o:shapelayout></xml><![endif]-->
</head>

<body bgcolor="#F8F8F8" lang="EN-US" link="blue" vlink="purple" style="word-wrap:break-word">
 <table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0" width="100%"
     style="width:100.0%;background:#F8F8F8">
     <tbody>
         <tr>
             <td valign="top" style="padding:0in 0in 0in 0in">
                 <p class="MsoNormal"><span
                         style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;color:black">&nbsp;</span><span
                         style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif">
                         <o:p></o:p>
                     </span></p>
             </td>
             <td width="580" valign="top"
                 style="width:435.0pt;padding:7.5pt 7.5pt 7.5pt 7.5pt;box-sizing:border-box">
                 <div>
                     <table class="MsoNormalTable" border="0" cellspacing="5" cellpadding="0" width="100%"
                         style="width:100.0%;background:white">
                         <tbody>
                             <tr>
                                 <td valign="top" style="padding:15.0pt 15.0pt 15.0pt 15.0pt">
                                     <table class="MsoNormalTable" border="0" cellspacing="0" cellpadding="0"
                                         width="100%" style="width:100.0%">
                                         <tbody>
                                             <tr>
                                                 <td valign="top" style="padding:0in 0in 0in 0in">
                                                     <table class="MsoNormalTable" border="0" cellspacing="0"
                                                         cellpadding="0" width="100%" style="width:100.0%">
                                                         <tbody>
                                                             <tr>
                                                                 <td valign="top" style="padding:0in 0in 0in 0in">
                                                                     <table class="MsoNormalTable" border="0"
                                                                         cellspacing="0" cellpadding="0" width="100%"
                                                                         style="width:100.0%">
                                                                         <tbody>
                                                                             <tr>
                                                                                 <td valign="top"
                                                                                     style="padding: 0in;">
                                                                                     <p align="center"
                                                                                         style="mso-margin-top-alt:0in;margin-right:0in;margin-bottom:-1in;margin-left:0in;margin-top:0in;text-align:center">
                                                                                         <span
                                                                                             style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif">
                                                                                             <img border="0"
                                                                                                 width="250"
                                                                                                 height="32"
                                                                                                 style="width:2.6666in;height:2.6666in"
                                                                                                 id="_x0000_i1025"
                                                                                                 src="https://nustradetrack.com/img/nus-logo-full@svg.svg"
                                                                                                 alt="NUS Consulting Group Logo"></span><span
                                                                                             style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif">
                                                                                             <o:p></o:p>
                                                                                         </span>
                                                                                     </p>
                                                                                 </td>
                                                                             </tr>
                                                                         </tbody>
                                                                     </table>
                                                                 </td>
                                                             </tr>
                                                         </tbody>
                                                     </table>
                                                     <h1 align="center"
                                                         style="mso-margin-top-alt:0in;margin-right:0in;margin-bottom:22.5pt;margin-left:0in;text-align:center">
                                                         <span
                                                             style="font-size:26.5pt;font-family:&quot;Arial&quot;,sans-serif;color:black;font-weight:normal">Confirm
                                                             your e-mail<o:p></o:p></span>
                                                     </h1>
                                                     <p
                                                         style="mso-margin-top-alt:0in;margin-right:0in;margin-bottom:21.5pt;margin-left:0in">
                                                         <span
                                                             style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif">
                                                             <span>Hello <b>' . $username . '</b>,</span><br><br>
                                                             You
                                                             have been set up a new user of NUS Consulting
                                                             Group&#39;s TTS System. Please click the button below to
                                                             confirm your e-mail address and complete the creation of
                                                             your account.
                                                             <o:p></o:p>
                                                         </span>
                                                     </p>
                                                     <table class="MsoNormalTable" border="0" cellspacing="0"
                                                         cellpadding="0" width="100%"
                                                         style="width:100.0%;box-sizing:border-box; padding: 0 0 0 35%;">
                                                         <tbody>
                                                             <tr>
                                                                 <td valign="top"
                                                                     style="padding:0in 0in 11.25pt 0in;border-radius:5px">
                                                                     <table class="MsoNormalTable" border="0"
                                                                         cellspacing="0" cellpadding="0" width="0"
                                                                         style="border-radius:5px">
                                                                         <tbody>
                                                                             <tr>
                                                                                 <td valign="top"
                                                                                     style="background:#345da6;padding:0in 0in 0in 0in;border-radius:5px;box-sizing:border-box;cursor:pointer;display:inline-block;text-transform:capitalize">
                                                                                     <p class="MsoNormal"
                                                                                         align="center"
                                                                                         style="text-align:center">
                                                                                         <span
                                                                                             style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;color:black"><a
                                                                                                 href="https://www.nustradetrack.com/confirmlogin.php' . $finalUserres . '"
                                                                                                 target="_blank"
                                                                                                 style="text-decoration: none;"><b><span
                                                                                                         style="color:white;border:solid #345da6 1.0pt;padding:11.0pt;background:#345da6;">Confirm
                                                                                                         email</span></b></a>
                                                                                         </span><span
                                                                                             style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif">
                                                                                             <o:p></o:p>
                                                                                         </span></p>
                                                                                 </td>
                                                                             </tr>
                                                                         </tbody>
                                                                     </table>
                                                                 </td>
                                                             </tr>
                                                         </tbody>
                                                     </table>
                                                     <p
                                                         style="mso-margin-top-alt:0in;margin-right:0in;margin-bottom:13.5pt;margin-left:0in">
                                                         <span
                                                             style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif">This
                                                             link will <b>expire in 7 days</b>. Once your e-mail
                                                             address has been confirmed you will be sent your
                                                             password via a separate e-mail to access the TTS system.
                                                             <o:p></o:p></span>
                                                     </p>
                                                     <p
                                                         style="mso-margin-top-alt:0in;margin-right:0in;margin-bottom:13.5pt;margin-left:0in;margin-top: 0in; background: #F8F8F8; padding: 0.2in 0 0.2in 0;text-align: center;">
                                                         <span
                                                             style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif"><span style="font-size: 16pt; display: block;">NUS Consulting Group </span><br><span style="display: block; padding: 0 0 -5pt 0;">This is an automatically generated e-mail for NUS Consulting Group&#39;s </span><br><span style="display: block; padding: 0 0 -5pt 0;">TTS web application</span><o:p></o:p></span>
                                                     </p>
                                                 </td>
                                             </tr>
                                         </tbody>
                                     </table>
                                 </td>
                             </tr>
                         </tbody>
                     </table>
                 </div>
             </td>
             <td valign="top" style="padding:0in 0in 0in 0in">
                     <p class="MsoNormal"><span
                             style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif;color:black">&nbsp;</span><span
                             style="font-size:12.0pt;font-family:&quot;Arial&quot;,sans-serif">
                             <o:p></o:p>
                         </span></p>
                 </td>
         </tr>
     </tbody>
 </table>
</body>
</html>
     
 ';


$mail->addAddress($emailid);

if ($mail->Send()) {
    //  echo "Email Sent!";

    echo "<script>;
            alert(' Mail Sent succesfully!'); 
            window.location = 'table.php';
        </script>";
    // header('location:table.php');
} else {
    echo "<script>;
            alert(' Mail Not Sent!'); 
            window.location = 'table.php';
        </script>";
}

$mail->smtpClose();
