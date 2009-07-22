<?php 

$min = 979;
$max = 999;


$algs = get_algs($min, $max, $cat_l, $uid);

for($i=$min;$i<=$max;$i++) $sid[] = $i;
			  
$title = 'choose_els_case';								// tytuł
$file = 'case';										// plik który ma być w linku ({cat, file})
	
$smarty -> assign('if_subchapter', false);						// czy $_GET('sch')
$smarty -> assign('if_chapter', true);							// czy $_GET('ch')
	
	
$imgcats = array('cube');
$image_cat = 'mgls_els';
$method = 'mgls';														// metoda
$chapter = 'els';																// chapter
			
$get_imgcats_id = 'mgls_els';	
	
?>
