<?php
if(isset($_GET["Target"]))
    {
		 $serveurBD = "localhost";
			$nomUtilisateur = "Admin";
			$motDePasse = "c344RqtvsgGCA8K";
			$baseDeDonnees = "shortener";
		   
			$mysqli = new mysqli($serveurBD,
						  $nomUtilisateur,
						  $motDePasse,
						  $baseDeDonnees);

		
		
		  $data= filter_var($_GET["Target"], FILTER_SANITIZE_STRING);		  
		  $data = mysqli_real_escape_string($mysqli , $data);
		  
		  if (substr($_SERVER['REQUEST_URI'], -1) != "+")
		  {			
		    $result = $mysqli->query("SELECT * FROM lien WHERE Lien_Court='".$_GET["Target"]."'") or die(mysqli_error($mysqli));
			$Value = $result->fetch_assoc();
			
			$mysqli->query("INSERT INTO stat Values(".array_values($Value)[0].",'".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')") or die(mysqli_error($mysqli));
			echo sizeof($Value). "\n";
			header("Location:". array_values($Value)[1]);
		  }else
		  {
			    $result = $mysqli->query("SELECT * FROM lien WHERE Lien_Court='".$_GET["Target"]."'") or die(mysqli_error($mysqli));
				$Value = $result->fetch_assoc();
				header("Location: Stats.php?T=". array_values($Value)[0]);
		  }
	}
	else
	{
		echo 'nope';
	}
?>