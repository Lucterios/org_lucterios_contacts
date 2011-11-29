<?php
// 	This file is part of Diacamma, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// 	Thanks to have payed a retribution for using this module.
// 
// 	Diacamma is free software; you can redistribute it and/or modify
// 	it under the terms of the GNU General Public License as published by
// 	the Free Software Foundation; either version 2 of the License, or
// 	(at your option) any later version.
// 
// 	Diacamma is distributed in the hope that it will be useful,
// 	but WITHOUT ANY WARRANTY; without even the implied warranty of
// 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// 	GNU General Public License for more details.
// 
// 	You should have received a copy of the GNU General Public License
// 	along with Lucterios; if not, write to the Free Software
// 	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
// Action file write by SDK tool
// --- Last modification: Date 15 November 2011 19:46:31 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Liste des personnes physiques
//@PARAM@ FiltrecodPostal=0
//@PARAM@ IsSearch=0


//@LOCK:0

function personnePhysique_APAS_List($Params)
{
$FiltrecodPostal=getParams($Params,"FiltrecodPostal",0);
$IsSearch=getParams($Params,"IsSearch",0);
$self=new DBObj_org_lucterios_contacts_personnePhysique();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","personnePhysique_APAS_List",$Params);
$xfer_result->Caption="Liste des personnes physiques";
//@CODE_ACTION@
$img = new Xfer_Comp_Image('img');
$img->setLocation(0,0,1,2);
$xfer_result->addComponent($img);
$lbl = new Xfer_Comp_LabelForm("titre");
$lbl->setLocation(1,0,2);
$xfer_result->addComponent($lbl);
if($IsSearch != 0) {
	$img->setValue('contactPhyiqueFind.png');
	$self->setForSearch($Params,"org_lucterios_contacts_personnePhysique.nom,org_lucterios_contacts_personnePhysique.prenom");
	include_once("CORE/DBFind.inc.php");
	$lbl->setValue("{[center]}{[bold]}Résultat de la recherche{[/bold]}{[newline]}{[newline]}".DBFind::getCriteriaText($self,$Params)."{[/center]}");
	$xfer_result->Caption = 'Résultat de recherche';
}
else {
	$img->setValue('contactPhyique.png');
	$lbl->setValue("{[center]}{[bold]}Liste des personnes physiques{[/bold]}{[/center]}");
	if( is_integer($FiltrecodPostal) && ($FiltrecodPostal == 0)) {
		$local_struct = new DBObj_org_lucterios_contacts_personneMorale;
		$local_struct->get(1);
		$FiltrecodPostal = $local_struct->codePostal;
	}
	$lbl = new Xfer_Comp_LabelForm('filtre');
	$lbl->setValue("{[italic]}Filtrer par code postal{[/italic]}");
	$lbl->setLocation(1,1);
	$xfer_result->addComponent($lbl);
	$comp = new Xfer_Comp_Edit('FiltrecodPostal');
	$comp->setValue($FiltrecodPostal);
	$comp->setAction($xfer_result->getRefreshAction());
	$comp->setLocation(2,1);
	$xfer_result->addComponent($comp);
	$q = "SELECT org_lucterios_contacts_personnePhysique.* ";
	$q .= "FROM org_lucterios_contacts_personnePhysique,org_lucterios_contacts_personneAbstraite ";
	$q .= "WHERE ( org_lucterios_contacts_personnePhysique.superId=org_lucterios_contacts_personneAbstraite.id )  AND ( org_lucterios_contacts_personneAbstraite.codePostal like '".$FiltrecodPostal."%') ";
	$q .= "ORDER BY org_lucterios_contacts_personnePhysique.nom,org_lucterios_contacts_personnePhysique.prenom ";
	$self->query($q);
}
$mNbLines=$self->N;
$grid = $self->getGrid($Params);
$grid->setLocation(0,2,3);
if($IsSearch != 0) {
	$xfer_result->m_context['CLASSNAME']="DBObj_org_lucterios_contacts_personnePhysique";
	$xfer_result->m_context['PARAMNAME']="personnePhysique";
	$DBAbstract=new DBObj_org_lucterios_contacts_personneAbstraite;
	$grid->addAction($DBAbstract->newAction("_Fusionner","","SelectMerge", FORMTYPE_MODAL, CLOSE_NO,SELECT_MULTI));
	$grid->addAction($self->newAction("_Supprimer","suppr.png","Del", FORMTYPE_MODAL, CLOSE_NO,SELECT_SINGLE));
}
$xfer_result->addComponent($grid);

$DBPhysique=new DBObj_org_lucterios_contacts_personnePhysique;
if($IsSearch != 0) {
	$DBPhysique->setForSearch($Params,"org_lucterios_contacts_personnePhysique.nom,org_lucterios_contacts_personnePhysique.prenom");
}
else {
	$q = "SELECT org_lucterios_contacts_personnePhysique.* ";
	$q .= "FROM org_lucterios_contacts_personnePhysique,org_lucterios_contacts_personneAbstraite ";
	$q .= "WHERE ( org_lucterios_contacts_personnePhysique.superId=org_lucterios_contacts_personneAbstraite.id )  AND ( org_lucterios_contacts_personneAbstraite.codePostal like '".$FiltrecodPostal."%') ";
	$q .= "ORDER BY org_lucterios_contacts_personnePhysique.nom,org_lucterios_contacts_personnePhysique.prenom ";
	$DBPhysique->query($q);
}
$link = $DBPhysique->getEmailLink($DBPhysique);
$link->setLocation(2,3);
$xfer_result->addComponent($link);
$lbl = new Xfer_Comp_LabelForm("nb");
$lbl->setLocation(0,3,2);
$lbl->setValue("Nombre total : ".$mNbLines);
$xfer_result->addComponent($lbl);
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
