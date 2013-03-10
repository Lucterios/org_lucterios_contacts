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
// Method file write by Lucterios SDK tool

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/champPerso.tbl.php');
//@TABLES@

//@DESC@Editer un champ personalisé
//@PARAM@ posX
//@PARAM@ posY
//@PARAM@ xfer_result

function champPerso_APAS_edit(&$self,$posX,$posY,$xfer_result)
{
//@CODE_ACTION@
$lbl=new  Xfer_Comp_LabelForm("classlbl");
$lbl->setLocation($posX,$posY);
$lbl->setValue("{[bold]}Type de contact{[/bold]}");
$xfer_result->addComponent($lbl);
$select=new Xfer_Comp_Select('class');
$select->fillByDaughterList("org_lucterios_contacts/personneAbstraite",$self->class,true);
$select->setLocation($posX+1,$posY++);
$xfer_result->addComponent($select);

$xfer_result->setDBObject($self,"description",false,$posY++,$posX);
$xfer_result->setDBObject($self,"type",false,$posY++,$posX);
$type=$xfer_result->getComponents('type');
$type->JavaScript="
var value=current.getValue();
parent.get('ValMinlbl').setVisible((value=='1') || (value=='2'));
parent.get('ValMin').setVisible((value=='1') || (value=='2'));
parent.get('ValMaxlbl').setVisible((value=='1') || (value=='2'));
parent.get('ValMax').setVisible((value=='1') || (value=='2'));
parent.get('ValPreclbl').setVisible(value=='2');
parent.get('ValPrec').setVisible(value=='2');
parent.get('ValMultilbl').setVisible(value=='0');
parent.get('ValMulti').setVisible(value=='0');
parent.get('ValEnumlbl').setVisible(value=='4');
parent.get('ValEnum').setVisible(value=='4');
";

if ($self->param!='') {
	$cmd='$champParam='.$self->param.';';
	eval($cmd);
}
else
	$champParam=array();

$lbl=new Xfer_Comp_LabelForm('ValMinlbl');
$lbl->setValue("{[bold]}Min{[/bold]}");
$lbl->setLocation(1,4);
$xfer_result->addComponent($lbl);
$edt=new Xfer_Comp_Float('ValMin',1,1000,2);
$edt->setValue($champParam['Min']);
$edt->setLocation(2,4);
$xfer_result->addComponent($edt);

$lbl=new Xfer_Comp_LabelForm('ValMaxlbl');
$lbl->setValue("{[bold]}Max{[/bold]}");
$lbl->setLocation(1,5);
$xfer_result->addComponent($lbl);
$edt=new Xfer_Comp_Float('ValMax',1,1000,2);
$edt->setValue($champParam['Max']);
$edt->setLocation(2,5);
$xfer_result->addComponent($edt);

$lbl=new Xfer_Comp_LabelForm('ValPreclbl');
$lbl->setValue("{[bold]}Précision{[/bold]}");
$lbl->setLocation(1,6);
$xfer_result->addComponent($lbl);
$edt=new Xfer_Comp_Float('ValPrec',1,10,0);
$edt->setValue($champParam['Prec']);
$edt->setLocation(2,6);
$xfer_result->addComponent($edt);

$lbl=new Xfer_Comp_LabelForm('ValMultilbl');
$lbl->setValue("{[bold]}Multiligne{[/bold]}");
$lbl->setLocation(1,7);
$xfer_result->addComponent($lbl);
$edt=new Xfer_Comp_Check('ValMulti');
$edt->setValue($champParam['Multi']);
$edt->setLocation(2,7);
$xfer_result->addComponent($edt);

$lbl=new Xfer_Comp_LabelForm('ValEnumlbl');
$lbl->setValue("{[bold]}Enumeration{[/bold]}");
$lbl->setLocation(1,8);
$xfer_result->addComponent($lbl);
$edt=new Xfer_Comp_Edit('ValEnum');
$enum_val="";
foreach($champParam['Enum'] as $enum_item)
	$enum_val.=$enum_item.";";
if ($enum_val!='') $enum_val=substr($enum_val,0,-1);
$edt->setValue($enum_val);
$edt->setLocation(2,8);
$xfer_result->addComponent($edt);

return $xfer_result;
//@CODE_ACTION@
}

?>
