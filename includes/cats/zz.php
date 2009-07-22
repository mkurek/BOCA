<?php

$ch = $_GET['ch'];

if(!isSet($_GET['ch']) || $_GET['ch'] == '')
{
$smarty -> assign('level', 'zz_cat_choose');
$smarty -> assign('title', 'choose_zz_cat');
}

else
{
	  if($ch == 'a') include "includes/cats/zbll.php";

	  else
	  {
	  		//co robic
			$title_little=array();
	  		if(isSet($_GET['o']) && !isSet($_GET['p'])) $what = "choose_per";
	  		else if(isSet($_GET['o']) && isSet($_GET['p'])) $what = "choose_case";
	  		else $what = "choose_or"; 

			$o = intval($_GET['o']);
			if($o>7) $o=7;

			$p = intval($_GET['p']);
			if($p>6 || ($ch == 'd' && $o <7)) $p=6;
			if($ch == 'd' && $o == 7) $p = 4;
			
			$tab = array();
			$in_section = array();
			$algs = array();
			$sid = array();
			
			// wybór orientacji
			if($what == 'choose_or')
			{
			 			for($i=1;$i<473;$i+=72)
        				$tab[]=$i;
        				
        				for($i=1;$i<=7;$i++) $in_section[] = $i;
        				
   					if($ch == 'd') $perm = true;
   					else $perm = false;
   					
   					
   					if($mode == 'print')
  						{
  							$tab = array();  						
				 			if($ch == 'd')
				 			{
				 				for($i=0;$i<7;$i++)
				 				{
				 					if($i != 6){$min = $i*72+1+60; $max = $min+11;}
				 					else {$min = 465; $max=472;}
				 				
								 	for($j=$min;$j<=$max;$j++) $tab[]=$j;
								 }
				 				
						  }
						  
						  else
						  {
						  		for($i=5;$i<453;$i+=12)
								  for($j=$i;$j<=$i+3;$j++) $tab[] = $j;
						  	
						  		  $tab[]=459;
						  		  $tab[]=460;
						  		  $tab[]=461;
						  		  $tab[]=462;
						  		  $tab[]=469;
						  		  $tab[]=470;
						  		  $tab[]=471;
						  		  $tab[]=472;
						  }
						  
						  // przetwarzanie tytułów
						  if($ch == 'b')
						  {
						  $temp = $zz_b_title_little; 
						  $temp2 = $zz_b_title_little_h; 
  						  
  	 					   for($i=0;$i<7;$i++)
	  						for($j=0;$j<25;$j++)
	  					   {
				  							if($i != 6 && $temp[$j] != '') $title_little[$i*24+$j] = $temp[$j]; 				  	
	 		   							if($i == 6 && $temp2[$j] != '') $title_little[$i*24+$j] = $temp2[$j];
					      }
		     				$title_big = $zz_b_title_big;
						  }
		     				
		     				else
		     				{
		     					$title_big = $zz_d_title_big;		     				
		     					$title_little = $zz_d_full_title_little;
						   }
	 		  				
						  
						  
			         }	 
   					
   					$what_in_section = 'orientation';							// co się zmienia w section
	
						$title = 'choose_zz_or';									   // tytuł
						$file = 'cat';														// plik który ma być w linku({cat, file})
	
						$smarty -> assign('if_chapter', true);												// czy $_GET('ch')
						$smarty -> assign('if_subchapter', false);										// czy $_GET('sch')
						$smarty -> assign('if_orientation', true);										// czy $_GET('o')
						$smarty -> assign('if_permutation', $perm);										// czy $_GET('p')
	   
	   				//if($ch == 'd') $smarty ->assign('permutation', $permutation);				// jeśli wariant d -> permutacja 6
	   				
   					$image_cat = 'zbll';												// główne kategorie obrazków
						$imgcats = array('cube_oll', 'top_oll');				// description_img
   					
         }

			// -----------------------------------------


			//wybór permutacji
			if($what == 'choose_per')
			{
			 	  $min=($o-1)*72+1;
				  
				  if($ch == 'd')
				  {
	  			      if($o == 7) $min+=33;
	  			      else $min+=60;
	  			      $max = $min+1;
				  }
				  
				  else
				  {
				  		 if($o != 7) $max = $min+72;
				  		 else $max= $min+40;
				  }
			
				  for($i=$min;$i<$max;$i+=12)
				       $tab[] = $i;
						 
				  if($o == 7) $maks = 4;
				  else $maks = 6;
				  for($i=1;$i<=$maks;$i++) $in_section[] = $i;	 
						 
						 
					if($mode == 'print')
  					{
  						  					
			 			if($ch == 'd') {$what='choose_case'; $p=6;}
  					
  						else
  						{
  							// algi  						
  					 	 	 $tab=array();
							 if($o==7)
							 {
							 	$temp = array(437,449,459,469);							 
							 	for($i=0;$i<4;$i++)
							 	for($j=0;$j<4;$j++) $tab[]=$temp[$i]+$j;
							 }	  	
  							 
  							 else
  							 {
  							 	 							 
  							 	$start=5;
  							 	$end=$o*72;
  							 	for($i=0;$i<6;$i++)
  							 	{
  							 		$start=5;
									if($i == 5) $start=9; 	 						 	
  							 		for($j=0;$j<=3;$j++) $tab[]=(($o-1)*72)+$i*12+$start+$j;
  							 	}
							 }
  						
  						
							
						  $temp = $zz_b_title_little; 
						  $temp2 = $zz_b_title_little_h; 
  						  	
	  						for($j=0;$j<22;$j++)
	  					   {
				  							if($o != 7 && $temp[$j] != '') $title_little[$j] = $temp[$j]; 			  	
	 		   							if($o == 7 && $temp2[$j] != '') $title_little[$j] = $temp2[$j]; 
					      }
		     				$title_big = array(1=>$zz_b_title_big[(($o-1)*24)+1]);
			      	}
			      }	 
				  		 
              $orientation = $o;
              
				  $smarty-> assign('scig_cat', 'coll');
			
				  if($ch == 'd') $permutation = 6;							// jeśli wariant d -> permutacja 6
				  else
				  {
				  	  $what_in_section = 'permutation';								// co się zmienia w section  
			     }
			     
				  $title = 'choose_zz_per';										// tytuł
				  $file = 'cat';														// plik który ma być w linku ({cat, file})
				  
				  $smarty -> assign('if_chapter', true);													// czy $_GET('ch')
				  $smarty -> assign('if_subchapter', false);												// czy $_GET('sch')
				  $smarty -> assign('if_orientation', true);											// czy $_GET('o')
				  $smarty -> assign('if_permutation', true);											// czy $_GET('p')

				  $orientation = $o;													// aktualna orientacja
				  
				  if($mode == 'print')$image_cat = 'zbll';												// główne kategorie obrazków
				  else $image_cat = 'coll';
				  $imgcats = array('cube', 'top_pll');							// description_img
			
			
			}

			// ---------------------------------------------


			//wybór case'a
			if($what == 'choose_case')
			{
			 	 $min = ($o-1)*72 + ($p-1)*12 + 1;
				 $max = $min+12;
	
				 if($ch == 'b')
				 {
				  		  if($o != 7)
						  {
						  			 if($p == 6) $min+= 8;
									 else $min +=4;
									 $max = $min+4;
				        }
			
						  else 
						  {
						  		 	 if($p == 3)	$min +=2;
									 else if($p == 4) $min = $min;
									 else $min += 4;
									 $max = $min+4;	
                    }
				 }
				 
				 else
				 {			 
				    if($o == 7)
				 	 {		
				 		if($p==3) {$max = $min+8;}
						if($p==4) {$min-=4; $max = $min+8;}
    		       }
				 }
				 
				 for($i=$min;$i<$max;$i++)
			         $tab[] = $i;
   
   
   					if($mode == 'print')
  						{
				 			 // przetwarzanie tytułów
			             $title_big = array(1=>$zz_b_title_big[(($o-1)*24)+1]);
		      		  	 $tym2 = ($p-1)*4+1;
		                if($o != 7) $title_little = array(1=>$zz_b_title_little[$tym2]);
							 else $title_little=array(1=>$zz_b_title_little_h[$tym2]);
					  }
   
   			 // img_main == true		
			    $img_main = true;  
				 $top_img_cat = 'coll';
				 $top_img_cats = array('cube', 'top_pll');
			  
			  	 $title = 'choose_zz_case';										// tytuł
			  	 $file = 'case';															// plik który ma być w linku ({cat, file})
			  	 $sid = $tab;												// sid_array
	
				 $image_cat = 'zbll';													// główne kategorie obrazków
				 $imgcats = array('cube', 'top_pll');							// description_img
			
				 $smarty -> assign('if_chapter', true);													// czy $_GET('ch')
 			    $smarty -> assign('if_subchapter', false);												// czy $_GET('sch')
 			 	 $smarty -> assign('if_orientation', true);											// czy $_GET('o')
	  			 $smarty -> assign('if_permutation', true);											// czy $_GET('p')

				 $orientation = $o;													// aktualna orientacja
 			 	 $permutation =$p;													// aktualna orientacja
			
			
			}	
	  
	

	$algs = array();

	for($i=0;$i<count($tab);$i++)
       $algs[] = get_alg($tab[$i], $cat_l, $uid);


	$method = 'zz';														// metoda
	$chapter = $ch;													// chapter
	}
	
	
	$get_imgcats_id = 'zbll';
}
?>