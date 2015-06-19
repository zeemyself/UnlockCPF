<html>   
    <head>
    	<meta charset="utf-8">
    	<title>User Verification</title>
    	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

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

             $(function(){
          $("#dateInput").datepicker({
          dateFormat: 'dd-M-yy'
            });
            });
        </script>
        
        <script>function checkName(){
          var username = document.myForm.name.value;
          var cardID = document.myForm.cardID.value;
          var birthDay = document.myForm.birthDay.value;
          if(username=="" & cardID=="" & birthDay==""){
          alert("Please insert data");
           return false;
          } else if (username==""){
            alert("Please enter Username");
         
          } else if (cardID==""){
            alert("Please enter card ID");
         
          }else 
          return true;

          
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
			
			#nav2{
					padding: 0;
					    width: 100%;
					    height: 100px;
					    border: none;

					}

      </style>
    </head>
    <body>
	 	<div data-role="page" data-theme='a'>
	            <form  name="myForm" method="post" action="page1.html" >
	            <div data-role="header" data-tap-toggle="false" data-theme='a'>
	                <a class="header-back-button" href="page1.html" data-role="none">Home</a>
	                <h1 class="header-title">User Verification</h1>
	                <a href="page2.html" class="header-back-button"   align = "right" id = "home"  data-role="none">Next</a>
	                
    
    
	            </div>
	            

		            <div data-role="content"  >       
		            <h3 class="header-title"> <img src="image/logo.jpg" alt="CPF" style="width:40px;height:40px;" align="bottom">
			 		Manage ADSelfService </h3>                
		              <p> <input  type="text" id ="name" name="name" placeholder="Username" OnKeyPress="return chkNumber(this)" >
		              <input type="text" id="cardId" name="cardID" placeholder="Card Id" onKeyUp="if(this.value*1!=this.value) this.value='' ;" >
		               <input type="text" id="birthDay" name="birthDay" id="dateInput" placeholder="Birth Day >" /><br></p>
		         <!-- <button type="submit" href="page2.html" name ="cmd" value = "Next" onclick='return checkName(),checkCardId()' >Next </button> -->
	          	    </div>
	            
	    		</div>
    			</form>

        

       

    </body>
</html>