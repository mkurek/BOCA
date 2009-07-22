<?php
	
function fileName($human_name) {
	return strtolower(implode("_",explode(" ",$human_name)));
}

function humanName($file_name) {
	return implode(" ",ucwords(explode("_",$filename)));

}

function className($human_name) {
	return str_replace(" ","",$human_name);
}
?>
