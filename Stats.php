<html>
	<header>			
		<link rel="stylesheet" href="main.css">
	</header>
	 <script src="script.js"></script>
	<body>
		<?PHP
		 include 'Navig.php';
		 include 'DataAccessLite.php';
		 
		echo" <div  class='Centered'>" ;
		  if (isset ($_GET["T"]))
		  {
			 
			$Value = getLienRaw($_GET["T"]);						
					
			echo "<table class='Centered'>"	;							
								
			$DateCrea = $Value["DateCrea"];	
			$LienLong = $Value["Lien_Long"];
			echo "Lien Long :  <a href ='".$LienLong."' >".$LienLong."  </a> <br/> ";				
			echo "Lien Court  : ".$_SERVER['HTTP_HOST'] ."/r".$Value["Lien_Court"]."  <br/> ";
			echo "Date de Creation :".date("Y-m-d" , $DateCrea )."<br>"; 			
							
			$NbClick = getNbClick($_GET["T"]);
										
			$MaxJour = MaxJour($_GET["T"]) ;
			
			$timeDiff = abs(time() - intval($DateCrea));
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