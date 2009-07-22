<?php

include_once "includes/headers.php";
include_once "getsituation_new.php";

function tree_gen2($sid)    								// sid -> liczba
{
  	include_once "includes/arrays.php";
	//echo $sid;
	
	$method = '';
	$chapter = '';
	$subchapter = '';
	$orientation = '';
	$permutation = '';
	$name = '';
	
	if($sid > 0 && $sid < 473)				// zbll
	{
		$method = 1; 
		$chapter = 'zbll';
		
		$orientation = ceil($sid/72);
		$permutation = ceil(($sid-($orientation-1)*72)/12);
	
		if($orientation == 7 && $sid > 464) $permutation = 4;
	}
	
	if($sid > 472 && $sid < 775)				// zbf2l
	{
		$method = 1;
		$chapter = 'zbf2l';
		if($sid < 761) $subchapter = ceil(($sid-472)/16);
		else if($sid > 760 && $sid < 763) $subchapter = 19;
		else if($sid > 762 && $sid < 769) $subchapter = 20;
		else $subchapter = 21;	
	}
	
	if($sid > 774 && $sid < 816)				// f2l
	{
   		$method = 2;
   		$chapter = 'f2l';
 	}
	
	if($sid > 815 && $sid < 873)				// oll
	{
		$method = 2;
		$chapter = 'oll';
		if($sid < 824)$subchapter = 'd';			// dott
		else if($sid > 823 && $sid < 851) $subchapter = 'l';	// L
		else if($sid > 850 && $sid < 866) $subchapter = 'b';	// bar
		else $subchapter = 'c'; 				// cross
	}
	
	if($sid > 872 && $sid < 894)
	{
		$method = 2;
		$chapter = 'pll';
		//$if_case = true;
		$name = $pll_titles[$sid - 873];
	}
	
	if($sid > 893&& $sid < 915)
	{
		$method = 3;
		$chapter = 'els';
	}
	
	if($sid > 914 && $sid < 1019)
	{
		$method = 3;
		$chapter = 'cls';
		
		if($sid < 942) $subchapter = 'm';
    		else if($sid > 941 && $sid < 969) $subchapter = 'p';
    		else if($sid > 968 && $sid < 996) $subchapter = 'o';
    		else if($sid > 995 && $sid < 1004) $subchapter = 'i';
    		else $subchapter = 'im';
	}
	
	
	if($sid > 1018 && $sid < 1059)
	{
		$method = 4;
		$orientation = ceil(($sid-1018)/6);
	}
	
	if($sid > 1058 && $sid < 1066)
	{
		$method = 5;
		$chapter = 'co';	
	}
	
	
	if($sid > 1065 && $sid < 1072)
	{
		$method = 5;
		$chapter = 'cp';
	}
	
	if($sid > 1071 && $sid < 1192)
	{
		
		$method = 6;
		
		if($sid < 1112) $chapter = 'n';
		else if($sid > 1151) $chapter = 'd';
		else $chapter = 's';
		
		if($chapter == 'n') $minus = 1071;
		else if($chapter == 's') $minus = 1111;
		else $minus = 1151;
		
		$subchapter = intval(ceil(($sid-$minus)/6));
	}
	
 	if($sid > 1191 && $sid < 1296)
	{
 		$method = 7;

    		if($sid < 1219) $chapter = 'm';
    		else if($sid > 1218 && $sid < 1246) $chapter = 'p';
    		else if($sid > 1245 && $sid < 1273) $chapter = 'o';
    		else if($sid > 1272 && $sid < 1281) $chapter = 'i';
    		else $chapter = 'im';	
 	}
	
	return array($method, $chapter, $subchapter, $orientation, $permutation, $name);
}

function zbll_to_coll()
{
  for($i = 1;$i<=472;$i++)
  {
  	if($i < 465) $temp = ceil($i/12)+1018;
  	else $temp = 1058;
  	
  	$query = "INSERT INTO `portal_zbll_to_coll` VALUES($i, $temp);";
  	$result = query($query);
  	
  }
  return true;
}

function zbf2l_to_els()
{
  echo '<pre>';
  $rc = new RubiksCube;
  $post = array("", "U", "U'", "U2");
  for($i = 473;$i<=774;$i++)
  {
    	//echo '1.1; ';
    	$query = "SELECT `alg` FROM `portal_patterns` WHERE SID=$i;";
  	$result = query($query);
  	$row = mysql_fetch_row($result);
  	$temp = $row[0];
  	//echo '1.2; ';
  	for($j = 0;$j<count($post);$j++)
  	{
  		$alg = implode(" ",$rc -> getAlgorithmInverse($rc->parse($post[$j].$temp)));
  		
    		$elems = trim($rc -> getElemsName($alg, "reverse", 'els'));
    		//echo '$i = '.$i."\talg = ".$alg."\tpost = ".$post[$j]."\telems = ".$elems.'<br />';
    		$query = "SELECT SID FROM `portal_temp_els` WHERE hash='$elems'";
    		$result = query($query);
    	
   		if(mysql_num_rows($result) > 0)
    		{
    		  	$post2 = addslashes($post[$j]);
	    		$row = mysql_fetch_row(query($query));
    			$sid = $row[0];
    			$query = "INSERT INTO `portal_zbf2l_to_els` VALUES ($i, $sid, '$post2');";
    			$result = query($query);
    			echo '$i = '.$i.' -> ok<br />';
			    break;
    		}
    		if($j == 3) echo '$i = '.$i.' -> nie pasi<br />';
    		
    	}
  }
  echo '</pre>';

  return true;
}

function oll_to_els()
{
  echo '<pre>';
  echo '1; ';
  $rc = new RubiksCube;
  $post = array("", "U", "U'", "U2");
  echo '2; ';
  for($i = 816;$i<=872;$i++)
  {
    	//echo '1.1; ';
    	$query = "SELECT `alg` FROM `portal_patterns` WHERE SID=$i;";
  	$result = query($query);
  	$row = mysql_fetch_row($result);
  	$temp = $row[0];
  	//echo '1.2; ';
  	for($j = 0;$j<count($post);$j++)
  	{
  		$alg = implode(" ",$rc -> getAlgorithmInverse($rc->parse($post[$j].$temp)));
  		
    		$elems = trim($rc -> getElemsName($alg, "reverse", 'els'));
    		//echo '$i = '.$i."\talg = ".$alg."\tpost = ".$post[$j]."\telems = ".$elems.'<br />';
    		$query = "SELECT SID FROM `portal_temp_els` WHERE hash='$elems'";
    		$result = query($query);
    	
   		if(mysql_num_rows($result) > 0)
    		{
    		  	$post2 = addslashes($post[$j]);
	    		$row = mysql_fetch_row(query($query));
    			$sid = $row[0];
    			$query = "INSERT INTO `portal_oll_to_els` VALUES ($i, $sid, '$post2');";
    			$result = query($query);
    			echo '$i = '.$i.' -> ok<br />';
			    break;
    		}
    		if($j == 3) echo '$i = '.$i.' -> nie pasi<br />';
    		
    	}
  }
  echo '</pre>';

  return true;
}

function cls_to_ss()
{
  	for($i = 915;$i<=1018;$i++)
  	{
		$query = "INSERT INTO `portal_cls_to_ss` VALUES($i, $i+277);"; 
		$result = query($query);  
   	}
   	return true;
}

function eg_to_ortega_co()
{
   echo '<pre>';
   echo '1; ';
  $pc = new PocketCube;
  echo '2; ';
  $post = array("", "U", "U'", "U2");
  for($i = 1072;$i<=1191;$i++)
  {
    	//echo '1.1; ';
    	$query = "SELECT `alg` FROM `portal_patterns` WHERE SID=$i;";
  	$result = query($query);
  	$row = mysql_fetch_row($result);
  	$temp = $row[0];
  	//echo '1.2; ';
  	
	$alg = implode(" ",$pc -> getAlgorithmInverse($pc->parse($temp)));
	$elems = trim($pc -> getElemsName($alg, "reverse", 'ortega_co'));
	
	//echo '$i = '.$i."\talg = ".$alg."\tpost = ".$post[$j]."\telems = ".$elems.'<br />';
	$query = "SELECT SID FROM `portal_temp_ortega_co` WHERE hash='$elems'";
	$result = query($query);
    	
	if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_row($result);
		$sid = $row[0];
		
		$query = "INSERT INTO `portal_eg_to_ortega_co` VALUES ($i, $sid);";
		$result = query($query);
		echo '$i = '.$i.' -> ok; sid -> '.$sid.'<br />';
 		continue;
	}
    	echo '$i = '.$i.' -> nie pasi<br />';
    		
    	
  }
  echo '</pre>';

  return true;
  
  
}

function eg_to_ss()
{
   echo '<pre>';
   
  $pc = new PocketCube;
  
  $post = array("", "U", "U'", "U2");
  for($i = 1072;$i<=1191;$i++)
  {
    	//echo '1.1; ';
    	$query = "SELECT `alg` FROM `portal_patterns` WHERE SID=$i;";
  	$result = query($query);
  	$row = mysql_fetch_row($result);
  	$temp = $row[0];
  	//echo '1.2; ';
  	
	$alg = implode(" ",$pc -> getAlgorithmInverse($pc->parse($temp)));
	$elems = trim($pc -> getElemsName($alg, "reverse", 'ss'));
	
	//echo '$i = '.$i."\talg = ".$alg."\tpost = ".$post[$j]."\telems = ".$elems.'<br />';
	$query = "SELECT SID FROM `portal_temp_ss` WHERE hash='$elems'";
	$result = query($query);
    	
	if(mysql_num_rows($result) > 0)
	{
		$row = mysql_fetch_row($result);
		$sid = $row[0];
		
		$query = "INSERT INTO `portal_eg_to_ss` VALUES ($i, $sid);";
		$result = query($query);
		echo '$i = '.$i.' -> ok; sid -> '.$sid.'<br />';
 		continue;
	}
    	echo '$i = '.$i.' -> nie pasi<br />';
    		
    	
  }
  echo '</pre>';

  return true;
  
  
}


function fill_ortega_temp()
{
  	$tab = array(1072, 1078, 1084, 1090, 1096, 1102, 1108);
  	
  	$pc = new PocketCube;
  	$k = 1059;
  	for($i = 0;$i<count($tab);$i++, $k++)
  	{
  	  	$query = "SELECT `alg` FROM `portal_patterns` WHERE SID=$tab[$i];";
  		$result = query($query);
  		$row = mysql_fetch_row($result);
  	  	$alg = implode(" ",$pc -> getAlgorithmInverse($pc->parse($row[0])));
		$elems = trim($pc -> getElemsName($alg, "reverse", 'ortega_co'));
     		$query = "INSERT INTO `portal_temp_ortega_co` VALUES(NULL, $k, '$elems');";
     		$result = query($query);
   	}
}


function fill_ss_temp()
{
  	$pc = new PocketCube;
  	$k = 1289;
  	for($i = $k;$i<=1295;$i++)
  	{
  	  	$query = "SELECT `alg` FROM `portal_patterns` WHERE SID=$i;";
  		$result = query($query);
  		$row = mysql_fetch_row($result);
  	  	$alg = implode(" ",$pc -> getAlgorithmInverse($pc->parse($row[0])));
		$elems = trim($pc -> getElemsName($alg, "reverse", 'ss'));
     		$query = "INSERT INTO `portal_temp_ss` VALUES(NULL, $i, '$elems');";
     		$result = query($query);
   	}
}


function zbf2l_to_f2l()
{
  
	for($i = 473;$i<=774;$i++)
	{
		if($i > 472 && $i < 761) $temp = floor(($i-473)/8)+775;			
		else if($i == 761 || $i == 762) $temp = 811;									// |
		else if($i >= 763 && $i <= 766) $temp = 812;									// |		f2l
		else if($i == 767 || $i == 768) $temp = 813;									// |
		else if($i >= 769 && $i <= 772) $temp = 814;									// |
		else if($i == 773 || $i == 774) $temp = 815;									// /
	
		$query = "INSERT INTO `portal_zbf2l_to_f2l` VALUES ($i, $temp);";
		$result = query($query);
		//echo $i.' -> '.$temp.'<br />';
	}
	
	return true;
}

function change_algs_to_no_regrip()
{
  	$cube = new RubiksCube;
  	for($i = 1;$i<=1295;$i++)
  	{
     		$query = "SELECT * FROM `portal_patterns` WHERE SID = $i;";
     		$result = query($query);
     		$row = mysql_fetch_assoc($result);
     		
     		$alg = $row["alg"];
     		$alg = addslashes(implode(' ', $cube -> parse(implode(' ', $cube-> parse2($alg)))));
     		$query = "UPDATE `portal_patterns` SET alg='$alg' WHERE SID=$i;";
     		$result= query($query);
   	}
  return true;
}

function show_all_patterns()
{
  echo '<pre>';
  for($i = 1060;$i<=1200;$i++)
  {
    if($i < 1059) $cat = "cube";
    else $cat = "eg/cube";
    
    $query = "SELECT * FROM `portal_patterns` WHERE SID=$i;";
    $row = mysql_fetch_assoc(query($query));
    echo $i."\t<img src=\"scig/scig.php?desc=portal/$cat&data=".$row["alg"]."\" /><br /><br />";
    
  }
  echo '</pre>';
}

function add_pre_moves()
{
	$rc = new RubiksCube;
  	$tab3 = array("", "y", "y'", "y2", "x", "x'", "x2", "z", "z'", "z2", "y' x", "y2 x", "y x", "y' x'", "y x'", "y2 x'", "x' y", "x y", "x2 y", "y2 z", "y2 z'", "y' z'", "y' z", "y' z2");	
	$pre = array("", "U", "U'", "U2");
  
  	for($i = 0;$i<count($tab3);$i++)
  	{
	    	$inv = implode(" ", $rc -> getAlgorithmInverse($rc -> parse($tab3[$i])));	
	    	for($j=0;$j<count($pre);$j++)
		{
  		  	$add = addslashes(trim(implode(" ", $rc -> parse($pre[$j].$inv))));
  		  	
  		  	$query = "SELECT * FROM `portal_pre_moves` WHERE pre='$add';";
  		  	$result = query($query);
  		  	if(mysql_num_rows($result) > 0 ) continue;
  		  	
      			$query = "INSERT INTO `portal_pre_moves` VALUES (NULL, '$add', '$add');";
      			$result = query($query);
      		
    		}
  	}
  return true;
}

function show_pre_moves()
{
	$query = "SELECT * FROM `portal_pre_moves`;";
     	$result = query($query);
     	$i = 1;
     	echo '<pre>';
	     while($row = mysql_fetch_assoc($result))
   	{
      		echo $i."\t".'<img src="scig/scig.php?desc=portal/cube&data='.$row["pre"].'" />'."\t".'<img src="scig/scig.php?desc=portal/cube&data='.$row["pre2"].'" /><br /><br />';
		$i++;
    	}
  	echo '</pre>';
  	return true;
}

function add_zz()
{
  	$ch = 'b';
	$tab = array();

	for($o = 1;$o<8;$o++)
	{
  		for($p = 1;$p<7;$p++)
  		{	
     			if($o == 7 && $p > 4) continue;
			$min = ($o-1)*72 + ($p-1)*12 + 1;
	 		$max = $min+12;
			if($o != 7)
			{
 				if($p == 6) $min+= 8;
	 			else $min +=4;
	 			$max = $min+4;
     			}
			
			else 
			{
 				if($p == 3) $min +=2;
	 			else if($p == 4) $min = $min;
	 			else $min += 4;
	 			$max = $min+4;	
    			}
		 
 			for($i=$min;$i<$max;$i++)
   				$tab[] = array("id"=>$i, "or"=>$o, "per"=>$p);

		}
	}

	$b = $tab;

	$ch = 'd';
	$tab = array();


	for($o = 1;$o<8;$o++)
	{
  		if($o < 7) $p = 6;
  		else $p = 4;
		$min = ($o-1)*72 + ($p-1)*12 + 1;
	 	$max = $min+12;
		if($o == 7) {$min-=4; $max = $min+8;}
				 
 		for($i=$min;$i<$max;$i++)
   			$tab[] = array("id"=>$i, "or"=>$o, "per"=>$p);

	
	}

	$d = $tab;


	for($i=0;$i<count($b);$i++)
	{
  		$prev = "''";
  		$next = "''";
  		$id = $b[$i]["id"];
  		if($i != 0)$prev = $b[$i-1]["id"];
  		if($i != (count($d)-1))$next = $b[$i+1]["id"];

  		$query = "INSERT INTO portal_prev_next VALUES(NULL, $id, 8, 'd', $prev, $next);";
  		$result = query($query);
  	
  		$or = $b[$i]["or"];
  		$per = $b[$i]["per"];
  
  		$query = "INSERT INTO `portal_cats_sids` VALUES(NULL, $id, 8, 'd', '', $or, $per, '')";
  		$result = query($query);
	}


	// d
	for($i=0;$i<count($d);$i++)
	{
  		$prev = "''";
  		$next = "''";
  		$id = $d[$i]["id"];
  		if($i != 0)$prev = $d[$i-1]["id"];
  		if($i != (count($d)-1))$next = $d[$i+1]["id"];

  		$query = "INSERT INTO portal_prev_next VALUES(NULL, $id, 8, 'd', $prev, $next);";
  		$result = query($query);
  	
  		$or = $d[$i]["or"];
  		$per = $d[$i]["per"];
  
  		$query = "INSERT INTO `portal_cats_sids` VALUES(NULL, $id, 8, 'd', '', $or, $per, '')";
  		$result = query($query);

	
	}
  
  
  	return true;
}


function add_pre_next()
{
  	$no_prev = array(1,473,775,816,873,894,915,1019,1059,1066,1072,1192, 1296, 1325, 1370);
  	$no_next = array(472,774,815,872,893,914,1018,1058,1065,1071,1191,1295, 1324, 1396);

  	$chapter = "''";
  
  	for($i=1;$i<=1396;$i++)
	{
  		$query = "SELECT method FROM portal_cats_sids WHERE SID=$i";
  		$row = mysql_fetch_row(query($query));
  		$method_id = intval($row[0]);
  	
  		$prev = $i-1;
  		$next = $i+1;
  	
  		if(in_array($i, $no_prev)) $prev = "''";
  		if(in_array($i, $no_next)) $next ="''";
  	
  		$query = "INSERT INTO portal_prev_next VALUES(NULL, $i, $method_id, $chapter, $prev, $next);";
  		$result = query($query);
  
	}
  
  
  	return true;
}

function fill_sids_best_algs()
{
  	//$query = "TRUNCATE portal_sids_best_algs;";
  	$query = "DELETE FROM portal_sids_best_algs WHERE SID > 1295";
  	$result = query($query);
  
  	for($i = 1296;$i<=1396;$i++)
  	{
     		$query = "INSERT INTO portal_sids_best_algs VALUES($i, 0, 0, 0, 0, 0, 0)";
     		$result = query($query);
   	}
  
  
	return true;  
}

function truncate_pa()
{
  	$query = "TRUNCATE portal_algs_t;";
  	$result = query($query);
  	$query = "TRUNCATE portal_algs_sids_t;";
  	$result = query($query);
 	return true;
}
function delete_y2()
{
  	$query = "SELECT ID, pre FROM portal_situations WHERE SID IN (1111, 1191) AND pre LIKE 'y2%';";
  	
  	$result = query($query);
  	while($row = mysql_fetch_assoc($result))
  	{
  	  	$pre = addslashes(trim(str_replace('y2', '', $row['pre'])));
  	  	$id = $row['ID'];
     		$query2 = "UPDATE portal_situations SET pre='$pre' WHERE ID=$id";
     		$result2 = query($query2);
     		//echo 'ID: '.$row['ID'].' ; pre: '.$row['pre'].' ; pre2: '.stripslashes($pre).'<br />'; 
   	}
   	return true;
}

function correct_pio()
{
  	$cube = new RubiksCube;
  
  	for($i = 217;$i<=288;$i++)
  	{
     		$query = "SELECT * FROM `portal_patterns` WHERE SID = $i;";
     		$result = query($query);
     		$row = mysql_fetch_assoc($result);

     		$alg = addslashes(implode(' ', $cube -> parse($row["alg"]."U'")));
     		//echo $i."\t alg: ".$alg.'<br />';
     		$query2 = "UPDATE portal_patterns SET alg='$alg' WHERE SID=$i;";
     		$result2 = query($query2);
   	}
  
  	return true;
}


function move_sit()
{
  	$query = "SELECT * FROM portal_situations_temp";
  	$result = query($query);
  	
  	while($row = mysql_fetch_assoc($result))
  	{
     		$sid = $row['SID'];
     		$pre = addslashes($row['pre']);
     		$hash = addslashes($row['hash']);
     		
     		$query2 = "INSERT INTO portal_situations_temp2 VALUES(NULL, $sid, '$pre', '$hash')";
     		$res2 = query($query2);
   	}
  
  	return true;
}

function rewrite_algs_sids()
{
  	$query = "SELECT * FROM portal_algs_sids";
  	$result = query($query);
  	
  	//$k=0;
  	
  	while($row = mysql_fetch_assoc($result))
  	{
  	  
  	  	//var_dump($row);
     		$alg_id = $row['alg_id'];
    		$sid_id = $row['sid_id'];
     		
     		$query2 = "SELECT ID FROM portal_algs_sids2 WHERE alg_id = $alg_id AND sid_id = $sid_id";
     		//echo '$query2: '.$query2.'<br />';
     		$res2 = query($query2);
     		if(mysql_num_rows($res2) > 0) continue;
     		
     		$query2 = "INSERT INTO portal_algs_sids2 VALUES(NULL, $alg_id, $sid_id)";
     		//echo '$query: '.$query2.'<br />';
     		$res = query($query2);
     		
     		//$k++;
     		//if($k > 10) break;
     
   	}
  
  
  	return true;
}

function gen_sids_ell_cll_f2ll()
{
  	// ell - dobra perm kraw
	for($i=1296; $i < 1299; $i++)
	{
  		$sids[] = array(10, 'p', '', 0 , 0);
	}

	// ell - H
	for($i=1299; $i < 1303; $i++)
	{
  		$sids[] = array(10, 'h', '', 0 , 0);
	}
	
	
	// ell - Z
	for($i=1303; $i < 1309; $i++)
	{
  		$sids[] = array(10, 'z', '', 0 , 0);
	}
	
	
	// ell - U1
	for($i=1309; $i < 1317; $i++)
	{
  		$sids[] = array(10, 'u1', '', 0 , 0);
	}
	
	// ell - U2
	for($i=1317; $i < 1325; $i++)
	{
  		$sids[] = array(10, 'u2', '', 0 , 0);
	}
	
	$kat = 0;
	
	for($i=1325; $i < 1370; $i++)
	{
   		if(in_array($i, array(1325, 1331, 1337, 1343, 1343, 1349, 1355, 1361, 1365))) $kat++;
   		
   		$sids[] = array(9, '', '', $kat , 0);
   
 	}
 	
 	$sids[] = array(11, '3', '', 0 , 0);
 	
 	for($i = 1371; $i < 1377 ; $i++)
 		$sids[] = array(11, '2', '', 0 , 0);
	
	for($i = 1377; $i < 1389 ; $i++)
 		$sids[] = array(11, '1', '', 0 , 0);
 		
	for($i = 1389; $i < 1397; $i++)
 		$sids[] = array(11, '4', '', 0 , 0);
 		
	$k = 0;
	for($i = 1296; $i < 1397; $i++)
	{	
	  	echo $i.'<br />';
	  	var_dump($sids[$k]);
	  	$k++;
	
	}
	return $sids;
}


function add_coll_to_cll()
{
  	$coll = 1019;
  	$cll = 1325;
  	
  	for($i = $coll; $i <= 1058; $i++, $cll++)
  	{	
     		$query = "INSERT INTO portal_coll_to_cll VALUES (NULL, $i, $cll)";
     		$result = query($query);
     
   	}
   	
   	return true;
}


function update_best_algs()
{
  	$cat = 3;
  	$my_alg_id = 0;
  
  	for($i = 1; $i <= 1295; $i++)
	{
   		$query = "SELECT portal_algs.ID AS ide, pre, alg, htm, stm, qtm, portal_algs.user_id, portal_algs_sids.sid_id, username, IFNULL( SUM( vote ) , 0 ) AS suma
FROM portal_algs_sids, portal_users, portal_algs
LEFT JOIN portal_votes ON portal_algs.ID = portal_votes.alg_id
AND portal_votes.sid_id =$i
AND portal_votes.cat = $cat
WHERE portal_algs_sids.sid_id =$i
AND portal_algs.ID = portal_algs_sids.alg_id
AND portal_users.ID = portal_algs.user_id
GROUP BY portal_algs.ID
ORDER BY suma DESC , htm, qtm, stm, portal_algs.ID
LIMIT 1"; 
   		$result = query($query);
   		$row = mysql_fetch_assoc($result);
   		$ide = $row['ide'];
   		$suma = $row['suma'];
   		$cat_name = "cat_".$cat;
   		$votes_name = "votes_".$cat;
   		
   		$query = "UPDATE portal_sids_best_algs SET $cat_name=$ide, $votes_name=$suma WHERE SID=$i;";
   		$result = query($query);
   
 	} 
	  
  	return true;
}
/*
echo '<pre>';
echo "sid\tmet\tchap\tsubch\tor\tper\tname\n\n";
for($i=1;$i<1296;$i++)
{
  $tab = tree_gen($i);
  echo $i."\t|".$tab[0]."|\t|".$tab[1]."|\t|".$tab[2]."|\t|".$tab[3]."|\t|".$tab[4]."|\t|".$tab[5]."|\n";
  $query = "INSERT INTO `portal_cats_sids` VALUES (NULL, $i, '$tab[0]', '$tab[1]', '$tab[2]', '$tab[3]', '$tab[4]', '$tab[5]');";
  $result = query($query); 
}

echo '</pre>';


*/

/*
$methods = array('zbll', 'fridrich', 'mgls', 'coll', 'ortega', 'eg', 'ss');

for($i = 0;$i<count($methods);$i++)
{
  $query = "INSERT INTO `portal_cats` VALUES(NULL, '$methods[$i]');";
  $result = query($query);
  
}


*/

	//if(zbll_to_coll()) echo 'zbll to coll -> ok!<br />';
	//if(zbf2l_to_els()) echo 'zbf2l to els -> ok!<br />';
	//if(oll_to_els()) echo 'oll to els -> ok!<br />';	
	//if(cls_to_ss()) echo 'cls to ss -> ok!<br />';
	//fill_ortega_temp();
	//if(eg_to_ortega_co()) echo 'eg to ortega_co -> ok!<br />';
	//fill_ss_temp();
	//if(eg_to_ss()) echo 'eg to ss -> ok!<br />';
	//if(zbf2l_to_f2l()) echo 'zbf2l to f2l -> ok!<br />';
	//if(change_algs_to_no_regrip()) echo 'change_algs_to_no_regrip -> ok<br />';
	//show_all_patterns();
	//if(add_pre_moves()) echo 'add_pre_moves() -> ok<br />';
	//show_pre_moves();
	//if(truncate_pa()) echo 'truncate_pa() -> ok<br />';
	if(fill_sids_best_algs()) echo 'fill_sids_best_algs() -> ok<br />';
	//if(delete_y2()) echo 'delete_y2() -> ok<br />';
	//if(correct_pio()) echo 'correct_pio -> ok!<br />';
	//if(move_sit()) echo 'move_sit() -> ok<br />';
	//if(rewrite_algs_sids()) echo 'rewrite_algs_sids() -> ok<br />';
	//if(add_pre_next()) echo 'add_pre_next() -> ok<br />';
	//if(add_coll_to_cll()) echo 'add_coll_to_cll() -> ok<br />';
	//if(update_best_algs()) echo 'update_best_algs() -> ok<br />';
?>
