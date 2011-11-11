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
// --- Last modification: Date 16 November 2008 23:23:28 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Selectionner les personnes ? fusionner
//@PARAM@ CLASSNAME
//@PARAM@ PARAMNAME
//@PARAM@ contact=-1


//@LOCK:0

function personneAbstraite_APAS_SelectMerge($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "personneAbstraite_APAS_SelectMerge",$Params ,"CLASSNAME","PARAMNAME"))!=null)
	return $ret;
$CLASSNAME=getParams($Params,"CLASSNAME",0);
$PARAMNAME=getParams($Params,"PARAMNAME",0);
$contact=getParams($Params,"contact",-1);
$self=new DBObj_org_lucterios_contacts_personneAbstraite();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","personneAbstraite_APAS_SelectMerge",$Params);
$xfer_result->Caption="Selectionner les personnes à fusionner";
//@CODE_ACTION@
$img = new Xfer_Comp_Image("img");
$img->setLocation(0,0);
$img->setValue("contactMerge.png");
$xfer_result->addComponent($img);
$lbl = new Xfer_Comp_LabelForm("title");
$lbl->setLocation(1,0);
$lbl->setValue("{[bold]}{[center]}{[newline]}Fusion de personnes{[/center]}{[/bold]}");
$xfer_result->addComponent($lbl);

$grid=new Xfer_Comp_Grid('contact');
$grid->newHeader('select','Principale',3);
$grid->newHeader('text','Désignation',4);

$xfer_result->m_context['PERSONNE']=$Params[$PARAMNAME];
$list_id=explode(';',$Params[$PARAMNAME]);
$file_name=DBObj_Basic::getTableName(substr($CLASSNAME,6));
require_once($file_name);
foreach($list_id as $id) {
	$obj=new $CLASSNAME;
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
$grid->addAction($self->NewAction('_Changer','','SelectMerge',FORMTYPE_REFRESH,CLOSE_NO,SELECT_SINGLE));
$grid->addAction($self->NewAction('_Editer','edit.png','Fiche',FORMTYPE_MODAL,CLOSE_NO,SELECT_SINGLE));
$grid->setLocation(0,1,2);
$xfer_result->addComponent($grid);

$lbl = new Xfer_Comp_LabelForm("help");
$lbl->setLocation(0,2,2);
$lbl->setValue("{[italic]}Précisez le contact principale.{[newline]}L'outil supprimera les autres aprés avoir déplacé toutes leurs références sur l'enregistrement restant.{[/italic]}");
$xfer_result->addComponent($lbl);

$xfer_result->addAction($self->newAction("_Fusionner","","Merge", FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction( new Xfer_Action("_Fermer","close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
