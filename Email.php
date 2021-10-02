<?php

 include ("./Classe/src/phpmailer.php");
 include ( "./Classe/src/smtp.php");
 include ( "Config.php");
	use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();  // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true;  // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = GetConfig()["MailHost"];  
$mail->Port = GetConfig()["MailPort"];   
$mail->Username = GetConfig()["MailUser"];  
$mail->Password = GetConfig()["MailPassword"];         
$mail->SetFrom(GetConfig()["MailFrom"], GetConfig()["MailFrom"]);
$mail->Subject = "Demande de contact";
$mail->Body = $_POST["MESSAGE"];
$mail->AddAddress(GetConfig()["MailTo"]);

if(!$mail->Send()) {
    $error = 'Mail error: '.$mail->ErrorInfo; 
	echo $error;
    return false;
} else {
   header("Location: Info.php?result=OK");
}
	
	//header("Location: Info.php?result=PASOK");


?>