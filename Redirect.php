<?php
include 'DataAccess.php';
if(isset($_GET["Target"]))
    {
				
		  $data= filter_var($_GET["Target"], FILTER_SANITIZE_STRING);		  
		  
		  
		  if (substr($_SERVER['REQUEST_URI'], -1) != "+")
		  {			
			
			$Value = getRedirectLink($data);
			header("Location:". array_values($Value)[1]);
		  }else
		  {	  			  
			  
				header("Location: Stats.php?T=". getIDFromShort($data));
				
		  }
	}
	else
	{
		echo 'nope';
	}
?>