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
// --- Last modification: Date 14 December 2008 19:07:51 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Valider la recherche
//@PARAM@ personneMorale


//@LOCK:0

function liaison_APAS_AddSearchyAct($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "liaison_APAS_AddSearchyAct",$Params ,"personneMorale"))!=null)
	return $ret;
$personneMorale=getParams($Params,"personneMorale",0);
$self=new DBObj_org_lucterios_contacts_liaison();
try {
$xfer_result=new Xfer_Container_Custom("org_lucterios_contacts","liaison_APAS_AddSearchyAct",$Params);
$xfer_result->Caption="Valider la recherche";
//@CODE_ACTION@
$self->setFrom($Params);
$self->morale = $personneMorale;
$xfer_result->setDBObject($self,'morale', true,0,1);
$xfer_result->setDBObject($self,'fonction', true,1,1);

$physique = new DBObj_org_lucterios_contacts_personnePhysique;
$xfer_result->clearSearchParam();
$physique->setForSearch($Params);
$lbl = new Xfer_Comp_LabelForm("titreFind");
$lbl->setLocation(1,2,2);
include_once("CORE/DBFind.inc.php");
$lbl->setValue(DBFind::getCriteriaText($physique,$Params));
$xfer_result->addComponent($lbl);

$grid = new Xfer_Comp_Grid('personnePhysique');
$grid->setDBObject($physique,5,'',$Params);
$grid->setLocation(1,3,2);
$grid->setSize(300,600);
$grid->addAction($physique->NewAction('_Fiche','edit.png','Fiche', FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
$grid->addAction($self->NewAction('_Selectionner','ok.png','AddSearchSelect', FORMTYPE_MODAL, CLOSE_YES, SELECT_SINGLE));
$grid->addAction($self->NewAction('_Créer nouveau','add.png','AddModify', FORMTYPE_MODAL, CLOSE_YES, SELECT_NONE));
$grid->addAction( new Xfer_Action("_Fermer","close.png"));
foreach($Params as $name_p => $value_p) {
	if(( substr($name_p,-7) == '_select') && (((int)$value_p)>0) && ($Params[ substr($name_p,0,-7).'_value1'] != '')) {
		$field_name = substr($name_p,0,-7);
		$xfer_result->m_context[$field_name] = $Params[ substr($name_p,0,-7).'_value1'];
	}
}
$xfer_result->addComponent($grid);
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
