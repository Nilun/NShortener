<?php
include 'BDD/DataAccessLite.php';
if(isset($_GET["Target"]))
    {
				
		  $data= filter_var($_GET["Target"], FILTER_SANITIZE_STRING);		  
		  
		  
		  if (substr($_SERVER['REQUEST_URI'], -1) != "+")
		  {			
			
			$Value = getRedirectLink($data);
			$LLong = $Value["Lien_Long"];
			if (str_starts_with($LLong , "http://") || str_starts_with($LLong , "https://") )
				{
					header("Location:".$LLong );
				}else
				{
					header("Location:http://".$LLong );
				}
			
			
		  }else
		  {	  			  
			
				header("Location: Stats.php?T=". getIDFromShort(trim($data)));
				
		  }
	}
	else
	{
		echo 'nope';
	}
