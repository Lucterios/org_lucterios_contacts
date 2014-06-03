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
// --- Last modification: Date 02 March 2010 12:01:01 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Afficher les ou la organisation de l'utilisateur connecté
//@PARAM@ moral=0


//@LOCK:0

function personneMorale_APAS_currentMoral($Params)
{
$moral=getParams($Params,"moral",0);
$self=new DBObj_org_lucterios_contacts_personneMorale();
try {
$xfer_result=new Xfer_Container_Custom("org_lucterios_contacts","personneMorale_APAS_currentMoral",$Params);
$xfer_result->Caption="Afficher les ou la organisation de l'utilisateur connecté";
//@CODE_ACTION@
$img = new Xfer_Comp_Image("img");
$img->setLocation(0,0,1,5);
$img->setValue("contactMoral.png");
$xfer_result->addComponent($img);

if ($moral>0) {
	$xfer_result->Caption="Mon organisation";
	$self->get($moral);
	$xfer_result->m_context['personneMorale']=$moral;
	$xfer_result->setDBObject($self,"raisonSociale", true,3,1,3);
	$xfer_result = $self->Super->show(1,4,$xfer_result);
	$xfer_result->setDBObject($self,"siren", true,30,1);

	$xfer_result->addAction($self->newAction("_Modifier","edit.png","ModifyMaStructure", FORMTYPE_MODAL, CLOSE_NO));
	$xfer_result->addAction($self->newAction("_Fermer","close.png"));
}
else {
	$xfer_result=$self->getCurrentMoralShow(1, 3, $xfer_result);
	$grid = $xfer_result->getComponents('moral');
	if ($grid==null)
		$xfer_result->Caption="Mon organisation";
	else
		$xfer_result->Caption="Mes organisations";
}
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
