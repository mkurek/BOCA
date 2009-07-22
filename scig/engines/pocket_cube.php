<?php
class PocketCube {
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
        	$cube=array(0,1,2,3,4,5,6,7);
		if ($mode=="reverse")
			$moves=$this->getAlgorithmInverse($moves);
		$cube=$this->applyAlgorithm($cube,$moves);
		
		$stickers=$this->stickerize($cube);
		
		return $stickers;
	}

	function stickerize($cube) {
//		echo implode(" ",$cube)."<br/>";
		// corners
		foreach($this->corner_names as $index => $name) {
			$position=$index%8;
			$flip=floor($index/8);
			$stickers[$name]=$this->corner_names[($cube[$position]+$flip*8)%24];

		}
		return $stickers;
	}

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

	$solved_cube={0,1,2,3,4,5,6,7};
		      \...corners.../
	corners:urf,urb,ulb,ulf,drf,drb,dlb,dlf

	*/

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
			$cube[0]=$this->twistCornerCounter($cube[0]);
			$cube[7]=$this->twistCornerCounter($cube[7]);
			$cube[3]=$this->twistCorner($cube[3]);
			$cube[4]=$this->twistCorner($cube[4]);
		}
		if ($basic=="B")
		{
			$cube[2]=$this->twistCornerCounter($cube[2]);
			$cube[5]=$this->twistCornerCounter($cube[5]);
			$cube[1]=$this->twistCorner($cube[1]);
			$cube[6]=$this->twistCorner($cube[6]);
		}
		if ($basic=="R")
		{
			$cube[4]=$this->twistCornerCounter($cube[4]);
			$cube[1]=$this->twistCornerCounter($cube[1]);
			$cube[0]=$this->twistCorner($cube[0]);
			$cube[5]=$this->twistCorner($cube[5]);
		}
		if ($basic=="L")
		{
			$cube[6]=$this->twistCornerCounter($cube[6]);
			$cube[3]=$this->twistCornerCounter($cube[3]);
			$cube[2]=$this->twistCorner($cube[2]);
			$cube[7]=$this->twistCorner($cube[7]);
		}
		if ($basic=="x")
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
		if ($basic=="z")
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
