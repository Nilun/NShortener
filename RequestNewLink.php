<?php
	if(isset($_POST["Link"]))
    {
		
		  $serveurBD = "localhost";
			$nomUtilisateur = "Admin";
			$motDePasse = "c344RqtvsgGCA8K";
			$baseDeDonnees = "shortener";
		   
			$mysqli = new mysqli($serveurBD,
						  $nomUtilisateur,
						  $motDePasse,
						  $baseDeDonnees);

		
		
		  $data= filter_var($_POST["Link"], FILTER_SANITIZE_STRING);
		  $data = mysqli_real_escape_string($mysqli , $data);
		  
		  
		  
		    $result = $mysqli->query("SELECT MAX(ID) FROM lien ") or die(mysqli_error($mysqli));
			
			
			
			$Value = $result->fetch_assoc();
			echo sizeof($Value). "\n";
			$lastID = array_values($Value)[0];
			
		  echo $lastID. "\n";
		  $result =  $mysqli->query("INSERT INTO lien(Lien_Long ,Lien_Court ) VALUES ('".$data."','". dechex($lastID +1 ) ."')") or die(mysqli_error($mysqli)); 
		  
		  echo $result. "\n";
		
		  echo $data . "<br>" . $mysqli->host_info . "\n" ;
		  header("Location: http://".$_SERVER['SERVER_NAME']."/index.php?result=".dechex($lastID +1 ));
		  
	}
?>