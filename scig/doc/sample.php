<?php 
require_once("../collection.php");
?>
<html>
<head>
<title>SCIG sample page</title>
<link rel=stylesheet href="style/style.css" type="text/css">
</head>
<body>
<center>
<h1>SCIG sample page</h1>
<p><img src="../scig.php?desc=sample/all&data=R2U2R'U'R'URU'RU'R2U2RU2R'"><br/><alg>R2U2R'U'R'URU'RU'R2U2RU2R'</alg>
<br/><comment>5 views on one image</comment></p>
<p><img src="../scig.php?desc=sample/f2l&data=RU2R'U'RUR'"><br/><alg>RU2R'U'RUR'</alg>
<br/><comment>3face view and F2L scheme are used to nicely display F2L algs.</comment></p>
<p><img src="../scig.php?desc=sample/oll&data=FRUR'U'F'"><br/><alg>FRUR'U'F'</alg>
<br/><comment>Two views ('3face' and 'top2'), 'OLL' and 'blacktop' color schemes are used. Good for displaying OLL cases.</comment></p>
<p><img src="../scig.php?desc=sample/pll&data=RUR'U'R'FR2U'R'U'RUR'F'"><br/><alg>RUR'U'R'FR2U'R'U'RUR'F'</alg>
<br/><comment>Views: '3face', 'top'. Schemes: 'PLL', 'blacktop'.</comment></p>
<p><img src="../scig.php?desc=sample/pocket&data=RUR'URU2R'"><br/><alg>RUR'URU2R'</alg>
<br/><comment>Pocket cube.</comment></p>
<hr width=200>
<p><comment>Displaying collection - few PLL algs</comment></p>
<p>
<table width="80%" style="border: 1px solid;";>
<tr><th></th><th>Image</th><th>Algorithm</th><th>Description</th></tr>
<?php
displayCollection("pll");
?>
</table>
</p>
</center>
</body>
</html
