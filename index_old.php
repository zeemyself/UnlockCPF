<?php session_start();
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
		$_SESSION["user"]=$_REQUEST["txtUsername"];
		$_SESSION["displayname"]=$userinfo[0]['displayname'][0];
		$_SESSION['username'] = $_REQUEST['txtUsername'];
		$_SESSION['password'] = $_REQUEST['txtPassword'];
		$_SESSION['fullname'] = $userinfo[0]['description'][0];
		$_SESSION['firstname'] = $userinfo[0]['givenname'][0];
		$_SESSION['lastname'] = $userinfo[0]['sn'][0];
		$_SESSION['telephone'] = $userinfo[0]['telephonenumber'][0];
		$_SESSION['mobile'] = $userinfo[0]['mobile'][0];
		$_SESSION['title'] = $userinfo[0]['title'][0]; //ตำแหน่ง
		$_SESSION['department'] = $userinfo[0]['department'][0];
		$_SESSION['company'] = $userinfo[0]['company'][0];
		$_SESSION['mail'] = $userinfo[0]['mail'][0];
		$loginsucess = true;
		echo "<meta http-equiv=\"refresh\" content=\"0;URL='index.php'\">";
	}else{ 
		//##### Login fail #####
		$loginsucess = false;
		if($adldap -> authenticate($operator_adUser,$operator_adPassword,true)){
			$userinfo = $adldap->user_info($_REQUEST["txtUsername"], array("displayname","useraccountcontrol","lockoutTime"), $isGUID);
				if($userinfo){
					$uac = $userinfo[0]['useraccountcontrol'][0];
					//var_dump($uac);
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
<script language="JavaScript">
	/* $(document).ready(function() {
		  $('#formlogin').submit(function(e) {
			  alert('a');
			e.preventDefault();
			$.ajax({
			   type: "POST",
			   url: 'libraries/example.php',
			   data: $(this).serialize(),
			   success: function(data)
			   {
				  if (data === 'y') {
					document.location.reload();
				  }
				  else {
					alert(data);
				  }
			   }
		   });
		 });
	});*/
</script>
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
			var uname = <?php echo json_encode($_SESSION['username']); ?>;
			var pw = <?php echo json_encode($_SESSION['password']); ?>;
			//alert(uname);
			if(uname==null || pw==null){
				if (($("#txtUsername").val().length < 1) ||  ($("#txtUsername").val()=="ผู้ใช้งาน iHR/Internet")) {
					//alert('Please enter your username.');
					$('#trigger_username').fancybox({padding:0, margin:0}).trigger('click');
					return false;
				}
				if (($("#txtPassword").val().length < 1) ||  ($("#txtPassword").val()=="รหัสผ่าน iHR/Internet") ) {
					$('#trigger_password').fancybox({padding:0, margin:0}).trigger('click');
					return false;
				}
				document.formlogin.submit();
			}else{
				window.location.href="step2.php";
			}
		}
	});
	$(document).ready(function() {
		//$(".fancybox").fancybox({padding:0, margin:0});
		$("#other_login").click(function () {
			window.open('libraries/session_destroy.php');
			window.location.href='index.php';
		});
		
		$('#login_link').click(function(){
			if (($("#txtUsername").val().length < 1) ||  ($("#txtUsername").val()=="ผู้ใช้งาน iHR/Internet")) {
				//alert('Please enter your username.');
				$('#trigger_username').fancybox({padding:0, margin:0}).trigger('click');
				return false;
			}
			if (($("#txtPassword").val().length < 1) ||  ($("#txtPassword").val()=="รหัสผ่าน iHR/Internet") ) {
				$('#trigger_password').fancybox({padding:0, margin:0}).trigger('click');
				return false;
			}
			document.formlogin.submit();
		/* 	$.fancybox.showActivity();
			$.ajax({
				type	: "POST",
				cache	: false,
				url		: "libraries/example.php",
				data	: $(this).serializeArray(),
				success: function(data) {
					alert(data);
					var respond = data;
					if(respond=='y'){
						//go to next step
						window.location.href ='http://www.google.com';
					}
					else{
						//$.fancybox(data);
					}
				}
			});
		
			return false;*/
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
   		<div class="login_ldap">
        	<div class="txt_login">
            	<div class="username_field">
                	<input name="txtUsername" id="txtUsername" type="text"size="65" onfocus="inputFocus(this)" onblur="inputBlur(this)" value="ผู้ใช้งาน iHR/Internet"/>
                </div>
                <div class="password_field_temp" id="password_field_temp">
                	<input name="txtPassword_temp"  class="txtPassword" type="text" size="65" onfocus="changeBox()" value="รหัสผ่าน iHR/Internet"/>
                </div>
                <div class="password_field" id="password_field" style="display:none">
                	<input name="txtPassword" id="txtPassword" class="txtPassword"  type="password" size="65" onBlur="restoreBox()"/>
                </div>
            </div>
        	<div class="submit_ldap"><a style="cursor:pointer;" id="login_link"><img src="images/submit.png" width="101" height="38" style="cursor:pointer" border="0" /></a></div>
            
        </div>
     </form>
     <?php }else{?>
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
  <div id="footer"><div class="copyright">Copyright @ 2013 by CPF</div></div>
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