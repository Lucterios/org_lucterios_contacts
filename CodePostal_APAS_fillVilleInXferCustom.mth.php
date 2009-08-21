<?php
//
//  This file is part of Lucterios.
//
//  Lucterios is free software; you can redistribute it and/or modify
//  it under the terms of the GNU General Public License as published by
//  the Free Software Foundation; either version 2 of the License, or
//  (at your option) any later version.
//
//  Lucterios is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//  GNU General Public License for more details.
//
//  You should have received a copy of the GNU General Public License
//  along with Lucterios; if not, write to the Free Software
//  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
//
//	Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
//
// Method file write by SDK tool
// --- Last modification: Date 25 May 2008 17:39:42 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/CodePostal.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ codePostal
//@PARAM@ ville
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xferResult

function CodePostal_APAS_fillVilleInXferCustom(&$self,$codePostal,$ville,$posX,$posY,$xferResult)
{
//@CODE_ACTION@
$act_modif = new Xfer_Action('Modifier','',$xferResult->m_extension,$xferResult->m_action, FORMTYPE_REFRESH, CLOSE_NO, SELECT_NONE);
$obj_cp = $xferResult->getComponents('codePostal');
$obj_cp->setAction($act_modif);
List($villes,$pays) = $self->getVillePays($codePostal);
$lbl = new Xfer_Comp_LabelForm('lblville');
$lbl->setValue('{[bold]}Ville{[/bold]}');
$lbl->setLocation($posX,$posY);
$xferResult->addComponent($lbl);
if( count($villes) == 0) {
	$edit = new Xfer_Comp_Edit('ville');
	$edit->setValue($ville);
	$edit->setLocation($posX+1,$posY);
	$xferResult->addComponent($edit);
	$pays = "";
}
else {
	$select = new Xfer_Comp_Select('ville');
	$select->setSelect($villes);
	$select->setValue($ville);
	$select->setLocation($posX+1,$posY);
	$xferResult->addComponent($select);
}
return $pays;
//@CODE_ACTION@
}

?>
