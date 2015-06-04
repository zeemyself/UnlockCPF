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
</head>
<body>
<div id="container">
	<div id="header">
      <div class="sap_logo" align="right"><img src="images/sap_logo.png" width="101" height="51" /></div>
      <div class="sap_title"><img src="images/sap_title.png" width="577" height="36" /></div>
      <div class="unlock_logo"><img src="images/unlock_logo.png" width="37" height="36" /></div>
      <div class="cpf_logo"><img src="images/cpf_logo.png" width="51" height="51" /></div>
     
    </div>
    <div class="header_bar"></div>
    <div id="nav"><img src="images/nav1_over.png" width="835" height="46" usemap="#Map" border="0" />
	<div id="loader" style="display:none;position:relative; padding-left:850px; margin-top:-40px"><img src="images/preloader.gif" width="35" height="35" border="0"></div>
    </div>
    <div class="nav_line">
		<?php if(isset($_SESSION['username'])&&isset($_SESSION['password'])){?>
			<div class="logout"><img src="images/logout.png" width="127" height="30" usemap="#Map2" border="0"></div>
			<map name="Map2" id="Map2">
			  <area shape="rect" coords="5,1,132,28" href="javascript:window.location.href='libraries/session_destroy.php'" />
			</map>
		<?php } ?>
	</div>
	<div id="content1">
		<a href="index.php"><img src="images/forgotpassrsz.png" height="59px" width="357px" ></a>
		&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
		<a href="index.php"><img src="images/unlockaccrsz.png" height="59px" width="357px"></a>
</div>
</body>
</html>

 