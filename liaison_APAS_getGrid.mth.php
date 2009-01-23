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
// --- Last modification: Date 08 January 2009 21:48:18 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
//@TABLES@

//@DESC@getList de liaison
//@PARAM@ personneMorale

function liaison_APAS_getGrid(&$self,$personneMorale)
{
//@CODE_ACTION@
global $rootPath;
if(!isset($rootPath))$rootPath = "";

$physique = new DBObj_org_lucterios_contacts_personnePhysique;
$q = "select DISTINCT org_lucterios_contacts_personnePhysique.* FROM org_lucterios_contacts_personnePhysique,org_lucterios_contacts_liaison WHERE org_lucterios_contacts_personnePhysique.id=org_lucterios_contacts_liaison.physique AND org_lucterios_contacts_liaison.morale=".$personneMorale;
$physique->query($q);
// creation de la grille correspondante
$grid = new Xfer_Comp_Grid("liaison_physique");
if ($personneMorale==1) {
	$grid->setDBObject($physique,array("Photo".SEP_SHOW."PHOTO","nom","prenom","fonctions".SEP_SHOW."FCT","Téléphones".SEP_SHOW."TEL","mail"));
	$grid->m_headers["Photo".SEP_SHOW."PHOTO"]->m_type='icon';
}
else
	$grid->setDBObject($physique,array("nom","prenom","fonctions".SEP_SHOW."FCT","Téléphones".SEP_SHOW."TEL","mail"));
$grid->addAction($self->newAction("_Editer","edit.png","Fiche", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
$grid->addAction($self->NewAction('_Rechercher/Ajouter','add.png','AddSearch', FORMTYPE_MODAL, CLOSE_NO, SELECT_NONE));
foreach($grid->m_records as $key => $value) {
	$physique = new DBObj_org_lucterios_contacts_personnePhysique;
	$physique->get($key);
	$grid->m_records[$key]["fonctions". SEP_SHOW."FCT"] = $physique->getFonctions($personneMorale);
	$grid->m_records[$key]["Téléphones".SEP_SHOW."TEL"] = $physique->fixe."{[newline]}".$physique->portable;
	if ($personneMorale==1) {
		$abstract_id=$physique->Super->id;
		$grid->m_records[$key]["Photo".SEP_SHOW."PHOTO"] = $rootPath."usr/org_lucterios_contacts/Image_$abstract_id.jpg";
	}
}
return $grid;
//@CODE_ACTION@
}

?>
