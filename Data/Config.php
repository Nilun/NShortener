<?php
function GetConfig()
{
	$Config = 
	array( "User" => "test", // Default Admin User
      "Password" => "test", // Default Admin Password
	  "MailUser" => "Your mail", // SMTP Mail User
      "MailPassword" => "", // SMTP Mail Password
	  "MailFrom" => "sender@exemple.com", // Sender Email Adress
      "MailTo" => "your mail box@exemple.com",// The Email Adress you want to receive the mail
	  "MailPort"=> 465,// SMTP server port
	  "MailHost"=> "smtp.gmail.com",// SMTP server
	  
	);
	return $Config;
}
?>