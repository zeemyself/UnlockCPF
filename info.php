<? 
session_start();
include ("libraries/cfg/cfg.inc.php");
include ("libraries/class/adLDAP.php");
include ("libraries/include_mail.php");
include ("libraries/include_sms.php");
include ("libraries/include_changepw.php");
  
//echo ini_get('display_errors');
// ini_set('display_errors', '1');
//print_r($_SESSION) 
//echo $_SESSION['id_card'];
if(!$_SESSION["login"]){
echo "<script>window.location='http://www.google.com'</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CPF Self Unlock/Reset Password</title>
<link href="css/sap.css" rel="stylesheet" type="text/css" />
<!--[if gte IE 6]><link rel="stylesheet" type="text/css" href="css/sap_ie.css" /><![endif]-->
<script type="text/javascript" src="fancybox/jquery-1.9.0.min.js"></script>
<?php include "checkidletime.php";?>
</head>
<body>

<?php
//echo $_SESSION['message'];
	include "libraries/connect.php";
	$sql_trans_perday = "SELECT * FROM log_web WHERE User_Name_Ldap='$_SESSION[user]' AND Logon_Date='$_SESSION[todaydate]' AND Result='Success'";
	$query_trans_perday = mysql_query($sql_trans_perday);
	$trans_perday = mysql_num_rows($query_trans_perday);
	if($trans_perday>2){
		echo "<script>alert('สามารถเข้าใช้งานโปรแกรมได้ 2 ครั้ง/วัน'); window.location.href='libraries/session_system_destroy.php';</script>";
		break;
	}
	else{
?>
<div id="container">
	<div id="header">
     <div class="sap_logo" align="right"><img src="images/cpf_logo.png"  width="51" height="51" /></div>
      <div class="sap_title"><img src="images/title2.png"/></div>
      <div class="unlock_logo"><img src="images/cpfit.png" width="92" height="52" /></div>
     <!--  <div class="cpf_logo"><img src="images/cpf_logo.png" width="51" height="51" /></div> -->
    </div>
    <div class="header_bar"></div>
    <div id="nav"><img src="images/nav4_over.png" width="835" height="46" usemap="#Map" border="0" />
    </div>
    <div class="nav_line">
		<?php if(isset($_SESSION['username'])&&isset($_SESSION['password'])){?>
			<div class="logout"><img src="images/logout.png" width="127" height="30" usemap="#Map2" border="0"></div>
			<map name="Map2" id="Map2">
			  <area shape="rect" coords="5,1,132,28"  href="javascript:window.location.href='libraries/session_destroy.php'" />
			</map>
		<?php } ?>
	</div>
    <div id="inline1">
      <table width="684"border="0" cellspacing="0" cellpadding="0" class="inline1">
          <tr height="35">
            <td width="94"></td>
            <td width="235" class="ldap_name" valign="bottom"><?=$_SESSION['fullname'];?></td>
            <td width="127"></td>
            <td width="228" valign="bottom" class="ldap_name"><?=$_SESSION['user'];?></td>
          </tr>
          <tr height="40">
            <td></td>
            <td class="ldap_name" valign="bottom"><?=$_SESSION['email'];?></td>
            <td></td>
            <td class="ldap_name" valign="bottom"><?=$_SESSION['mobile'];?></td>
          </tr>
        </table>
        <div id="btn">
            <div class="cancel"><a id="other_login"><img src="images/cancel_btn.png" border="0" width="118" height="44" style="cursor:pointer" /></a></div>
            <div class="submit"><a href="step2.php"><img src="images/next_btn.png" width="118" height="44" border="0" style="cursor:pointer"/></a></div>
        </div>
  </div>
  <div id="footer"><div class="copyright">Copyright @ 2015 by CPF</div></div>
</div>
<map name="Map" id="Map">
        <area shape="rect" coords="1,1,189,51" href="index.php" />
        <area shape="rect" coords="208,-1,397,46" href="step2.php" />
        <?
         if($_SESSION['user_purpose'] == 2){
        ?>
        <area shape="rect" coords="420,0,607,46" href="step3.php" />
        <? }
        else {
        ?>
        <area shape="rect" coords="420,0,607,46" href="javascript:void(0)" />
        <? } 
        ?>
        <area shape="rect" coords="632,-4,835,44" href="javascript:void(0)" />
</map>

<? } ?>
</body>
</html>