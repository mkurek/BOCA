<?php
	class View {
		var $viewinfo;
		function View($filename) {
			$this->viewinfo = Spyc::YAMLLoad($filename);
			if (isset($this->viewinfo['use'])) {
				$dir = dirname($filename);
				$filename = $dir."/".$this->viewinfo['use'].".yml";
				if (!file_exists($filename))
					error("FILE_DOESNT_EXIST",$filename);
				$this->viewinfo = array_merge($this->viewinfo,Spyc::YAMLLoad($filename));
			}
		}
		
		function drawArrow($handle,$sx,$sy,$tx,$ty,$color)
		{
			//line
			//echo "line: $sx,$sy, $tx, $ty\n";
			ImageLine($handle,$sx,$sy,$tx,$ty,$color);
			// triangle at the end
			$arrowlen=5;
			$vectorx=$sx-$tx;
			$vectory=$sy-$ty;
			$vectorlen=sqrt($vectorx*$vectorx+$vectory*$vectory);
			$arrowpart=$arrowlen/$vectorlen;
			$pointx=$tx+$arrowpart*$vectorx;
			$pointy=$ty+$arrowpart*$vectory;
			$arrowvectorx=$tx-$pointx;
			$arrowvectory=$ty-$pointy;
			$a1x=-$arrowvectory;
			$a1y=$arrowvectorx;
			$coords[0]=$tx;
			$coords[1]=$ty;
			$coords[2]=$pointx+$a1x;
			$coords[3]=$pointy+$a1y;
			$coords[4]=$pointx-$a1x;
			$coords[5]=$pointy-$a1y;
			ImageFilledPolygon($handle,$coords,3,$color);
		}

		function draw($handle,$scheme,$state,$colors,$part,$puzzle) {
			$x=$part['x'];
			$y=$part['y'];
			if (isset($this->viewinfo['base'])) {
				$filename=getBaseFilename($part['view'],$this->viewinfo['base']);
				if (!file_exists($filename))
					error("FILE_DOESNT_EXIST",$filename);
				if (!isset($this->viewinfo['width'])  || !isset($this->viewinfo['height'])) {
					list($width, $height) = getimagesize($filename);
					$this->viewinfo['width']=$width;
					$this->viewinfo['height']=$height;
				}
				
				$base=imagecreatefrompng($filename);

				imagecopyresized($handle,$base,$x,$y,0,0,$part['width'],$part['height'],$this->viewinfo['width'],$this->viewinfo['height']);

			}
			$sx=$part['width']/$this->viewinfo['width'];
			$sy=$part['height']/$this->viewinfo['height'];
			$color="black";
			if (isset($this->viewinfo['lines']))
				foreach($this->viewinfo['lines'] as $key => $line) {
					$coords = explode(" ",$line);
					if (isset($coords[4]))
						$color=implode(" ",array_slice($coords,4));
					imageline($handle,$x+$sx*$coords[0],$y+$sy*$coords[1],$x+$sx*$coords[2],$y+$sy*$coords[3],$colors[$color]);
				}
			if (isset($this->viewinfo['stickers']))
				foreach($this->viewinfo['stickers'] as $fill) {
					$info = explode(" ",$fill);
					//echo $scheme->getColor($state[$info[0]]);
					$size=count($info);
					$color=$colors[$scheme->getColor($state[$info[0]])];
					if (!isset($color))
						error("COLOR_UNDEFINED",$scheme->getColor($state[$info[0]]));
					if ($size==3) {
						if ($scheme->getColor($state[$info[0]])=='transparent') {
							if ($scheme->getDefaultColor()!=false)
								$color=$colors[$scheme->getDefaultColor()];
						}
						imagefill($handle,$x+$sx*$info[1],$y+$sy*$info[2],$color);
					}
					elseif ($size==5)
						imagefilledrectangle($handle,$x+$sx*$info[1],$y+$sy*$info[2],$x+$sx*$info[3],$y+$sy*$info[4],$color);
					elseif ($size>=7 && $size%2==1) {
						$coords=array_slice($info,1);
						for($i=0;$i<count($coords);$i++) {
							if ($i%2)
								$coords[$i]=$sy*$coords[$i]+$y;
							else
								$coords[$i]=$sx*$coords[$i]+$x;
						}
						imagefilledpolygon($handle,$coords,($size-1)/2,$color);
					
					} else
						error("INCORRECT_STICKER",$info[0]);
				}
			if (isset($this->viewinfo['arrows'])) {
				foreach($this->viewinfo['stickers'] as $sticker) {
					$sticker = explode(" ",$sticker);
					$size=count($sticker);
					if ($size==3) {
						$cx = $sticker[1];
						$cy = $sticker[2];
					} elseif ($size==5) {
						$cx = ($sticker[1] + $sticker[3])/2;
						$cy = ($sticker[2] + $sticker[4])/2;
					} elseif ($size>=7 && $size%2) {
						
					}
					$centers[$sticker[0]]["x"]=$cx;
					$centers[$sticker[0]]["y"]=$cy;
				}
				$can_arrow = explode(" ",$this->viewinfo['arrows']);
				foreach($can_arrow as $sticker) {
					$is_valid = false;
					$piece_stickers=$puzzle->getStickersInSamePiece($state[$sticker]);
					if (!$piece_stickers)
						error("INCORRECT_STICKER",$sticker."=>".$state[$sticker]);
					if (in_array($sticker,$piece_stickers))
						continue;
					if (in_array($state[$sticker],$can_arrow)) {
						$is_valid=true;
						$draw_to=$state[$sticker];
					} else {
						if ($this->viewinfo['disable smart arrows'])
							continue;
						if (is_array($piece_stickers))
							foreach($piece_stickers as $piece_sticker) {
								if (in_array($piece_sticker,$can_arrow)) {
									$is_valid=true;
									$draw_to=$piece_sticker;
								}
							}
/*						else
							if (in_array($piece_stickers,$can_arrow)) {
								$is_valid=true;
								$draw_to=$piece_stickers;
							}*/
					}
					if (!$is_valid || $sticker==$draw_to)
						continue;
					$this->drawArrow($handle,$x+$sx*$centers[$sticker]["x"],$y+$sy*$centers[$sticker]["y"],
						$x+$sx*$centers[$draw_to]["x"],$y+$sy*$centers[$draw_to]["y"],
						$colors[$scheme->getArrowColor()]);

				}
			}
		}
	}

?>
