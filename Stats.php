<html>
	<header>			
		<link rel="stylesheet" href="main.css">
	</header>
	 <script src="script.js"></script>
	<body>
		<?PHP
		 include 'Navig.php';
		echo" <div  class='Centered'>" ;
		  if (isset ($_GET["T"]))
		  {
			  $serveurBD = "localhost";
					$nomUtilisateur = "Admin";
					$motDePasse = "c344RqtvsgGCA8K";
					$baseDeDonnees = "shortener";
				   
					$mysqli = new mysqli($serveurBD,
								  $nomUtilisateur,
								  $motDePasse,
								  $baseDeDonnees);		
			$result = $mysqli->query("SELECT * FROM lien Where ID =".$_GET["T"]) or die(mysqli_error($mysqli));			
					
			echo "<table class='Centered'>"	;
					
					
			$Value = $result->fetch_assoc();					
			$DateCrea = array_values($Value)[3];	
			$LienLong = array_values($Value)[1];
			echo "Lien Long :  <a href ='".$LienLong."' >".array_values($Value)[1]."  </a> <br/> ";				
			echo "Lien Court  : ".$_SERVER['SERVER_NAME'] ."/r".array_values($Value)[2]."  <br/> ";
			echo "Date de Creation :".$DateCrea ."<br>"; 
			
			$result = $mysqli->query("SELECT Count(*) FROM stat Where ID =".$_GET["T"]) or die(mysqli_error($mysqli));							
			$Value = $result->fetch_assoc();					
			$NbClick = array_values($Value)[0];
			
			$result = $mysqli->query("Select MAX(TT) From (SELECT Count(*) AS TT , date FROM stat Where ID =".$_GET["T"]." GROUP BY CAST(Date AS DATE) )AS SUBQUERY  ") or die(mysqli_error($mysqli));							
			$Value = $result->fetch_assoc();					
			$MaxJour = array_values($Value)[0];
			
			$timeDiff = abs(time() - strtotime($DateCrea));
			$numberDays = $timeDiff/86400; // nb second 
			$numberDays = intval($numberDays);
			Echo "Créer depuis : " . $numberDays . " Jours <br/>";
			echo "Nombre Consultation :  ".$NbClick."  <br/> ";	
			echo "Nombre de Consultation Max par Jour : ". $MaxJour . "<br>";		
			if($numberDays>0) {	echo "Nombre de Consultation Moyenne par Jour : "  . ($NbClick /$numberDays) ;}
		
		
			echo " <img id='screenshot' src='Loading.png' />";
						
		  }
		 echo"<script >GetImages('".$LienLong."')</script>";
		 echo" </div>" ;
		?>
		  
	</body>
</HTML>