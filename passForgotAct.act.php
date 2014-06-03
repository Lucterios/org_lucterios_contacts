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
// --- Last modification: Date 04 March 2010 23:58:16 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('CORE/users.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Mot de passe perdu
//@PARAM@ mail


//@LOCK:0

function passForgotAct($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "passForgotAct",$Params ,"mail"))!=null)
	return $ret;
$mail=getParams($Params,"mail",0);
try {
$xfer_result=new Xfer_Container_Acknowledge("org_lucterios_contacts","passForgotAct",$Params);
$xfer_result->Caption="Mot de passe perdu";
//@CODE_ACTION@
require_once('extensions/org_lucterios_contacts/mailerFunctions.inc.php');
$result=false;

$DBPersonne=new DBObj_org_lucterios_contacts_personnePhysique;
$DBPersonne->whereAdd("org_lucterios_contacts_personneAbstraite.mail='$mail'");
$DBPersonne->whereAdd('user>0');
$DBPersonne->find();
while ($DBPersonne->fetch()) {
	$DBObjusers=$DBPersonne->getField('user');
	if ($DBObjusers->actif=='o') {
		$newpass=passwordGenerator();
		$DBObjusers->ChangePWD($newpass);
		sendNewConnection($DBPersonne->mail,$DBObjusers->login,$newpass);
		$result=true;
	}
}

if ($result)
	$xfer_result->message("Nouveau mot de passe envoyé à '$mail'");
else
	$xfer_result->message("Aucun utilisateur enregistré avec ce courriel!",XFER_DBOX_WARNING);
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
