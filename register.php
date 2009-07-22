<?php
ob_start();
session_start();

include "includes/headers.php";
include "includes/reg_funcs.php";

$action = $_GET['action'];

$smarty -> assign('title', 'register');

//wybor jezyka

if(!isSet($_GET['l']))
{
	if(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) == 'pl') $lang_dom = '1';
	else $lang_dom = '0';
}

else
{
	if($_GET['l'] == 'pl') $lang_dom = '1';
	else $lang_dom = '0';
	}

//formularz

if(!isset($_GET['action'])) 																				// bez żadnych param. -> czysty form
{
	$smarty -> assign('register', 'register_form');  
	$smarty -> assign('languages', $languages); 
	$smarty -> assign('language', $lang_dom);
}

//formularz + błędy

if($action == "reg")																							// form po wysłaniu - do spr
{
	
	$errors = '';

	$errors_username = checkUsername($_POST['username']);											//sprawdzanie username, mail & pass
	$errors_pass = checkPasswords($_POST['password'], $_POST['password2']);
	$errors_mail = checkMail($_POST['mail'], $_POST['mail2']);
	$error_captcha = checkCaptcha($_POST['captcha']);
	
	if($errors_username != '') 																			// błędy w nazwie usera
	{
         $errors = $errors_username;
	 		if($errors_pass != '') $errors = array_merge($errors, $errors_pass);				// błedy w pass
	 		if($errors_mail != '') $errors = array_merge($errors, $errors_mail);				// błędy w mailu
			if($error_captcha != '') $errors = array_merge($errors, $error_captcha);
	}
	
	else																											// username ok;
	{
         if($errors_pass != '') 																			// sprawdzamy pass -> tu: błąd
              {
              $errors = $errors_pass; 		
 				  if($errors_mail != '') $errors = array_merge($errors, $errors_mail);		// błędy w pass & mail
              if($error_captcha != '') $errors = array_merge($errors, $error_captcha); // błedy w captch'ie
				  }

         else if($errors_mail != '') {
     				$errors = $errors_mail;									// błędy tylko w mailu	
				  if($error_captcha != '') $errors = array_merge($errors, $error_captcha);
				  }									
			
			else if($error_captcha != '') $errors = $error_captcha;		  
         
			else $errors = '';																				// brak błędów
   
	
	}

	if($errors == '') $action ='send';																	// przejście do wysyłania forma

	else{																											// błędy -> form do poprawy
		  $smarty -> assign('username', htmlspecialchars($_POST['username']));	
        $smarty -> assign('mail', htmlspecialchars($_POST['mail']));	
		  $smarty -> assign('mail2', htmlspecialchars($_POST['mail2']));	
		  $smarty -> assign('password', htmlspecialchars($_POST['password']));	
		  $smarty -> assign('password2', htmlspecialchars($_POST['password2']));	
		  $smarty -> assign('languages', $languages);
		  $smarty -> assign('language', htmlspecialchars($_POST['language']));	
		  $smarty -> assign('register', 'register_form');
		  $smarty -> assign('errors', $errors);
		  }
}

// wysyłanie formularza

if($action == "send")																					// form ok - do przesłania do sql
{
	
	$key = generate_key();																					// generowanie klucza akt.
	
	if($_POST['language'] == '0') $ln = 'en';
	else $ln = 'pl';
	
	$query = 'INSERT INTO portal_users VALUES (NULL, \''.addslashes($_POST['username']).'\', 102, \''.md5(sha1(md5($_POST['password']))).'\', \''.addslashes($_POST['mail']).'\', NULL, '.mktime(date("h"), date("i"), date("s"), date("m"), date("d"), date("Y")).', 0, \''.$ln.'\', 1, 30);';

	if(!$result = mysql_query($query))
	      {																		// zapytanie do sql 
 			echo('Nieprawidłowe zapytanie<br /><br />'.mysql_errno() . ": " . mysql_error() . "\n");
 			mysql_close();
 			exit;
         }
 
   $row = mysql_affected_rows();																			// czy dodano 1 wiersz do bazy)

	if($row == 1)
	{
	$query = 'SELECT `ID` FROM `portal_users` WHERE `username` = \''.addslashes($_POST['username']).'\';';

	if(!$result = mysql_query($query))
	      {																		// zapytanie do sql 
 			echo('Nieprawidłowe zapytanie<br /><br />'.mysql_errno() . ": " . mysql_error() . "\n");
 			mysql_close();
 			exit;
         }

	$row2 = mysql_fetch_row($result);
	
	$now = mktime(date("h"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	$end = mktime(date("h"), date("i")+15, date("s"), date("m"), date("d"), date("Y"));
	
	$query = 'INSERT INTO portal_sessions VALUES (\''.session_id().'\', '.$row2[0].', '.$now.', '.$end.', \''.$_SERVER['REMOTE_ADDR'].'\', 0);';

	if(!$result = mysql_query($query))
	      {																		// zapytanie do sql 
 			echo('Nieprawidłowe zapytanie<br /><br />'.mysql_errno() . ": " . mysql_error() . "\n");
 			mysql_close();
 			exit;
         }
			
	}
  	else $smarty -> assign('mysql_error', 'mysql_error'); 											// wystąpiły błędy po stronie sql

	$smarty->assign('register', 'send');

}

$smarty -> display('register.tpl');	
	
?>
