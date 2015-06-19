<!DOCTYPE html> 
<html> 
	<head> 
	<title>ThaiCreate.Com</title> 
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" />
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="//code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head> 
<body> 

<div data-role="page">

	<div data-role="header">
		<a href="javascript:history.back();" data-icon="back" data-iconpos="notext" data-direction="reverse">Back</a>
		<h1>Details</h1>
	</div><!-- /header -->
	
		<?
			$objConnect = mysql_connect("localhost","root","root") or die(mysql_error());
			$objDB = mysql_select_db("mobile");
			$strSQL = " SELECT * FROM news WHERE NewsID = '".$_GET["NewsID"]."' ";

			$objQuery = mysql_query($strSQL) or die (mysql_error());
			$objResult = mysql_fetch_array($objQuery);
		?>


			<div class="ui-body ui-body-c">
				<h3><?=$objResult["Subject"];?></h3>
				<p><?=$objResult["Details"];?></p>
				
					<p class="ui-li-aside"><strong><?=date("Y-m-d",strtotime($objResult["NewsDate"]));?></strong></p>
			</div>

</div><!-- /page -->

</body>
</html>

<!-- This Code Download from www.ThaiCreate.Com -->