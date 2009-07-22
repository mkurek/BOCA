<?php

$ch = $_GET['ch'];		

if($ch != '')
{			
	$algs = array();
	$sid = array();
	
   if($ch == 'm')					// minus
   {	
	$min = 1097;
	$max = 1123;
   }

   else if($ch == 'p')					// plus	
   {
	$min = 1124;
	$max = 1150;
   }

   else if($ch == 'o')					// o	
   {
	$min = 1151;
 	$max = 1177;
   }

   else if($ch == 'i')					// i
   {
	$min = 1178;
 	$max = 1185;
   }
   
   
   else 						// im
   {
	$min = 1186;
 	$max = 1193;
   }

	
	
	$algs = get_algs($min, $max, $cat_l, $uid);
	for($i=$min;$i<=$max;$i++) $sid[] = $i;
			  
	$title = 'choose_ss_case';					// tytuł
	$file = 'case';								// plik który ma być w linku ({cat, file})

	$chapter = $ch;
	$smarty -> assign('if_chapter', true);					// czy $_GET('ch')
			
	
}
else										// wybór kategorii oll
{
	
	$cats = array('m', 'p', 'o', 'i', 'im');
	$algs = array();
	
	if($mode == 'print')
	{
		$algs = get_algs(1097, 1193, $cat_l, $uid);
	}
	else
	{
      
        $query = "SELECT `pre-moves`, `alg`, `post-moves` FROM `portal_algs` WHERE SID IN(1097, 1124, 1151, 1178, 1186);";
		$result = query($query);
		while($row = mysql_fetch_row($result)) $algs[] = stripslashes($row[0].$row[1].$row[2]);
	}
	
	$in_section=$cats;
	
	$what_in_section = 'chapter';					// co się zmienia w section	
	$title = 'choose_ss_ch';						// tytuł
	$file = 'cat';								// plik który ma być w linku ({cat, file})

	$smarty -> assign('if_chapter', true);					// czy $_GET('ch')
	$smarty -> assign('if_subchapter', false);				// czy $_GET('sch')
	$smarty -> assign('if_orientation', false);				// czy $_GET('o')
	$smarty -> assign('if_permutation', false);				// czy $_GET('p')
 
	   
	

}

$imgcats = array('cube_oll');
$image_cat = 'ss';
$method = 'ss';								// metoda								// chapter
			
$get_imgcats_id = 'ss';
?>
