<?PHP

	function connection()
	{
		$serveurBD = "localhost";
				$nomUtilisateur = "Admin";
				$motDePasse = "c344RqtvsgGCA8K";
				$baseDeDonnees = "shortener";
			   
				$mysqli = new mysqli($serveurBD,
							  $nomUtilisateur,
							  $motDePasse,
							  $baseDeDonnees);	
				return $mysqli;
	}

	function initBDD()
	{
		
	}

	function getIDFromShort($urlshort)
	{
		$mysqli = connection();
		$result = $mysqli->query("SELECT * FROM lien WHERE Lien_Court='".$urlshort."'") or die(mysqli_error($mysqli));
		$Value = $result->fetch_assoc();
		return array_values($Value)[0];
	}
	
	function getLastID()
	{
			$mysqli = connection();
			$result = $mysqli->query("SELECT MAX(ID) FROM lien ") or die(mysqli_error($mysqli));			
			$Value = $result->fetch_assoc();			
			return array_values($Value)[0];
	}
	
	function insertNewURL($data , $lastID)
	{
		 
		  $mysqli = connection();
		  $data = mysqli_real_escape_string($mysqli , $data);			
		  $result =  $mysqli->query("INSERT INTO lien(Lien_Long ,Lien_Court ) VALUES ('".$data."','". dechex($lastID +1 ) ."')") or die(mysqli_error($mysqli)); 
	}
	function getRedirectLink($data)
	{
			$mysqli = connection();
			$data = mysqli_real_escape_string($mysqli , $data);
		    $result = $mysqli->query("SELECT * FROM lien WHERE Lien_Court='".$data."'") or die(mysqli_error($mysqli));
			$Value = $result->fetch_assoc();			
			$mysqli->query("INSERT INTO stat Values(".array_values($Value)[0].",'".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')") or die(mysqli_error($mysqli));
			return $Value;
	}
	function isPasswordCorrect($user , $passworduser)
	{
			$mysqli = connection();
			$result = $mysqli->query("SELECT Password FROM utilisateur WHERE user = '".$user."'") or die(mysqli_error($mysqli));	
			$Value = $result->fetch_assoc();			
			$Password = array_values($Value)[0];
			return password_verify($passworduser, $Password);
	}
	function deleteLink($ID)
	{
		$mysqli = connection();
		$result = $mysqli->query("DELETE FROM lien	WHERE ID = ".$ID) or die(mysqli_error($mysqli));	
		$result = $mysqli->query("DELETE FROM stat	WHERE ID = ".$ID) or die(mysqli_error($mysqli));
	}
	function updateLink($ID,$court,$long)
	{
		$mysqli = connection();
		$result = $mysqli->query("UPDATE lien
									  SET Lien_Long = '".$long."' , Lien_Court='".$court."'
									  WHERE ID = ".$ID) or die(mysqli_error($mysqli));	
	}
	function  getAllLink()
	{
			$mysqli = connection();
		$result =  $mysqli->query("SELECT * FROM lien ") or die(mysqli_error($mysqli));
		return $result;
	}
	function getLienRaw($ID)
	{
		$mysqli = connection();
		$result = $mysqli->query("SELECT * FROM lien WHERE ID = ".$ID) or die(mysqli_error($mysqli));	
		$Value = $result->fetch_assoc();
		return $Value;
	}
	function getNbClick($ID)
	{
		$mysqli = connection();
		$result = $mysqli->query("SELECT Count(*) FROM stat Where ID =".$ID) or die(mysqli_error($mysqli));							
		$Value = $result->fetch_assoc();	
		return  array_values($Value)[0];
	}
	function MaxJour($ID)
	{
		$mysqli = connection();
		$result = $mysqli->query("Select MAX(TT) From (SELECT Count(*) AS TT , date FROM stat Where ID =".$ID." GROUP BY CAST(Date AS DATE) )AS SUBQUERY  ") or die(mysqli_error($mysqli));							
			$Value = $result->fetch_assoc();					
			return array_values($Value)[0];
	}
?>
