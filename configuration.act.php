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
// --- Last modification: Date 05 March 2010 19:47:29 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/fonctions.tbl.php');
require_once('extensions/org_lucterios_contacts/typesMorales.tbl.php');
require_once('CORE/extension_params.tbl.php');
require_once('CORE/groups.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Configuration des contacts
//@PARAM@ 

//@TRANSACTION:

//@LOCK:0

function configuration($Params)
{

global $connect;
$connect->begin();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","configuration",$Params);
$xfer_result->Caption="Configuration des contacts";
//@CODE_ACTION@
$xfer_result->newTab("Paramètres");
$DBParam=new DBObj_CORE_extension_params;
$params=$DBParam->getParameters("org_lucterios_contacts");

$img=new  Xfer_Comp_Image('imgParams');
$img->setValue('contactsConfig.png');
$img->setLocation(0,0);
$xfer_result->addComponent($img);
$lab = new Xfer_Comp_LabelForm("titleParams");
$lab->setValue("{[newline]}{[center]}{[bold]}Paramètres des contacts{[/bold]}{[/center]}");
$lab->setLocation(1,0,2);
$xfer_result->addComponent($lab);

$lab = new Xfer_Comp_LabelForm("defaultGrouplbl");
$lab->setValue("{[bold]}Groupe par défaut{[/bold]}");
$lab->setLocation(1,1);
$xfer_result->addComponent($lab);
$Grp=new DBObj_CORE_groups;
$Grp->get($params['defaultGroup']);
$lab = new Xfer_Comp_LabelForm("defaultGroup");
$lab->setValue($Grp->toText());
$lab->setLocation(2,1);
$xfer_result->addComponent($lab);

$lab = new Xfer_Comp_LabelForm("defaultTypelbl");
$lab->setValue("{[bold]}Catégorie par défaut{[/bold]}");
$lab->setLocation(1,2);
$xfer_result->addComponent($lab);
$Type=new DBObj_org_lucterios_contacts_typesMorales;
$Type->get($params['defaultType']);
$lab = new Xfer_Comp_LabelForm("defaultType");
$lab->setValue($Type->toText());
$lab->setLocation(2,2);
$xfer_result->addComponent($lab);

$lab = new Xfer_Comp_LabelForm("defaultFunctionlbl");
$lab->setValue("{[bold]}Fonction par défaut{[/bold]}");
$lab->setLocation(1,3);
$xfer_result->addComponent($lab);
$Fct=new DBObj_org_lucterios_contacts_fonctions;
$Fct->get($params['defaultFunction']);
$lab = new Xfer_Comp_LabelForm("defaultFunction");
$lab->setValue($Fct->toText());
$lab->setLocation(2,3);
$xfer_result->addComponent($lab);

$lab = new Xfer_Comp_Button("Params");
$lab->setValue("_Modifier");
$lab->setLocation(0,4,3);
$lab->setAction(new Xfer_Action('Modifier','edit.png','org_lucterios_contacts','ChangeParams',FORMTYPE_MODAL,CLOSE_NO));
$xfer_result->addComponent($lab);

$xfer_result->newTab("Fonctions et responsabilités");

$DBFunction=new DBObj_org_lucterios_contacts_fonctions;
$img = new Xfer_Comp_Image('img');
$img->setValue('contactFonction.png');
$img->setLocation(0,0);
$xfer_result->addComponent($img);
$img = new Xfer_Comp_LabelForm('title');
$img->setValue('{[newline]}{[center]}{[undeline]}{[bold]}Liste des fonctions{[/bold]}{[/undeline]}{[/center]}');
$img->setLocation(1,0);
$xfer_result->addComponent($img);
$DBFunction->find();
$grid = new Xfer_Comp_Grid("fonction");
$grid->setDBObject($DBFunction,array("nom"));
$grid->addAction($DBFunction->newAction("_Ajouter","add.png","ajout", FORMTYPE_MODAL, CLOSE_NO, SELECT_NONE));
$grid->addAction($DBFunction->newAction("_Supprimer","suppr.png","suppr", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
$grid->setLocation(0,1,2);
$grid->setSize(200,500);
$xfer_result->addComponent($grid);
$lbl = new Xfer_Comp_LabelForm("nb");
$lbl->setLocation(0,2,2);
$lbl->setValue("Nombre de fonctions affichés : ". count($grid->m_records));
$xfer_result->addComponent($lbl);

$xfer_result->newTab("Catégories de personnes morales");

$DBCategorie=new DBObj_org_lucterios_contacts_typesMorales;
$img = new Xfer_Comp_Image('img');
$img->setValue('contactCategorie.png');
$img->setLocation(0,0);
$xfer_result->addComponent($img);
$img = new Xfer_Comp_LabelForm('title');
$img->setValue('{[newline]}{[center]}{[underline]}{[bold]}Liste des catégories{[/bold]}{[/underline]}{[/center]}');
$img->setLocation(1,0);
$xfer_result->addComponent($img);
$DBCategorie->find();
$grid = new Xfer_Comp_Grid("typeMorale");
$grid->setDBObject($DBCategorie,array("nom"));
$grid->addAction($DBCategorie->newAction("_Ajouter","add.png","ajout", FORMTYPE_MODAL, CLOSE_NO, SELECT_NONE));
$grid->addAction($DBCategorie->newAction("_Supprimer","suppr.png","suppr", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
$grid->setLocation(0,1,2);
$grid->setSize(200,500);
$xfer_result->addComponent($grid);
$lbl = new Xfer_Comp_LabelForm("nb");
$lbl->setLocation(0,2,2);
$lbl->setValue("Nombre de types affichés : ". count($grid->m_records));
$xfer_result->addComponent($lbl);

$xfer_result->addAction( new Xfer_Action("_Fermer","close.png"));
//@CODE_ACTION@
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	throw $e;
}
return $xfer_result;
}

?>
