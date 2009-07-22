<?php
class RubiksCube {
	var $transformations;	
	var $cubeelems;
	var $alg1;
	var $alg2;
	var $kostka;
	var $search;
	var $maska;
	
		function RubiksCube() {
		$this->cubeelems=26;
		$this->transformations["R"]=array(0,8,2,3,4,10,6,7,5,9,1,11,16,12,14,15,17,13,18,19,20,21,22,23,24,25);
		$this->transformations["L"]=array(0,1,2,11,4,5,6,9,8,3,10,7,12,13,18,14,16,17,19,15,20,21,22,23,24,25);
		$this->transformations["F"]=array(9,1,2,3,8,5,6,7,0,4,10,11,15,13,14,19,12,17,18,16,20,21,22,23,24,25);
		$this->transformations["B"]=array(0,1,10,3,4,5,11,7,8,9,6,2,12,17,13,15,16,18,14,19,20,21,22,23,24,25);
		$this->transformations["U"]=array(1,2,3,0,4,5,6,7,8,9,10,11,13,14,15,12,16,17,18,19,20,21,22,23,24,25);
		$this->transformations["D"]=array(0,1,2,3,7,4,5,6,8,9,10,11,12,13,14,15,19,16,17,18,20,21,22,23,24,25);
		$this->transformations["x"]=array(4,8,0,9,6,10,2,11,5,7,1,3,16,12,15,19,17,13,14,18,25,24,22,23,20,21);
		$this->transformations["y"]=array(1,2,3,0,5,6,7,4,10,8,11,9,13,14,15,12,17,18,19,16,22,23,21,20,24,25);
		$this->transformations["z"]=array(9,3,11,7,8,1,10,5,0,4,2,6,15,14,18,19,12,13,17,16,20,21,24,25,23,22);
		
		$this->center_names[0]="F";
		$this->center_names[1]="B";
		$this->center_names[2]="R";
		$this->center_names[3]="L";
		$this->center_names[4]="U";
		$this->center_names[5]="D";
		
		$this->edge_names[0]="UF"; 		// dobrze zorientowane
		$this->edge_names[1]="UR";
		$this->edge_names[2]="UB";
		$this->edge_names[3]="UL";
		$this->edge_names[4]="DF";
		$this->edge_names[5]="DR";
		$this->edge_names[6]="DB";
		$this->edge_names[7]="DL";
		$this->edge_names[8]="FR";
		$this->edge_names[9]="FL";
		$this->edge_names[10]="BR";
		$this->edge_names[11]="BL";
		
		$this->edge_names[12]="-UF"; 		// źle zorientowane -> -
		$this->edge_names[13]="-UR";
		$this->edge_names[14]="-UB";
		$this->edge_names[15]="-UL";
		$this->edge_names[16]="-DF";
		$this->edge_names[17]="-DR";
		$this->edge_names[18]="-DB";
		$this->edge_names[19]="-DL";
		$this->edge_names[20]="-FR";
		$this->edge_names[21]="-FL";
		$this->edge_names[22]="-BR";
		$this->edge_names[23]="-BL";
		
		
		$this->corner_names[0]="UFR"; 		//dobrze zorientowane 
		$this->corner_names[1]="URB";
		$this->corner_names[2]="UBL";
		$this->corner_names[3]="ULF";
		$this->corner_names[4]="DRF";
		$this->corner_names[5]="DBR";
		$this->corner_names[6]="DLB";
		$this->corner_names[7]="DFL";
		
		$this->corner_names[8]="+UFR"; 		//źle zorientowane -> +
		$this->corner_names[9]="+URB";
		$this->corner_names[10]="+UBL";
		$this->corner_names[11]="+ULF";
		$this->corner_names[12]="+DRF";
		$this->corner_names[13]="+DBR";
		$this->corner_names[14]="+DLB";
		$this->corner_names[15]="+DFL";
		
		$this->corner_names[16]="-UFR"; 	//źle zorientowane -> -
		$this->corner_names[17]="-URB";
		$this->corner_names[18]="-UBL";
		$this->corner_names[19]="-ULF";
		$this->corner_names[20]="-DRF";
		$this->corner_names[21]="-DBR";
		$this->corner_names[22]="-DLB";
		$this->corner_names[23]="-DFL";
		
		$this -> starting_state=array(0,1,2,3,4,5,6,7,8,9,10,11,0,1,2,3,4,5,6,7,0,1,2,3,4,5);
		$this -> alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');

		$this -> search["y"] = array("L"=>"F", "R"=>"B", "F"=>"R", "B"=>"L", "M"=>"S", "S"=>"M");/* , "x'" => "z", "z'" => "x'", "x" => "z'", "z" => "x", "x2" => "z2", "z2"=>"x2"); */
		$this -> search["y'"] = array("L"=>"B", "R"=>"F", "F"=>"L", "B"=>"R", "M"=>"S", "S"=>"M"); /*, "x'" => "z'", "z'" => "x", "x" => "z", "z" => "x'", "x2" => "z2", "z2"=>"x2");*/
		$this -> search["y2"] = array("L"=>"R", "R"=>"L", "F"=>"B", "B"=>"F"); /*, "x'" => "x", "x" => "x'", "z'" => "z", "z" => "z'");*/
		$this -> search["x"] = array("U"=>"F", "D"=>"B", "F"=>"D", "B"=>"U", "E"=>"S", "S"=>"E"); /*, "y"=>"y z", "y'"=>"y' z'", "y2"=>"y2 x'", "z"=>"y' x", "z'"=>"y x", "z2"=>"y2 x");*/
		$this -> search["x'"] = array("U"=>"B", "D"=>"F", "F"=>"U", "B"=>"D", "E"=>"S", "S"=>"E"); /*, "y"=>"y z'", "y'"=>"y' z", "y2"=>"y2 x", "z"=>"y x'", "z'"=>"y' x'", "z2"=>"y2 x'"); */
		$this -> search["x2"] = array("U"=>"D", "D"=>"U", "F"=>"B", "B"=>"F"); /*, "y"=>"y z2", "y'"=>"y' z2", "y2"=>"z2", "z"=>"y2 z'", "z'"=>"y2 z", "z2"=>"y2");*/
		$this -> search["z"] = array("U"=>"L", "D"=>"R", "R"=>"U", "L"=>"D", "E"=>"M", "M"=>"E"); /*, "y"=>"y x'", "y'"=>"y' x", "y2"=>"y2 z'", "x"=>"y z", "x'"=>"y' z", "x2"=>"y2 z");*/
		$this -> search["z'"] = array("U"=>"R", "D"=>"L", "R"=>"D", "L"=>"U", "E"=>"M", "M"=>"E"); /*, "y"=>"", "y'"=>"y' x'", "y2"=>"", "x"=>"", "x'"=>"", "x2"=>""); */
		$this -> search["z2"] = array("U"=>"D", "D"=>"U", "R"=>"L", "L"=>"R"); /*, "y"=>"", "y'"=>"", "y2"=>"", "x"=>"", "x'"=>"", "x2"=>"");*/
	
		$this -> maska['zbll'] = array();
		$this -> maska['pll'] = array();
		$this -> maska['coll'] = array("place"=>array("edges"=>array(4,5,6,7,8,9,10,11,16,17,18,19,20,21,22,23), "corners"=>array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23)), "orient" => array('edges'=>array(0,1,2,3,12,13,14,15)));
		$this -> maska["oll"] = array("orient"=>array("edges"=>array(0,1,2,3,12,13,14,15), "corners"=>array(0,1,2,3,8,9,10,11,16,17,18,19)), "place"=>array("edges"=>array(4,5,6,7,8,9,10,11,16,17,18,19,20,21,22,23), "corners"=>array(4,5,6,7,12,13,14,15,20,21,22,23)));
		$this -> maska["zbf2l"] = array("orient" => array("edges"=>array(0,1,2,3,12,13,14,15)), "place"=>array("edges"=>array(4,5,6,7,8,9,10,11,16,17,18,19,20,21,22,23), "corners"=>array(4,5,6,7,12,13,14,15,20,21,22,23)));
		$this -> maska["f2l"] = array("place"=>array("edges"=>array(4,5,6,7,8,9,10,11,16,17,18,19,20,21,22,23), "corners"=>array(4,5,6,7,12,13,14,15,20,21,22,23)));
		$this -> maska['els'] = array("orient" => array('edges'=>array(0,1,2,3,12,13,14,15)), "place"=>array("edges"=>array(4,5,6,7,8,9,10,11,16,17,18,19,20,21,22,23), "corners"=>array(5,6,7,13,14,15,21,22,23)));
		$this -> maska['cls'] = array("orient" => array('edges'=>array(0,1,2,3,12,13,14,15), 'corners' => array(0,1,2,3,8,9,10,11,16,17,18,19)), "place"=>array("edges"=>array(4,5,6,7,8,9,10,11,16,17,18,19,20,21,22,23), "corners"=>array(4,5,6,7,12,13,14,15,20,21,22,23)));
		$this -> maska['cll'] = array("place" => array('edges'=>array(4,5,6,7,8,9,10,11,16,17,18,19,20,21,22,23), "corners"=>array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23)));
		$this -> maska['ell'] = array();
		$this -> maska['f2ll'] = array("place"=>array("edges"=>array(4,5,6,7,8,9,10,11,16,17,18,19,20,21,22,23), "corners"=>array(4,5,6,7,12,13,14,15,20,21,22,23)), "orient"=>array("edges"=>array(0,1,2,3,12,13,14,15), "corners"=>array(0,1,2,3,8,9,10,11,16,17,18,19)));
	}
	
		/*
	these tables say from where to take piece, when performing a move, to put
	it into place example:
	you make move R, so $transformations["R"][0] say from what position piece
	comes to position 0 (when you do R the position of piece 0 doesn't change,
	so you need to take piece from position 0 and put it to 0...- do nothing ;) ).
	Also check function applyBasic().

	$solved_cube={0,1,2,3,4,5,6,7,8,9,10,11,0,1,2,3,4,5,6,7,0,1,2,3,4,5};
		           \.........edges........./ \...corners.../ \.centers./
	order of edges:uf,ur,ub,ul,df,dr,db,dl,fr,fl,br,bl
	corners:urf,urb,ulb,ulf,drf,drb,dlb,dlf
	centers:front,back,right,left,up,down

	the values of $cube[0..11] may be from range 0-23, when value is >11
	it means that piece comes from position value-12, but it is flipped

	same for corners, values can be from 0 to 23, but corners have
	3 orientations, so for example 10 means that corner is from pos 2, but
	is twisted clockwise, 18 means that it is the same corner but 
	twisted counter-clockwise (7<value<16 - twisted clockwise, value>15 - 
	counter-clockwise ).

	*/
	
	
	    function getAlgorithmInverse($algorithm)
	{
	  //echo '<br />alg przed zamiana: '.implode(" ",$algorithm);
		$count=0;
		$count=count($algorithm);

		for ($i=$count-1;$i>=0;$i--)
		{
			$dl = strlen($algorithm[$i]);		
			$inv_last="";
			if ($dl==1)
				$inv_last="'";
			if ($dl>1)
			{
				$last_char=substr($algorithm[$i],$dl-1,1);
				if ($last_char=="'")
					$inv_last="";
				else
					if ($last_char=="2")
						$inv_last="2";
					else
						$inv_last="'";
				if ($last_char=="'" || $last_char=="2")
					$algorithm[$i]=substr($algorithm[$i],0,$dl-1);
			}
			$inverse[$count-$i-1]=$algorithm[$i].$inv_last;
		}
		//echo "\tpo zamianie: ".implode(" ",$inverse).'<br />';
		return $inverse;
	}
	
	
	function parse($input) {
		$count=-1;
		$char=substr($input,0,1);
		$input=substr($input,1);
		while($char)
		{
			if ($char==" ")
			{
				$char=substr($input,0,1);
				$input=substr($input,1);
				continue;
			}
			if ($char=="'" || $char=="2")
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
			
		return $moves;
	}
	
	
	function if_regripping_end($i, $moves)
	{
	  	$regrips = array("y", "z", "x");
   		for($i;$i<count($moves);$i++)
   			if(!in_array(substr($moves[$i],0,1), $regrips)) return false;
   			
		return true;
   
 	}
	
	
	function if_small($alg)
	{
   		if(preg_match("/[rlfbudMES]/", $alg)) return false;
		else return true;
 	}
	
	function are_spare_moves($alg)
	{
   		if(preg_match("/[xyzrlfbudMES]/", $alg)) return false;
		else return true;
   		
 	}
 	
	function parse2($input, $mode = "normal") 
	{
		//echo 'alg:&nbsp; '.$input.'<br />';
		
		if($this -> are_spare_moves($input) == true) return $this -> parse($input); 
		//echo 'nie ma spare moves!<br />';
		if($this -> if_small($input) == true) $are_small = false;
		else $are_small = true;
		
		$w_tab = array("r"=>"L x", "r'"=>"L' x'", "r2"=>"L2 x2", "l"=>"R x'", "l'"=>"R' x", "l2"=>"R2 x2", "u"=>"D y", "u'"=>"D' y'", "u2"=>"D2 y2", "d"=>"U y'", "d'"=>"U' y", "d2"=>"U2 y2", "f"=>"B z", "f'"=>"B' z'", "f2"=>"B2 z2", "b"=>"F z'", "b'"=>"F' z", "b2"=>"F2 z2", "M"=>"R L' x'", "M'"=>"R' L x", "M2"=>"R2 L2 x2", "E"=>"U D' y'", "E'"=>"U' D y", "E2"=>"U2 D2 y2", "S"=>"F' B z", "S'"=>"F B' z'", "S2"=>"F2 B2 z2");
		$if_once_again = false;
		
		$count=-1;
		$char=substr($input,0,1);
		$input=substr($input,1);
		while($char)
		{
			if ($char==" ")
			{
				$char=substr($input,0,1);
				$input=substr($input,1);
				continue;
			}
			if ($char=="'" || $char=="2")
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
		
		if($are_small)
		{
			$size = count($moves);
			for($i=0;$i<$size;$i++)
				if(array_key_exists($moves[$i], $w_tab)) $moves[$i] = $w_tab[$moves[$i]]; 
			$moves = $this -> parse(implode(' ', $moves));
		}
		
		$current_rotations = array("R"=>"R", "L"=>"L", "U"=>"U", "D"=>"D", "F"=>"F", "B"=>"B", "M"=>"M", "E"=>"E", "S"=>"S");
		$size = count($moves);
		for($i = 0;$i<$size;$i++)
		{
		  	if($mode == "keep_reg") if($this -> if_regripping_end($i, $moves)) break;
			$temp = trim(substr($moves[$i],0,1));
			if($temp == 'y' || $temp == 'z' || $temp == 'x')
			{
				//echo '<br /><br />----------------------------<br />';
				//echo 'ruch: '.$moves[$i].'<br />';
				$current_rotations = $this -> convert_rotations($moves[$i], $current_rotations);
				$moves = $this -> convert($moves, $i, $moves[$i], $current_rotations);
				$i--;
			}
		}
		return $moves;

	}
	
	
	function convert($moves, $start, $var, $cr)
	{	
		$before = array_slice($moves, 0, $start);
		$end = array_slice($moves, $start);
		
		$move = array_shift($end);
		$i=0;
		$first = '';
		while($first != 'z' && $first != 'y' && $first != 'x' && $i<count($end))
		{
			$first = substr($end[$i],0,1);
				if(array_key_exists($first, $cr)) $end[$i] = substr_replace($end[$i], $cr[$first], 0, 1);
				//else if(array_key_exists(strtoupper($first), $this -> search[$move])) $end[$i] = substr_replace($end[$i], strtolower($this -> search[$move][strtoupper($first)]), 0, 1);
			
			$i++;
		}
		//echo '<br />';
		//var_dump(array_merge($before, $end));
		return array_merge($before, $end);
	}
	
	
	function convert_rotations($move, $cr)
	{
		global $search;
		$copy = $cr;
		$new = array();
		//echo '$move: |'.$move.'|<br />';
		foreach($cr as $key=>$value)
			if(array_key_exists($key, $this -> search[$move])) $new[$key] = $cr[$this -> search[$move][$key]];
			else $new[$key] = $cr[$key];
		/*
		echo 'przed:';
		var_dump($cr);
		echo 'po:';
		var_dump($new);
		*/
		return $new;
	}
	
	
	
	function process($moves,$mode, $parsuj = true)
	{	
		if($parsuj)$moves=$this->parse($moves);
		
		//echo("received:<br>");
		//for ($i=0;$i<count($moves);$i++)
		//echo("$i: '".$moves[$i]."'<br>");
		
        	$cube=array(0,1,2,3,4,5,6,7,8,9,10,11,0,1,2,3,4,5,6,7,0,1,2,3,4,5);
		//if ($mode=="reverse") $moves=$this->getAlgorithmInverse($moves); 
			 $cube=$this->applyAlgorithm($cube,$moves);
		
		
		return $cube;
	}

	function flipEdge($edge)
	{
		return ($edge+12)%24;
	}

	function twistCorner($corner)
	{
		return ($corner+8)%24;
	}

	function twistCornerCounter($corner)
	{
		return $this->twistCorner($this->twistCorner($corner));
	}

	function applyBasic($basic,$cube)
	{
		global $cubeelems,$transformations;
//		echo("applyBasic:Received state:".implode(" ",$cube)."<br>");
//		echo("Applying basic move $basic<br>");
		if ($basic=="F")
		{
			$cube[0]=$this->flipEdge($cube[0]);
			$cube[8]=$this->flipEdge($cube[8]);
			$cube[9]=$this->flipEdge($cube[9]);
			$cube[4]=$this->flipEdge($cube[4]);

			$cube[12]=$this->twistCornerCounter($cube[12]);
			$cube[19]=$this->twistCornerCounter($cube[19]);
			$cube[15]=$this->twistCorner($cube[15]);
			$cube[16]=$this->twistCorner($cube[16]);
		}
		else if ($basic=="B")
		{
			$cube[2]=$this->flipEdge($cube[2]);
			$cube[10]=$this->flipEdge($cube[10]);
			$cube[11]=$this->flipEdge($cube[11]);
			$cube[6]=$this->flipEdge($cube[6]);

			$cube[14]=$this->twistCornerCounter($cube[14]);
			$cube[17]=$this->twistCornerCounter($cube[17]);
			$cube[13]=$this->twistCorner($cube[13]);
			$cube[18]=$this->twistCorner($cube[18]);
		}
		else if ($basic=="R")
		{
			$cube[16]=$this->twistCornerCounter($cube[16]);
			$cube[13]=$this->twistCornerCounter($cube[13]);
			$cube[12]=$this->twistCorner($cube[12]);
			$cube[17]=$this->twistCorner($cube[17]);
		}
		else if ($basic=="L")
		{
			$cube[18]=$this->twistCornerCounter($cube[18]);
			$cube[15]=$this->twistCornerCounter($cube[15]);
			$cube[14]=$this->twistCorner($cube[14]);
			$cube[19]=$this->twistCorner($cube[19]);
		}
		else if ($basic=="x")
		{
			$cube[0]=$this->flipEdge($cube[0]);
			$cube[2]=$this->flipEdge($cube[2]);
			$cube[4]=$this->flipEdge($cube[4]);
			$cube[6]=$this->flipEdge($cube[6]);
			$cube[18]=$this->twistCornerCounter($cube[18]);
			$cube[15]=$this->twistCornerCounter($cube[15]);
			$cube[14]=$this->twistCorner($cube[14]);
			$cube[19]=$this->twistCorner($cube[19]);
			$cube[16]=$this->twistCornerCounter($cube[16]);
			$cube[13]=$this->twistCornerCounter($cube[13]);
			$cube[12]=$this->twistCorner($cube[12]);
			$cube[17]=$this->twistCorner($cube[17]);
		}
		else if ($basic=="y")
		{
			for ($i=8;$i<12;$i++)
				$cube[$i]=$this->flipEdge($cube[$i]);

		}
		else if ($basic=="z")
		{
			for ($i=0;$i<12;$i++)
				$cube[$i]=$this->flipEdge($cube[$i]);

			$cube[14]=$this->twistCornerCounter($cube[14]);
			$cube[17]=$this->twistCornerCounter($cube[17]);
			$cube[13]=$this->twistCorner($cube[13]);
			$cube[18]=$this->twistCorner($cube[18]);
			$cube[12]=$this->twistCornerCounter($cube[12]);
			$cube[19]=$this->twistCornerCounter($cube[19]);
			$cube[15]=$this->twistCorner($cube[15]);
			$cube[16]=$this->twistCorner($cube[16]);

		}
		for ($i=0;$i<$this->cubeelems;$i++)
		{
			$newcube[$i]=$cube[$this->transformations[$basic][$i]];
		}
	//	echo("applyBasic:Returning state:".implode(" ",$newcube)."<br>");
		return $newcube;
	}

	function applyMove($cube,$move)
	{
//		echo("To apply:\"$move\"<br>");
//		echo("applyMove:Received state:".implode(" ",$cube)."<br>");
		switch($move)
		{
			case "R":
				$cube=$this->applyBasic("R",$cube);
				break;
			case "L":
				$cube=$this->applyBasic("L",$cube);
				break;
			case "F":
				$cube=$this->applyBasic("F",$cube);
				break;
			case "B":
				$cube=$this->applyBasic("B",$cube);
				break;
			case "U":
				$cube=$this->applyBasic("U",$cube);
				break;
			case "D":
				$cube=$this->applyBasic("D",$cube);
				break;
			
			case "r":
				$cube=$this->applyAlgorithm($cube,array("L","x"));
				break;
			case "l":
				$cube=$this->applyAlgorithm($cube,array("R","x'"));
				break;
			case "f":
				$cube=$this->applyAlgorithm($cube,array("B","z"));
				break;
			case "b":
				$cube=$this->applyAlgorithm($cube,array("F","z'"));
				break;
			case "u":
				$cube=$this->applyAlgorithm($cube,array("D","y"));
				break;
			case "d":
				$cube=$this->applyAlgorithm($cube,array("U","y'"));
				break;
			
			case "x":
				$cube=$this->applyBasic("x",$cube);
				break;
			case "y":
				$cube=$this->applyBasic("y",$cube);
				break;
			case "z":
				$cube=$this->applyBasic("z",$cube);
				break;
			
			default:
				echo("Bad move:$move<br>");
				exit;

		}

	//	echo("applyMove:Returning state:".implode(" ",$cube)."<br>");
		return $cube;
	}

	function applyAlgorithm($cube,$algorithm)
	{
//		echo("Applying algorithm ".implode(" ",$algorithm)."<br>");
//		echo("Received state:".implode(" ",$cube)."<br>");
		for ($i=0;$i<count($algorithm);$i++)
		{
			$dl = strlen($algorithm[$i]);	
			$last_char="";
			if ($dl>1)
				$last_char=substr($algorithm[$i],$dl-1,1);
//			echo("last_char is \"$last_char\"<br>");
			$times=1;
			if ($last_char=="'")
				$times=3;
			if ($last_char=="2")
				$times=2;
			if ($times>1)
				$algorithm[$i]=substr($algorithm[$i],0,$dl-1);
//			echo("Will apply move $algorithm[$i] $times times<br>");
			for ($j=0;$j<$times;$j++)
			{
				$cube=$this->applyMove($cube,$algorithm[$i]);
			}
		}
		return $cube;
	}
	
	
	function getElemsName($alg, $mode, $cat='zbll', $parsuj=true, $parsuj2=true)
	{
	  	if(trim($alg) == '') return '';
	  	//if($mode == "reverse") $alg = implode(" ",$this -> getAlgorithmInverse($this->parse($alg)));
		//echo 'alg-get-elems: '.$alg.'<br />';
		//if(strlen($alg) > 8) 
		//	if($parsuj) echo 'moves1: '.$alg.'<br />';
		//	else echo 'moves1: '.implode(' ', $alg).'<br />';
		if($parsuj){$alg = $this -> parse(implode(' ', $this-> parse2($alg, $mode))); $parsuj2 = false;}
		//if(count($alg) > 3)echo 'moves2: '.implode(' ', $alg).'<br />';
		//echo $cat."\t".implode(' ', $alg).'<br />';
		$numbers = $this ->process($alg, $mode, $parsuj2);		
		
		if($mode == 'show') {echo 'numbers: <br />'; var_dump($numbers);}
		
		$mod = 12;
		$plus = 0;
		$if_implode = false;
		
		if(count($this -> maska[$cat]) == 0)
		{
			for($i=0;$i<20;$i++)	
				if($numbers[$i] == $this -> starting_state[$i]) $numbers[$i] = -1;
				
			$if_implode = true;
		}
			
		for($i=0;$i<20;$i++)
		{
			if($i < 12) $subcat = "edges";
			else $subcat = "corners";
		
			if($i == 12) {$mod = 8;	$state[] = '&'; $plus = 12;}							// przejście na rogi
			
			// przejście
			if(!array_key_exists('orient', $this -> maska[$cat]) && !array_key_exists('place', $this -> maska[$cat]) && $numbers[$i] != -1)
			{
				$k = $numbers[$i];
				$stan = '';

				while($numbers[($k%$mod)+$plus] != -1) {$k_copy = ($k%$mod)+$plus; $stan .= $this->alphabet[$k]; $k = $numbers[($k%$mod)+$plus]; $numbers[$k_copy] = -1;}
				$state[] = $stan;
			}
			
			
			// stan
			else if(array_key_exists('orient', $this -> maska[$cat]) || array_key_exists('place', $this -> maska[$cat]))
			{	
				if(array_key_exists('orient', $this -> maska[$cat]))
					if(array_key_exists($subcat, $this -> maska[$cat]['orient']))
						if(in_array($numbers[$i], $this -> maska[$cat]['orient'][$subcat]) != false)
							$state[] = floor($numbers[$i]/$mod);
				
				
				if(array_key_exists('place', $this -> maska[$cat]))
					if(array_key_exists($subcat, $this -> maska[$cat]['place']))
						{
							if(in_array($numbers[$i], $this -> maska[$cat]['place'][$subcat]) != false)
								$state[] = $this->alphabet[$numbers[$i]];
							else
							{
			  					if(array_key_exists('orient', $this -> maska[$cat]))
			  					{
									if(!array_key_exists($subcat, $this -> maska[$cat]['orient']) || !in_array($numbers[$i], $this -> maska[$cat]['orient'][$subcat]))
										$state[] = '-';
								}
								else $state[] = '-';
							}
						}
			}
		}

		if(count($state) == 0) return '';
				
		if($if_implode) return implode('|',$state);
		
		return implode('', $state);
			
	}

}



class PocketCube extends RubiksCube
{
	var $transformations;	
	var $cubeelems;
	var $maska;
	
	function PocketCube() {
		$this->cubeelems=8;
		$this->transformations["R"]=array(4,0,2,3,5,1,6,7);
		$this->transformations["L"]=array(0,1,6,2,4,5,7,3);
		$this->transformations["F"]=array(3,1,2,7,0,5,6,4);
		$this->transformations["B"]=array(0,5,1,3,4,6,2,7);
		$this->transformations["U"]=array(1,2,3,0,4,5,6,7);
		$this->transformations["D"]=array(0,1,2,3,7,4,5,6);
		$this->transformations["x"]=array(4,0,3,7,5,1,2,6);
		$this->transformations["y"]=array(1,2,3,0,5,6,7,4);
		$this->transformations["z"]=array(3,2,6,7,0,1,5,4);

		$this->corner_names[0]="UFR"; 		//dobrze zorientowane 
		$this->corner_names[1]="URB";
		$this->corner_names[2]="UBL";
		$this->corner_names[3]="ULF";
		$this->corner_names[4]="DRF";
		$this->corner_names[5]="DBR";
		$this->corner_names[6]="DLB";
		$this->corner_names[7]="DFL";
		
		$this->corner_names[8]="+UFR"; 		//źle zorientowane -> +
		$this->corner_names[9]="+URB";
		$this->corner_names[10]="+UBL";
		$this->corner_names[11]="+ULF";
		$this->corner_names[12]="+DRF";
		$this->corner_names[13]="+DBR";
		$this->corner_names[14]="+DLB";
		$this->corner_names[15]="+DFL";
		
		$this->corner_names[16]="-UFR"; 	//źle zorientowane -> -
		$this->corner_names[17]="-URB";
		$this->corner_names[18]="-UBL";
		$this->corner_names[19]="-ULF";
		$this->corner_names[20]="-DRF";
		$this->corner_names[21]="-DBR";
		$this->corner_names[22]="-DLB";
		$this->corner_names[23]="-DFL";

		$this -> alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
		$this -> starting_state=array(0,1,2,3,4,5,6,7);
		
		$this -> search["y"] = array("L"=>"F", "R"=>"B", "F"=>"R", "B"=>"L", "M"=>"S", "S"=>"M");/* , "x'" => "z", "z'" => "x'", "x" => "z'", "z" => "x", "x2" => "z2", "z2"=>"x2"); */
		$this -> search["y'"] = array("L"=>"B", "R"=>"F", "F"=>"L", "B"=>"R", "M"=>"S", "S"=>"M"); /*, "x'" => "z'", "z'" => "x", "x" => "z", "z" => "x'", "x2" => "z2", "z2"=>"x2");*/
		$this -> search["y2"] = array("L"=>"R", "R"=>"L", "F"=>"B", "B"=>"F"); /*, "x'" => "x", "x" => "x'", "z'" => "z", "z" => "z'");*/
		$this -> search["x"] = array("U"=>"F", "D"=>"B", "F"=>"D", "B"=>"U", "E"=>"S", "S"=>"E"); /*, "y"=>"y z", "y'"=>"y' z'", "y2"=>"y2 x'", "z"=>"y' x", "z'"=>"y x", "z2"=>"y2 x");*/
		$this -> search["x'"] = array("U"=>"B", "D"=>"F", "F"=>"U", "B"=>"D", "E"=>"S", "S"=>"E"); /*, "y"=>"y z'", "y'"=>"y' z", "y2"=>"y2 x", "z"=>"y x'", "z'"=>"y' x'", "z2"=>"y2 x'"); */
		$this -> search["x2"] = array("U"=>"D", "D"=>"U", "F"=>"B", "B"=>"F"); /*, "y"=>"y z2", "y'"=>"y' z2", "y2"=>"z2", "z"=>"y2 z'", "z'"=>"y2 z", "z2"=>"y2");*/
		$this -> search["z"] = array("U"=>"L", "D"=>"R", "R"=>"U", "L"=>"D", "E"=>"M", "M"=>"E"); /*, "y"=>"y x'", "y'"=>"y' x", "y2"=>"y2 z'", "x"=>"y z", "x'"=>"y' z", "x2"=>"y2 z");*/
		$this -> search["z'"] = array("U"=>"R", "D"=>"L", "R"=>"D", "L"=>"U", "E"=>"M", "M"=>"E"); /*, "y"=>"", "y'"=>"y' x'", "y2"=>"", "x"=>"", "x'"=>"", "x2"=>""); */
		$this -> search["z2"] = array("U"=>"D", "D"=>"U", "R"=>"L", "L"=>"R"); /*, "y"=>"", "y'"=>"", "y2"=>"", "x"=>"", "x'"=>"", "x2"=>"");*/
		
		$this -> maska['eg'] = array();
		$this -> maska['ortega_cp'] = array();
		$this -> maska['ss'] = array("or_in_lay"=>array("."=>array(0,1,2,3,8,9,10,11,16,17,18,19), ","=>array(4,5,6,7,12,13,14,15,20,21,22,23)));
		$this -> maska['ortega_co'] = array("or_in_lay"=>array("."=>array(0,1,2,3,8,9,10,11,16,17,18,19), ","=>array(4,5,6,7,12,13,14,15,20,21,22,23)));
	}
	
	function process($moves,$mode, $parsuj = true)
	{	
		if($parsuj)$moves=$this->parse($moves);
//		echo("received:<br>");
//		for ($i=0;$i<count($moves);$i++)
//			echo("$i: '".$moves[$i]."'<br>");
        	$cube=array(0,1,2,3,4,5,6,7);
		//if ($mode=="reverse") $moves=$this->getAlgorithmInverse($moves);
		$cube=$this->applyAlgorithm($cube,$moves);		
		return $cube;
	}

	/*
	these tables say from where to take piece, when performing a move, to put
	it into place example:
	you make move R, so $transformations["R"][0] say from what position piece
	comes to position 0 (when you do R the position of piece 0 doesn't change,
	so you need to take piece from position 0 and put it to 0...- do nothing ;) ).
	Also check function applyBasic().

	$solved_cube={0,1,2,3,4,5,6,7};
		      \...corners.../
	corners:urf,urb,ulb,ulf,drf,drb,dlb,dlf

	*/

	function applyBasic($basic,$cube)
	{
		global $cubeelems,$transformations;
//		echo("applyBasic:Received state:".implode(" ",$cube)."<br>");
//		echo("Applying basic move $basic<br>");
		if ($basic=="F")
		{
			$cube[0]=$this->twistCornerCounter($cube[0]);
			$cube[7]=$this->twistCornerCounter($cube[7]);
			$cube[3]=$this->twistCorner($cube[3]);
			$cube[4]=$this->twistCorner($cube[4]);
		}
		else if ($basic=="B")
		{
			$cube[2]=$this->twistCornerCounter($cube[2]);
			$cube[5]=$this->twistCornerCounter($cube[5]);
			$cube[1]=$this->twistCorner($cube[1]);
			$cube[6]=$this->twistCorner($cube[6]);
		}
		else if ($basic=="R")
		{
			$cube[4]=$this->twistCornerCounter($cube[4]);
			$cube[1]=$this->twistCornerCounter($cube[1]);
			$cube[0]=$this->twistCorner($cube[0]);
			$cube[5]=$this->twistCorner($cube[5]);
		}
		else if ($basic=="L")
		{
			$cube[6]=$this->twistCornerCounter($cube[6]);
			$cube[3]=$this->twistCornerCounter($cube[3]);
			$cube[2]=$this->twistCorner($cube[2]);
			$cube[7]=$this->twistCorner($cube[7]);
		}
		
		else if ($basic=="x")
		{
			$cube[6]=$this->twistCornerCounter($cube[6]);
			$cube[3]=$this->twistCornerCounter($cube[3]);
			$cube[2]=$this->twistCorner($cube[2]);
			$cube[7]=$this->twistCorner($cube[7]);
			$cube[4]=$this->twistCornerCounter($cube[4]);
			$cube[1]=$this->twistCornerCounter($cube[1]);
			$cube[0]=$this->twistCorner($cube[0]);
			$cube[5]=$this->twistCorner($cube[5]);
		}
		else if ($basic=="z")
		{

			$cube[2]=$this->twistCornerCounter($cube[2]);
			$cube[5]=$this->twistCornerCounter($cube[5]);
			$cube[1]=$this->twistCorner($cube[1]);
			$cube[6]=$this->twistCorner($cube[6]);
			$cube[0]=$this->twistCornerCounter($cube[0]);
			$cube[7]=$this->twistCornerCounter($cube[7]);
			$cube[3]=$this->twistCorner($cube[3]);
			$cube[4]=$this->twistCorner($cube[4]);

		}
		
		for ($i=0;$i<$this->cubeelems;$i++)
		{
			$newcube[$i]=$cube[$this->transformations[$basic][$i]];
		}
	//	echo("applyBasic:Returning state:".implode(" ",$newcube)."<br>");
		return $newcube;
	}


	
	function getElemsName($alg, $mode, $cat='eg', $parsuj=true, $parsuj2 = true)
	{
	  	if(trim($alg) == '') return '';
	  	//if($mode == "reverse") $alg = implode(" ",$this -> getAlgorithmInverse($this->parse($alg)));
		//echo 'alg-get-elems: '.$alg.'<br />';
		//if(strlen($alg) > 8) 
		//	if($parsuj) echo 'moves1: '.$alg.'<br />';
		//	else echo 'moves1: '.implode(' ', $alg).'<br />';
		if($parsuj){$alg = $this -> parse(implode(' ', $this-> parse2($alg, $mode))); $parsuj2 = false;}
		//if(count($alg) > 3)echo 'moves2: '.implode(' ', $alg).'<br />';
		//echo $cat."\t".implode(' ', $alg).'<br />';
		$numbers = $this ->process($alg, $mode, $parsuj2);		
		
		if($mode == 'show') {echo 'numbers: <br />'; var_dump($numbers);}
		
		$mod = 8;
		$if_implode = false;
		
		if(count($this -> maska[$cat]) == 0)
		{
			for($i=0;$i<8;$i++)	
				if($numbers[$i] == $this -> starting_state[$i]) $numbers[$i] = -1;
				
			$if_implode = true;
		}
		
		for($i=0;$i<8;$i++)
		{
			if(count($this -> maska[$cat]) == 0 && $numbers[$i] != -1)
			{
		
				$k = $numbers[$i];
				$stan = '';

				while($numbers[$k%$mod] != -1) {$k_copy = $k%$mod; $stan .= $this->alphabet[$k]; $k = $numbers[$k%$mod]; $numbers[$k_copy] = -1;}
				$state[] = $stan;
			}
			
			else if(array_key_exists('or_in_lay', $this -> maska[$cat]))
			{			
 				$keys = array_keys($this->maska[$cat]['or_in_lay']);
 				
 				$lay = $keys[0];
 				foreach($keys as $val)
 					if(in_array($numbers[$i], $this->maska[$cat]['or_in_lay'][$val])) {$lay = $val; break;}
 					
				$state[] = $lay.floor($numbers[$i]/$mod);
			}
		}

		if(count($state) == 0) return '';
		
		if($if_implode) return implode('|',$state);
		
		return implode('', $state);
			
	}
}
/*
$cube = new RubiksCube;

$alg = "L' U2 R U L U' L' U R' U2 L ";

$inv = implode(' ', $cube->getAlgorithmInverse($cube -> parse2($alg)));
echo '$alg: '.$alg.'<br />';
echo '$inv: '.$inv.'<br />';

$methods = array('zbll', 'oll', 'cll', 'ell', 'coll', 'zbf2l', 'f2l', 'f2ll');

for($i = 0; $i < count($methods); $i++)
{
$hash = $cube -> getElemsName($inv, "normal", $methods[$i], true, false);
echo 'method: '.$methods[$i].'<br />';
echo 'hash: '.$hash.'<br /><br />';
}
*/
?>
