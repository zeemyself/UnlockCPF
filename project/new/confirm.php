<?php
session_start();
putenv("NLS_LANG=AMERICAN_AMERICA.UTF8");
ini_set('display_errors', '1');
?>
<html> 
	<head> 
		
		<title>Confirm</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="libraries/jquery-1.11.1.min.js"></script>
		<script src="libraries/jquery.mobile-1.4.5.min.js"></script>

		<link rel="stylesheet" type="text/css" href="libraries/jquery.mobile-1.4.5.min.css" /> 
		<link rel="stylesheet" type="text/css" href="libraries/custom.css" /> 
		
	</head> 

	<body>
		<? if($_SESSION['userPurpose'] == 1){?>

			<div data-role="page" >

			<div data-role="header" id="header1" >
				
				<h1 style="margin:0px; text-align: center;  " >Unlock Account</h1>
			</div><!-- /header -->		
		
			
				<div data-role="content" data-theme="d">
					<h4> Are you sure you want to unlock this account ?? </h4><?=$_SESSION['username']?>
					<a href="#message" data-role="button" data-theme="a" data-rel="dialog" > Confirm</a>
					<a href="index.php" data-role="button" data-ajax="false">Cancle</a>
					
				</div>
			</div>

			<? } elseif($_SESSION['userPurpose'] == 2){ ?>
				<div data-role="page" id="popup2">

						<div data-role="header" id="header1" >
							<h1 style="margin:0px; text-align: center; ">Reset Password</h1>
						</div>

					<div data-role="content" data-theme="d" align="left">	
						<h4> 
	                      New password for <?=$_SESSION['username']?> will send to </br>
	                      E-mail :<?=$_SESSION['email']?> and </br>
	                      SMS : <?=$_SESSION['mobile']?> 
	                    </h4>
	                         		
	            	<a href="#message2" data-role="button" data-theme="a" data-rel="dialog" > Confirm</a>
					<a href="index.php" data-role="button" data-ajax="false">Cancle</a>

					</div>
				</div>
			<? } else{?>


			<div data-role="page" id="popup3">
				<div data-role="header" id="header1" >
					<h1 style="margin:0px; text-align: center; ">Change Password</h1>
				</div>
				<div data-role="content" data-theme="d">	
					<form action="changPass.php" method="post">
					Current Password : <input type="password" name="currentPass" value="">
					New Password:<input type="password" name="newPass" value="">
					Confirm Password:<input type="password" name="confirmPass" value="">
					<br />
					<a href="#message3" data-role="button" data-theme="a" data-rel="dialog" > Confirm</a>
					<a href="index.php" data-role="button" data-ajax="false">Cancle</a>
					</form>

				</div>
			</div>
			<? } ?>


			<!--showMessageComplete-->

		<div data-role="page" id="message">

				<div data-role="header" data-theme="c" id="header1">
					<h1 style="margin:0px; text-align: center; ">UnLock Complete</h1>
				</div>

				<div data-role="content" data-theme="d" align="center">	
					<p> Account : <?=$_SESSION['username']?> <br/>
						has been unlocked.
					</p>
				</div>
		</div>

		<div data-role="page" id="message2">

				<div data-role="header" data-theme="c" id="header1">
					<h1 style="margin:0px; text-align: center; ">Reset Complete</h1>
				</div>

				<div data-role="content" data-theme="d">	
					<p> 
	                      Send New password for <?=$_SESSION['username']?>  to </br>
	                      E-mail :<?=$_SESSION['email']?> and </br>
	                      SMS : <?=$_SESSION['mobile']?> 
	                      already!
	                    </p>
				</div>
		</div>

		<div data-role="page" id="message3">

				<div data-role="header" data-theme="c" id="header1">
					<h1 style="margin:0px; text-align: center; ">Change Complete</h1>
				</div>

				<div data-role="content" data-theme="d">	
					<p> Your Password has changed.</p>
				</div>
		</div>


		
	 </body>

 </html>