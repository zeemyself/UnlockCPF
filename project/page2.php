<html>
	<head>
			<meta charset="utf-8">
			<title>login</title>
			
			  <link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui.css" />
			  <link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui-timepicker-addon.css" />
	    	  <link rel="stylesheet" href="css/jqeury.mobile.theme.min.css" />
		      <link rel="stylesheet" href="css/jquery.mobile.icons.min.css" />
		      <link rel="stylesheet" href="css/jquery.mobile.min.css" />
		      <link rel="stylesheet" href="css/owl.carousel.css">
		      <link rel="stylesheet" href="css/owl.theme.css">
		      <link rel="stylesheet" href="css/nightly.css" />
		      <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic,600italic,700italic|Oswald:400,700' rel='stylesheet' type='text/css'>
		      <link rel="stylesheet" href="css/font-awesome.min.css">
		      <script src="js/jquery.min.js"></script>
		      <script src="js/jquery.mobile.min.js"></script>
		      <script src="js/owl.carousel.min.js"></script>
		      <script src="js/nightly.js"></script>
		      <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
			  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
	     	  <script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
		  	  <script type="text/javascript" src="js/jquery-ui-sliderAccess.js"></script>
		  	  <script>
				function alertFunction() {
   		 		alert("The process has been done sucesfully");
				}
			   </script>

		      	<style type="text/css">
			        .ui-header, .ui-bar-a{
			          background-color: #45B6CC;
			        }
			        #sidebar{
			          background-color: #45B6CC;
			        }
			        .ui-panel-inner{
			          background-color: #45B6CC;
			        }

			        @media all and (min-width: 100px) and (max-width: 800px) {
			        #loginForm{
			        				 
				    float:center;
						}
					}


				
	    		</style>
		</head>

	<body>	
		<div data-role="page" data-theme='a'>
			<div  data-role="header" data-tap-toggle="false" data-theme='a'>
				 

			
		 		 <a  href="page1.html" class="header-back-button" data-role="none">Home</a>
	                <h1 class="header-title">User Verification</h1>
	                <a class="header-back-button"   align = "right" id = "home" href="page3.html" data-role="none">Next</a>
		 		
			</div>
			<div data-role="content" align ="center"  >
			  <div id="loginForm"  >
			  	
	
		 			 	
			 <form method="post" action="page3.html" >
		      
		        <button type="submit" name="passwordReset"  ><img src="image/icon/key.png" style="width:15px;height:15px;" align="absmiddle">Password Reset </button>
				

				
				

		        
		   <!--     <p align ="right">
		          <a href="page3.html"> Server Settings> </a> <br/><br/><br/>    </p>    
        
		       

		        <p align ="right" style="color:gray ">if not enrolled,tap here <button type="submit" name="commit" 
		       	style= "padding: 10px;"  >Enroll</button> </p> -->
	      	</form>
	      	 <button type="submit" name="accUnlock" onclick="alertFunction()" id ="button2" >
				 	<img src="image/icon/unlocked44.png" 
				 	style="width:15px;height:15px;" align="absmiddle">
				 	Account Unlock 

				 </button>
			<div>
		</div>
	<div >

	</body>

</html>