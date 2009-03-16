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
// --- Last modification: Date 16 March 2009 22:20:42 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('CORE/users.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Mon compte
//@PARAM@ 


//@LOCK:0

function FichePersonnel($Params)
{
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","FichePersonnel",$Params);
$xfer_result->Caption="Mon compte";
//@CODE_ACTION@
$contact=new DBObj_org_lucterios_contacts_personnePhysique;
if ($contact->findConnected()) {
	$contact->show(0, 1, $xfer_result);
	$title = $xfer_result->getComponents('title');
	$title->setValue('{[center]}{[bold]}{[newline]}Mon compte personnel{[/bold]}{[/center]}');
	$xfer_result->addAction($contact->NewAction('_Modifier','edit.png','EditerPerso',FORMTYPE_MODAL,CLOSE_YES));

	$liaison=new DBObj_org_lucterios_contacts_liaison;
	$liaison->physique=$contact->id;
	if ($liaison->find()==1) {
		$liaison->fetch();
		if ($liaison->morale>1) {
			$xfer_result->m_context['personneMorale']=$liaison->morale;
			$contact_moral=new DBObj_org_lucterios_contacts_personneMorale;
			$xfer_result->addAction($contact_moral->NewAction('Ma _structure','','MaStructure',FORMTYPE_MODAL,CLOSE_YES));
		}
	}
}
else {
	global $LOGIN_ID;
	$user=new DBObj_CORE_users;
	$user->get($LOGIN_ID);
	$user->show(0,1,$xfer_result);
	$xfer_result->addAction($user->NewAction('_Modifier','edit.png','AddModify',FORMTYPE_MODAL,CLOSE_NO));
}
$img=$xfer_result->getComponents('img');
$img->setValue('fiche.png');
$xfer_result->addAction( new Xfer_Action("_Fermer","close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
