<?php
/*
$host= "192.168.71.184";
$dbuser= "sapunlock";
$dbpass= "sapunlock#uat";
$dbname =  "SAPCPFGUAT";
*/
$host= "192.168.185.197:3379";	
$dbuser= "sapcpfg";	
$dbpass= "sKslrpe#ws23";
$dbname =  "SAPCPFGPRD";	

$link = mysql_connect($host, $dbuser, $dbpass);
mysql_select_db($dbname);
mysql_query('SET CHARACTER SET UTF8');
?>