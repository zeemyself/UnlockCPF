<!DOCTYPE html> 
<html> 
	<head> 
		<title>Index</title> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<script src="libraries/jquery-1.11.1.min.js"></script>
		<script src="libraries/jquery.mobile-1.4.5.min.js"></script>

		<link rel="stylesheet" type="text/css" href="libraries/jquery.mobile-1.4.5.min.css" /> 
		<link rel="stylesheet" type="text/css" href="libraries/custom.css" /> 
	
	</head> 

	<body> 
		<div data-role="page" >

			<div data-role="header" id="header1" >
				<h1 style="margin:0px; text-align: center; " >Manage AD Self Service</h1>
			</div><!-- /header -->		
			<br />
			
			<ul data-role="listview" data-inset="true" data-theme="d">
					<li><a href="#popup" data-role="button" data-theme="a" data-rel="dialog" text-align="center" data-transition="pop">
						<center>Unlock Account</center></a>
						</li> 
					<li><a href="#popup2" data-role="button" data-theme="a" data-rel="dialog" align="center" data-transition="pop">
						<center>Reset Password</center></a>
						</li> 
					<!-- <li><a href="#popup" data-role="button" data-theme="a" data-rel="dialog" data-transition="pop">ปลดล็อกไอดี</a></li> -->
					<li><a href="#popup3" data-role="button" data-theme="a" data-rel="dialog">
						<center>Change Password</center></a></li>
			</ul>
			<br />

			</div><!-- /page -->


			<!-- Start of third page: #popup -->
			<div data-role="page" id="popup">

				<div data-role="header" data-theme="c">
					<h1>Login</h1>
				</div><!-- /header -->

				<div data-role="content" data-theme="d">	
					<form action="login.php?purpose=1" method="post">
					Username : <input type="text" name="txtUser" value="wisanu.tec">
					Card Id:<input type="text" name="txtId" value="1559900091845">
					BirthDay:<input type="text" name="txtBirthDay" value="06/10/1986">
					<br />
					<input type="submit" value="Login">
					</form>

				</div><!-- /content -->
				
				
		</div><!-- /page popup -->

		<div data-role="page" id="popup2">

				<div data-role="header" data-theme="c">
					<h1>Login</h1>
				</div><!-- /header -->

				<div data-role="content" data-theme="d">	
					<form action="login.php?purpose=2" method="post">
					Username : <input tyepe="text" name="txtUser" value="wisanu.tec">
					Card Id:<input type="text" name="txtId" value="1559900091845">
					BirthDay:<input type="text" name="txtBirthDay" value="06/10/1986">
					<br />
					<input type="submit" value="Login">
					</form>

				</div><!-- /content -->
				
				
		</div><!-- /page popup -->

			<div data-role="page" id="popup3">

				<div data-role="header" data-theme="c">
					<h1>Login</h1>
				</div><!-- /header -->

				<div data-role="content" data-theme="d">	
					<form action="login.php?purpose=3" method="post">
					Username : <input type="text" name="txtUser" value="wisanu.tec">
					Card Id:<input type="text" name="txtId" value="1559900091845">
					BirthDay:<input type="text" name="txtBirthDay" value="06/10/1986">
					<br />
					<input type="submit" value="Login">
					</form>

				</div><!-- /content -->
				
				
		</div><!-- /page popup -->


	</body>
</html>

