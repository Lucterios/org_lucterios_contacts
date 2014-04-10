<?php
// This file is part of Lucterios/Diacamma, a software developped by 'Le Sanglier du Libre' (http://www.sd-libre.fr)
// thanks to have payed a retribution for using this module.
// 
// Lucterios/Diacamma is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
// 
// Lucterios/Diacamma is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Lucterios; if not, write to the Free Software
// Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// Action file write by Lucterios SDK tool

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Envoyer un courriel de test
//@PARAM@ 


//@LOCK:0

function sendTestMail($Params)
{
try {
$xfer_result=new Xfer_Container_Acknowledge("org_lucterios_contacts","sendTestMail",$Params);
$xfer_result->Caption="Envoyer un courriel de test";
//@CODE_ACTION@
$Moral=new DBObj_org_lucterios_contacts_personneMorale;
$Moral->get(1);
$from=$Moral->mail;
$mail=$from;

$contact=new DBObj_org_lucterios_contacts_personnePhysique;
if ($contact->findConnected()) {
	$mail=$contact->mail;
}

$body="Courriel d'essai";

require_once('extensions/org_lucterios_contacts/mailerFunctions.inc.php');
if (willMailSend() && ($mail!='')) {
	sendEMail($from,$mail,"Essai",str_replace(array('{[newline]}'),"\n",$body));
}
else {
	require_once("CORE/Lucterios_Error.inc.php");
	throw new LucteriosException(IMPORTANT,"Envoi impossible{[newline]}Configuration incomplète!");
}
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
