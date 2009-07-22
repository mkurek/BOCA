<?php
ob_start();
session_start();

include "includes/headers.php";
include "includes/reg_funcs.php";
include "includes/case_funcs.php";

if($_GET['act'] == 'send' && (checkCaptcha($_POST['captcha']) == '' || $_SESSION['login'] == 1) && trim($_POST['algs']) != '')
{

$errors = array();	
include_once "includes/add_algs_func.php";	

//przetwarzanie $_POST['algs']

$algs = nl2br($_POST['algs']);
$algi = explode("<br />", $algs);
if(count($algi) < 2)
{
$algi = explode(',', $algs);
		if(count($algi) < 2)
		{$algi = explode("\n", $algs);
				if(count($algi < 2))
									$algi = explode(';', $algs);
		}
}



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


//var_dump($cats);


$if_ma = $_POST['if_ma'];
$now = microtime(true);
//$algi = array();
//$query = "SELECT alg FROM portal_algs ORDER BY ID;";
//$result = query($query);
//while($row = mysql_fetch_row($result)) {$algi[] = $row[0];}
//var_dump($algi);

for($i=0;$i<count($algi);$i++)
{
$result = add_alg(stripslashes($algi[$i]), $_SESSION['uid'], $if_ma, $cats, $cats_algs, $cats_ok, $moves, $movement);
//echo '<br />alg: '.$algi[$i].'<br />result: ';
//var_dump($result);
if($result == 'bad_line') $bad_line++;
else if($result == 'bad_line2') $bad_line2++;
else if($result == 'gut') $ok++;
else {
  	$errors[$bad][0] = $result[0]; 
	$errors[$bad][1] = stripslashes($algi[$i]); 
 	if($result[0] == 'cloned') $cloned[$bad] = $result[1];
 	$bad++;
 }

}

$end = microtime(true);
$delta = $end-$now;
//echo 'czas: '.$delta.'<br />';
//echo 'ok: '.$ok.'<br />';
//echo 'bad_line: '.$bad_line.'<br />';
//echo 'bad_line2: '.$bad_line2.'<br />';
//echo 'bad: '.$bad.'<br />';
$smarty -> assign('ok', $ok);
$smarty -> assign('bad', $bad);
$smarty -> assign('bad_line', ($bad_line+$bad_line2));
$smarty -> assign('errors', $errors);
$smarty -> assign('what', 'show_raport');
$smarty -> assign('cloned', $cloned);	
}

else{	
	
	$cap = checkCaptcha($_POST['captcha']);
	
	if(trim($_POST['algs']) == '' && $_GET['act'] == 'send') $smarty -> assign('error', 'empty_form');
	else if($cap != '' && $_GET['act'] == 'send' && $uid == 1) $smarty -> assign('error', 'bad_cap');

$smarty ->assign('what', 'show_form');	
}	


$smarty -> display('add_algs.tpl');

?>
