<?php

include_once 'getsituation_new.php';
include_once "obrobka.php";
include_once "case_funcs.php";

// SZUKANIE ZLYCH SYMBOLI W ALGU                      
function allowed($alg)
{
	if(preg_match("/[^ 2RLFBDUXYZMSE'rlfbduxyzwsa]/", $alg)) return false;
	else return true;	
}


// sprawdzenie duplikatu
function cloned($alg, $pre='')
{
  	$alg = addslashes($alg);
  	if($pre !== 0)$pre = addslashes($pre);
  	
	if($pre === 0) $query = "SELECT `ID` FROM `portal_algs` WHERE `alg`='$alg';";
	else $query = "SELECT `ID` FROM `portal_algs` WHERE `alg`='$alg' AND `pre`='$pre';";
	$result = query($query);
	
	while($row = mysql_fetch_row($result))
	{
   		$id = intval($row[0]);
 	}
	
	if(mysql_num_rows($result) > 0) return $id;
	
	return true;
}

function insert_alg($alg, $pre, $suid, $htm, $qtm, $stm)			// dodaje alg do bazy i zwraca jego id
{  
  	$alg = addslashes($alg);
  	$pre = addslashes($pre);
  	$suid = intval($suid);
  			
  	$query = "INSERT INTO `portal_algs` VALUES(NULL, '$pre', '$alg', $htm, $qtm, $stm, $suid);";
  	$result = query($query);
  	
  	$query = "SELECT `ID` FROM `portal_algs` WHERE alg='$alg' AND `pre`='$pre';";
  	$row = mysql_fetch_row(query($query));

	return $row[0];
	//return 0;
}	


function my_algs($alg, $suid)
{
  	//echo 'MY_ALGS!<br />';
  	$tmp = array();
	$cats = array("zbll", "zbf2l", "eg");
	for($i = 0;$i<count($cats);$i++)
	{
         	$obr = obrobka($alg, $cats[$i]);
		if($cats[$i] == 'eg') $obr = up($obr);
		if(!in_array($obr, $tmp)) $tmp[] = $obr;
	}
   	
   	//var_dump($tmp);
   	
  	
  	for($i = 0;$i< count($tmp);$i++)
  	{
  	  	$alg = addslashes(stripslashes($tmp[$i]));
  		$query = "SELECT ID FROM portal_algs WHERE alg='$alg';";
  		//echo 'query: '.$query.'<br />';
  		$result = query($query);
  		//echo '$alg: '.$alg.'<br />';
  		$row_temp = query($query);
  		//var_dump(mysql_fetch_row($row_temp));
		while($row = mysql_fetch_assoc($result))
  		{
  		  	//echo 'row1!<br />';
  		  	$id = $row["ID"];
  		  	//echo 'id = |'.$id.'|<br />';
     			$query2 = "SELECT `sid_id` FROM `portal_algs_sids` WHERE `alg_id`=$id;";
     			$result2 = query($query2);
     		
   			while($row2 = mysql_fetch_row($result2))
     			{	
     			  	//echo 'row2!<br />';
     		  		my_alg(intval($row2[0]), $id, $suid);
     		  		//echo 'my_alg($sid = '.$row2[0].', $alg_id = '.$id.', $uid = '.$suid.');<br />';
       			}
   		}
   	}
  	return true;	
}

function search($tab, $key, $value)
{
 	for($i=0;$i<count($tab);$i++)
  		if($tab[$i][$key] == $value) return $i;  		
     
  	return false;
}

function search_to_cls($tab)
{
  	$cls_ok = array(672, 688, 704, 764, 770);
 	for($i=0;$i<count($tab);$i++)
 	{
 	  	$tmp = $tab[$i]['sid'];
  		if(in_array($tmp, $cls_ok)) return $i;  		
     	}
  	return false;
}

//-------------------------------------------------------
// main function
//-------------------------------------------------------

function add_alg($alg, $uid, $if_ma)			// alg, user_id, czy wybrać jako mój alg {on, off}
{
  	/*
	echo 'inside: ';
  	$now = getmicrotime();
  	echo '<br />';
  	*/
  	
  	$eg2 = false;
	$cloned = false;
	$cloned_cats = array('zbll', 'zbf2l', 'eg', 'eg2');
	//if($uid == 1) $uid = 2;
	
	if(!allowed(obrobka(trim($alg), 'zbll')) || trim($alg) == '') return 'bad_line';
	
	$cube_temp = new RubiksCube;
	$algs_tab = array();
	
	// sprawdzanie istnienia algu w bazie dla każdej obróbki
	for($i=0;$i<count($cloned_cats);$i++)
	{
	  	$cat = $cloned_cats[$i];
	  	if($cat == 'eg2') {$cat = 'eg'; $ifu = false;}
	  	else $ifu = true;
	  	
	  	$tmp = $cube_temp -> parse(obrobka(trim($alg), $cat, $ifu));
		//echo '$tmp: ';
		//var_dump($tmp);
	  	if(!is_array($tmp) && $cloned_cats[$i] != 'eg' && $cloned_cats[$i] != 'eg2') return 'bad_line';
	  	if(!is_array($tmp) && ($cloned_cats[$i] == 'eg' || $cloned_cats[$i] == 'eg2')) {$algs_tab[$cloned_cats[$i]] = ''; continue;}
	  	if($cloned_cats[$i] == 'eg' || $cloned_cats[$i] == 'eg2') $tmp = up2($tmp);
 		$tmp = implode(' ', $tmp);
		$inv[$cloned_cats[$i]] = implode(' ', $cube_temp->getAlgorithmInverse($cube_temp -> parse2($tmp)));
 		$algs_tab[$cloned_cats[$i]] = $tmp;
	  	
	  	if($cloned !== true)$cloned = cloned($tmp);
	}
	
	if($inv['eg'] != $inv['eg2']) $eg2 = true;
	
	/*
	echo 'po utworzeniu tab 3 algów: ';
	echo getmicrotime()-$now;
	$now  = getmicrotime();
	echo '<br />';
	
	echo 'inv: ';
	var_dump($inv);
	echo 'normal: ';
	var_dump($algs_tab);
	echo '$eg2: ';
	var_dump($eg2);
	echo '---------------<br />';
	*/
	
	
	// jeśli nie było jeszcze takiego alga:
	if($cloned === true)
	{
		$cats = array("oll", "zbll", "pll", "zbf2l", "cls", "ortega_cp", "eg", "ortega_cp2", "eg2", "ss");
		$cats_algs = array("oll"=>"zbll", "zbll"=>"zbll", "pll"=>"zbll", "cls"=>"zbf2l", "zbf2l"=>"zbf2l", "ortega_cp"=>"eg", "eg"=>"eg", "ortega_cp2"=>"eg2", "eg2"=>"eg2", "ss"=>"eg");
		$cats_ok = array("zbll"=>array(), "zbf2l"=>array(), "f2l"=>array(), "oll"=>array(), "pll"=>array(), "els"=>array(), "cls"=>array(), "coll"=>array(), "ortega_co"=>array(), "ortega_cp"=>array(), "eg"=>array(), "ss"=>array()); // 1 - zbll, 2 - zbf2l, 3 - f2l, 4 - oll, 5 - pll, 6 - els, 7 - cls, 8 - coll, 9 - ortega_co, 10 - ortega_cp, 11 - eg, 12 - ss
		$no_invs = array(875, 876, 879, 880, 881, 883, 888, 889, 890, 891, 892, 893,1066,1067,1068,1069,1070,1071);
		$need_to_up = array('eg', 'ortega_cp', 'ss');
				
		$moves = array
		(	
			"zbll"=>array(""), 
			"zbf2l"=>array("", "x", "x'", "x2", "z", "z'"), 
			"oll"=>array("", "x", "x'", "x2", "z", "z'"), 
			"pll"=>array(""), 
			"cls"=>array("", "x", "x'", "x2", "z", "z'"), 
			"ortega_cp"=>array(""), 
			"eg"=>array(""), 
			"ss"=>array("", "y", "y'", "y2", "x", "x'", "x2", "z", "z'", "z2", "y' x", "y2 x", "y x", "y' x'", "y x'", "y2 x'", "x' y", "x y", "x2 y", "y2 z", "y2 z'", "y' z'", "y' z", "y' z2")
		);
		
		$now2 = getmicrotime();
		
		for($i = 0; $i<count($cats); $i++)		// przerabianie (prawie) każdej kategorii
		{
  			$act = $cats[$i];			// aktualna kategoria
  			$next = false;
  	
  			if(($act == 'eg2' || $act == 'ortega_cp2') && $eg2 == false) continue;
  	
  			$alg_temp = $inv[$cats_algs[$act]];
  			
  			$act_shit = $act;
  			
  			if($act == 'ortega_cp2') $act = 'ortega_cp';
  			if($act == 'eg2') $act = 'eg';
  			
  			//echo '$act_shit: '.$act_shit.'<br />$act: '.$act.'<br />$alg: '.$alg_temp.'<br /><br />';
  	
  	
  			if($act == 'ortega_cp') $act2 = 'cp';
  			else $act2 = $act;
  	
  			// niesprawdzanie niepotrzebnych rzeczy
			if(count($cats_ok["zbll"]) > 0 && ($act == 'zbf2l' || $act == 'pll')) continue;
			if(search_to_cls($cats_ok['zbf2l']) === false && count($cats_ok["zbll"]) == 0 && $act == 'cls') continue;
  			if(count($cats_ok["oll"]) > 0 && $act == 'zbf2l') continue; 
  			if(count($cats_ok["oll"]) == 0 && $act == 'zbll') continue;
  			if(count($cats_ok["pll"]) > 0 && ($act == 'cls' || $act == 'zbf2l' || $act == 'eg' || $act == 'ss')) continue; 
			if((count($cats_ok["cls"]) > 0 || count($cats_ok["eg"]) > 0) && $act == 'ss')  continue; // uzupełnienie później
			//if(count($cats_ok["ortega_cp"]) > 0 && $act == 'ss')  continue;
  			if(count($cats_ok["eg"]) > 0 && $act_shit == 'eg2') continue;
  			if(count($cats_ok["ortega_cp"]) > 0 && $act_shit == 'ortega_cp2') continue;
  			if($algs_tab[$cats_algs[$act]] == '') continue;
  			
  			// id kategorii
			if($act2 == 'eg') $cat_id = 6;
			else if($act2 == 'ss') $cat_id = 7;
			else $cat_id = 0;
  	
	  		//pobieranie min i max SID z danej kategorii
	  		$query = "SELECT MIN(ID), MAX(ID) FROM `portal_cats_sids` WHERE `method`=$cat_id OR `chapter`='$act2';";
  			$result = query($query);
  			$row = mysql_fetch_row($result);
			$min = $row[0];
  			$max = $row[1];
  	
  			// wybór klasy
			if(in_array($act, $need_to_up)) $cube = new PocketCube;
  			else $cube = new RubiksCube;
	
			$ok = false; 
			
	  		$ile = count($moves[$act]);
	  		for($j=0;$j<$ile; $j++)
			{
  	  			$regrip = $moves[$act][$j];
     				$hash = $cube -> getElemsName($regrip.$alg_temp, "normal", $act, true, false);
     				$query = "SELECT * FROM `portal_situations` WHERE SID BETWEEN $min AND $max AND hash='$hash' GROUP BY SID ORDER BY ID";
			   	$result = query($query);
   			
   				if(mysql_num_rows($result) > 0) 
   				{
	  				$result2 = query($query);
  					$row = mysql_fetch_assoc($result2);
  					$sid = $row["SID"];
  					//echo 'SID1 -> '.$sid.'<br />';
  					if(in_array($sid, $no_invs))
  					{
	  					$alg_t = $cube -> parse(implode(' ', $cube-> parse2($algs_tab[$cats_algs[$act_shit]], "normal")));
		  				$hash = $cube -> getElemsName($alg_t, "normal", $act, false, false);
		  				//echo '<b>nowy hash: -> '.$hash.'</b><br />';
  						$query = "SELECT * FROM `portal_situations` WHERE SID BETWEEN $min AND $max AND hash='$hash' GROUP BY SID ORDER BY ID;";
  						$result = query($query);
  					
  					}
					$ok = true; 
		     			break;
   				}
			}
			if($ok)   
			{		 
		  		while($row = mysql_fetch_assoc($result))
     				{
     				  	$pre = '';
     			  		$pre = stripslashes($row["pre"]).$moves[$act][$j];
        				if(trim($pre) != "") $pre = trim(implode(" ", $cube -> parse($pre)));
        				if($pre == NULL) $pre = '';
	  				$cats_ok[$act][] =  array('sid' => $row["SID"], 'alg'=>$algs_tab[$cats_algs[$act_shit]], 'pre'=>$pre); 
	  			
		  		} 
			}
			/*
			echo 'po kolejnej kat:('.$act.'): ';
			echo getmicrotime()-$now;
			$now = getmicrotime();
			echo '<br />';
			*/
		}
		/*
		echo 'po sprawdzeniu pasujących syt: ';
		echo getmicrotime()-$now2;
		$now = getmicrotime();
		echo '<br />';
		*/
		//var_dump($cats_ok);
		if((count($cats_ok, COUNT_RECURSIVE) - count($cats_ok)) <= 0 && $cloned === true) return 'no_sid';
		
		// właściwe dodawanie algów
	
		$movement = array
			(
			"zbll"=>array("coll"), 
			"zbf2l"=>array("els","f2l"), 
			"oll"=>array("els"), 
			"eg"=>array("ortega_co", 'ss'), 
			"cls"=>array("ss")
			);
	
		$cube = new RubiksCube;
	
		foreach($movement as $key=>$value)
  		{
     			$k = count($cats_ok[$key]);
           		$i = 0;
           		if($k == 0) continue; 
   			while($i<$k)
	   		{
		     		$sid = $cats_ok[$key][$i]['sid'];
	   	  		$proviso = $key.'_SID';

	     			for($j = 0;$j<count($value);$j++)
	   	  		{
	   	  	  		$value2 = $value[$j];
	   	  			//echo '$key = '.$key."\tvalue = ".$value2.' -> dopisanie!<br />';
	   	  			$pre_temp = '';
	   	  	
	   	  			// pobieranie ID do uzupełnienia
	   	  			$table = 'portal_'.$key.'_to_'.$value2;
	   	  			$what = $value2.'_SID';
       					$query = "SELECT $what FROM $table WHERE $proviso=$sid;";
       					$result = query($query);

		       			if(mysql_num_rows($result) > 0)
       					{
       				  		$row = mysql_fetch_row($result);
		       				$sid2 = intval($row[0]);
       				
       						if($value2 == 'ss' && $key == 'cls') 
       						{
				           		$offset = search($cats_ok['ss'], 'sid', $sid2);
				           		if($offset !== false) continue;
					 	}
       				
       						// jeśli oll -> els: czasami trzeba dołożyć pre-move(s)
		       				if($key == 'oll' && $value2 == 'els')
       						{
	           					$query = "SELECT `pre` FROM `portal_oll_to_els` WHERE `oll_SID`=$sid;";
	           					$row = mysql_fetch_row(query($query));
							if(trim($row[0].$cats_ok[$key][$i]['pre']) != '')$pre_temp = addslashes(trim(implode(' ', $cube -> parse($row[0].$cats_ok[$key][$i]['pre'])))); 
						
							$query = "SELECT `pre2` FROM `portal_pre_moves` WHERE `pre` = '$pre_temp';";
							$result2 = mysql_query($query);
							if(mysql_num_rows($result2) > 0) {$row2 = mysql_fetch_row($result2); $pre_temp = stripslashes($row2[0]);}
							else $pre_temp = stripslashes($pre_temp);	
		 				}

 						else if($key == 'eg' && ($value2 == 'ortega_co' || $value2 == 'ss'))
 						{
			     				$pre_temp = trim($cats_ok[$key][$i]['pre']);
			     				$pre_temp = str_replace("D2", "", $pre_temp);
							$pre_temp = str_replace("D'", "", $pre_temp);
							$pre_temp = trim(str_replace("D", "", $pre_temp));
	
							if($pre_temp != '') 
			     				{
								//$pre_temp = str_replace("U", "y", $pre_temp);
								$pre_temp = trim(addslashes(implode(' ', $cube -> parse($pre_temp))));
								$query = "SELECT `pre2` FROM `portal_pre_moves` WHERE `pre` = '$pre_temp';";
								$result2 = mysql_query($query);
								if(mysql_num_rows($result2) > 0) {$row2 = mysql_fetch_row($result2); $pre_temp = stripslashes($row2[0]);}
								else $pre_temp = stripslashes($pre_temp);
							}
			   			}
			       
			       			else $pre_temp = $cats_ok[$key][$i]['pre'];
			       
			       			if($value2 == 'ss' && $key == 'cls') $alg_tmp = up($cats_ok[$key][$i]['alg']);
			       			else $alg_tmp = $cats_ok[$key][$i]['alg'];
	       					$cats_ok[$value2][] = array('pre'=> trim($pre_temp), 'sid'=>$sid2, 'alg'=> $alg_tmp);
			       		} 
      				}
		     		$i++;
     			}
   		}
  		/*
  		echo 'po dopisaniu: ';
		echo getmicrotime()-$now;
		$now = getmicrotime();
  		echo '<br />';
  		//echo 'cats_ok po dopisaniu: ';
  		//var_dump($cats_ok);
 		*/
		$clon = false;
		foreach($cats_ok as $key => $value)
		{
			for($i=0;$i<count($cats_ok[$key]);$i++)
			{
			  	$con = false;
	   			$alg_id = cloned($cats_ok[$key][$i]["alg"], $cats_ok[$key][$i]["pre"]);
	   		
	   			$htm = moves($cats_ok[$key][$i]['alg'], 'htm');						// moves htm
				$qtm = moves($cats_ok[$key][$i]['alg'], 'qtm');						// moves qtm
				$stm = moves($cats_ok[$key][$i]['alg'], 'stm');						// moves stm 
   				if($alg_id === true)				// -> algu nie ma w bazie
   				{
       					$alg_id = insert_alg($cats_ok[$key][$i]["alg"], $cats_ok[$key][$i]["pre"], $uid, $htm, $qtm, $stm);
       					$dodano_jakis = true;
       					$clon = false;
     				}
     				else
     				{
		     			if(!$dodano_jakis) $clon = true;	
       				}
     				$sid = $cats_ok[$key][$i]["sid"];
     				//$ma[] = array("sid" => $cats_ok[$key][$i]["sid"], "alg_id"=>$alg_id);

				$query = "SELECT ID FROM portal_algs_sids WHERE sid_id = $sid AND alg_id = $alg_id";
				$result = query($query);
				if(mysql_num_rows($result) > 0) continue;

     				$query = "INSERT INTO `portal_algs_sids` VALUES(NULL, $alg_id, $sid);";
     				$result = query($query);
     				
     				$query = "SELECT * FROM portal_sids_best_algs WHERE SID=$sid";
				$result = query($query);
				$row = mysql_fetch_assoc($result);
	
				// jeśli trzeba - dodawanie jako najlepszy alg
				if($row['votes_1'] > 0 && $row['votes_2'] > 0 && $row['votes_3'] > 0) continue;
				for($j = 0;$j<3;$j++)
				{	
 					$cat_name = "cat_".($j+1);
 					$votes_name = "votes_".($j+1);
 			
 					if(intval($row[$cat_name]) === 0 || intval($row[$votes_name]) < 0) 	// cat_X == 0 - brak najlepszego algu
	 				{
     						$query2 = "UPDATE portal_sids_best_algs SET `$cat_name`=$alg_id WHERE SID=$sid AND `$votes_name` = 0";
    						$result2 = query($query2);
     						continue;
   					} 
   
   					else if(intval($row[$votes_name]) === 0)				// votes_X == 0 - najlepszy alg bez głosów
   					{	
	       					$query2 = "SELECT htm, qtm, stm FROM portal_algs WHERE ID = $row[$cat_name]";
						$result2 = query($query2);
						$row2 = mysql_fetch_assoc($result2);
				
	       					$czy = false;
	       					if($htm < $row2['htm']) $czy = true;
	       					else if($htm == $row2['htm'] && $qtm < $row2['qtm']) $czy = true;
	       					else if($htm == $row2['htm'] && $qtm == $row2['qtm'] && $stm < $row2['stm']) $czy = true;
	       			
	       					if($czy)
	       					{
		           				$query2 = "UPDATE portal_sids_best_algs SET `$cat_name`=$alg_id WHERE SID=$sid";
		           				$result2 = query($query2);
			 			}
	       
	       
	     				}
 				}
     			
     				
 			}
		}
	}
	/*
	echo 'po dodaniu: ';
	echo getmicrotime()-$now;
	$now = getmicrotime();
	echo '<br />';
	*/
	//if($if_ma == 'on' && $cloned === true) my_algs($ma, $uid);
	//else if($if_ma == 'on') my_algs2($algs_tab, $uid);

	if($cloned !== true || $clon === true) return 'cloned';
	return 'gut';
		
}

?>
