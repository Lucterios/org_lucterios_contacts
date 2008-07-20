<?php
// Action file write by SDK tool
// --- Last modification: Date 18 June 2008 22:25:55 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/fonctions.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Ajouter une fonction
//@PARAM@ 


//@LOCK:0

function fonctions_APAS_ajout($Params)
{
$self=new DBObj_org_lucterios_contacts_fonctions();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","fonctions_APAS_ajout",$Params);
$xfer_result->Caption="Ajouter une fonction";
//@CODE_ACTION@
$img = new Xfer_Comp_Image('img');
$img->setValue('contactFonction.png');
$img->setLocation(0,0,1,2);
$xfer_result->addComponent($img);
$xfer_result->setDBObject($self, null, false,0,1);
$xfer_result->addAction( new Xfer_Action("Annuler","cancel.png"));
$xfer_result->addAction($self->NewAction("Ajouter","ok.png","ajouteract"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
