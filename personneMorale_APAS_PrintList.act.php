<?php
// Action file write by SDK tool
// --- Last modification: Date 25 May 2008 16:08:31 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@
//@XFER:print
require_once('CORE/xfer_printing.inc.php');
//@XFER:print@


//@DESC@Imprimer une liste de personneMorale
//@PARAM@ Filtretype=1
//@PARAM@ IsSearch=0


//@LOCK:0

function personneMorale_APAS_PrintList($Params)
{
$Filtretype=getParams($Params,"Filtretype",1);
$IsSearch=getParams($Params,"IsSearch",0);
$self=new DBObj_org_lucterios_contacts_personneMorale();
try {
$xfer_result=&new Xfer_Container_Print("org_lucterios_contacts","personneMorale_APAS_PrintList",$Params);
$xfer_result->Caption="Imprimer une liste de personneMorale";
//@CODE_ACTION@
require_once"CORE/PrintListing.inc.php";
$listing = new PrintListing("Liste des Personnes Morales");
$listing->Header = "Liste des Personnes Morales";
$listing->GridHeader[] = array('Raison Sociale',50);
$listing->GridHeader[] = array('Adresse',70);
$listing->GridHeader[] = array('T�l�phones',20);
$listing->GridHeader[] = array('Courriel',50);
if($IsSearch != 0)$self->setForSearch($Params);
else {
	$self->type = $Filtretype;
	$self->find();
}
while($self->fetch()) {
	$one_row = array();
	$one_row[] = $self->raisonSociale;
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