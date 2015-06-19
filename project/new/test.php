<?php
session_start();
putenv("NLS_LANG=AMERICAN_AMERICA.UTF8");
ini_set('display_errors', '1');
?>
<html>
	<head> 
		

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="libraries/jquery-1.11.1.min.js"></script>
		<script src="libraries/jquery.mobile-1.4.5.min.js"></script>

		<link rel="stylesheet" type="text/css" href="libraries/jquery.mobile-1.4.5.min.css" /> 
		<link rel="stylesheet" type="text/css" href="libraries/custom.css" /> 
		
	</head> 

<? if($_SESSION['userPurpose'] == 1){?>
<div data-role="page" >

			<div data-role="header" id="header1" >
				<h1 style="margin:0px; text-align: center;  " >Manage AD Self Service</h1>
			</div><!-- /header -->		
			<br />
			
			
			

				<div data-role="header" data-theme="c">
					<h1>Unlock Account</h1>
				</div><!-- /header -->

				<div data-role="content" data-theme="d">	
					<p> Are you sure you want to unlock this account ?? </p><?=$_SESSION['username']?>
					<input type="submit" value="Confirm">
					<input type="submit" value="Cancle">

				</div><!-- /content -->
			</div><!-- /page popup -->

			<? } else { ?>
				<div data-role="page" >

			<div data-role="header" id="header1" >
				<h1 style="margin:0px; text-align: center;  " >Manage AD Self Service</h1>
			</div><!-- /header -->		
			<br />
			
			
			

				<div data-role="header" data-theme="c">
					<h1>Reset Password</h1>
				</div><!-- /header -->

				<div data-role="content" data-theme="d">	
					
					<p> 
	                      New password for <?=$_SESSION['username']?> will send to </br>
	                      E-mail :<? $_SESSION['email']?> and </br>
	                      SMS : <?=$_SESSION['mobile']?> 
	                    </p>
					<input type="submit" value="Confirm">
					<input type="submit" value="Cancle">

				</div><!-- /content -->
			</div><!-- /page popup -->
		
			<? } ?>

			</html>