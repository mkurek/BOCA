<?php


// gość

if(!isSet($_SESSION['login']) || $_SESSION['login'] == 0) 
{
    $_SESSION['login'] = 0;
	 $_SESSION['uid'] = 1;
	 $_SESSION['rank'] = 101;
	 $log_status = 2; 								// 1- zalogowany, 2-niezalogowany
}



// jeśli user jest zalogowany
if($_SESSION['login'] == 1)
{
	
	// sprawdz czy sesja sie nie skończyła
	$timeout = check_timeout($_SESSION['uid']);	


	if($timeout == 1) 							  // koniec sesji
	{
 		$ses_end = true;	
  	 													  // coockie też nie istnieje
 		if(!isSet($_COOKIE['boca'])) 
 		{
   			$ses_end = true;	
	    	}
	
 		else
 		{
	  		$dane = $_COOKIE['boca'];
	  		$dane = explode('_', $dane);	
	  		$query = 'SELECT `session_id` FROM `portal_sessions` WHERE user_id = '.$dane[0].';';
	  		$result = query($query);
 			$row = mysql_fetch_row($result);	
		  	if($dane[1] == $row[0])  
		  	{
     				$ses_end = false;
		  	}
		}
		
		
		if($ses_end)
		{			
			  change_session_key($_SESSION['uid']);
			  unset($_SESSION['login']);
			  unset($_SESSION['uid']);
			  unset($_SESSION['username']);
			  session_destroy();
			  $log_status = 0;
		}
		
		else
		{
			login($_SESSION['uid'], 1, true); 		
			$log_status = 1;			
		}
	}
	
	else if($_GET['act'] == 'logout') $log_status=2; 			/*echo 'Logout<br /><br />';*/
	
	else 																		// przedłużenie sesji
	{
	  	
	   	login($_SESSION['uid'], 0, false); 		
      		$log_status = 1;
	}

}

// jeśli user nie jest zalogowany && jeśli istnieje cookie autologin
if(($_SESSION['login'] == 0 || !isSet($_SESSION['login'])) && isSet($_COOKIE['boca']))
{
	
		$dane = explode('_', $_COOKIE['boca']);	
		$query = 'SELECT `username`, `rank` FROM `portal_users` WHERE `ID` = '.$dane[0].';';
		$result = query($query);
		$row = mysql_fetch_row($result);
		$username = $row[0];
		$rank = $row[1];
		
		$query = 'SELECT `session_id` FROM `portal_sessions` WHERE user_id = '.$dane[0].';';
		$result = query($query);
		$row = mysql_fetch_row($result);
		
		//jeśli hashe sie zgadzają		
		if($dane[1] == $row[0]) 
		{					
		   	login($dane[0], 1, true);
	      		$_SESSION['login'] = 1;
			$_SESSION['uid'] = $dane[0];
		   	$_SESSION['username'] = $username;
			$_SESSION['rank'] = $rank;
			$log_status = 1;
		}					
}	

$smarty -> assign('login', $_SESSION['username']);
$smarty -> assign('log_status', $log_status);

//echo '<br />$_SESSOION[login] = '.$_SESSION['login'].'<br /><br />';

?>
