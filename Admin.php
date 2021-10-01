<html>
	<header>			
		<link rel="stylesheet" href="main.css">
	</header>
	
	<body>
	<?php include 'Navig.php';?>	

<table class="Centered">
<?php
 $serveurBD = "localhost";
			$nomUtilisateur = "Admin";
			$motDePasse = "c344RqtvsgGCA8K";
			$baseDeDonnees = "shortener";
		   
			$mysqli = new mysqli($serveurBD,
						  $nomUtilisateur,
						  $motDePasse,
						  $baseDeDonnees);		  
		  
		  
		    $result = $mysqli->query("SELECT * FROM lien ") or die(mysqli_error($mysqli));			
			
			 while ($row = $result -> fetch_row())
				 {				 
					echo ("<tr><td>". $row[0]."</td><td>" .$row[1]."</td><td>".$_SERVER['SERVER_NAME'] ."/r".$row[2]."</td><td><a href='Delete.php?T=".$row[0]."'><img src='cross.png'/></a></td><td><a href='Edit.php?T=".$row[0]."'><img src='edit.png'/></a></td><td><a href='Stats.php?T=".$row[0]."'><img src='stats.png'/></a></td></tr>");			
				}
				
			$result -> free_result();
?>
</table>
</body>
</html>