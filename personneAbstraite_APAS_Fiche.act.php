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
// --- Last modification: Date 06 May 2009 20:38:44 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Fiche d'un contact
//@PARAM@ contact
//@PARAM@ classname=''


//@LOCK:0

function personneAbstraite_APAS_Fiche($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "personneAbstraite_APAS_Fiche",$Params ,"contact"))!=null)
	return $ret;
$contact=getParams($Params,"contact",0);
$classname=getParams($Params,"classname",'');
$self=new DBObj_org_lucterios_contacts_personneAbstraite();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","personneAbstraite_APAS_Fiche",$Params);
$xfer_result->Caption="Fiche d'un contact";
//@CODE_ACTION@
if ($classname!='') {
	list($ext_name,$table_name) = split('/',$classname);
	$table_name = trim($table_name);
	$file="extensions/$ext_name/$table_name.tbl.php";
	$class_name="DBObj_".$ext_name."_".$table_name;
	include_once $file;
	$DBcontact=new $class_name;
	$DBcontact->get($contact);
	$contact=$DBcontact->getMotherId("DBObj_org_lucterios_contacts_personneAbstraite");
}
$self->get($contact);
$xfer_result=$self->show(1,0,$xfer_result);
$xfer_result->addAction($self->newAction("_Imprimer", "print.png", "PrintFile", FORMTYPE_MODAL,CLOSE_NO));
$xfer_result->addAction(new Xfer_Action("_Fermer", "close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
