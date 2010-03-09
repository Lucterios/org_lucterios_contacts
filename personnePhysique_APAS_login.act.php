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
// --- Last modification: Date 08 March 2010 19:38:53 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('CORE/extension_params.tbl.php');
require_once('CORE/users.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Modifier la connexion
//@PARAM@ 
//@INDEX:personnePhysique


//@LOCK:0

function personnePhysique_APAS_login($Params)
{
$self=new DBObj_org_lucterios_contacts_personnePhysique();
$personnePhysique=getParams($Params,"personnePhysique",-1);
if ($personnePhysique>=0) $self->get($personnePhysique);
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","personnePhysique_APAS_login",$Params);
$xfer_result->Caption="Modifier la connexion";
//@CODE_ACTION@
if($self->user>0) {
	$DBObjusers=$self->getField('user');
	$xfer_result->Caption="Modifier la connexion";
}
else {
	$DBParam=new DBObj_CORE_extension_params();
	$param_contacts=$DBParam->getParameters('org_lucterios_contacts');

	$DBObjusers=new DBObj_CORE_users;
	$DBObjusers->realName=$self->toText();
	$DBObjusers->groupId=$param_contacts['defaultGroup'];
	$xfer_result->Caption="Créer une connexion";
}
$xfer_result->WithActif=true;
$xfer_result=$DBObjusers->Formulaire($xfer_result);

require_once('extensions/org_lucterios_contacts/mailerFunctions.inc.php');
if (willMailSend() && ($self->mail!='')) {
	$lbl=new Xfer_Comp_LabelForm('lbl_sendPass');
	$lbl->setLocation(0,10,2);
	$lbl->setValue("{[italic]}Générer un mot de passe et l'envoyer par courriel{[/italic]}");
	$xfer_result->addComponent($lbl);

	$check=new Xfer_Comp_Check('sendPass');
	$check->setLocation(2,10);
	$check->JavaScript="
var type=current.getValue();
parent.get('newpass1').setEnabled(type!='o');
parent.get('newpass2').setEnabled(type!='o');
";
	$xfer_result->addComponent($check);
}
$xfer_result->addAction($self->NewAction("_OK","ok.png","validerLogin"));
$xfer_result->addAction($self->NewAction("_Annuler","cancel.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
