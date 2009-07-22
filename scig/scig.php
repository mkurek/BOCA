<?php
require_once("includes/utils.php");
require_once("includes/errors.php");
require_once("includes/spyc/spyc.php");

require_once("class/Puzzle.php");
require_once("class/Scheme.php");
require_once("class/View.php");
require_once("class/Logger.php");


function getSchemeFilename($scheme,$puzzle) {
	return "schemes/".filename($puzzle)."/".filename($scheme).".yml";
}

function getViewFilename($view,$puzzle) {
	return "views/".filename($puzzle)."/".filename($view).".yml";
}

function getBaseFilename($view,$base) {
	global $description;
	return "views/".filename($description['puzzle'])."/bases/".$base.".png";
}


function fileExists($filename) {
	if (!file_exists($filename)) {
		error("FILE_DOESNT_EXIST",$filename);
	}
}


function debug($message) {
	global $logger,$debug;
	if ($debug)
		$logger->writeLog($message);
}

function isCoordinate($number) {
	if (!isset($number) || $number<0 || !is_int($number))
		return 0;
	else
		return 1;
}

function validateState($puzzle,$state) {
	$stickers = $puzzle->getStickerNames();
	foreach($stickers as $sticker) {
		if (!isset($state[$sticker]) || !$puzzle->isSticker($state[$sticker]))
			error("STATE_INVALID","$sticker,".$state[$sticker]);
	}
	foreach($state as $place => $sticker) {
		if (!$puzzle->isSticker($place) || !$puzzle->isSticker($sticker))
			error("STATE_INVALID","($place,$sticker)");
	}
	return true;
}

function getCacheFilename($desc,$data) {
	global $configuration;
	return $configuration['cache dir'].md5($data.$desc).".png";
}

function readConfiguration() {
	global $logger,$debug, $configuration;
	$configuration = Spyc::YAMLLoad("configuration.yml");
	$debug = $configuration["debug"];
	if ($debug) {
		if (!is_writable($configuration["logs dir"]))
			error("NOT_WRITEABLE",$configuration["logs dir"]);
		$logger = new Logger($configuration["logs dir"]."debug.log");
	}
	if ($configuration['use cache'])
		if (!is_writable($configuration["cache dir"]))
			error("NOT_WRITEABLE",$configuration["cache dir"]);
	debug("\nSCIG started at ".date("Y-m-d G:i"));
}


function handleCache($desc,$data) {
	global $configuration;
	if (!$configuration['use cache'])
		return;
	$desc_file="descriptions/".$desc.".yml";
	if (!file_exists($desc_file))
		error("DESC_FILE_DOESNT_EXIST",$desc);
	$filename=getCacheFilename($desc,$data);
	if (file_exists($filename) && filectime($filename)>filectime($desc_file)) {
		debug("Using cached image $filename");
		header("Content-type: image/png");
		readfile($filename);
		exit;
	}
		
}

function readDescription($desc) {
	global $parts, $description;
	debug("Reading description file...");
	if (!file_exists("descriptions/".$desc.".yml"))
		error("DESC_FILE_DOESNT_EXIST",$desc);
	$description = Spyc::YAMLLoad("descriptions/".$desc.".yml");
	if (!isCoordinate($description['width']))
		error("WIDTH_INCORRECT");
	if (!isCoordinate($description['height']))
		error("HEIGHT_INCORRECT");
	if ($description['mode']!="normal" && $description["mode"]!="reverse" && $description["mode"]!="effect")
		error("MODE_INCORRECT");
	$filename=fileName($description['puzzle']);
	if (!file_exists("specs/".$filename.".yml"))
		error("PUZZLE_INCORRECT",$filename.".yml");
	foreach ($description['parts'] as $name => $options) {
		$error_extra="part: '".$name."'";
		if (!isCoordinate($options['width']))
			error("WIDTH_INCORRECT",$error_extra);
		if (!isCoordinate($options['height']))
			error("HEIGHT_INCORRECT",$error_extra);
		if (!isCoordinate($options['x']))
			error("BEGINX_INCORRECT",$error_extra);
		if (!isCoordinate($options['y']))
			error("BEGINY_INCORRECT",$error_extra);
		if (!file_exists(getSchemeFilename($options['scheme'],$description['puzzle'])))
			error("FILE_DOESNT_EXIST",$error_extra);
		if (!file_exists(getViewFilename($options['view'],$description['puzzle'])))
			error("FILE_DOESNT_EXIST",$error_extra);
		$parts[$name]=$options;

	}
	if (count($parts)==0)
		error("PARTS_UNDEFINED");
}

function allocateColors($handle) {
	global $colors;
	debug("Allocating colors...");
	$colorsdef = Spyc::YAMLLoad("colors.yml");
	foreach ($colorsdef as $key => $value) {
		$value=explode(" ",$value);
		debug("Allocating $key: $value[0] $value[1] $value[2]");
		$colors[$key]=imageColorAllocate($handle,$value[0],$value[1],$value[2]);
		if (!isset($colors[$key]) || $colors[$key]==-1) {
			error("ALLOCATION_FAILED",$key);
		}
	}
	if (!isset($colors['transparent']))
		error("TRANSPARENT_UNSET");

}

function generateImage() {
	global $parts,$description,$logger,$colors,$data,$desc,$configuration;
	// creating image
	debug("Creating image...");	
	$handle=imagecreatetruecolor($description["width"],$description["height"]);
	allocateColors($handle);
	imageantialias($handle,false);
	imagefill($handle,0,0,$colors['transparent']);
	imagecolortransparent($handle,$colors['transparent']);

	$filename="specs/".fileName($description['puzzle']).".yml";
	if (!file_exists($filename))
		error("FILE_DOESNT_EXIST",$filename);
	$puzzle = new Puzzle($filename);
	
	require_once("engines/".fileName($description['puzzle']).'.php');

	$engine_class = className($description['puzzle']);
	$engine = new $engine_class;
	if ($description["mode"]=="reverse" || $description["mode"]=="effect") {
		$state=$engine->process($data,$description['mode']);
	}
	else
		$state=$engine->stickerize(explode(".",$data));
	validateState($puzzle,$state);
	foreach($parts as $partname => $part) {
		debug("Drawing part ".$partname."...");
		$filename=getSchemeFilename($part['scheme'],$description['puzzle']);
		if (!file_exists($filename))
			error("FILE_DOESNT_EXIST",$filename);
		$scheme = new Scheme($filename,$puzzle);
		$filename=getViewFilename($part['view'],$description['puzzle']);
		if (!file_exists($filename))
			error("FILE_DOESNT_EXIST",$filename);
		$view = new View($filename);
		$view->draw($handle,$scheme,$state,$colors,$part,$puzzle);
	}
	if ($configuration['use cache']) {
		$filename=getCacheFilename($desc,$data);
		imagepng($handle,$filename);
	}
	// return image
	header("Content-type: image/png");
	imagepng($handle);

}

function main() {
	global $desc, $puzzles, $data,$configuration;
	readConfiguration();
	readDescription($desc);
	handleCache($desc, $data);
	generateImage();
}

$desc=$_GET["desc"];
$data=$_GET["data"];

$data=stripslashes($data);

main();

?>
