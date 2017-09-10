<!Doctype html>
<html>
<head></head>

<body>

<?php

if(isset($_POST['submit'])) /*if we received a submit request if type POST...*/

	{
		$data_missing = array(); /*create an array that contains any missing info, e.g. if something has not been put into the form*/
	
			if(empty($_POST['dbinput_term'])) /*if dbinput_term is empty, you get the following message*/
			
			{ 
				$data_missing[] = 'Term has been left empty!'; /*I am adding that to my data_missing-Array*/
			}
			
			
			else /*wenn term hinzugefügt wurde, !!schnipple ich Whitespace!! vom Input!! aus term-Feld*/
				{
					$trm = trim($_POST['dbinput_term']); /*trim-methode für "term" - trm abgekrzt.*/
				}
			
			
			if(empty($_POST['dbinput_termdescr']))
			
				{
					$data_missing[] = 'Term Description';
				}
			
			else
				{
					$dscr = trim($_POST['dbinput_termdescr']);  /*trim-methode für "description" - dscr abgekrzt.*/
				}
			
			
			if(empty($data_missing)) /*Wenn alles brav eingegeben wurde, sollte hier kein Fehler kommen*/
			{
					require_once('../mysqli_connect.php'); 
					$query = "INSERT INTO itdictionary (dbinput_term, dbinput_descr) VALUES (?, ?)";
					
					 $stmt = mysqli_prepare($dbc, $query); /*prepared statement*/
					 mysqli_stmt_bind_param($stmt, "ss", $trm, $dscr); /*binde die beiden "Parameter" aus der Datenbank - term und description - in das prepared statement ein - ss sagt, dass es 2 Strings sind, also term und description*/
					 
					 mysqli_stmt_execute($stmt); /*führt das prepared statement aus*/
					 
					 $affected_rows = mysqli_stmt_affected_rows($stmt); /*sicherstellen ob eine Zeile - hier jetzt erstmal eh nur eine - betroffen ist*/
				 
				 if($affected_rows == 1)  /*wenn ich kann nur einen auf einmal eingeben, also ist das immer eins - dann gebe ich das hier aus*/
					 {
						 echo 'Term was entered';
						 mysqli_stmt_close($stmt);
						 mysqli_close($dbc);
					 }
				 
				 else
					 {
						echo 'Error Occurred<br>';
						 echo mysqli_error();
						 mysqli_stmt_close($stmt);
						 mysqli_close($dbc);

					 }
					 
			}
					 
		else
			{
				 echo 'You need to enter the following data<br>';
				
				foreach($data_missing as $missing)
				 { 
					echo "$missing <br>";
				 }
			
			
			}	 
				
				
					

	}


?>


<h1> NOCHMAL VON VORN</h1>
<form action="http://localhost:81/termadded.php" method="post">
									
									<input name="dbinput_term" size="50" class="searchbarwidth" type="text" placeholder="Insert term here" value="" required />
						
									<input name="dbinput_termdescr" class="searchbarwidth" type="text" size="250" placeholder="Insert description here" value="" />
									
									<input type="submit" name="submit" value="Send"/>
	</form>
</body>


</html>