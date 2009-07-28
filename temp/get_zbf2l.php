<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="zbll, fridrich, coll, rubik's" />
<meta name="Description" content="Rubik's Cube'" />
<meta name="Author" content="PoznanTeam" />
<meta name="Copyright" content="All rights reserved ®" />
<meta http-equiv="Content-Language" content="pl" />
<title>ZBLL</title>
</head>
<body>

<?php
/*
$str = file_get_contents("http://www.cubezone.be/zbf2lprintpage.html");

$new = explode('<tr align="center">', $str);

for($i=2;$i<count($new);$i+=2)
{
	$new2 = explode('<td>', $new[$i]);
	
	for($j=1;$j<count($new2);$j++)
	$zbf2l[] = trim(substr_replace($new2[$j], '',-3));
	
}

for($i=0;$i<count($zbf2l);$i++)
{echo $zbf2l[$i];
echo '
<br />';}

*/

function parse($input) {
		$count=-1;
		$char=substr($input,0,1);
		$input=substr($input,1);
		while($char)
		{
			if ($char==" " || $char=="(" || $char==")")
			{
				$char=substr($input,0,1);
				$input=substr($input,1);
				continue;
			}
			if ($char=="'" || $char=="2" || $char=="s" || $char=="a")
			{
				$moves[$count].=$char;	
			}
			else
			{
				$count++;
//				if ($moves[$count]!="")
//					$count++;
				$moves[$count]=$char;
			}
			$char=substr($input,0,1);
			$input=substr($input,1);
		}

		return implode(' ', $moves);

	}
	
	$postm = array("", "U", "U'", "U2");
	
	echo $postm[2];
	
	echo memory_get_peak_usage();
	
?>

</body>
</html>