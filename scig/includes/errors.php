<?php
$errors["NOT_WRITEABLE"] = "File is not writeable";
$errors["FILE_DOESNT_EXIST"] = "File doesn't exist";
$errors["DESC_FILE_DOESNT_EXIST"] = "Description file doesn't exist";

$errors["WIDTH_INCORRECT"] = "Width is incorrect";
$errors["HEIGHT_INCORRECT"] = "Height is incorrect";
$errors["BEGINX_INCORRECT"] = "X coordinate is incorrect";
$errors["BEGINY_INCORRECT"] = "Y coordinate is incorrect";
$errors["MODE_INCORRECT"] = "Mode is incorrect";
$errors["PUZZLE_INCORRECT"] = "Can't find puzzle specification file";
$errors["PARTS_UNDEFINED"] = "No parts defined in description file";
$errors["SECTION_MISSING"] = "Specification file is missing a section";
$errors["NO_COLOR_FOR_STICKER"] = "No color defined for sticker";
$errors["FACE_NONAME"] = "Face has no name";
$errors["UNKNOWN_NAME"] = "Unknown name";
$errors["INVALID_FACE"] = "Invalid face name";
$errors["STATE_INVALID"] = "Invalid puzzle state (probably engine error)";

$errors["COLOR_UNDEFINED"] = "Color undefined";
$errors["ALLOCATION_FAILED"] = "Color allocation failed";
$errors["INCORRECT_STICKER"] = "Incorrect sticker definition in view";
$errors["TRANSPARENT_UNSET"] = "No definition of transparency in colors file";

function error($error, $extra="") {
	global $errors, $debug, $logger;
	if ($extra!="")
		$extra=" (".$extra.")";
	echo("<b>Error: </b>".$errors[$error]."$extra<br/>");
	if ($debug)
		$logger->writelog("Error: ".$errors[$error]." $extra");
	exit;
}
?>
