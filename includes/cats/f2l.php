<?php

	//wypełnianie tab - SID cat
$tab = array();
$sid = array();

$k=473;
for($i=0;$i<36;$i++)
{
$tab[] = $k;
$k+=8;
}

$tab[] = $k;
$tab[] = 0;
for($i=0;$i<2;$i++)
{
$k+=2;
$tab[] = $k;
$k+=4;
$tab[] = $k;
}
$tab[] = 775;

$p=0;
for($i=0;$i<(count($tab)-1);$i++)
{
	if($tab[$i] == 0) continue;
	$temp1 = $tab[$i+1]-1;
	if($temp1 == -1) $temp1 = 762;
	
	if($mode == 'print')
	{
		$algs[] = get_alg(array($tab[$i],$temp1), $cat_l, $uid);	
	}
	else{
	$query = "SELECT `pre-moves`, `alg`, `post-moves` FROM `portal_algs` WHERE SID=$tab[$i];";
	$result = query($query);
	$row = mysql_fetch_row($result);
	$temp = stripslashes($row[0].$row[1].$row[2]);
	
	$algs[] = stripslashes($row[0].$row[1].$row[2]);
	$sid[] = $tab[$i].','.$temp1;
	}
}

$title = 'choose_f2l_case';										// tytuł	   
$file = 'case';														// plik który ma być w linku ({cat, file})	   	   
$imgcats = array('cube');	
$image_cat = 'f2l';													// główne kategorie obrazków

$method = 'fridrich';												// metoda
$chapter = 'f2l';														// chapter
$get_imgcats_id = 'f2l';

$smarty -> assign('if_chapter', true);
		

?>