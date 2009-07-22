<?php

$cats = array();

$query = "SELECT * FROM portal_cats";
$res = query($query);

while($row = mysql_fetch_assoc($res)) $cats[] = $row['name'];
$level = 'method_choose';
$smarty -> assign ('cats', $cats);
$smarty -> assign('level', 'method_choose');
?>
