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
// --- Last modification: Date 05 March 2010 19:48:20 By  ---

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


//@DESC@Changer les paramètres
//@PARAM@ 


//@LOCK:0

function ChangeParams($Params)
{
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","ChangeParams",$Params);
$xfer_result->Caption="Changer les paramètres";
//@CODE_ACTION@
$img=new  Xfer_Comp_Image('img');
$img->setValue('contactsConfig.png');
$img->setLocation(0,0);
$xfer_result->addComponent($img);
$lab = new Xfer_Comp_LabelForm("title");
$lab->setValue("{[newline]}{[center]}{[bold]}Paramètres des contacts{[/bold]}{[/center]}");
$lab->setLocation(1,0,2);
$xfer_result->addComponent($lab);

$DBParam=new DBObj_CORE_extension_params();
$params=$DBParam->getParameters('org_lucterios_contacts');
$lab = new Xfer_Comp_LabelForm("defaultGrouplbl");
$lab->setValue("{[bold]}Groupe par défaut{[/bold]}");
$lab->setLocation(1,4);
$xfer_result->addComponent($lab);
$select_grp=array();
$Grp=new DBObj_CORE_groups;
$Grp->find();
while ($Grp->fetch())
	$select_grp[$Grp->id]=$Grp->toText();
$sel = new Xfer_Comp_Select("defaultGroup");
$sel->setSelect($select_grp);
$sel->setValue($params['defaultGroup']);
$sel->setLocation(2,4,3);
$xfer_result->addComponent($sel);

$lab = new Xfer_Comp_LabelForm("defaultTypelbl");
$lab->setValue("{[bold]}Type par défaut{[/bold]}");
$lab->setLocation(1,5);
$xfer_result->addComponent($lab);
$select_Type=array();
$Type=new DBObj_org_lucterios_contacts_typesMorales;
$Type->find();
while ($Type->fetch())
	$select_Type[$Type->id]=$Type->toText();
$sel = new Xfer_Comp_Select("defaultType");
$sel->setSelect($select_Type);
$sel->setValue($params['defaultType']);
$sel->setLocation(2,5,3);
$xfer_result->addComponent($sel);

$lab = new Xfer_Comp_LabelForm("defaultFunctionlbl");
$lab->setValue("{[bold]}Fonction par défaut{[/bold]}");
$lab->setLocation(1,6);
$xfer_result->addComponent($lab);
$select_Fct=array();
$Fct=new DBObj_org_lucterios_contacts_fonctions;
$Fct->find();
while ($Fct->fetch())
	$select_Fct[$Fct->id]=$Fct->toText();
$sel = new Xfer_Comp_Select("defaultFunction");
$sel->setSelect($select_Fct);
$sel->setValue($params['defaultFunction']);
$sel->setLocation(2,6,3);
$xfer_result->addComponent($sel);


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
