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
// --- Last modification: Date 31 January 2010 0:13:36 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@
//@XFER:print
require_once('CORE/xfer_printing.inc.php');
//@XFER:print@


//@DESC@Imprimer un personneMorale
//@PARAM@ 
//@INDEX:personneMorale


//@LOCK:0

function personneMorale_APAS_PrintFile($Params)
{
$self=new DBObj_org_lucterios_contacts_personneMorale();
$personneMorale=getParams($Params,"personneMorale",-1);
if ($personneMorale>=0) $self->get($personneMorale);
try {
$xfer_result=&new Xfer_Container_Print("org_lucterios_contacts","personneMorale_APAS_PrintFile",$Params);
$xfer_result->Caption="Imprimer un personneMorale";
//@CODE_ACTION@
$xfer_result->withTextExport=1;
if ($xfer_result->showSelector(0)) {
	require_once"CORE/PrintAction.inc.php";
	$print_action = new PrintAction("org_lucterios_contacts","personneMorale_APAS_Fiche",$Params);
	$print_action->largeur_page = 297;
	$print_action->hauteur_page = 210;
	$print_action->TabChangePage = false;
	$print_action->Extended = false;
	$print_action->Title = "Fiche descriptive";
	$xfer_result->printListing($print_action);
}
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
