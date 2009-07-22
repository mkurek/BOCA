<?php

$min = 775;
$max = 795;

$algs = array();
$tab = array();

$algs = get_algs($min, $max, $cat_l, $uid);

for($i=$min;$i<=$max;$i++) $tab[] = $i;

			  
$title = 'choose_pll_case';										// tytuł
$file = 'case';														// plik który ma być w linku ({cat, file})
$sid = $tab;															// sid_array

$smarty -> assign('if_chapter', true);							// czy $_GET('ch')
	
$imgcats = array('cube', 'top_pll');							// description_img
$image_cat = 'pll';													// główne kategorie obrazków

$method = 'fridrich';												// metoda
$chapter = 'pll';														// chapter

$get_imgcats_id = 'pll';
$title_cell = $pll_titles;
$smarty -> assign('titles_cell', $pll_titles);
if($lang == 'pl') $before = true;
else $before = false;
$smarty -> assign('titles_cell_before', $before);
$smarty -> assign('titles_cell_text', 'permutation'); 
?>
