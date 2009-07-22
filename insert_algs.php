<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="zbll, fridrich, coll, rubik's" />
<meta name="Description" content="Rubik's Cube'" />
<meta name="Author" content="PoznanTeam" />
<meta name="Copyright" content="All rights reserved ®" />
<meta http-equiv="Content-Language" content="pl" />
<title>ZBLL</title>
</head>
<body>

<?php

function obrobka($alg)
{
$alg = str_replace("(", "", $alg);
$alg = str_replace(")", "", $alg);
$alg = str_replace(". ", "", $alg);

$start = stripos($alg, "q") - 2;
	 $alg = substr_replace ($alg, ' ', $start);
$alg = trim($alg);
$tab = explode(" ", $alg);	
	
$shift = true;
$shift_end = true;	
	
if($tab[0] == 'U') $end[0] = 'y';
else if($tab[0] == "U\'") $end[0] = "y\'";	
else if($tab[0] == "U'") $end[0] = "y\'";
else if($tab[0] == 'U2') $end[0] = 'y2';
else if($tab[0] == '(U)') $end[0] = 'y';
else if($tab[0] == '(U\')') $end[0] = 'y\'';	
else if($tab[0] == '(U2)') $end[0] = 'y2';
else $shift = false;

if($tab[count($tab)-1] == 'U') $end[2] = 'U';
else if($tab[count($tab)-1] == "U\'") $end[2] = "U\'";	
else if($tab[count($tab)-1] == "U'") $end[2] = "U\'";
else if($tab[count($tab)-1] == 'U2') $end[2] = 'U2';
else if($tab[count($tab)-1] == '(U)') $end[2] = 'U';
else if($tab[count($tab)-1] == '(U\')') $end[2] = 'U\'';	
else if($tab[count($tab)-1] == '(U2)') $end[2] = 'U2';
else $shift_end = false;


if($shift) array_shift($tab);
if($shift_end) $cos = array_pop($tab);

$end[1] = implode(" ", $tab);

//echo $alg.'<br /><br />';

return $end;
}


function ruchy($alg, $typ)
{
	$alg = trim($alg) ;
	$ruchy = 0;

preg_match_all("/[A-Z]/", $alg, $wynik);
$ruchy += count($wynik[0]);
$wynik = '';

preg_match_all("/\d+/", $alg, $wynik);
$dwojki = count($wynik[0]);
$wynik = '';

preg_match_all("/M/", $alg, $wynik);
$emki = count($wynik[0]);
$wynik = '';

preg_match_all("/M2/", $alg, $wynik);
$emki2 = count($wynik[0]);
$wynik = '';

if($typ == 'htm') {
$ruchy += ($emki + $emki2)*2;		
}

else if($typ == 'stm') {
$ruchy += ($emki + $emki2);		
}

else if($typ == 'qtm') {
$ruchy += $dwojki;
$ruchy += ($emki + $emki2)*2;		
}

$tab = explode(" ", $alg);
$koniec = count($tab)-1;

if($tab[$koniec] == "U" || $tab[$koniec] == "U\'" || $tab[$koniec] == "U2" || $tab[$koniec] == "U'") $ruchy--;


if($alg == 'brak algu') $ruchy = 0;

return $ruchy;
}



function connect($host, $dbuser, $dbhaslo, $db_select)
{
if (!$db_lnk = mysql_connect ($host, $dbuser, $dbhaslo)){
echo ('Nie połączono z bazą');
return false;
}

if(!mysql_select_db($db_select, $db_lnk))
echo('Wystąpił błąd podczas wyboru bazy danych...<br />');
}



include("config.php");

connect($host, $dbuser, $dbhaslo, $db_select);

// otwieranie rul

if(!$fd = fopen('rul.txt', 'r'))
echo "Nie udało się otowrzyć dokumentu\n";

while(!feof($fd))
{
	$str .= fgets($fd);	
}
fclose($fd);


$rul = explode('~', addslashes(str_replace("\n", "<br />", $str)));

//to samo dla all

$str='';

if(!$fd = fopen('all.txt', 'r'))
echo "Nie udało się otowrzyć dokumentu\n";

while(!feof($fd))
{
	$str .= fgets($fd);	
}
fclose($fd);

$all = explode('~', addslashes(str_replace("\n", "<br />", $str)));

// otwieranie ruf

$str='';

if(!$fd = fopen('ruf.txt', 'r'))
echo "Nie udało się otowrzyć dokumentu\n";

while(!feof($fd))
{
	$str .= fgets($fd);	
}
fclose($fd);

$ruf = explode('~', addslashes(str_replace("\n", "<br />", $str)));



// koniec otwierania -> mamy tablice all, rul, ruf ; 




$ile = count($all);

//obrobka all

$j=0;

for($i=1; $i<$ile; $i++)
{
	$temp = explode('<br />', $all[$i]);
	
	$end[$j][0] = $i;								//sytuacje
	$end[$j+1][0] = $i;

	$dl_temp = count($temp)-2;								//dlugosc temp1

	$all1 = obrobka($temp[$dl_temp-1]);				// przypisanie wartosci 2 najkrotszych algow
	$all2 = obrobka($temp[$dl_temp-2]);

	if($all1[1] == $all2[1]) $all2 = obrobka($temp[$dl_temp-3]);		//sprawdzenie czy algi nie są identyczne

	$end[$j][1] = $all1[0];
	$end[$j+1][1] = $all2[0];														// pre-moves
	
	$end[$j][2] = $all1[1];
	$end[$j+1][2] = $all2[1]; 														// alg

	$end[$j][3] = $all1[2];
	$end[$j+1][3] = $all1[2];														// post-moves
	
$j+=2;
}




$ile = count($rul);

//obrobka rul

for($i=1; $i<$ile; $i++)
{
	$temp = explode('<br />', $rul[$i]);
	
	$end[$j][0] = $i;								//sytuacje
	$end[$j+1][0] = $i;

	$dl_temp = count($temp)-2;								//dlugosc temp1

	$rul1 = obrobka($temp[$dl_temp-1]);				// przypisanie wartosci 2 najkrotszych algow
	$rul2 = obrobka($temp[$dl_temp-2]);

	if($rul1[1] == $rul2[1]) $rul2 = obrobka($temp[$dl_temp-3]);		//sprawdzenie czy algi nie są identyczne

	$end[$j][1] = $rul1[0];
	$end[$j+1][1] = $rul2[0];														// pre-moves
	
	$end[$j][2] = $rul1[1];
	$end[$j+1][2] = $rul2[1]; 														// alg

	$end[$j][3] = $rul1[2];
	$end[$j+1][3] = $rul1[2];														// post-moves
	
$j+=2;
}

// obrobka ruf

$ile = count($ruf);

for($i=1; $i<$ile; $i++)
{
	$temp = explode('<br />', $ruf[$i]);
	
	$end[$j][0] = $i;								//sytuacje
	$end[$j+1][0] = $i;

	$dl_temp = count($temp)-2;								//dlugosc temp1

	$ruf1 = obrobka($temp[$dl_temp-1]);				// przypisanie wartosci 2 najkrotszych algow
	$ruf2 = obrobka($temp[$dl_temp-2]);

	if($ruf1[1] == $ruf2[1]) $ruf2 = obrobka($temp[$dl_temp-3]);		//sprawdzenie czy algi nie są identyczne

	$end[$j][1] = $ruf1[0];
	$end[$j+1][1] = $ruf2[0];														// pre-moves
	
	$end[$j][2] = $ruf1[1];
	$end[$j+1][2] = $ruf2[1]; 														// alg

	$end[$j][3] = $ruf1[2];
	$end[$j+1][3] = $ruf1[2];														// post-moves
	
$j+=2;
}



echo '<br /><br />';
/*
$query = 'TRUNCATE `portal_algs`';

if(!$result = mysql_query($query)){
echo mysql_errno() . ": " . mysql_error() . "\n";
echo('<br />Nie utworzono tabel_1!');
mysql_close();
exit;
}


$insert = 'INSERT INTO `portal_algs` VALUES ';

$orientacja = 1;
$permutacja = 1;
$zero = 0;
$jeden = 1;
$dwa = 2;

for($i = 0;$i<count($end);$i++) 											//wszystkie case'y
{	
$query = '';		 	 
$query = $insert.'(NULL, '.$end[$i][0].', \''.$end[$i][1].'\', \''.$end[$i][2].'\', \''.$end[$i][3].'\', 1);';																// zapytanie do mysql

echo '$query['.$i.'] = '.$query.'<br /><br />';

if(!$result = mysql_query($query)){
echo mysql_errno() . ": " . mysql_error() . "\n";
echo('<br />Nie utworzono tabel!');
mysql_close();
exit;
}

else
echo $i.'INSTALACJA - OK!<br /><br />';


} 


*/
?>
</body>
</html>