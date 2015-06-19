<?php
// ini_set('display_errors', '1');
include ("libraries/cfg/cfg.inc.php");
include ("libraries/class/adLDAP.php");



 try {
    $adldap = new adLDAP();
  }
  catch (adLDAPException $e) {
    echo $e; 
    exit();   
  }
  if($adldap -> connect())
  	echo "Connecting........<br>";


	// echo "Operator....$operator_adUser....<br>";
	

  if($adldap -> authenticate("swas.kun","cpfit@2015"))
  	echo "Connected<br>";


else
  echo "fail";
  // $attr=array("samaccountname","mail","memberof","department","displayname","telephonenumber","primarygroupid","objectsid","pager"); 
  //  $userinfo = ($adldap -> user_info("wisanu.sys",$attr));
  //      $uac = $userinfo[0]['pager'][0];
  //          echo $uac;
        
    // //}
    // else{
    // 	echo ("   FAIL   :(");
    // }




?>