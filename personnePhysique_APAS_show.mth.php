<?php
// This file is part of Lucterios, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// Thanks to have payed a donation for using this module.
// 
// Lucterios is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
// 
// Lucterios is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Lucterios; if not, write to the Free Software
// Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// Method file write by Lucterios SDK tool

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@

//@DESC@Voir un personne physique
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function personnePhysique_APAS_show(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$img = new Xfer_Comp_Image("img");
$img->setLocation($posX,$posY);
$img->setValue("contactPhyique.png");
$xfer_result->addComponent($img);
$lbl = new Xfer_Comp_LabelForm("title");
$lbl->setLocation($posX+1,$posY++,5);
$lbl->setValue("{[bold]}{[center]}{[newline]}Personne physique{[/center]}{[/bold]}");
$xfer_result->addComponent($lbl);
//
$xfer_result->setDBObject($self,"sexe", true,$posY++,$posX);
$xfer_result->setDBObject($self,"nom", true,$posY,$posX);
$xfer_result->setDBObject($self,"prenom", true,$posY++,$posX+2);
$xfer_result = $self->Super->show($posX,$posY,$xfer_result);

$user=$self->getField('user');
$lbl = new Xfer_Comp_LabelForm("labeluser");
$lbl->setLocation($posX,$posY+10);
$lbl->setValue("{[bold]}connexion{[/bold]}");
$xfer_result->addComponent($lbl);
$lbl = new Xfer_Comp_LabelForm("user");
$lbl->setLocation($posX+1,$posY+10);
$lbl->setValue($user->getText());
$xfer_result->addComponent($lbl);

$bt_login=new Xfer_Comp_Button('buttonLogin');
if ($self->user>0)
	$bt_login->setAction($self->NewAction("Modifier l`a_lias","","login",FORMTYPE_MODAL,CLOSE_NO));
else
	$bt_login->setAction($self->NewAction("Cr�er un a_lias","","login",FORMTYPE_MODAL,CLOSE_NO));
$bt_login->setLocation($posX+2,$posY+10);
$xfer_result->addComponent($bt_login);
$xfer_result->m_context['personnePhysique']=$self->id;

if (($xfer_result->m_action!='liaison_APAS_Fiche') || ($xfer_result->m_extension!='org_lucterios_contacts')) {
	if ($self->functions!='') {
		$lbl = new Xfer_Comp_LabelForm("labelresponsable");
		$lbl->setLocation($posX,$posY+11);
		$lbl->setValue("{[bold]}Responsabilit�{[/bold]}");
		$xfer_result->addComponent($lbl);
		$lbl = new Xfer_Comp_LabelForm("responsable");
		$lbl->setLocation($posX+1,$posY+11,2);
		$lbl->setValue($self->functions);
		$xfer_result->addComponent($lbl);
	}
	$DBLiaison=new DBObj_org_lucterios_contacts_liaison;
	$grid=$DBLiaison->getGridPhysique($self->id, $Params);
	if ($grid->mNbLines>0) {
		$lbl = new Xfer_Comp_LabelForm("labelstructures");
		$lbl->setLocation($posX,$posY+12);
		$lbl->setValue("{[bold]}Structure(s){[/bold]}");
		$xfer_result->addComponent($lbl);
		$grid->setLocation($posX,$posY+12,6);
		$xfer_result->addComponent($grid);
	}
}

return $xfer_result;
//@CODE_ACTION@
}

?>
