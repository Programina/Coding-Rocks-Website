 <?php
	$servername = "localhost";
	$username = "username";
	$password = "password";

	try {
			$conn = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
				// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
			echo "Erfolgreich verbunden.";
    }
		
	catch(PDOException $e)
    
	{
		echo "Verbindung fehlgeschlagen: " . $e->getMessage();
    }
?> 