<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
         "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Static Cube Images Generator</title>
<link rel=stylesheet href="style/style.css" type="text/css">
</head>
<body>
<h1 align="center">Static Cube Images Generator ver. 0.2</h1>
<p>
<h2>Table of contents</h2>
<ol>
	<li><a href="#intro">Introduction</a></li>
	<li><a href="#start">Getting started</a></li>
	<li><a href="#usage">Usage</a>
	<ol>
		<li><a href="#first">First image</a></li>
		<li><a href="#configuration">Configuration</a></li>
		<li><a href="#descriptions">Description files</a></li>
		<li><a href="#names">Names in SCIG</a></li>
		<li><a href="#colors">Colors</a></li>
		<li><a href="#schemes">Color schemes</a></li>
		<li><a href="#views">Views</a></li>
		<li><a href="#specs">Specifications</a></li>
		<li><a href="#engines">Engines</a></li>
		<li><a href="#collections">Collections</a></li>
	</ol>
	<li><a href="#contact">Contact</a></li>
</ol>
</p>
<comment>This page may not display properly if your browser does not support XHTML. Please <a href="http://www.mozilla.com/firefox/">get firefox</a>.
<ol>
<p>
<h2 id="intro"><li>Introduction</li></h2>
SCIG is a PHP script which allows to create static representations of Rubiks Cube and similar puzzles.
It is highly customizable and has many useful features like caching and drawing many cubes on one image.<br/><br/>
Main features:
<ul>
	<li>many views of the same puzzle on one image</li>
	<li>defining your own color schemes and views</li>
	<li>displaying state of the puzzle before or after execution of an algorithm</li>
	<li>defining state of the puzzle explicitely</li>
	<li>drawing arrows</li>
	<li>configuring with YAML</li>
	<li>caching</li>
	<li>handling collections of algorithms</li>
	<li>possibility to add new puzzles</li>
	<li>Joomla mambot</li>
</ul>
</p>
<p>
<h2 id="start"><li>Getting started</li></h2>
To run SCIG on your web server you need to have PHP and GD installed. Then you need to get source code. The best place for this would be
<a href="http://www.sourceforge.net/projects/scig">SCIG sourceforge site</a>(recommended). You can also use SVN repository (the newest possible version), 
but the code there can be unstable. To get SVN version of SCIG run:<br/>
<pre>
svn co https://svn.sourceforge.net/svnroot/scig/trunk scig
</pre>
To do this you must have SVN installed. 
</p>
<p>
Place the <i>scig</i> directory in a place you can access via web server and make sure that <i>cache</i> directory is writable by the web server.
Then point your browser to file <i><a href="sample.php">sample.php</a></i> in <i>doc</i> directory.
If all images are displayed correctly then you have successfully installed SCIG. If you don't see one or more of the images make sure you
have PHP and PHPGD installed. <a href="#contact">Contact me</a> if you encounter other problems.</p>
<p>
<h2 id="usage"><li>Usage</li></h2>
</p>
<p>
In most cases you will have to know only first three sections of this chapter. Rest will be needed only when you will want to create something more
complicated or totally new. Also go through existing SCIG files if you have problems understanding any of the SCIG features.
</p>
<ol>
<p>
<h3 id="first"><li>First image</li></h3>
<p>
Everytime you run <i>scig.php</i> you can specify two parameters: <i>desc</i> and <i>data</i>. The first one is the name of the description file
without the <i>yml</i> extension. Description files are placed in directory <i>descriptions</i>. They contain information about general structure
of an image that will be generated. Read more about them <a href="#descriptions">here</a>. The <i>data</i> can be one of two things: a state
of the puzzle or an algorithm.</p>
<p>
Let's say you want to create nice image for your pr0 T permutation. Then your <i>data</i> will be your algorithm: RUR'U'R'FR2U'R'U'RUR'F'.
You would like to see top face with arrows and front view of the cube. Luckily there already exists a description file (<i>sample/pll</i>) which
describes such situation, let's use it.
<center>
<img src="../scig.php?desc=sample/pll&data=RUR'U'R'FR2U'R'U'RUR'F'"><br/>
scig.php?desc=sample/pll&data=RUR'U'R'FR2U'R'U'RUR'F'
</center><br/>
If you want a different algorithm just change <i>data</i>:
<center>
<img src="../scig.php?desc=sample/pll&data=M2UM2U2M2UM2"><br/>
scig.php?desc=sample/pll&data=M2UM2U2M2UM2
</center>
</p>
</p>
<p>
<h3 id="configuration"><li>Configuration</li></h3>
<p>You can configure general SCIG behaviour in file <i>configuration.yml</i>. <a href="http://www.yaml.org">YAML</a> is used here
(like almost everywhere in SCIG). Don't worry, you don't have to fully learn new language. YAML is extremaly simple and readable so actually
no explanation is needed.</p>
<term>use cache</term><br/>
<div class="def">Set it to true if you want SCIG to cache images (in most cases you want this to be enabled). 
Everytime SCIG will be run it will check if the same image was created before and is stored in cache. If it is it will be used and won't have to
be created. Cached file won't be used if description file was modified. When this is set to true the directory specified as <term>cache dir</term> must be writeable.</div>
<term>cache dir</term><br/>
<div class="def">Directory where cached files will be stored. Must be writeable if <term>use cache</term> is true.</div>
<term>debug</term><br/>
<div class="def">You probably want this set to false.</div>
<term>logs dir</term><br/>
<div class="def">Directory for storing logs. Must be writeable if <term>debug</term> is true.</div>
</p>
<p>
<h3 id="descriptions"><li>Description files</li></h3>
Description files are placed in <i>descriptions</i> directory. They contain general information about the created image. Elements that must
appear in a description file:</p>
<p>
<ul>
	<li><term>puzzle</term><br/>
	<div class="def">The name of the puzzle for which the image will be generated, for example <i>Rubiks Cube</i>. See
	<a href="#names">Names in SCIG</a>.</div></li>
	<li><term>mode</term><br/>
	<div class="def">Can be one of these: <term>normal</term>, <term>effect</term>, <term>reverse</term>.
	<ul>
		<li><term>normal</term><br/>
		<div class="def">You want to specify state of the puzzle on your own. You must check engine's documentation to
		read about used format. Then you must place the description of that state in <i>data</i> parameter. For example you want an
		image where two edges of a Rubiks Cube are swapped (this position is impossible to achieve by any algorithm 
		so you must use <term>normal</term> mode and define state manually). The description file (sample/simple.yml) might look like this:
		<pre>
width:          100
height:         100
<font color="red">mode:           normal</font>
puzzle:         Rubiks Cube
parts:
  - main:
    x:                0
    y:                0
    width:            100
    height:           100
    view:             3face
    scheme:           BOY</pre>
		And the URL:
		<pre>scig.php?desc=sample/simple&data=1.0.2.3.4.5.6.7.8.9.10.11.0.1.2.3.4.5.6.7.0.1.2.3.4.5</pre>
		The result would be:
		<center>
		<img src="../scig.php?desc=sample/simple&data=1.0.2.3.4.5.6.7.8.9.10.11.0.1.2.3.4.5.6.7.0.1.2.3.4.5">
		</center>
		If mode is <term>normal</term> then the <i>data</i> parameter is divided into parts (separated by dot) and these
		parts are passed on to the engine which creates array readable by SCIG.
		</div></li>
		<li><term>effect</term><br/>
		<div class="def">It creates a state of a puzzle after execution of an algorithm specified in the <i>data</i> parameter.
		Notice that you can use parentheses in algorithm (they don't change behaviour of the script, but the algorithm written
		in this way can be displayed when you are using <a href="#collections">Collections</a>).</div></li>
		<li><term>reverse</term><br/>
		<div class="def">It creates a state of a puzzle before execution of an algorithm.</div></li>
	</ul></div></li>
	<li><term>width</term><br/>
	<div class="def">The width of created image.</div></li>
	<li><term>height</term><br/>
	<div class="def">The height of created image.</div></li>
	<li><term>parts</term><br/>
	<div class="def">This element defines parts of an image. Every image can have unlimited amount of them. The description of
	every part starts with a dash and a part name. It must contain following elements:
	<ul>
		<li><term>x</term</br>
		<div class="def">The x coordinate of part's left-top corner.</div></li>
		<li><term>y</term</br>
		<div class="def">The y coordinate of part's left-top corner.</div></li>
		<li><term>width</term</br>
		<div class="def">The width of the part.</div></li>
		<li><term>height</term</br>
		<div class="def">The height of the part.</div></li>
		<li><term>scheme</term</br>
		<div class="def">Name of the color scheme used by the part.</div></li>
		<li><term>view</term</br>
		<div class="def">Name of the view used by the part.</div></li>
	</ul>
	Example:
	<pre>
parts:
  - normal:
      x:                0
      y:                0
      width:            100
      height:           100
      view:             3face
      scheme:           BOY
  - top:
      x:                200
      y:                0
      width:            100
      height:           100
      view:             top
      scheme:           BOY
  - blackandwhite:
      x:                300
      y:                0
      width:            100
      height:           100
      view:             top
      scheme:           blacktop</pre></div></li>
</ul>
</p>
<p>
<h3 id="names"><li>Names in SCIG</li></h3>
In SCIG there are few conventions concerning names of files, directories and classes. They allow SCIG to figure out these names so you won't have
to define them everywhere. Everything starts with the puzzle name that is given in the description file. For example if its <i>Rubiks Cube</i>
then SCIG looks for files rubiks_cube.yml in <i>specs</i> directory for puzzle specification and rubiks_cube.php in <i>engines</i> for puzzle
engine. The engine class name should be <i>RubiksCube</i>. Also all color schemes and views for this puzzle should be in subdirectory 
<i>rubiks_cube</i> in <i>schemes</i> and <i>views</i> directories. Color schemes and views names are lowercased when SCIG looks for their files, so
<i>BOY</i> should be in a file <i>boy.yml</i>.
</p>
<p>
<h3 id="colors"><li>Colors</li></h3>
All colors used by SCIG are defined in file <i>colors.yml</i>. Definition of a color looks like this:
<pre>
color name: red green blue
</pre>
where <i>red</i>, <i>green</i> and <i>blue</i> are numbers from range 0-255. Later (color schemes) you don't have to remember these numbers, you
just use color names. It is important to have <i>transparent</i> color defined, so it can be used in views in some special cases.
</p>
<p>
<h3 id="schemes"><li>Color schemes</li></h3>
Color schemes are files which describe the colors of stickers. They are placed in directory <i>schemes/puzzlename</i>. Of course YAML is used in
these files. Let's see an example (Fridrich PLL):
<pre>
all:    dark gray
U:      yellow
stickers:
  red: FU FRU FLU
  green: RU RUF RUB
  orange: BU BRU BLU
  blue: LU LUF LUB</pre>
If <i>all</i> appears in file it is always processed first and sets color of all stickers to the one given. In the example above first we set
all stickers to dark gray. Then SCIG reads pairs <i>facename: color</i> and sets all stickers on that face to the given color. Next are
pairs <i>stickername: color</i> which set one sticker to given color. Remember that if theres a sticker which has the same name as face (for
example U is a sticker and a face on Rubiks Cube) SCIG will always consider it a face. You should use <i>stickers</i> to set colors of such
stickers. <i>stickers</i> is always read at the end, you can set with it's help many stickers to one color. Of course you could define colors
of all stickers with <i>stickers</i>, but it would take much more time and effort. Remember to color all stickers (with <i>all</i>) 
first to the most common color, then color faces and stickers as last.
</p>
<p>
There are also few special elements which can appear in color scheme:
<ul>
	<li><term>default</term><br/>
	<div class="def">SCIG doesn't allow some stickers (see <a href="#views">views</a>) to be transparent. You can specify <i>default</i>
	color which will be used instead of transparent.</div></li>
	<li><term>arrows</term><br/>
	<div class="def">Color of arrows if they will be drawn.</div></li>
</ul>
</p>
<p>
<h3 id="views"><li>Views</li></h3>
Views' files are placed in directory <i>views/puzzlename</i>. Their function is to describe the appearence of a puzzle. They can contain:
<ul>
	<li><term>use</term><br/>
	<div class="def">Include contents of another view file. Useful when you want to use same lines or/and stickers and just make a minor
	change.</div></li>
	<li><term>width</term><br/>
	<div class="def">This is the width that will mean <i>100% of view's width</i>. Of course all views will be rescaled by the user
	all the time in description files so this doesn't mean much. Use whatever suits you. This is just used inside view's description when
	you specify coordinates.</div></li>
	<li><term>height</term><br/>
	<div class="def">Same as <term>width</term>.</div></li>
	<li><term>base</term><br/>
	<div class="def">The base image that will be used as a background. Image must be a PNG and should be placed in directory <i>bases</i>.
	You should specify filename without png extension. For example if you set <i>base</i> to <i>top</i> SCIG will look for a file
	<i>top.png</i> in <i>views/puzzlename/bases</i> directory. If width or height is unset then both will be set to PNG's width and height. If they are
	set the base image will be rescaled.</div></li>
	<li><term>lines</term><br/>
	<div class="def">List of lines to draw. Definition of each line:
<pre>
  - beginx beginy endx endy [color]
</pre>
	Where <i>beginx</i>, <i>beginy</i>, <i>endx</i>, <i>endy</i> should be numbers &gt;0 and &lt;<term>width</term> (<i>color</i> is not
	required). By default all lines are black. If you want to change their color just specify it as a 5th element.
	All following lines will use new color.</div></li>
	<li><term>stickers</term><br/>
	<div class="def">This section defines places on the image where stickers will be drawn. Every element of the list should like like this:
<pre>
  - sticker coord1x coord1y [coord2x coord2y [coord3x coord3y...]]
</pre>It means you always must specify sticker and two coordinates, but you can more. If you will give two coordinates SCIG will fill
the image at the given coordinates with sticker's color. These coordinates will also be use to draw arrows. Four coordinates mean that
you want to draw rectangle filled with sticker's color. Center of the rectangle will be used to draw arrows. If more coordinates are specified
SCIG will consider them as filled polygon vertices. It will calculate it's center of mass to draw arrows.</div></li>
	<li><term>arrows</term><br/>
	<div class="def">List of stickers for which arrows can be drawn. For example:
<pre>
arrows: UF UR UB UL</pre>
	will draw arrows between edges of top layer. SCIG will not care about orientation of a piece. 
	</div></li>
	<li><term>disable smart arrows</term><br/>
	<div class="def">By default this is false, but if you set it to true SCIG will care about orientation of a piece and will not draw
	arrows if pieces are incorrectly oriented. Example:
	<pre>
arrows: UF UR UB UL UFR UFL UBR UBL</pre>
	<center>
	<table cellspacing="5">
	<tr><td>Smart arrows enabled</td><td>Smart arrows disabled</td></tr>
	<tr><td align="center" valign="middle"><img src="../scig.php?desc=sample/smartarrows&data=L'U'LRU2L'U'LU2R'U"></td>
	<td align="center" valign="middle"><img src="../scig.php?desc=sample/arrows&data=L'U'LRU2L'U'LU2R'U"></td></tr>
	</table>
	</center></div></li>

</ul>
</p>
<p>
<h3 id="specs"><li>Specifications</li></h3>
Specification files describe the structure of the puzzle. They should be located in directory <i>specs</i> and contain two sections:
<ul>
<li><term>stickers</term><br/>
<div class="def">This section should have the following format:
<pre>
stickers:
  - piecetype:
    - [stickerofpiece, stickerofpiece...] # stickers of one piece
    - [stickerofanotherpiece...] # stickers of another piece
    ... # next pieces
  - anotherpiecetype:
    ...</pre>Let's look at Rubiks Cube stickers:
<pre>
stickers:
  - edges:
    - [UF, FU]
    - [UR, RU]
    - [UB, BU]
    - [UL, LU]
    - [DF, FD]
    - [DR, RD]
    - [DB, BD]
    - [DL, LD]
    - [FR, RF]
    - [FL, LF]
    - [BR, RB]
    - [BL, LB]
  - corners:
    - [UFR, FRU, RUF]
    - [UFL, FLU, LUF]
    - [UBR, BRU, RUB]
    - [UBL, BLU, LUB]
    - [DFR, FRD, RDF]
    - [DFL, FLD, LDF]
    - [DBR, BRD, RDB]
    - [DBL, BLD, LDB]
  - centers:
    - U
    - D
    - F
    - B
    - R
    - L
</pre></div></li>
<li><term>faces</term><br/>
<div class="def">Here you place information which sticker belongs to which face. The format is as follows:
<pre>
faces:
  - facename
    - sticker1
    - sticker2
    ...
  - anotherfacename
    ...
  ...</pre>
</div></li>
</ul>
</p>
<p>
<h3 id="engines"><li>Engines</li></h3>
Engines are PHP classes (sorry, no YAML here ;p). They're purpose is to generate the state after of before execution of an algorithm. It should
have at least two public methods:
<ul>
<li><term>process</term><br/>
<div class="def">This method should accept two parameters. First being the algorithm and second the mode (effect or reverse). It should return
an array with indices and values being sticker names. For example:
<pre>$state=$engine->process($alg,$state);
</pre>Then for any stickername <i>$state[stickername]</i> should be also a sticker name and it means <i>there's a $state[stickername] in 
stickername's place</i>.</div></li>
<li><term>stickerize</term><br/>
<div class="def">Accepts one parameter - state of the puzzle but in the format that could be used by human and should return the same
as the <term>process</term> method. It is up to engine writer to create such a readable format and document it. This
format would be used when <term>mode</term> is set to <i>normal</i>.</div></li>
</ul>
</p>
<p>
<h3 id="collections"><li>Collections</li></h3>
SCIG allows to pretty easily display collections of algorithm. For example 21 PLL algorithms. If you want to use that feature your application
should include file <i>collection.php</i> and you should create template file (in directory <i>templates</i>) and collection description 
(<i>collections</i>). Then you should simply use method <i>renderCollection(collection)</i>. Where <i>collection</i> is filename of the
collection description file without extension.
<h3>Collection descriptions</h3>
<ul>
<li><term>description</term><br/>
<div class="def">Name of the description file that will be used when generating images.</div></li>
<li><term>template</term><br/>
<div class="def">Name of the template that will be used, if this is not specify SCIG assumes that it is the same as <term>description</term>.</div></li>
<li><term>algorithms</term><br/>
<div class="def">In this section you define algorithms that will be displayed. The format is as follows:
<pre>
algorithms:
  -
    data: algorithm # where algorithm is for example RUR'
    [other options]
  - data: algorithm2
    [other options]
  ...</pre><i>data</i> is required and is an algorithm or state for which an image will be generated.<i>[other options</i> are pairs <i>option: value</i> which can be used in templates. For example if you also want to display
  a short description of an algorithm you can specify <i>description: Very nice alg</i> and then use {DESCRIPTION} in template.</div></li>

</ul>
<h3>Templates</h3>
Templates are files with <i>xtpl</i> extension. They're basically the same as HTML except you can insert variables in there.
SCIG uses <a href="http://www.phpxtemplate.org">XTemplate</a> as template engine, however only basic features are used now (maybe that'll change).
Your template should define <i>main</i> template so probably it will look like this:
<pre>
&lt;!-- BEGIN: main --&gt;
template content
&lt;!-- END: main --&gt;
</pre>
Remember that you can use here variables defined in collection file (uppercase). SCIG will insert the image in the place of <i>{IMAGE}</i>. 
Example:
<pre>
&lt;!-- BEGIN: main --&gt;
<?php
echo htmlentities("<tr><td align=\"center\"><letter>{NAME}</letter></td><td align=\"center\"><img src=\"../{IMAGE}\"></td>
<td align=\"center\"><alg>{ALG}</alg></td><td><comment>{DESCRIPTION}</comment></td></tr>"); ?>

&lt;!-- END: main --&gt;
</pre>
</p>
</ol>
<p>
<h2 id="contact"><li>Contact</li></h2>
You can contact me via email (tomahawk_pl at users.sourceforge.net). Remember that you can report bugs and feature requests
on <a href="http://www.sourceforge.net/projects/scig">SCIG sourceforge page</a>.
</p>
</ol>
<center>
<hr style="border: 1px solid black; width: 50%;">
<a href="http://sourceforge.net"><img src="http://sflogo.sourceforge.net/sflogo.php?group_id=175129&amp;type=1" width="88" height="31" border="0" alt="SourceForge.net Logo" /></a>
</center>
</body>

</html>
