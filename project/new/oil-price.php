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
		<a href="index.php" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
		<h1>Oil Price</h1>
	</div><!-- /header -->

	

			<ul data-role="listview" data-inset="true">
				<center><h4>Update <?=date("Y-m-d")?></h4></center>
				<?
				$objConnect = mysql_connect("localhost","root","root") or die(mysql_error());
				$objDB = mysql_select_db("mobile");
				$strSQL = " SELECT * FROM oil ORDER BY CompID ASC ";

				$objQuery = mysql_query($strSQL) or die (mysql_error());
				while($objResult = mysql_fetch_array($objQuery))
				{
				?>
					<li>
						<img src="image/<?=$objResult["Logo"];?>" width="60"  height="60" />
						<h3><?=$objResult["CompName"];?></h3>
						<p><?=$objResult["Price"];?></p>
					</li>
				<?
				}
				?>

			</ul>

</div><!-- /page -->

</body>
</html>

<!-- This Code Download from www.ThaiCreate.Com -->