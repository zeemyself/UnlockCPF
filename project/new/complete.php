<?
session_start();
putenv("NLS_LANG=AMERICAN_AMERICA.UTF8");
$_SESSION['userComplete']	= $_GET['complete'];

?>

<html>
<head>
	<title>Complete</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<script src="libraries/jquery-1.11.1.min.js"></script>
	<script src="libraries/jquery.mobile-1.4.5.min.js"></script>

	<link rel="stylesheet" type="text/css" href="libraries/jquery.mobile-1.4.5.min.css" /> 
	<link rel="stylesheet" type="text/css" href="libraries/custom.css" /> 
</head>

<body>
	<? if($_SESSION['userComplete'] == 1){ 
		echo "ok"?>

			<div data-role="page" >

			<div data-role="header" id="header1" >
				<h1 style="margin:0px; text-align: center;  " >Unlock Account</h1>
			</div><!-- /header -->		
			<br />
			
				<div data-role="content" data-theme="d">	
					<p> Complete1 Jaa</p><?=$_SESSION['username']?>
					<input type="submit" value="Confirm">
					<input type="submit" value="Cancle">

				</div>
			</div>

			<? } elseif($_SESSION['userPurpose'] == 2){ ?>
				<div data-role="page" id="popup2">

						<div data-role="header" id="header1" >
							<h1 style="margin:0px; text-align: center; ">Reset Password</h1>
						</div><!-- /header -->

					<div data-role="content" data-theme="d" align="left">	
						<p> 
	                      New password for <?=$_SESSION['username']?> will send to </br>
	                      E-mail :<?=$_SESSION['email']?> and </br>
	                      SMS : <?=$_SESSION['mobile']?> 
	                    </p>
	                         		
	            		<input type="submit" value="Confirm">
	            		<input type="submit" value="Cancle">

					</div><!-- /content -->
				</div><!-- /page popup -->
			<? } else{?>

			<div data-role="page" id="popup3">

				<div data-role="header" id="header1" >
					<h1 style="margin:0px; text-align: center; ">Change Password</h1>
				</div><!-- /header -->

				<div data-role="content" data-theme="d">	
					<form action="changPass.php" method="post">
					Current Password : <input type="password" name="currentPass" value="">
					New Password:<input type="password" name="newPass" value="">
					Confirm Password:<input type="password" name="confirmPass" value="">
					<br />
					<input type="submit" value="Confirm">
            		<input type="submit" value="Cancle">
					</form>

				</div><!-- /content -->
			</div><!-- /page popup -->
			<? } ?>

</body>
</html>