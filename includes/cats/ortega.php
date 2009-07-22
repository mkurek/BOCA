<?php
$ch = $_GET['ch'];

$algs = array();
$sid = array();


if($ch == '') 										// wybor kategori ortegi
{
 		 $query = "SELECT `pre-moves`, `alg`, `post-moves`, `SID` FROM `portal_algs` WHERE SID IN(859, 853);";
 		 $result = query($query);
		 while($row = mysql_fetch_row($result)) $algs[] = stripslashes($row[0].$row[1].$row[2]);
		 
		 $smarty -> assign('level', 'ortega_cat_choose');
		 $title = 'choose_ortega_cat';								// tytuł
}

else if($ch == 'cp')								// wybor permutacji rogow
{
   $min = 853;
   $max = 858;
   
   $algs = get_algs($min, $max, $cat_l, $uid);
   
   for($i=$min;$i<=$max;$i++) $sid[] = $i;
  	  
	$title = 'choose_ortega_cp_case';								// tytuł
	$file = 'case';														// plik który ma być w linku ({cat, file})
	
	$imgcats = array('top_pll', 'down');							// description_img

	if($mode == 'print')
	{
	   $get_imgcats_id = 'ortega_cp';
	
	}

	
  $smarty -> assign('if_chapter', true);												// czy $_GET('ch')
  $chapter = 'cp';
  $smarty -> assign('if_subchapter', false);											// czy $_GET('sch')
  $smarty -> assign('if_orientation', false);											// czy $_GET('o')
  $smarty -> assign('if_permutation', false);											// czy $_GET('p')
	

}

else													// wybor orientacji
{

    $min=859;
    $max=864;
    
    for($i=0;$i<7;$i++)
    {
    	$algs[] = get_alg($min, $cat_l, $uid);
    	$sid[]=$min.','.$max;
    	if($mode == 'print') $temp[] = array($min, $max); 
		$min+=6;
    	if($i!=5)$max+=6;
    	else $max+=4;
	 }

   $title = 'choose_ortega_co_case';								// tytuł
	$file = 'case';														// plik który ma być w linku ({cat, file})
	$imgcats = array('cube_oll', 'top_oll');						// description_img


	if($mode == 'print')
	{
		$algs = array();	
		for($i=0;$i<count($temp);$i++)
		    $algs[] = get_alg($temp[$i], $cat_l, $uid);
	   $get_imgcats_id = 'ortega_co';
	}

  $smarty -> assign('if_chapter', true);												// czy $_GET('ch')
  $chapter = 'co';
  $smarty -> assign('if_subchapter', false);											// czy $_GET('sch')
  $smarty -> assign('if_orientation', false);											// czy $_GET('o')
  $smarty -> assign('if_permutation', false);											// czy $_GET('p')

}

$method = 'ortega';														// metoda
$image_cat = 'ortega';
?>