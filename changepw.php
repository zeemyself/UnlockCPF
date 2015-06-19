<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<!-- <meta name="viewport" content="width=320" /> -->
<!-- <meta name="viewport" content="width-divce-width, initial-scale=1"> -->
<meta name="viewport" content="user-scalable = yes">
<?php
session_start();
putenv("NLS_LANG=AMERICAN_AMERICA.UTF8");
// ini_set('display_errors', '1');
$_SESSION['user_purpose'] = $_GET['purpose'];
echo $_SESSION['user_purpose'];
include ("libraries/cfg/cfg.inc.php");
include ("libraries/class/adLDAP.php");
include ("libraries/AntiXSS.php");
$data = AntiXSS::setEncoding($data, "UTF-8");

	// try {
 //    $adldap = new adLDAP();
 //  }
 //  catch (adLDAPException $e) {
 //    echo $e; 
 //    exit();   
 //  }
 //  $adldap -> connect();
  	


  // var_dump($adldap -> user_info("wisanu.dis"));

  // $adldap -> authenticate($operator_adUser,$operator_adPassword);

  // $attr=array("samaccountname","mail","memberof","department","displayname","telephonenumber","primarygroupid","objectsid","pager"); 
  // $userinfo = ($adldap -> user_info("wisanu.sys",$attr));
  // $uac = $userinfo[0]['pager'][0];


if($_REQUEST['txtUsername'] != ""){			
	try {
		$adldap = new adLDAP();
	}catch (adLDAPException $e) {
		echo $e;
	    exit();   
	}
	$adldap -> connect();
	if($adldap -> authenticate($_REQUEST['txtUsername'],$_REQUEST['txtPassword'])){
		$userinfo = $adldap->user_info($_REQUEST['txtUsername'], array("displayname","description","telephonenumber","givenname","sn","mobile","title","department","company","mail"), $isGUID);
		$_SESSION["login"] = true;
		$_SESSION["needLogin"] = false;
		//echo "<script>alert('test');</script>";
		
		var_dump($userinfo[0]['displayname'][0]);
		var_dump($userinfo[0]['sn'][1]);
		exit();
		
	

		// var_dump($row);
		// exit();
	//	echo "<script>alert('$row[OPERATION_ID]');</script>";
		$_SESSION['user'] = $users;
		$_SESSION['username'] = $users;
		$_SESSION['password'] = $_REQUEST['txtPassword'];
		$_SESSION['prefix'] = $row['PREFIX_NAME_LOCAL'];
		$_SESSION['firstname'] = $row['FIRST_NAME_LOCAL'];
		$_SESSION['lastname'] = $row['LAST_NAME_LOCAL'];
		$_SESSION['fullname'] = $row['PREFIX_NAME_LOCAL']." ".$row['FIRST_NAME_LOCAL']." ".$row['LAST_NAME_LOCAL'];
		// $_SESSION['department'] = $row['BUSINESS_AREA_DESC'];
		// $_SESSION['company'] = $row['COMPANY_DESC'];
		$_SESSION['birthdate'] = $row['BIRTH_DATE'];
		$_SESSION['mobile'] = $row['MOBILE_NO'];
		$_SESSION['email'] = $row['CPF_INTERNET_EMAIL'];
		$_SESSION['title'] = $row['POSITION_DESC'];
		$_SESSION['id'] = $row['ID_NO'];
		$user_detail = "คุณ".$_SESSION['fullname']." หน่วยงาน ".$_SESSION['department']." ตำแหน่ง ".$_SESSION['title']." บริษัท ".$_SESSION['company'];
		$_SESSION['user_detail'] = $user_detail;
		$loginsucess = true;
		$todaydate = date("Y-m-d");
		$_SESSION['todaydate'] = $todaydate;
		$timenow = date("H:i:s");
		$_SESSION['timenow'] = $timenow;
		// var_dump($_SESSION['id']);
		// exit();
		// if(check($_SESSION['user'],$_SESSION['id'],$_SESSION['birthdate'])){
		// 	$_SESSION["login"] = true;
		// 	$_SESSION["needLogin"] = false;
		// 	// echo "<script>alert('Login successs');window.location='index.php'</script>";
		// }
		// else{
		// 	$loginsucess = false;
		// 	$failCause = $loginFailAlert[1];
		// 	echo "<script>alert('$failCause');window.location='index.php'</script>";
		// 	break;
		// }

		include "libraries/connect.php";
		$sql_trans_perday = "SELECT * FROM log_web WHERE User_Name_Ldap='$users' AND Logon_Date='$todaydate' AND Result='Success'";
		//echo $sql_trans_perday;
		$query_trans_perday = mysql_query($sql_trans_perday);
		$trans_perday = mysql_num_rows($query_trans_perday);
		if($_SESSION['user_purpose'] == 1)
			$requirement = "Reset";
		else
			$requirement = "Unlock";
		//echo $trans_perday;
		if($trans_perday>=2){
			echo "<script>alert('สามารถเข้าใช้งานโปรแกรมได้ 2 ครั้ง/วัน'); window.location.href='libraries/session_system_destroy.php';</script>";
		}else{
			$sql_log = "INSERT INTO log_web(Logon_Date,Logon_Time,User_Name_Ldap,Domain,Requirement) VALUES ('$todaydate','$timenow','$users','cpf.co.th','$requirement')";
			$query_log = mysql_query($sql_log);
			$_SESSION['log_id'] = mysql_insert_id();
			// echo $_SESSION['log_id'];
			// echo "<meta http-equiv=\"refresh\" content=\"0;URL='index.php'\">";
		}
	}	
	else{ 
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
		echo "<script>alert('$failCause');window.location='changepw.php'</script>";			
	}				
}

function check($id,$card,$day,$u,$p){

	
	 try {
    $adldap = new adLDAP();
  }
  catch (adLDAPException $e) {
    echo $e; 
    exit();   
  }
  //Connect AD
  $adldap -> connect();
  $adldap -> authenticate($u,$p);
  $attr=array("displayname","pager"); 
  $userinfo = ($adldap -> user_info($id,$attr));
  $uac = $userinfo[0]['pager'][0];
   // //End
  if($uac != $card)  return false;
  // //Connect DB
  // var_dump($day);
  $conn = oci_connect('VOXTRONS', 'ksdew#kdlo13', 'SPSI');
  $strSQL = "SELECT * FROM SMARTCR.VIEW_SR_USER WHERE  ID_NO = '$uac'";
  $stid = oci_parse($conn, $strSQL);
  $st_exe = oci_execute($stid,OCI_DEFAULT);
  $row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
  // //End
  // var_dump($row['BIRTH_DATE']);
  // exit();
  if($day != $row['BIRTH_DATE']) return false;
  return true;
}







?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<!-- Date Picker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.11.3.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.2.1/jquery.form-validator.min.js"></script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker({
    	dateFormat: "dd/mm/yy",
    	yearRange: "1950:2015",
    	changeYear:true,
    	//appendText: "(yyyy-mm-dd)"
    	
    });
  });
  var yearRange = $( ".selector" ).datepicker( "option", "yearRange" );
  var changeYear = $( ".selector" ).datepicker( "option", "changeYear" );
  var altFormat = $( "#datepicker" ).datepicker( "option", "altFormat" );
 // var appendText = $( ".selector" ).datepicker( "option", "appendText" );
 // var yearRange = $( ".selector" ).datepicker( "option", "yearRange" );
</script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CPF Self Unlock/Reset Password</title>
<link href="css/sap.css" rel="stylesheet" type="text/css" />
<!--[if gte IE 6]><link rel="stylesheet" type="text/css" href="css/sap_ie.css" /><![endif]-->
<!-- <script type="text/javascript" src="fancybox/jquery-1.9.0.min.js"></script> -->
<script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />
<script type="text/javascript">
function letternumber(e)
{
var key;
var keychar;

if (window.event)
   key = window.event.keyCode;
else if (e)
   key = e.which;
else
   return true;
keychar = String.fromCharCode(key);
keychar = keychar.toLowerCase();

// control keys
if ((key==null) || (key==0) || (key==8) || 
    (key==9) || (key==13) || (key==27) )
   return true;

// alphas and numbers
else if ((("abcdefghijklmnopqrstuvwxyz-.").indexOf(keychar) > -1))
   return true;
else
   return false;
}
function letternumber2(e)
{
var key;
var keychar;

if (window.event)
   key = window.event.keyCode;
else if (e)
   key = e.which;
else
   return true;
keychar = String.fromCharCode(key);
keychar = keychar.toLowerCase();

// control keys
if ((key==null) || (key==0) || (key==8) || 
    (key==9) || (key==13) || (key==27) )
   return true;

// alphas and numbers
else if ((("1234567890").indexOf(keychar) > -1))
   return true;
else
   return false;
}
</script>
 

	





<script language="javascript">
	//Font color
    function inputFocus(i){
		if(i.value==i.defaultValue){ 
			i.value="";
			i.style.color="#6b6b6b"; 
		}
	}
	//Cursor color
	function inputBlur(i){
		if(i.value==""){
			i.value=i.defaultValue;
			i.style.color="#6b6b6b";
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
			
			 //alert(!preg_match('/[^A-Za-z0-9]/', $("#txtUsername").val() ))
			 	
			 	// alert($("#txtUsername").val() + "DONE");
			if (($("#txtUsername").val().length < 1) ||  ($("#txtUsername").val()=="ผู้ใช้งาน iHR/Internet") ) {
				$('#trigger_username').fancybox({padding:0, margin:0}).trigger('click');
				return false;
			}
			if (($("#txtPassword").val().length <1) ||  ($("#txtPassword").val()=="รหัสผ่าน iHR/Internet") ) {
				$('#trigger_password').fancybox({padding:0, margin:0}).trigger('click');
				return false;
			}
			
			
			var capt = document.getElementById('capt').value;
			if(capt==""){
				$('#trigger_captcha_empty').fancybox({padding:0, margin:0}).trigger('click');
				return false;
			}
			
			$.ajax({
				type: "POST",
				url:"sample/check.php",
				data:'capt='+capt,
				success:function(respond){
					if(respond=='n'){
						$('#trigger_captcha').fancybox({padding:0, margin:0}).trigger('click');
						return false;
					}else{
						document.formlogin.submit();
						$("#loader").show();
					}
				}
			});
			
		});
	});

</script>
	

</head>
<body>
<div id="container">
	<div id="header">
      <div class="sap_logo" align="right"><img src="images/cpf_logo.png"  width="51" height="51" /></div>
      <div class="sap_title"><a href="libraries/session_system_destroy.php"><img src="images/title2.png"/></a></div>
      <div class="unlock_logo"><img src="images/cpfit.png" width="92" height="52" /></div>
     <!--  <div class="cpf_logo"><img src="images/cpf_logo.png" width="51" height="51" /></div> -->
     
    </div>
    <div class="header_bar"></div>
    <? if($_REQUEST['txtUsername'] != ""){ ?>
    <div id="nav"><img src="images/nav2_over.png" width="835" height="46" usemap="#Map" border="0" />
    <? }else{ ?>
    <div id="nav"><img src="images/nav1_over.png" width="835" height="46" usemap="#Map" border="0" />
    <? } ?>
	<div id="loader" style="display:none;position:relative; padding-left:850px; margin-top:-40px"><img src="images/preloader.gif" width="35" height="35" border="0"></div>
    </div>
    <div class="nav_line">
		<?php if(isset($_SESSION['username'])&&isset($_SESSION['password'])){?>
			<div class="logout"><img src="images/logout.png" width="127" height="30" usemap="#Map2" border="0"></div>
			<map name="Map2" id="Map2">
			  <area shape="rect" coords="5,1,132,28" href="javascript:window.location.href='libraries/session_destroy.php'" />
			</map>
		<?php } ?>
	</div>
    <div id="content1">
    <?php if(!isset($_SESSION['username'])||!isset($_SESSION['password'])){?>
    <form name="formlogin" id="formlogin" method="POST" action="">
		<!-- <div class="txt_login2"></div> -->
   		<div class="fgtpw_box">
        	<div class="txt_login">
            	<div class="username_field">
                	<input name="txtUsername" id="txtUsername" type="text"size="50" pattern="[a-zA-Z]" onKeyPress="return letternumber(event)" onfocus="inputFocus(this)" onblur="inputBlur(this)" value="" required="required" maxlength="20"/>
                </div>
                <!-- Card ID  -->
                <div class="password_field_temp" id="password_field_temp">
                	<input name="txtPassword" id="txtPassword" class="txtPassword" type="password"  size="65" onfocus="inputFocus(this)" onblur="inputBlur(this)" value=""/>
                </div>
               <!--  <div class="password_field" id="password_field" style="display:none">
                	<input name="txtPassword" id="txtPassword" class="txtPassword"  type="password" size="65" onBlur="restoreBox()"/>
                 -->
               <!--  <div class="birthdate_field">
                	<input name="txtBirthDate" id="txtBirthDate" type="text"size="50" onfocus="inputFocus(this)" onblur="inputBlur(this)" value=""/>
                </div> -->
                

            </div>

         </div>
			 <div class="capt_chaa">
				<div style="position:absolute; margin-top:-78px; margin-left:460px"><img src="captcha/captcha_img.php"></div>
				<div class="capt_txt"; style="margin-top:-61px;margin-left:580px"><input  type="text" name="capt" id="capt" class="capt"></div>
			 </div>
        	<div class="submit_ldap"><a style="cursor:pointer;" id="login_link"><img src="images/next_btn.png" width="101" height="38" style="cursor:pointer" border="0" /></a></div>
           
        </div>

     </form>
     <script>
     	$.validate({
     	
		form : '#formlogin',
    	//modules : 'security',
    	onError : function() {
     		 alert('The form is valid');
      	//return false;
    	}
	});

     </script>
     <? 
 	}else{
		include "checkidletime.php";
		//echo "<script>alert('a');</script>";
	 ?>
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
    <? 
	}
    ?> 
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
<a class="fancybox" id="trigger_birthdate" href="#inline12"></a>
<a class="fancybox" id="trigger_captcha" href="#inline4"></a>
<a class="fancybox" id="trigger_captcha_empty" href="#inline5"></a>
<div id="inline2" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณาระบุไอดี</td>
      </tr>
    </table>
</div>
<div id="inline3" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณาระบุเลขบัตรประจำตัวประชาชนให้ถูกต้อง</td>
      </tr>
    </table>
</div>
<div id="inline4" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณากรอกรหัส 5 หลักให้ตรงกับรูปภาพ</td>
      </tr>
    </table>
</div>
<div id="inline5" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณากรอกรหัส 5 หลักที่ท่านเห็น</td>
      </tr>
    </table>
</div>
<div id="inline12" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณาระบุวัดเกิด</td>
      </tr>
    </table>
</div>
</body>

</html>