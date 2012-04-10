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
// Action file write by SDK tool
// --- Last modification: Date 10 April 2012 20:54:54 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('CORE/extension_params.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Changer la configuration courriel
//@PARAM@ 


//@LOCK:0

function ChangeParamMail($Params)
{
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","ChangeParamMail",$Params);
$xfer_result->Caption="Changer la configuration courriel";
//@CODE_ACTION@
$img=new  Xfer_Comp_Image('img');
$img->setValue('contacts.png');
$img->setLocation(0,0,1,3);
$xfer_result->addComponent($img);
$lab = new Xfer_Comp_LabelForm("title");
$lab->setValue("{[center]}{[underline]}Configuration courriel{[/underline]}{[/center]}{[newline]}");
$lab->setLocation(1,0,5);
$xfer_result->addComponent($lab);

$ParamsDesc=array('MailSmtpServer'=>array(1,3,3),'MailSmtpSecurity'=>array(1,4),'MailSmtpPort'=>array(3,4),'MailSmtpUser'=>array(1,5),'MailSmtpPass'=>array(3,5),'MailConnectionMsg'=>array(1,6,3));
$DBParam=new DBObj_CORE_extension_params();
$xfer_result=$DBParam->fillCustom("org_lucterios_contacts",0,$ParamsDesc,$xfer_result);

$xfer_result->m_context['extensionName']="org_lucterios_contacts";
$xfer_result->addAction($DBParam->NewAction('_Valider','ok.png','validerModif',FORMTYPE_MODAL,CLOSE_YES));

$xfer_result->addAction(new Xfer_Action("_Annuler","cancel.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
