<?php

//co robic

if(isSet($_GET['o']) && !isSet($_GET['p'])) $what = "choose_per";
else if(isSet($_GET['o']) && isSet($_GET['p'])) $what = "choose_case";
else $what = "choose_or"; 

$o = intval($_GET['o']);
if($o>7) $o=7;

$p = intval($_GET['p']);
if($p>6) $p=6;

$tab = array();
$in_section = array();
$algs = array();


// wybór orientacji
if($what == 'choose_or')
{
	$min = 1;
	$max = 473;
	for($i=1;$i<473;$i+=72)
        $tab[]=$i;
   
   for($i=1;$i<=7;$i++) $in_section[]=$i;
   
  if($mode == 'print')
  {
  	$temp = $zb_title_little; 
	$temp2 = $zb_title_little_h; 
  // przetwarzanie tytułów
  	  for($i=0;$i<7;$i++)
	  {
	  		  for($j=0;$j<72;$j++)
	  		  {
	  		  	  if($i != 6)
				  {
				  		if($temp[$j] != '') $title_little[$i*72+$j] = $temp[$j]; 				  	
			     }
				  else
				  {
				  	if($temp2[$j] != '') $title_little[$i*72+$j] = $temp2[$j];
				  }	  		  
	  		  	
		     }
		     
	  }
  	  
	  $title_big = $zb_title_big;
  }
   
   
   $what_in_section = 'orientation';														// co się zmienia w section
	$title = 'choose_zbll_or';																	// tytuł
	$file = 'cat';																					// plik który ma być w linku ({cat, file})

	$smarty -> assign('if_chapter', true);													// czy $_GET('ch')
	$smarty -> assign('if_subchapter', false);											// czy $_GET('sch')
	$smarty -> assign('if_orientation', true);											// czy $_GET('o')
	$smarty -> assign('if_permutation', false);											// czy $_GET('p')
	   
   $image_cat = 'zbll';																			// główne kategorie obrazków
	$imgcats = array('cube_oll', 'top_oll');												// description_img
}

// ----------------------------------------------------------------------

//wybór permutacji
else if($what == 'choose_per')
{
	$min=($o-1)*72+1;
	if($o != 7) $max = $min+72;
	else $max= $min+40;
	
	for($i=$min;$i<$max;$i+=12)
        $tab[] = $i;
		  
	if($o == 7) $max2=4;
	else $max2=6;
	
	for($i=1;$i<=$max2;$i++) $in_section[] = $i;	  						


  if($mode == 'print')
  {
  // przetwarzanie tytułów
  	  $tym = ($o-1)*72+1;
  	  $title_big = array(1=>$zb_title_big[$tym]);
	  if($o != 7) $title_little = $zb_title_little;
	  else $title_little=$zb_title_little_h;
  }


   $what_in_section = 'permutation';														// co się zmienia w section

	$title = 'choose_zbll_per';																// tytuł
	$file='cat';																					// plik który ma być w linku ({cat, file})

	$smarty -> assign('if_chapter', true);													// czy $_GET('ch')
	$smarty -> assign('if_subchapter', false);												// czy $_GET('sch')
	$smarty -> assign('if_orientation', true);											// czy $_GET('o')
	$smarty -> assign('if_permutation', true);											// czy $_GET('p')

	$orientation=$o;																				// aktualna orientacja

	$image_cat = 'coll';																			// główne kategorie obrazków
	if($mode == 'print') $image_cat = 'zbll';
	$imgcats= array('cube', 'top_pll');														// description_img
}

// ---------------------------------------------------------------

//wybór case'a
else
{
	$min = ($o-1)*72 + ($p-1)*12 + 1;
	$max = $min+12;
	
	if($o == 7)
	{	
		if($p==3) {$max = $min+8;}
		if($p==4) {$min-=4; $max = $min+8;}
	}
			
			for($i=$min;$i<$max;$i++)
		      $tab[] = $i;
   
  if($mode == 'print')
  {
  // przetwarzanie tytułów
  	  $tym = ($o-1)*72+1;
  	  $title_big = array(1=>$zb_title_big[$tym]);
  	  $tym2 = ($p-1)*12+1;
		 if($o != 7) $title_little = array(1=>$zb_title_little[$tym2]);
		 else { if($p == 4) $tym2-=4; $title_little=array(1=>$zb_title_little_h[$tym2]);}
  }
  
  // img_main == true
  	$img_main = true;  
	$top_img_cat = 'coll';
	$top_img_cats = array('cube', 'top_pll');
			  
	$title = 'choose_zbll_case';																// tytuł
	$file = 'case';																				// plik który ma być w linku ({cat, file})
	$sid = $tab;																					// sid_array
	
	$image_cat = 'zbll';																			// główne kategorie obrazków
	$imgcats = array('cube', 'top_pll');													// description_img

	$smarty -> assign('if_chapter', true);													// czy $_GET('ch')
	$smarty -> assign('if_subchapter', false);												// czy $_GET('sch')
	$smarty -> assign('if_orientation', true);											// czy $_GET('o')
	$smarty -> assign('if_permutation', true);											// czy $_GET('p')
	$orientation = $o;																			// aktualna orientacja
	$permutation = $p;																			// aktualna permutacja

}

// ----------------------------------------------------------------


if($mode == 'print')
{
 $algs = get_algs($min, $max-1, $cat_l, $uid);	
}
else
{
for($i=0;$i<count($tab);$i++)
$algs[] = get_alg($tab[$i], $cat_l, $uid);
}

$method='zb';																					// metoda
$chapter='zbll';																				// chapter
$get_imgcats_id = 'zbll';
?>