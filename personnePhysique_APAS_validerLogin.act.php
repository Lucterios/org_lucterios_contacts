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
// --- Last modification: Date 15 November 2008 23:48:57 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('CORE/users.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Valider une connexion
//@PARAM@ newpass1
//@PARAM@ newpass2
//@INDEX:personnePhysique

//@TRANSACTION:

//@LOCK:0

function personnePhysique_APAS_validerLogin($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "personnePhysique_APAS_validerLogin",$Params ,"newpass1","newpass2"))!=null)
	return $ret;
$newpass1=getParams($Params,"newpass1",0);
$newpass2=getParams($Params,"newpass2",0);
$self=new DBObj_org_lucterios_contacts_personnePhysique();
$personnePhysique=getParams($Params,"personnePhysique",-1);
if ($personnePhysique>=0) $self->get($personnePhysique);

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_contacts","personnePhysique_APAS_validerLogin",$Params);
$xfer_result->Caption="Valider une connexion";
//@CODE_ACTION@
if($self->user>0)
	$DBObjusers=$self->getField('user');
else
	$DBObjusers=new DBObj_CORE_users;
if ((($self->user>0) || ($newpass1!= "")) && ($newpass1==$newpass2))
{
	if ($DBObjusers->ModifierUser($Params)) {
		if($self->user>0) {
			$DBObjusers->realName=$self->toText();
			$DBObjusers->update();
		}
		else {
			$DBObjusers->realName=$self->toText();
			$uid=$DBObjusers->insert();
			global $connect;
			$connect->execute("UPDATE org_lucterios_contacts_personnePhysique SET user=$uid WHERE id=$personnePhysique",true);
		}
		if ($newpass1!= "")
			$DBObjusers->ChangePWD($newpass1);
	}
	else
		$xfer_result->message("Cette connexion exists déjà!",4);
}
else if ($newpass1!=$newpass2)
	$xfer_result->message("Les mots de passe ne sont pas égaux!",4);
else
	$xfer_result->message("Le mots de passe est obligatoire!",4);
//@CODE_ACTION@
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	throw $e;
}
return $xfer_result;
}

?>
