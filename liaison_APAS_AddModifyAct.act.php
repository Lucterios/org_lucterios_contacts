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
// --- Last modification: Date 14 July 2009 15:55:03 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Valider un liaison
//@PARAM@ personneMorale
//@PARAM@ liaison

//@TRANSACTION:

//@LOCK:0

function liaison_APAS_AddModifyAct($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "liaison_APAS_AddModifyAct",$Params ,"personneMorale","liaison"))!=null)
	return $ret;
$personneMorale=getParams($Params,"personneMorale",0);
$liaison=getParams($Params,"liaison",0);
$self=new DBObj_org_lucterios_contacts_liaison();

global $connect;
$connect->begin();
try {
$xfer_result=new Xfer_Container_Acknowledge("org_lucterios_contacts","liaison_APAS_AddModifyAct",$Params);
$xfer_result->Caption="Valider un liaison";
//@CODE_ACTION@
if($liaison>0)$find = $self->get($liaison);
$self->setFrom($Params);
$self->morale = $personneMorale;
if($find) {
	$physique = $self->getField('physique');
	$physique->setFrom($Params);
	$physique->update();
	$self->update();
}
else {
	$physique = new DBObj_org_lucterios_contacts_personnePhysique;
	$physique->setFrom($Params);
	$self->physique = $physique->insert();
	$self->insert();
}
if( liaison<=0) {
	$xfer_result->m_context = array("personneMorale" => $personneMorale,"liaison_physique" => $physique->id);
	$xfer_result->redirectAction($self->NewAction("editer","","Fiche"));
}
//@CODE_ACTION@
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	throw $e;
}
return $xfer_result;
}

?>
