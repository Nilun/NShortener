<html>
	<header>			
		<link rel="stylesheet" href=".\Style\main.css">
	</header>
	
	<body>
		
	<?php include 'Navig.php';?>	
	
	
	<p class="recenter">
	Ce service permet de transformer n'importe quel URL en un version plus compacte et facile à partager !<br>
	Comment proceder ? Rien de plus simple ! <br>
	Copiez - Collez votre URL dans la barre de saisie ci-dessous et profitez !<br><br>
	</p>
	
	<form method="POST" action="RequestNewLink.php">	
		<h3>
			
		<input type = "text" class="big" value="" name ="Link" /><br><br><br>
		
		<input type = "submit" class="centered" value =" Raccourci-moi">
		
		<?php
			
			if(isset($_GET["result"]))
			{
				 echo  "<p class='recenter'> Votre nouvelle mini URL ! : <a href='http://".$_GET["result"]."'> " . $_GET["result"] ."</a> </p>";
			}
			
		?>
		</h3>
	</form>
	</body>
</html>