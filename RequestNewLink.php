<?php
	if(isset($_POST["Link"]))
    {
			include 'BDD/DataAccessLite.php';
			
		
			$short = "";
			if(exist($_POST["Link"]) == false)
			{
				$lastID = getLastID();			
				$data= filter_var($_POST["Link"], FILTER_SANITIZE_STRING);
				insertNewURL($data ,$lastID );

			}
			$short = getShortFromLong($_POST["Link"]);
	
		  header("Location: http://".$_SERVER['HTTP_HOST']."/index.php?result=".$_SERVER['HTTP_HOST'] ."/r".$short);
		 
		  
	}
?>