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
// --- Last modification: Date 15 November 2008 2:03:32 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Fusionner des contacts moraux
//@PARAM@ personneMorale
//@PARAM@ contact=-1


//@LOCK:0

function personneMorale_APAS_SelectMerge($Params)
{
if (($ret=checkParams("org_lucterios_contacts", "personneMorale_APAS_SelectMerge",$Params ,"personneMorale"))!=null)
	return $ret;
$personneMorale=getParams($Params,"personneMorale",0);
$contact=getParams($Params,"contact",-1);
$self=new DBObj_org_lucterios_contacts_personneMorale();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","personneMorale_APAS_SelectMerge",$Params);
$xfer_result->Caption="Fusionner des contacts moraux";
//@CODE_ACTION@
$img = new Xfer_Comp_Image("img");
$img->setLocation(0,0);
$img->setValue("merger.png");
$xfer_result->addComponent($img);
$lbl = new Xfer_Comp_LabelForm("title");
$lbl->setLocation(1,0);
$lbl->setValue("{[bold]}{[center]}{[newline]}Fusion de contacts moraux{[/center]}{[/bold]}");
$xfer_result->addComponent($lbl);

$grid=$self->mergeGrid('DBObj_org_lucterios_contacts_personneMorale',$personneMorale,$contact);
$grid->setLocation(0,1,2);
$grid->addAction($self->NewAction('_Changer','','SelectMerge',FORMTYPE_REFRESH,CLOSE_NO,SELECT_SINGLE));
$xfer_result->addComponent($grid);

$DBAbstract=new DBObj_org_lucterios_contacts_personneAbstraite;
$xfer_result->m_context['CLASSNAME']='DBObj_org_lucterios_contacts_personneMorale';
$xfer_result->m_context['PERSONNE']=$personneMorale;
$xfer_result->addAction($DBAbstract->newAction("_Fusionner","","Merge", FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction( new Xfer_Action("_Fermer","close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
