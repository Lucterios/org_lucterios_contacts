<?php
// Action file write by SDK tool
// --- Last modification: Date 18 June 2008 22:26:10 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/fonctions.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Liste des fonctions
//@PARAM@ 


//@LOCK:0

function fonctions_APAS_list($Params)
{
$self=new DBObj_org_lucterios_contacts_fonctions();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","fonctions_APAS_list",$Params);
$xfer_result->Caption="Liste des fonctions";
//@CODE_ACTION@
$img = new Xfer_Comp_Image('img');
$img->setValue('contactFonction.png');
$img->setLocation(0,0);
$xfer_result->addComponent($img);
$img = new Xfer_Comp_LabelForm('title');
$img->setValue('{[center]}{[undeline]}{[bold]}Liste des fonctions{[/bold]}{[/undeline]}{[/center]}');
$img->setLocation(1,0);
$xfer_result->addComponent($img);
$self->find();
$grid = new Xfer_Comp_Grid("fonction");
$grid->setDBObject($self,array("nom"));
$grid->addAction($self->newAction("_Ajouter","add.png","ajout", FORMTYPE_MODAL, CLOSE_NO, SELECT_NONE));
$grid->addAction($self->newAction("_Supprimer","suppr.png","suppr", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
$grid->setLocation(0,1,2);
$grid->setSize(200,500);
$xfer_result->addComponent($grid);
$lbl = new Xfer_Comp_LabelForm("nb");
$lbl->setLocation(0,2,2);
$lbl->setValue("Nombre de fonctions affichés : ". count($grid->m_records));
$xfer_result->addComponent($lbl);
$xfer_result->addAction( new Xfer_Action("_Fermer","close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
