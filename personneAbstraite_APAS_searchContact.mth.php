<?php
// Method file write by SDK tool
// --- Last modification: Date 17 September 2008 20:38:52 By  ---

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
else
	$classname='org_lucterios_contacts/personneMorale';
$lbl=new  Xfer_Comp_LabelForm("type");
$lbl->setLocation(0,$posY);
$lbl->setValue("{[bold]}Type de contact{[/bold]}");
$xfer_result->addComponent($lbl);
$select=new Xfer_Comp_Select('classname');
$select->fillByDaughterList('org_lucterios_contacts/personneAbstraite',$classname,false);
$select->setLocation(1,$posY,2);
$select->setAction(new Xfer_Action('refresh','',$xfer_result->m_extension,$xfer_result->m_action,FORMTYPE_REFRESH,CLOSE_NO,SELECT_NONE));
$xfer_result->addComponent($select);

list($ext_name,$table_name) = split('/',$classname);
$table_name = trim($table_name);
$file="extensions/$ext_name/$table_name.tbl.php";
$class_name="DBObj_".$ext_name."_".$table_name;
include_once $file;
$contact=new $class_name;
$xfer_result=$contact->finder($posY+1, true, $xfer_result);
return $xfer_result;
//@CODE_ACTION@
}

?>
