<?
putenv("NLS_LANG=AMERICAN_AMERICA.UTF8");
include ("libraries/cfg/cfg.inc.php");
include ("libraries/class/adLDAP.php");




$conn = oci_connect('VOXTRONS', 'ksdew#kdlo13', 'SPSI');
$uac = "swas.kun";
$strSQL = "SELECT * FROM SMARTCR.VIEW_SR_USER WHERE  USER_ID = '$uac'";
$stid = oci_parse($conn, $strSQL);
$st_exe = oci_execute($stid,OCI_DEFAULT);
$num_row = oci_num_rows($stid);
$row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS);
var_dump($row);



?>