<?php
require_once("includes/spyc/spyc.php");
require_once("includes/xtpl/xtemplate.class.php");
require_once("includes/errors.php");

function readCollection($filename) {
	$filename=dirname(__FILE__)."/collections/".$filename.".yml";
	if (!file_exists($filename))
		error("FILE_DOESNT_EXIST",$filename);
	$collection=Spyc::YAMLLoad($filename);
	if (!isset($collection['template']))
		$collection['template']=$collection['description'];
	$template_filename=dirname(__FILE__)."/templates/".$collection['template'].".xtpl";
	if (!file_exists($template_filename))
		error("FILE_DOESNT_EXIST",$template_filename);
	return $collection;
}
	
function renderCollection($collection) {
	$template_filename=dirname(__FILE__)."/templates/".$collection['template'].".xtpl";
	foreach($collection['algorithms'] as $algorithm) {
		$xtpl = new XTemplate($template_filename);
		foreach($algorithm as $key => $value) {
			$xtpl->assign(strtoupper($key),$value);
		}
		$xtpl->assign("IMAGE","scig.php?desc=".$collection['description']."&data=".$algorithm['data']);
		$xtpl->parse("main");
		$xtpl->out("main");
	}

}

function displayCollection($filename) {
	$collection=readCollection($filename);
	renderCollection($collection);
}

?>
