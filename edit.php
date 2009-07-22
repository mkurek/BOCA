<?php
ob_start();
session_start();

include "includes/headers.php";
include "includes/add_algs_func.php";
include "includes/case_funcs.php";

if(!isSet($_GET['cat'])) {$cat = 1; $cat_s = 'TH';}
if($_GET['cat'] != 'oh' && $_GET['cat'] != 'fm') {$cat = 1; $cat_s = 'TH';}
if($_GET['cat'] == 'oh') {$cat = 2; $cat_s = 'OH';}
if($_GET['cat'] == 'fm') {$cat = 3; $cat_s = 'FM';}

$sid = $_GET['sid'];
$sid = explode(',', $sid);
if($sid[1] == '') $sid[1] = $sid[0];
$id = $_GET['id'];

if($_GET['act'] == 'st2')
{
	$alg = obrobka(parse(stripslashes($_POST['alg'])));
	
	//echo 'alg1: '.$alg.'<br /><br />';
		
	if($sid[0]>900 && $sid[1]<985) $cat = 'eg';
	else if($sid[0] > 852 && $sid[1]<859) $cat='eg';
	else if(($sid[0]>472 && $sid[1]<775) || ($sid[0] > 978 && $sid[1] < 1097)) $cat = 'zbf2l';
	else $cat = 'pll';
	
	
$tab = search_pre_post($alg, $cat);
$pre = parse(trim($tab[0]));
$alg = parse(trim($tab[1]));
$post = parse(trim($tab[2]));


//echo '$alg: '.$alg.'<br />$pre: '.$pre.'<br />$post: '.$post.'<br /><br />';


$jac = jacubize(trim($pre.$alg.$post));

if($sid[0]>472 && $sid[1]<775) $jac = zbf2lize($jac);
if($sid[0]>795 && $sid[1]<853) $jac = ollize($jac);
if($sid[0]>852 && $sid[1]<979) $jac = pocketize($jac);

//if(!cloned(addslashes($alg))) 

	//echo 'cloned!<br /><br />';
	//$smarty->assign('message', 'cloned');

	
	$alg = addslashes(parse($alg));
	$pre = addslashes(parse($pre));
	$post = addslashes(parse($post));
	
	//echo '$alg: '.$alg.'<br />$pre: '.$pre.'<br />$post: '.$post.'<br />$jac: '.$jac.'<br /><br />';
	
	$query = "UPDATE `portal_algs` SET `pre-moves`='$pre', `alg`='$alg', `post-moves`='$post', `hash`='$jac' WHERE ID=$id;";
	$result = query($query);
	
	$smarty -> assign('message', true);
}


$query = "SELECT `pre-moves`, `alg`, `post-moves`, `hash` FROM `portal_algs` WHERE ID=$id;";

$result = query($query);

$row = mysql_fetch_row($result);

$alg = parse(stripslashes($row[0].$row[1].$row[2]));
$jac = $row[3];



$smarty -> assign('cat', $cat_s);
$smarty ->assign('alg', $alg);
$smarty -> assign('name', $sid);
$smarty ->assign('id', $id);
$smarty->register_modifier("sslash","stripslashes");
$smarty -> assign('jac', $jac);

$imgcat = get_cat($sid[0], $sid[1]);
$imgcats = get_imgcats($imgcat, 2);
if($imgcat == 'ortega_cp' || $imgcat == 'ortega_co') $imgcat = 'ortega';

$var_imgcats = 'var imgcats = new Array(';
for($i=0;$i<count($imgcats);$i++) {$var_imgcats .= '\''.$imgcats[$i].'\''; if($i<(count($imgcats)-1)) $var_imgcats .= ',';}
$var_imgcats .= ');';

$var_catname = 'var catname = \''.$imgcat.'\';';

$smarty -> assign('var_imgcats', $var_imgcats);
$smarty -> assign('var_catname', $var_catname);
$smarty -> assign('cat_name', $imgcat);
$smarty -> assign('images', $imgcats);

$smarty ->display('edit.tpl');
