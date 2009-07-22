<?

include "includes/config.php";
include "includes/add_algs_func.php";
include "includes/mysql.php";



connect($host, $dbuser, $dbhaslo, $db_select);

for($i=796;$i<=852;$i++)
{
 $query = "SELECT `pre-moves`, `alg`, `post-moves` FROM `portal_algs` WHERE SID=$i;";
 
 $result = query($query);
 
 $row = mysql_fetch_row($result);
 $up = ollize(jacubize(stripslashes($row[0].$row[1].$row[2])));
 $query = "UPDATE portal_algs SET `hash`='$up' WHERE SID=$i;";

 //$result = query($query);
 
}

echo 'OK!'

?>