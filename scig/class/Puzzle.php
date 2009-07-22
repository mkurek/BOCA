<?php
class Puzzle {
	var $stickers;
	var $faces;
	function Puzzle($filename) {
		$desc = Spyc::YAMLLoad($filename);
		if (!isset($desc['stickers']) || !isset($desc['faces']))
			error("SECTION_MISSING");
		$this->stickers=$desc['stickers'];
		$this->faces=$desc['faces'];
	}
	function getStickerNames() {
		$i=0;
		foreach($this->stickers as $type => $pieces) {
			foreach($pieces as $piece) {
				if (is_array($piece)) {
					foreach($piece as $sticker) {
						$stickers[$i]=$sticker;
						$i++;
					}
				}
				else {
					$stickers[$i]=$piece;
					$i++;
				}
			}
		}
		return $stickers;
	}
	function getFaceNames() {
		$i=0;
		foreach($this->faces as $key => $value) {
//			if (!isset($value['name']))
//				error("FACE_NONAME");
			$names[$i]=$key;
		}
		return $names;

	}

	function getStickersForFace($face) {
		if (!isset($this->faces[$face]))
			error("INVALID_FACE",$face);
		return $this->faces[$face];
	}

	function getStickersInSamePiece($searched) {
//		echo $searched."<br/>";
		foreach($this->stickers as $type) {
			foreach($type as $piece) {
//				print_r ($piece);
//				echo "<br/>";
				if (is_array($piece)) {
					if (in_array($searched,$piece))
						return $piece;
				} else
					if ($searched==$piece) {
						$result[0]=$piece;
						return $result;
					}
			}
		}
		return false;
	}
	
	function isSticker($name) {
		foreach($this->stickers as $stickers) {
			foreach($stickers as $sticker) {
				if (is_array($sticker)) {
					foreach($sticker as $elem)
						if ($elem==$name)
							return true;
				} else
					if ($sticker==$name)
						return true;
			}
		}
		return false;
	}

	function isFace($name) {
		if (isset($this->faces[$name]))
			return true;
		else
			return false;
	}
}

?>
