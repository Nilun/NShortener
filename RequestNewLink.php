<?php
	if(isset($_POST["Link"]))
    {
			include 'DataAccessLite.php';
			
		  $lastID = getLastID();			
		  $data= filter_var($_POST["Link"], FILTER_SANITIZE_STRING);
		  insertNewURL($data ,$lastID );
		  header("Location: http://".$_SERVER['HTTP_HOST']."/index.php?result=".dechex($lastID +1 ));
		  
	}
?>