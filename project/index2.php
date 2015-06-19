<html>   
    <head>
    	<title>User Verification</title>
    	<meta charset="utf-8">    	
    	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    	

      	  <link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui.css" />
		  <link rel="stylesheet" media="all" type="text/css" href="css/jquery-ui-timepicker-addon.css" />
    	  <link rel="stylesheet" href="css/jqeury.mobile.theme.min.css" />
	      <link rel="stylesheet" href="css/jquery.mobile.icons.min.css" />
	      <link rel="stylesheet" href="css/jquery.mobile.min.css" />
	      <link rel="stylesheet" href="css/owl.carousel.css">
	      <link rel="stylesheet" href="css/owl.theme.css">
	      <link rel="stylesheet" href="css/nightly.css" />
	     <!-- <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic,600italic,700italic|Oswald:400,700' rel='stylesheet' type='text/css'> -->
	      <link rel="stylesheet" href="css/font-awesome.min.css">
	      <script src="js/jquery.min.js"></script>
	      <script src="js/jquery.mobile.min.js"></script>
	      <script src="js/owl.carousel.min.js"></script>
	      <script src="js/nightly.js"></script>
	      <!-- <script type="text/javascript" src="js/jquery-1.10.2.min.js"></script> -->
		  <script type="text/javascript" src="js/jquery-ui.min.js"></script>
     	  <script type="text/javascript" src="js/jquery-ui-timepicker-addon.js"></script>
	  	  <script type="text/javascript" src="js/jquery-ui-sliderAccess.js"></script>
		 
		  <script>
			  	$(function() {
			    $( "#datepicker" ).datepicker({
			    	yearRange: "1950:2015",
			    	changeYear:true
			    });
			  });

			  var yearRange = $( ".selector" ).datepicker( "option", "yearRange" );
			  var changeYear = $( ".selector" ).datepicker( "option", "changeYear" );
			 // var yearRange = $( ".selector" ).datepicker( "option", "yearRange" );
			</script>

		<script type="text/javascript">
		function letternumber(e)
		{
		var key;
		var keychar;

		if (window.event)
		   key = window.event.keyCode;
		else if (e)
		   key = e.which;
		else
		   return true;
		keychar = String.fromCharCode(key);
		keychar = keychar.toLowerCase();

		// control keys
		if ((key==null) || (key==0) || (key==8) || 
		    (key==9) || (key==13) || (key==27) )
		   return true;

		// alphas and numbers
		else if ((("abcdefghijklmnopqrstuvwxyz.").indexOf(keychar) > -1))
		   return true;
		else
		   return false;
		}
		</script>

		<script language="javascript">
	
    function inputFocus(i){
		if(i.value==i.defaultValue){ 
			i.value="";
			i.style.color="#064d8f"; 
		}
	}
	function inputBlur(i){
		if(i.value==""){
			i.value=i.defaultValue;
			i.style.color="#064d8f";
		}
	}
	function changeBox(){
		document.getElementById('password_field_temp').style.display='none';
		document.getElementById('password_field').style.display='';
		document.getElementById('txtPassword').focus();
	}
	function restoreBox(){
		if(document.getElementById('txtPassword').value==''){
			document.getElementById('password_field_temp').style.display='';
			document.getElementById('password_field').style.display='none';
		}
	}  
	$(document).keypress(function(event){
		var keycode = (event.keyCode ? event.keyCode : event.which);
		
		if(keycode == '13'){
			document.getElementById("login_link").click(); 
		}
	});
	$(document).ready(function() {
		$("#other_login").click(function () {
			window.location.href='libraries/session_destroy.php';
		});
		
		$('#login_link').click(function(){
			
			 //alert(!preg_match('/[^A-Za-z0-9]/', $("#txtUsername").val() ))
			 	
			 	// alert($("#txtUsername").val() + "DONE");
			if (($("#txtUsername").val().length < 1) ||  ($("#txtUsername").val()=="ผู้ใช้งาน iHR/Internet") ) {
				$('#trigger_username').fancybox({padding:0, margin:0}).trigger('click');
				return false;
			}
			if (($("#txtPassword").val().length <1) ||  ($("#txtPassword").val()=="รหัสผ่าน iHR/Internet") ) {
				$('#trigger_password').fancybox({padding:0, margin:0}).trigger('click');
				return false;
			}
			if (($("#datepicker").val().length < 1) ||  ($("#datepicker").val()=="รหัสผ่าน iHR/Internet") ) {
				$('#trigger_birthdate').fancybox({padding:0, margin:0}).trigger('click');
				return false;	
			}
			var capt = document.getElementById('capt').value;
			if(capt==""){
				$('#trigger_captcha_empty').fancybox({padding:0, margin:0}).trigger('click');
				return false;
			}
			
			$.ajax({
				type: "POST",
				url:"sample/check.php",
				data:'capt='+capt,
				success:function(respond){
					if(respond=='n'){
						$('#trigger_captcha').fancybox({padding:0, margin:0}).trigger('click');
						return false;
					}else{
						document.formlogin.submit();
						$("#loader").show();
					}
				}
			});
			
		});
	});
		</script>
           
     <!--  <script>

             $(function(){
          $("#dateInput").datepicker({
          dateFormat: 'dd-M-yy'
            });
            });
        </script> 
       --> 
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
	            	<div data-role="header" data-tap-toggle="false" data-theme='a'>
	                <a class="header-back-button" href="login.html" data-role="none">Home</a>
	                <h1 class="header-title">User Verification</h1>
	                <a class="header-back-button"  align = "right" id = "home" href="page2.html" data-role="none">Next</a>
	                 
                </div>
	            </form>


	            <div data-role="content"  >       
	            <h3 class="header-title"> <img src="image/logo.jpg" alt="CPF" style="width:40px;height:40px;" align="bottom">
		 		Manage ADSelfService </h3>    

		 		  <form  name="myForm" method="POST" action="test2.php">
        
	              <p> 
	              	<input name="txtUsername" placeholder="Username" id="txtUsername" type="text"size="50" onKeyPress="return letternumber(event)" onfocus="inputFocus(this)" onblur="inputBlur(this)" value="ER" required="required" maxlength="20"/>

	              	<input name="txtPassword" placeholder="Card Id" id="txtPassword" class="txtPassword" type="text" pattern="[0-9]*" size="65" onfocus="inputFocus(this)" onblur="inputBlur(this)" required="required" value="7" onKeyUp="if(this.value*1!=this.value) this.value='' ;"/>

	             	<input name="txtBirthDate" required="required" type="text" id="datepicker" placeholder="Birth Day >" />
	             	<input type="submit" name ="cmd" value = "Go" >


	               <br></p>
	          <button type="submit" name ="cmd" value = "Next"  >Next </button>
	         
              </div>
	            
	    </div>
    			</form>

        

       

    </body>
</html>