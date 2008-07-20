<?php
// Action file write by SDK tool
// --- Last modification: Date 25 May 2008 17:42:25 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/typesMorales.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Liste des catégories de personnes morales
//@PARAM@ 


//@LOCK:0

function typesMorales_APAS_liste($Params)
{
$self=new DBObj_org_lucterios_contacts_typesMorales();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","typesMorales_APAS_liste",$Params);
$xfer_result->Caption="Liste des catégories de personnes morales";
//@CODE_ACTION@
$img = new Xfer_Comp_Image('img');
$img->setValue('contactCategorie.png');
$img->setLocation(0,0);
$xfer_result->addComponent($img);
$img = new Xfer_Comp_LabelForm('title');
$img->setValue('{[center]}{[underline]}{[bold]}Liste des catégories{[/bold]}{[/underline]}{[/center]}');
$img->setLocation(1,0);
$xfer_result->addComponent($img);
$self->find();
$grid = new Xfer_Comp_Grid("typeMorale");
$grid->setDBObject($self,array("nom"));
$grid->addAction($self->newAction("_Ajouter","add.png","ajout", FORMTYPE_MODAL, CLOSE_NO, SELECT_NONE));
$grid->addAction($self->newAction("_Supprimer","suppr.png","suppr", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
$grid->setLocation(0,1,2);
$grid->setSize(200,500);
$xfer_result->addComponent($grid);
$lbl = new Xfer_Comp_LabelForm("nb");
$lbl->setLocation(0,2,2);
$lbl->setValue("Nombre de types affichés : ". count($grid->m_records));
$xfer_result->addComponent($lbl);
$xfer_result->addAction( new Xfer_Action("_Fermer","close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
