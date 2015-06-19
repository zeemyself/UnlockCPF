<?PHP
@session_start();
include ("./cfg/cfg.inc.php");
include ("./cfg/UserAccountControl.inc.php");
include ("./class/adLDAP.php");

if($_REQUEST['txtUsername'] != ""){			
	try {
		$adldap = new adLDAP();
	}catch (adLDAPException $e) {
		echo $e; exit();   
	}
	$adldap -> connect();
	if($adldap -> authenticate($_REQUEST['txtUsername'],$_REQUEST['txtPassword'])){
		$userinfo = $adldap->user_info($_REQUEST['txtUsername'], array("displayname","description","telephonenumber","givenname","sn","mobile","title","department","company","mail"), $isGUID);
		$_SESSION["login"] = true;
		$_SESSION["needLogin"] = false;
		$_SESSION["user"]=$_REQUEST["txtUsername"];
		$_SESSION["displayname"]=$userinfo[0]['displayname'][0];
		$_SESSION['username'] = $_REQUEST['txtUsername'];
		$_SESSION['password'] = $_REQUEST['txtPassword'];
		$_SESSION['fullname'] = $userinfo[0]['description'][0];
		$_SESSION['firstname'] = $userinfo[0]['givenname'][0];
		$_SESSION['lastname'] = $userinfo[0]['sn'][0];
		$_SESSION['telephone'] = $userinfo[0]['telephonenumber'][0];
		$_SESSION['mobile'] = $userinfo[0]['mobile'][0];
		$_SESSION['title'] = $userinfo[0]['title'][0]; //ตำแหน่ง
		$_SESSION['department'] = $userinfo[0]['department'][0];
		$_SESSION['company'] = $userinfo[0]['company'][0];
		$_SESSION['mail'] = $userinfo[0]['mail'][0];
		$loginsucess = true;
		echo "<meta http-equiv=\"refresh\" content=\"0;URL='../index.php'\">";
	}else{ 
		##### Login fail #####
		$loginsucess = false;
		if($adldap -> authenticate($operator_adUser,$operator_adPassword,true)){
			$userinfo = $adldap->user_info($_REQUEST["txtUsername"], array("displayname","useraccountcontrol","lockoutTime"), $isGUID);
				if($userinfo){
					$uac = $userinfo[0]['useraccountcontrol'][0];
					//var_dump($uac);
					$uac_locktime = $userinfo[0]['lockouttime'][0];
					$loginfail = 2; ##### Case Password,Account lock,Account Disable #####
					if($uac_locktime != 0){
							$failCause = $userAccountLock;
					}else{
						if(isset($userAccountControlAlert[$uac])){
							$failCause = $userAccountControlAlert[$uac];
						}else{
							$failCause = $loginFailAlert[2];
						}
					}
				}else{
					$failCause = $loginFailAlert[3]; ##### Not found domain account
				}		
		}else{
			$failCause = $loginFailAlert[1]; ##### Check : operation user and password 
		}	
		echo "<script>alert('$failCause');window.location='../index.php'</script>";			
	}	
			
}
?>