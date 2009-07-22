<?php

$s_and_a_tab = array("R" => "L", "L" => "R", "U" => "D", "D" => "U", "F" => "B", "B" => "F");
$fru_tab = array("f" => 'z', 'r'=>'x', 'u'=>'y');

function is_a_s($alg)
{
	if(preg_match("/[SAsa]/", $alg)) return false;
	else return true;	
}

function is_w($alg)
{
  	if(preg_match("/[Ww]/", $alg)) return false;
	else return true;
}

function are_f_r_u($alg)
{
  	if(preg_match("/[fru]/", $alg)) return false;
	else return true;
  
}


function shit_delete($alg)
{
	$alg = trim($alg);
	$alg = str_replace(array("(", ")", "[", "]", "-", ".", ","), "", $alg);

	// sprawdzenie czy jest końcówka z JAC 
	if(substr(trim($alg), -1) == 's' && is_int(intval(substr($alg, -2, 1))) == true)
	{
		$start = stripos($alg, "q") - 2;
		$alg = trim(substr_replace($alg, ' ', $start));
	}

	// zamiana wszystkich cyfr != 2 na ''
	for($i=0;$i<10;$i++)
		if($i != 2)
			$alg = str_replace($i, "", $alg);

	return $alg;
}

function s_and_a_change($alg)
{
	global $s_and_a_tab;
	
	if(is_a_s($alg))  return $alg;

	for($i = 0;$i<strlen($alg);$i++)
	{
		if(substr($alg, $i, 2) == "s2" || substr($alg, $i, 2) == "2s" || substr($alg, $i, 2) == "a2" || substr($alg, $i, 2) == "2a") 
			$alg = trim(substr_replace($alg, "2 ".$s_and_a_tab[substr($alg, $i-1,1)].'2', $i, 2));

		else if(substr($alg, $i, 2) == "s'" || substr($alg, $i, 2) == "'s") 
			$alg = trim(substr_replace($alg, "' ".$s_and_a_tab[substr($alg, $i-1,1)], $i, 2));
			
		else if(substr($alg, $i, 1) == "s") 
			$alg = trim(substr_replace($alg, $s_and_a_tab[substr($alg, $i-1,1)]."'", $i, 2));
			
		else if(substr($alg, $i, 2) == "a'" || substr($alg, $i, 2) == "'a") 
			$alg = trim(substr_replace($alg, "' ".$s_and_a_tab[substr($alg, $i-1,1)]."'", $i, 2));
		
		else if(substr($alg, $i, 1) == "a") 
			$alg = trim(substr_replace($alg, $s_and_a_tab[substr($alg, $i-1,1)], $i, 2));
	}
	
	return $alg;
}

function w_notation_change($alg)
{
  	if(is_w($alg)) return $alg;
  
	for($i = 0;$i<strlen($alg);$i++)
	{
	  	$str3 = substr($alg, $i, 3);
	  	$str2 = substr($alg, $i, 2);
	  	$str1 = substr($alg, $i, 1);
	  
	  	$tmp = substr($alg, ($i-1),1);
	  
		if($str3 == "w2'"|| $str3 == "2w'"|| $str3 == "'2w"|| $str3 == "'w2") 
			$alg = trim(substr_replace($alg, strtolower($tmp)."2", ($i-1), 4));

		else if($str2 == "w'" || $str2 == "'w") 
			$alg = trim(substr_replace($alg, strtolower($tmp)."'", ($i-1), 3));
		
		else if($str2 == "w2" || $str2 == "2w") 
			$alg = trim(substr_replace($alg, strtolower($tmp)."2", ($i-1), 3));
			
		else if($str1 == "w" || $str1 == "w") 
			$alg = trim(substr_replace($alg, strtolower($tmp), ($i-1), 2));	
	}

	return $alg;
}

function f_r_u_change($alg)
{
  	global $fru_tab;
	$alg =  str_replace(array("´", "’", "‘", "2'", "'2", "Y", "X", "Z"), array("'", "'", "'", "2", "2", "y", "x", "z"), $alg);

	if(are_f_r_u($alg)) return $alg;

	$dl = strlen($alg);

	for($i=0;$i<$dl;$i++)
	{
   		if(substr($alg, $i, 1) == '(')
   		{
   		  	$k = $i;
  			while(substr($alg, $k, 1) != ')' && $k < ($i+5) && $k < $dl) $k++; 
       			$tmp = substr($alg, $i, $k-$i);
       			if($tmp == strtolower($tmp))
       				for($j = $i;$j<=$k;$j++)
       				{
       				  	$tmp = substr($alg, $j, 1);
       				  	if($tmp == '') continue;
		   			if(array_key_exists($tmp, $fru_tab)) $alg = substr_replace($alg, $fru_tab[$tmp], $j, 1);		
     				}
     		}
 	}

	return $alg;
}






// SZUKANIE RUCHOW PRZED
function find_pre($alg, $was, $poprz='', $ifu = true, $if_reg = false)
{
  	//if($if_reg == true) return array('', $alg);
  
	$pre = '';
	$ktory = count($poprz);	
   	$ile = 0;
   	   	
	if($was != 'eg' && $was != 'ortega_cp')
   	{
		if(($ktory == 0 || ($poprz[0] == 'y' && $ktory == 1)) && $ifu == true) $pattern = '/^[UXYZxyz]$/D';
		else $pattern = '/^[XYZxyz]$/D';
	}
	
	else
	{
		if($ktory < 2 && $poprz[0] != 'x' && $poprz[0] != 'z' && $poprz[1] != 'x' && $poprz[1] != 'z') 
		{	
			if($ifu) $pattern = '/^[UDXYZxyz]$/D';
			else $pattern = '/^[XYZxyz]$/D';
		}
		else $pattern = '/^[XYZxyz]$/D';	
	}
	
	if(preg_match($pattern, substr($alg, 0, 1)))
 	{
		$pocz = substr($alg, 0, 1); 	
 		if($pocz == 'U' && $was != 'zbf2l' && $was !='eg' && $was != 'ortega_cp') {$pocz = 'y';}
 		
	 	if(substr($alg, 1, 1) == "'") {$pre = $pocz."'"; $ile = 2;}
	 	else if(substr($alg, 1, 1) == '2') {$pre = $pocz.'2'; $ile = 2;}
		else {$pre = $pocz; $ile = 1;}	 
   	}

$alg = trim(substr_replace($alg, '', 0, $ile));

$tab = array($pre, $alg);

return $tab;	
} 

// SZUKANIE RUCHOW PO
function find_post($alg, $cat, $poprz, $ifu = true)
{
	$post = '';
	$size = count($poprz);
	
	if($cat == 'eg' || $cat == 'ortega_cp')
   	{
	     	if($size == 0) 
     		{
		     if($ifu)$pattern = '/[UDXYZxyz]/';
		     else $pattern = '/[XYZxyz]/';
		}  
 		else if($size == 1) 
	  	{ 		  
 			if(($poprz[0] == 'U' || $poprz[0]== 'y' || $poprz[0]=='Y' || $poprz[0]=='D') && $ifu == true) $pattern = '/[UDXYZxyz]/';	 	
 		 	else $pattern = '/[XYZxyz]/';	
        	}
        
	  	else if($size == 2)
        	{
      		 	if(($poprz[0] == 'U' || $poprz[0]== 'y' || $poprz[0]=='Y') && ($poprz[1] == 'U' || $poprz[1]== 'y' || $poprz[1]=='Y' || $poprz[0]=='D' || $poprz[1]=='D') && $ifu == true) $pattern = '/[UDXYZxyz]/';	 	
 		 	else $pattern = '/[XYZxyz]/';
	  	}
		  
	  	else $pattern = '/[XYZxyz]/';
	}
	
	else
	{
 		if($size == 0) 
		{	 
		 	if($ifu)$pattern = '/[UXYZxyz]/';
		 	else $pattern = '/[XYZxyz]/';
	 	}
	  	else if($size == 1) 
	  	{
 		 	if(($poprz[0] == 'U' || $poprz[0]== 'y' || $poprz[0]=='Y') && $ifu == true ) $pattern = '/[UXYZxyz]/';	 	
  		 	else $pattern = '/[XYZxyz]/';	
        	}
        
		  else if($size == 2)
        	{
      		 	if(($poprz[0] == 'U' || $poprz[0]== 'y' || $poprz[0]=='Y') && ($poprz[1] == 'U' || $poprz[1]== 'y' || $poprz[1]=='Y') && $ifu == true) $pattern = '/[UXYZxyz]/';	 	
 		 	else $pattern = '/[XYZxyz]/';
	  	}
		  
	  	else $pattern = '/[XYZxyz]/';
	}
	
	if(preg_match($pattern, substr($alg, -1, 1)))
 	{
	 	$post = substr($alg, -1, 1); 	
 	 	$alg = substr_replace($alg, '', -1);
 	}
	 
 	else if(preg_match("/['2]/", substr($alg, -1, 1)) && preg_match($pattern, substr($alg, -2, 1)))
 	{
 		$post = substr($alg, -2, 2);
	 	$alg = substr_replace($alg, '', -2);
 	}
	 	 
return array($alg, $post);	
} 


// ALG PRZEKAZYWANY DO FUNKCJI -> WYCHODZI ALG
function search_pre_post($alg, $cat, $ifu = true, $if_reg = false, $return_pre = false)
{
	$pre = '';
$k = 0;
$temp = array(' ','');
$poprz = array();
while($temp[0] != '' && $k<4)
{
	$temp = find_pre(trim($alg), $cat, $poprz, $ifu, $if_reg);
	$pre .= ' '.$temp[0];
	$poprz[] = substr($temp[0], 0, 1);
	$alg = $temp[1];
	$k++;
}

$temp = array('', ' ');
$post = '';
$k = 0;
$poprz = array();
while($temp[1] != '' && $k<4)
{
	$temp = find_post(trim($alg), $cat, $poprz, $ifu);
	$post = $temp[1].' '.$post;
	$poprz[] = substr($temp[1], 0, 1);
	$alg = $temp[0];
	$k++;	
}
	
	if($return_pre)return array(trim($pre), $alg);
	return $alg;
	
}

function delete_slices($alg, $cat)
{
  	if(!in_array($cat, array('eg', 'ortega_cp', 'ss'))) return $alg;
  	
	$alg =  str_replace(array("M2'", "S2'", "E2'", "M'2", "S'2", "E'2"), array('', '', '', '','', ''), $alg);
	$alg =  str_replace(array('M2', 'S2', 'E2'), array('', '', ''), $alg);
  	$alg =  str_replace(array("M'", "S'", "E'"), array('', '', ''), $alg);
  	$alg =  str_replace(array('M', 'S', 'E'), array('', '', ''), $alg);
  	
  	return $alg;
}



function up($alg)
{
  	$alg = str_replace(array("d", "r", "u", "l", "b", "f"), array("D", "R", "U", "L", "B", "F"), $alg);
  	/*
  	$lower = array("d", "r", "u", "l", "b", "f");
  		for($i = 0;$i<strlen($alg);$i++)
  			if(in_array(substr($alg,$i,1), $lower)) $alg = substr_replace($alg, strtoupper(substr($alg,$i,1)), $i, 1);
   	*/	
   	return $alg;
}

function up2($tab)
{
  	for($i = 0;$i<count($tab);$i++)
  		if(in_array(substr($tab[$i], 0, 1), array("d", "r", "u", "l", "b", "f"))) $tab[$i] = strtoupper($tab[$i]);
  	return $tab;
}


function obrobka($alg, $cat, $ifu = true, $if_reg=false, $get_pre = false)
{
  	//echo '$cat -> '.$cat.'<br />';
  	//if($cat == 'eg' || $cat == 'ss' || $cat == 'ortega_cp' || $cat == 'ortega_co') $alg = up($alg, $cat);
	return search_pre_post(delete_slices(w_notation_change(s_and_a_change(shit_delete(f_r_u_change($alg)))), $cat), $cat, $ifu, $if_reg, $get_pre);
}


?>
