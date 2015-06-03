<?php
session_start();
//print_r($_SESSION);
if($_SESSION['usertype']=='1'||$_SESSION['usertype']=='g'){ // บุคคลทั่วไป
	$typeofuser = "X";
	if($typeofuser!=""){$_SESSION['typeofuser'] = $typeofuser;}
	$user_sap = $_POST['txtUsername_sap'];
	$user_sap = strtoupper($user_sap);
	if($user_sap!=""){$_SESSION['user_sap'] = $user_sap;}
	//$id = $_POST['txtPassword_temp_sap'];
	//$_SESSION['id_card']=$id;
	if(($_SESSION['usertype']=='1'||$_SESSION['usertype']=='g') && $_SESSION['worktype']=='1'){  //opsys R3
		$opsys_client = '8'; //PR1 555
		$_SESSION['opsys_client'] = $opsys_client;
	}
	else if(($_SESSION['usertype']=='1'||$_SESSION['usertype']=='g') && $_SESSION['worktype']=='2'){ //opsys BW
		$opsys_client = '13'; //PW1 555
		$_SESSION['opsys_client'] = $opsys_client;
	}
	$User_ID_SAP = $user_sap;
	if($opsys_client=='8'){$Client = "PR1-555";}
	else if($opsys_client=='13'){$Client = "PW1-555";}
}
else{ //ทีมงาน SAP
	$typeofuser = "";
	$_SESSION['typeofuser'] = $typeofuser;
	$user_sap = $_POST['txtUsername_sap2'];
	$user_sap = strtoupper($user_sap);
	$_SESSION['user_sap'] = $user_sap;
	//$id = $_POST['txtPassword_temp_sap2'];
	$opsys_client = $_POST['opsys_client'];
	$_SESSION['opsys_client'] = $opsys_client;
	if($opsys_client==''){$opsys_client = $_SESSION['opsys_client'];}
	$User_ID_SAP = $user_sap;
}

if($_SESSION['worktype']=='1'){
	$opsys = "R3";
	$_SESSION['opsys']=$opsys;
}
else if($_SESSION['worktype']=='2'){
	$opsys = "BW";
	$_SESSION['opsys']=$opsys;
}

if($_SESSION['user_purpose_ss']=='1'){
	$user_purpose = "X";
} //RESET
else if($_SESSION['user_purpose_ss']=='2'){
	$user_purpose = "";
} //UNLOCK
//echo $opsys_client;
if($opsys_client=='1'||$_SESSION['opsys_client']=='1'){ // dv6 200
	$url= "http://cpfdv6:8000/sap/bc/srt/wsdl/srvc_001560047A3C1EE38F8B9689DE8D9D01/wsdl11/allinone/ws_policy/document?sap-client=200";
	$login_wsdl = 'WSRFC';
	$pw_wsdl = 'cpfWS@10';
	$Client = "DV6-200";
}
else if($opsys_client=='2'||$_SESSION['opsys_client']=='2'){ // dv6 210
	$url= "http://cpfdv6:8000/sap/bc/srt/wsdl/srvc_001560047A3C1ED38F8AF7D24F094200/wsdl11/allinone/ws_policy/document?sap-client=210";
	$login_wsdl = 'WSRFC';
	$pw_wsdl = 'cpfWS@10';
	$Client = "DV6-210";
}
else if($opsys_client=='3'||$_SESSION['opsys_client']=='3'){ // dv6 220
	$url= "http://cpfdv6:8000/sap/bc/srt/wsdl/srvc_001560047A3C1EE2BBD347B2AB40C400/wsdl11/allinone/ws_policy/document?sap-client=220";
	$login_wsdl = 'WSRFC';
	$pw_wsdl = 'cpfWS@10';
	$Client = "DV6-220";
}
else if($opsys_client=='6'||$_SESSION['opsys_client']=='6'){ // qa1 300
	$url= "http://cpfdv1.cpf.co.th:8000/sap/bc/srt/rfc/sap/zws_reset_unlock_psw?sap-client=210&wsdl=1.1";
	$login_wsdl = 'wsrfc';
	$pw_wsdl = 'cpfws@10';
	$Client = "QA1-300";
}
else if($opsys_client=='7'||$_SESSION['opsys_client']=='7'){ // tr1 800
	$url= "http://cpfdv1.cpf.co.th:8000/sap/bc/srt/rfc/sap/zws_reset_unlock_psw?sap-client=210&wsdl=1.1";
	$login_wsdl = 'wsrfc';
	$pw_wsdl = 'cpfws@10';
	$Client = "TR1-800";
}
else if($opsys_client=='8'||$_SESSION['opsys_client']=='8'){ // pr1 555
	$url= "http://cpfdv1.cpf.co.th:8000/sap/bc/srt/rfc/sap/zws_reset_unlock_psw?sap-client=210&wsdl=1.1";
	$login_wsdl = 'wsrfc';
	$pw_wsdl = 'cpfws@10';
	$Client = "PR1-555";
}
else if($opsys_client=='9'||$_SESSION['opsys_client']=='9'){ // pr1 510
	$url= "http://cpfdv1.cpf.co.th:8000/sap/bc/srt/rfc/sap/zws_reset_unlock_psw?sap-client=210&wsdl=1.1";
	$login_wsdl = 'wsrfc';
	$pw_wsdl = 'cpfws@10';
	$Client = "PR1-510";
}
else if($opsys_client=='10'||$_SESSION['opsys_client']=='10'){ // rpt 555
	$url= "http://cpfdv1.cpf.co.th:8000/sap/bc/srt/rfc/sap/zws_reset_unlock_psw?sap-client=210&wsdl=1.1";
	$login_wsdl = 'wsrfc';
	$pw_wsdl = 'cpfws@10';
	$Client = "RPT-555";
}
else if($opsys_client=='11'||$_SESSION['opsys_client']=='11'){ // dw1 200
	$url= "http://cpfdv1.cpf.co.th:8000/sap/bc/srt/rfc/sap/zws_reset_unlock_psw?sap-client=210&wsdl=1.1";
	$login_wsdl = 'wsrfc';
	$pw_wsdl = 'cpfws@10';
	$Client = "DW1-200";
}
else if($opsys_client=='12'||$_SESSION['opsys_client']=='12'){ // qw1 300
	$url= "http://cpfdv1.cpf.co.th:8000/sap/bc/srt/rfc/sap/zws_reset_unlock_psw?sap-client=210&wsdl=1.1";
	$login_wsdl = 'wsrfc';
	$pw_wsdl = 'cpfws@10';
	$Client = "QW1-300";
}
else if($opsys_client=='13'||$_SESSION['opsys_client']=='13'){ // pw1 555
	$url= "http://cpfdv1.cpf.co.th:8000/sap/bc/srt/rfc/sap/zws_reset_unlock_psw?sap-client=210&wsdl=1.1";
	$login_wsdl = 'wsrfc';
	$pw_wsdl = 'cpfws@10';
	$Client = "PW1-555";
}
include "libraries/connect.php";


$sql_log_id = "SELECT * FROM log_web WHERE log_id='$_SESSION[log_id]'";
$query_log_id = mysql_query($sql_log_id);
$row_log_id = mysql_fetch_array($query_log_id);
$Msg_response_fromdb = $row_log_id['Msg_response'];
//echo "Msg".$Msg_response_fromdb;
if($Msg_response_fromdb=="")
{
	$sql_log = "UPDATE log_web SET User_ID_SAP ='$User_ID_SAP',Client='$Client' WHERE log_id = '$_SESSION[log_id]'";
	$query_log = mysql_query($sql_log);
}else{
	$sql_log = "INSERT INTO log_web(Logon_Date,Logon_Time,User_Name_Ldap,User_Type,Requirement,System,User_ID_SAP,Client) 
				VALUES('$_SESSION[todaydate]','$_SESSION[timenow]','$_SESSION[username]','$_SESSION[User_Type]',
				'$_SESSION[Requirement]','$_SESSION[System]','$User_ID_SAP','$Client')";
	//$query_log = mysql_query($sql_log);
	$_SESSION['log_id'] = mysql_insert_id();
}
//echo $sql_log;
$_SESSION['User_ID_SAP'] = $User_ID_SAP;
$_SESSION['Client'] = $Client;
/*echo "<br/>id".$_SESSION['id'];
echo "<br/>opsys".$_SESSION['opsys'];
echo "<br/>puppose".$_SESSION['user_purpose'];
echo "<br/>usertype".$_SESSION['typeofuser'];
echo "<br/>usersap".$user_sap;*/
//echo $login_wsdl;
//echo $pw_wsdl;
//echo $url;
//echo $_SESSION['user_purpose'];
	if($_SESSION['user_purpose']=='1'){$wsdl_preset="U";}
	else{$wsdl_preset="R";}
	if($_SESSION['usertype']=='1'||$_SESSION['usertype']=='g'){$wsdl_usertype="U";}
	else{$wsdl_usertype="S";}
	//echo $wsdl_preset;
	$msgin = $_SESSION['user_detail'];
	//echo $msgin."<br/>".$_SESSION['opsys']."<br/>".$wsdl_preset."<br/>".$user_sap."<br/>".$wsdl_usertype;
	
	$client = new SoapClient($url,array(
        'login' => $login_wsdl,
        'password' => $pw_wsdl
    ));
	//echo $client;
	
	$objectResult = $client->ZWS_RESET_UNLOCK_PSW(array(
	'MSGIN'=>$msgin,
	'OPSYS'=>$_SESSION['opsys'],
	'PRESET'=>$wsdl_preset,
	'UNAME'=>$user_sap,
	'USER'=>$wsdl_usertype));

$message = $objectResult->MESSAGE;
$msgtype = $objectResult->MSGTYP;

$_SESSION['message'] = $message;
$_SESSION['msgtype'] = $msgtype;

//echo $_SESSION['message'];
if($msgtype=='S'){ $result = "Success";}
else{$result = "Error";}

$sql_log_id = "SELECT * FROM log_web WHERE log_id='$_SESSION[log_id]'";
$query_log_id = mysql_query($sql_log_id);
$row_log_id = mysql_fetch_array($query_log_id);
$Msg_response_fromdb = $row_log_id['Msg_response'];
if($Msg_response_fromdb==""){
	$sql_log = "UPDATE log_web SET Result='$result',Msg_response='$_SESSION[message]' WHERE log_id = '$_SESSION[log_id]'";
	$query_log = mysql_query($sql_log);
}else{
	$sql_log = "INSERT INTO log_web(Logon_Date,Logon_Time,User_Name_Ldap,User_Type,Requirement,System,User_ID_SAP,Client,Result,Msg_response) 
				VALUES('$_SESSION[todaydate]','$_SESSION[timenow]','$_SESSION[username]','$_SESSION[User_Type]',
				'$_SESSION[Requirement]','$_SESSION[System]','$_SESSION[User_ID_SAP]','$_SESSION[Client]','$result','$_SESSION[message]')";
	$query_log = mysql_query($sql_log);
	$_SESSION['log_id'] = mysql_insert_id();
}
echo "<script>window.location.href='step4.php';</script>";
?>
<?php
/*
$client = new SoapClient("http://cpfdv1.cpf.co.th:8000/sap/bc/srt/rfc/sap/zws_reset_unlock_psw?sap-client=210&wsdl=1.1",array(
        'login' => 'wsrfc',
        'password' => 'cpfws@10'
    ));

	$objectResult = $client->ZWS_RESET_UNLOCK_PSW(array('ID'=>'1234567890123','OPSYS'=>'R3','PRESET'=>'X','USER'=>'','UNAME'=>'WICHAAMP'));


echo $objectResult->MESSAGE;
*/
?>