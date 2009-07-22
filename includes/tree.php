<?php

include "configs/lang.php";
include_once 'includes/arrays.php';

global $orient, $pll_titles, $perm, $permh;


$lang = 'pl';
if(isSet($_GET['l'])) $lang = $_GET['l'];

$tree = array("<a href='index.php?l=$lang&cat=".strtolower($cat_s)."'>{$text[$lang]['main_site']}</a>", "<a href='cat.php?l=$lang&cat=".strtolower($cat_s)."'>{$text[$lang]['cat']}</a>");


if($method != '')
$tree[] = "<a href='cat.php?l=$lang&cat=".strtolower($cat_s)."&m=$method'>".$text[$lang]['method'].": ".strtoupper($method).'</a>';

if($chapter != '')
{
	$tree[] = "<a href='cat.php?l=$lang&cat=".strtolower($cat_s)."&m=$method&ch=$chapter'>".$text[$lang]['chapter'].": ".strtoupper($chapter).'</a>';
}

if($subchapter != '' )
{
	if($chapter != 'zbf2l')
	{
	if(is_int($subchapter)) $temp = 'OLL '.$orient[$subchapter];
	else $temp = strtoupper($subchapter);
	$tree[] = " <a href='cat.php?l=$lang&cat=".strtolower($cat_s)."&m=$method&ch=$chapter&sch=$subchapter'>".$text[$lang]['subchapter'].": ".$temp.'</a>';	
	}
	
	else
	{
		$tree[] = " <a href='cat.php?l=$lang&cat=".strtolower($cat_s)."&m=$method&ch=$chapter&sch=$subchapter'>".$text[$lang]['subchapter'].": ".$subchapter.'</a>';		
	}


}

if($orientation != '' && $orientation != 0)
{
	if($subchapter == '') $tree2 = "<a href='cat.php?l=$lang&cat=".strtolower($cat_s)."&m=$method&ch=$chapter&o=$orientation'>";

	else $tree2 = "<a href='cat.php?l=$lang&cat=".strtolower($cat_s)."&m=$method&ch=$chapter&sch=$subchapter&o=$orientation'>";
	
	$tree2 .= $text[$lang]['orientation'].": ".$orient[$orientation].'</a>';	
	
	$tree[] = $tree2;
}

if($permutation != '' && $permutation != 0)
{
	if($orientation == 7) $perm = $permh;
	
	if($subchapter == '') $tree2 = "<a href='cat.php?l=$lang&cat=".strtolower($cat_s)."&m=$method&ch=$chapter&o=$orientation&p=$permutation'>";
	else $tree2 = "<a href='cat.php?l=$lang&cat=".strtolower($cat_s)."&m=$method&ch=$chapter&sch=$subchapter&o=$orientation&p=$permutation'>";
	
	$tree2 .= $text[$lang]['permutation'].": ".strtolower($perm[$permutation]).'</a>';	
	
	$tree[] = $tree2;
}

if($method == 'fridrich' && $chapter == 'pll')
{
	$tree2 = 'PLL '.$pll_titles[$sid-873];
	$tree[] = "<a href='case.php?l=$lang&cat=".strtolower($cat_s)."&sid=$sid'>".$tree2.'</a>';
}


?>
