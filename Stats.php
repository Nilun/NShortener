<html>
	<header>			
		<link rel="stylesheet" href="main.css">
	</header>
	 <script src="script.js"></script>
	<body>
		<?PHP
		 include 'Navig.php';
		 include 'DataAccess.php';
		 
		echo" <div  class='Centered'>" ;
		  if (isset ($_GET["T"]))
		  {
			 
			$Value = getLienRaw($_GET["T"]);						
					
			echo "<table class='Centered'>"	;							
								
			$DateCrea = array_values($Value)[3];	
			$LienLong = array_values($Value)[1];
			echo "Lien Long :  <a href ='".$LienLong."' >".array_values($Value)[1]."  </a> <br/> ";				
			echo "Lien Court  : ".$_SERVER['SERVER_NAME'] ."/r".array_values($Value)[2]."  <br/> ";
			echo "Date de Creation :".$DateCrea ."<br>"; 			
							
			$NbClick = getNbClick($_GET["T"]);
										
			$MaxJour = MaxJour($_GET["T"]) ;
			
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