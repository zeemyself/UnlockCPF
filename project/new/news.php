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

			<?
				$objConnect = mysql_connect("localhost","root","root") or die(mysql_error());
				$objDB = mysql_select_db("mobile");
				$strSQL = " SELECT * FROM category WHERE CategoryID = '".$_GET["CategoryID"]."' ";

				$objQuery = mysql_query($strSQL) or die (mysql_error());
				$objResult = mysql_fetch_array($objQuery);
			?>
	<div data-role="header">
		<a href="category.php" data-icon="home" data-iconpos="notext" data-direction="reverse">Home</a>
		<h1><?=$objResult["CategoryName"];?></h1>
	</div><!-- /header -->
	
	<br />
	
		<ul data-role="listview" data-inset="true" data-theme="d" data-divider-theme="e">
			<li data-role="list-divider"><?=$objResult["CategoryName"];?></li>
				<?
				$strSQL2 = " SELECT * FROM news WHERE CategoryID = '".$_GET["CategoryID"]."' ORDER BY NewsDate DESC ";
				$objQuery2 = mysql_query($strSQL2) or die (mysql_error());
				while($objResult2 = mysql_fetch_array($objQuery2))
				{
				?>
					<li><a href="details.php?NewsID=<?=$objResult2["NewsID"];?>">
							<h3><?=date("Y-m-d",strtotime($objResult2["NewsDate"]));?></h3>
							<p><?=$objResult2["Subject"];?></p>
							<p class="ui-li-aside"><strong><?=date("H:i",strtotime($objResult2["NewsDate"]));?></strong></p>
						</a>
					</li>
				<?
				}
				?>
		</ul>


</div><!-- /page -->

</body>
</html>

<!-- This Code Download from www.ThaiCreate.Com -->