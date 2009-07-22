<?php 
	$ch = $_GET['ch'];

	if($ch == 'els') include "els.php";												// ZBF2l
	else if($ch == 'cls') include "cls.php";											// ZBLL


	// wybór kategorii MGLS (!isSet($_GET['ch']) || $ch == '')
	else
	{
	$cats = array('els', 'cls');	
	$algs = array('', '');
	$image_cat = $cats;
	$imgcats = array('cube');
	//$img_cat_different = true;
	
	$file = 'cat';
	$method = 'mgls';	
	$what_in_section = 'chapter';
	$in_section = $cats;	
	$title = 'choose_mgls_cat';
	$level = 'mgls_cat_choose';
	$smarty -> assign('level', $title);
	$smarty -> assign('if_chapter', true);

	}



?>
