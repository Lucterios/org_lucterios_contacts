<?php
//
//  This file is part of Lucterios.
//
//  Lucterios is free software; you can redistribute it and/or modify
//  it under the terms of the GNU General Public License as published by
//  the Free Software Foundation; either version 2 of the License, or
//  (at your option) any later version.
//
//  Lucterios is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//  GNU General Public License for more details.
//
//  You should have received a copy of the GNU General Public License
//  along with Lucterios; if not, write to the Free Software
//  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
//
//	Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
//
// Action file write by SDK tool
// --- Last modification: Date 17 June 2008 20:54:44 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Ajouter/Modifier une liaison
//@PARAM@ personneMorale
//@INDEX:liaison


//@LOCK:2

function liaison_APAS_AddModify($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "liaison_APAS_AddModify",$Params ,"personneMorale"))!=null)
	return $ret;
$personneMorale=getParams($Params,"personneMorale",0);
$self=new DBObj_org_lucterios_contacts_liaison();
$liaison=getParams($Params,"liaison",-1);
if ($liaison>=0) $self->get($liaison);

$self->lockRecord("liaison_APAS_AddModify");
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","liaison_APAS_AddModify",$Params);
$xfer_result->Caption="Ajouter/Modifier une liaison";
$xfer_result->m_context['ORIGINE']="liaison_APAS_AddModify";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
if($self->id>0)$xfer_result->Caption = "Modifier une liaison";
else $xfer_result->Caption = "Ajouter une liaison";
$self->setFrom($Params);
$self->morale = $personneMorale;
$xfer_result->setDBObject($self,'morale', true,0,1);
$xfer_result->setDBObject($self,'fonction', false,1,1);
$physique = $self->getField('physique');
$physique->setFrom($Params);
$xfer_result = $physique->edit(0,2,$xfer_result);
$xfer_result->addAction($self->newAction("_Ok","ok.png","AddModifyAct", FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction( new Xfer_Action("_Annuler","cancel.png"));
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
}catch(Exception $e) {
	$self->unlockRecord("liaison_APAS_AddModify");
	throw $e;
}
return $xfer_result;
}

?>
