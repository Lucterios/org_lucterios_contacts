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
//  // Method file write by SDK tool
// --- Last modification: Date 21 November 2008 23:12:30 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@

//@DESC@Ajouter un bouton de suppression en cascade
//@PARAM@ xfer_result

function personneAbstraite_APAS_addDeleteButton(&$self,$xfer_result)
{
//@CODE_ACTION@
$nb1=count($xfer_result->m_actions);
$xfer_result->addAction($self->NewAction('_Suppression','suppr.png','Delete',FORMTYPE_MODAL,CLOSE_YES));
$nb2=count($xfer_result->m_actions);

$can_be_delete=($nb1<$nb2);
if ($can_be_delete) {
	$contact=new DBObj_org_lucterios_contacts_personneAbstraite;
	$contact->get($self->id);
	$can_be_delete=($contact->canBeDelete()==0);
}

if ($can_be_delete)
	$xfer_result->m_context['abstractContact']=$self->id;
else
	unset($xfer_result->m_actions[$nb2-1]);
return $xfer_result;
//@CODE_ACTION@
}

?>
