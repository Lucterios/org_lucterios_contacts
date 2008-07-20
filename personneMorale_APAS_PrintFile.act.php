<?php
// Action file write by SDK tool
// --- Last modification: Date 16 June 2008 21:51:54 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@
//@XFER:print
require_once('CORE/xfer_printing.inc.php');
//@XFER:print@


//@DESC@Imprimer un personneMorale
//@PARAM@ 
//@INDEX:personneMorale


//@LOCK:0

function personneMorale_APAS_PrintFile($Params)
{
$self=new DBObj_org_lucterios_contacts_personneMorale();
$personneMorale=getParams($Params,"personneMorale",-1);
if ($personneMorale>=0) $self->get($personneMorale);
try {
$xfer_result=&new Xfer_Container_Print("org_lucterios_contacts","personneMorale_APAS_PrintFile",$Params);
$xfer_result->Caption="Imprimer un personneMorale";
//@CODE_ACTION@
require_once"CORE/PrintAction.inc.php";
$print_action = new PrintAction("org_lucterios_contacts","personneMorale_APAS_Fiche",$Params);
$print_action->largeur_page = 297;
$print_action->hauteur_page = 210;
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
