<?php
// Action file write by SDK tool
// --- Last modification: Date 16 June 2008 21:52:04 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@
//@XFER:print
require_once('CORE/xfer_printing.inc.php');
//@XFER:print@


//@DESC@Imprimer une personne physique
//@PARAM@ 
//@INDEX:personnePhysique


//@LOCK:0

function personnePhysique_APAS_PrintFile($Params)
{
$self=new DBObj_org_lucterios_contacts_personnePhysique();
$personnePhysique=getParams($Params,"personnePhysique",-1);
if ($personnePhysique>=0) $self->get($personnePhysique);
try {
$xfer_result=&new Xfer_Container_Print("org_lucterios_contacts","personnePhysique_APAS_PrintFile",$Params);
$xfer_result->Caption="Imprimer une personne physique";
//@CODE_ACTION@
require_once"CORE/PrintAction.inc.php";
$print_action = new PrintAction("org_lucterios_contacts","personnePhysique_APAS_Fiche",$Params);
$print_action->TabChangePage = false;
$print_action->Extended = false;
$print_action->Title = "Fiche descriptive";
$xfer_result->printListing($print_action);
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
