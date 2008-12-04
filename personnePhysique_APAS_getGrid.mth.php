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
// --- Last modification: Date 29 November 2008 0:04:54 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@

//@DESC@getList de personne physique
//@PARAM@ Params

function personnePhysique_APAS_getGrid(&$self,$Params)
{
//@CODE_ACTION@
$grid = new Xfer_Comp_Grid("personnePhysique");
$grid->setDBObject($self,array("prenom","nom","fixe","portable","mail"),'',$Params);
$grid->addAction($self->newAction("_Editer","edit.png","Fiche", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
$grid->addAction($self->newAction("_Ajouter","add.png","AddModify", FORMTYPE_MODAL, CLOSE_NO, SELECT_NONE));
$grid->setSize(200,750);
return $grid;
//@CODE_ACTION@
}

?>
