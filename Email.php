<?php

 include ("./Classe/src/phpmailer.php");
 include ( "./Classe/src/smtp.php");
	use PHPMailer\PHPMailer\PHPMailer;

$mail = new PHPMailer();  // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true;  // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465; 
$mail->Username = "maximin.deschamps@gmail.com";  
$mail->Password = "ange19061991";           
$mail->SetFrom("maximin.deschamps@gmail.Com", "maximin.deschamps@gmail.Com");
$mail->Subject = "Demande de contacte";
$mail->Body = $_POST["MESSAGE"];
$mail->AddAddress("maximin.deschamps@gmail.Com");

if(!$mail->Send()) {
    $error = 'Mail error: '.$mail->ErrorInfo; 
	echo $error;
    return false;
} else {
   header("Location: Info.php?result=OK");
}
	
	//header("Location: Info.php?result=PASOK");


?>