<html>
	<header>			
		<link rel="stylesheet" href="main.css">
	</header>
	
	<body>
	<?php include 'Navig.php';?>	


<?php
if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="Admin"');
    header('HTTP/1.0 401 Unauthorized');   
    exit;
} else {
    				
			include 'DataAccess.php';
			if (isPasswordCorrect($_SERVER['PHP_AUTH_USER'] ,$_SERVER['PHP_AUTH_PW']))
			{			  
					  
						if (isset ($_GET["Edit"]))
							{							
								
								$Value = getLienRaw($_GET["Edit"]);
								echo "<Form Action='Admin.php'  class='centered' Method='POST'> ";
								echo "<input type='TEXT' Value='".array_values($Value)[0]."' Name='IDEdit' readonly='readonly' /> <br>";
								echo "Lien Long : <input type='TEXT' Value= '".array_values($Value)[1]."' Name = 'EditNewLong'/> <br/> ";				
								echo "Lien Court  : <input type='TEXT' Value= '".array_values($Value)[2]."' Name = 'EditNewCourt'/> <br/> ";				
								echo "<input type = 'submit' value ='Valid'>";
								echo "</Form><Br><Br><Br><Br><HR Width = '25%'>";
								
							}				
							
						if (isset ($_POST["EditNewLong"]) && isset ($_POST["EditNewCourt"]) && isset($_POST["IDEdit"]))
							{
								updateLink	($_POST["IDEdit"],$_POST["EditNewCourt"],$_POST["EditNewLong"]);
							}
						if (isset ($_GET["DELETE"]))
							{
								deleteLink($_GET["DELETE"]);
							}
						$result = getAllLink();		
						
						echo "<table class='Centered'>"	;
						
						
						 while ($row = $result -> fetch_row())
							 {				 
								echo ("<tr><td>". $row[0]."</td><td>" .$row[1]."</td><td>".$_SERVER['SERVER_NAME'] ."/r".$row[2]."</td><td><a href='Admin.php?DELETE=".$row[0]."'><img src='cross.png'/></a></td><td><a href='Admin.php?Edit=".$row[0]."'><img src='edit.png'/></a></td><td><a href='Stats.php?T=".$row[0]."'><img src='stats.png'/></a></td></tr>");			
							}
							
							
						echo "</table>";
						$result -> free_result();
			}
}
?>

</body>
</html>