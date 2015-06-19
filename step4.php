<? 
session_start();
include ("libraries/cfg/cfg.inc.php");
include ("libraries/class/adLDAP.php");
include ("libraries/include_mail.php");
include ("libraries/include_sms.php");
include ("libraries/include_changepw.php");
  
//echo ini_get('display_errors');
// ini_set('display_errors', '1');
//print_r($_SESSION) 
//echo $_SESSION['id_card'];
if(!$_SESSION["login"]){
echo "<script>window.location='index.php'</script>";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CPF Self Unlock/Reset Password</title>
<link href="css/sap.css" rel="stylesheet" type="text/css" />
<!--[if gte IE 6]><link rel="stylesheet" type="text/css" href="css/sap_ie.css" /><![endif]-->
<script type="text/javascript" src="fancybox/jquery-1.9.0.min.js"></script>
<?php include "checkidletime.php";?>
</head>
<body>

<?php
//echo $_SESSION['message'];
	include "libraries/connect.php";
	$sql_trans_perday = "SELECT * FROM log_web WHERE User_Name_Ldap='$_SESSION[user]' AND Logon_Date='$_SESSION[todaydate]' AND Result='Success'";
	$query_trans_perday = mysql_query($sql_trans_perday);
	$trans_perday = mysql_num_rows($query_trans_perday);
	if($trans_perday>2){
		echo "<script>alert('สามารถเข้าใช้งานโปรแกรมได้ 2 ครั้ง/วัน'); window.location.href='libraries/session_system_destroy.php';</script>";
		break;
	}
	else{
?>
<div id="container">
	<div id="header">
     <div class="sap_logo" align="right"><img src="images/cpf_logo.png"  width="51" height="51" /></div>
      <div class="sap_title"><a href="libraries/session_system_destroy.php"><img src="images/title2.png"/></a></div>
      <div class="unlock_logo"><img src="images/cpfit.png" width="92" height="52" /></div>
     <!--  <div class="cpf_logo"><img src="images/cpf_logo.png" width="51" height="51" /></div> -->
    </div>
    <div class="header_bar"></div>
    <div id="nav"><img src="images/nav4_over.png" width="835" height="46" usemap="#Map" border="0" />
    </div>
    <div class="nav_line">
		<?php if(isset($_SESSION['username'])&&isset($_SESSION['password'])){?>
			<div class="logout"><img src="images/logout.png" width="127" height="30" usemap="#Map2" border="0"></div>
			<map name="Map2" id="Map2">
			  <area shape="rect" coords="5,1,132,28"  href="javascript:window.location.href='libraries/session_destroy.php'" />
			</map>
		<?php } ?>
	</div>
    <div id="content5">
    	<div class="response">
    	  <table style="margin-left:30px;" width="396" border="0" cellspacing="0" cellpadding="0">
    	    <tr>
    	      <td width="396" height="70" valign="bottom" class="result">
              <? 
                  //echo $_SESSION['user_purpose'];
                  // echo $_POST['type'];
                  // var_dump(isset($_POST['type']));
                  if($_SESSION['user_purpose'] == 2)
                    echo "Your account " .$_SESSION['user']." has been unlocked";
                  else
                    echo "New password has been sent to ".$_SESSION['email']." and ".$_SESSION['mobile'];
                  

            ?>
          </td>
  	      </tr>
    	   <!--  <tr>
    	      <td height="48" valign="bottom" class="result_detail"><?=$_SESSION['mobile'];?></td>
  	      </tr> -->
  	    </table>
    	</div>
  	</div>
  <div id="footer"><div class="copyright">Copyright @ 2015 by CPF</div></div>
</div>
<map name="Map" id="Map">
        <area shape="rect" coords="1,1,189,51" href="index.php" />
        <area shape="rect" coords="208,-1,397,46" href="step2.php" />
        <?
         if($_SESSION['user_purpose'] == 2){
        ?>
        <area shape="rect" coords="420,0,607,46" href="step3.php" />
        <? }
        else {
        ?>
        <area shape="rect" coords="420,0,607,46" href="javascript:void(0)" />
        <? } 
        ?>
        <area shape="rect" coords="632,-4,835,44" href="javascript:void(0)" />
</map>
<?php

  try {
    $adldap = new adLDAP();
  }
  catch (adLDAPException $e) {
    echo $e; 
    exit();   
  }
  $adldap -> connect();
    
  $adldap -> authenticate($operator_adUser,$operator_adPassword);
    //echo "yes";
  $newpw =  $adldap -> generatePassword();
  $messpw = "Your new password is \"".$newpw. "\"";
   //var_dump($newpw);
  // echo "eiei";
    //exit();
  $telnum = str_replace("-", "", $_SESSION['mobile']);
 
   include "libraries/connect.php";
      $sql_log_id = "SELECT * FROM log_web WHERE log_id='$_SESSION[log_id]'";
      //echo $sql_log_id;
      $query_log_id = mysql_query($sql_log_id);
      $row_log_id = mysql_fetch_array($query_log_id);
  
    //Unlock account
    if($_SESSION['user_purpose'] == 2){
      // echo strtolower($_SESSION['user']);
        if($adldap -> user_enable(strtolower($_SESSION['user']))){
        // var_dump($adldap -> user_enable("wisanu.dis"));
        // if($adldap -> user_enable("wisanu.dis")){
           echo ("Unlock Success");
          $sql_log = "UPDATE log_web SET Result = 'Success'";
        $query_log = mysql_query($sql_log);
        //$_SESSION['log_id'] = mysql_insert_id();
        }
        else{
          echo "FAIL";
        $sql_log = "UPDATE log_web SET Result = 'Fail'";
        $query_log = mysql_query($sql_log);
        //$_SESSION['log_id'] = mysql_insert_id();
        // echo $sql_log;
        }
        // else
          // echo "<br> Failwa";
      // $adldap -> user_enable("wisanu.dis");
    }
    //Reset password
    else{
          $adldap -> user_enable(strtolower($_SESSION['user']));
          if(setPassword("cpf","svr-tdc01",strtolower($_SESSION['user']),$newpw)){
          // if(setPassword("cpf","svr-tdc01","wisanu.dis",$newpw)){
              // echo "Success Krub.";
            $sql_log = "UPDATE log_web SET Result = 'Success'";
              $query_log = mysql_query($sql_log);
             // $_SESSION['log_id'] = mysql_insert_id();
              echo $newpw;
          }
      
       
            //echo "Yeah";
          else{
            echo "FAIL";
            $sql_log = "UPDATE log_web SET Result = 'Fail'";
            $query_log = mysql_query($sql_log);
          }
        $to = $_SESSION['email'];
        $subject = 'Reset your Password';
        $message = 'Your new password for account ' . $_SESSION['user'] . ' is "' . $newpw . '"';
        $headers = 'From: adss@cpf.co.th' . "\r\n" .'X-Mailer: PHP/' . phpversion();
        mail($to, $subject, $message, $headers);
                  
          sendSMS("CPF-ADSS",$telnum,$messpw);
     
    }
   




?>
<? } ?>
</body>
</html>