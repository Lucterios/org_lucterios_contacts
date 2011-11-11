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
//  // library file write by SDK tool
// --- Last modification: Date 12 March 2009 23:25:06 By  ---

//@BEGIN@
/*
function org_lucterios_contacts_APAS_config(&$xfer_result) {
	// Fonction pour ajouter des composants dans la fenêtre de configuration
	require_once"extensions/org_lucterios_contacts/personneMorale.tbl.php";
	$xfer_result->m_context['personneMorale'] = 1;
	$contact = new DBObj_org_lucterios_contacts_personneMorale;
	$contact->get(1);
	$xfer_result = $contact->show(0,1,$xfer_result);
	$title = $xfer_result->getComponents('title_personne');
	$title->setValue('');
	$xfer_result->newTab("Coordonnées");
	$btn = new Xfer_Comp_Button('editer');
	$btn->setAction($contact->newAction('_Modifier','edit.png','AddModify', FORMTYPE_MODAL, CLOSE_NO));
	$btn->setLocation(0,60,2);
	$xfer_result->addComponent($btn);
}
*/
//@END@
?>
