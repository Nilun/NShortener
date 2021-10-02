<?PHP
	include ("Config.php");
	class MyDB extends SQLite3
		{
			function __construct()
			{
				try
				{
					$this->open('shortener.db',SQLITE3_OPEN_READWRITE);
				
				}catch(exception $e)
				{
					$this->open('shortener.db');
					initBDD($this);
				
				}				
			}
		}
		
	function connection()
	{
		
		// Connexion
		
			$mysqli = new MyDB();
		return $mysqli;
	
	}
	
	function Deconnection()
	{
		$mysqli = null;
	}

	function initBDD($mysqli)
	{
						
		// echo	$mysqli->query("			
			// CREATE DATABASE IF NOT EXISTS `shortener` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
					// ");

			$mysqli->query("
					CREATE TABLE `lien` (
					  `ID` int(11) NOT NULL,
					  `Lien_Long` text NOT NULL,
					  `Lien_Court` text NOT NULL,
					  `DateCrea` text NOT NULL 
					) ");

			 $mysqli->query("
			CREATE TABLE `stat` (
			  `ID` int(11) NOT NULL,
			  `Date` text NOT NULL,
			  `IP` text NOT NULL
			)");

			
			 $mysqli->query("
			CREATE TABLE `utilisateur` (
			  `ID` int(11) NOT NULL,
			  `User` text NOT NULL,
			  `Password` text NOT NULL
			) ");
			
			 $mysqli->query("
			INSERT INTO `utilisateur` VALUES (	1,
									  '".GetConfig()["User"]."',
									  '".password_hash(GetConfig()["Password"] , PASSWORD_BCRYPT  )."'
									  ) ");
			 

			

	}

	function getIDFromShort($urlshort)
	{
		$mysqli = connection();
		$result = $mysqli->query("SELECT * FROM lien WHERE Lien_Court='".$urlshort."'") ;
		$Value = $result->fetchArray();
		return ($Value)[0];
	}
	
	function getLastID()
	{
			$mysqli = connection();
			$result = $mysqli->query("SELECT MAX(ID) FROM lien ") ;			
			$Value = $result->fetchArray();			
			return ($Value)[0];
	}
	
	function insertNewURL($data , $lastID)
	{
		 
		  $mysqli = connection();			
		  $result =  $mysqli->query("INSERT INTO lien(ID,Lien_Long ,Lien_Court,DateCrea ) VALUES ($lastID +1, '".$data."','". dechex($lastID +1 ) ."',".time().")") ; 
	}
	function getRedirectLink($data)
	{
			$mysqli = connection();			
		    $result = $mysqli->query("SELECT * FROM lien WHERE Lien_Court='".$data."'") ;
			$Value = $result->fetchArray();	
			$mysqli->query("INSERT INTO stat Values(".($Value)[0].",'".date("Y-m-d H:i:s")."','".$_SERVER['REMOTE_ADDR']."')") ;
			return $Value;
	}
	function isPasswordCorrect($user , $passworduser)
	{
			$mysqli = connection();
			$result = $mysqli->query("SELECT Password FROM utilisateur WHERE user = '".$user."'") ;				
			$Value = $result->fetchArray();		
			if($Value == false)
			{
				return false;
			}
			$Password = $Value[0];
			return password_verify($passworduser, $Password);
	}
	function deleteLink($ID)
	{
		$mysqli = connection();
		$result = $mysqli->query("DELETE FROM lien	WHERE ID = ".$ID) ;	
		$result = $mysqli->query("DELETE FROM stat	WHERE ID = ".$ID) ;
	}
	function updateLink($ID,$court,$long)
	{
		$mysqli = connection();
		$result = $mysqli->query("UPDATE lien
									  SET Lien_Long = '".$long."' , Lien_Court='".$court."'
									  WHERE ID = ".$ID) ;	
	}
	function  getAllLink()
	{
			$mysqli = connection();
		$result =  $mysqli->query("SELECT * FROM lien " );
		return $result;
	}
	function getLienRaw($ID)
	{
		$mysqli = connection();
		$result = $mysqli->query("SELECT * FROM lien WHERE ID = ".$ID ) ;	
		$Value = $result->fetchArray();
		return $Value;
	}
	function getNbClick($ID)
	{
		$mysqli = connection();
		$result = $mysqli->query("SELECT Count(*) FROM stat Where ID =".$ID ) ;							
		$Value = $result->fetchArray();	
		return  ($Value)[0];
	}
	function MaxJour($ID)
	{
		$mysqli = connection();
		$result = $mysqli->query("Select MAX(TT) as RESULT From (SELECT Count(*) AS TT , date FROM stat Where ID =".$ID." GROUP BY SUBSTR(Date,0,10) )AS SUBquery  " );							
			$Value = $result->fetchArray();	
			//var_dump($Value); 				
			return $Value["RESULT"];
	}
?>
