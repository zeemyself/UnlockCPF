

<?php


	function sendSMS($source,$tar_num,$tar_msg){
	

		if($com=new COM("WScript.Shell")){
		
			$cmd='C:\inetpub\CPFWebApplication\ADSS\libraries\sms\Feed\NpFeed.exe /F:"'.$source.'" /D:'.$tar_num.' /T:"'.$tar_msg.'"'; 
			
			if($cmd1=$com->exec($cmd)){ 
				return true;
			}else{ 
				return false;
			}
		}
	
	}
	
	
?>