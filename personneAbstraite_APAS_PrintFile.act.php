<?php
// Action file write by SDK tool
// --- Last modification: Date 13 September 2008 17:21:37 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@
//@XFER:print
require_once('CORE/xfer_printing.inc.php');
//@XFER:print@


//@DESC@Imprimer un contact
//@PARAM@ 
//@INDEX:personneAbstraite


//@LOCK:0

function personneAbstraite_APAS_PrintFile($Params)
{
$self=new DBObj_org_lucterios_contacts_personneAbstraite();
$personneAbstraite=getParams($Params,"personneAbstraite",-1);
if ($personneAbstraite>=0) $self->get($personneAbstraite);
try {
$xfer_result=&new Xfer_Container_Print("org_lucterios_contacts","personneAbstraite_APAS_PrintFile",$Params);
$xfer_result->Caption="Imprimer un contact";
//@CODE_ACTION@
require_once "CORE/PrintAction.inc.php";
$print_action=new PrintAction("org_lucterios_contacts","personneAbstraite_APAS_PrintFile",$Params);
$print_action->TabChangePage=false;
$print_action->Extended=false;
$print_action->Title="Fiche descriptive";
$xfer_result->printListing($print_action);
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
