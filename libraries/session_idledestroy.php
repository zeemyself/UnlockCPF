<?php
session_start();
include "connect.php";
mysql_query("UPDATE log_web SET Logout_status='Time Out' WHERE User_Name_Ldap = '$_SESSION[username]' AND Logon_Date='$_SESSION[todaydate]' AND Logon_Time='$_SESSION[timenow]'");

session_unregister("login");
session_unregister("needLogin");
session_unregister("user");
session_unregister("displayname");
session_unregister("username");
session_unregister("password");
session_unregister("fullname");
session_unregister("firstname");
session_unregister("lastname");
session_unregister("telephone");
session_unregister("mobile");
session_unregister("title");
session_unregister("department");
session_unregister("company");
session_unregister("mail");
session_unregister("log_id");
session_unregister("timenow");
session_unregister("todaydate");
session_unregister("User_Type");
session_unregister("Requirement");
session_unregister("System");
session_unregister("User_ID_SAP");
session_unregister("Client");
session_unregister("message");
session_unregister("msgtype");
session_destroy();

echo  "<script>window.location='../index.php'</script>";
?>
