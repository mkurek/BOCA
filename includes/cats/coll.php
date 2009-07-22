<?php

if(isSet($_GET['o'])) $what = "choose_case";
else $what = "choose_or"; 


$tab = array();
$algs = array();

if($what == 'choose_or')
{
 			
    for($i=1;$i<473;$i+=72)
	      $tab[]=$i;

    for($i=1;$i<=7;$i++) $in_section[] = $i;


	 $what_in_section = 'orientation';
	 $title = 'choose_coll_or';
	 $file = 'cat';
    $imgcats = array('cube_oll', 'top_oll');

	 $smarty -> assign('if_chapter', false);												// czy $_GET('ch')
	 $smarty -> assign('if_subchapter', false);											// czy $_GET('sch')
	 $smarty -> assign('if_orientation', true);											// czy $_GET('o')
	 $smarty -> assign('if_permutation', false);											// czy $_GET('p')
	  


    if($mode == 'print')
	 {
	      for($i=1;$i<456;$i+=12)
					$algs[] = get_alg(array($i, $i+11), $cat_l, $uid);		  
		   $algs[] = get_alg(array(457, 464), $cat_l, $uid);
			$algs[] = get_alg(array(465, 472), $cat_l, $uid);
    		
    		$title_big = $colls_title;
	 }

}

else
{

 	 $o = $_GET['o'];

	 $min=($o-1)*72+1;
	 if($o != 7) $max = $min+72;
	 else $max= $min+40;
	
	 for($i=$min;$i<$max;$i+=12)
        $tab[] = $i;
	
    $k=0;	  
	 for($i=$min;$i<$max;$i+=12)
	 {
				if($o == 7 && $k==2) $sid[] = '457,464';
				else if($o == 7 && $k==3) $sid[] = '465,472';
				else $sid[] = $i.','.($i+11);	
				$k++;  						
    }
   
   
    $img_main = true;
    $top_img_cat = 'oll';
    $top_img_cats = array('top_oll');
	 
	 $orientation = $o;		  
    $title = 'choose_coll_case';														// tytuł
	 $file = 'case';																		// plik który ma być w linku ({cat, file})
	 $imgcats= array('cube', 'top_pll');											// description_img
	 
	 $smarty -> assign('if_orientation', true);									// czy $_GET('o')
	 $smarty -> assign('orientation', $o);

	 if($mode == 'print')
	 {
	     if($o != 7)
		  {
		  		  $start = ($o-1)*72+1;	
				  for($i=$start;$i<$start+72;$i+=12)
					   $algs[] = get_alg(array($i, $i+11), $cat_l, $uid);	
		  }	  
		  else
		  {
		  		  $algs[] = get_alg(array(433, 444), $cat_l, $uid);
				  $algs[] = get_alg(array(445, 456), $cat_l, $uid);	
				  $algs[] = get_alg(array(457, 464), $cat_l, $uid);
				  $algs[] = get_alg(array(465, 472), $cat_l, $uid);
		  }
    
	 	  $title_big = array(1=>$colls_title[($o-1)*6+1]);
	 	  $top_img_cats = array('cube_oll', 'top_oll');
	 }

}


$image_cat = 'coll';

if($mode != 'print'){
for($i=0;$i<count($tab);$i++)
$algs[] = get_alg($tab[$i], $cat_l, $uid);
}


$get_imgcats_id = 'coll';																				// metoda

?>