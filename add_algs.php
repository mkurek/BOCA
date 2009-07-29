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
	
	$good = 0;
	$bad = 0;
	
	$if_ma = $_POST['if_ma'];
	$start_time = microtime(true);
	foreach($algs as $alg)
	{
        $result = add_alg($alg, $_SESSION['uid'], $if_ma);
		if($result == 'gut')
			$good++;
        else if($result == 'cloned')
        {
            $bad++;
            $cloned[] = $alg;
        } else
        {
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
		$smarty -> assign('ok', $ok);
		$smarty -> assign('bad', $bad);	
		$smarty -> assign('bads', $bads);
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
