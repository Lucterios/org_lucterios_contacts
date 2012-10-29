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
// Method file write by Lucterios SDK tool

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function personneMorale_APAS_getCurrentMoralShow(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$contact=new DBObj_org_lucterios_contacts_personnePhysique;
if ($contact->findConnected()) {
	$Q="SELECT M.* FROM org_lucterios_contacts_personneMorale M,org_lucterios_contacts_liaison L WHERE M.id<>1 AND L.morale=M.id AND L.physique=".$contact->id;
	$DBMoral=new DBObj_org_lucterios_contacts_personneMorale;
	$DBMoral->query($Q);
	$grid = new Xfer_Comp_Grid('moral');
	$grid->setDBObject($DBMoral,array("raisonSociale","fixe","fax","mail"),'',$Params);
	if (count($grid->m_records)==0) {
		require_once("CORE/Lucterios_Error.inc.php");
		throw new LucteriosException( IMPORTANT,"Vous n'avez pas de structure morale!");
	}
	else if (count($grid->m_records)==1) {
		$DBMoral=new DBObj_org_lucterios_contacts_personneMorale;
		$DBMoral->query($Q);
		$DBMoral->fetch();
		$xfer_result->m_context['personneMorale']=$DBMoral->id;
		$xfer_result->setDBObject($DBMoral,"raisonSociale", true,$posY++,$posX, 3);
		$xfer_result = $DBMoral->Super->show($posX, $posY,$xfer_result);
		$xfer_result->setDBObject($DBMoral,"siren", true,$posY+30,$posX);
		$xfer_result->addAction($DBMoral->newAction("_Modifier organisation","editMoral.png","ModifyMaStructure", FORMTYPE_MODAL, CLOSE_NO));
	}
	else {
		$grid->setSize(300,500);
		$grid->setLocation($posX, $posY);
		$grid->addAction($DBMoral->newAction("_Editer","editMoral.png","currentMoral", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
		$xfer_result->addComponent($grid);
	}
} else {
	require_once("CORE/Lucterios_Error.inc.php");
	throw new LucteriosException( IMPORTANT,"Votre connexion n'est pas liée à un contact!");
}
return $xfer_result;
//@CODE_ACTION@
}

?>
