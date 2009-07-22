<?php
	class Scheme {
		var $colors;
		var $default = false;
		var $arrow = false;
		function Scheme($filename,$puzzle) {
			$scheme = Spyc::YAMLLoad($filename);
			if (isset($scheme['all'])) {
				foreach($puzzle->getStickerNames() as $sticker)
					$this->colors[$sticker]=$scheme['all'];
			}
			foreach($scheme as $key => $value) {
				if ($key=='arrows') {
					$this->arrow=$value;
					continue;
				}
				if ($key=='default') {
					$this->default=$value;
					continue;
				}
				if ($key=='all' || $key=='stickers')
					continue;
				if ($puzzle->isFace($key)) {
					$to_update=$puzzle->getStickersForFace($key);
					foreach($to_update as $sticker) {
						$this->colors[$sticker]=$value;
					}
				}
				elseif ($puzzle->isSticker($key))
					$this->colors[$key]=$value;
				else
					error("UNKNOWN_NAME",$key);
			}
			if (isset($scheme['stickers'])) {
				foreach($scheme['stickers'] as $color => $stickers) {
					$stickers=explode(" ",$stickers);
					foreach($stickers as $sticker) 
						$this->colors[$sticker]=$color;
				}
			}
		}
		function getColor($sticker) {
			if (!isset($this->colors[$sticker]))
				error("NO_COLOR_FOR_STICKER",$sticker);
			return $this->colors[$sticker];
		}
		function getDefaultColor() {
			return $this->default;
		}
		function getArrowColor() {
			return $this->arrow;
		}
	}

?>
