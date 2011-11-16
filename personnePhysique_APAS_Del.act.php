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
// --- Last modification: Date 15 November 2011 19:45:07 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Supprimer une personne physique
//@PARAM@ 
//@INDEX:personnePhysique

//@TRANSACTION:

//@LOCK:2

function personnePhysique_APAS_Del($Params)
{
$self=new DBObj_org_lucterios_contacts_personnePhysique();
$personnePhysique=getParams($Params,"personnePhysique",-1);
if ($personnePhysique>=0) $self->get($personnePhysique);

$self->lockRecord("personnePhysique_APAS_Del");

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_contacts","personnePhysique_APAS_Del",$Params);
$xfer_result->Caption="Supprimer une personne physique";
$xfer_result->m_context['ORIGINE']="personnePhysique_APAS_Del";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
if (($res=$self->canBeDelete())!=0) {
	require_once("CORE/Lucterios_Error.inc.php");
	throw new LucteriosException(IMPORTANT,"Suppression de ".$self->toText()." impossible");
}
if ($xfer_result->confirme("Voulez vous supprimer ".$self->toText()."?")) {
	$DBuser=$self->getField('user');
	if (($DBuser->id>0) && ($DBuser->canBeDelete()==0))
		$DBuser->deleteCascade();
	$self->deleteCascade();
}
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	$self->unlockRecord("personnePhysique_APAS_Del");
	throw $e;
}
return $xfer_result;
}

?>
