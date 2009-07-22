<?php
ob_start();
session_start();
include "includes/headers.php";
include_once "includes/add_algs_func.php";

$alg = $_GET['data'];

//echo '$alg: '.$alg.'<br />';

$cube_size = $_GET['cube'];

if(!allowed(obrobka(trim(stripslashes($alg)), 'zbf2l')) || trim($alg) == '') 
{
	$smarty -> assign("ok", 2);
}

else
{
  	if($cube_size == 1) {$cat = 'zbf2l'; $size = '';}
  	else {$cat = 'eg'; $size = 'pocket_';}
  	$alg = obrobka(trim($alg), $cat);
  	
  	$smarty -> assign('size', stripslashes($size));
  	$smarty -> assign('alg', stripslashes($alg));
  	$smarty -> assign('cube_size', $cube_size);
  	$smarty -> assign("ok", 1);
}


$smarty -> assign('mode', 'print');
$smarty -> display("preview.tpl");

?>
