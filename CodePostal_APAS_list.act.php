<?php
// Action file write by SDK tool
// --- Last modification: Date 25 May 2008 17:38:59 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
require_once('extensions/org_lucterios_contacts/CodePostal.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Liste des Codes Postaux/Villes
//@PARAM@ FiltrecodPostal=0


//@LOCK:0

function CodePostal_APAS_list($Params)
{
$FiltrecodPostal=getParams($Params,"FiltrecodPostal",0);
$self=new DBObj_org_lucterios_contacts_CodePostal();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","CodePostal_APAS_list",$Params);
$xfer_result->Caption="Liste des Codes Postaux/Villes";
//@CODE_ACTION@
$img = new Xfer_Comp_Image('img');
$img->setValue('contactCodePostal.png');
$img->setLocation(0,0,1,2);
$xfer_result->addComponent($img);
if($FiltrecodPostal == 0) {
	$local_struct = new DBObj_org_lucterios_contacts_personneMorale;
	$local_struct->get(1);
	$FiltrecodPostal = $local_struct->codePostal;
}
$lbl = new Xfer_Comp_LabelForm('filtre');
$lbl->setValue("{[bold]}Filtrer par code postal{[/bold]}");
$lbl->setLocation(1,0);
$xfer_result->addComponent($lbl);
$comp = new Xfer_Comp_Edit('FiltrecodPostal');
$comp->setValue($FiltrecodPostal);
$comp->setAction($self->newAction('','','list', FORMTYPE_REFRESH, CLOSE_NO));
$comp->setLocation(1,1);
$xfer_result->addComponent($comp);
$q = "SELECT * FROM org_lucterios_contacts_CodePostal WHERE codePostal like '".$FiltrecodPostal."%' ORDER BY codePostal, ville ";
$self->query($q);
$grid = new Xfer_Comp_Grid("codePostal");
$grid->setDBObject($self);
$grid->addAction($self->newAction("_Ajouter","add.png","ajout", FORMTYPE_MODAL, CLOSE_NO, SELECT_NONE));
$grid->addAction($self->newAction("_Supprimer","suppr.png","suppr", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
$grid->setLocation(0,2,3);
$grid->setSize(200,500);
$xfer_result->addComponent($grid);
$lbl = new Xfer_Comp_LabelForm("nb");
$lbl->setLocation(0,3,3);
$lbl->setValue("Nombre de codes postaux/villes affichés : ". count($grid->m_records));
$xfer_result->addComponent($lbl);
$xfer_result->addAction( new Xfer_Action("_Fermer","close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
