<?php 
session_start();
ini_set('display_errors', 1);
error_reporting(ALL);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
      <title>Untitled</title>
</head>

<body>
 <pre> 
<?php 

function skroc($pre_add, $u=false, $y=false, $y2=false, $d=false)
{
  	$rc = new RubiksCube;
  	if(($u === false && $d === false && $y === false && $y2 === false) || trim($pre_add) == '') return $pre_add;
	$was = false;  
	$was2 = false;
	
	$tab = array("D2"=>$d, "D"=>$d, "D'"=>$d, "U'"=>$u, "U"=>$u, "U2"=>$u, "y"=>$y, "y'"=>$y, "y2"=>$y2);
		
  	$moves = $rc -> parse($pre_add);
	$search = array('U', 'D');
	$znak = substr($moves[0],0,1);
  	if($tab[$moves[0]] === true) $tmp = array_shift($moves);
  	
	return implode(' ', $moves);
}


//echo '$query: SELECT * FROM portal_situations_temp l INNER JOIN portal_situations_temp r ON l.hash = r.hash AND l.ID != r.ID AND l.SID = r.SID<br /><br />';


include "includes/headers.php";
include "getsituation_new.php";
include "obrobka.php";

$tab1 = array("");
$tab2 = array("", "y", "y'", "y2");
$tab3 = array("", "y", "y'", "y2", "x", "x'", "x2", "z", "z'", "z2", "y' x", "y2 x", "y x", "y' x'", "y x'", "y2 x'", "x' y", "x y", "x2 y", "y2 z", "y2 z'", "y' z'", "y' z", "y' z2");

$post1 = array("", "U", "U'", "U2", "D", "D'", "D2", "R", "R'", "R2", "L", "L'", "L2", "F", "F'", "F2", "B", "B'", "B2");
$pre_tab = array("", "U", "U'", "U2");
$d_tab = array("", "D", "D'", "D2");
$restricted = array(""=>array("U", "D"), "y"=>array("U", "D"), "x"=>array("R", "L"), "z"=> array("F", "B"));
$restricted_matter = array(1066,1067);
//$sids = array(1,460,1070,1111);
$sids = array(1269);
$no_invs = array(875, 876, 879, 880, 881, 883, 888, 889, 890, 891, 892, 893);
//var_dump($restricted1);

for($i=1;$i<=1396;$i++)
{
  if(!in_array($i, $sids)) continue;
  
  if($i > 1058 && $i < 1296)$cube = new PocketCube;
  else $cube = new RubiksCube;
  // pobieranie wzorca
  $query = "SELECT `alg` FROM `portal_patterns` WHERE SID=$i;";
  $result = query($query);
  $row = mysql_fetch_row($result);
  $alg = f_r_u_change($row[0]);
  
  // wstępne założenia
  $cat = 'zbll';
  $if_pre = true;
  $znoszenie = false;			// znoszenie pre-moves (np. U y' = '')
  $znoszenie2 = false;			// znoszenie pre-moves na 2x2 (np. U y' = D)
  $znoszenie3 = false;
  $pre = $pre_tab;
  $inv = true;
  $end = array("");
  $mode = "normal";
  $post_regrip = array("");
  $no_inv_pre = array("");
  $u_no_matter = false;		// gdy zamiana rogów po skosie na 2x2 -> ruchy U2, D2 nie mają znaczenia
  $d_no_matter = false;
  $y2_no_matter = false;
  $y_no_matter = false;
  
  // kategorie -> zakres, nazwy, obroty, czy pre_moves i oborty "znoszą się"
  if($i <= 472) 				// zbll -> wszystkie pre, pre znoszą się
  {
    	$cat = 'zbll'; 
    	$tab = $tab3; 
    	$znoszenie = true;
    	if(in_array($i, array(459,460,469,470,471,472))) {$y2_no_matter = true;}
  }				
  else if($i > 472 && $i <= 774) 		// zbf2l -> pre moves: {'', 'y', 'y'', 'y2'}
  {
    	$cat = 'zbf2l'; 
    	$tab = $tab2;
  }
  
  else if($i > 815 && $i <= 872) 		// oll
  {
    	$cat = 'oll'; 
    	$tab = $tab2; 
    	$pre = array("");
  }
  
  else if($i > 872 && $i <= 893) 		// pll -> wszystkie pre, pre znoszą się, niektóre pll'e -> nie korzystamy z inwersji
  {
    	$cat = 'pll'; 
    	$tab = $tab3; 
    	$znoszenie = true; 
    	if(in_array($i, $no_invs)) 
	{
 		$inv = false;
 		$no_inv_pre = $pre_tab;
 		$pre = array("");
 	}
 	if($i == 875 || $i == 888 || $i == 889) $y_no_matter = $y2_no_matter = true;
 	if(in_array($i, array(876, 879))) $y2_no_matter = true;
  }
  
  else if($i > 914 && $i <= 1018) 		// cls -> jak w zbf2l
  {
    	$cat = 'cls'; 
    	$tab = $tab2;
    	if($i == 1012) $y2_no_matter = true;
  }
  
  else if($i > 1065 && $i <= 1071) 		// ortega_cp -> wszystkie obroty, brak inwersji, częściowe znoszenie, ruchy i obroty przed i po algu
  {
    	$cat = 'ortega_cp'; 
    	$tab = $tab3; 
  	$end = $d_tab; 
    	if($i < 1068 || $i==1070 || $i == 1071) $znoszenie = true;
  	else $znoszenie2 = true;  
    	$inv = false; 
    	$post_regrip = $tab3; 
    	$mode = "keep_reg"; 			// -> zachowanie obrotów po algu
    	$no_inv_pre = $pre_tab;
    	if($i == 1069 ) $u_no_matter = true;
    	if($i== 1066 || $i == 1071) $d_no_matter = true;
    	if($i == 1067 || $i == 1070) $y_no_matter = $y2_no_matter = true;
  }
    
  else if($i > 1071 && $i <= 1191) 		// eg -> jak ortega_cp (oprócz obrotów warstwą po algu)
  {
    	$cat = 'eg'; 
    	$tab = $tab3; 
 	$no_inv_pre = $pre_tab; 
    	if($i < 1112 || $i > 1151) {$znoszenie = true; $d_no_matter = true;}
	else $znoszenie2 = true;

    	$post_regrip = $tab3; 
    	if($i == 1111 || $i == 1191) $y2_no_matter = true;
   
    	$mode = "keep_reg";
    	//if($i > 1151) $d2_no_matter = true;
  }
  
  else if($i > 1191 && $i <= 1295) 		// ss -> brak obrotów
  {
    	$cat = 'ss'; 
	$tab = $tab1;
	$post_regrip = $tab3;
	$mode = "keep_reg";
  } 

  else if($i > 1295 && $i <= 1324)
  {
    	$cat = 'ell';
    	$tab = $tab3; 
    	$znoszenie = true;
    	if(in_array($i, array(1297, 1298, 1299, 1301, 1302, 1303, 1306, 1307, 1308))) {$y2_no_matter = true;}
    	if($i == 1299 || $i == 1302 || $i == 1298) $y_no_matter = true;
  }
  
  else if($i > 1324 && $i <= 1369 )
  {
    	$cat = 'cll';
    	$tab = $tab2;
    	$znoszenie = true;
    	if(in_array($i, array(1363, 1364, 1369))) {$y2_no_matter = true;}
    	if($i == 1369) $y_no_matter = true;
  }
  
  else if($i > 1369 && $i <= 1396)
  {
    	$cat = 'f2ll';
    	$tab = $tab2;
  }

  else if($i > 893 && $i <= 914) {$cat = 'els'; continue;}
  else if($i > 774 && $i <= 815) {$cat = 'f2l'; continue;}
  else if($i > 1018 && $i <= 1058) {$cat = 'coll'; continue;}
  else if($i > 1058 && $i <= 1065) {$cat = 'ortega_co'; continue;}
    
  // pobieranie inwersji algu
  if($inv) $alg = implode(" ",$cube -> getAlgorithmInverse($cube->parse($alg)));
  
  
  for($j = 0;$j<count($tab);$j++)						// pre1_x: y, y'...
  {
    	$regrip = $tab[$j];
	$regrip_inv = implode(" ", $cube-> getAlgorithmInverse($cube -> parse($tab[$j])));
	 	
    	for($k = 0;$k<count($pre);$k++)						// pre2_x: U, U'...
    	{
    	  	$pre2_1 = trim($pre[$k]);
		$pre2_2 = trim(implode(' ', $cube -> getAlgorithmInverse($cube -> parse($pre[$k]))));
    	  
    	  	for($l = 0;$l<count($no_inv_pre);$l++)				// gdy nie korzystamy z inwersji -> pre moves
     	  	{
     	  	  	for($m = 0;$m<count($post_regrip);$m++)			// obroty po algu - działają tylko z $mode="keep_reg"
     	  	  	{
     				$temp = trim($tab[$j].$no_inv_pre[$l].$alg.$pre[$k].$post_regrip[$m]);
     				//echo '$temp: '.$temp.'<br />';
		     		//$temp = $tab[$j].$alg;
				
				// pobieranie przejścia/stanu kostki
				$elems = trim($cube -> getElemsName($temp, $mode, $cat, true, false));		
				//echo 'elems: '.$elems.'<br />';				
		
				$query2 = "SELECT * FROM `portal_situations` WHERE SID=$i AND `hash`='$elems';";
				/*
				if(mysql_num_rows(query($query2)) > 0) 
				{
				  //echo 'tab: '.$tab[$j].' ; no_inv_pre: '.$no_inv_pre[$l].' ; pre: '.$pre[$k].' ; post_regrip: '.$post_regrip[$m].' -> było<br />';
				  continue;
				}
				*/
				$pre_add = trim($regrip_inv);
				
				
				if($inv === true && trim($post_regrip[$m]) != '')	// jeśli obrót po nie jest pusty -> koniunkcja obrotów -> krótki obrót
		  		{
		      			$tmp = $pre_add.$post_regrip[$m];
		      			$tmp = trim($cube -> getElemsName($tmp, "keep_reg", $cat, true, false));
		      			$query = "SELECT `pre` FROM `portal_regrips` WHERE `pre_end`='$tmp';";
		      			$result = query($query);
		      			$row = mysql_fetch_row($result);
      					if(mysql_num_rows($result) > 0) $pre_add = stripslashes($row[0]);	
		    		}
				
				if($inv)			// jeśli korzystamy z inwersji -> wstępne generowanie pre-moves
				{
		    			$pre_add = trim(implode(" ", $cube -> parse($pre2_1.$pre_add)));
		 	 	}
				
				else
				{
		    			$no_inv_pre_inv = implode(" ", $cube-> getAlgorithmInverse($cube -> parse($no_inv_pre[$l])));
		    			$pre_add = trim(implode(' ', $cube ->parse($no_inv_pre_inv.$regrip_inv)));
		  		}
				
				
				if($znoszenie)		// jeśli pre-moves znoszą sie -> pobieranie z SQL skróconej wersji
				{	
		  			$tmp = addslashes($pre_add);
   					$query2 = "SELECT `pre2` FROM `portal_pre_moves` WHERE `pre`='$tmp';";
    					$result = query($query2);
	  				$row = mysql_fetch_row($result);
   					if(mysql_num_rows($result) > 0) $pre_add = stripslashes($row[0]);
				}
			
				else if($znoszenie2)	// jeśli kość to 2x2 i ruchy pre{D} mają znaczenie (np. U2 y2 -> D2)
				{
		    			$tmp = addslashes($pre_add);
   					$query2 = "SELECT `pre2` FROM `portal_pre_moves2` WHERE `pre`='$tmp';";
    					$result = query($query2);
	  				$row = mysql_fetch_row($result);
   					if(mysql_num_rows($result) > 0) $pre_add = stripslashes($row[0]);
		  		}
  		
		  		
				if($y_no_matter == true || $y2_no_matter == true || $u_no_matter == true || $d_no_matter == true)$pre_add = skroc($pre_add, $u_no_matter, $y_no_matter, $y2_no_matter, $d_no_matter);  
				    		  		
				$pre_add = addslashes($pre_add);
			 	
			 	//$query = "INSERT INTO `portal_situations` VALUES (NULL, $i, '$pre_add', '$elems');"; 
 				$query = "INSERT INTO `portal_situations` VALUES(NULL, $i, '$pre_add', '$elems');";
			 	//$result = query($query);
	  			//echo $query.'<br />';
	  			echo '$i: '.$i.";\tpre_add: ".$pre_add.";\telems: ".$elems."\t\tpost_regrip: ".$post_regrip[$m].'<br />';
      				
	 		//echo '----<br />';
	  		}
 			//echo '<br />';
 		}
 		//echo '<br />';
   	}
   	//echo '<br />';
  }
  	//$query = substr_replace(trim($query), ';', -1, 1);
	//$result = query($query);
	//echo $i.' -> ok<br />';

}


?>
 </pre>
</body>
</html>
