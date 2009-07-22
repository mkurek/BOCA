<?php

// BigDump ver. 0.21b from 2005-02-08
// Staggered import of an large MySQL Dump (like phpMyAdmin 2.x Dump)
// Even through the webservers with hard runtime limit and those in safe mode
// Works fine with Internet Explorer 6.0 SP1, Mozilla 1.x and even Netscape 4.8

// Author:       Alexey Ozerov (alexey at ozerov dot de) 
// Copyright:    GPL (C) 2003-2005
// More Infos:   http://www.ozerov.de/bigdump

// This program is free software; you can redistribute it and/or modify it under the
// terms of the GNU General Public License as published by the Free Software Foundation; 
// either version 2 of the License, or (at your option) any later version.

// THIS SCRIPT IS PROVIDED AS IS, WITHOUT ANY WARRANTY OR GUARANTEE OF ANY KIND

// USAGE:

// 1. Adjust the database configuration in this file
// 2. Drop the old tables on the target database if your dump doesn't contain "DROP TABLE"
// 3. Create the working directory (e.g. dump) on your web-server 
// 4. If you want to upload the dump files directly from the web-browser give the scripts 
//    writing permissions on the working directory (chmod 777 on a Linux based system) 
// 5. Upload bigdump.php and your dump files (.sql, .gz) via FTP to the working directory
// 6. Run the bigdump.php from your browser via URL like http://www.yourdomain.com/dump/bigdump.php
// 7. BigDump will start the next import session automatically if you enable the JavaScript
// 8. Wait for the script to finish, do not close the browser window
// 9. IMPORTANT: Remove bigdump.php and your dump files from the web-server

// If Timeout errors still occure you may need to adjust the $linepersession setting in this file

// VERSION HISTORY

// Version 0.21b 2005-02-08
// *** extended inserts giveup bugfix (don't count linebreaks within text fields)

// Version 0.20b 2005-01-05
// *** short_open_tag=off bugfix
// *** stop processing on extended insert
// *** disable upload of PHP files
// *** minor bugfixes

// Version 0.19b 2004-05-31
// *** # comment in the text field bugfix

// Version 0.18b 2004-03-18
// *** \\' in the text field bugfix

// Version 0.17b 2003-12-14
// *** MySQL deprecated '-- ' comment bugfix
// *** Drop user-defined proprietary comment lines
// *** Improved anti-cache headers

// Version 0.16b 2003-11-20
// *** Register globals bugfix

// Version 0.15b 2003-11-02
// *** Dump file browser upload feature added (for dump files up to upload_max_filesize)
// *** Dump file mini-browser for the working directory added

// Version 0.14b 2003-10-12
// *** GZip compressed files support added (available with PHP 4.3.0+)

// Version 0.13b 2003-10-09
// *** Query definition bugfix: don't stop query inside an text field ending by ';'
// *** Query definition bugfix: don't trim queries since spaces can be useful :-)
// *** $delaypersession setting added

// Version 0.12 2003-07-11
// *** File seek by fseek() instead of line skipping should avoid time loss when skipping lines
//     Thanks to Anton Hummel for this idea

// Version 0.11 2003-03-11
// *** Table definition bugfix: don't stop session inside an SQL query
// *** Queries statistics added

// Database configuration

$db_server   = "localhost";
$db_name     = "cube3";
$db_username = "mateusz";
$db_password = "informatyka";


// Other Settings

$filename        = "";     // Specify the dump filename to suppress the file selection dialog
$linespersession = 10000;   // Lines to be executed per one import session
$delaypersession = 0;      // You can specify a sleep time in milliseconds after each session
                           // Works only if JavaScript is activated. Use to reduce server overrun

// Allowed comment delimiters: lines starting with these strings will be dropped by BigDump

$comment[0]="#";           // Standard comment lines are dropped by default
$comment[1]="-- ";
// $comment[2]="---";      // Uncomment this line if using proprietary dump created by outdated mysqldump
// $comment[3]="";         // Or add your own string to leave out other proprietary things


// *******************************************************************************************
// If not familiar with PHP please don't change anything below this line
// *******************************************************************************************

define ("VERSION","0.21b");
define ("MAX_LINE_LENGTH",65536);
define ("MAX_QUERY_LINES",300);

ini_set("auto_detect_line_endings", true);

header("Expires: Mon, 1 Dec 2003 01:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>BigDump ver. <?php echo (VERSION); ?></title>
<META HTTP-EQUIV="CONTENT-TYPE" CONTENT="text/html; CHARSET=iso-8859-1">
<META HTTP-EQUIV="CONTENT-LANGUAGE" CONTENT="EN">

<META http-equiv="Cache-Control" content="no-cache">
<META http-equiv="Pragma" content="no-cache">
<META http-equiv="Expires" content="-1">

<style type="text/css">
<!--

body
{ background-color:#FFFFF0;
}

h1 
{ font-size:25px;
  line-height:28px;
  font-family:Arial,Helvetica,sans-serif;
  margin-top:5px;
  margin-bottom:5px;
}

p,td,th
{ font-size:14px;
  line-height:18px;
  font-family:Arial,Helvetica,sans-serif;
  margin-top:5px;
  margin-bottom:5px;
  text-align:justify;
  vertical-align:top;
}

p.error
{ color:#FF0000;
  font-weight:bold;
}

p.success
{ color:#00DD00;
  font-weight:bold;
}

td
{ background-color:#F8F8F8;
  text-align:left;
}

td.transparent
{ background-color:#FFFFF0;
}

th
{ font-weight:bold;
  color:#FFFFFF;
  background-color:#008080;
  text-align:left;
}

td.right
{ text-align:right;
}

form
{ margin-top:5px;
  margin-bottom:5px;
}

-->
</style>

</head>

<body>

<table width="780" cellspacing="0" cellpadding="0">
<tr><td class="transparent">

<h1>BigDump: Staggered MySQL Dump Importer ver. <?php echo (VERSION); ?></h1>

<?php

$error = false;
$file  = false;

// Check PHP version

if (!$error && !function_exists("version_compare"))
{ echo ("<p class=\"error\">PHP version 4.1.0 is required for BigDump to proceed. You have PHP ".phpversion()." installed. Sorry!</p>\n");
  $error=true;
}

// Calculate PHP max upload size (handle settings like 10M or 100K)

if (!$error)
{ $upload_max_filesize=ini_get("upload_max_filesize");
  if (eregi("([0-9]+)K",$upload_max_filesize,$tempregs)) $upload_max_filesize=$tempregs[1]*1024;
  if (eregi("([0-9]+)M",$upload_max_filesize,$tempregs)) $upload_max_filesize=$tempregs[1]*1024*1024;
  if (eregi("([0-9]+)G",$upload_max_filesize,$tempregs)) $upload_max_filesize=$tempregs[1]*1024*1024*1024;
}

// Handle file upload

$upload_dir=dirname($_SERVER["SCRIPT_FILENAME"]);

if (!$error && isset($_REQUEST["uploadbutton"]))
{ if (is_uploaded_file($_FILES["dumpfile"]["tmp_name"]) && ($_FILES["dumpfile"]["error"])==0)
  { 
    $uploaded_filename=str_replace(" ","_",$_FILES["dumpfile"]["name"]);
    $uploaded_filepath=str_replace("\\","/",$upload_dir."/".$uploaded_filename);
    	
    if (file_exists($uploaded_filename))
    { echo ("<p class=\"error\">File $uploaded_filename already exist! Delete and upload again!</p>\n");
    }
    else if (eregi("(\.php|\.php3|\.php4|\.php5)$",$uploaded_filename))
    { echo ("<p class=\"error\">You may not upload this type of files.</p>\n");
    }
    else if (!@move_uploaded_file($_FILES["dumpfile"]["tmp_name"],$uploaded_filepath))
    { echo ("<p class=\"error\">Error moving uploaded file ".$_FILES["dumpfile"]["tmp_name"]." to the $uploaded_filepath</p>\n");
      echo ("<p>Check the directory permissions for $upload_dir (must be 777)!</p>\n");
    }
    else
    { echo ("<p class=\"success\">Uploaded file saved as $uploaded_filename</p>\n");
    }
  }
  else
  { echo ("<p class=\"error\">Error uploading file ".$_FILES["dumpfile"]["name"]."</p>\n");
  }
}


// Handle file deletion (delete only in the current directory for security reasons)

if (!$error && isset($_REQUEST["delete"]) && $_REQUEST["delete"]!=basename($_SERVER["SCRIPT_FILENAME"]))
{ if (@unlink(basename($_REQUEST["delete"])))
    echo ("<p class=\"success\">".$_REQUEST["delete"]." was removed successfully</p>\n");
  else
    echo ("<p class=\"error\">Can't remove ".$_REQUEST["delete"]."</p>\n");
}


// Open the database

if (!$error)
{ $dbconnection = @mysql_connect($db_server,$db_username,$db_password); 
  if ($dbconnection) 
    $db = mysql_select_db($db_name);
  if (!$dbconnection || !$db) 
  { echo ("<p class=\"error\">Database connection failed due to ".mysql_error()."</p>\n");
    echo ("<p>Edit the database settings in ".$_SERVER["SCRIPT_FILENAME"]." or contact your database provider</p>\n");
    $error=true;
  }
}


// List uploaded files in multifile mode

if (!$error && !isset($_REQUEST["fn"]) && $filename=="")
{ if ($dirhandle = opendir($upload_dir)) 
  { $dirhead=false;
    while (false !== ($dirfile = readdir($dirhandle)))
    { if ($dirfile != "." && $dirfile != ".." && $dirfile!=basename($_SERVER["SCRIPT_FILENAME"]))
      { if (!$dirhead)
        { echo ("<table cellspacing=\"2\" cellpadding=\"2\">\n");
          echo ("<tr><th>Filename</td><th>Size</td><th>Date&amp;Time</td><th>Type</td><th>&nbsp;</td><th>&nbsp;</td>\n");
          $dirhead=true;
        }
        echo ("<tr><td>$dirfile</td><td class=\"right\">".filesize($dirfile)."</td><td>".date ("Y-m-d H:i:s", filemtime($dirfile))."</td>");
        if (eregi("\.gz$",$dirfile)) 
          echo ("<td>GZip</td>");
        else 
          echo ("<td>SQL</td>");
        if (!eregi("\.gz$",$dirfile) || function_exists("gzopen")) 
          echo ("<td><a href=\"".$_SERVER["PHP_SELF"]."?start=1&fn=$dirfile&foffset=0&totalqueries=0\">Start Import</a> into $db_name at $db_server</td>\n");
        else
          echo ("<td>&nbsp;</td>\n");
        echo ("<td><a href=\"".$_SERVER["PHP_SELF"]."?delete=$dirfile\">Delete file</a></td></tr>\n");
      } 

    }
    if ($dirhead) echo ("</table>\n");
    else echo ("<p>No uploaded files found in the working directory</p>\n");
    closedir($dirhandle); 
  }
  else
  { echo ("<p class=\"error\">Error listing directory $upload_dir</p>\n");
    $error=true;
  }
}


// Single file mode

if (!$error && !isset ($_REQUEST["fn"]) && $filename!="")
{ echo ("<p><a href=\"".$_SERVER["PHP_SELF"]."?start=1&fn=$filename&foffset=0&totalqueries=0\">Start Import</a> from $filename into $db_name at $db_server</p>\n");
}


// File Upload Form

if (!$error && !isset($_REQUEST["fn"]) && $filename=="")
{ 

// Test permissions on working directory

  do { $tempfilename=time().".tmp"; } while (file_exists($tempfilename));
  if (!($tempfile=@fopen($tempfilename,"w")))
  { echo ("<p>Upload form disabled. Permissions for the working directory <i>$upload_dir</i> <b>must be set to 777</b> in order ");
    echo ("to upload files from here. Alternatively you can upload your dump files via FTP.</p>\n");
  }
  else
  { fclose($tempfile);
    unlink ($tempfilename);
 
    echo ("<p>You can now upload your dump file up to $upload_max_filesize bytes (".round ($upload_max_filesize/1024/1024)." Mbytes)  ");
    echo ("directly from your browser to the server. Alternatively you can upload your dump files of any size via FTP.</p>\n");
?>
<form method="POST" action="<?php echo ($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
<input type="hidden" name="MAX_FILE_SIZE" value="$upload_max_filesize">
<p>Dump file: <input type="file" name="dumpfile" accept="*/*" size=60"></p>
<p><input type="submit" name="uploadbutton" value="Upload"></p>
</form>
<?php
  }
}


// Open the file

if (!$error && isset($_REQUEST["fn"]))
{ 

// Recognize GZip filename

  if (eregi("\.gz$",$_REQUEST["fn"])) 
    $gzipmode=true;
  else
    $gzipmode=false;

  if ((!$gzipmode && !$file=fopen($_REQUEST["fn"],"rt")) || ($gzipmode && !$file=gzopen($_REQUEST["fn"],"rt")))
  { echo ("<p class=\"error\">Can't open ".$_REQUEST["fn"]." for import</p>\n");
    echo ("<p>You have to upload the ".$_REQUEST["fn"]." to the server</p>\n");
    $error=true;
  }

// Get the file size (can't do it fast on gzipped files, no idea how)

  else if ((!$gzipmode && fseek($file, 0, SEEK_END)==0) || ($gzipmode && gzseek($file, 0, SEEK_SET)==0))
  { if (!$gzipmode) $filesize = ftell($file);
    else $filesize = gztell($file); // Always zero, ignore
  }
  else
  { echo ("<p class=\"error\">I can't get the filesize of ".$_REQUEST["fn"]."</p>\n");
    $error=true;
  }
}


// ****************************************************
// START IMPORT SESSION HERE
// ****************************************************

if (!$error && isset($_REQUEST["start"]) && isset($_REQUEST["foffset"]))
{
  echo ("<p>Processing file: ".$_REQUEST["fn"]."</p>\n");
  echo ("<p>Starting at the line: ".$_REQUEST["start"]."</p>\n");

// Check $_REQUEST["foffset"] upon $filesize (can't do it on gzipped files)

  if (!$gzipmode && $_REQUEST["foffset"]>$filesize)
  { echo ("<p class=\"error\">UNEXPECTED: Can't set file pointer behind the end of file</p>\n");
    $error=true;
  }

// Set file pointer to $_REQUEST["foffset"]

  if (!$error && ((!$gzipmode && fseek($file, $_REQUEST["foffset"])!=0) || ($gzipmode && gzseek($file, $_REQUEST["foffset"])!=0)))
  { echo ("<p class=\"error\">UNEXPECTED: Can't set file pointer to offset: ".$_REQUEST["foffset"]."</p>\n");
    $error=true;
  }

// Start processing queries from $file

  if (!$error)
  { $query="";
    $queries=0;
    $totalqueries=$_REQUEST["totalqueries"];
    $linenumber=$_REQUEST["start"];
    $querylines=0;
    $inparents=false;

    while (($linenumber<$_REQUEST["start"]+$linespersession || $query!="") 
       && ((!$gzipmode && $dumpline=fgets($file, MAX_LINE_LENGTH)) || ($gzipmode && $dumpline=gzgets($file, MAX_LINE_LENGTH))))
    { 
      
// Handle DOS and Mac encoded linebreaks (I don't know if it will work on Win32 or Mac Servers)

      $dumpline=ereg_replace("\r\n$", "\n", $dumpline);
      $dumpline=ereg_replace("\r$", "\n", $dumpline);
      
// DIAGNOSTIC
// echo ("<p>Line $linenumber: $dumpline</p>\n");

// Skip comments and blank lines only if NOT in parents

      if (!$inparents)
      { $skipline=false;
        reset($comment);
        foreach ($comment as $comment_value)
        { if (!$inparents && (trim($dumpline)=="" || strpos ($dumpline, $comment_value) === 0))
          { $skipline=true;
            break;
          }
        }
        if ($skipline)
        { $linenumber++;
          continue;
        }
      }

// Remove double back-slashes from the dumpline prior to count the quotes ('\\' can only be within strings)
      
      $dumpline_deslashed = str_replace ("\\\\","",$dumpline);

// Count ' and \' in the dumpline to avoid query break within a text field ending by ;
// Please don't use double quotes ('"')to surround strings, it wont work

      $parents=substr_count ($dumpline_deslashed, "'")-substr_count ($dumpline_deslashed, "\\'");
      if ($parents % 2 != 0)
        $inparents=!$inparents;

// Add the line to query

      $query .= $dumpline;

// Don't count the line if in parents (text fields may include unlimited linebreaks)
      
      if (!$inparents)
        $querylines++;
      
// Stop if query contains more lines as defined by MAX_QUERY_LINES

      if ($querylines>MAX_QUERY_LINES)
      {
        echo ("<p class=\"error\">Stopped at the line $linenumber. </p>");
        echo ("<p>At this place the current query includes more than ".MAX_QUERY_LINES." dump lines. That can happen if your dump file was ");
        echo ("created by some tool which doesn't place a semicolon followed by a linebreak at the end of each query, or if your dump contains ");
        echo ("extended inserts. Please read the BigDump FAQs for more infos.</p>\n");
        $error=true;
        break;
      }

// Execute query if end of query detected (; as last character) AND NOT in parents

      if (ereg(";$",trim($dumpline)) && !$inparents)
      { if (!mysql_query(trim($query), $dbconnection))
        { echo ("<p class=\"error\">Error at the line $linenumber: ". trim($dumpline)."</p>\n");
          echo ("<p>Query: ".trim($query)."</p>\n");
          echo ("<p>MySQL: ".mysql_error()."</p>\n");
          $error=true;
          break;
        }
        $totalqueries++;
        $queries++;
        $query="";
        $querylines=0;
      }
      $linenumber++;
    }
  }

// Get the current file position

  if (!$error)
  { if (!$gzipmode) 
      $foffset = ftell($file);
    else
      $foffset = gztell($file);
    if (!$foffset)
    { echo ("<p class=\"error\">UNEXPECTED: Can't read the file pointer offset</p>\n");
      $error=true;
    }
  }

// Finish message and restart the script

  if (!$error)
  { echo ("<p>Stopping at the line: ".($linenumber-1)."</p>\n");
    echo ("<p>Queries performed (this session/total): $queries/$totalqueries</p>\n");
    echo ("<p>Total bytes processed: $foffset (".round($foffset/1024)." KB)</p>\n");
    if ($linenumber<$_REQUEST["start"]+$linespersession)
    { echo ("<p class=\"success\">Congratulations: End of file reached, assuming OK</p>\n");
      echo ("<p>Thank you for using! Please rate <a href=\"http://www.hotscripts.com/Detailed/20922.html\" target=\"_blank\">Bigdump at Hotscripts.com</a></p>\n");
      echo ("<p>You can send me some bucks or euros as appreciation <a href=\"http://www.ozerov.de/bigdump\" target=\"_blank\">via PayPal</a></p>\n");
      $error=true;
    }
    else
    { if ($delaypersession!=0)
        echo ("<p>Now I'm <b>waiting $delaypersession milliseconds</b> before starting next session...</p>\n");
      echo ("<script language=\"JavaScript\" type=\"text/javascript\">window.setTimeout('location.href=\"".$_SERVER["PHP_SELF"]."?start=$linenumber&fn=".$_REQUEST["fn"]."&foffset=$foffset&totalqueries=$totalqueries\";',500+$delaypersession);</script>\n");
      echo ("<noscript>\n");
      echo ("<p><a href=\"".$_SERVER["PHP_SELF"]."?start=$linenumber&fn=".$_REQUEST["fn"]."&foffset=$foffset&totalqueries=$totalqueries\">Continue from the line $linenumber</a> (Enable JavaScript to do it automatically)</p>\n");
      echo ("</noscript>\n");
      echo ("<p>Press <a href=\"".$_SERVER["PHP_SELF"]."\">STOP</a> to abort the import <b>OR WAIT!</b></p>\n");
    }
  }
  else 
    echo ("<p class=\"error\">Stopped on error</p>\n");
}

if ($error)
  echo ("<p><a href=\"".$_SERVER["PHP_SELF"]."\">Start from the beginning</a> (DROP the old tables before restarting)</p>\n");

if ($dbconnection) mysql_close();
if ($file && !$gzipmode) fclose($file);
else if ($file && $gzipmode) gzclose($file);

?>

<p> 2003-2005 <a href="mailto:alexey@ozerov.de">Alexey Ozerov</a> - <a href="http://www.ozerov.de/bigdump" target="_blank">BigDump Home</a></p>

</td></tr></table>

</body>
</html>
