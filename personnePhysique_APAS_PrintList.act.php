<?php
//
//  This file is part of Lucterios.
//
//  Lucterios is free software; you can redistribute it and/or modify
//  it under the terms of the GNU General Public License as published by
//  the Free Software Foundation; either version 2 of the License, or
//  (at your option) any later version.
//
//  Lucterios is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//  GNU General Public License for more details.
//
//  You should have received a copy of the GNU General Public License
//  along with Lucterios; if not, write to the Free Software
//  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
//
//	Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
//
// Action file write by SDK tool
// --- Last modification: Date 25 May 2008 15:39:25 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@
//@XFER:print
require_once('CORE/xfer_printing.inc.php');
//@XFER:print@


//@DESC@Imprimer une liste de personnes physiques
//@PARAM@ FiltrecodPostal=0
//@PARAM@ IsSearch=0


//@LOCK:0

function personnePhysique_APAS_PrintList($Params)
{
$FiltrecodPostal=getParams($Params,"FiltrecodPostal",0);
$IsSearch=getParams($Params,"IsSearch",0);
$self=new DBObj_org_lucterios_contacts_personnePhysique();
try {
$xfer_result=&new Xfer_Container_Print("org_lucterios_contacts","personnePhysique_APAS_PrintList",$Params);
$xfer_result->Caption="Imprimer une liste de personnes physiques";
//@CODE_ACTION@
require_once"CORE/PrintListing.inc.php";
$listing = new PrintListing("Liste des Personnes Morales");
$listing->Header = "Liste des Personnes Morales";
$listing->GridHeader[] = array('Nom',25);
$listing->GridHeader[] = array('Prénom',40);
$listing->GridHeader[] = array('Adresse',60);
$listing->GridHeader[] = array('Téléphones',20);
$listing->GridHeader[] = array('Courriel',45);
if($IsSearch != 0)$self->setForSearch($Params);
else {
	$q = "SELECT org_lucterios_contacts_personnePhysique.* FROM org_lucterios_contacts_personnePhysique,org_lucterios_contacts_personneAbstraite WHERE (org_lucterios_contacts_personnePhysique.superId=org_lucterios_contacts_personneAbstraite.id) AND (org_lucterios_contacts_personneAbstraite.codePostal like '".$FiltrecodPostal."%') ";
	$self->query($q);
}
while($self->fetch()) {
	$one_row = array();
	$one_row[] = $self->nom;
	$one_row[] = $self->prenom;
	$adress = $self->adresse."{[newline]}".$self->codePostal." ".$self->ville;
	if($self->pays != "France")$adress .= "{[newline]}".$self->pays;
	$one_row[] = $adress;
	$one_row[] = $self->fixe."{[newline]}".$self->portable;
	$one_row[] = $self->mail;
	$listing->GridContent[] = $one_row;
}
$xfer_result->printListing($listing);
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
