<?php
ob_start();
session_start();

include "includes/headers.php";

// max SID
$query = "SELECT MAX(sid_id) FROM `portal_algs_sids`;";
$row = mysql_fetch_row(query($query));
$max = 1396;
$app = 30;
// algs per page
$query = "SELECT `algs_per_page` FROM `portal_users` WHERE ID=".$_SESSION['uid'].";";
$row = mysql_fetch_row(query($query));
if(!in_array($row[0], array('', null, 0, '0'), true))$app = $row[0];
$sid = intval($_GET['sid']);

include "includes/case_funcs.php";
include_once "includes/add_algs_func.php";

//include "includes/tree.php";

if(!isSet($sid) || $sid > $max)$smarty -> assign('error', 'no_sid');		// gdy nie ma takiego przypadku

else
{
	// kategoria
	if(!isSet($_GET['cat'])) {$cat = 1; $cat_s = 'TH';}
	else if($_GET['cat'] != 'oh' && $_GET['cat'] != 'fm') {$cat = 1; $cat_s = 'TH';}
	else if($_GET['cat'] == 'oh') {$cat = 2; $cat_s = 'OH';}
	else {$cat = 3; $cat_s = 'FM';}
	$smarty -> assign('cat', $cat_s);


	// głosowanie OR wybór my_alg
	if(isSet($_GET['act']) && isSet($_GET['id']))
	{
		if($_GET['act'] == 'v1' || $_GET['act'] == 'v4') vote($sid, intval($_GET['id']), $_SESSION['uid'], $cat, 1);
	
		if($_GET['act'] == 'v2') vote($sid, intval($_GET['id']), $_SESSION['uid'], $cat, -1);
	
		if($_GET['act'] == 'v3' || $_GET['act'] == 'v4') my_alg($sid, intval($_GET['id']), $_SESSION['uid'], $cat);
	}

	// paginacja
	$page = intval($_GET['page']);
	if(!isSet($_GET['page'])) $page = 1;

	$pocz = ($page-1)*$app;
	$kon = $page*$app-$pocz;
	
	
	// my_alg
	
	$my_alg_id = get_my_alg($sid, $_SESSION['uid'], $cat);
	if($my_alg_id === false) $my_alg_id = 0;
	else{
	  
	$query = "SELECT portal_algs.ID AS ide, pre, alg, htm, stm, qtm, portal_algs.user_id, username, IFNULL( SUM( vote ) , 0 ) AS suma
FROM portal_users, portal_algs
LEFT JOIN portal_votes ON portal_algs.ID = portal_votes.alg_id
AND portal_votes.sid_id =$sid
AND portal_votes.cat = $cat
WHERE portal_users.ID = portal_algs.user_id
AND portal_algs.ID = $my_alg_id
GROUP BY portal_algs.ID";
	
	$result = query($query);
	
	$row = mysql_fetch_assoc($result);
	$my_alg['id'] = $my_alg_id;
	$pre = $row["pre"];
	if(trim($pre) != '') $pre = '('.$pre.') ';
	
	$alg = trim(stripslashes($pre.$row["alg"]));
	$my_alg["alg"] = $alg;																	// alg
	$my_alg["htm"] = intval($row["htm"]);							// moves htm
	$my_alg["qtm"] = intval($row["qtm"]);							// moves qtm
	$my_alg["stm"] = intval($row["stm"]);							// moves stm									
	$my_alg["user"] = $row["username"];
	$my_alg['votes'] = $row['suma'];
	$my_alg["if_my_alg"] = 'yes';
	}
	
	//echo 'my_alg: ';
	//var_dump($my_alg);

	// pobieranie algów
	$i = 0;
	$temp = array();
	$algs = array();
	//$query = "SELECT portal_algs.ID AS ide, pre, alg, user_id, portal_algs_sids.ID, sid_id, alg_id, username, htm, qtm, stm FROM portal_algs, portal_algs_sids, portal_users WHERE sid_id=$sid AND portal_algs.ID = portal_algs_sids.alg_id AND portal_users.ID = user_id ORDER BY portal_algs.ID";
	$query = "SELECT portal_algs.ID AS ide, pre, alg, htm, stm, qtm, portal_algs.user_id, portal_algs_sids.sid_id, username, IFNULL( SUM( vote ) , 0 ) AS suma
FROM portal_algs_sids, portal_users, portal_algs
LEFT JOIN portal_votes ON portal_algs.ID = portal_votes.alg_id
AND portal_votes.sid_id =$sid
AND portal_votes.cat = $cat
WHERE portal_algs_sids.sid_id =$sid
AND portal_algs.ID = portal_algs_sids.alg_id
AND portal_users.ID = portal_algs.user_id
AND portal_algs.ID != $my_alg_id
GROUP BY portal_algs.ID
ORDER BY suma DESC , htm, qtm, stm, portal_algs.ID
LIMIT $pocz , $app ";
	$result = query($query);
	
	while($row = mysql_fetch_assoc($result))
	{
		$pre = $row["pre"];
		if(trim($pre) != '') $pre = '('.$pre.') ';
	
		$alg = trim(stripslashes($pre.$row["alg"]));
	
		$temp[$i]["id"] = intval($row["ide"]);						// id
		$temp[$i]["alg"] = $alg;																	// alg
		$temp[$i]["htm"] = intval($row["htm"]);							// moves htm
		$temp[$i]["qtm"] = intval($row["qtm"]);							// moves qtm
		$temp[$i]["stm"] = intval($row["stm"]);							// moves stm									
		$temp[$i]["user"] = $row["username"];
		$temp[$i]['votes'] = $row['suma'];															// user
		$i++;
	}
	
	if($_GET['show_algs'] == 1)
	{
	for($k=0;$k<count($temp);$k++)
		echo $temp[$k]['alg'].'<br />';
	}
	//echo 'algs po pobraniu: ';
	//var_dump($temp);
	if($my_alg_id != 0) array_unshift($temp, $my_alg);
 	
	 $algs = votuj($temp, $sid, $_SESSION['uid'], $cat);
	
	//echo 'algs po votowaniu: ';
	//var_dump($algs);
	
	

	//echo 'algs po dodaniu MA: ';
	//var_dump($algs);

	// jeśli było głosowanie - update najlepszego algu
	if(isSet($_GET['act']) && isSet($_GET['id']) && ($_GET['act'] == 'v1' || $_GET['act'] == 'v2') && $_SESSION['uid'] != 1)
	{
	  	$query = "SELECT portal_algs.ID AS ide, pre, alg, htm, stm, qtm, portal_algs_sids.sid_id, IFNULL( SUM( vote ) , 0 ) AS suma
FROM portal_algs_sids, portal_algs
LEFT JOIN portal_votes ON portal_algs.ID = portal_votes.alg_id
AND portal_votes.sid_id =$sid
AND portal_votes.cat = $cat
WHERE portal_algs_sids.sid_id =$sid
AND portal_algs.ID = portal_algs_sids.alg_id
GROUP BY portal_algs.ID
ORDER BY suma DESC , htm, qtm, stm, portal_algs.ID
LIMIT 1"; 
		//echo '$query: '.$query.'<br />';


   		$res = query($query);
   		$row = mysql_fetch_assoc($res);
   		//var_dump($row);
   		$best_alg_id = $row['ide'];
   		$best_votes = $row['suma'];
   		
   		$cat_name = 'cat_'.$cat;
   		$votes_name = 'votes_'.$cat;
   	
   		$query = "UPDATE portal_sids_best_algs SET `$cat_name`=$best_alg_id, `$votes_name`=$best_votes WHERE SID=$sid; ";
   		//echo '$query(update sids_best_algs) = '.$query.'<br />';
	   	$result = query($query);
   
 	}
	
	
	
	// przekazywanie czy user może głsować itd... 
	if($algs[0]["if_my_alg"] == 'yes') $smarty -> assign('my_alg', 'yes'); 
	else $smarty -> assign('my_alg', 'no');
	
	if($_SESSION['uid'] == 1) $smarty -> assign('can_choose_my_alg', 'no');
	else $smarty -> assign('can_choose_my_alg', 'yes');
	
	if($_SESSION['rank'] == 103) $smarty -> assign('can_edit', 'yes');
	else $smarty->assign('can_edit', 'no');
	
	if($_SESSION['uid'] != 1) $smarty-> assign('can_vote', 'yes'); 
	else $smarty-> assign('can_vote', 'no');



	// paginacja cd
	
	$query = "SELECT COUNT(ID) FROM portal_algs_sids WHERE sid_id=$sid";
	$row = mysql_fetch_row(query($query));
	
	$pages = intval(ceil($row[0]/$app));
	$smarty -> assign('act_page', $page);
	$smarty -> assign('pages', $pages);
	
	$start = 2;
	$end = $pages;
	
	
	if($pages > 10)
	{
   		$start = $page-5;
   		if($start < 2) $start = 2;
		   
		$end = $start+10; 
		if($end > $pages) $end = $pages-1;
	}
	
	$pages_tab = array();
	for($i=1;$i<=$end;$i++)
		$pages_tab[$i] = $i;
	
	$smarty -> assign('pages_start', $start);
	$smarty -> assign('pages_end', $end);
	$smarty -> assign('pages_tab', $pages_tab);
	
	//var_dump($algs);
	
	
// komentarze
/*
$query = "SELECT * FROM portal_comments WHERE SID=$sid";

if(!$result = mysql_query($query)){
		echo('Nieprawidłowe zapytanie2');
		mysql_close();
		exit;
		}
		
if(mysql_num_rows($result) != 0)		
{
	$com = array();
	
 while($row = mysql_fetch_row($result))
 {
 	$com[$i][0] = $row[0];						// ID
 	$com[$i][1] = $row[1];						// userID
 	$com[$i][2] = $row[3];						// content
 	$com[$i][3] = $row[4];						// date
	 } 


$smarty -> assign('comments', $com);
$smarty -> assign('comments_isSet', 'yes');
}
else $smarty -> assign('comments_isSet', 'no');


*/


	// kategoria && imgcats
	
	$cat = get_cat($sid);
	$images = get_imgcats($cat, $_SESSION['uid']);
	if($cat == 'ortega_cp' || $cat == 'ortega_co') $cat = 'ortega';

	//echo '$cat: '.$cat.'<br />';
	//echo 'images: ';
	//var_dump($images);
	//echo '<br />---------';

	$max = count($images);
	if($max>4) {$max = ceil($max/2); $smarty -> assign('if_next', true);}		// jeśli wiecej niż 4 obr -> przełamanie do nowej linii
	$smarty -> assign('max', $max);

	$subcat = '';
	if(isSet($_SESSION['method']) && $sid< 473) 					// na wypadek zz
	{
	  	$cat = substr($_SESSION['method'], 0,2); 
		$subcat = substr($_SESSION['method'], 2,1);
	} 	

	$smarty -> assign('images', $images);
	$smarty -> assign('cat_name', $cat);


	//poprzedni, nastepny
	$prev_next = get_prev_next($sid, $cat, $subcat);
	$smarty -> assign('prev', $prev_next['prev']);
	$smarty -> assign('next', $prev_next['next']);


	// jeśli pll -> do menu
	if($cat == 'pll')
	{
		$smarty -> assign('pll_titles', $pll_titles);
		$smarty -> assign('pll', ($sid-872));
	}



	// pattern
	
	$pattern = get_pattern($sid);
	$smarty -> assign('pattern', $pattern);



	// elementy potrzebne do drzewka

	$tab = tree_gen($sid, $cat, $subcat, $cat_s);
	$smarty -> assign('tree', $tab['tree']);
	$smarty -> assign('chapter', $tab['chapter']);												// chapter
	$smarty -> assign('subchapter', $tab['subchapter']);										// subchapter
	$smarty -> assign('orientation', $tab['orientation']);										// orientacja
	$smarty -> assign('permutation', $tab['permutation']);										// permutacja
	$smarty -> assign('method', $tab['method']);

	$smarty -> assign('sid', $sid);							

	$smarty -> assign('algs', $algs);
	$smarty -> assign('cat_s', strtolower($cat_s));
	$smarty -> assign('site_title', 'Case '.$sid.' ('.$cat_s.')');


}

/*
$tab = $smarty -> get_template_vars();
foreach($tab as $key=>$value)
{
	echo $key.' => ';
var_dump($value);
echo '<br />';
}

*/
$smarty -> display('case.tpl');
?>
