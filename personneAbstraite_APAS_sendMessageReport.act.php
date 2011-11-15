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
// --- Last modification: Date 15 November 2011 0:15:43 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Envoye de rapport par courriel
//@PARAM@ PrintExtension
//@PARAM@ PrintModel
//@PARAM@ PrintTitle
//@PARAM@ PrintWriteMode
//@PARAM@ PrintRef
//@PARAM@ PrintFileName
//@PARAM@ sujet
//@PARAM@ body
//@INDEX:personne


//@LOCK:0

function personneAbstraite_APAS_sendMessageReport($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "personneAbstraite_APAS_sendMessageReport",$Params ,"PrintExtension","PrintModel","PrintTitle","PrintWriteMode","PrintRef","PrintFileName","sujet","body"))!=null)
	return $ret;
$PrintExtension=getParams($Params,"PrintExtension",0);
$PrintModel=getParams($Params,"PrintModel",0);
$PrintTitle=getParams($Params,"PrintTitle",0);
$PrintWriteMode=getParams($Params,"PrintWriteMode",0);
$PrintRef=getParams($Params,"PrintRef",0);
$PrintFileName=getParams($Params,"PrintFileName",0);
$sujet=getParams($Params,"sujet",0);
$body=getParams($Params,"body",0);
$self=new DBObj_org_lucterios_contacts_personneAbstraite();
$personne=getParams($Params,"personne",-1);
if ($personne>=0) $self->get($personne);
try {
$xfer_result=&new Xfer_Container_Acknowledge("org_lucterios_contacts","personneAbstraite_APAS_sendMessageReport",$Params);
$xfer_result->Caption="Envoye de rapport par courriel";
//@CODE_ACTION@
require_once('CORE/xfer_printing.inc.php');
$xfer_print=new Xfer_Container_Print($PrintExtension,'');
if (!$xfer_print->selectReport($PrintModel,$Params,$PrintTitle,$PrintWriteMode,$PrintRef)) {
	require_once "CORE/Lucterios_Error.inc.php";
	throw new LucteriosException(IMPORTANT,"Rapport inconnu!");
}
$PrintContent=$xfer_print->getBodyContent(false);

$DBMoral=new DBObj_org_lucterios_contacts_personneMorale;
$DBMoral->get(1);

require_once('extensions/org_lucterios_contacts/mailerFunctions.inc.php');
sendEMail($DBMoral->mail,$self->mail,$sujet,str_replace('{[newline]}',"\n",$body),$PrintContent,$PrintFileName);
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
