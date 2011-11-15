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
// Method file write by SDK tool
// --- Last modification: Date 15 November 2011 0:18:02 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@

//@DESC@Preparation à l'envoie d'un rapport par email
//@PARAM@ xfer_result
//@PARAM@ printmodel
//@PARAM@ title
//@PARAM@ writeMode
//@PARAM@ printRef
//@PARAM@ fileName
//@PARAM@ body

function personneAbstraite_APAS_prepareSendReport(&$self,$xfer_result,$printmodel,$title,$writeMode,$printRef,$fileName,$body)
{
//@CODE_ACTION@
$DBMoral=new DBObj_org_lucterios_contacts_personneMorale;
$DBMoral->get(1);
$body.='{[newline]}';
$body.=$DBMoral->toText().'{[newline]}';
$body.=$DBMoral->adresse.'{[newline]}';
$body.=$DBMoral->codePostal." ".$DBMoral->ville.'{[newline]}';
$body.=$DBMoral->mail.'{[newline]}';

$img=new Xfer_Comp_Image('sendMail');
$img->setValue('sendmail.png');
$img->setLocation(0,0,1,4);
$xfer_result->addComponent($img);

$lbl=new Xfer_Comp_LabelForm('lbldest');
$lbl->setValue('{[bold]}Destinataire{[/bold]}');
$lbl->setLocation(1,1);
$xfer_result->addComponent($lbl);
$lbl=new Xfer_Comp_LabelForm('dest');
$lbl->setValue($self->mail);
$lbl->setLocation(2,1);
$xfer_result->addComponent($lbl);

$lbl=new Xfer_Comp_LabelForm('Lblsubjet');
$lbl->setValue('{[bold]}Sujet{[/bold]}');
$lbl->setLocation(1,2);
$xfer_result->addComponent($lbl);
$edt=new Xfer_Comp_Edit('sujet');
$edt->setValue($title);
$edt->setLocation(2,2);
$xfer_result->addComponent($edt);

$lbl=new Xfer_Comp_LabelForm('Lblbody');
$lbl->setValue('{[bold]}Message{[/bold]}');
$lbl->setLocation(1,3);
$xfer_result->addComponent($lbl);
$edt=new Xfer_Comp_Memo('body');
$edt->setValue($body);
$edt->setLocation(2,3);
$edt->setSize(150,300);
$xfer_result->addComponent($edt);

$lbl=new Xfer_Comp_LabelForm('lblfileattached');
$lbl->setValue('{[bold]}Fichier attaché{[/bold]}');
$lbl->setLocation(1,4);
$xfer_result->addComponent($lbl);
$lbl=new Xfer_Comp_LabelForm('fileattached');
$lbl->setValue($fileName);
$lbl->setLocation(2,4);
$xfer_result->addComponent($lbl);

$xfer_result->m_context['personne']=$self->id;
$xfer_result->m_context['PrintExtension']=$xfer_result->m_extension;
$xfer_result->m_context['PrintModel']=$printmodel;
$xfer_result->m_context['PrintTitle']=$title;
$xfer_result->m_context['PrintWriteMode']=$writeMode;
$xfer_result->m_context['PrintRef']=$printRef;
$xfer_result->m_context['PrintFileName']=$fileName;

$xfer_result->addAction($self->NewAction('_Envoyer','ok.png','sendMessageReport',FORMTYPE_MODAL,CLOSE_YES));
$xfer_result->addAction(new Xfer_Action('_Annuler','cancel.png'));
//@CODE_ACTION@
}

?>
