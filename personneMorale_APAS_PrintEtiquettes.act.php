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
//@TABLES@
//@XFER:print
require_once('CORE/xfer_printing.inc.php');
//@XFER:print@


//@DESC@Imprimer des étiquettes
//@PARAM@ Filtretype=1
//@PARAM@ IsSearch=0
//@PARAM@ Filtreraison=''


//@LOCK:0

function personneMorale_APAS_PrintEtiquettes($Params)
{
$Filtretype=getParams($Params,"Filtretype",1);
$IsSearch=getParams($Params,"IsSearch",0);
$Filtreraison=getParams($Params,"Filtreraison",'');
$self=new DBObj_org_lucterios_contacts_personneMorale();
try {
$xfer_result=new Xfer_Container_Print("org_lucterios_contacts","personneMorale_APAS_PrintEtiquettes",$Params);
$xfer_result->Caption="Imprimer des étiquettes";
//@CODE_ACTION@
if ($xfer_result->showSelector()) {
	if ($search!=0)
		$self->setForSearch($Params);
	else {
		$self->type = $Filtretype;
		if ($Filtreraison != '')
			$self->whereAdd("raisonSociale like '%".$Filtreraison."%'");		
		$self->find();
	}
	$etiquette_values=array();
	while ($self->fetch()) {
		$etiquette_val=$self->raisonSociale."{[newline]}";
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
