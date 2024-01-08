<?php
require_once('includes/dbconnection.php');
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception;
require 'vendor/PHPmailer/PHPmailer/src/Exception.php';
require 'vendor/PHPmailer/PHPmailer/src/PHPMailer.php'; 
require 'vendor/PHPmailer/PHPmailer/src/SMTP.php';

require_once 'vendor/autoload.php';

if (isset($_REQUEST['action'])) {
	$action = $_REQUEST['action'];
	switch ($action) {
		case "signup":
			global $conn;
			$allRows = array();
			$userName = validate($_POST['fullname']);
    		$userEmail = validate($_POST['useremail']);
    		$userPassword = sha1($_REQUEST['userpassword']);
    		$userRole = $_REQUEST['userrole'];
			$getUserRole = "SELECT * FROM nus_users WHERE user_email='".$userEmail."'";
	        $result = $conn->query($getUserRole);
	        if ($result->num_rows > 0) {
	            while($row = $result->fetch_assoc()) {
	                $allRows[] = $row;
	            }
	        }
	        if(count($allRows) > 0){
	        	alert('user already exits');
	        	reload_page();
	        }else{
	        	
	        	$sql = "INSERT INTO nus_users (user_name, user_email, user_password, roleId) VALUES ('".$userName."', '".$userEmail."', '".$userPassword."', '".$userRole."')";
				if ($conn->query($sql) === TRUE) {
				  echo "New record created successfully";
				} 
				$last_id = $conn->insert_id;

				$url 	= 'http://localhost/nus/confirm.php?userid='.$last_id.'&useremail='.$userEmail.'&confirm=1';
				$content ='<div style="border:1px solid grey;">';
				$content ='<p>Hi '.$userName.'</p>';
				$content .='<p>Please Click below Link to confirm:</p>';
				$content .='<p>Your User Email : '.$userEmail.'</p>';
				$content .='<p>Your User password : '.$_REQUEST['userpassword'].'</p>';
				$content .="<p><a href='".$url."' style='background:'>Confirm</a></p>";
				$content .='</div>';
				sendMail($content, $userEmail, 'Confirm Email');
				alert('user Created ');
	        	reload_page();
	        }
		break;
		case "resetpassword":
			global $conn;
			$userEmail = validate($_POST['useremail']);
			if(filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
				$date = 
				$url = 'http://localhost/nus/passwordreset.php?emailId='.$userEmail.'&check='.base64_encode('emailcheck').'&expireAt='.time();
				$content ='<p>Hi</p>';
				$content .='<p>Please Click below Link to reset your password:</p>';
				$content .="<p><a href='".$url."'>Reset Password</a></p>";
				sendMail($content, $userEmail, 'Reset password');
				alert('Reset link has sent your entered email');
	        	reload_page();
			    
			}else{
				alert('Please enter valid password');
			}
			
		break;

		case "confirmResetpassword":
			
			$new_pass 		= $_POST['newpassword'];
			$confirm_pass 	= $_POST['confirmpassword'];
			if($new_pass == $confirm_pass){
				$sql = "UPDATE nus_users SET user_password='".sha1($confirm_pass)."' WHERE userId=".$_GET['userid']."";
				if ($conn->query($sql) === TRUE) {
					$sqls = "UPDATE nus_users SET userStatus=1 WHERE userId=".$_GET['userid']."";
					$conn->query($sqls);
				  	echo '<script type="text/javascript">alert("Your password has been reset sucessfully!!");
				 	window.location.href = "http://localhost/nus/login.php"</script>';

				} 
				

			}else{
				alert("Mismatch password");
	        	reload_page();
			}

		break;

		case "signin":
			$Email = validateEmail($_REQUEST['username']);
			$dummypasswrod = 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3';
			if($Email != 'notvalid'){
				$allRows = array();
				$getUserRole = "SELECT * FROM nus_users WHERE user_email='".$Email."' AND user_password='".sha1($_REQUEST['password'])."' AND userStatus=1";
				
		        $result = $conn->query($getUserRole);
		        if ($result->num_rows > 0) {
		            while($row = $result->fetch_assoc()) {
		                $allRows[] = $row;
		                
		                // $_SESSION['userId'] = $row['userId'];
		            }
		        }
		       
		        
		        if(count($allRows)>0){
		        	$_SESSION['userId'] = $allRows[0]['userId'];
		        	$_SESSION['role'] = $allRows[0]['roleId'];
			        header('Location: index.php?supc=supc');
		        }else{
		        	alert("Please Enter valid credentials");
		        	reload_page();
		        }
		        
		        

			}else{
				alert("Please Enter valid eamil");
		        reload_page();
			}
		break;
		case "addParent":
			$sql = "INSERT INTO nus_parentcompany (parentCompanyName, parentCompanyAddedOn, addedBy) VALUES ('".$_REQUEST['parentName']."', '".date('Y-m-d H:i:s',time())."', '".$_SESSION['userId']."')";
			$conn->query($sql);				 
			alert("Parent Added successfully");
		    reload_page();
		break;
		case "addClient":
			$clientname = validate($_POST['clientname']);
			$sql = "INSERT INTO nus_clients (clientName, parentCompanyId, country, clientAddedOn, clientAddedBy) VALUES ('".$clientname."', '".$_REQUEST['parentId']."', '".$_REQUEST['country']."' ,'".date('Y-m-d H:i:s',time())."', '".$_SESSION['userId']."')";
			$conn->query($sql);				 
			alert("Client Added successfully");
		    reload_page();
		break;
			
 	}

}

function validateEmail($emil){
	$emilaval = false;
	if(filter_var($emil, FILTER_VALIDATE_EMAIL)) {
		$emilaval = true;
	}
	return ($emilaval == true)?$emil:'notvalid';
}
function sendMail($content, $emailAdress,$subject){
	// $mail = new PHPMailer;
	// $mail->SMTPDebug = 0;                      // Enable verbose debug output
 //    $mail->isSMTP();                                            // Send using SMTP
 //    $mail->Host       = 'localhost';                    // Set the SMTP server to send through
 //    $mail->Port       = 1025;                                    // TCP port to connect to
 //    // $mail->Username   = '';                     // SMTP username
 //    // $mail->Password   = '';                               // SMTP password
 //    // $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
 //    // $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted

 //    //Recipients
 //    $mail->setFrom('jobfredcs1992@gmail.com', 'Jobfred');
 //    $mail->addAddress($emailAdress);     // Add a recipient

 //    // Content
 //    $mail->isHTML(true);                                  // Set email format to HTML
 //    $mail->Subject =utf8_decode($subject);;
 //    $mail->Body    = $content;
 //    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

 //    if(!$mail->Send()) {
 //        echo "Mailer Error: " . $mail->ErrorInfo;
 //    } else {
 //        echo "Message sent!";
 //    }
	$mail = new PHPMailer;
	$mail->SMTPDebug = 0;
	$mail->isSMTP(); 
	  // Set mailer to use SMTP
	$mail->Host = "smtp.gmail.com";             // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                 // Enable SMTP authentication
	$mail->Username = 'vkt973012@gmail.com';          // SMTP username
	$mail->Password = "Ganesha@3012"; // SMTP password
	$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 465;                          // TCP port to connect to
	$mail->setFrom('vkt973012@gmail.com', 'Vijaykumar K T');
	$mail->addAddress($emailAdress);   // Add a recipient
	$mail->Subject = utf8_decode($subject);
	$mail->isHTML(true);  // Set email format to HTML
	$mail->Body = $content;
	$mail->send();
	
}

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function reload_page(){
	echo '<script type="text/javascript">window.location = window.location.href.split("#")[0];</script>';
}
function alert($text){
	echo '<script type="text/javascript">alert("'.$text.'");</script>';
}
function leave_apply($applidvalue){
	echo '	<div class="popupwindow" id="popupwindow">
				<div class="centerwindow">
					<h6><i class="fa fa-check" aria-hidden="true"></i></h6>
					<h3 id="insertText"></h3>
					<center><button onclick="closePopup()">OK</button></center>
				</div>
			</div>';
	echo '<script>
				document.getElementById("insertText").innerHTML = "'.$applidvalue.'";
				document.getElementById("popupwindow").style.display = "block";
				function closePopup(){
					window.location = window.location.href.split("#")[0];
				}
		</script>';
}
?>