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
// --- Last modification: Date 05 March 2010 22:02:22 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('CORE/extension_params.tbl.php');
require_once('CORE/users.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Nouveau contact
//@PARAM@ login

//@TRANSACTION:

//@LOCK:0

function newContactAct($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "newContactAct",$Params ,"login"))!=null)
	return $ret;
$login=getParams($Params,"login",0);

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_contacts","newContactAct",$Params);
$xfer_result->Caption="Nouveau contact";
//@CODE_ACTION@
$DBUser=new DBObj_CORE_users;
$DBUser->login=$login;
if ($DBUser->find()) {
	$xfer_result->m_context['error']='Alias déjà utilisé!';
	$xfer_result->redirectAction(new Xfer_Action('','','org_lucterios_contacts','newContact',FORMTYPE_MODAL, CLOSE_YES));
} else {
	$DBPhysique=new DBObj_org_lucterios_contacts_personnePhysique;
	$DBPhysique->setFrom($Params);
	$DBMoral=new DBObj_org_lucterios_contacts_personneMorale;
	$DBMoral->setFrom($Params);
	$pattern = '^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$';
	if (!eregi($pattern, $DBPhysique->mail)){
		$xfer_result->m_context['error']='Courriel invalide!';
		$xfer_result->redirectAction(new Xfer_Action('','','org_lucterios_contacts','newContact',FORMTYPE_MODAL, CLOSE_YES));
	}
	else {
		$DBParam=new DBObj_CORE_extension_params;
		$params_contacts=$DBParam->getParameters("org_lucterios_contacts");

		require_once('extensions/org_lucterios_contacts/mailerFunctions.inc.php');
		$newpass=passwordGenerator();

		$DBUser=new DBObj_CORE_users;
		$DBUser->login=$login;
		$DBUser->realName=$DBPhysique->toText();
		$DBUser->groupId=$params_contacts['defaultGroup'];
		$DBUser->pass=md5($newpass);
		$DBUser->actif='o';
		$DBUser->insert();

		$DBPhysique->user=$DBUser->id;
		$DBPhysique->insert();
		if ($DBMoral->raisonSociale!='') {
			$DBMoral->type=$params_contacts['defaultType'];
			$DBMoral->insert();
			$DBlink=new DBObj_org_lucterios_contacts_liaison;
			$DBlink->physique=$DBPhysique->id;
			$DBlink->morale=$DBMoral->id;
			$DBlink->fonction=$params_contacts['defaultFunction'];
			$DBlink->insert();
		}

		sendNewConnection($DBPhysique->mail,$login,$newpass);
		$xfer_result->message("Nouveau contact créé.{[newline]}Le mot de passe est transmis par courriel.");
	}
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
