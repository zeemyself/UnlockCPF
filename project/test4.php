<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<?php
session_start();
putenv("NLS_LANG=AMERICAN_AMERICA.UTF8");
// ini_set('display_errors', '1');

//echo $_SESSION[log_id];
include ("libraries/cfg/cfg.inc.php");
include ("libraries/class/adLDAP.php");
include ("libraries/AntiXSS.php");
$data = AntiXSS::setEncoding($data, "UTF-8");




/*if($_REQUEST['txtUsername'] != ""){			
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
		*/
	if($_REQUEST['txtUsername'] != ""){
		$conn = oci_connect('VOXTRONS', 'ksdew#kdlo13', 'SPSI');
		
		 //var_dump($_POST);
		$users = $_REQUEST['txtUsername'];
		$idnum = $_REQUEST['txtPassword'];
		$datepick = $_REQUEST['txtBirthDate'];
		$date = str_replace("/","-","$datepick");
		$users = strtoupper($users); 
		
		$strSQL = "SELECT * FROM SMARTCR.VIEW_SR_USER WHERE  USER_ID = '$users' and ID_NO = $idnum and BIRTH_DATE = '$date'";
		//  echo $strSQL."<br>";
		//  var_dump()
		//  echo $users;
		//  echo $idnum;
		// var_dump($date);
		//exit();
		$stid = oci_parse($conn, $strSQL);
		$st_exe = oci_execute($stid,OCI_DEFAULT);
		$num_row = oci_num_rows($stid);
		// var_dump($num_row);
		// exit();
		$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
		// var_dump($row);
		// exit();
		if($row['LAST_NAME_LOCAL'] != null){
			$_SESSION["login"] = true;
		 	$_SESSION["needLogin"] = false;
		}
		else{
			$loginsucess = false;
			$failCause = $loginFailAlert[3];
			echo "<script>alert('$failCause');window.location='index2.html'</script>";
			break;
		}
		//exit();
		//exit();
		//$datepick = $_REQUEST['datepicker'];
		//$date = str_replace("/","-","$datepick");
		//echo "<script> alert($date);</script>";
		// if($conn){
		// 	if(strtoupper($users) == $row['USER_ID'] && $_REQUEST['txtPassword'] == $row['ID_NO'] && $_REQUEST['datepicker'] == $row['BIRTH_DATE']){
		// 	$_SESSION["login"] = true;
		// 	$_SESSION["needLogin"] = false;
		// 	echo "YEs";
		// 	}
		// 	else
		// 		$loginsucess = false;
		// }

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
		//echo $trans_perday;
		if($trans_perday>=2){
			echo "<script>alert('สามารถเข้าใช้งานโปรแกรมได้ 2 ครั้ง/วัน'); window.location.href='libraries/session_system_destroy.php';</script>";
		}else{
			$sql_log = "INSERT INTO log_web(Logon_Date,Logon_Time,User_Name_Ldap) VALUES ('$todaydate','$timenow','$users')";
			$query_log = mysql_query($sql_log);
			$_SESSION['log_id'] = mysql_insert_id();
			echo "<meta http-equiv=\"refresh\" content=\"0;URL='index.php'\">";
		}
	}	
	/*}else{ 
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
}*/

function check($id,$card,$day){
	$d = $_REQUEST['datepicker'];
	$id = strtolower($id); 
	if($id != $_REQUEST['txtUsername'])
		return false;
	if($card != $_REQUEST['txtPassword'])
		return false;
	if($day != str_replace("/", "-", $d))
		return false;
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
    	yearRange: "1950:2015",
    	changeYear:true
    });
  });
  var yearRange = $( ".selector" ).datepicker( "option", "yearRange" );
  var changeYear = $( ".selector" ).datepicker( "option", "changeYear" );
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
else if ((("abcdefghijklmnopqrstuvwxyz.").indexOf(keychar) > -1))
   return true;
else
   return false;
}
</script>

<link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui.css" />
			  <link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui-timepicker-addon.css" />
	    	  <link rel="stylesheet" href="css/jqeury.mobile.theme.min.css" />
		      <link rel="stylesheet" href="css/jquery.mobile.icons.min.css" />
		      <link rel="stylesheet" href="css/jquery.mobile.min.css" />
		      <link rel="stylesheet" href="css/owl.carousel.css">
		      <link rel="stylesheet" href="css/owl.theme.css">
		      <link rel="stylesheet" href="css/nightly.css" />
		      <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic,600italic,700italic|Oswald:400,700' rel='stylesheet' type='text/css'>
		      <link rel="stylesheet" href="css/font-awesome.min.css">
		      <script src="js/jquery.min.js"></script>
		      <script src="js/jquery.mobile.min.js"></script>
		      <script src="js/owl.carousel.min.js"></script>
		      <script src="js/nightly.js"></script>
		      <script type="text/javascript" src="js/jquery-1.10.2.min.js"> </script>
			  <script type="text/javascript" src="js/jquery-ui.min.js"> </script>
	     	  <script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
		  	  <script type="text/javascript" src="js/jquery-ui-sliderAccess.js"></script>
 

	





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
			if (($("#datepicker").val().length < 1) ||  ($("#datepicker").val()=="รหัสผ่าน iHR/Internet") ) {
				$('#trigger_birthdate').fancybox({padding:0, margin:0}).trigger('click');
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
<div data-role="page" data-theme='a'>
	
   
     <div data-role="content"  >   
      <div data-role="header" data-tap-toggle="false" data-theme='a'>    
	            <h3 class="header-title"> <img src="image/logo.jpg" alt="CPF" style="width:40px;height:40px;" align="bottom">
		 		Manage ADSelfService </h3>   </div>
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
    <form name="formlogin" id="formlogin" method="POST" action="test2.php">
		<div class="txt_login2"></div>
   		<div class="fgt_box">
        	<div class="txt_login">
            	<div class="username_field">
                	<input name="txtUsername" id="txtUsername" type="text"size="50" pattern="[a-zA-Z]" onKeyPress="return letternumber(event)" onfocus="inputFocus(this)" onblur="inputBlur(this)" value="" required="required" maxlength="20"/>
                </div>
                <!-- Card ID  -->
                <div class="password_field_temp" id="password_field_temp">
                	<input name="txtPassword" id="txtPassword" class="txtPassword" type="text" pattern="[0-9]*" size="65" onfocus="inputFocus(this)" onblur="inputBlur(this)" value=""/>
                </div>
               <!--  <div class="password_field" id="password_field" style="display:none">
                	<input name="txtPassword" id="txtPassword" class="txtPassword"  type="password" size="65" onBlur="restoreBox()"/>
                 -->
               <!--  <div class="birthdate_field">
                	<input name="txtBirthDate" id="txtBirthDate" type="text"size="50" onfocus="inputFocus(this)" onblur="inputBlur(this)" value=""/>
                </div> -->
                <div class="birthdate_field">
              <input name="txtBirthDate" type="text" id="datepicker">
                </div>
 


            </div>

            </div>
			 <div class="capt_chaa">
				<div style="position:absolute; margin-top:-25px; margin-left:460px"><img src="captcha/captcha_img.php"></div>
				<div class="capt_txt"><input  type="text" name="capt" id="capt" class="capt"></div>
			 </div>
        	<div class="submit_ldap"><a style="cursor:pointer;" id="login_link"><img src="images/submit.png" width="101" height="38" style="cursor:pointer" border="0" /></a></div>
           
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
            <td width="228" valign="bottom" class="ldap_name"><?=$_SESSION['title'];?></td>
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
        <td height="40" class="alert_error" style="padding-left:30px">กรุณาระบุผู้ใช้งาน iHR/Internet</td>
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