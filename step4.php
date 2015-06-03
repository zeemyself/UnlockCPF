<? session_start();
//echo $_SESSION[log_id];

//print_r($_SESSION) 
//echo $_SESSION['id_card'];
if(!isset($_SESSION['username'])||!isset($_SESSION['password'])){
echo "<script>window.location='index.php'</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SAP-CPFG Self Unlock/Reset Password</title>
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
      <div class="sap_logo" align="right"><img src="images/sap_logo.png" width="101" height="51" /></div>
      <div class="sap_title"><img src="images/sap_title.png" width="577" height="36" /></div>
      <div class="unlock_logo"><img src="images/unlock_logo.png" width="37" height="36" /></div>
      <div class="cpf_logo"><img src="images/cpf_logo.png" width="51" height="51" /></div>
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
    <div id="content5">
    	<div class="response">
    	  <table style="margin-left:30px;" width="396" border="0" cellspacing="0" cellpadding="0">
    	    <tr>
    	      <td width="396" height="39" valign="bottom" class="result"><? if($_SESSION['msgtype']=='S'&& $_SESSION['user_purpose_ss']=='1'){echo "การขอปลดล็อครหัสผ่านเรียบร้อยแล้ว";}else if($_SESSION['msgtype']=='S'&& $_SESSION['user_purpose_ss']=='2'){echo "การขอรหัสผ่านใหม่เรียบร้อยแล้ว";}else if($_SESSION['msgtype']=='E'){echo "ไม่สามารถตรวจสอบผู้ใช้งานได้"; }?></td>
  	      </tr>
    	    <tr>
    	      <td height="48" valign="bottom" class="result_detail"><?=$_SESSION['message'];?></td>
  	      </tr>
  	    </table>
    	</div>
  	</div>
  <div id="footer"><div class="copyright">Copyright @ 2013 by CPF</div></div>
</div>
<map name="Map" id="Map">
        <area shape="rect" coords="1,1,189,51" href="index.php" />
        <area shape="rect" coords="208,-1,397,46" href="step2.php" />
        <area shape="rect" coords="420,0,607,46" href="step3.php" />
        <area shape="rect" coords="632,-4,835,44" href="javascript:void(0)" />
</map>
<?
include "libraries/connect.php";

if($_SESSION['opsys_client']=='1'){$client = "DV1-200";}
else if($_SESSION['opsys_client']=='2'){$client = "DV1-210";}
else if($_SESSION['opsys_client']=='3'){$client = "DV1-220";}
else if($_SESSION['opsys_client']=='4'){$client = "DV1-230";}
else if($_SESSION['opsys_client']=='5'){$client = "DV1-240";}
else if($_SESSION['opsys_client']=='6'){$client = "QA1-300";}
else if($_SESSION['opsys_client']=='7'){$client = "TR1-800";}
else if($_SESSION['opsys_client']=='8'){$client = "PR1-555";}
else if($_SESSION['opsys_client']=='9'){$client = "PR1-510";}
else if($_SESSION['opsys_client']=='10'){$client = "RPT-555";}
else if($_SESSION['opsys_client']=='11'){$client = "DW1-200";}
else if($_SESSION['opsys_client']=='12'){$client = "QW1-300";}
else if($_SESSION['opsys_client']=='13'){$client = "PW1-555";}

if($_SESSION['usertype']=='1'){$usertype="g";}
else if($_SESSION['usertype']=='2'){$usertype="s";}

if($_SESSION['user_purpose_ss']=='1'){$purpose="u";}
else if($_SESSION['user_purpose_ss']=='2'){$purpose="s";}

if($_SESSION['worktype']=='1'){$opsys="R3";}
else if($_SESSION['worktype']=='2'){$opsys="BW";}
$msgtime = date("Y-m-d H:i:s");

?>
<? } ?>
</body>
</html>