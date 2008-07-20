<?php
// Action file write by SDK tool
// --- Last modification: Date 16 June 2008 22:06:45 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Rechercher une personne morale
//@PARAM@ 


//@LOCK:0

function personneMorale_APAS_Search($Params)
{
$self=new DBObj_org_lucterios_contacts_personneMorale();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","personneMorale_APAS_Search",$Params);
$xfer_result->Caption="Rechercher une personne morale";
//@CODE_ACTION@
$img = new Xfer_Comp_Image("img");
$img->setValue("contactMoralFind.png");
$img->setLocation(0,0);
$xfer_result->addComponent($img);
$img = new Xfer_Comp_LabelForm("title");
$img->setValue("{[center]}{[underline]}{[bold]}Séléctionnez vos critères de recherche{[/bold]}{[/underline]}{[/center]}");
$img->setLocation(1,0,2);
$xfer_result->addComponent($img);
$xfer_result->m_context["IsSearch"] = 1;
$xfer_result = $self->finder(1,0,$xfer_result);
$xfer_result->addAction($self->NewAction("_Rechercher","search.png","List", FORMTYPE_NOMODAL, CLOSE_YES));
$xfer_result->addAction($self->NewAction("_Annuler","cancel.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
