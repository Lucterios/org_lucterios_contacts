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
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY// Method file write by SDK tool
// --- Last modification: Date 25 May 2012 4:26:44 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ posY
//@PARAM@ xfer_result

function personneAbstraite_APAS_searchContact(&$self,$posY,$xfer_result)
{
//@CODE_ACTION@
if (isset($xfer_result->m_context['classname']))
	$classname=$xfer_result->m_context['classname'];
else if (!isset($xfer_result->classRoot))
	$classname='org_lucterios_contacts/personneAbstraite';
else
	$classname=$xfer_result->classRoot;
$lbl=new  Xfer_Comp_LabelForm("type");
$lbl->setLocation(0,$posY);
$lbl->setValue("{[bold]}Type de contact{[/bold]}");
$xfer_result->addComponent($lbl);
$select=new Xfer_Comp_Select('classname');
if (!isset($xfer_result->classRoot))
	$xfer_result->classRoot='org_lucterios_contacts/personneAbstraite';
$includeParent=true;
$select->fillByDaughterList($xfer_result->classRoot,$classname,$includeParent);
$select->setLocation(1,$posY,2);
$select->setAction($xfer_result->getRefreshAction('refresh'));
$xfer_result->addComponent($select);

list($file,$class_name)=DBObj_Abstract::getTableAndClass($classname);
include_once $file;
$contact=new $class_name;
$Fields=$contact->findFields();
foreach($Fields as $ExtractName)
	$ExtractFields[]=$ExtractName;

$xfer_result->setSearchGUI($contact,$ExtractFields,$posY+1,0,"{[bold]}Le type de contact{[/bold]} est '".$contact->Title."'");
return $xfer_result;
//@CODE_ACTION@
}

?>
