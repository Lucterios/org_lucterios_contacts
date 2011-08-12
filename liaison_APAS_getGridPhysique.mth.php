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
// Method file write by SDK tool
// --- Last modification: Date 11 August 2011 14:49:37 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
//@TABLES@

//@DESC@getList par responsable
//@PARAM@ personnePhysique
//@PARAM@ Params

function liaison_APAS_getGridPhysique(&$self,$personnePhysique,$Params)
{
//@CODE_ACTION@
$q = "SELECT DISTINCT M.*,org_lucterios_contacts_FCT_personnePhysique_APAS_getFunctions($personnePhysique,M.id) as functions ";
$q.= "FROM org_lucterios_contacts_personneMorale M,org_lucterios_contacts_liaison L ";
$q.= "WHERE M.id=L.morale AND M.id<>1 AND L.physique=".$personnePhysique;
$q.= " ORDER BY L.fonction";

global $connect;
$Qid=$connect->execute($q,true);

$grid = new Xfer_Comp_Grid("personneMorale");
$grid->addHeader('org_lucterios_contacts_personneMorale.raisonSociale','Raison sociale');
$grid->addHeader('functions','Fonctions');
$grid->setDBRows($Qid,"org_lucterios_contacts_personneMorale.id",$Params);
$DBMoral = new DBObj_org_lucterios_contacts_personneMorale;
$grid->addAction($DBMoral->newAction("_Editer","edit.png","Fiche", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
return $grid;
//@CODE_ACTION@
}

?>
