<?php

$ch = $_GET['ch'];
										
if($ch == 'oll') include "includes/cats/oll.php";								// OLL
else if($ch == 'pll') include "includes/cats/pll.php";						// PLL
else if($ch == 'f2l') include "includes/cats/f2l.php";

// wybór kategorii Fridricha (!isSet($_GET['ch']) || $ch == '')
else
{
$smarty -> assign('level', 'fridrich_cat_choose');
$smarty -> assign('title', 'choose_fridrich_cat');	
}

$method = 'fridrich';

?>