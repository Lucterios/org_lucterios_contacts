<?php
// This file is part of Lucterios/Diacamma, a software developped by 'Le Sanglier du Libre' (http://www.sd-libre.fr)
// thanks to have payed a retribution for using this module.
// 
// Lucterios/Diacamma is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
// 
// Lucterios/Diacamma is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Lucterios; if not, write to the Free Software
// Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// Action file write by Lucterios SDK tool

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/typesMorales.tbl.php');
require_once('CORE/extension_params.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Liste des personnes morales
//@PARAM@ Filtretype=-1
//@PARAM@ IsSearch=0
//@PARAM@ Filtreraison=''


//@LOCK:0

function personneMorale_APAS_List($Params)
{
$Filtretype=getParams($Params,"Filtretype",-1);
$IsSearch=getParams($Params,"IsSearch",0);
$Filtreraison=getParams($Params,"Filtreraison",'');
$self=new DBObj_org_lucterios_contacts_personneMorale();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","personneMorale_APAS_List",$Params);
$xfer_result->Caption="Liste des personnes morales";
//@CODE_ACTION@
if ($Filtretype==-1) {
	$DBParam=new DBObj_CORE_extension_params();
	$param_contacts=$DBParam->getParameters('org_lucterios_contacts');
	$Filtretype=$param_contacts['defaultType'];
}

$img = new Xfer_Comp_Image("img");
$img->setLocation(0,0,1,3);
$img->setValue("contactMoral.png");
$xfer_result->addComponent($img);
$lbl = new Xfer_Comp_LabelForm("titre");
$lbl->setLocation(1,0,2);
$xfer_result->addComponent($lbl);
if($IsSearch != 0) {
	$xfer_result->clearSearchParam();
	$self->setForSearch($Params,'raisonSociale');
	include_once("CORE/DBFind.inc.php");
	$lbl->setValue("{[center]}{[bold]}Résultat de la recherche{[/bold]}{[newline]}{[newline]}".DBFind::getCriteriaText($self,$Params)."{[/center]}");
}
else {
	$lbl->setValue("{[center]}{[bold]}Liste des personnes morales{[/bold]}{[/center]}");
	$lbl = new Xfer_Comp_LabelForm('filtre');
	$lbl->setValue("{[italic]}Filtrer par catégorie{[/italic]}");
	$lbl->setLocation(1,1);
	$xfer_result->addComponent($lbl);
	$comp = new Xfer_Comp_Select('Filtretype');
	$sub_object = new DBObj_org_lucterios_contacts_typesMorales;
	$sub_object->find();
	while($sub_object->fetch())
		$select_list[$sub_object->id] = $sub_object->toText();
	$comp->setSelect($select_list);
	$comp->setValue($Filtretype);
	$comp->setAction($self->NewAction('','','List', FORMTYPE_REFRESH, CLOSE_NO));
	$comp->setLocation(2,1);
	$comp->setSize(22,100);
	$xfer_result->addComponent($comp);
	$lbl = new Xfer_Comp_LabelForm('filtre2');
	$lbl->setValue("{[italic]}Raison sociale contenant{[/italic]}");
	$lbl->setLocation(1,2);
	$xfer_result->addComponent($lbl);
	$comp = new Xfer_Comp_Edit('Filtreraison');
	$comp->setValue($Filtreraison);
	$comp->setAction($self->NewAction('','','List', FORMTYPE_REFRESH, CLOSE_NO));
	$comp->setLocation(2,2);
	$comp->setSize(22,100);
	$xfer_result->addComponent($comp);

	if ($Filtreraison != '')
		$self->whereAdd("raisonSociale like '%".$Filtreraison."%'");
	$self->type = $Filtretype;
	$self->orderBy('raisonSociale');
	$self->find();
}
$grid = $self->getGrid($Params);
$grid->setLocation(0,3,3);
if($IsSearch != 0) {
	$xfer_result->m_context['CLASSNAME']="DBObj_org_lucterios_contacts_personneMorale";
	$xfer_result->m_context['PARAMNAME']="personneMorale";
	$DBAbstract=new DBObj_org_lucterios_contacts_personneAbstraite;
	$grid->addAction($DBAbstract->newAction("_Fusionner","","SelectMerge", FORMTYPE_MODAL, CLOSE_NO,SELECT_MULTI));
	$grid->addAction($self->newAction("_Supprimer","suppr.png","Del", FORMTYPE_MODAL, CLOSE_NO,SELECT_SINGLE));
}
$xfer_result->addComponent($grid);
$lbl = new Xfer_Comp_LabelForm("nb");
$lbl->setLocation(0,4,2);
$lbl->setValue("Nombre total : ".$grid->mNbLines);
$xfer_result->addComponent($lbl);

$DBMoral=new DBObj_org_lucterios_contacts_personneMorale;
if($IsSearch != 0) {
	$DBMoral->setForSearch($Params,'raisonSociale');
}
else {
	$DBMoral->type = $Filtretype;
	$DBMoral->orderBy('raisonSociale');
	$nb=$DBMoral->find();
}
$link = $DBMoral->getEmailLink($DBMoral);
$link->setLocation(2,4);
$xfer_result->addComponent($link);

$xfer_result->addAction($self->newAction("_Imprimer","print.png","PrintList", FORMTYPE_MODAL, CLOSE_NO));
$xfer_result->addAction($self->newAction("_Etiquettes","print.png","PrintEtiquettes", FORMTYPE_MODAL, CLOSE_NO));
if($IsSearch != 0)$xfer_result->addAction($self->NewAction("Nouvelle _Recherche","search.png","Search", FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction( new Xfer_Action("_Fermer","close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
