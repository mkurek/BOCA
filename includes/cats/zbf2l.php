<?php

$sch = $_GET['sch'];
$sid = array();
$algs = array();
$in_section=array();

if($sch == '')							// wybór kat zbf2l;
{
   if($mode == 'print')
				$algs = get_algs(473,774, $cat_l, $uid);
	
	else
	{
	 	 //wypełnianie tab - SID cat
		 $tab = array();
		 $k=473;
		 for($i=0;$i<36;$i++)
		 {
			 $tab[] = $k;
			 $k+=8;
		 }
		 $tab[] = $k;
		 $tab[] = 0;
		 $k+=1;
		 for($i=0;$i<2;$i++)
		 {
	       $k+=2;
			 $tab[] = $k;
			 $k+=4;
			 $tab[] = $k;
		 }

		 // koniec wypełniania

		 for($i=0;$i<count($tab);$i++)
		 {
			  $query = "SELECT `pre-moves`, `alg`, `post-moves` FROM `portal_algs` WHERE SID=$tab[$i];";
			  //echo $i.' -> '.$query.'<br />';
			  $result = query($query);
			  $row = mysql_fetch_row($result);
	
			  $temp = stripslashes($row[0].$row[1].$row[2]);
			  //echo $i.' -> '.$tab[$i].' -> '.$temp.'<br />';
			  $algs[] = stripslashes($row[0].$row[1].$row[2]);
			  $in_section[] = $i+1;
			  $in_section[] = $i+1;
       }


/*
$smarty -> assign('what', 'choose_zbf2l_cat');
$smarty -> assign('algs', $algs);
//var_dump($algs);
$smarty -> assign('cat', 'zbf2l');
*/
   }

	$what_in_section = 'subchapter';													// co się zmienia w section

	$title = 'choose_zbf2l_cat';														// tytuł
	$file = 'cat';																			// plik który ma być w linku ({cat, file})

	$smarty -> assign('if_chapter', true);											// czy $_GET('ch')
	$smarty -> assign('if_subchapter', true);										// czy $_GET('sch')
	$smarty -> assign('if_orientation', false);									// czy $_GET('o')
	$smarty -> assign('if_permutation', false);									// czy $_GET('p')

	$image_cat = 'zbf2lweuf';															// główne kategorie obrazków -> zbf2l without edges u face
	if($mode == 'print') $image_cat = 'zbf2l';
	$imgcats = array('cube');															// description_img	
	$step = 4;																				// krok w pętli


}

else																// wybór case'a
{

   $sch = intval($_GET['sch']);

	if($sch<1) $sch = 1;
	if($sch>21) $sch = 21;

	if($sch<19) {$min = 473+($sch-1)*16; $max = $min+15; $half = $min+8;}
	else if($sch==19) {$min = 473 + ($sch-1)*16; $max = $min + 1; $half = $min+1;}
	else {$min = 473 + 18*16 + 2 + ($sch-20)*6; $max = $min+5; $half = $min+3;}

	$algs = get_algs($min, $max, $cat_l, $uid);

	for($i=$min;$i<=$max;$i++)
       $sid[]=$i;

   $file = 'case';																// plik który ma być w linku ({cat, file})

	$image_cat = 'zbf2l';														// główne kategorie obrazków -> zbf2l without edges u face
	$imgcats = array('cube');													// description_img	

	$smarty -> assign('if_chapter', true);									// czy $_GET('ch')
	$smarty -> assign('if_subchapter', true);								// czy $_GET('sch')

	$title = 'choose_zbf2l_case';												// tytuł
	
	$subchapter = $sch;															// subchapter	

}

$method = 'zb';																// metoda
$chapter = 'zbf2l';															// chapter
$get_imgcats_id = 'zbf2l';

?>
