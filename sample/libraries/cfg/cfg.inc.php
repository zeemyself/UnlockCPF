<?PHP
##############################################################
#################### Web Site Config Authentication AD #######
############################################################## 
$operator_adUser = "webadmin.opr";
$operator_adPassword = "vijvp,kd@300";
$userAccountControlAlert[512] = "Invalid password : รหัสผ่านไม่ถูกต้องกรุณาลองใหม่อีกครั้ง";// Narmal_account
$userAccountControlAlert[514] = "ACCOUNTDISABLE : บัญชีรายชื่อ (Account) ที่เรียกใช้งานอยู่ในสถานะ Disable จึงไม่สามารถใช้งานได้";//ACCOUNTDISABLE
$userAccountControlAlert[528] = "ชื่อผู้ใช้งานของท่านเข้าใช้งานเกินกำหนด หากต้องการเข้าใช้งานให้แจ้งงานผ่าน Call Center : 02-625-7751-6 ในวันและเวลาทำการ"; //LOCKOUT
$userAccountControlAlert[8389120] = "PASSWORD_EXPIRED : ";    /*8388608 PASSWORD_EXPIRED */
$userAccountLock = "LOCKOUT : บัญชีรายชื่อ (Account) ที่เรียกใช้งานอยู่ในสถานะ Lockout จึงไม่สามารถใช้งานได้ กรุณาติดต่อ Call Center";
$defaultAlert = " System Error(Default), Please contact Call Center : ขณะนี้ระบบไม่สามารถใช้งานได้กรุณาแจ้ง  Call Center.";
$loginFailAlert[0] = " Verify code invalid : (คุณกรอกรหัสตัวอักษรไม่ถูกต้อง กรุณากรอกใหม่)";
$loginFailAlert[1] = " System Error, Please contact Call Center : ขณะนี้ระบบไม่สามารถใช้งานได้กรุณาแจ้ง  Call Center.";
$loginFailAlert[2] = " Your Account have problem, Please contact  call center  : Account ของคุณอยู่ในสถานะไม่ปรกติกรุณาแจ้ง  Call Center.";
$loginFailAlert[3] = " Not found your account : ไม่พบ Account ของคุณอยู่ในระบบกรุณาตรวจสอบ Account ของท่านอีกครั้งหรือกรุณาแจ้ง  Call Center.";
?>