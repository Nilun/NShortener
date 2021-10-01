<html>
	<header>			
		<link rel="stylesheet" href="main.css">
	</header>
	
	<body>
	<?php include 'Navig.php';?>	
	
	<form method="POST" action="RequestNewLink.php">	
		<h3>
		<div>	
		<input type = "text" class="big" value="" name ="Link" /><br>
		</div>
		<div>
		<input type = "submit" class="centered" value =" Raccourci moi">
		</div>
		<?php
			
			if(isset($_GET["result"]))
			{
				 echo "Votre nouvelle mini URL ! : <a href='". $_SERVER['SERVER_NAME'] ."/r".$_GET["result"]."'> " . $_SERVER['SERVER_NAME'] ."/r".$_GET["result"] ."</a>";
			}
			
		?>
		</h3>
	</form>
	</body>
</html>