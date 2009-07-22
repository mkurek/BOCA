<?php
session_start();
include_once "includes/headers.php";
include_once "includes/case_funcs.php";
include_once "includes/cat_funcs.php";
include_once "includes/add_algs_func.php";
//include_once "install1.php";
 

$alg = "x U' R' U2 y' R U' R' F2 R";


$cube_temp = new RubiksCube;
	$algs_tab = array();

	$get_pre = false;
	$cloned_cats = array('zbll', 'zbll2', 'zbf2l', 'eg', 'eg2', 'eg3');
	
	
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
	  	
	  	var_dump($tmp);
	  	
	  	if($get_pre) {$pre = $tmp[0]; $tmp = $tmp[1];}
	  	$tmp = $cube_temp -> parse($tmp);
		
	  	if(!is_array($tmp) && !in_array($cloned_cats[$i], array('eg', 'eg2', 'eg3'))) return array('bad_line');
	  	if(!is_array($tmp) && in_array($cloned_cats[$i], array('eg', 'eg2', 'eg3'))) {$algs_tab[$cloned_cats[$i]] = ''; continue;}
	  	if(in_array($cloned_cats[$i], array('eg', 'eg2', 'eg3'))) $tmp = up2($tmp);
	  		  	
 		$tmp = implode(' ', $tmp);
		$inv[$cloned_cats[$i]] = implode(' ', $cube_temp->getAlgorithmInverse($cube_temp -> parse2($tmp)));
		
		if($cat == 'eg3') $inv[$cloned_cats[$i]] = trim($inv[$cloned_cats[$i]].' '.implode(' ', $cube_temp->getAlgorithmInverse($cube_temp -> parse2($pre))));
		
 		$algs_tab[$cloned_cats[$i]] = $tmp;
	  	
	  	if(cloned($tmp, 0) !== true) {$cloned = true;}
	  	
	}
	
	if($inv['eg'] != $inv['eg2']) $eg2 = true;
	if($inv['eg'] != $inv['eg3']) $eg3 = true;
	if($inv['zbll'] != $inv['zbll2']) $zbll2 = true;
	
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

?>
