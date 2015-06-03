<?
$host= "192.168.71.184";
$dbuser= "sapunlock";
$dbpass= "sapunlock#uat";
$dbname =  "SAPCPFGUAT";

$link = mysql_connect($host, $dbuser, $dbpass);
mysql_select_db($dbname);
mysql_query('SET CHARACTER SET UTF8');
?>