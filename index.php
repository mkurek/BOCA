<?php
ob_start();
session_start();

include "includes/headers.php";

include "includes/news_funcs.php";

//ok

$smarty -> assign("or", $orientacja_upper);
$smarty -> assign("perm", $permutacja);


$news_per_site = 10;
$com_per_site = 20;

$page = 1;
if(isSet($_GET['page'])) $page = intval($_GET['page']);

$news_id = false;
if(isSet($_GET['news_id'])) $news_id = intval($_GET['news_id']);

// strona główna - same newsy
if($news_id == false)
{
  	$total_news = get_total_news($lang);
  
  	$pages = intval(ceil($total_news/$news_per_site));
  
  	$news = get_news_to_page($page, $lang, $news_per_site);
  	$smarty -> assign('news_per_site', $news_per_site);
  	$smarty -> assign('total_news', $total_news);
  	$smarty -> assign('news', $news);
  	$smarty -> assign('what', 'newses_display');
  	$smarty -> assign('pages', $pages);
  	
  	$start = 2;
	$end = $pages;
	
	if($pages > 10)
	{
   		$start = $page-5;
   		if($start < 2) $start = 2;
		   
		$end = $start+10; 
		if($end > $pages) $end = $pages-1;
	}
	
	$pages_tab = array();
	for($i=1;$i<=$end;$i++)
		$pages_tab[$i] = $i;
	
	$smarty -> assign('pages_start', $start);
	$smarty -> assign('pages_end', $end);
	$smarty -> assign('pages_tab', $pages_tab);
 }
 


else if($news_id !== false)
{
  	if(isSet($_GET['act']) && $_GET['act'] == 'send' && $_SESSION['login'] == 1 && trim($_POST['comment']) != '')
	{
   		$comment = htmlspecialchars(addslashes(trim($_POST['comment'])));
   		$uid = $_SESSION['uid'];
   		$query = "INSERT INTO portal_news_komentarze VALUES(NULL, $news_id, $uid, '$comment', NOW());";
   		$res = query($query);
   
 	}
  
  
  	$news = get_news($news_id, $page, $com_per_site);
	$kom = $news[1];
	$news = $news[0];
  	$total_com = $news['kom'];
  	$smarty -> assign('com_per_page', $com_per_site);
  	$smarty -> assign('what', 'news_display');
  	$smarty -> assign('news', $news);
  	$smarty -> assign('total_com', $total_com);
  	$smarty -> assign('kom', $kom);
  	
  	$pages = intval(ceil($total_com/$com_per_site));
  	$smarty -> assign('pages', $pages);
  	
  	$start = 2;
	$end = $pages;
	
	if($pages > 10)
	{
   		$start = $page-5;
   		if($start < 2) $start = 2;
		   
		$end = $start+10; 
		if($end > $pages) $end = $pages-1;
	}
	
	$pages_tab = array();
	for($i=1;$i<=$end;$i++)
		$pages_tab[$i] = $i;
	
	$smarty -> assign('pages_start', $start);
	$smarty -> assign('pages_end', $end);
	$smarty -> assign('pages_tab', $pages_tab);
  	
}


$smarty -> assign('act_page', $page);

if($_GET['tpl'] == 1)
{
$tab = $smarty -> get_template_vars();

echo '<b>------------------------------------------------</b><br />ZMIENNE PRZEKAZANE: <br />';
foreach($tab as $key=>$value)
{
	echo $key.' => ';
var_dump($value);
echo '<br />';
}
}

$smarty -> display('index.tpl');


?>
