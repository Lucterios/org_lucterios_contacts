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
// --- Last modification: Date 17 March 2009 22:35:48 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Nos coordonnées
//@PARAM@ 


//@LOCK:0

function StructureLocal($Params)
{
try {
$xfer_result=new Xfer_Container_Custom("org_lucterios_contacts","StructureLocal",$Params);
$xfer_result->Caption="Nos coordonnées";
//@CODE_ACTION@
$xfer_result->m_context['personneMorale'] = 1;
$contact = new DBObj_org_lucterios_contacts_personneMorale;
$contact->get(1);

$xfer_result = $contact->show(0,1,$xfer_result);
$title = $xfer_result->getComponents('title_personne');
$title->setValue('{[center]}{[bold]}Coordonnées de notre structure{[newline]}et de nos responsables{[/bold]}{[/center]}');
$img=$xfer_result->getComponents('img');
$img->setValue('nousContact.png');

$xfer_result->addAction($contact->newAction('_Modifier','edit.png','AddModify', FORMTYPE_MODAL, CLOSE_NO));
$xfer_result->addAction(new Xfer_Action('_Imprimer','print.png','org_lucterios_contacts','ImpressionLocal',FORMTYPE_MODAL, CLOSE_NO));
$xfer_result->addAction($contact->newAction('_Fermer','close.png'));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
