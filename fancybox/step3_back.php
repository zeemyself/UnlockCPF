<? session_start(); 
//echo  $_SESSION[log_id];?>

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
</script>
</head>
<body>
<?php
	include "libraries/connect.php";
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
		if(!isset($_SESSION['username'])||!isset($_SESSION['password'])){
			echo "<script>window.location='index.php'</script>";
		}
		if(isset($_POST['user_purpose'])){
			// $usertype = $_POST['usertype'];
			$user_purpose = $_POST['user_purpose'];
			// $worktype = $_POST['worktype'];
			// $_SESSION['usertype'] = $usertype;
			// $_SESSION['user_purpose_ss'] = $user_purpose;
			$_SESSION['user_purpose']=$user_purpose;
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
			$Msg_response_fromdb = $row_log_id['Msg_response'];
			//echo $Msg_response_fromdb;
			if($Msg_response_fromdb==""){
				$sql_log = "UPDATE log_web SET User_Type='$User_Type', Requirement='$Requirement',System='$System'  WHERE log_id = '$_SESSION[log_id]'";
				$query_log = mysql_query($sql_log);
			}else{
				$sql_log = "INSERT INTO log_web(Logon_Date,Logon_Time,User_Name_Ldap,User_Type,Requirement,System) 
							VALUES('$_SESSION[todaydate]','$_SESSION[timenow]','$_SESSION[username]','$User_Type','$Requirement','$System')";
				$query_log = mysql_query($sql_log);
				$_SESSION['log_id'] = mysql_insert_id();
			}
			//echo $sql_log;
			$_SESSION['User_Type'] = $User_Type;
			$_SESSION['Requirement'] = $Requirement;
			$_SESSION['System'] = $System;
		}
?>
<div id="container">
	<div id="header">
      <div class="sap_logo" align="right"><img src="images/sap_logo.png" width="101" height="51" /></div>
      <div class="sap_title"><img src="images/sap_title.png" width="577" height="36" /></div>
      <div class="unlock_logo"><img src="images/unlock_logo.png" width="37" height="36" /></div>
      <div class="cpf_logo"><img src="images/cpf_logo.png" width="51" height="51" /></div>
     
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
	
    <? 
	if($_SESSION['usertype']=='1'||$_SESSION['usertype']=='g'){?>
       <div id="content3">
            <div id="general_user">
                <div class="title">
                    <div style="width:200px;display:inline" class="usertype">ผู้ใช้งานทั่วไป :</div>
                    <div style="width:300px;display:inline" class="usertype2">ระบุข้อมูล User ID SAP</div>
                    <div style="clear:both"></div>
                </div>
            <form name="formlogin_sap" id="formlogin_sap" method="POST" action="sap.php">
				<input type="hidden" name="log_id_hidden" id="log_id_hidden" value="<?php echo $_SESSION['log_id'];?>">
                <div class="login_sap">
                    <div class="txt_login">
                        <div class="username_field">
                            <input name="txtUsername_sap" id="txtUsername_sap" type="text"size="100" onfocus="inputFocus(this)" onblur="inputBlur(this)" value=""/>
                        </div>
                    </div>
                </div>
             </form>
             </div> 
             <div id="btn3">
                <div class="cancel_sap"><a id="other_login"><img src="images/cancel_btn.png" border="0" width="118" height="44" style="cursor:pointer" /></a></div>
                <div class="submit"><a onclick="javascript:IsEmpty1();"><img src="images/next_btn.png" width="118" height="44" border="0" style="cursor:pointer"/></a></div>
            </div>
        </div><!-- END div content3-->
    <? }else{ ?>
    <div id="content4">
         <div  class="sap_user">
         	<form name="formlogin_sap2" id="formlogin_sap2" method="POST" action="sap.php">
			<input type="hidden" name="log_id_hidden" id="log_id_hidden" value="<?php echo $_SESSION['log_id'];?>">
            <div class="login_sap2">
            	<div class="title2">
                    <div style="width:100px;display:inline;padding-left:20px;" class="usertype">ทีมงาน SAP :</div>
                    <div style="width:100px;display:inline" class="usertype2">ระบุข้อมูล User ID SAP</div>
                    <div style="clear:both"></div>
            	</div>
                <div class="login2">
                	<div class="txt_login">
                        <div class="username_field2">
                            <input name="txtUsername_sap2" id="txtUsername_sap2" type="text"size="100" onfocus="inputFocus(this)" onblur="inputBlur(this)" value=""/>
                        </div>
                        <!-- <div class="password_field_temp2" >
                            <input name="txtPassword_temp_sap2"  class="txtPassword2" type="text" size="65" onfocus="inputFocus(this)"  onblur="inputBlur(this)"  value="เลขที่บัตรประชาชน" id="txtPassword_temp_sap2"/>
                        </div> -->
                	</div>
                </div>
            </div>
            <div class="worktype2">
            	<div class="title2">
                    <div style="width:100px;display:inline" class="usertype">ระบุระบบงาน :</div>
                    <div class="usertype2" style="width:100px;display:inline;color:#0581fe" ><? if($_SESSION['worktype']=='1'){echo "ECC6-THA-LANDSCAPE";}else{echo "BW-THA-LANSCAPE";}?></div>
                    <div style="clear:both"></div>
                </div>
                <div class="table">
                	<table width="350" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="104"></td>
                        <td width="22"></td>
                        <td width="106" class="worksys2">System</td>
                        <td width="118" class="worksys2">Client</td>
                      </tr>
                      <? if($_SESSION['worktype']=='1'){?>
                      <tr><td colspan="4" height="4" align="center"><img src="images/short_line.png"></td></tr>
                      <tr>
                        <td width="104" align="right"><input type="radio" name="opsys_client" id="radio" value="1" /></td>
                        <td></td>
                        <td class="worksys">DV6</td>
                        <td class="worksys">200</td>
                      </tr>
                      <tr><td colspan="4" height="4" align="center"><img src="images/short_line.png"></td></tr>
                      <tr>
                        <td width="104" align="right"><input type="radio" name="opsys_client" id="radio3" value="2" /></td>
                        <td></td>
                        <td class="worksys">DV6</td>
                        <td class="worksys">210</td>
                      </tr>
                      <tr><td colspan="4" height="4" align="center"><img src="images/short_line.png"></td></tr>
                      <tr>
                        <td width="104" align="right"><input type="radio" name="opsys_client" id="radio4" value="3" /></td>
                        <td></td>
                        <td class="worksys">DV6</td>
                        <td class="worksys">220</td>
                      </tr>
                      <tr><td colspan="4" height="4" align="center"><img src="images/short_line.png"></td></tr>
                      <tr>
                        <td width="104" align="right"><input type="radio" name="opsys_client" id="radio7" value="6" /></td>
                        <td></td>
                        <td class="worksys">QA6</td>
                        <td class="worksys">300</td>
                      </tr>
                      <tr><td colspan="4" height="4" align="center"><img src="images/short_line.png"></td></tr>
                     <!-- <tr>
                        <td width="104" align="right"><input type="radio" name="opsys_client" id="radio8" value="7" /></td>
                        <td></td>
                        <td class="worksys">QA6</td>
                        <td class="worksys">310</td>
                      </tr>
                      <tr><td colspan="4" height="4" align="center"><img src="images/short_line.png"></td></tr>
					  -->
                      <tr>
                        <td width="104" align="right"><input type="radio" name="opsys_client" id="radio9" value="8" /></td>
                        <td></td>
                        <td class="worksys">PR6</td>
                        <td class="worksys">888</td>
                      </tr>
                      <tr><td colspan="4" height="4" align="center"><img src="images/short_line.png"></td></tr>
                      <tr>
                        <td width="104" align="right"><input type="radio" name="opsys_client" id="radio10" value="9" /></td>
                        <td></td>
                        <td class="worksys">PR6</td>
                        <td class="worksys">889</td>
                      </tr>
                      <tr><td colspan="4" height="4" align="center"><img src="images/short_line.png"></td></tr>
                      <tr>
                        <td width="104" align="right"><input type="radio" name="opsys_client" id="radio11" value="10" /></td>
                        <td></td>
                        <td class="worksys">RPT</td>
                        <td class="worksys">555</td>
                      </tr>
                      <? }else if($_SESSION['worktype']=='2'){?>
                      <tr><td colspan="4" height="4" align="center"><img src="images/short_line.png"></td></tr>
                      <tr>
                        <td width="104" align="right"><input type="radio" name="opsys_client" id="radio11" value="11" /></td>
                        <td></td>
                        <td class="worksys">DW1</td>
                        <td class="worksys">200</td>
                      </tr>
                      <tr><td colspan="4" height="4" align="center"><img src="images/short_line.png"></td></tr>
                      <tr>
                        <td width="104" align="right"><input type="radio" name="opsys_client" id="radio11" value="12" /></td>
                        <td></td>
                        <td class="worksys">QW1</td>
                        <td class="worksys">300</td>
                      </tr>
                      <tr><td colspan="4" height="4" align="center"><img src="images/short_line.png"></td></tr>
                      <tr>
                        <td width="104" align="right"><input type="radio" name="opsys_client" id="radio11" value="13" /></td>
                        <td></td>
                        <td class="worksys">PW1</td>
                        <td class="worksys">555</td>
                      </tr>
                      <? }?>
                    </table>
              </div>
            </div>
            </form>
         </div>
     <div id="btn3">
            <div class="cancel_sap"><a id="other_login"><img src="images/cancel_btn.png" border="0" width="118" height="44" style="cursor:pointer" /></a></div>
            <div class="submit"><a onclick="javascript:IsEmpty2();"><img src="images/next_btn.png" width="118" height="44" border="0" style="cursor:pointer"/></a></div>
        </div>
  </div>
  <? } ?>
  <div id="footer3"><div class="copyright">Copyright @ 2013 by CPF</div></div>
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