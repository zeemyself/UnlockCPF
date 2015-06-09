
<?php



include ("libraries/cfg/cfg.inc.php");
include ("libraries/class/adLDAP.php");

	##wisanu.dis password@1
	try {
		$adldap = new adLDAP();
	}catch (adLDAPException $e) {
		echo $e; exit();   
	}
	
	
	$adldap -> connect();
	if($adldap -> authenticate("wisanu.sys","golf@339")){
	
		if($adldap -> user_enable("wisanu.dis")){
			echo "Enable user success.";
		}
		
		$newpw = generateStrongPassword();
		echo $newpw."<BR>";
		var_dump($adldap -> user_password("wisanu.dis",$newpw));
		/*if($adldap -> user_password("wisanu.dis",$newpw)){
			
			echo "reset password success.".$newpw;
		}else{
		
			echo "reset password fail.".$newpw;
		}
		*/
		
		echo "<BR>";
		echo "End<BR>";
	
	
	}
	
	
	
	function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds'){
		$sets = array();
		if(strpos($available_sets, 'l') !== false)
			$sets[] = 'abcdefghjkmnpqrstuvwxyz';
		if(strpos($available_sets, 'u') !== false)
			$sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
		if(strpos($available_sets, 'd') !== false)
			$sets[] = '23456789';
		if(strpos($available_sets, 's') !== false)
			$sets[] = '!@#$%&*?';

		$all = '';
		$password = '';
		foreach($sets as $set)
		{
			$password .= $set[array_rand(str_split($set))];
			$all .= $set;
		}

		$all = str_split($all);
		for($i = 0; $i < $length - count($sets); $i++)
			$password .= $all[array_rand($all)];

		$password = str_shuffle($password);

		if(!$add_dashes)
			return $password;

		$dash_len = floor(sqrt($length));
		$dash_str = '';
		while(strlen($password) > $dash_len)
		{
			$dash_str .= substr($password, 0, $dash_len) . '-';
			$password = substr($password, $dash_len);
		}
		$dash_str .= $password;
		return $dash_str;
	}
	
	
	
	


?>
