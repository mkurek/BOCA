<?php

function generate_key()
{
return substr(str_shuffle("1234567890qwertyuiopasdfghjklzxcvbnm"), 0, 30);
	}



function sendMail($to, $mail, $lang, $uid, $act_key)
{
include 'arrays.php';
$state = 1;

$link = 'http://'.$_SERVER['SERVER_NAME'].'/register.php?action=act$u='.$uid.'&act_key='.$act_key;

if($lang == 'en') $pocz = 0; else $pocz = 4; 

$content = $activate_text[$pocz].$to.$activate_text[$pocz+1].$link.$activate_text[$pocz+2];

$title = $activate_text[$pocz+3].$_SERVER['SERVER_NAME'];

$state = mail($mail, $title, $content);

return $state;
   }



function checkUsername($username)
{

if(strlen($username) <4) $errors['to_short_username'] = 'to_short_username';
if(strlen($username) >30) $errors['to_long_username'] = 'to_long_username'; 	
	
$query = "SELECT ID FROM portal_users WHERE username='".addslashes($username)."';";

if(!$result = mysql_query($query)){
 			echo('Nieprawidłowe zapytanie checkUsername<br /><br />'.mysql_errno() . ": " . mysql_error() . "\n");
 			mysql_close();
 			exit;}

if(mysql_num_rows($result) != 0) $errors['username_already_occupied'] = 'username_already_occupied'; 
 
return $errors;
	}
	
	
	
function checkPasswords($password1, $password2)
{
if(strlen($password1) <5) $errors['password_to_short'] = 'password_to_short';

if($password1 != $password2) $errors['passwords_not_same'] = 'passwords_not_same';

return $errors;	
	}
	
	
	
	
function checkMail($mail1, $mail2)
{
	$query = "SELECT ID FROM portal_users WHERE `e-mail`='".addslashes($mail1)."';";

$result = query($query);

if(mysql_num_rows($result) != 0) $errors['mail_taken'] = 'mail_taken';	
	
if($mail1 != $mail2) $errors['mails_not_same'] = 'mails_not_same';
	
$wzorzec = '/[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}/';
	
if(!preg_match($wzorzec, $mail1)) $errors['mail_incorrect'] = 'mail_incorrect';	
	
	
return $errors;	
	}

function checkCaptcha($cap)
{
	
	if($_SESSION['captcha'] != $cap) $errors['bad_cap'] = 'bad_cap';
	
	return $errors;
	
}

?>