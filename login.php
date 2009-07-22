<?php
ob_start();
session_start();

include "includes/headers.php";

$display_form = true;
$display_inf = false;

if($_SESSION['login'] == 1) 
{
       $display_inf = true;
       $smarty->assign('inf', 'already_logged');
		 $display_form = false;	
}

// jeśli user próbuje się zalogować

if($_GET['act'] == 'login' && ($_SESSION['login'] == 0 || !isSet($_SESSION['login'])))
	{
		$display_form = false;	
		$query = "SELECT `pass`, `ID`, `rank` FROM `portal_users` WHERE `username` = '".htmlspecialchars($_POST['login'])."';";
		
		$autologin = 1;
		if(!$_POST['autologin']) $autologin = 0;
		
		$result = query($query);
		
		if(mysql_num_rows($result) != 0)
		{
		$row = mysql_fetch_row($result);
		
			  if(md5(sha1(md5(htmlspecialchars($_POST['pass'])))) == $row[0]) 
			  {										 
					$uid = login($row[1], $autologin);
					$_SESSION['login'] = 1;
					$_SESSION['uid'] = $row[1];
					$_SESSION['username'] = htmlspecialchars($_POST['login']);
					$_SESSION['rank'] = $row[2];
		     			$smarty ->assign('log_status', 1);
		     			$smarty -> assign('login', $_SESSION['username']);
		     			$smarty -> assign('login_step', 'ok');
			  		increaseVisits($row[1]);
			  }
			
			  else {$smarty -> assign('errors', 'wrong_datas'); $display_form = true;}
					
		
		}
		
		else {$smarty -> assign('errors', 'no_user_with_this_username'); $display_form = true;}		

		
}	

if($_GET['act'] == 'logout' && $_SESSION['login'] == 1)
{
	change_session_key($_SESSION['uid']);
	
   unset($_SESSION['login']);
	unset($_SESSION['uid']);
	unset($_SESSION['username']);
	unset($_SESSION['rank']);
		
	if(!session_destroy()) echo 'Can\'t delete session!<br />';
	
	$display_inf = true;
	$smarty->assign('inf', 'logged_out');
	
	//$display_form = true;
}

$smarty -> assign('display_form', $display_form);
$smarty -> assign('display_inf', $display_inf);

$smarty -> display('login.tpl');
ob_end_flush();
?>
