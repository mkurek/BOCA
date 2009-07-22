<?php

$algs = array();
$in_section = array();
$sid = array();

$ch = $_GET['ch'];															// chapter
$sch = intval($_GET['sch']);												// sub-chapter


if($sch > 7) $sch = 7;

if($ch != '' && $sch == '')												// wybór orientacji 
{

   if($ch == 'n')																// D-face: OK
   {	
			$min = 859;
			$max = 898;
   }
		
   else if($ch == 'r')														// D-face: swap na 1 ścianie
   {
	  		$min = 899;
			$max = 938;
	}

	else 																			// D-face: swap po skosie
	{
	 	  $min = 939;
		  $max = 978;
	}

	
	for($i=$min;$i<$max;$i+=6)
 	{
 		$algs[] = get_alg($i, $cat_l, $uid);
	 }

	 for($i=1;$i<=7;$i++)
		$in_section[] = $i;

   $img_main = true; 
   $top_img_cat = 'eg';
	$top_img_cats = array('down');

	$what_in_section = 'subchapter';								// co się zmienia w section
	
	$title = 'choose_eg_or';										// tytuł
	$file = 'cat';														// plik który ma być w linku ({cat, file})

	$smarty -> assign('if_chapter', true);													// czy $_GET('ch')
	$smarty -> assign('if_subchapter', true);												// czy $_GET('sch')
	$smarty -> assign('if_orientation', false);											// czy $_GET('o')
	$smarty -> assign('if_permutation', false);											// czy $_GET('p')
	$chapter = $ch;
	   
	$imgcats = array('cube_oll', 'top_oll');					// description_img
	
	if($mode == 'print')
	{
		$algs = get_algs($min, $max, $cat_l, $uid);
		$title_big = $colls_title;
		$top_imgs = 'down';
		$smarty -> assign('top_imgs', $top_imgs);
		
	}
	
	

}



else if($ch != '' && $sch != '')											// wybór case'a
{
 	if($ch == 'n') $min = 859;
 	else if($ch == 'r') $min = 899;
 	else $min = 939;
 	
 	$min += ($sch-1)*6;
	
	if($sch != 7)$max = $min+5;
	else $max = $min+3;
	
	$algs = get_algs($min, $max, $cat_l, $uid);
	
	for($i=$min;$i<=$max;$i++)
    $sid[] = $i;
	
	$img_main = true;  
	$top_img_cat = 'eg';
	$top_img_cats = array('cube_oll', 'top_oll', 'down');
			  
	$title = 'choose_eg_case';										// tytuł
	$file = 'case';														// plik który ma być w linku ({cat, file})
	
	if($mode == 'print')
	{
		$title_big = array(1=>$colls_title[($sch-1)*6+1]);
		$top_imgs = 'down';
		$smarty -> assign('top_imgs', $top_imgs);
		
	}
	
	
	$imgcats = array('cube', 'top_pll');							// description_img
	$smarty -> assign('if_chapter', true);													// czy $_GET('ch')
	$smarty -> assign('if_subchapter', true);												// czy $_GET('sch')
	$chapter = $ch;
	$subchapter = $sch;
	$smarty -> assign('if_orientation', false);											// czy $_GET('o')
	$smarty -> assign('if_permutation', false);											// czy $_GET('p')
}



else																				// wybór kategorii eg
{
	
	$cats = array('n', 'r', 'b');
	$algs = array();
	$in_section = $cats;
	
	if($mode != 'print')
	{
	$query = "SELECT `pre-moves`, `alg`, `post-moves` FROM `portal_algs` WHERE ID IN(859, 899, 939);";
	$result = query($query);
	while($row = mysql_fetch_row($result)) $algs[] = stripslashes($row[0].$row[1].$row[2]);
	}
	
	else
	{
		$algs = get_algs(859, 978, $cat_l, $uid);
	}
	
	$what_in_section = 'chapter';								// co się zmienia w section
	
	$title = 'choose_eg_ch';									// tytuł
	$file = 'cat';													// plik który ma być w linku ({cat, file})

	$smarty -> assign('if_chapter', true);												// czy $_GET('ch')
	$smarty -> assign('if_subchapter', false);										// czy $_GET('sch')
	$smarty -> assign('if_orientation', false);										// czy $_GET('o')
	$smarty -> assign('if_permutation', false);										// czy $_GET('p')
	   
	$imgcats = array('cube', 'down');							// description_img
	
	$top_imgs = 'down';
	$smarty -> assign('top_imgs', $top_imgs);
	
	if($mode == 'print')
	{
		$title_big = array();	
		$k=0;	
		for($i=0;$i<120;$i++)
		{
				
			if($i==40 || $i== 80) $k=0;
			//echo '$i: '.$i.' ; $k: '.$k.' ; $colls_title['.$k.'] = '.$colls_title[$k].'<br />';	
			if($colls_title[$k] != '') $title_big[$i] = $colls_title[$k];
			$k++;
		}
	}
	
}

$image_cat = 'eg';												// główne kategorie obrazków
$method = 'eg';													// metoda
$get_imgcats_id = 'eg';

?>