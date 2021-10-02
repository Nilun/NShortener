<html>
	<header>			
		<link rel="stylesheet" href="main.css">
	</header>
	
	<body>
	<?php include 'Navig.php';?>	


<?php
 $serveurBD = "localhost";
			$nomUtilisateur = "Admin";
			$motDePasse = "c344RqtvsgGCA8K";
			$baseDeDonnees = "shortener";
		   
			$mysqli = new mysqli($serveurBD,
						  $nomUtilisateur,
						  $motDePasse,
						  $baseDeDonnees);		  
		  
		  
			if (isset ($_GET["Edit"]))
				{
					
					$result = $mysqli->query("SELECT * FROM lien WHERE ID = ".$_GET["Edit"]) or die(mysqli_error($mysqli));	
					$Value = $result->fetch_assoc();
					echo "<Form Action='Admin.php'  class='centered' Method='POST'> ";
					echo "<input type='TEXT' Value='".array_values($Value)[0]."' Name='IDEdit' readonly='readonly' /> <br>";
					echo "Lien Long : <input type='TEXT' Value= '".array_values($Value)[1]."' Name = 'EditNewLong'/> <br/> ";				
					echo "Lien Court  : <input type='TEXT' Value= '".array_values($Value)[2]."' Name = 'EditNewCourt'/> <br/> ";				
					echo "<input type = 'submit' value ='Valid'>";
					echo "</Form><Br><Br><Br><Br><HR Width = '25%'>";
					
				}				
				
			if (isset ($_POST["EditNewLong"]) && isset ($_POST["EditNewCourt"]) && isset($_POST["IDEdit"]))
				{
					
					$result = $mysqli->query("UPDATE lien
											  SET Lien_Long = '".$_POST["EditNewLong"]."' , Lien_Court='".$_POST["EditNewCourt"]."'
											  WHERE ID = ".$_POST["IDEdit"]) or die(mysqli_error($mysqli));	
					
					
				}
			if (isset ($_GET["DELETE"]))
				{
					$result = $mysqli->query("DELETE FROM lien	WHERE ID = ".$_GET["DELETE"]) or die(mysqli_error($mysqli));	
					$result = $mysqli->query("DELETE FROM stat	WHERE ID = ".$_GET["DELETE"]) or die(mysqli_error($mysqli));
				}
		    $result = $mysqli->query("SELECT * FROM lien ") or die(mysqli_error($mysqli));			
			
			echo "<table class='Centered'>"	;
			
			
			 while ($row = $result -> fetch_row())
				 {				 
					echo ("<tr><td>". $row[0]."</td><td>" .$row[1]."</td><td>".$_SERVER['SERVER_NAME'] ."/r".$row[2]."</td><td><a href='Admin.php?DELETE=".$row[0]."'><img src='cross.png'/></a></td><td><a href='Admin.php?Edit=".$row[0]."'><img src='edit.png'/></a></td><td><a href='Stats.php?T=".$row[0]."'><img src='stats.png'/></a></td></tr>");			
				}
				
				
			echo "</table>";
			$result -> free_result();
?>

</body>
</html>