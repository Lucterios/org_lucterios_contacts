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
//  // Method file write by SDK tool
// --- Last modification: Date 15 November 2008 2:08:04 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@

//@DESC@creation de grille
//@PARAM@ className
//@PARAM@ listId
//@PARAM@ contact

function personneAbstraite_APAS_mergeGrid(&$self,$className,$listId,$contact)
{
//@CODE_ACTION@
$abstract=array();
$list_id=split(';',$listid);
foreach($list_id as $id) {
	$obj=new $className;
	$obj->get($id);
	$sub_obj=$obj->getSuperObject('org_lucterios_contacts_personneAbstraite');
	$abstract[]=$sub_obj;
	if ($Selected==-1)
		$Selected=$sub_obj->id;
}

$grid=new Xfer_Comp_Grid('contact');
$grid->newHeader('select','Référence',3);
$grid->newHeader('text','Désignation',4);

$list_id=split(';',$listId);
foreach($list_id as $id) {
	$obj=new $className;
	$obj->get($id);
	$sub_obj=$obj->getSuperObject('org_lucterios_contacts_personneAbstraite');
	$sub_obj_id=$sub_obj->id;
	if ($contact==-1)
		$contact=$sub_obj_id;
	$grid->setValue($sub_obj_id,'select',$sub_obj_id==$contact?'Oui':'Non');
	$grid->setValue($sub_obj_id,'text',$obj->toText());
}
if (count($grid->m_records)<2) {
	require_once("CORE/Lucterios_Error.inc.php");
	throw new LucteriosException(IMPORTANT,"Fusion impossible: vous devez selectionner plusieurs enregistrement");
}
$grid->setSize(200,400);
$grid->addAction($self->NewAction('_Editer','edit.png','Fiche',FORMTYPE_MODAL,CLOSE_NO,SELECT_SINGLE));
return $grid;
//@CODE_ACTION@
}

?>
