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


function my_algs($algs_tab, $suid, $ifmyalgs=true)
{
  	//echo 'in my_algs:<br />';
  	//var_dump($algs_tab);
  	
  
  	$temp = array_fill(0, 1295, 0);
  	foreach($algs_tab as $key => $value)
  	{
  	  	
  	  	$alg = addslashes($value);
  	  	
  		$query = "SELECT ID FROM portal_algs WHERE alg='$alg';";
  		$result = query($query);
  		$row_temp = query($query);
		while($row = mysql_fetch_assoc($result))
  		{
  		  	$id = $row["ID"];
     			$query2 = "SELECT `sid_id` FROM `portal_algs_sids` WHERE `alg_id`=$id;";
     			$result2 = query($query2);
     		
   			while($row2 = mysql_fetch_row($result2))
     			{	
     		  		if($ifmyalgs) {$res = my_alg(intval($row2[0]), $id, $suid); /*echo 'dodaje_MA1 -> $res: '.$res.'<br />';*/}
     		  		if($temp[$row2[0]] == 0) {$sids[] = intval($row2[0]); $temp[$row2[0]] = 1;}
       			}
   		}
   	}

	//echo '$sids: ';
	//var_dump($sids);

   	return $sids;	
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

function add_alg($alg, $uid, $if_ma, $cats, $cats_algs, $cats_ok, $moves, $movement)			// alg, user_id, czy wybrać jako mój alg {on, off}
{
  
  	//var_dump(func_get_args());
  
  	$eg2 = false;
  	$zbll2 = false;
	$cloned = false;
	$lec = true;
	$get_pre = false;
	$cloned_cats = array('zbll', 'zbll2', 'zbf2l', 'eg', 'eg2', 'eg3');
	
	if(!allowed(obrobka(trim($alg), 'zbll')) || trim($alg) == '') return array('bad_line');
	
	$cube_temp = new RubiksCube;
	$algs_tab = array();
	
	// sprawdzanie istnienia algu w bazie dla każdej obróbki
	for($i=0;$i<count($cloned_cats);$i++)
	{
	  	$cat = $cloned_cats[$i];
	  	$if_reg = false;
	  	if($cat == 'eg2') {$cat = 'eg'; $ifu = false;}
	  	else if($cat == 'eg3') {$cat = 'eg'; $if_reg = true; $get_pre = true;}
	  	else if($cat == 'zbll2') {$cat = 'zbll'; $ifu = false;}
	  	else $ifu = true;
	  	
	  	$tmp = obrobka(trim($alg), $cat, $ifu, $if_reg, $get_pre);
	  	
	  	//var_dump($tmp);
	  	
	  	if($get_pre) {$pre = $tmp[0]; $tmp = $tmp[1];}
	  	$tmp = $cube_temp -> parse($tmp);
		
	  	if(!is_array($tmp) && !in_array($cloned_cats[$i], array('eg', 'eg2', 'eg3'))) return array('bad_line');
	  	if(!is_array($tmp) && in_array($cloned_cats[$i], array('eg', 'eg2', 'eg3'))) {$algs_tab[$cloned_cats[$i]] = ''; continue;}
	  	if(in_array($cloned_cats[$i], array('eg', 'eg2', 'eg3'))) $tmp = up2($tmp);
	  		  	
 		$tmp = implode(' ', $tmp);
		$inv[$cloned_cats[$i]] = implode(' ', $cube_temp->getAlgorithmInverse($cube_temp -> parse2($tmp)));
		
		if($cloned_cats[$i] == 'eg3')
		{
		  	//echo 'pre: '.$pre.'<br />';
    			if(trim($pre) != '')$inv[$cloned_cats[$i]] = trim($inv[$cloned_cats[$i]].' '.implode(' ', $cube_temp->getAlgorithmInverse($cube_temp -> parse($pre))));
			$algs_tab[$cloned_cats[$i]] = implode(' ', $cube_temp -> parse($pre.$tmp));	
    
  		} 
 		else $algs_tab[$cloned_cats[$i]] = $tmp;
	  	
	  	if(cloned($tmp, 0) !== true) {$cloned = true;}
	  	
	}
	
	if($inv['eg'] != $inv['eg2']) $eg2 = true;
	if($inv['eg'] != $inv['eg3']) $eg3 = true;
	if($inv['zbll'] != $inv['zbll2']) $zbll2 = true;
	/*
	echo 'inv: ';
	var_dump($inv);
	echo 'normal: ';
	var_dump($algs_tab);
	echo '$eg2: ';
	var_dump($eg2);
	echo '$eg3: ';
	var_dump($eg3);
	echo 'zbll2: ';
	var_dump($zbll2);
	echo '---------------<br />';
	*/
	
	//var_dump($lec);
	
	// jeśli nie było jeszcze takiego alga:
	if($lec)
	{
		$no_invs = array(875, 876, 879, 880, 881, 883, 888, 889, 890, 891, 892, 893,1066,1067,1068,1069,1070,1071);
		$need_to_up = array('eg', 'ortega_cp', 'ss');
		
		for($i = 0; $i<count($cats); $i++)		// przerabianie (prawie) każdej kategorii
		{
  			$act = $cats[$i];			// aktualna kategoria
  			$next = false;
  	
  			if(($act == 'eg2' || $act == 'ortega_cp2') && $eg2 == false) continue;
  			if($eg3 == false && $act == 'ss2') continue;
  			if(($act == 'zbll2' || $act == 'pll2' || $act == 'oll2')&& $zbll2 == false) continue;
  			$alg_temp = $inv[$cats_algs[$act]];
  			
  			$act_shit = $act;
  			
  			if(substr($act, -1) == '2') $act = substr($act, 0, -1);
  	
  			if($act == 'ortega_cp') $act2 = 'cp';
  			else $act2 = $act;
  	
  			//echo '---------------------------<br /><br />act: '.$act.' ; act2: '.$act2.' ; act_shit: '.$act_shit.'<br />';
  	
  			// niesprawdzanie niepotrzebnych rzeczy
			if(count($cats_ok["zbll"]) > 0 && ($act == 'zbf2l' || $act == 'pll')) continue;
			if(search_to_cls($cats_ok['zbf2l']) === false && count($cats_ok["zbll"]) == 0 && $act == 'cls') continue;
  			if(count($cats_ok["oll"]) > 0 && $act == 'zbf2l') continue;
  			if(count($cats_ok["oll"]) == 0 && $act == 'zbll') continue;
  			if(count($cats_ok["pll"]) > 0 && ($act == 'cls' || $act == 'zbf2l' || $act == 'eg' || $act == 'ss')) continue;
			if((count($cats_ok["cls"]) > 0 || count($cats_ok["eg"]) > 0) && $act == 'ss') continue; // uzupełnienie później
  			if(count($cats_ok["eg"]) > 0 && $act_shit == 'eg2') continue;
  			if(count($cats_ok["ss"]) > 0 && $act_shit == 'ss2') continue;
  			if(count($cats_ok["ortega_cp"]) > 0 && $act_shit == 'ortega_cp2') continue;
  			if(count($cats_ok["zbll"]) > 0 && $act_shit == 'zbll2')continue;
  			if(count($cats_ok["zbll"]) > 0 && $act == 'cll') continue; // uzupełnienie później
  			//echo 'ok1!<br />';
  			if($inv[$cats_algs[$act]] == '') continue;

			//echo 'ok2!<br />';

  			// id kategorii
			if($act2 == 'eg') $cat_id = 6;
			else if($act2 == 'ss') $cat_id = 7;
			else if($act2 == 'cll') $cat_id = 9;
			else if($act2 == 'ell') $cat_id = 10;
			else if($act2 == 'f2ll') $cat_id = 11;
			else $cat_id = 0;
  	
	  		//pobieranie min i max SID z danej kategorii
	  		$query = "SELECT MIN(SID), MAX(SID) FROM `portal_cats_sids` WHERE `method`=$cat_id OR `chapter`='$act2';";
  			$result = query($query);
  			$row = mysql_fetch_row($result);
			$min = $row[0];
  			$max = $row[1];
  	
  			// wybór klasy
			if(in_array($act, $need_to_up)) $cube = new PocketCube;
  			else $cube = new RubiksCube;
	
			$ok = false; 
			
	  		$ile = count($moves[$act]);
	  		
	  		//echo 'cat: '.$act.'<br />min: '.$min.'<br />max: '.$max.'<br />ile: '.$ile.'<br />';
	  		
	  		
	  		for($j=0;$j<$ile; $j++)
			{
  	  			$regrip = $moves[$act][$j];
  	  			
  	  			$parsuj = true;
  	  			if($act_shit == 'ss2') {$do_zelementowania = $cube ->parse($regrip.$alg_temp); $parsuj = false;}
  	  			else $do_zelementowania = $regrip.$alg_temp;
     				$hash = $cube -> getElemsName($do_zelementowania, "normal", $act, $parsuj, false);

				//echo 'regrip: '.$regrip.'<br />hash: '.$hash.'<br />alg_temp: '.$alg_temp.'<br /><br />';

     				$query = "SELECT * FROM `portal_situations` WHERE SID BETWEEN $min AND $max AND hash='$hash' GROUP BY SID ORDER BY ID";
			   	$result = query($query);
   			
   				if(mysql_num_rows($result) > 0) 
   				{
	  				$result2 = query($query);
  					$row = mysql_fetch_assoc($result2);
  					$sid = $row["SID"];
  					if(in_array($sid, $no_invs))
  					{
	  					$alg_t = $cube -> parse(implode(' ', $cube-> parse2($algs_tab[$cats_algs[$act_shit]], "normal")));
		  				$hash = $cube -> getElemsName($alg_t, "normal", $act, false, false);
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
     		
					// jeśli eg3 - szukamy pre-moves, usuwamy je z algu i dodajemy do pre       
		       			if($act_shit == 'ss2')
     			  		{
     			  		  	//echo 'kat: ss2!<br />przed: alg: ';
     			  		  	//var_dump($algs_tab[$cats_algs[$act_shit]]);
     			  		  	//var_dump($pre);
     			  		  
			           		$tab_temp = search_pre_post($algs_tab[$cats_algs[$act_shit]], 'eg', false, false, true);
			           		$algs_tab[$cats_algs[$act_shit]] = $tab_temp[1];
			           		$pre .= $tab_temp[0];
			           		
			           		//echo 'after: ';
			           		//var_dump($algs_tab[$cats_algs[$act_shit]]);
     			  		  	//var_dump($pre);
     			  		  	//echo '---------------------<br />';
			           
			           
					}
        				if(trim($pre) != "") $pre = trim(implode(" ", $cube -> parse($pre)));
        				if($pre == NULL) $pre = '';
	  				$cats_ok[$act][] =  array('sid' => $row["SID"], 'alg'=>$algs_tab[$cats_algs[$act_shit]], 'pre'=>$pre); 
	  			
		  		} 
			}
			
			//echo '---------------------------<br />';
		}
		
		//echo '------<br />';
		
		if((count($cats_ok, COUNT_RECURSIVE) - count($cats_ok)) <= 0 && $cloned === true ) 
		{
 			if($inv['zbll'] == '' && $inv['eg'] == '' && $inv['zbf2l'] == '' && ($inv['zbll2'] != '' || $inv['eg2'] != '')) {/*echo 'clon1!<br />'; */ return array('cloned', array(''));}
  			return array('no_sid');
  		}
		
		// właściwe dodawanie algów
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
  		
 		//echo 'cats_ok po dopisaniu: ';
  		//var_dump($cats_ok);
 		
 		$licznik = 0;
		$clon = false;
		foreach($cats_ok as $key => $value)
		{
			for($i=0;$i<count($cats_ok[$key]);$i++)
			{
			  	if($key == 'ss' || $key == 'ss2')
	   			{
		       			$prem_tab = explode(' ', $cats_ok[$key][$i]["pre"]);
		       			if(count($prem_tab) > 1)
		       			{
			           		$temp = addslashes(trim($prem_tab[0].' '.$prem_tab[1]));
			           		$query3 = "SELECT pre2 FROM portal_pre_moves2 WHERE pre='$temp'";
			           		$res = query($query3);
			           		if(mysql_num_rows($res) > 0)
			           		{
			           			$row = mysql_fetch_assoc($res);
			           			$pre_new = $row['pre2'];
			           			$smiec = array_shift($prem_tab);
				   			$prem_tab[0] = $pre_new;
			           			if(count($prem_tab) > 1)$cats_ok[$key][$i]["pre"] = implode(' ', $prem_tab);
			           			else $cats_ok[$key][$i]["pre"] = $prem_tab[0];
			           		}
			           		
			           
				 	}
				 	//echo 'key: ss';
				 	//var_dump($cats_ok[$key][$i]);
		     		}
			  
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
 			
 					if(intval($row[$cat_name]) === 0 || intval($row[$votes_name]) < 0) 	// cat_X == 0 - brak najlepszego algu<br />
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
     			
     				$licznik++;
 			}
		}
	}
	
	//var_dump($dodano_jakis);
	//var_dump($licznik);
	//var_dump($clon);
	if($if_ma == 'on') { $sids = my_algs($algs_tab, $uid, true);}
	else if($clon === true) {$sids = my_algs($algs_tab, $uid, false);}

	if($clon === true) return array('cloned', $sids);
	if($licznik == 0) return array('no_sid');
	return 'gut';
		
}

?>
