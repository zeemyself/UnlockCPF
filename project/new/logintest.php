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
		<h1 style="margin:0px; text-align: center; " id="header1" >Account Information</h1>
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

		$_SESSION['userPurpose']	= $_GET['purpose'];


		if($row['LAST_NAME_LOCAL'] != null){
			$_SESSION["login"] = true;
		 	$_SESSION["needLogin"] = false;
		?>

		

			<div style="padding-left:10px;padding-right:10px">

				
		
				<div data-role="fieldcontain">
							 <label for="name">ID :</label>
							 <?=$_SESSION['username']?>
				</div>

				<div data-role="fieldcontain">
							 <label for="name">Name :</label>
							 <?=$_SESSION['fullname'];?>
				</div>

			

				<div data-role="fieldcontain">
							 <label for="name">Email :</label>
							<?=$_SESSION['email'] ;?>
				</div>

				<div data-role="fieldcontain">
							 <label for="name">Tel :</label>
							<?=$_SESSION['mobile'] ;?>							
							
				</div>



				
				
				<a href="confirm.php" data-role="button" data-ajax="false">Next</a>
	</div>

		<?
		}
		else
		{
			
		?>
			<center><h6>Invalid user & password</h6></center>

			<a href="index.php#popup" data-role="button" data-icon="back">Try Again</a>
		<?
		}

		


		?>

</div><!-- /page -->

</body>
</html>
