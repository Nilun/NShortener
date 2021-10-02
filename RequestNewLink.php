<?php
	if(isset($_POST["Link"]))
    {
			include 'DataAccess.php';
			
		  $lastID = getLastID();			
		  $data= filter_var($_POST["Link"], FILTER_SANITIZE_STRING);
		  insertNewURL($data ,$lastID );
		  
		  echo $result. "\n";
		
		  echo $data . "<br>" . $mysqli->host_info . "\n" ;

		  header("Location: http://".$_SERVER['SERVER_NAME']."/index.php?result=".dechex($lastID +1 ));
		  
	}
?>