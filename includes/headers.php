<?php

//ini_set('display_errors', 1);
//error_reporting(ALL);
ini_set("register_globals", "off");

ini_set("max_execution_time","1036800");
set_time_limit(0);

include "includes/config.php";

include "mysql.php";
include "login_funcs.php";
include "arrays.php";
include "stat_funcs.php";

function getmicrotime(){ 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
} 


/*
if(isSet($_SESSION['login'])) echo 'sesja istnieje!<br /><br />';
else echo 'sesja nie istnieje!<br /><br />';


echo '$_SESSION[\'login\']: '.$_SESSION['login'].'<br /><br />';
echo '$_SESSION[\'uid\']: '.$_SESSION['uid'].'<br /><br />';
echo '$_SESSION[\'rank\']: '.$_SESSION['rank'].'<br /><br />';

*/

connect($host, $dbuser, $dbhaslo, $db_select);

//definicja Smarty

include_once('Smarty/Smarty.class.php');
$smarty = new Smarty;
$smarty -> compile_dir = "temp/templates_c";

//$smarty ->debugging = TRUE;

include "includes/log_status.php";


// język
if(isSet($_GET['l']) && ($_GET['l'] == 'pl' || $_GET['l'] == 'en')) $lang = $_GET['l'];
else 
{
	if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) == 'pl') $lang = "pl";
	else $lang = 'en';
}

$smarty -> assign('lang', $lang);


$smarty -> assign("or", $orientacja_upper);
$smarty -> assign("perm", $permutacja);
$smarty -> assign("permh", $permutacjah);



// kategoria: th/oh/fm
if($_GET['cat'] == 'oh') {$cat_s = 'oh'; $cat_l = 2;}
else if($_GET['cat'] == 'fm') {$cat_s = 'fm'; $cat_l = 3;}
else {$cat_s = 'th'; $cat_l = 1;}

$smarty -> assign('cat_s', $cat_s);

$uid = $_SESSION['uid'];

// statystyki

$users = users_count();
$algs_inb = algs_in_base();
$visits = visits($uid);
$your_algs = your_algs($uid);

$smarty -> assign('users', $users);
$smarty -> assign('algs_inb', $algs_inb);
if($uid > 1)
{$smarty -> assign('visits', $visits);
$smarty -> assign('your_algs', $your_algs);
}
?>
