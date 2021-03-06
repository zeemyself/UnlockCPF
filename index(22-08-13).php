﻿<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?php 
putenv("NLS_LANG=AMERICAN_AMERICA.UTF8");
session_start();
include ("libraries/cfg/cfg.inc.php");
include ("libraries/class/adLDAP.php");

if($_REQUEST['txtUsername'] != ""){			
	try {
		$adldap = new adLDAP();
	}catch (adLDAPException $e) {
		echo $e; exit();   
	}
	$adldap -> connect();
	if($adldap -> authenticate($_REQUEST['txtUsername'],$_REQUEST['txtPassword'])){
		$userinfo = $adldap->user_info($_REQUEST['txtUsername'], array("displayname","description","telephonenumber","givenname","sn","mobile","title","department","company","mail"), $isGUID);
		$_SESSION["login"] = true;
		$_SESSION["needLogin"] = false;
		//echo "<script>alert('test');</script>";
		
		$conn = oci_connect('HRUSER', 'husr#smc79', 'SPSI');
		if($conn){
			//echo "<script>alert('test2');</script>";
		}
		$users = $_REQUEST['txtUsername'];
		$users = strtoupper($users); 
		$strSQL = "SELECT * FROM SMARTCR.VIEW_SR_USER_IHR WHERE  OPERATION_ID LIKE '%".$users."%'";
		
		$stid = oci_parse($conn, $strSQL);
		$st_exe = oci_execute($stid,OCI_DEFAULT);
		$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
	//	echo "<script>alert('$row[OPERATION_ID]');</script>";
		$_SESSION['user'] = $users;
		$_SESSION['username'] = $users;
		$_SESSION['password'] = $_REQUEST['txtPassword'];
		$_SESSION['firstname'] = $row['FIRST_NAME_LOCAL'];
		$_SESSION['lastname'] = $row['LAST_NAME_LOCAL'];
		$_SESSION['fullname'] = $row['FIRST_NAME_LOCAL']." ".$row['LAST_NAME_LOCAL'];
		$_SESSION['department'] = $row['BUSINESS_AREA_DESC'];
		$_SESSION['company'] = $row['COMPANY_DESC'];
		$_SESSION['title'] = $row['POSITION_DESC160'];
		$user_detail = "คุณ".$_SESSION['fullname']." หน่วยงาน ".$_SESSION['department']." ตำแหน่ง ".$_SESSION['title']." บริษัท ".$_SESSION['company'];
		$_SESSION['user_detail'] = $user_detail;
		$loginsucess = true;
		echo "<meta http-equiv=\"refresh\" content=\"0;URL='index.php'\">";
	}else{ 
		//##### Login fail #####
		$loginsucess = false;
		if($adldap -> authenticate($operator_adUser,$operator_adPassword,true)){
			$userinfo = $adldap->user_info($_REQUEST["txtUsername"], array("displayname","useraccountcontrol","lockoutTime"), $isGUID);
				if($userinfo){
					$uac = $userinfo[0]['useraccountcontrol'][0];
					$uac_locktime = $userinfo[0]['lockouttime'][0];
					$loginfail = 2; ##### Case Password,Account lock,Account Disable #####
					if($uac_locktime != 0){
							$failCause = $userAccountLock;
					}else{
						if(isset($userAccountControlAlert[$uac])){
							$failCause = $userAccountControlAlert[$uac];
						}else{
							$failCause = $loginFailAlert[2];
						}
					}
				}else{
					$failCause = $loginFailAlert[3]; ##### Not found domain account
				}		
		}else{
			$failCause = $loginFailAlert[1]; ##### Check : operation user and password 
		}	
		echo "<script>alert('$failCause');window.location='index.php'</script>";			
	}				
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
<script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />

<script language="javascript">
	
    function inputFocus(i){
		if(i.value==i.defaultValue){ 
			i.value="";
			i.style.color="#064d8f"; 
		}
	}
	function inputBlur(i){
		if(i.value==""){
			i.value=i.defaultValue;
			i.style.color="#064d8f";
		}
	}
	function changeBox(){
		document.getElementById('password_field_temp').style.display='none';
		document.getElementById('password_field').style.display='';
		document.getElementById('txtPassword').focus();
	}
	function restoreBox(){
		if(document.getElementById('txtPassword').value==''){
			document.getElementById('password_field_temp').style.display='';
			document.getElementById('password_field').style.display='none';
		}
	}  
	$(document).keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		
		if(keycode == '13'){
			document.getElementById("login_link").click(); 
		}
	});
	$(document).ready(function() {
		$("#other_login").click(function () {
			window.location.href='libraries/session_destroy.php';
		});
		
		$('#login_link').click(function(){
			if (($("#txtUsername").val().length < 1) ||  ($("#txtUsername").val()=="ผู้ใช้งาน iHR/Internet")) {
				$('#trigger_username').fancybox({padding:0, margin:0}).trigger('click');
				return false;
			}
			if (($("#txtPassword").val().length < 1) ||  ($("#txtPassword").val()=="รหัสผ่าน iHR/Internet") ) {
				$('#trigger_password').fancybox({padding:0, margin:0}).trigger('click');
				return false;
			}
			document.formlogin.submit();
		});
	});
	
</script>
	

</head>
<body>
<div id="container">
	<div id="header">
      <div class="sap_logo" align="right"><img src="images/sap_logo.png" width="101" height="51" /></div>
      <div class="sap_title"><img src="images/sap_title.png" width="577" height="36" /></div>
      <div class="unlock_logo"><img src="images/unlock_logo.png" width="37" height="36" /></div>
      <div class="cpf_logo"><img src="images/cpf_logo.png" width="51" height="51" /></div>
     
    </div>
    <div class="header_bar"></div>
    <div id="nav"><img src="images/nav1_over.png" width="835" height="46" usemap="#Map" border="0" />
    </div>
    <div class="nav_line"></div>
    <div id="content1">
    <?php if(!isset($_SESSION['username'])||!isset($_SESSION['password'])){?>
    <form name="formlogin" id="formlogin" method="POST" action="">
		<div class="text_ihr"></div>
   		<div class="login_ldap2">
        	<div class="txt_login">
            	<div class="username_field">
                	<input name="txtUsername" id="txtUsername" type="text"size="50" onfocus="inputFocus(this)" onblur="inputBlur(this)" value=""/>
                </div>
                <div class="password_field_temp" id="password_field_temp">
                	<input name="txtPassword_temp"  class="txtPassword" type="text" size="65" onfocus="changeBox()" value=""/>
                </div>
                <div class="password_field" id="password_field" style="display:none">
                	<input name="txtPassword" id="txtPassword" class="txtPassword"  type="password" size="65" onBlur="restoreBox()"/>
                </div>
            </div>
        	<div class="submit_ldap"><a style="cursor:pointer;" id="login_link"><img src="images/submit.png" width="101" height="38" style="cursor:pointer" border="0" /></a></div>
            
        </div>
     </form>
     <?php }else{
		include "checkidletime.php";
		//echo "<script>alert('a');</script>";
	 ?>
     <div id="inline1">
     	<table width="684"border="0" cellspacing="0" cellpadding="0" class="inline1">
          <tr height="35">
            <td width="94"></td>
            <td width="235" class="ldap_name" valign="bottom"><?php echo $_SESSION['fullname'];?></td>
            <td width="127"></td>
            <td width="228" valign="bottom" class="ldap_name"><?php echo $_SESSION['title'];?></td>
          </tr>
          <tr height="40">
            <td></td>
            <td class="ldap_name" valign="bottom"><?php echo $_SESSION['department'];?></td>
            <td></td>
            <td class="ldap_name" valign="bottom"><?php echo $_SESSION['company'];?></td>
          </tr>
        </table>
        <div id="btn">
            <div class="cancel"><a id="other_login"><img src="images/cancel_btn.png" border="0" width="118" height="44" style="cursor:pointer" /></a></div>
            <div class="submit"><a href="step2.php"><img src="images/next_btn.png" width="118" height="44" border="0" style="cursor:pointer"/></a></div>
        </div>
	</div>
    <?php }?> 
  </div>
  <div id="footer" style="padding-top:100px;"><div class="copyright">Copyright @ 2013 by CPF</div></div>
</div>

<map name="Map" id="Map">
        <area shape="rect" coords="1,1,189,51" href="javascript:void(0)" />
        <area shape="rect" coords="208,-1,397,46" href="javascript:void(0)" />
        <area shape="rect" coords="420,0,607,46" href="javascript:void(0)" />
        <area shape="rect" coords="632,-4,835,44" href="javascript:void(0)" />
</map>
<a class="fancybox" id="trigger_username" href="#inline2"></a>
<a class="fancybox" id="trigger_password" href="#inline3"></a>
<div id="inline2" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณาระบุผู้ใช้งาน iHR/Internet</td>
      </tr>
    </table>
</div>
<div id="inline3" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณาระบุรหัสผ่าน iHR/Internet</td>
      </tr>
    </table>
</div>
</body>

</html>