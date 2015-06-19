<? session_start(); 
//echo  $_SESSION[log_id];?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CPF Self Unlock/Reset Password</title>
<link href="css/sap.css" rel="stylesheet" type="text/css" />
<!--[if gte IE 6]><link rel="stylesheet" type="text/css" href="css/sap_ie.css" /><![endif]-->

<script type="text/javascript" src="fancybox/jquery-1.9.0.min.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.4"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css?v=2.1.4" media="screen" />
<?php include "checkidletime.php";?>
<script language="javascript">
	$(document).ready(function() {
		$("#other_login").click(function () {
			window.location.href='libraries/session_destroy.php';
		});
	});
	$(document).keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		if(keycode == '13'){
			var foo = <?php echo json_encode($_SESSION['usertype']); ?>;
			if(foo=='1')IsEmpty1(); //check empty general user
			else if(foo=='2')IsEmpty2(); //check empty user sap
		}
	});
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
	function IsEmpty1(){ 
		//CHECK EMPTY USERTYPE
		
		var txtUsername_sap = document.formlogin_sap.txtUsername_sap.value;
		
		if (txtUsername_sap=="" ){
			$('#trigger_usersap').fancybox({padding:0, margin:0}).trigger('click');
			return false;
		}
		document.formlogin_sap.submit();
		$("#loader").show();
		return false;
	}
	function IsEmpty2(){ 
		//CHECK EMPTY USERTYPE
		
		var txtUsername_sap2 = document.formlogin_sap2.txtUsername_sap2.value;
		if (txtUsername_sap2==""){
			$('#trigger_usersap').fancybox({padding:0, margin:0}).trigger('click');
			return false;
		}
		
		//CHECK EMPTY OPSYS
		var opsys_client = "";
		var len = document.formlogin_sap2.opsys_client.length;
		
		var i;
		for (i = 0; i < len; i++) {
			if ( document.formlogin_sap2.opsys_client[i].checked ) {
				opsys_client = document.formlogin_sap2.opsys_client[i].value;
				break;
			}
		}
		if (opsys_client==""){
			$('#trigger_client').fancybox({padding:0, margin:0}).trigger('click');
			return false;
		}
		document.formlogin_sap2.submit();
		$("#loader").show();
			return false;
		}
	function next(){
		// Send the email or SMS
		document.repass.submit();
		$("#loader").show();
		return false;
	}
	
</script>
</head>
<body>
<?php
	include "libraries/connect.php";
	include ("libraries/cfg/cfg.inc.php");
	include ("libraries/class/adLDAP.php");
	$sql_trans_perday = "SELECT * FROM log_web WHERE User_Name_Ldap='$_SESSION[user]' AND Logon_Date='$_SESSION[todaydate]' AND Result='Success'";
	//echo $sql_trans_perday;
	$query_trans_perday = mysql_query($sql_trans_perday);
	$trans_perday = mysql_num_rows($query_trans_perday);
	//echo $trans_perday;
	if($trans_perday>=2){
		echo "<script>alert('สามารถเข้าใช้งานโปรแกรมได้ 2 ครั้ง/วัน'); window.location.href='libraries/session_system_destroy.php';</script>";
	}
	else{
		//print_r($_SESSION);
		if(!$_SESSION["login"]){
			echo "<script>window.location='index.php'</script>";
		}
		if(isset($_POST['user_purpose'])){
			// $usertype = $_POST['usertype'];
			$user_purpose = $_POST['user_purpose'];
			// $worktype = $_POST['worktype'];
			// $_SESSION['usertype'] = $usertype;
			// $_SESSION['user_purpose_ss'] = $user_purpose;
			$_SESSION['user_purpose']=$user_purpose;
			if($user_purpose == 1){
				$requirement = "Unlock";
			}
			else{
				$requirement = "Reset";
			}
			// $_SESSION['worktype'] = $worktype;
		//echo $user_purpose;
			// if($usertype=='1'){ $User_Type = "User";}
			// else if($usertype=='2'||$_SESSION['usertype']=='s'){ $User_Type = "SAP Team";}
			// if($user_purpose=='1'){ $Requirement =  "Unlock";}
			// else if($user_purpose=='2'){ $Requirement =  "Reset";}
			// if($worktype=='1'){ $System = "SAP";}
			// else if($worktype=='2'){ $System = "BW";}
			include "libraries/connect.php";
			$sql_log_id = "SELECT * FROM log_web WHERE log_id='$_SESSION[log_id]'";
			//echo $sql_log_id;
			$query_log_id = mysql_query($sql_log_id);
			$row_log_id = mysql_fetch_array($query_log_id);
			echo $_SESSION['log_id'];
			// $Msg_response_fromdb = $row_log_id['Msg_response'];
			//echo $Msg_response_fromdb;
			echo $requirement;
			
				$sql_log = "UPDATE log_web SET Requirement = '$requirement'";
				$query_log = mysql_query($sql_log);
				//$_SESSION['log_id'] = mysql_insert_id();
			
			echo $sql_log;
			//$_SESSION['User_Type'] = $User_Type;
			$_SESSION['requirement'] = $requirement;
			//$_SESSION['System'] = $System;
		}
		//echo "<script type='text/javascript'>alert('$user_purpose');</script>";
		if($user_purpose == 1){
			echo "Are you sure to unlock account " . $_SESSION['user'];
			//echo '<script> window.location="step4.php"; </script>';
			

		}

	// Function Time


	function connectAD(){
			
	try {
		$adldap = new adLDAP();
	}
	catch (adLDAPException $e) {
		echo $e; 
		exit();   
	}
	$adldap -> connect();
	$adldap -> authenticate("wisanu.sys","golf@339");
		
	}
	function unlockAccount(){
		
		//include ("libraries/cfg/cfg.inc.php");
		//include ("libraries/class/adLDAP.php");
			$adldap -> user_enable($_SESSION['user']);
			echo $_SESSION['user'];
		

	}
	function sendMail(){
		
			$to      = $_SESSION['email'];
			$subject = 'Reset your Password';
			$message = 'A request to reset password was received your password is' . $newpw;
			$headers = 'From: adss@cpf.co.th' . "\r\n" .'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);

	}
	function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds'){
		
		$sets = array();
		if(strpos($available_sets, 'l') !== false)
			$sets[] = 'abcdefghjkmnpqrstuvwxyz';
		if(strpos($available_sets, 'u') !== false)
			$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
		if(strpos($available_sets, 'd') !== false)
			$sets[] = '23456789';
		if(strpos($available_sets, 's') !== false)
			$sets[] = '!@#$%&*?';

		$all = '';
		$password = '';
		foreach($sets as $set)
		{
			$password .= $set[array_rand(str_split($set))];
			$all .= $set;
		}

		$all = str_split($all);
		for($i = 0; $i < $length - count($sets); $i++)
			$password .= $all[array_rand($all)];

		$password = str_shuffle($password);

		if(!$add_dashes)
			return $password;

		$dash_len = floor(sqrt($length));
		$dash_str = '';
		while(strlen($password) > $dash_len)
		{
			$dash_str .= substr($password, 0, $dash_len) . '-';
			$password = substr($password, $dash_len);
		}
		$dash_str .= $password;
		return $dash_str;
		
	}
?>
<div id="container">
	<div id="header">
      <div class="sap_logo" align="right"><img src="images/cpf_logo.png"  width="51" height="51" /></div>
      <div class="sap_title"><img src="images/title2.png"/></div>
      <div class="unlock_logo"><img src="images/cpfit.png" width="92" height="52" /></div>
     <!--  <div class="cpf_logo"><img src="images/cpf_logo.png" width="51" height="51" /></div> -->
     
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
	
    <div id =general_user>
      <div class="title">
                    <div style="width:200px;display:inline" class="usertype">โปรดระบุช่องทาง</div>
                   
                    <div style="clear:both"></div>
                </div>
</div>

  
  		<!-- <td class="worksys">Email</td>
  		<td width="104" align="center"><input type="radio" name="opsys_client" id="radio" value="Email" /><?echo $_SESSION['email']?></td>
  		<br>
  		<td class="worksys">SMS</td>
  		<td width="104" align="center"><input type="radio" name="opsys_client" id="radio2" value="SMS" /><?echo $_SESSION['mobile']?></td>
  		<br> -->
  <form name="repass" id="repass" method="POST" action="step4.php">
 <div class="im-centered">
<!-- <div class="container" align ="center"> -->
<div class="row">
    <div class="col-lg-12">
    	
    <div class="input-group">
      <span class="input-group-addon">
        <input type="checkbox" size ="20" aria-label="..." name= "type" checked>By Email</button> 
      </span>
      <input type="text" class="form-control" style="width:200px;" placeholder="<?echo $_SESSION['email']?>" readonly >
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->

  <!-- <br><br> -->
  	<div class="col-lg-12">
    <div class="input-group">
      <span class="input-group-addon">
        <input type="checkbox" size ="20" aria-label="..." name = "type2" checked>By SMS&nbsp</button>
      </span>
      <input type="text" class="form-control" style="width:200px;"  placeholder="<?echo $_SESSION['mobile']?>" readonly>
      	
    </div><!-- /input-group -->
  </div><!-- /.col-lg-6 -->
</div><!-- /.row -->
</div> <!-- Container -->	
  	<!-- </div> -->
</form>
  	<div id="btn3">
                <div class="cancel_sap"><a id="other_login"><img src="images/cancel_btn.png" border="0" width="118" height="44" style="cursor:pointer" /></a></div>
                <div class="submit"><a onclick="javascript:next();"><img src="images/next_btn.png" width="118" height="44" border="0" style="cursor:pointer"/></a></div>
    </div>
  	
   
  
  <div id="footer3"><div class="copyright">Copyright @ 2015 by CPF</div></div>
</div>
<map name="Map" id="Map">
        <area shape="rect" coords="1,1,189,51" href="index.php" />
        <area shape="rect" coords="208,-1,397,46" href="step2.php" />
        <area shape="rect" coords="420,0,607,46" href="javascript:void(0)" />
        <area shape="rect" coords="632,-4,835,44" href="javascript:void(0)" />
      </map>
<a class="fancybox" id="trigger_usersap" href="#inline7"></a>
<a class="fancybox" id="trigger_idcard" href="#inline8"></a>
<a class="fancybox" id="trigger_client" href="#inline9"></a>
<a class="fancybox" id="trigger_usersap12" href="#inline10"></a>
<a class="fancybox" id="trigger_idcard13" href="#inline11"></a>

<div id="inline7" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณาระบุ User Id Sap</td>
      </tr>
    </table>
</div>
<div id="inline8" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณาระบุเลขที่บัตรประชาชน</td>
      </tr>
    </table>
</div>
<div id="inline9" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณาระบุระบบงาน</td>
      </tr>
    </table>
</div>
<div id="inline10" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณากรอก User ID SAP 12 หลัก</td>
      </tr>
    </table>
</div>
<div id="inline11" style="display:none;">
	<table width="379" height="107" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="40" class="alert_error" style="padding-left:30px">กรุณากรอกรหัสบัตรประชาชน 13 หลัก</td>
      </tr>
    </table>
</div>
<?php } ?>

</body>
</html>