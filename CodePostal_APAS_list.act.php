<?php
// This file is part of Lucterios/Diacamma, a software developped by 'Le Sanglier du Libre' (http://www.sd-libre.fr)
// thanks to have payed a retribution for using this module.
// 
// Lucterios/Diacamma is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
// 
// Lucterios/Diacamma is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Lucterios; if not, write to the Free Software
// Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// Action file write by Lucterios SDK tool

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
require_once('extensions/org_lucterios_contacts/CodePostal.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Liste des Codes Postaux/Villes
//@PARAM@ FiltrecodPostal=0


//@LOCK:0

function CodePostal_APAS_list($Params)
{
$FiltrecodPostal=getParams($Params,"FiltrecodPostal",0);
$self=new DBObj_org_lucterios_contacts_CodePostal();
try {
$xfer_result=new Xfer_Container_Custom("org_lucterios_contacts","CodePostal_APAS_list",$Params);
$xfer_result->Caption="Liste des Codes Postaux/Villes";
//@CODE_ACTION@
$img = new Xfer_Comp_Image('img');
$img->setValue('contactCodePostal.png');
$img->setLocation(0,0,1,2);
$xfer_result->addComponent($img);
if($FiltrecodPostal == 0) {
	$local_struct = new DBObj_org_lucterios_contacts_personneMorale;
	$local_struct->get(1);
	$FiltrecodPostal = $local_struct->codePostal;
}
$lbl = new Xfer_Comp_LabelForm('filtre');
$lbl->setValue("{[bold]}Filtrer par code postal{[/bold]}");
$lbl->setLocation(1,0);
$xfer_result->addComponent($lbl);
$comp = new Xfer_Comp_Edit('FiltrecodPostal');
$comp->setValue($FiltrecodPostal);
$comp->setAction($self->newAction('','','list', FORMTYPE_REFRESH, CLOSE_NO));
$comp->setLocation(1,1);
$xfer_result->addComponent($comp);
$q = "SELECT * FROM org_lucterios_contacts_CodePostal WHERE codePostal like '".$FiltrecodPostal."%' ORDER BY codePostal, ville ";
$self->query($q,(int)$Params[GRID_PAGE.'codePostal']*75,75);

$grid = new Xfer_Comp_Grid("codePostal");
$grid->setDBObject($self,3,"",$Params);
$grid->addAction($self->newAction("_Ajouter","add.png","ajout", FORMTYPE_MODAL, CLOSE_NO, SELECT_NONE));
$grid->addAction($self->newAction("_Supprimer","suppr.png","suppr", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
$grid->setLocation(0,2,3);
$grid->setSize(300,750);
$xfer_result->addComponent($grid);
$lbl = new Xfer_Comp_LabelForm("nb");
$lbl->setLocation(0,3,3);
$lbl->setValue("Nombre total de codes postaux/villes: ". $self->N);
$xfer_result->addComponent($lbl);
$xfer_result->addAction( new Xfer_Action("_Fermer","close.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
