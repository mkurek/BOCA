<?php
ob_start();
session_start();
include "includes/headers.php";
include "includes/cat_funcs.php";
include_once "includes/case_funcs.php";

$method = '';
$chapter = '';
$subchapter = '';
$orientation = '';
$permutation = '';
$if_method= false;
$if_chapter = false;
$if_subchapter = false;
$if_orientation = false;
$if_permutation = false;
$mode = "normal";
$in_section = '';
$sids = '';
$patterns = array();
$algs = array();
$img_main = false;
$top_img_cat = '';
$top_img_cats = '';
$img_diff = false;
$step = 2;


$m = htmlspecialchars($_GET['m']);
$ch = htmlspecialchars($_GET['ch']);
$sch = htmlspecialchars($_GET['sch']);
$o = htmlspecialchars(intval($_GET['o']));
$p = htmlspecialchars(intval($_GET['p']));
if(isSet($_GET['mode'])) $mode = htmlspecialchars($_GET['mode']);

if($m == '' && ($_GET['special'] != 1 || !isSet($_GET['special']))) include("includes/cats/cats.php");

else if($_GET['special'] == 1) 	// LL sub10 ruchów
{
  	$query = " SELECT portal_algs_sids.sid_id AS SID, portal_algs.ID AS ide, htm
FROM portal_algs_sids, portal_algs
WHERE portal_algs.ID = portal_algs_sids.alg_id
AND portal_algs.htm <10
AND (
portal_algs_sids.sid_id <473
OR portal_algs_sids.sid_id
BETWEEN 873
AND 893
)
GROUP BY SID
ORDER BY SID";

	$result = query($query);

	while($row = mysql_fetch_assoc($result))
	{
	  	//var_dump($row);
  		$sids[] = $row['SID'];
	}
  
  	//echo 'algów: '.count($sids).'<br />';
  
  	for($i = 0; $i < count($sids); $i++)
  	{	
  	  	$sid = $sids[$i];
  	  	//echo '$sid: '.$sid.'<br />';
	    	$query = "SELECT alg FROM portal_patterns WHERE SID=$sid;";
    		$row2 = mysql_fetch_row(query($query));
    		$patterns[] = $row2[0];
   		$algs[] = get_best_alg($sid, 3, $_SESSION['uid']);
  	}
  
  	$htm = 0;
	$qtm = 0;
	$stm = 0;
	$k = 0;
	for($i = 0;$i<count($algs);$i++)
	{
		$htm += $algs[$i]['htm'];
		$qtm += $algs[$i]['qtm'];
		$stm += $algs[$i]['stm'];
		$k++;
	}
     		
	if($k != 0)
	{
		$htm = round($htm/$k, 2);
		$stm = round($stm/$k, 2);
		$qtm = round($qtm/$k, 2);
	}
     		
	$avg_moves = array("htm"=>$htm, "qtm"=>$qtm, "stm"=>$stm);
  
  	$smarty -> assign('file', 'cat');
	$imgcat = get_cat($sids[0]);
	$imgcats = get_imgcats($imgcat, $_SESSION['uid']); 
	$smarty -> assign('column', 2);
	//echo '$tab_titles_big_little: ';
  	//var_dump($titles);	
	$smarty -> assign('colspan', count($imgcats));			
	$smarty -> assign('title_big', array('','SPECIAL -> LL SUB-10 htm'));				// tytuly glowne
	$smarty -> assign('algs', $algs);
  
  	$smarty -> assign('image_cat', $imgcat);					// glowna kategoria obrazkow
	$smarty -> assign('img_cats', $imgcats);					// podkategorie obrazkow

	$smarty -> assign('situations_id', $sids);					// sid_array
	//if(count($algs)>0) $smarty -> assign('avg', get_avg_moves($algs));		// średnia ruchów
	$smarty -> assign('size', count($patterns));					// rozmiar algow (?)
	$smarty -> assign('patterns', $patterns);
  
  	$smarty -> assign('htm_avg', $avg_moves['htm']);
	$smarty -> assign('qtm_avg', $avg_moves['qtm']);
	$smarty -> assign('stm_avg', $avg_moves['stm']);
	$smarty -> assign('mode', 'print');
  
  	$smarty -> display('print.tpl');
}


// NORMAL

else 
{
  	//echo 'metoda istnieje!<br />';
  	$no_way = array('', 0,'0',NULL);
  	/*
  	echo 'method: ';
  	var_dump($m);
  	echo 'chapter: ';
  	var_dump($ch);
  	echo 'subchapter: ';
  	var_dump($sch);
  	echo 'or: ';
  	var_dump($o);
  	echo 'per: ';
  	var_dump($p);
  	*/
  	while(true)
	{
	  
		$query = "SELECT ID FROM `portal_cats` WHERE name='$m';";
  		$result = query($query);
  		if(mysql_num_rows($result) == 0 ) {include "includes/cats/cats.php"; break;}
  		$row = mysql_fetch_row($result);
  		$method_id = intval($row[0]);  
  		//echo 'method_id: '.$method_id.'<br />';
 	
 		
 		// co wybieramy
 		$what_next = what_n($method_id, $ch, $sch, $o, $p);
 		//var_dump($what_next);
 		if($what_next === false) {include "includes/cats/cats.php"; break;}
  		$smarty -> assign('what_in_section', $what_next);				// co się zmienia w section
  	
  		// step
  		if($m == 'zb' && $ch=='zbf2l' && in_array($sch,$no_way, true)) $step = 4;
  
  		//echo 'ok!';
  		// level
  		if(($m == 'zb' || $m == 'zz') && (in_array($ch, $no_way, true) || ($ch != 'zbll' && $ch != 'zbf2l' && $ch != 'b' && $ch != 'd'))) $img['title'] = "choose_".$m."_cat";
  		else if($m == 'fridrich' && in_array($ch, $no_way, true)) $img['title'] = 'choose_fridrich_cat';
  		else if($m == 'ortega' && in_array($ch, $no_way, true)) $img['title'] = 'choose_ortega_cat';
  		else if($m == 'mgls' && in_array($ch, $no_way, true)) $img['title'] = 'choose_mgls_cat';
  		else
  		{
  	  		//echo 'chapter: '.$ch.'<br />';
			$img = get_img_cats($method_id, $ch, $sch, $o, $p); 
			//echo '$img!'; 
			//var_dump($img);
			if($img === false) {include "includes/cats/cats.php"; break;}
			//echo '$IMG: ';
			//var_dump($img);
			$imgcat = $img['imgcat'];
			$imgcats = $img['imgcats'];
			if(!in_array($img["top_img"], $no_way, true))  
			{
   				$img_main = true;
   				$top_img_cat = $img["top_img"];
   				$top_img_cats = $img["top_img_cats"];
 			}
		}  
	 
  		// jaki plik
  		if($what_next == 'case') $smarty -> assign('file', 'case');
  		else $smarty -> assign('file', 'cat');
  	
  		$query = '';
  		//echo 'ok2!<br />';
  		// w zależności od tego jakie są zmienne GET -> query
  		if($ch == 'zbf2l' && $what_next != 'case' && $mode != 'print') $query_pocz = "SELECT MIN(SID) AS SID, MAX(SID) AS SID2";
		else  $query_pocz = "SELECT SID";
  		
  		if($what_next != 'case') $query .= ", $what_next";
 		$query .= " FROM `portal_cats_sids` WHERE method=$method_id ";
  	
  		if(!in_array($ch, $no_way, true)) {$query .= "AND chapter='$ch' "; $if_chapter = true; $chapter = $ch;}
  		if(!in_array($sch, $no_way, true)) {$query .= "AND subchapter='$sch' "; $if_subchapter = true; $subchapter = $sch;}
  		if(!in_array($o, $no_way, true)) {$query .="AND orientation=$o "; $if_orientation = true; $orientation = $o;}
  		if(!in_array($p, $no_way, true)) {$query .= "AND permutation=$p "; $if_permutation = true; $permutation = $p;}
  	
  		$query_temp = "SELECT SID".$query."ORDER BY ID";
	 	//echo 'what_next: '.$what_next.'<br />'; 
  		if($what_next != 'case' && $mode != 'print')$query .= "GROUP BY $what_next ";
 		$query .= "ORDER BY ID";
  		$query = $query_pocz.$query;
  		//echo 'query: '.$query.'<br />';
  	
  		$result = query($query);
  	
  		$licznik = 0;
  	
  		while($row = mysql_fetch_assoc($result))
  		{
  	  		$sid = intval($row['SID']); 
         		$query2 = "SELECT alg FROM portal_patterns WHERE SID=$sid;";
    			$row2 = mysql_fetch_row(query($query2));
    			$patterns[] = $row2[0];
  	  
  	  		if($ch == 'zbf2l' && $what_next !='case') 
	    		{
     				$sid2 = intval($row['SID2']);
  	  			$query3 = "SELECT alg FROM portal_patterns WHERE SID=$sid2;";
    				$row3 = mysql_fetch_row(query($query3));
	    			$patterns[] = $row3[0];
  	  		}
  	  	
     			if($what_next != 'case' && $mode != 'print')
     			{
         			$in_section[] = $row[$what_next];
         			if($ch == 'zbf2l' && $what_next !='case') $in_section[] = $row[$what_next];
     			}
     		
     			else
     			{	
     		  		$sids[] = $sid;
     		  		//echo '$sid: ';
     		  		//var_dump($sid);
     		  		//echo '<br />';
         			if($mode == 'print')
         			{
				 	$algs[] = get_best_alg($sid, $cat_l, $_SESSION['uid']);
				 	
				 	if((($m == 'ss' || $ch == 'cls') && in_array($licznik, array(26,53,80))) || ($m == 'ell' && in_array($licznik, array(2))))
				 	{
						$sids[] = 0;
						$patterns[] = 0;
						$algs[] = 0;
			   		}
				 	
			 	}
         			
       			}	
   			$licznik++;
		   
	   	}
  	
		if(count($patterns) == 0) include "includes/cats/cats.php";  
	   	
  		break;
  	}

	if($mode != 'print' && count($in_section) > 0) $avg_moves = get_avg_moves($query_temp, $cat_l, $_SESSION['uid']);
	else
	{
	  	$htm = 0;
		$qtm = 0;
		$stm = 0;
		$k = 0;
   		for($i = 0;$i<count($algs);$i++)
   		{
       			$htm += $algs[$i]['htm'];
			$qtm += $algs[$i]['qtm'];
			$stm += $algs[$i]['stm'];
       			if($algs[$i]['htm']!= '' && $algs[$i]['htm'] != 0)$k++;
     		}
     		
     		if($k != 0)
		{
	  	$htm = round($htm/$k, 2);
		$stm = round($stm/$k, 2);
		$qtm = round($qtm/$k, 2);
		}
     		
   		$avg_moves = array("htm"=>$htm, "qtm"=>$qtm, "stm"=>$stm);
   
 	}
	//var_dump($avg_moves);

}


if($_GET['special'] != 1 || !isSet($_GET['special']))
{
$method = $m;
/*
echo '$patterns: ';
var_dump($patterns);
echo '$in_section: ';
var_dump($in_section);
echo '$sids: ';
var_dump($sids);
echo '$algs: ';
var_dump($algs);
*/

if($what_next == 'chapter') $if_chapter = true;
else if($what_next == 'subchapter') $if_subchapter = true;
else if($what_next == 'orientation') $if_orientation = true;
else if($what_next == 'permutation') $if_permutation = true; 


if($level != 'method_choose') include "includes/tree.php";
else $tree = false;

// obrazek główny
$smarty -> assign('img_main', $img_main);  					// czy obrazek "glowny"
$smarty -> assign('top_img_cat', $top_img_cat);					// kategoria gl. obrazka
$smarty -> assign('top_img_cats', $top_img_cats);				// podkategorie

// jeśli drukowanie
if($mode == 'print')
{
	$smarty -> assign('file', 'cat');
	$imgcat = get_cat($sids[0]);
	$imgcats = get_imgcats($imgcat, $_SESSION['uid']); 
	if($imgcat == 'ortega_co' || $imgcat == 'ortega_cp') $imgcat = 'ortega';
	if(count($imgcats) > 3) $smarty -> assign('column', 1);
	else if((count($imgcats) > 1 && count($imgcats) < 4) || $m == 'ss') $smarty -> assign('column', 2);
	else $smarty -> assign('column', 3);
	
	if($m == 'eg') $smarty -> assign('top_imgs', true);
	
	$titles = get_title_big_little($m, $ch, $sch, $o, $p);
	//echo '$tab_titles_big_little: ';
  	//var_dump($titles);
	  
  
	  	
	$smarty -> assign('colspan', count($imgcats));			
	$smarty -> assign('title_big', $titles['title_big']);				// tytuly glowne
	$smarty -> assign('title_little', $titles['title_little']);			// tytuly posrednie
	$smarty -> assign('titles_cell', $titles['titles_cell']);
	$smarty -> assign('algs', $algs);					// algi
	$smarty -> assign('sids_table', $sids);
}

$smarty -> assign('image_cat', $imgcat);					// glowna kategoria obrazkow
$smarty -> assign('img_cats', $imgcats);					// podkategorie obrazkow

$smarty -> assign('situations_id', $sids);					// sid_array
//if(count($algs)>0) $smarty -> assign('avg', get_avg_moves($algs));		// średnia ruchów
$smarty -> assign('size', count($patterns));					// rozmiar algow (?)
$smarty -> assign('patterns', $patterns);
$smarty -> assign('in_section', $in_section);					// co do przelecenia w section	

$smarty -> assign('chapter', $chapter);						// chapter
$smarty -> assign('subchapter', $subchapter);					// subchapter
$smarty -> assign('orientation', $orientation);					// orientacja
$smarty -> assign('permutation', $permutation);					// permutacja
$smarty -> assign('method', $m);						// metoda
$smarty -> assign('if_chapter', $if_chapter);													// czy $_GET('ch')
$smarty -> assign('if_subchapter', $if_subchapter);											// czy $_GET('sch')
$smarty -> assign('if_orientation', $if_orientation);											// czy $_GET('o')
$smarty -> assign('if_permutation', $if_permutation);

$smarty -> assign('htm_avg', $avg_moves['htm']);
$smarty -> assign('qtm_avg', $avg_moves['qtm']);
$smarty -> assign('stm_avg', $avg_moves['stm']);

if($level != 'method_choose')$smarty -> assign('level', $img['title']);		// aktualny wybór
$smarty -> assign('tree', $tree);						// tree
$smarty -> assign('step', $step);						// krok w petlach
$smarty -> assign('mode', $mode);

if($chapter == 'pll') $smarty -> assign('pll_titles', $pll_titles);


// na wypadek zz
if($m == 'zz' && $what_next == 'case')
{
 	$_SESSION['method'] = 'zz'.$chapter;	
}
else {if(isSet($_SESSION['method'])) unset($_SESSION['method']);}


if(!isSet($_GET['tpl']))
{
	if($mode == 'print' && isSet($_GET['m']) && count($algs) > 0) 
	/*if(($m == 'zb' || $m == 'zz' || $m=='ortega' || $m=='fridrich') && isSet($_GET['ch']))*/ $smarty -> display('print.tpl');
	else $smarty -> display('cat_new.tpl');
	}
}
//else {$smarty -> display('cat_new.tpl'); echo 'cat';}

if($_GET['tpl'] == 1)
{
$tab = $smarty -> get_template_vars();

echo '<b>------------------------------------------------</b><br />ZMIENNE PRZEKAZANE: <br />';
foreach($tab as $key=>$value)
{
	echo $key.' => ';
var_dump($value);
echo '<br />';
}
}



?>
