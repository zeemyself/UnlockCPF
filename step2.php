<? session_start();
//echo $_SESSION[log_id];

//print_r($_SESSION)
if(!$_SESSION["login"]){
echo "<script>window.location='index.php'</script>";
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
<script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />
<? include "checkidletime.php";?>
<script language="javascript">
	$(document).ready(function() {
		$("#other_login").click(function () {
			window.location.href='libraries/session_destroy.php';
		});
	});
	$(document).keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			IsEmpty();
		}
		//alert("555");
	});
	function IsEmpty(){ 
		//CHECK EMPTY USERTYPE
		/*var usertype = "";
		var len = document.step2.usertype.length;
		var i;
		for (i = 0; i < len; i++) {
			if ( document.step2.usertype[i].checked ) {
				usertype = document.step2.usertype[i].value;
				break;
			}
		}
		// if (usertype==""){
		// 	$('#trigger_usertype').fancybox({padding:0, margin:0}).trigger('click');
		// 	//alert('กรุณาเลือกประเภทผู้ใ้ช้งาน');
		// 	return false;
		// }
		//CHECK EMPTY USER PURPOSE
		var user_purpose = "";
		var len2 = document.step2.user_purpose.length;
		var j;
		for (j = 0; j < len2; j++) {
			if ( document.step2.user_purpose[j].checked ) {
				user_purpose = document.step2.user_purpose[j].value;
				break;
			}
		}
		if (user_purpose==""){
			$('#trigger_purpose').fancybox({padding:0, margin:0}).trigger('click');
			//alert('กรุณาระบุความต้องการ');
			return false;
		}
		//CHECK EMPTY WORKTYPE
		var worktype = "";
		var len3 = document.step2.worktype.length;
		var k;
		for (k = 0; k < len3; k++) {
			if ( document.step2.worktype[k].checked ) {
				worktype = document.step2.worktype[k].value;
				break;
			}
		}
		// if (worktype==""){
		// 	$('#trigger_worktype').fancybox({padding:0, margin:0}).trigger('click');
		// 	//alert('กรุณาระบุระบบงาน');
		// 	return false;
		// }
		*/
		var user_purpose="";
		
		for(i=0 ;i<2 ; i++){
			if(document.step2.user_purpose[i].checked){
				user_purpose=i;
				break;
			}
		}
		if(user_purpose ===""){
			$('#trigger_worktype').fancybox({padding:0, margin:0}).trigger('click');
			alert('กรุณาระบุความต้องการ');
			return false;
		}
		<?$_SESSION["type"] = user_purpose;?>
		document.step2.submit();
		$("#loader").show();
	}
</script>

</head>
<body>
<?php
	include "libraries/connect.php";

	$sql_trans_perday = "SELECT * FROM log_web WHERE User_Name_Ldap='$_SESSION[user]' AND Logon_Date='$_SESSION[todaydate]' AND Result='Success'";
	$query_trans_perday = mysql_query($sql_trans_perday);
	$trans_perday = mysql_num_rows($query_trans_perday);
	//echo $trans_perday;
	if($trans_perday>=2){
		echo "<script>alert('สามารถเข้าใช้งานโปรแกรมได้ 2 ครั้ง/วัน'); window.location.href='libraries/session_system_destroy.php';</script>";
	}
	else{
		echo $_SESSION['log_id'];
?>
<div id="container">
	<div id="header">
      <div class="sap_logo" align="right"><img src="images/cpf_logo.png"  width="51" height="51" /></div>
      <div class="sap_title"><a href="libraries/session_system_destroy.php"><img src="images/title2.png"/></a></div>
      <div class="unlock_logo"><img src="images/cpfit.png" width="92" height="52" /></div>
      <!-- <div class="cpf_logo"><img src="images/cpf_logo.png" width="51" height="51" /></div> -->
     
    </div>
    <div class="header_bar"></div>
    <div id="nav"><img src="images/nav3_over.png" width="835" height="46" usemap="#Map" border="0" />
	<div id="loader" style="display:none;position:relative; padding-left:850px; margin-top:-40px"><img src="images/preloader.gif" width="35" height="35" border="0"></div>
    </div>
    <div class="nav_line">
		<?php if(isset($_SESSION['username'])&&isset($_SESSION['password'])){?>
			<div class="logout"><img src="images/logout.png" width="127" height="30" usemap="#Map2" border="0"></div>
			<map name="Map2" id="Map2">
			  <area shape="rect" coords="5,1,132,28"  href="javascript:window.location.href='libraries/session_destroy.php'" />
			</map>
		<?php } ?>
	</div>
	
    <div id="content2">
    <form name="step2" action="step3.php" method="post">
    	<table width="550" border="0" cellspacing="0" cellpadding="0" align="center">
        <!--   <tr>
          	<td width="17" height="80"></td>
            <td width="193" class="usertype">เลือกประเภทผู้ใช้งาน</td>
            <td width="25"><input name="usertype"  type="radio" value="1" <? if($_SESSION['usertype']=='1'||$_SESSION['usertype']=='g'){echo "checked";} ?> /></td>
            <td width="157" class="usertype2">ผู้ใช้งานทั่วไป</td>
            <td width="27"><input name="usertype" type="radio" value="2" <? if($_SESSION['usertype']=='2'||$_SESSION['usertype']=='s'){echo "checked";} ?>/></td>
            <td width="131" class="usertype2">ทีมงาน SAP</td>
          </tr>
          <tr>
            <td colspan="6" height="4" style="background-image:url(images/line.png); background-repeat:no-repeat"></td>
           </tr>-->
          <tr>
          	<td height="80">&nbsp;</td>
          	<?if($_SESSION['user_purpose'] == 2){
          	?>
            <td class="usertype">Are you sure want to unlock this account (<?=$_SESSION['user']?>)</td>
            <?
        	}
        	else{
        	?>
        	<td class="usertype">New password for <?=$_SESSION['user']?> will send to <?=$_SESSION['mobile']?> and <?=$_SESSION['email']?></td>
        	<? } ?>
           <!--  <td><input name="user_purpose"  type="radio" value="1" <? if($_SESSION['user_purpose_ss']=='1'){echo "checked";} ?> /></td>
            <td  class="usertype2">ขอปลดล็อครหัสผ่าน</td>
            <td><input name="user_purpose" type="radio" value="2" <? if($_SESSION['user_purpose_ss']=='2'){echo "checked";} ?>/></td>
            <td  class="usertype2">ขอรหัสผ่านใหม่</td> -->
          </tr>
         
        </table>
    </form>
    	<div id="btn2">
            <div class="cancel"><a id="other_login"><img src="images/cancel_btn.png" border="0" width="118" height="44" style="cursor:pointer" /></a></div>
            <div class="submit"><a href="step4.php"><img src="images/next_btn.png" width="118" height="44" border="0" style="cursor:pointer" /></a></div>
        </div>
  	</div>
  <div id="footer"><div class="copyright">Copyright @ 2015 by CPF</div></div>
</div>
<map name="Map" id="Map">
        <area shape="rect" coords="1,1,189,51" href="index.php" />
        <area shape="rect" coords="208,-1,397,46" href="javascript:void(0)" />
        <area shape="rect" coords="420,0,607,46" href="javascript:void(0)" />
        <area shape="rect" coords="632,-4,835,44" href="javascript:void(0)" />
      </map>
<!-- <a class="fancybox" id="trigger_usertype" href="#inline4"></a> -->
<a class="fancybox" id="trigger_purpose" href="#inline5"></a>
<!-- <a class="fancybox" id="trigger_worktype" href="#inline6"></a> -->
<div id="inline4" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณาเลือกประเภทผู้ใช้งาน</td>
      </tr>
    </table>
</div>
<div id="inline5" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณาระบุความต้องการ</td>
      </tr>
    </table>
</div>
<div id="inline6" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณาระบุระบบงาน</td>
      </tr>
    </table>
</div>
<?php } ?>
</body>
</html>