
<?php

include ("libraries/cfg/cfg.inc.php");
include ("libraries/class/adLDAP.php");


echo "<BR>----------------------------------<BR>";
$con = @ldap_connect('ldaps://svr-cpfdc01.cpf.co.th', 636);
var_dump($con);
echo "<BR>----------------------------------<BR>";
ldap_set_option($con, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($con, LDAP_OPT_REFERRALS, 0);

var_dump(@ldap_bind($con, 'wisanu.sys@cpf.co.th', 'zadmin@cp1'));
echo "<BR>----------------------------------<BR>";


#Show Error
if (!ini_get('display_errors')) {
	ini_set('display_errors', '1');
}
ldap_set_option(NULL, LDAP_OPT_DEBUG_LEVEL, 7); 

$_domain_controllers = array ("192.168.1.171");

	##wisanu.dis password@1
	try {
		$adldap = new adLDAP();
	}catch (adLDAPException $e) {
		echo $e; exit();   
	}

	$_domain_controllers = array ("svr-cpfdc01.cpf.co.th");
	$adldap ->  set_domain_controllers($_domain_controllers);
	
	var_dump($adldap->get_domain_controllers());
	echo "<br>";

	$adldap -> set_use_ssl(true);
	$adldap -> set_use_tls(true);
	
	
	if($adldap -> connect()){
		echo "1. Connected<BR>";
		
		if($adldap -> authenticate("wisanu.sys","")){
		
			echo "2. Authentication Success <BR>";
		
			if($adldap -> user_enable("wisanu.dis")){
				echo "Enable user success.<BR>";
			}
			else{
				echo "Enable user Failed.<BR>";
			}
		}else{
	
			echo "2. Authentication Failed <BR>";
			
		}

	}


	
	$newpw = generateStrongPassword();
	echo "New Password:".$newpw."<BR>";
		
	// var_dump($adldap -> user_password("wisanu.dis",$newpw));
		if($adldap -> user_password("wisanu.dis",$newpw)){
			
			echo "reset password success.";
		}else{
		
			echo "reset password fail.";
		}
	
		echo "<BR>";
	
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
