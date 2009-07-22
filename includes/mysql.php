<?php

function connect($host, $dbuser, $dbhaslo, $db_select)
{
if (!$db_lnk = mysql_connect ($host, $dbuser, $dbhaslo)){
echo ('Nie połączono z bazą');
return false;
}

if(!mysql_select_db($db_select, $db_lnk))
echo('Wystąpił błąd podczas wyboru bazy danych...<br />');

}

function query($query)
{
	if(!$result = mysql_query($query)){
		
		
		echo 'Nieprawidłowe zapytanie: $query: '.$query.'<br />'.mysql_errno() . ": " . mysql_error(). "\n";

		mysql_close();
		exit();
		}
return $result;			
}

?>