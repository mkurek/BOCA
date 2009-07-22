<?php

function users_count()
{
    $query = "SELECT COUNT(ID) FROM `portal_users`";
    $result = query($query);
    $row = mysql_fetch_row($result);
    return ($row[0]-1);
}

function algs_in_base()
{
    $query = "SELECT COUNT(ID) FROM `portal_algs`";
    $result = query($query);
    $row = mysql_fetch_row($result);
    return ($row[0]);	
}


function visits($uid)
{
	if($uid == 1) return '';
	
	$query = "SELECT `visits` FROM `portal_users` WHERE ID=$uid";
	$result = query($query);
	$row = mysql_fetch_row($result);
	return ($row[0]);
}

function your_algs($uid)
{
	$query = "SELECT COUNT(ID) FROM `portal_algs` WHERE `user_id`=$uid";
    $result = query($query);
    $row = mysql_fetch_row($result);
    return ($row[0]);
}


?>