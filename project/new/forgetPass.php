<?
session_start();
putenv("NLS_LANG=AMERICAN_AMERICA.UTF8");
?>
<!DOCTYPE html> 
<html> 
	<head> 
	<title>Login</title> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<script src="libraries/jquery-1.11.1.min.js"></script>
	<script src="libraries/jquery.mobile-1.4.5.min.js"></script>

	<link rel="stylesheet" type="text/css" href="libraries/jquery.mobile-1.4.5.min.css" /> 
	<link rel="stylesheet" type="text/css" href="libraries/custom.css" /> 

</head> 
<body> 

<div data-role="page">

	<div data-role="header">
		<a href="index.php" data-icon="back" data-iconpos="notext" data-direction="reverse">Back</a>
		<h1>Account Information</h1>
	</div><!-- /header -->
	
		<?
			$conn = oci_connect('VOXTRONS', 'ksdew#kdlo13', 'SPSI');
			$users = $_POST['txtUser'];
			$idCard = $_POST['txtId'];
			$birthDay = $_POST['txtBirthDay'];
			$users = strtoupper($users);
			$birthDay = str_replace("/", "-", "$birthDay");
		//	if ($conn->connect_error) {
   		//	 die("Connection failed: " . $conn->connect_error);
		//	} 
		//	echo "Connected successfully";

		



		

			$strSQL = "SELECT * FROM SMARTCR.VIEW_SR_USER WHERE  USER_ID = '$users' and ID_NO = $idCard and BIRTH_DATE = '$birthDay'";
	
		$stid = oci_parse($conn, $strSQL);
		$st_exe = oci_execute($stid,OCI_DEFAULT);
		$num_row = oci_num_rows($stid);
		// var_dump($num_row);
		// exit();
		$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);


		$_SESSION['user'] = $users;
		$_SESSION['username'] = $users;
	//	$_SESSION['password'] = $_REQUEST['txtPassword'];
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


		if($row['LAST_NAME_LOCAL'] != null){
			$_SESSION["login"] = true;
		 	$_SESSION["needLogin"] = false;

		?>

			<ul data-role="listview" data-inset="true" data-theme="d">
			<li><a href="#popup" data-role="button" data-theme="a" data-rel="dialog" data-transition="pop">ลืมรหัสผ่าน</a></li>
			<!-- <li><a href="#popup" data-role="button" data-theme="a" data-rel="dialog" data-transition="pop">ปลดล็อกไอดี</a></li> -->
			<li><a href="https://passport.cpf.co.th/changepass.asp" data-role="button" data-theme="a" data-rel="dialog">เปลี่ยนรหัสผ่าน</a></li>
	</ul>

			


	<div data-role="page" id="popup">

	<div data-role="header" data-theme="c">
		<h1>Login</h1>
	</div><!-- /header -->

	<div data-role="content" data-theme="d">	
		<form action="login.php" method="post">
		Username : <input type="text" name="txtUser">
		Card Id:<input type="text" name="txtId">
		BirthDay:<input type="text" name="txtBirthDay">
		<br />
		<input type="submit" value="Login">
		</form>

	</div><!-- /content -->
	
	<div data-role="footer">
		<h4>Security SSL</h4>
	</div><!-- /footer -->
</div>

		<?
		}
		else
		{
			$_SESSION["strUserID"] = $objResult["UserID"];
		?>
			<center><h6>Invalid user & password</h6></center>

			<a href="index.php#popup" data-role="button" data-icon="back">Try Again</a>
		<?
		}
		?>

</div><!-- /page -->

</body>
</html>

<!-- This Code Download from www.ThaiCreate.Com -->