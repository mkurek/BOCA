<?php
class RubiksCube {
	var $transformations;	
	var $cubeelems;
	
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

		return $moves;

	}
	
	function getAlgorithmInverse($algorithm)
	{
		$count=0;
		$count=count($algorithm);
		for ($i=$count-1;$i>=0;$i--)
		{
			$inv_last="";
			if (strlen($algorithm[$i])==1)
				$inv_last="'";
			if (strlen($algorithm[$i])>1)
			{
				$last_char=substr($algorithm[$i],strlen($algorithm[$i])-1,1);
				if ($last_char=="'")
					$inv_last="";
				else
					if ($last_char=="2")
						$inv_last="2";
					else
						$inv_last="'";
				if ($last_char=="'" || $last_char=="2")
					$algorithm[$i]=substr($algorithm[$i],0,strlen($algorithm[$i])-1);
			}
			$inverse[$count-$i-1]=$algorithm[$i].$inv_last;
		}
		return $inverse;
	}
	function process($input,$mode)
	{
		$moves=$this->parse($input);
//		echo("received:<br>");
//		for ($i=0;$i<count($moves);$i++)
//			echo("$i: '".$moves[$i]."'<br>");
        	$cube=array(0,1,2,3,4,5,6,7,8,9,10,11,0,1,2,3,4,5,6,7,0,1,2,3,4,5);
		if ($mode=="reverse")
			$moves=$this->getAlgorithmInverse($moves);
		$cube=$this->applyAlgorithm($cube,$moves);
		$stickers=$this->stickerize($cube);
		return $stickers;
	}

	function stickerize($cube) {
//		echo implode(" ",$cube)."<br/>";
		// centers
		foreach($this->center_names as $index => $name) {
			$stickers[$name]=$this->center_names[$cube[$index+20]];
		}
		// edges
		foreach($this->edge_names as $index => $name) {
			$position=$index%12;
			$flip=floor($index/12);
			$stickers[$name]=$this->edge_names[($cube[$position]+$flip*12)%24];
			
		}
		// corners
		foreach($this->corner_names as $index => $name) {
			$position=$index%8;
			$flip=floor($index/8);
			$stickers[$name]=$this->corner_names[($cube[$position+12]+$flip*8)%24];

		}
		return $stickers;
	}

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

		$this->edge_names[0]="UF";
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
		$this->edge_names[12]="FU";
		$this->edge_names[13]="RU";
		$this->edge_names[14]="BU";
		$this->edge_names[15]="LU";
		$this->edge_names[16]="FD";
		$this->edge_names[17]="RD";
		$this->edge_names[18]="BD";
		$this->edge_names[19]="LD";
		$this->edge_names[20]="RF";
		$this->edge_names[21]="LF";
		$this->edge_names[22]="RB";
		$this->edge_names[23]="LB";

		$this->corner_names[0]="UFR";
		$this->corner_names[1]="UBR";
		$this->corner_names[2]="UBL";
		$this->corner_names[3]="UFL";
		$this->corner_names[4]="DFR";
		$this->corner_names[5]="DBR";
		$this->corner_names[6]="DBL";
		$this->corner_names[7]="DFL";
		
		$this->corner_names[8]="FRU";
		$this->corner_names[9]="RUB";
		$this->corner_names[10]="BLU";
		$this->corner_names[11]="LUF";
		$this->corner_names[12]="RDF";
		$this->corner_names[13]="BRD";
		$this->corner_names[14]="LDB";
		$this->corner_names[15]="FLD";
		
		$this->corner_names[16]="RUF";
		$this->corner_names[17]="BRU";
		$this->corner_names[18]="LUB";
		$this->corner_names[19]="FLU";
		$this->corner_names[20]="FRD";
		$this->corner_names[21]="RDB";
		$this->corner_names[22]="BLD";
		$this->corner_names[23]="LDF";

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
		if ($basic=="B")
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
		if ($basic=="R")
		{
			$cube[16]=$this->twistCornerCounter($cube[16]);
			$cube[13]=$this->twistCornerCounter($cube[13]);
			$cube[12]=$this->twistCorner($cube[12]);
			$cube[17]=$this->twistCorner($cube[17]);
		}
		if ($basic=="L")
		{
			$cube[18]=$this->twistCornerCounter($cube[18]);
			$cube[15]=$this->twistCornerCounter($cube[15]);
			$cube[14]=$this->twistCorner($cube[14]);
			$cube[19]=$this->twistCorner($cube[19]);
		}
		if ($basic=="x")
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
		if ($basic=="y")
		{
			for ($i=8;$i<12;$i++)
				$cube[$i]=$this->flipEdge($cube[$i]);

		}
		if ($basic=="z")
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
			case "Ra":
				$cube=$this->applyAlgorithm($cube,array("R","L"));
				break;
			case "La":
				$cube=$this->applyAlgorithm($cube,array("R","L"));
				break;
			case "Fa":
				$cube=$this->applyAlgorithm($cube,array("F","B"));
				break;
			case "Ba":
				$cube=$this->applyAlgorithm($cube,array("F","B"));
				break;
			case "Ua":
				$cube=$this->applyAlgorithm($cube,array("U","D"));
				break;
			case "Ds":
				$cube=$this->applyAlgorithm($cube,array("U","D"));
				break;
			case "Rs":
				$cube=$this->applyAlgorithm($cube,array("R","L'"));
				break;
			case "Ls":
				$cube=$this->applyAlgorithm($cube,array("R'","L"));
				break;
			case "Fs":
				$cube=$this->applyAlgorithm($cube,array("F","B'"));
				break;
			case "Bs":
				$cube=$this->applyAlgorithm($cube,array("B","F'"));
				break;
			case "Us":
				$cube=$this->applyAlgorithm($cube,array("U","D'"));
				break;
			case "Ds":
				$cube=$this->applyAlgorithm($cube,array("D","U'"));
				break;
			case "S":
				$cube=$this->applyAlgorithm($cube,array("F'","B","z"));
				break;
			case "M":
				$cube=$this->applyAlgorithm($cube,array("R","L'","x'"));
				break;
			case "E":
				$cube=$this->applyAlgorithm($cube,array("D'","U","y'"));
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
			$last_char="";
			if (strlen($algorithm[$i])>1)
				$last_char=substr($algorithm[$i],strlen($algorithm[$i])-1,1);
//			echo("last_char is \"$last_char\"<br>");
			$times=1;
			if ($last_char=="'")
				$times=3;
			if ($last_char=="2")
				$times=2;
			if ($times>1)
				$algorithm[$i]=substr($algorithm[$i],0,strlen($algorithm[$i])-1);
//			echo("Will apply move $algorithm[$i] $times times<br>");
			for ($j=0;$j<$times;$j++)
			{
				$cube=$this->applyMove($cube,$algorithm[$i]);
			}
		}
		return $cube;
	}

}