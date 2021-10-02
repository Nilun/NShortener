<?php
function GetConfig()
{
	$Config = 
	array( "User" => "test",
      "Password" => "test",
	  "MailUser" => "Your mail",
      "MailPassword" => "",
	  "MailFrom" => "sender@exemple.com",
      "MailTo" => "your mail box@exemple.com",
	  "MailPort"=> 465,
	  "MailHost"=> "smtp.gmail.com",
	  
	);
	return $Config;
}
?>