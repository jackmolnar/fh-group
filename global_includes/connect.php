<?php

$dbhost = 'xxxxxxx';
$dbuser = 'xxxxxxx';
$dbpass = 'xxxxxxx';
$dbname = 'xxxxxxx';

date_default_timezone_set("US/Eastern");



$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if (!$conn)
  {
  die('Could not connect: ' . mysql_error());
  } else {
	  echo '';
  }
mysql_select_db($dbname, $conn);
?>
