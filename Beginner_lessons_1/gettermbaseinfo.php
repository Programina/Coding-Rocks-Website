<?php
		/*verbindet sich mit der PHP-Datei, die sich mit der DB verbindet, mysqli_connect. Öffnet Verbindung mit DB, holt Info raus, schickt die an den Browser. */

	require_once('../mysqli_connect.php'); /*ruft die DB-Verbindung auf*/

	$query = "SELECT dbinput_term, dbinput_descr FROM itdictionary"; /*issues query - Abfrage gestartet*/

	$response = mysqli_query($dbc, $query); /*gests a response from DB by sending a response and a query*/

	if($response) /*fragt, did I get a response?, erstellt das eine HTML-Tabelle, die alle Inhalte aufteilt und einträgt*/
	{
		echo '<table align="left" cellspacing="5" cellpadding="8">
		<tr><td align="left"> <p><strong>Term</strong></p></td><td align="left"> <p><strong>Term Description</strong></p></td></tr>'; 

		while ($row = mysqli_fetch_array($response))
		{
			echo '<tr><td align="left"><p>'.
			$row ['dbinput_term'] .
			'</p></td><td align="left"><p>' . 
			$row['dbinput_descr'] . 
			'</p></td></tr>' ;
		}

	echo '</table>';

	} 

	else /*wenn die Datenbankabfrage fehlschlug*/
	{
		echo "SOMETHING WENT WRONG AGAIN! Database query fehlgeschlagen! Here is why...Errormessage from db connection:";
		echo "mysqli_error($dbc)";
	}

	mysqli_close($dbc); /*Schließt die DB-Verbindung - wichtig, um den Server nicht zu überlasten!*/
?>