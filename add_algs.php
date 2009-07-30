<?php
ob_start();
session_start();

include "includes/headers.php";
include "includes/reg_funcs.php";
include "includes/case_funcs.php";
include "includes/add_algs_func.php";	

$algs = array();


if(isset($_POST['algs']))
	$_POST['algs'] = trim($_POST['algs']);
else
	$_POST['algs'] = '';

if($_POST['algs'] !== '' and ($_SESSION['login'] == 1 or checkCaptcha($_POST['captcha']) == ''))
{
	
	foreach(preg_split('/(\<br \/\>)|[\,\;]/i', nl2br($_POST['algs'])) as $alg)
	{
		$alg = trim($alg);
		if(!empty($alg))
			$algs[] = stripslashes($alg);
	}
	
	// moje - start
	
	$ok = 0;
	$bad = 0;
	$bad_line = 0;
	$bad_line2 = 0;
	$movement = array();

	$query = "SELECT * FROM portal_addalgs_cats_algs;";
	$result = query($query);
	while($row = mysql_fetch_assoc($result))
	{ 
  		// cats
  		$cats[] = $row['cat'];
  	
  		// cats_algs
  		$cats_algs[$row['cat']] = $row['cat_alg'];
  	
  		// cats_ok
  		$cats_ok[$row['cat']] = array();
	}
	

	//$cats = array('cll', 'ell', 'f2ll');

	// moves

	$query = "SELECT * FROM portal_addalgs_moves;";
	$result = query($query);
	while($row = mysql_fetch_assoc($result)) 
	{
  		if($row['moves'] == NULL || $row['moves'] == '') $moves[$row['cat']] = array('');
  		else $moves[$row['cat']] = explode(',', $row['moves']);
	}

	// movement
	$query = "SELECT * FROM portal_addalgs_movement;";
	$result = query($query);
	while($row = mysql_fetch_assoc($result)) $movement[$row['cat']][] = $row['cat2'];
	
	// moje - end
	
	$good = 0;
	$bad = 0;
	$cloned = array();
	$bad_sid = array();
	
	$if_ma = $_POST['if_ma'];
	$start_time = microtime(true);
	foreach($algs as $alg)
	{
        	$result = add_alg($alg, $_SESSION['uid'], $if_ma, $cats, $cats_algs, $cats_ok, $moves, $movement);
        	//var_dump($result);
		if($result[0] == 'gut')
		{
	    		$good++;
	    		//echo 'gut!<br />';
	  	}
			
        	else if($result[0] == 'cloned')
        	{
        	  	//echo 'cloned!<br />';
            		$bad++;
            		$cloned[] = $alg;
            		//$cloned_sids[] = $result[1];
        	} 
		else
        	{
        	  	//echo 'bad<br />';
            		$bad++;
            		$bad_sid[] = $alg;
        	}
			
	}
	$processing_time = microtime(true) - $start_time;

	isset($_POST['output']) or $_POST['output'] = 'html';

	if($_POST['output'] == 'json')
	{
		echo json_encode(array(
			'good' => $good,
			'bad' => $bad,
            		'cloned' => $cloned,
            		'unrecognized' => $bad_sid,
			'total' => count($algs),
			'time' => $processing_time,
		));
	} else
	{
		$smarty -> assign('ok', $good);
		$smarty -> assign('bad', $bad);	
		$smarty -> assign('bad_sid', $bad_sid);
		$smarty -> assign('cloned', $cloned);
		$smarty -> display('add_algs.tpl');
	}
}
else if($_POST['algs'] !== '' and $_SESSION['login'] !== 1 and checkCaptcha($_POST['captcha']) !== '')
{	
	$smarty -> assign('error', 'bad_cap');
	$smarty -> assign('what', 'show_form');	
	$smarty -> display('add_algs.tpl');
} else
{
	if($_SESSION['login'] === 1)
		$smarty -> assign('use_js', TRUE);

	$smarty -> assign('what', 'show_form');	
	$smarty -> display('add_algs.tpl');
}	
