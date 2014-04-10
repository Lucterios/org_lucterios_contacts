<?php
// This file is part of Lucterios, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// Thanks to have payed a donation for using this module.
// 
// Lucterios is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
// 
// Lucterios is distributed in the hope that it will be useful,
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
require_once('extensions/org_lucterios_contacts/CodePostal.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Nouveau contact
//@PARAM@ login=''
//@PARAM@ error=''


//@LOCK:0

function newContact($Params)
{
$login=getParams($Params,"login",'');
$error=getParams($Params,"error",'');
try {
$xfer_result=new Xfer_Container_Custom("org_lucterios_contacts","newContact",$Params);
$xfer_result->Caption="Nouveau contact";
//@CODE_ACTION@
$DBPhysique=new DBObj_org_lucterios_contacts_personnePhysique;
$DBPhysique->setFrom($Params);
$DBMoral=new DBObj_org_lucterios_contacts_personneMorale;
$DBMoral->setFrom($Params);

$img=new Xfer_Comp_Image('img');
$img->setValue('contactMoral.png');
$img->setLocation(0, 0, 1, 3);
$xfer_result->addComponent($img);

$lab = new Xfer_Comp_LabelForm("title");
$lab->setValue("{[center]}{[italic]}{[bold]}Créaction d'une fiche contact{[/bold]}{[/italic]}{[/center]}{[newline]}");
$lab->setLocation(1,0,4);
$xfer_result->addComponent($lab);

$posX=1;
$posY=1;

$lab = new Xfer_Comp_LabelForm("lbllogin");
$lab->setValue("{[bold]}Alias de connexion{[/bold]}");
$lab->setLocation($posX,$posY);
$xfer_result->addComponent($lab);

$lab = new Xfer_Comp_Edit("login");
$lab->setLocation($posX+1,$posY++);
$lab->setValue($login);
$lab->needed=true;
$lab->m_description='Alias';
$xfer_result->addComponent($lab);

$xfer_result->setDBObject($DBPhysique,"sexe", false,$posY++,$posX);
$xfer_result->setDBObject($DBPhysique,"nom", false,$posY,$posX);
$xfer_result->setDBObject($DBPhysique,"prenom", false,$posY++,$posX+2);
$xfer_result->setDBObject($DBMoral,"raisonSociale", false,$posY++,$posX,3);
$raisonSociale=$xfer_result->getComponents("raisonSociale");
$raisonSociale->needed=false;
$xfer_result->setDBObject($DBPhysique,"mail", false,$posY++,$posX,3);
$mail=$xfer_result->getComponents("mail");
$mail->needed=true;

$xfer_result->setDBObject($DBPhysique,"adresse", false,$posY++,$posX,3);
$xfer_result->setDBObject($DBPhysique,"codePostal", false,$posY,$posX);
$DBObjCodePostal = new DBObj_org_lucterios_contacts_CodePostal;
$pays = $DBObjCodePostal->fillVilleInXferCustom($DBPhysique->codePostal,$DBPhysique->ville,$posX+2,$posY++,$xfer_result);
if($pays != '')$DBPhysique->pays = $pays;
$xfer_result->setDBObject($DBPhysique,"pays", false,$posY++,$posX);
$xfer_result->setDBObject($DBPhysique,"fixe", false,$posY,$posX);
$xfer_result->setDBObject($DBPhysique,"portable", false,$posY++,$posX+2);
$xfer_result->setDBObject($DBPhysique,"fax", false,$posY++,$posX);

$lab = new Xfer_Comp_LabelForm("error");
$lab->setValue("{[italic]}{[font color='red']}$error{[/font]}{[/italic]}");
$lab->setLocation($posX,$posY,4);
$xfer_result->addComponent($lab);

$xfer_result->addAction(new Xfer_Action('_Valider','ok.png','org_lucterios_contacts','newContactAct',FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction(new Xfer_Action('_Annuler','cancel.png'));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
