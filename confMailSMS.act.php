<?php
// 	This file is part of Lucterios/Diacamma, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// 	Thanks to have payed a retribution for using this module.
// 
// 	Lucterios/Diacamma is free software; you can redistribute it and/or modify
// 	it under the terms of the GNU General Public License as published by
// 	the Free Software Foundation; either version 2 of the License, or
// 	(at your option) any later version.
// 
// 	Lucterios/Diacamma is distributed in the hope that it will be useful,
// 	but WITHOUT ANY WARRANTY; without even the implied warranty of
// 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// 	GNU General Public License for more details.
// 
// 	You should have received a copy of the GNU General Public License
// 	along with Lucterios; if not, write to the Free Software
// 	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY// Action file write by SDK tool
// --- Last modification: Date 26 March 2012 6:09:29 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('CORE/extension_params.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Configuration courriel
//@PARAM@ 


//@LOCK:0

function confMailSMS($Params)
{
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","confMailSMS",$Params);
$xfer_result->Caption="Configuration courriel";
//@CODE_ACTION@
$xfer_result->newTab("Courriel");

$lab = new Xfer_Comp_LabelForm("titleParams1");
$lab->setValue("{[newline]}{[center]}{[underline]}{[bold]}Configuration d'envoie de courriels{[/bold]}{[/underline]}{[/center]}");
$lab->setLocation(1,1,5);
$xfer_result->addComponent($lab);

$ParamsDesc=array('MailSmtpServer'=>array(1,3,3),'MailSmtpUser'=>array(1,4),'MailSmtpPass'=>array(3,4),'MailConnectionMsg'=>array(1,5,3));
$DBParam=new DBObj_CORE_extension_params;
$xfer_result=$DBParam->fillCustom("org_lucterios_contacts",1,$ParamsDesc,$xfer_result);

$lab = new Xfer_Comp_Button("btnMail");
$lab->setValue("_Modifier");
$lab->setLocation(1,12);
$lab->setAction(new Xfer_Action('Modifier','edit.png','org_lucterios_contacts','ChangeParamMail',FORMTYPE_MODAL,CLOSE_NO));
$xfer_result->addComponent($lab);

$lab = new Xfer_Comp_Button("btnTestMail");
$lab->setValue("_Modifier");
$lab->setLocation(2,12,4);
$lab->setAction(new Xfer_Action('Essai','sendmail.png','org_lucterios_contacts','sendTestMail',FORMTYPE_MODAL,CLOSE_NO));
$xfer_result->addComponent($lab);

$xfer_result->newTab("Options");

$lab = new Xfer_Comp_LabelForm("titleParams3");
$lab->setValue("{[newline]}{[center]}{[underline]}{[bold]}Paramètres{[/bold]}{[/underline]}{[/center]}");
$lab->setLocation(1,1,5);
$xfer_result->addComponent($lab);

$DBParam=new DBObj_CORE_extension_params;
$xfer_result=$DBParam->fillCustom("org_lucterios_contacts",1,array('MailToConfig'=>array(1,3)),$xfer_result);

$lab = new Xfer_Comp_Button("btnOptions");
$lab->setValue("_Modifier");
$lab->setLocation(1,12,5);
$lab->setAction(new Xfer_Action('Modifier','edit.png','org_lucterios_contacts','ChangeParamOptions',FORMTYPE_MODAL,CLOSE_NO));
$xfer_result->addComponent($lab);

$xfer_result->addAction( new Xfer_Action("_Fermer","close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
