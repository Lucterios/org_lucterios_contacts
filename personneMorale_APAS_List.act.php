<?php
// Action file write by SDK tool
// --- Last modification: Date 25 May 2008 19:43:57 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/typesMorales.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Liste des personnes morales
//@PARAM@ Filtretype=1
//@PARAM@ IsSearch=0


//@LOCK:0

function personneMorale_APAS_List($Params)
{
$Filtretype=getParams($Params,"Filtretype",1);
$IsSearch=getParams($Params,"IsSearch",0);
$self=new DBObj_org_lucterios_contacts_personneMorale();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","personneMorale_APAS_List",$Params);
$xfer_result->Caption="Liste des personnes morales";
//@CODE_ACTION@
$img = new Xfer_Comp_Image("img");
$img->setLocation(0,0,1,2);
$img->setValue("contactMoral.png");
$xfer_result->addComponent($img);
$lbl = new Xfer_Comp_LabelForm("titre");
$lbl->setLocation(1,0,2);
$xfer_result->addComponent($lbl);
if($IsSearch != 0) {
	$self->setForSearch($Params);
	$lbl->setValue("{[center]}{[bold]}R�sultat de la recherche{[/bold]}{[/center]}");
}
else {
	$lbl->setValue("{[center]}{[bold]}Liste des personnes morales{[/bold]}{[/center]}");
	$lbl = new Xfer_Comp_LabelForm('filtre');
	$lbl->setValue("{[italic]}Filtrer par cat�gorie{[/italic]}");
	$lbl->setLocation(1,1);
	$xfer_result->addComponent($lbl);
	$comp = new Xfer_Comp_Select('Filtretype');
	$sub_object = new DBObj_org_lucterios_contacts_typesMorales;
	$sub_object->find();
	while($sub_object->fetch())$select_list[$sub_object->id] = $sub_object->toText();
	$comp->setSelect($select_list);
	$comp->setValue($Filtretype);
	$comp->setAction($self->NewAction('','','List', FORMTYPE_REFRESH, CLOSE_NO));
	$comp->setLocation(2,1);
	$xfer_result->addComponent($comp);
	$self->type = $Filtretype;
	$self->find();
}
$grid = $self->getGrid("personneMorale");
$grid->setLocation(0,2,3);
$xfer_result->addComponent($grid);
$lbl = new Xfer_Comp_LabelForm("nb");
$lbl->setLocation(0,3,2);
$lbl->setValue("Nombre affich�s : ". count($grid->m_records));
$xfer_result->addComponent($lbl);
$link = new Xfer_Comp_LinkLabel('email');
$link->setValue('Ecrire a tous');
$link->setEmailFromGrid($grid,"mail");
$link->setLocation(2,3);
$xfer_result->addComponent($link);
$xfer_result->addAction($self->newAction("_Imprimer","print.png","PrintList", FORMTYPE_MODAL, CLOSE_NO));
if($IsSearch != 0)$xfer_result->addAction($self->NewAction("Nouvelle _Recherche","search.png","Search", FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction( new Xfer_Action("_Fermer","close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>