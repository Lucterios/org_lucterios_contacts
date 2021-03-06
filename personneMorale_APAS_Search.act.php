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
// --- Last modification: Date 27 February 2012 6:40:36 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Rechercher une personne morale
//@PARAM@ 


//@LOCK:0

function personneMorale_APAS_Search($Params)
{
$self=new DBObj_org_lucterios_contacts_personneMorale();
try {
$xfer_result=new Xfer_Container_Custom("org_lucterios_contacts","personneMorale_APAS_Search",$Params);
$xfer_result->Caption="Rechercher une personne morale";
//@CODE_ACTION@
$img = new Xfer_Comp_Image("img");
$img->setValue("contactMoralFind.png");
$img->setLocation(0,0);
$xfer_result->addComponent($img);
$img = new Xfer_Comp_LabelForm("title");
$img->setValue("{[center]}{[underline]}{[bold]}Séléctionnez vos critères de recherche{[/bold]}{[/underline]}{[/center]}");
$img->setLocation(1,0,5);
$xfer_result->addComponent($img);
$xfer_result->m_context["IsSearch"] = 1;
$fields = $self->findFields();
$xfer_result->setSearchGUI($self,$fields,1);
$xfer_result->addAction($self->NewAction("_Rechercher","ok.png","List", FORMTYPE_NOMODAL, CLOSE_YES));
$xfer_result->addAction($self->NewAction("_Doublons","search.png","rechercheDoublon", FORMTYPE_NOMODAL, CLOSE_YES));
$xfer_result->addAction($self->NewAction("_Annuler","cancel.png"));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
