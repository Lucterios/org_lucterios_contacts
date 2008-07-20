<?php
// Method file write by SDK tool
// --- Last modification: Date 18 June 2008 23:03:51 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@

//@DESC@Voir un personneMorale
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function personneMorale_APAS_show(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$img = new Xfer_Comp_Image("img");
$img->setLocation($posX,$posY);
$img->setValue("contactMoral.png");
$xfer_result->addComponent($img);
$lbl = new Xfer_Comp_LabelForm("title_personne");
$lbl->setLocation($posX+1,$posY++,5);
$lbl->setValue("{[bold]}{[center]}{[newline]}Personne morale{[/center]}{[/bold]}");
$xfer_result->addComponent($lbl);
//
$xfer_result->newTab("Coordonnées",1);
$xfer_result->setDBObject($self,"raisonSociale", true,$posY++,$posX,3);
$xfer_result = $self->Super->show($posX,$posY,$xfer_result);
$posY = 30;
$xfer_result->setDBObject($self,"identifiant", true,$posY,$posX);
if($self->id != 1)$xfer_result->setDBObject($self,"type", true,$posY++,$posX+2);
else $posY++;
$xfer_result->setDBObject($self,"siren", true,$posY++,$posX);
//
$xfer_result->newTab("Résponsables",2);
$liaison_physiques = new DBObj_org_lucterios_contacts_liaison;
$grid = $liaison_physiques->getGrid($self->id);
$grid->setLocation($posX,$posY++,6);
$xfer_result->addComponent($grid);
$lbl = new Xfer_Comp_LabelForm("nbresponsable");
$lbl->setLocation($posX,$posY);
$lbl->setValue("Nombre de responsables : ". count($grid->m_records));
$xfer_result->addComponent($lbl);
if(!isset($xfer_result->m_context['NOPLAN'])) {
	$link = new Xfer_Comp_LinkLabel('email');
	$link->setValue('Ecrire a tous');
	$link->setEmailFromGrid($grid,"mail");
	$link->setLocation($posX+1,$posY);
	$xfer_result->addComponent($link);
}
return $xfer_result;
//@CODE_ACTION@
}

?>
