

<?php

	

	/*if(setPassword("cpf","svr-tdc01","wisanu.tec","#wZMT45?x")){
		echo "Success Krub.";
	}else{
		
		echo "5555";
	
	}
	*/
	
	function setPassword($domain_name,$domain_controller,$userid,$password){
	

		if($com=new COM("WScript.Shell")){
		
			$cmd='C:\inetpub\CPFWebApplication\ADSS\libraries\CPF-ResetPassword\changepw.exe /d:'.$domain_name.' /s:'.$domain_controller.' /u:'.$userid.' /p:"'.$password.'"'; 
			
			
			if($cmd1=$com->exec($cmd)){ 
				
				return true;
				
			}else{ 
			
				return false;
			}
		}
	
	}
	
	
?>