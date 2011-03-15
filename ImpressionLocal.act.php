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
// --- Last modification: Date 13 March 2011 14:49:10 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
//@TABLES@
//@XFER:print
require_once('CORE/xfer_printing.inc.php');
//@XFER:print@


//@DESC@Imprimer nos contacts
//@PARAM@ 


//@LOCK:0

function ImpressionLocal($Params)
{
try {
$xfer_result=&new Xfer_Container_Print("org_lucterios_contacts","ImpressionLocal",$Params);
$xfer_result->Caption="Imprimer nos contacts";
//@CODE_ACTION@
require_once"CORE/PrintAction.inc.php";
$print_action = new PrintAction("org_lucterios_contacts","StructureLocal",$Params);
$print_action->largeur_page = 297;
$print_action->hauteur_page = 210;
$print_action->TabChangePage = false;
$print_action->Extended = true;
$print_action->Title = "Nos coordonnées";
$xfer_result->printListing($print_action);
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
