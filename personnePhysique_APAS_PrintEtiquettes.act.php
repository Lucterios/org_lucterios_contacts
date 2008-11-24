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
// --- Last modification: Date 23 November 2008 11:02:11 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@
//@XFER:print
require_once('CORE/xfer_printing.inc.php');
//@XFER:print@


//@DESC@Imprimer les étiquettes
//@PARAM@ FiltrecodePostal=0
//@PARAM@ IsSearch=0


//@LOCK:0

function personnePhysique_APAS_PrintEtiquettes($Params)
{
$FiltrecodePostal=getParams($Params,"FiltrecodePostal",0);
$IsSearch=getParams($Params,"IsSearch",0);
$self=new DBObj_org_lucterios_contacts_personnePhysique();
try {
$xfer_result=&new Xfer_Container_Print("org_lucterios_contacts","personnePhysique_APAS_PrintEtiquettes",$Params);
$xfer_result->Caption="Imprimer les étiquettes";
//@CODE_ACTION@
if ($xfer_result->showSelector()) {
	if ($search!=0)
		$self->setForSearch($Params);
	else {
		$q = "SELECT org_lucterios_contacts_personnePhysique.* FROM org_lucterios_contacts_personnePhysique,org_lucterios_contacts_personneAbstraite WHERE ( org_lucterios_contacts_personnePhysique.superId=org_lucterios_contacts_personneAbstraite.id )  AND ( org_lucterios_contacts_personneAbstraite.codePostal like '".$FiltrecodPostal."%') ";
		$self->query($q);
	}
	$etiquette_values=array();
	while ($self->fetch()) {
		$etiquette_val=$self->nom." ".$self->prenom."{[newline]}";
		$etiquette_val.=$self->adresse."{[newline]}".$self->codePostal." ".$self->ville;
		if ($pers->pays!="France") $etiquette_val.="{[newline]}".$self->pays;
		$etiquette_values[]=$etiquette_val;
	}
	while (count($etiquette_values)<1) $etiquette_values[]="";
	$xfer_result->printEtiquette($xfer_result->Caption,$etiquette_values);
}
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
