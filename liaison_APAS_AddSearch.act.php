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
// --- Last modification: Date 08 March 2010 19:44:30 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('CORE/extension_params.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Rechercher une personne pour ajout
//@PARAM@ personneMorale


//@LOCK:0

function liaison_APAS_AddSearch($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "liaison_APAS_AddSearch",$Params ,"personneMorale"))!=null)
	return $ret;
$personneMorale=getParams($Params,"personneMorale",0);
$self=new DBObj_org_lucterios_contacts_liaison();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","liaison_APAS_AddSearch",$Params);
$xfer_result->Caption="Rechercher une personne pour ajout";
//@CODE_ACTION@
$DBParam=new DBObj_CORE_extension_params();
$param_contacts=$DBParam->getParameters('org_lucterios_contacts');
$self->fonction=$param_contacts['defaultFunction'];
$self->morale = $personneMorale;
$xfer_result->setDBObject($self,'morale', true,0,0,3);
$xfer_result->setDBObject($self,'fonction', false,1,0,3);
$physique = $self->getField('physique');
$physique->setFrom($Params);
$fields=$physique->findFields();
$xfer_result->setSearchGUI($physique,$fields,2);
$xfer_result->addAction($self->newAction("_Ok","ok.png","AddSearchyAct", FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction($self->newAction("_Créer","add.png","AddModify", FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction( new Xfer_Action("_Annuler","cancel.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
