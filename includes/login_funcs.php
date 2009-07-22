<?php

// login: $was: 0 - przedłużenie sesji, 1: nowa sesja ; $autologin: 0 - nie, 1- tak;

function login($uid, $autologin, $increase_vis=false)
{

	$now = mktime(date("h"), date("i"), date("s"), date("m"), date("d"), date("Y"));
	$end = mktime(date("h"), date("i")+30, date("s"), date("m"), date("d"), date("Y"));
	$key = $uid."_".session_id();

	//update sessions
	$query = 'UPDATE `portal_sessions` SET `session_id` = \''.session_id().'\', `session_start` = '.$now.', `session_time`='.$end.', `session_ip` = \''.$_SERVER['REMOTE_ADDR'].'\', `session_key` = \''.$key.'\' WHERE `user_id`='.intval($uid).';';
	$result = query($query);

	// zwiekszanie wizyty jeśli 
	if($increase_vis) increaseVisits($uid);

// czesc cookie
if($autologin)
{
	setCookie("boca", $uid."_".session_id(), time()+18144000);
}

}


function check_timeout($uid)
{
$query = 'SELECT `session_time` FROM `portal_sessions` WHERE `user_id` = '.$uid.';';

$result = query($query);

$row = mysql_fetch_row($result);

if(mktime(date("h"), date("i"), date("s"), date("m"), date("d"), date("Y")) > $row[0]) return 1;

return 0;
}

function increaseVisits($uid)
{
	$query = 'UPDATE `portal_users` SET visits=visits+1 WHERE ID='.$uid.';';
	
	$result = query($query);
	
}

function change_session_key($uid)
{
	$id = substr(str_shuffle("1234567890qwertyuiopasdfghjklzxcvbnm"), 0, 32);
	
	$session_key = $uid.'_'.$id;
	
	//echo '$id: '.$id.'<br /><br />';
	
	$query = "UPDATE portal_sessions SET session_id='$id', session_key='$session_key' WHERE user_id=$uid;";
	
	$result=query($query);
}


?>
