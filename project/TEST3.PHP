		<?php
		ini_set('display_errors', '1');
		?>
<html>	

	<head>

		<link href="js/jquery.mobile-1.4.2/jquery.mobile-1.4.2.css" type="text/css" rel="stylesheet" /> 
			<meta name="viewport" content="width=device-width, initial-scale=1">
		 <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		 <script type="text/javascript" src="js/jquery-ui-1.10.4/jquery-1.10.2.js"></script> 
		 <script type="text/javascript" src="js/jquery-ui-1.10.4/jquery-ui-1.10.4.custom.js"></script>
		 <script type="text/javascript" src="js/jquery.mobile-1.4.2/jquery.mobile-1.4.2.js"></script>
	</head>		

			<form  name="myForm" method="POST" action="test2.php">
        
	              <p> 
	              	<input name="txtUsername" placeholder="Username" id="txtUsername" type="text"size="50" onKeyPress="return letternumber(event)" onfocus="inputFocus(this)" onblur="inputBlur(this)" value="ER" required="required" maxlength="20"/>

	              	<input name="txtPassword" placeholder="Card Id" id="txtPassword" class="txtPassword" type="text" pattern="[0-9]*" size="65" onfocus="inputFocus(this)" onblur="inputBlur(this)" required="required" value="7" onKeyUp="if(this.value*1!=this.value) this.value='' ;"/>

	             <!--	<input name="txtBirthDate" required="required" type="text" id="datepicker" placeholder="Birth Day >" />
	             	<input type="submit" name ="cmd" value = "Go" >
-->
					

	               <br></p>
	          <button type="submit" name ="cmd" value = "Next"  >Next </button>
	         
           
    		</form>

   </html> 	