<?php
// 	This file is part of Lucterios/Diacamma, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// 	Thanks to have payed a retribution for using this module.
// 
// 	Lucterios/Diacamma is free software; you can redistribute it and/or modify
// 	it under the terms of the GNU General Public License as published by
// 	the Free Software Foundation; either version 2 of the License, or
// 	(at your option) any later version.
// 
// 	Lucterios/Diacamma is distributed in the hope that it will be useful,
// 	but WITHOUT ANY WARRANTY; without even the implied warranty of
// 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// 	GNU General Public License for more details.
// 
// 	You should have received a copy of the GNU General Public License
// 	along with Lucterios; if not, write to the Free Software
// 	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY// Action file write by SDK tool
// --- Last modification: Date 27 February 2012 6:21:32 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Recherche des personnes physiques en doublon
//@PARAM@ 


//@LOCK:0

function personnePhysique_APAS_rechercheDoublon($Params)
{
$self=new DBObj_org_lucterios_contacts_personnePhysique();
try {
$xfer_result=new Xfer_Container_Custom("org_lucterios_contacts","personnePhysique_APAS_rechercheDoublon",$Params);
$xfer_result->Caption="Recherche des personnes physiques en doublon";
//@CODE_ACTION@
$img=new  Xfer_Comp_Image("img");
$img->setLocation(0,0);
$img->setValue("contactPhyiqueFind.png");
$xfer_result->addComponent($img);
$lbl=new  Xfer_Comp_LabelForm("titre");
$lbl->setLocation(1,0,10);
$xfer_result->addComponent($lbl);
$lbl->setValue("{[center]}{[bold]}Liste des personnes physiques doublonnées{[/bold]}{[/center]}");

$self->query("SELECT p1.*,a.* FROM org_lucterios_contacts_personnePhysique p1,org_lucterios_contacts_personneAbstraite a
WHERE (SELECT count(*) FROM org_lucterios_contacts_personnePhysique p2 WHERE p2.nom like p1.nom and p2.prenom like p1.prenom)>1 AND p1.superId=a.id
ORDER BY p1.nom,p1.prenom");

$grid = $self->getGrid($Params,false);
$grid->setLocation(0,2,8);
$xfer_result->m_context['CLASSNAME']="DBObj_org_lucterios_contacts_personnePhysique";
$xfer_result->m_context['PARAMNAME']="personnePhysique";
$DBAbstract=new DBObj_org_lucterios_contacts_personneAbstraite;
$grid->addAction($DBAbstract->newAction("_Fusionner","","SelectMerge", FORMTYPE_MODAL, CLOSE_NO,SELECT_MULTI));
$grid->addAction($self->newAction("_Supprimer","suppr.png","Del", FORMTYPE_MODAL, CLOSE_NO,SELECT_SINGLE));
$xfer_result->addComponent($grid);

$lbl=new Xfer_Comp_LabelForm("nb");
$lbl->setLocation(0, 4,3);
$lbl->setValue("Nombre total : ".$grid->mNbLines);
$xfer_result->addComponent($lbl);

$xfer_result->addAction(new Xfer_Action("_Fermer", "close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
