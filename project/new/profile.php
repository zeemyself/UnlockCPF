<?
session_start();
if($_SESSION["strUserID"] == "")
{
	header("location:index.php");
	exit();
}
?>
<!DOCTYPE html> 
<html> 
	<head> 
	<title>ThaiCreate.Com</title> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!-- <link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" /> -->
	<!--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> -->
	<!-- <script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script> -->
	<script src="libraries/jquery-1.11.1.min.js"></script>
	<script src="libraries/jquery.mobile-1.4.5.min.js"></script>

	<link rel="stylesheet" href="libraries/jquery.mobile-1.4.5.min.css" /> 
</head> 
<body> 

<div data-role="page">
	<div data-role="header">
		<a href="index.php" data-icon="back" data-iconpos="notext" data-direction="reverse">Back</a>
		<h1>Profile</h1>
	</div><!-- /header -->
 
 		<?
			$objConnect = mysql_connect("localhost","root","root") or die(mysql_error());
			$objDB = mysql_select_db("mobile");
			$strSQL = " SELECT * FROM member WHERE UserID = '".$_SESSION["strUserID"]."' ";

			$objQuery = mysql_query($strSQL) or die (mysql_error());
			$objResult = mysql_fetch_array($objQuery);
		?>
		<div style="padding-left:10px;padding-right:10px">

				<center><h3>Account Information</h3></center>
		
				<div data-role="fieldcontain">
							 <label for="name">Username :</label>
							 <?=$objResult["Username"];?>
				</div>

				<div data-role="fieldcontain">
							 <label for="name">Name :</label>
							 <?=$objResult["Name"];?>
				</div>

				<div data-role="fieldcontain">
							 <label for="name">Password :</label>
							 <?=$objResult["Password"];?>
				</div>

				<div data-role="fieldcontain">
							 <label for="name">Email :</label>
							<?=$objResult["Email"];?>
				</div>
	
	</div>

<a href="#AccDialog" data-role="button" data-rel="dialog" data-transition="slideup">Account Option</a>

</div><!-- /page -->
<div data-role="page" id="AccDialog"> 
 
	<div data-role="content"> 
		<a href="logout.php" data-role="button" data-icon="star" data-theme="e">Logout</a>
		<a href="profile.php" data-role="button" data-icon="star" data-theme="b">Cancel</a>
	</div>
	
</div>

</body>
</html>

<!-- This Code Download from www.ThaiCreate.Com -->