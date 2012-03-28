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
// --- Last modification: Date 26 March 2012 6:15:04 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/CodePostal.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Ajouter Code postal/Ville
//@PARAM@ 


//@LOCK:0

function CodePostal_APAS_ajout($Params)
{
$self=new DBObj_org_lucterios_contacts_CodePostal();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","CodePostal_APAS_ajout",$Params);
$xfer_result->Caption="Ajouter Code postal/Ville";
//@CODE_ACTION@
$img = new Xfer_Comp_Image('img');
$img->setValue('contactCodePostal.png');
$img->setLocation(0,0,1,3);
$xfer_result->addComponent($img);
$xfer_result->setDBObject($self, null, false,0,1);
$xfer_result->addAction( new Xfer_Action("Annuler","cancel.png"));
$xfer_result->addAction($self->NewAction("Ajouter","ok.png","ajouteract"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
