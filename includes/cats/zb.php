<?php

$ch = $_GET['ch'];

if($ch == 'zbf2l') include "zbf2l.php";												// ZBF2l
else if($ch == 'zbll') include "zbll.php";											// ZBLL


// wybór kategorii ZB (!isSet($_GET['ch']) || $ch == '')
else
{
$cats = array('zbf2l', 'zbll');	
$algs = array('', '');
$image_cat = array('zbf2l', 'zbll');
$imgcats = array('cube');
$img_cat_different = true;
	
$file = 'cat';
$method = 'zb';	
$what_in_section = 'chapter';
$in_section = $cats;	
$title = 'choose_zb_cat';

$smarty -> assign('if_chapter', true);

}

?>