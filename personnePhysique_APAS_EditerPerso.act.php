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
// --- Last modification: Date 12 March 2009 23:18:16 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@
//@XFER:custom
require_once('CORE/xfer_custom.inc.php');
//@XFER:custom@


//@DESC@Modifier ma fiche personnelle
//@PARAM@ 


//@LOCK:0

function personnePhysique_APAS_EditerPerso($Params)
{
$self=new DBObj_org_lucterios_contacts_personnePhysique();
try {
$xfer_result=&new Xfer_Container_Custom("org_lucterios_contacts","personnePhysique_APAS_EditerPerso",$Params);
$xfer_result->Caption="Modifier ma fiche personnelle";
//@CODE_ACTION@
$self->findConnected();
$self->setFrom($Params);
$xfer_result = $self->edit(1,0,$xfer_result);
$xfer_result->addAction($self->newAction("_Ok","ok.png","ModifFichePerso", FORMTYPE_MODAL, CLOSE_YES));
$xfer_result->addAction(new Xfer_Action("_Annuler","cancel.png","org_lucterios_contacts","FichePersonnel", FORMTYPE_MODAL, CLOSE_YES));
//@CODE_ACTION@
}catch(Exception $e) {
	throw $e;
}
return $xfer_result;
}

?>
