<?php
// Action file write by SDK tool
// --- Last modification: Date 25 May 2008 17:40:35 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/fonctions.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Valider l'ajout
//@PARAM@ 

//@TRANSACTION:

//@LOCK:0

function fonctions_APAS_ajouteract($Params)
{
$self=new DBObj_org_lucterios_contacts_fonctions();

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_contacts","fonctions_APAS_ajouteract",$Params);
$xfer_result->Caption="Valider l'ajout";
//@CODE_ACTION@
$self->setFrom($Params);
$self->readonly = 'n';
$self->Insert();
//@CODE_ACTION@
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	throw $e;
}
return $xfer_result;
}

?>
