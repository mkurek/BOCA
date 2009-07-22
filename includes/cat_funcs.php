<?php

include_once "add_algs_func.php";
include_once "case_funcs.php";


function get_algs($min, $max, $cat, $uid)
{
	$algs = array();

	for($i=$min;$i<=$max;$i++)
	{
		$algs[] = get_best_alg($i, $cat, $uid);
	}

	return $algs;
}

function get_avg_moves($query, $cat, $uid)
{
  
  	if($query == "SELECT MIN(SID) AS SID, MAX(SID) AS SID2, subchapter FROM `portal_cats_sids` WHERE method=1 AND chapter='zbf2l' ORDER BY ID") 
  	$query = "SELECT SID, subchapter FROM `portal_cats_sids` WHERE method=1 AND chapter='zbf2l' ORDER BY ID";
  
  	//echo '$query2: '.$query.'<br />';
	$result = query($query);
	$htm = 0;
	$qtm = 0;
	$stm = 0;
	$k = 0;
	while($row = mysql_fetch_row($result))
	{
   		$alg = get_best_alg(intval($row[0]), $cat, $uid);
   		//var_dump($alg);
   		$htm += $alg['htm'];
		$qtm += $alg['qtm'];
		$stm += $alg['stm'];
		
		$k++;
		//echo '-----------------------------<br /><br />';
	}
	
	//echo 'htm: '.$htm.'<br />';
	//echo '$k: '.$k.'<br />';
	if($k != 0)
	{
	  	$htm = round($htm/$k, 2);
		$stm = round($stm/$k, 2);
		$qtm = round($qtm/$k, 2);
	}

	return array("htm"=>$htm, "qtm"=>$qtm, "stm"=>$stm);
}	

function get_best_alg($sid, $cat, $uid)
{
  	$my_alg = get_my_alg($sid, $uid, $cat);
  	
   	if($my_alg !== false && $my_alg != '' && $uid != 1) $alg_id = $my_alg;
   	else
   	{
   		$cat_name = "cat_".$cat;
   		$votes_name = "votes_".$cat;
   		$query = "SELECT $cat_name AS cat FROM portal_sids_best_algs WHERE SID=$sid";
   		$result = query($query);
   		$row = mysql_fetch_assoc($result);
   		$alg_id = intval($row['cat']);
   		//echo 'alg_id: ';
   		//var_dump($row);
   	}
   	//echo 'my_alg: ';
   	//var_dump($my_alg);
   	
   	
   	//echo 'test1<br />';
   	$query = "SELECT * FROM portal_algs WHERE ID=$alg_id";
	$result = query($query);
	//echo 'test2<br />';
	$row = mysql_fetch_assoc($result);
     		
	$pre = $row["pre"];
	if(trim($pre) != '') $pre = '('.$pre.') ';
	
	$alg = trim(stripslashes($pre.$row["alg"]));
	
	$temp["id"] = intval($row["ID"]);							// id
	$temp["alg"] = $alg;																	// alg
	$temp["htm"] = intval($row["htm"]);							// moves htm
	$temp["qtm"] = intval($row["qtm"]);							// moves qtm
	$temp["stm"] = intval($row["stm"]);							// moves stm	
		
	return $temp;	
}

function what_n($m, $ch, $sch, $o, $p)
{
  	$no_way = array('',0,'0',NULL);
  	
    	//if(in_array($ch, $no_way, true)) echo 'brak ch!<br />';
  	if(in_array($ch, $no_way, true) && in_array($sch, $no_way, true) && in_array($o, $no_way, true) && in_array($p, $no_way, true) && $m != 4 && $m != 9) return 'chapter'; 
  	if(($m == 4 || $m ==9) && in_array($o, $no_way, true)) return 'orientation';
  	if(($m == 8 && $ch == 'd' && !in_array($o, $no_way, true)) || ($m == 10 && !in_array($ch, $no_way, true))) return 'case';
  	
	// sprawdzanie czy nast=chapter
  	$query = "SELECT * FROM portal_cats_sids WHERE method=$m AND chapter='$ch' LIMIT 1";
  	$result = query($query);
  	$row = mysql_fetch_assoc($result);
  	//echo '$row: ';
  	//var_dump($row);
  	
  	$tab = array();
  	
  	//echo 'subchapter: '.$row['subchapter'].'<br />';
  	//echo 'or: '.$row['orientation'].'<br />';
  	//echo 'per: '.$row['permutation'].'<br />';
  	$tab['method'] = 'chapter';
  	if(!in_array($row['subchapter'], $no_way, true)) 
	{
	  	
	    	$tab['chapter'] = 'subchapter';
	    	if(!in_array($row['orientation'], $no_way, true))
	    	{
        		$tab['subchapter'] = 'orientation';
        		if(!in_array($row['permutation'], $no_way, true)) $tab['orientation'] = 'permutation';
      		}
      		
      		else if (!in_array($row['permutation'], $no_way, true)) $tab['subchapter'] = 'permutation';
  	}
  	
  	else if(!in_array($row['orientation'], $no_way, true))
  	{
 		if(!in_array($ch, $no_way, true))$tab['chapter'] = 'orientation';
 		else $tab['method'] = 'orientation';
 		if(!in_array($row['permutation'], $no_way, true)) $tab['orientation'] = 'permutation';
	}
	
	else if(!in_array($row['permutation'], $no_way, true)) $tab['chapter'] = 'permutation';
  
  	//echo '$tab: ';
  	//var_dump($tab);
  	
  	if(in_array($ch, $no_way, true) && in_array($sch, $no_way, true) && !in_array($o, $no_way, true) && in_array($p, $no_way, true)) {return 'case';}
  	if(!in_array($ch, $no_way, true) && in_array($sch, $no_way, true) && in_array($o, $no_way, true) && in_array($p, $no_way, true)) {if(array_key_exists('chapter', $tab)) return $tab['chapter']; else return 'case';}
  	if(!in_array($ch, $no_way, true) && !in_array($sch, $no_way, true) && in_array($o, $no_way, true) && in_array($p, $no_way, true)) {if(array_key_exists('subchapter', $tab)) return $tab['subchapter']; else return 'case';}
  	if(!in_array($ch, $no_way, true) && !in_array($sch, $no_way, true) && !in_array($o, $no_way, true) && in_array($p, $no_way, true)) {if(array_key_exists('orientation', $tab)) return $tab['orientation']; else return 'case';}
	if(!in_array($ch, $no_way, true) && in_array($sch, $no_way, true) && in_array($o, $no_way, true) && !in_array($p, $no_way, true)) {if(array_key_exists('permutation', $tab)) return $tab['permutation']; else return 'case';}
	if(!in_array($ch, $no_way, true) && in_array($sch, $no_way, true) && !in_array($o, $no_way, true) && in_array($p, $no_way, true)) {if(array_key_exists('orientation', $tab)) return $tab['orientation']; else return 'case';}
	if(!in_array($ch, $no_way, true) && in_array($sch, $no_way, true) && !in_array($o, $no_way, true) && !in_array($p, $no_way, true)) {if(array_key_exists('permutation', $tab)) return $tab['permutation']; else return 'case';}
	
	return false;
}


function get_img_cats($m, $ch, $sch, $o, $p)
{
  
  	//var_dump(func_get_args());
  
  	$no_way = array('',0,'0',NULL);
  	
  	$top_img_cat = '';
  	$top_img_cats = '';
  	
  	$query = "SELECT * FROM `portal_cats_imgcats` WHERE method=$m ";
	if(!in_array($ch, $no_way, true)) $query .= "AND chapter='$ch' ";
	else $query .= "AND chapter=0 ";
  	if(!in_array($sch, $no_way, true)) $query .= "AND subchapter=1 ";
  	else $query .= "AND (subchapter=0 OR subchapter=NULL OR subchapter='')";
  	if(!in_array($o, $no_way, true)) $query .= "AND orientation=1 ";
  	else $query .= "AND (orientation=0 OR orientation=NULL OR orientation='') ";
  	if(!in_array($p, $no_way, true)) $query .= "AND permutation=1";
  	else if($m != 8 && $ch != 'd')$query .= "AND permutation=0";
  
  	//echo 'get_img_cats - query: '.$query.'<br />';
  
  	$result = query($query);
  	if(mysql_num_rows($result) == 0)  return false;
  	  	
  	$row = mysql_fetch_assoc($result);
	$imgcat = $row["imgcat"];
	$imgcats = explode(',', $row["imgcats"]);
	
	if(!in_array($row["top_img"], $no_way, true)) $top_img = $row["top_img"];
	if(!in_array($row["top_img_cats"], $no_way, true)) $top_img_cats = explode(',',$row["top_img_cats"]);
     	
     	if($m == 6 && in_array($ch, $no_way, true)) {$top_img = 'cat'; $top_img_cats = array('down');}
     	
     	return array("imgcat"=>$imgcat, "imgcats"=>$imgcats, "top_img"=>$top_img, "top_img_cats"=>$top_img_cats, "title"=>$row['title']);	
}

function get_title_big_little($m,$ch,$sch,$o,$p)
{
  	include_once "includes/arrays.php";
	global $lang, $smarty, $zb_title_big, $zb_title_little, $zb_title_little_h, $zz_d_title_big, $zz_d_title_little, $zz_d_full_title_little, $zz_b_title_big, $zz_b_title_little, $zz_b_title_little_h, $colls_title, $pll_titles, $cls_titles, $cls_titles2, $ss_titles, $ss_titles2, $ell_titles, $clls_title;  
	$no_way = array('',0,'0',NULL);
	$tab = array("title_big"=>'', "title_little"=>'', "titles_cell"=>'');  
	  
	  
	if($m == 'zb' && $ch == 'zbll')
	{
	  	if(in_array($o, $no_way, true) && in_array($p, $no_way, true)) 
 		{
  			for($i=0;$i<7;$i++)
  		 		for($j=0;$j<72;$j++)
	  		  	{
 		  	  		if($i != 6)
				  		if($zb_title_little[$j] != '') $title_little[$i*72+$j] = $zb_title_little[$j]; 				  	
			     		
				  	else
				  		if($zb_title_little_h[$j] != '') $title_little[$i*72+$j] = $zb_title_little_h[$j];
		    		}
		     
		   	$tab["title_big"] = $zb_title_big;
		   	$tab["title_little"] = $title_little;
		   	return $tab;
   		}
	  
		if(!in_array($o, $no_way, true) && in_array($p, $no_way, true))
		{
    			$tym = ($o-1)*72+1;
  	  		$title_big = array(1=>$zb_title_big[$tym]);
	  		if($o != 7) $title_little = $zb_title_little;
	  		else $title_little=$zb_title_little_h;
	  		
	  		$tab["title_big"] = $title_big;
		   	$tab["title_little"] = $title_little;
	  		return $tab;
      		}
      		
      		if(!in_array($o, $no_way, true) && !in_array($p, $no_way, true))
		{
    			$tym = ($o-1)*72+1;
  	  		$title_big = array(1=>$zb_title_big[$tym]);
  	  		$tym2 = ($p-1)*12+1;
		 	if($o != 7) $title_little = array(1=>$zb_title_little[$tym2]);
		 	else {if($p == 4) $tym2-=4; $title_little=array(1=>$zb_title_little_h[$tym2]);}
    
    			$tab["title_big"] = $title_big;
		   	$tab["title_little"] = $title_little;
	  		return $tab;
  		}		
	}  	
  	
  	if($m == 'zz')
  	{
     		if(in_array($o, $no_way, true) && in_array($p, $no_way, true))
     		{
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
  				$tab["title_big"] = $zz_b_title_big;
  				$tab["title_little"] = $title_little;
	  		}
		     				
			else
			{
				$tab["title_big"] = $zz_d_title_big;		     				
				$tab["title_little"] = $zz_d_full_title_little;
 			}	
       		}
     
     		if(!in_array($o, $no_way, true) && in_array($p, $no_way, true) && $ch == 'b')
     		{
			$temp = $zz_b_title_little; 
		  	$temp2 = $zz_b_title_little_h; 
  						  	
			for($j=0;$j<22;$j++)
 			{
				if($o != 7 && $temp[$j] != '') $title_little[$j] = $temp[$j]; 			  	
				if($o == 7 && $temp2[$j] != '') $title_little[$j] = $temp2[$j]; 
    			}
			
			$tab["title_big"] = array(1=>$zz_b_title_big[(($o-1)*24)+1]);
         		$tab["title_little"] = $title_little;
       		}
     
     		if(!in_array($o, $no_way, true) && !in_array($p, $no_way, true))
     		{
         		$title_big = array(1=>$zz_b_title_big[(($o-1)*24)+1]);
	  	 	$tym2 = ($p-1)*4+1;
      			if($o != 7) $title_little = array(1=>$zz_b_title_little[$tym2]);
		 	else $title_little=array(1=>$zz_b_title_little_h[$tym2]);
         		
		 	$tab["title_big"] = $title_big;
		   	$tab["title_little"] = $title_little;
       		}
     
     		return $tab;
   	}
  	
  	
  	if($m == 'zb'  && $ch == 'zbf2l')
	{
	  	if(in_array($sch, $no_way, true)) 
 			$tab["title_little"] = array(1=>1, 17=>2, 33=>3, 49=>4, 65=>5, 81=>6, 97=>7,113=>8,129=>9,145=>10, 161=>11,
			  177=>12, 193=>13, 209=>14, 225=>15, 241=>16, 257=>17, 273=>18, 289=>19, 291=>20, 297=>21);
		else $tab["title_little"] = array(1=>$sch);
	  		
  		return $tab;
      			
	}
	
	if($m == 'coll')
	{
   		if(in_array($o, $no_way, true)) $tab["title_big"] = $colls_title;
       		else $tab["title_big"] = array(1=>$colls_title[($o-1)*6+1]);
		
		return $tab;	
	}

	if($m == 'cll')
	{
   		if(in_array($o, $no_way, true)) $tab["title_big"] = $clls_title;
       		else $tab["title_big"] = array(1=>$clls_title[($o-1)*6+1]);
		
		return $tab;	
 	}

  
  	if($m == 'eg')
  	{
     		if(in_array($ch, $no_way, true))
     		{
         		$title_big = array();	
			$k=0;	
			for($i=0;$i<120;$i++)
			{
				
			if($i==40 || $i== 80) $k=0;
			if($colls_title[$k] != '') $title_big[$i] = $colls_title[$k];
			$k++;
			}
         
         		$tab["title_big"] = $title_big;
      	 	}
		       
		else if(!in_array($ch, $no_way, true) && in_array($o, $no_way, true)) 
			$tab["title_big"] = $colls_title;
			
		else $tab["title_big"] = array(1=>$colls_title[($o-1)*6+1]);
    			
    		return $tab;
   	}
  
  	if($m == 'fridrich' && $ch == 'pll')
  	{
         		$tab["titles_cell"] = $pll_titles;
         		if($lang == 'pl') $before = true;
         		else $before = false;
         		
         		$smarty -> assign('titles_cell_before', $before);
			$smarty -> assign('titles_cell_text', 'permutation');
			
			return $tab;
  	}
  
  	if($m == 'mgls' && $ch == 'cls')
  	{	
  	  	if(in_array($sch, $no_way, true))
  	  		$tab["title_big"] = $cls_titles;
	 		   	
     		else 
    			$tab["title_big"] = array(1=>$sch);
    			
		return $tab;
   	}
   	
   	if($m == 'ell')
  	{	
  	  	if(in_array($sch, $no_way, true))
  	  		$tab["title_big"] = $ell_titles;
	 		   	
     		else 
    			$tab["title_big"] = array(1=>$sch);
    			
		return $tab;
   	}
  
  	if($m == 'ss')
  	{
     		if(in_array($ch, $no_way, true))
  	  		$tab["title_big"] = $ss_titles;
	 		   	
     		else 
    			$tab["title_big"] = array(1=>$ch);
    			
		return $tab;	
     
   	}
  	return $tab;
}



?>
