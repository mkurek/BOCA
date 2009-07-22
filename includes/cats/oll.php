<?php

$sch = $_GET['sch'];															// sub-chapter

if($sch != '')																	// wybor case'a OLL'a
{
	$algs = array();
	$sid = array();
	
   if($sch == 'd')															// . (dott)
   {	
	$min = 796;
	$max = 803;
   }

   else if($sch == 'l')														// L
   {
	$min = 804;
	$max = 830;
   }

   else if($sch == 'b')														// | (bar)
   {
	$min = 831;
 	$max = 845;
   }

   else 																			// + (plus)
   {
	$min = 846;
	$max = 852;
   }

	
	$algs = get_algs($min, $max, $cat_l, $uid);

	for($i=$min;$i<=$max;$i++) $sid[] = $i;
			  
	$title = 'choose_oll_case';										// tytuł
	$file = 'case';														// plik który ma być w linku ({cat, file})
	
	$smarty -> assign('if_subchapter', true);						// czy $_GET('sch')
	$subchapter = $sch;
	$smarty -> assign('if_chapter', true);							// czy $_GET('ch')
			
}	

else																				// wybór kategorii oll
{
	
	$cats = array('d', 'l', 'b', 'p');
	$algs = array();
	
	if($mode == 'print')
	{
		$algs = get_algs(796, 852, $cat_l, $uid);
	}
	else
	{
      $query = "SELECT `pre-moves`, `alg`, `post-moves` FROM `portal_algs` WHERE ID IN(796, 804, 831, 846);";
		$result = query($query);
		while($row = mysql_fetch_row($result)) $algs[] = stripslashes($row[0].$row[1].$row[2]);
	}
	
	$in_section=$cats;
	
	$what_in_section = 'subchapter';								// co się zmienia w section	
	$title = 'choose_oll_sch';										// tytuł
	$file = 'cat';														// plik który ma być w linku ({cat, file})

	$smarty -> assign('if_chapter', true);													// czy $_GET('ch')
	$smarty -> assign('if_subchapter', true);												// czy $_GET('sch')
	$smarty -> assign('if_orientation', false);											// czy $_GET('o')
	$smarty -> assign('if_permutation', false);											// czy $_GET('p')
	   
	   
	

}

$imgcats = array('cube_oll', 'top_oll');
$image_cat = 'oll';
$method = 'fridrich';														// metoda
$chapter = 'oll';																// chapter
			
$get_imgcats_id = 'oll';
?>
