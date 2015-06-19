<html>


<head>
	<title>test2</title>
			<link href="js/jquery.mobile-1.4.2/jquery.mobile-1.4.2.css" type="text/css" rel="stylesheet" /> 

		 <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		 <script type="text/javascript" src="js/jquery-ui-1.10.4/jquery-1.10.2.js"></script> 
		 <script type="text/javascript" src="js/jquery-ui-1.10.4/jquery-ui-1.10.4.custom.js"></script>
		 <script type="text/javascript" src="js/jquery.mobile-1.4.2/jquery.mobile-1.4.2.js"></script>
		 

</head>




<?php 
// ini_set('display_errors', '1');
$conn = oci_connect('VOXTRONS', 'ksdew#kdlo13', 'SPSI');
		
		 //var_dump($_POST);
		$users = $_POST['txtUsername'];
		$id = $_POST['txtPassword'];
		$birth = $_POST['txtBirthDate'];
		// $idnum = $_REQUEST['txtPassword'];
		// $datepick = $_REQUEST['txtBirthDate'];
		// $date = str_replace("/","-","$datepick");
		// $users = strtoupper($users); 

		if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "Connected successfully";

		
		// $strSQL = "SELECT * FROM SMARTCR.VIEW_SR_USER WHERE  USER_ID = '$users' and ID_NO = $idnum and BIRTH_DATE = '$date'";
		//  echo $strSQL."<br>";
		//  var_dump()
		//  echo $users;
		//  echo $idnum;
		// var_dump($date);
		//exit();
		//echo "<br>1<br>";
		?>

		 <body>
		<div data-role="page"> 	
		<div data-role="fieldcontain">
							 <label for="name">Username :</label>
							 <?=$_POST['txtUsername']?>
		</div>

	</div>	
	<h1><? echo $users;	?></h1>
	<!-- <input type="text" value = "<?php echo $_POST['txtUsername']?>" /> -->
	
	
</body>

</html>