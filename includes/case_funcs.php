<?php

// funkcje sortujące

function cmp_htm($a, $b)
{
    if ($a["htm"] == $b["htm"]) {
        return 0;
    }
    return ($a["htm"] < $b["htm"]) ? -1 : 1;
}

function cmp_stm($a, $b)
{
    if ($a["stm"] == $b["stm"]) {
        return 0;
    }
    return ($a["stm"] < $b["stm"]) ? -1 : 1;
} 

function cmp_qtm($a, $b)
{
    if ($a["qtm"] == $b["qtm"]) {
        return 0;
    }
    return ($a["qtm"] < $b["qtm"]) ? -1 : 1;
}

function cmp_id($a, $b)
{
    if ($a["id"] == $b["id"]) {
        return 0;
    }
    return ($a["id"] < $b["id"]) ? -1 : 1;
}


function cmp_votes($a, $b)
{
    if ($a["votes"] == $b["votes"]) {
        return 0;
    }
    return ($a["votes"] > $b["votes"]) ? -1 : 1;
}

function sort_by_moves($tab, $act)
{
  	//usort($tym,  "cmp_ros");
  
  	$next = array("votes"=>"htm", "htm"=>"qtm", "qtm"=>"stm", "stm"=>"id");
  
  	// sortowanie z taką samą iloścą głosów by htm
  	if(count($tab)>1) 
	{	
		$wynik = array();	
		$sort_by = $tab[0][$act];	
		$i=0;
		while(true)	
		{	  
			$sort_by = $tab[$i][$act];
		     	$poprz = $i;
	  		$i++;		
	  		$tym = array();
	  		while($tab[$i][$act] == $sort_by) {$i++; if($i >= count($tab)) break;}
		    
		     	if($i != $poprz-1)
		     	{		     
  	    			for($j=$poprz;$j<$i;$j++)
		     	        	$tym[] = $tab[$j]; 
  
			  	if(array_key_exists($act, $next)) 
  				{
				    if($act == 'votes') usort($tym, "cmp_htm");
				    else if($act == 'htm') usort($tym, "cmp_qtm");
				    else if($act == 'qtm') usort($tym, "cmp_stm");
				    $tym = sort_by_moves($tym, $next[$act]);
		    		}
			   	
			   	else usort($tym, "cmp_id");
			   	
			   	$wynik = array_merge($wynik, $tym);
  			}
  			else $wynik[] = $tab[$poprz];

			if($i >= count($tab)) break;
		}
		$tab = $wynik;
	}
  
  	return $tab;
}


function moves($alg, $typ='htm')
{
		$ruchy = 0;

		preg_match_all("/[RLFBDUMSErlubdf]/", $alg, $wynik);
		$ruchy += count($wynik[0]);
		$wynik = '';

		preg_match_all("/\d+/", $alg, $wynik);
		$dwojki = count($wynik[0]);
		$wynik = '';

		preg_match_all("/[MES]/", $alg, $wynik);
		$emki = count($wynik[0]);
		$wynik = '';

		preg_match_all("/[MES]2/", $alg, $wynik);
		$emki2 = count($wynik[0]);

		if($typ == 'htm') 
           $ruchy += $emki + $ext;		

		else if($typ == 'stm') 
			  $ruchy += $ext;	

      else if($typ == 'qtm') 
			  $ruchy += $dwojki + $emki + $emki2 + $ext + $ext2;

		return $ruchy;
}


function vote($sid, $id, $uid, $cat, $vote)
{
	if(!can_vote($uid, $id, $sid, $cat)) return 'cant_vote';
	
	$query = "SELECT ID FROM portal_algs_sids WHERE alg_id=$id AND sid_id=$sid";
	$res = query($query);
	if(mysql_num_rows($res) == 0) return false;

	$query = "INSERT INTO portal_votes VALUES(NULL, $sid, $id, $uid, $cat, $vote);";
	$result = query($query);
	
	return true;
}


function my_alg($sid, $id, $uid, $cat=1)
{
	$sid = intval($sid);
	$id = intval($id);
	$uid = intval($uid);
	$cat = intval($cat);
	
	if($uid == 1) return false;
	
	$query = "SELECT ID FROM portal_algs_sids WHERE alg_id=$id AND sid_id=$sid";
	$res = query($query);
	if(mysql_num_rows($res) == 0) return false;
		
	$query = "SELECT `ID` FROM `portal_users_algs` WHERE `user_id`=$uid AND `sid_id`=$sid AND cat=$cat;";
	$result = query($query);
	$row = mysql_fetch_row($result);
	
	if(mysql_num_rows($result) == 0) $query = "INSERT INTO `portal_users_algs` VALUES(NULL, $sid, $id, $uid, $cat);";	
	else $query = "UPDATE `portal_users_algs` SET `alg_id`=$id WHERE `ID`=$row[0];";	
	$result = query($query);
	
	if($result != false) return true;
	else return 'mysql_error';	
}

function get_my_alg($sid, $uid, $cat)
{
	$my_alg = '';
	if($uid == 1) return false; 														// user = guest
	
	$sid = intval($sid);
	$uid = intval($uid);
	$cat = intval($cat);
	
	$query = "SELECT alg_id FROM portal_users_algs WHERE sid_id=$sid AND user_id=$uid AND cat=$cat;";
	$result = query($query);
	if(mysql_num_rows($result) == 0) return false;
	else
	{
		$row = mysql_fetch_row($result);
		$my_alg = $row[0];
	}


	return intval($my_alg);	
}


function can_vote($uid, $id, $sid, $cat)
{
	if($uid == 1) return false; 										// Guest
	
	$query = "SELECT * FROM portal_votes WHERE user_id=$uid AND alg_id=$id AND sid_id=$sid AND cat=$cat;";
	$result = query($query);
	if(mysql_num_rows($result) == 0) return true;
	
	return false;
}


function votuj($tab, $sid, $uid, $cat)
{
	$algs = array();
	
	// sprawdzanie ilości głosów dla danego algu i czy user może głosować na dany alg
	for($i = 0;$i<count($tab);$i++)
	{			
		if(can_vote($uid, $tab[$i]["id"], $sid, $cat)) $tab[$i]["can_vote"] = 1;					// can vote
		else $tab[$i]["can_vote"] = 0;																		// can't vote
	}
	/*
	$my_alg = get_my_alg($sid, $uid, $cat);
	$size = count($tab);
	// jeśli user ma już wybrany swój alg w danej sytuacji
	if($my_alg != '' && $my_alg != 0)
	{
		$i=0;
		while($tab[$i]["id"] != $my_alg && $i < $size) $i++;
		$algs = array_splice($tab, $i, 1);
		//echo '$algs (in my alg): ';
		//var_dump($algs);
	}
	//echo 'przed sortowaniem po głosach: ';
	//var_dump($tab);
	if(count($tab)>1) usort($tab,  "cmp_votes");			// sortowanie po głosach
	//echo 'po sortowaniu po głosach: ';
	//var_dump($tab);	
	if(count($tab)>1) $tab = sort_by_moves($tab, "votes");		// sortowanie po ruchach
	//echo 'po sortowaniu po ruchach: ';
	//var_dump($tab);
	//echo 'my_alg: ';
	//var_dump($my_alg);
	
   	if(count($tab) > 0 && $my_alg != '' && $my_alg != 0) $algs = array_merge($algs, $tab); //echo 'mergujemy!<br />';}
	else if($my_alg == '' || $my_alg == 0) $algs = $tab; //echo 'nie ma my_alg<br />';}
	else $algs = $algs; //echo 'tylko my_alg<br />';}
	
	if($my_alg != '') $algs[0]["if_my_alg"] = 'yes';
	
	//var_dump($algs);
	*/	
	return $tab;
}

function get_imgcats($cat, $uid)
{
      	global $imagecats;
		
	$tab = $imagecats[$cat];

      	$query = "SELECT `subcat_name`, `value` FROM `portal_users_imgcats` WHERE `user_id`=$uid AND `cat_name`='$cat';";
	$result = query($query);	
			
	while($row = mysql_fetch_row($result))
		$tab[$row[0]] = $row[1];
		
	$result = array();
		
	foreach($tab as $key=>$value)
	      if($value == 1) $result[]=$key;		
	   

	return $result;
}


function get_cat($sid)
{	
  	$methods = array('eg', 'ss', 'coll', 'ell', 'cll', 'f2ll');
  
  	$query = "SELECT portal_cats.name AS name, portal_cats_sids.chapter AS chapter FROM portal_cats, portal_cats_sids WHERE SID=$sid AND portal_cats.ID = portal_cats_sids.method;";
  	$row = mysql_fetch_assoc(query($query));
  	$method = $row['name'];
  	$ch = $row['chapter'];
  	
  	if(in_array($method, $methods)) return $method;
  	if($method == 'ortega') return $method.'_'.$ch;
  	
  	return $ch;
}

function get_prev_next($sid, $cat, $subcat='')
{
  	if($cat != 'zz')
	{
   		$query = "SELECT method FROM `portal_cats_sids` WHERE SID=$sid;";
   		$row = mysql_fetch_row(query($query));
   		$cat = $row[0];
 		
 		$query = "SELECT `prev`, `next` FROM `portal_prev_next` WHERE `method` = $cat AND `SID`=$sid;";
 	}
 	
 	else {$cat = 8; $query = "SELECT `prev`, `next` FROM `portal_prev_next` WHERE `method` = $cat AND `chapter`='$subcat' AND `SID`=$sid";}
 	
 	$row = mysql_fetch_row(query($query));
 	
 	return array('prev'=>$row[0], 'next'=>$row[1]);
}

function tree_gen($sid, $cat, $subcat, $cat_s)
{
  	// metoda
  	if($cat != 'zz')
	{
   		$query = "SELECT `method` FROM `portal_cats_sids` WHERE `SID`=$sid;";
   		$row = mysql_fetch_row(query($query));
   		$method_id = $row[0];
 		
 		$query = "SELECT `name` FROM `portal_cats` WHERE `ID`=$method_id;";
 		$row = mysql_fetch_row(query($query));
   		$method = $row[0];
   		$query = "SELECT * FROM `portal_cats_sids` WHERE `SID`=$sid AND `method`=$method_id;";
 	}
 	else 
 	{
	   	$method = 'zz'; 
  		$method_id = 8; 
  		$query = "SELECT * FROM `portal_cats_sids` WHERE `SID`=$sid AND `method`=$method_id AND chapter='$subcat';";
  	}
  
  
  	// reszta
  
  	//$query = "SELECT * FROM `portal_cats_sids` WHERE `SID`=$sid AND `method`=$method_id;";
  	
  	$row = mysql_fetch_assoc(query($query));
  	
  	$chapter = trim($row['chapter']);
  	$subchapter = trim($row['subchapter']);
  	$orientation = intval(trim($row['orientation']));
  	$permutation = intval(trim($row['permutation']));
  	
  	
  	//var_dump($row);
  	
  	include "tree.php";
  	
  	return array("tree"=>$tree, "method"=>$method, "chapter"=>$chapter, "subchapter"=>$subchapter, "orientation"=>$orientation, "permutation"=>$permutation);
  	
  
}


function get_pattern($sid)
{	
  	$query = "SELECT alg FROM portal_patterns WHERE SID=$sid";
  	$row = mysql_fetch_row(query($query));
  	
  	return $row[0];
  
}



?>
