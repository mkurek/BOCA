<?php

$oll_woe = array(array(1, 72), array(73, 144), array(145, 216), array(217, 288), array(289, 360), array(361, 432), array(433, 472));


$sch = $_GET['sch'];					// sub-chapter

if($sch != '')										
{
	$algs = array();
	$sid = array();
	
   if($sch == 'm')					// minus		
   {	
	$min = 1000;
	$max = 1026;
   }

   else if($sch == 'p')					// plus			
   {
	$min = 1027;
	$max = 1053;
   }

   else if($sch == 'o')					// o	
   {
	$min = 1054;
 	$max = 1080;
   }

   else if($sch == 'i')					// i	
   {
	$min = 1081;
 	$max = 1088;
   }
   
   
   else if($sch == 'im')				// im
   {
	$min = 1089;
 	$max = 1096;
   }

	if($sch != 'c')
	{
		$algs = get_algs($min, $max, $cat_l, $uid);
		for($i=$min;$i<=$max;$i++) $sid[] = $i;
	}
	else								// orientacja rogów
	{
 		for($i=0;$i<count($oll_woe);$i++) $algs[] = get_alg($oll_woe[$i][0], $oll_woe[$i][1], $cat_l, $uid);
 		for($i=0;$i<count($oll_woe);$i++) $sid[] = $oll_woe[$i][0].','.$oll_woe[$i][1];
 	}
	 		  
	$title = 'choose_mgls_cls_case';					// tytuł
	$file = 'case';								// plik który ma być w linku ({cat, file})
	
	$smarty -> assign('if_subchapter', true);				// czy $_GET('sch')
	$subchapter = $sch;
	$smarty -> assign('if_chapter', true);					// czy $_GET('ch')
			
}	

else										// wybór kategorii cls
{
	
	$cats = array('m', 'p', 'o', 'i', 'im', 'c');
	$algs = array();
	
	if($mode == 'print')
	{
		$algs = get_algs(1000, 1096, $cat_l, $uid);
		for($i=0;$i<count($oll_woe);$i++) $algs[] = get_alg($oll_woe[$i][0], $oll_woe[$i][1], $cat_l, $uid);
	}
	else
	{
      
        $query = "SELECT `pre-moves`, `alg`, `post-moves` FROM `portal_algs` WHERE SID IN(1000, 1027, 1054, 1081, 1089);";
		$result = query($query);
		while($row = mysql_fetch_row($result)) $algs[] = stripslashes($row[0].$row[1].$row[2]);
	$query = "SELECT `pre-moves`, `alg`, `post-moves` FROM `portal_algs` WHERE ID=1;";
	$result = query($query);
		while($row = mysql_fetch_row($result)) $algs[] = stripslashes($row[0].$row[1].$row[2]);
	}
	
	$in_section=$cats;
	
	$what_in_section = 'subchapter';						// co się zmienia w section	
	$title = 'choose_mgls_sch';							// tytuł
	$file = 'cat';									// plik który ma być w linku ({cat, file})

	$smarty -> assign('if_chapter', true);						// czy $_GET('ch')
	$smarty -> assign('if_subchapter', true);					// czy $_GET('sch')
	$smarty -> assign('if_orientation', false);					// czy $_GET('o')
	$smarty -> assign('if_permutation', false);					// czy $_GET('p')
	   
	   
	

}

$imgcats = array('cube');
$image_cat = 'mgls_cls';
$method = 'mgls';											// metoda
$chapter = 'cls';											// chapter
			
$get_imgcats_id = 'mgls_cls';
?>
