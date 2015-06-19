

<?php

	function mail2Approver($to,$rq_id){
	
	# Send mail to Manager $_SESSION["managermail"]
			
			
		$subject = 'UFOs:Please to approve UFOs Request:'.displayID($rq_id);
		$message = 'Please to approve UFOs Request:'.displayID($rq_id)." \r\n" .
				   'You can to approve via link => http://ufos.cpf.co.th/data_request_update_detail.php?id='.$rq_id;
		$headers = 'From: ufos@cpf.co.th' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	
	}
	
	function mail2Requester($to,$rq_id,$approve_cancel){
	
	# Send mail to Manager $_SESSION["managermail"]
			
		if($approve_cancel){		
			$subject = 'UFOs:Manager to approved UFOs Request:'.displayID($rq_id);
			$message = 'UFOs:Manager to approved UFOs Request:'.displayID($rq_id)." \r\n" .
					   'You can view detail via link => http://ufos.cpf.co.th/data_request_update_detail.php?id='.$rq_id;
			$headers = 'From: ufos@cpf.co.th' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
		}else{
			$subject = 'UFOs:Manager to canceled UFOs Request:'.displayID($rq_id);
			$message = 'UFOs:Manager to approved UFOs Request:'.displayID($rq_id)." \r\n" .
					   'You can view detail via link => http://ufos.cpf.co.th/data_request_update_detail.php?id='.$rq_id;
			$headers = 'From: ufos@cpf.co.th' . "\r\n" .
					'X-Mailer: PHP/' . phpversion();
			mail($to, $subject, $message, $headers);
		
	
		}
	
	}
	
	function mail2AllExecuted($to,$rq_id){
	

		$subject = 'UFOs: Executed Request:'.$rq_id;
		$message = 'UFOs: Executed Request:'.displayID($rq_id)." \r\n" .
				   'You can view detail via link => http://ufos.cpf.co.th/data_request_update_detail.php?id='.$rq_id;
		$headers = 'From: ufos@cpf.co.th' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

		mail($to, $subject, $message, $headers);
	
	}

?>