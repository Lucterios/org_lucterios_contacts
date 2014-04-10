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
// --- Last modification: Date 20 February 2012 8:45:56 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@
//@XFER:acknowledge
require_once('CORE/xfer.inc.php');
//@XFER:acknowledge@


//@DESC@Fusionne des contacts
//@PARAM@ CLASSNAME
//@PARAM@ PERSONNE
//@PARAM@ contact=-1

//@TRANSACTION:

//@LOCK:0

function personneAbstraite_APAS_Merge($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "personneAbstraite_APAS_Merge",$Params ,"CLASSNAME","PERSONNE"))!=null)
	return $ret;
$CLASSNAME=getParams($Params,"CLASSNAME",0);
$PERSONNE=getParams($Params,"PERSONNE",0);
$contact=getParams($Params,"contact",-1);
$self=new DBObj_org_lucterios_contacts_personneAbstraite();

global $connect;
$connect->begin();
try {
$xfer_result=new Xfer_Container_Acknowledge("org_lucterios_contacts","personneAbstraite_APAS_Merge",$Params);
$xfer_result->Caption="Fusionne des contacts";
//@CODE_ACTION@
$file_name=DBObj_Basic::getTableName(substr($CLASSNAME,6));
require_once($file_name);

$extraParam=array();
$list_id=explode(';',$PERSONNE);
foreach($list_id as $id) {
	$main=new DBObj_org_lucterios_contacts_personneAbstraite;
	$main->get($contact);

	$obj=new $CLASSNAME;
	$obj->get($id);
	$extraParam=$obj->getMergeExtra($extraParam, $contact);
	$sub_obj=$obj->getSuperObject('org_lucterios_contacts_personneAbstraite');
	$sub_obj_id=$sub_obj->id;
	if ($contact==-1)
		$contact=$sub_obj_id;
	if ($contact!=$sub_obj_id) {
		$other=new DBObj_org_lucterios_contacts_personneAbstraite;
		$other->get($sub_obj_id);
		$main->merge($other);
	}
}
$son=$main->getSon();
while (($son!=null) && (get_class($main)!=$CLASSNAME)) {
	$main=$son;
	$son=$main->getSon();
}
$obj->setMergeExtra($extraParam);

$xfer_result->m_context['contact']=$contact;
$xfer_result->redirectAction($self->NewAction('titre','','Fiche',FORMTYPE_MODAL,CLOSE_NO));
//@CODE_ACTION@
	$connect->commit();
}catch(Exception $e) {
	$connect->rollback();
	throw $e;
}
return $xfer_result;
}

?>
