<?php

$host= "192.168.166.179:3306";	
$dbuser= "adss";	
$dbpass= "password@1";
$dbname =  "adssdev";	

$link = mysql_connect($host, $dbuser, $dbpass);
mysql_select_db($dbname);
mysql_query('SET CHARACTER SET UTF8');
?>