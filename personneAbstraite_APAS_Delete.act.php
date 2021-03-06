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
// --- Last modification: Date 14 November 2008 23:18:07 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Suppression en cascade
//@PARAM@ 
//@INDEX:abstractContact

//@TRANSACTION:

//@LOCK:0

function personneAbstraite_APAS_Delete($Params)
{
$self=new DBObj_org_lucterios_contacts_personneAbstraite();
$abstractContact=getParams($Params,"abstractContact",-1);
if ($abstractContact>=0) $self->get($abstractContact);

global $connect;
$connect->begin();
try {
$xfer_result=new Xfer_Container_Acknowledge("org_lucterios_contacts","personneAbstraite_APAS_Delete",$Params);
$xfer_result->Caption="Suppression en cascade";
//@CODE_ACTION@
if (($res=$self->canBeDelete())!=0) {
	require_once("CORE/Lucterios_Error.inc.php");
	throw new LucteriosException(IMPORTANT,"Suppression de '".$self->toText()."' impossible");
}
if ($xfer_result->confirme("Voulez vous supprimer '".$self->toText()."'?"))
	$self->deleteCascade();
//@CODE_ACTION@
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	throw $e;
}
return $xfer_result;
}

?>
