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
// --- Last modification: Date 27 February 2010 0:25:09 By  ---

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


//@DESC@Afficher les ou la structure moral de l'utilisateur connecté
//@PARAM@ moral=0


//@LOCK:0

function personneMorale_APAS_currentMoral($Params)
{
$moral=getParams($Params,"moral",0);
$self=new DBObj_org_lucterios_contacts_personneMorale();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","personneMorale_APAS_currentMoral",$Params);
$xfer_result->Caption="Afficher les ou la structure moral de l'utilisateur connecté";
//@CODE_ACTION@
if ($moral>0) {
	$xfer_result->Caption="Ma structure morale";
	$self->get($moral);

$img = new Xfer_Comp_Image("img");
$img->setLocation(0,0,1,5);
$img->setValue("contactMoral.png");
$xfer_result->addComponent($img);

$xfer_result->setDBObject($self,"raisonSociale", true,3,1,3);
$xfer_result = $self->Super->show(1,4,$xfer_result);
$xfer_result->setDBObject($self,"siren", true,30,1);

	$xfer_result->addAction($self->newAction("_Modifier","edit.png","ModifyMaStructure", FORMTYPE_MODAL, CLOSE_NO));
	$xfer_result->addAction($self->newAction("_Fermer","close.png"));
}
else {
	$contact=new DBObj_org_lucterios_contacts_personnePhysique;
	if ($contact->findConnected()) {
		$Q="SELECT M.* FROM org_lucterios_contacts_personneMorale M,org_lucterios_contacts_liaison L WHERE M.id<>1 AND L.morale=M.id AND L.physique=".$contact->id;
		$DBMoral=new DBObj_org_lucterios_contacts_personneMorale;
		$DBMoral->query($Q);
		$grid = new Xfer_Comp_Grid('moral');
		$grid->setDBObject($DBMoral,array("raisonSociale","fixe","fax","mail"),'',$Params);
		if (count($grid->m_records)==0) {
			require_once("CORE/Lucterios_Error.inc.php");
			throw new LucteriosException( IMPORTANT,"Vous n'avez pas de structure morale!");
		}
		else if (count($grid->m_records)==1) {
			$xfer_result->Caption="Ma structure morale";
			$DBMoral=new DBObj_org_lucterios_contacts_personneMorale;
			$DBMoral->query($Q);
			$DBMoral->fetch();

$img = new Xfer_Comp_Image("img");
$img->setLocation(0,0,1,5);
$img->setValue("contactMoral.png");
$xfer_result->addComponent($img);

$xfer_result->setDBObject($DBMoral,"raisonSociale", true,3,1,3);
$xfer_result = $DBMoral->Super->show(1,4,$xfer_result);
$xfer_result->setDBObject($DBMoral,"siren", true,30,1);

			$xfer_result->addAction($DBMoral->newAction("_Modifier","edit.png","ModifyMaStructure", FORMTYPE_MODAL, CLOSE_NO));
			$xfer_result->addAction($DBMoral->newAction("_Fermer","close.png"));
		}
		else {
			$xfer_result->Caption="Mes structures morales";
			$grid->setSize(300,500);
			$grid->addAction($DBMoral->newAction("_Editer","edit.png","currentMoral", FORMTYPE_MODAL, CLOSE_NO, SELECT_SINGLE));
			$grid->addAction($DBMoral->newAction("_Fermer","close.png"));
			$xfer_result->addComponent($grid);
		}
	} else {
		require_once("CORE/Lucterios_Error.inc.php");
		throw new LucteriosException( IMPORTANT,"Votre connexion n'est pas lié à un contact!");
	}
}
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
