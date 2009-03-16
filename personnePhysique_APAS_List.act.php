<?php
// 
//     This file is part of Lucterios.
// 
//     Lucterios is free software; you can redistribute it and/or modify
//     it under the terms of the GNU General Public License as published by
//     the Free Software Foundation; either version 2 of the License, or
//     (at your option) any later version.
// 
//     Lucterios is distributed in the hope that it will be useful,
//     but WITHOUT ANY WARRANTY; without even the implied warranty of
//     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//     GNU General Public License for more details.
// 
//     You should have received a copy of the GNU General Public License
//     along with Lucterios; if not, write to the Free Software
//     Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 	Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
//  // Action file write by SDK tool
// --- Last modification: Date 16 March 2009 23:05:33 By  ---

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
	$lbl->setValue("{[center]}{[bold]}Résultat de la recherche{[/bold]}{[/center]}");
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
	$comp->setAction( new Xfer_Action('','',$xfer_result->m_extension,$xfer_result->m_action, FORMTYPE_REFRESH, CLOSE_NO));
	$comp->setLocation(2,1);
	$xfer_result->addComponent($comp);
	$q = "SELECT org_lucterios_contacts_personnePhysique.* ";
	$q .= "FROM org_lucterios_contacts_personnePhysique,org_lucterios_contacts_personneAbstraite ";
	$q .= "WHERE ( org_lucterios_contacts_personnePhysique.superId=org_lucterios_contacts_personneAbstraite.id )  AND ( org_lucterios_contacts_personneAbstraite.codePostal like '".$FiltrecodPostal."%') ";
	$q .= "ORDER BY org_lucterios_contacts_personnePhysique.nom,org_lucterios_contacts_personnePhysique.prenom ";
	$self->query($q);
}
$grid = $self->getGrid($Params);
$grid->setLocation(0,2,3);
if($IsSearch != 0) {
	$xfer_result->m_context['CLASSNAME']="DBObj_org_lucterios_contacts_personnePhysique";
	$xfer_result->m_context['PARAMNAME']="personnePhysique";
	$DBAbstract=new DBObj_org_lucterios_contacts_personneAbstraite;
	$grid->addAction($DBAbstract->newAction("_Fusionner","","SelectMerge", FORMTYPE_MODAL, CLOSE_NO,SELECT_MULTI));
}
$xfer_result->addComponent($grid);
$link = new Xfer_Comp_LinkLabel('email');
$link->setValue('Ecrire a tous');
$link->setEmailFromGrid($grid,"mail");
$link->setLocation(2,3);
$xfer_result->addComponent($link);
$lbl = new Xfer_Comp_LabelForm("nb");
$lbl->setLocation(0,3,2);
$lbl->setValue("Nombre total : ".$grid->mNbLines);
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
