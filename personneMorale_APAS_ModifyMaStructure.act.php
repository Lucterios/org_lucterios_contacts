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
// Action file write by SDK tool
// --- Last modification: Date 28 April 2011 22:06:20 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Modifier mon organisation
//@PARAM@ 
//@INDEX:personneMorale


//@LOCK:2

function personneMorale_APAS_ModifyMaStructure($Params)
{
$self=new DBObj_org_lucterios_contacts_personneMorale();
$personneMorale=getParams($Params,"personneMorale",-1);
if ($personneMorale>=0) $self->get($personneMorale);

$self->lockRecord("personneMorale_APAS_ModifyMaStructure");
try {
$xfer_result=new Xfer_Container_Custom("org_lucterios_contacts","personneMorale_APAS_ModifyMaStructure",$Params);
$xfer_result->Caption="Modifier mon organisation";
$xfer_result->m_context['ORIGINE']="personneMorale_APAS_ModifyMaStructure";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
$self->setFrom($Params);

$xfer_result->setDBObject($self,"raisonSociale", false,$posY++,$posX,3);
$xfer_result = $self->Super->edit($posX,$posY,$xfer_result);
$posY = 30;
$xfer_result->setDBObject($self,"siren", false,$posY++,$posX);

$xfer_result->addAction($self->newAction("_Ok","ok.png","ModifyMaStructureAct", FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction( new Xfer_Action("_Annuler","cancel.png"));
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
}catch(Exception $e) {
	$self->unlockRecord("personneMorale_APAS_ModifyMaStructure");
	throw $e;
}
return $xfer_result;
}

?>
