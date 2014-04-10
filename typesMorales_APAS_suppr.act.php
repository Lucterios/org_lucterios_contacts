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
// --- Last modification: Date 09 December 2008 22:30:43 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
require_once('extensions/org_lucterios_contacts/typesMorales.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Suppression de catégorie de personne morale
//@PARAM@ 
//@INDEX:typeMorale

//@TRANSACTION:

//@LOCK:2

function typesMorales_APAS_suppr($Params)
{
$self=new DBObj_org_lucterios_contacts_typesMorales();
$typeMorale=getParams($Params,"typeMorale",-1);
if ($typeMorale>=0) $self->get($typeMorale);

$self->lockRecord("typesMorales_APAS_suppr");

global $connect;
$connect->begin();
try {
$xfer_result=new Xfer_Container_Acknowledge("org_lucterios_contacts","typesMorales_APAS_suppr",$Params);
$xfer_result->Caption="Suppression de catégorie de personne morale";
$xfer_result->m_context['ORIGINE']="typesMorales_APAS_suppr";
$xfer_result->m_context['TABLE_NAME']=$self->__table;
$xfer_result->m_context['RECORD_ID']=$self->id;
//@CODE_ACTION@
if($self->readonly == 'o') {
	$xfer_result->message("Il est interdit de supprimer cette catégorie.",4);
}
else {
	if($self->canBeDelete()!=0)
		$xfer_result->message("Suppression interdite: cette catégorie est utilisé.",4);
	else if($xfer_result->confirme("Etes vous sûre de vouloir supprimer cette catégorie?")) {
		$self->deleteCascade();
	}
}
//@CODE_ACTION@
	$xfer_result->setCloseAction(new Xfer_Action('unlock','','CORE','UNLOCK',FORMTYPE_MODAL,CLOSE_YES,SELECT_NONE));
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	$self->unlockRecord("typesMorales_APAS_suppr");
	throw $e;
}
return $xfer_result;
}

?>
