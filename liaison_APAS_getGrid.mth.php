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
// --- Last modification: Date 04 March 2010 15:30:22 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
//@TABLES@

//@DESC@getList de liaison
//@PARAM@ personneMorale
//@PARAM@ Params

function liaison_APAS_getGrid(&$self,$personneMorale,$Params)
{
//@CODE_ACTION@
$q = "SELECT DISTINCT P.*,org_lucterios_contacts_FCT_personnePhysique_APAS_getFunctions(P.id,$personneMorale) as functions, org_lucterios_contacts_FCT_personneAbstraite_APAS_getAllTel(P.superId) as allTel ";
$q.= "FROM org_lucterios_contacts_personnePhysique P,org_lucterios_contacts_liaison L ";
$q.= "WHERE P.id=L.physique AND L.morale=".$personneMorale;
$q.= " ORDER BY L.fonction";

$DBPhys = new DBObj_org_lucterios_contacts_personnePhysique;
$DBPhys->query($q);

// creation de la grille correspondante
$grid = new Xfer_Comp_Grid("liaison_physique");
if ($personneMorale==1) {
	$grid->setDBObject($DBPhys,array("Photo".SEP_SHOW."#getPhoto","nom","prenom","functions","allTel","mail"),"",$Params);
	$grid->m_headers["Photo".SEP_SHOW."#getPhoto"]->m_type='icon';
}
else
	$grid->setDBObject($DBPhys,array("nom","prenom","functions","allTel","mail"),"",$Params);
$grid->addAction($self->newAction("_Editer","edit.png","Fiche", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
$grid->addAction($self->NewAction('_Rechercher/Ajouter','add.png','AddSearch', FORMTYPE_MODAL, CLOSE_NO, SELECT_NONE));
return $grid;
//@CODE_ACTION@
}

?>
