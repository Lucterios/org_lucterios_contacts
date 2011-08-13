<?php
// 	This file is part of Diacamma, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// 	Thanks to have payed a retribution for using this module.
// 
// 	Diacamma is free software; you can redistribute it and/or modify
// 	it under the terms of the GNU General Public License as published by
// 	the Free Software Foundation; either version 2 of the License, or
// 	(at your option) any later version.
// 
// 	Diacamma is distributed in the hope that it will be useful,
// 	but WITHOUT ANY WARRANTY; without even the implied warranty of
// 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// 	GNU General Public License for more details.
// 
// 	You should have received a copy of the GNU General Public License
// 	along with Lucterios; if not, write to the Free Software
// 	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
// Test file write by SDK tool
// --- Last modification: Date 12 August 2011 11:16:40 By  ---


//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@

//@DESC@recherche de contacts
//@PARAM@ 

function org_lucterios_contacts_personnePhysique_APAS_Recherche(&$test)
{
//@CODE_ACTION@
$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_AddModifyAct",array('nom'=>'Nom1','prenom'=>'Prenom1','adresse'=>'adresse1 adresse2',
'codePostal'=>'38600','ville'=>'FONTAINE','pays'=>'FRANCE','fixe'=>'041234567','portable'=>'065432109','fax'=>'041234567',
'mail'=>'nom1.prenom1@free.fr','commentaire'=>'aa bb cc','sexe'=>1),"Xfer_Container_Acknowledge");

$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_AddModifyAct",array('nom'=>'Nom2','prenom'=>'Prenom2','adresse'=>'adresse1 adresse2',
'codePostal'=>'38000','ville'=>'GRENOBLE','pays'=>'FRANCE','fixe'=>'047654321','portable'=>'069012345','fax'=>'041234567',
'mail'=>'nom2.prenom2@free.fr','commentaire'=>'aa bb cc','sexe'=>0),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('FiltrecodPostal'=>''),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(2,count($comp->m_records),"Initial");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_Search",array(),"Xfer_Container_Custom");
$test->assertEquals(35,$rep->getComponentCount(),"nb");
$test->assertEquals(2,count($rep->m_actions),"m_actions nb");
$comp=$rep->getComponents('nom_value1');
$test->assertClass("Xfer_Comp_Edit",$comp,'nom_value1');
$comp=$rep->getComponents('prenom_value1');
$test->assertClass("Xfer_Comp_Edit",$comp,'prenom_value1');
$comp=$rep->getComponents('user%login_value1');
$test->assertClass("Xfer_Comp_Edit",$comp,'user%login_value1');
$comp=$rep->getComponents('sexe_value1');
$test->assertClass("Xfer_Comp_CheckList",$comp,'sexe_value1');
$comp=$rep->getComponents('codePostal_value1');
$test->assertClass("Xfer_Comp_Edit",$comp,'codePostal_value1');
$comp=$rep->getComponents('ville_value1');
$test->assertClass("Xfer_Comp_Edit",$comp,'ville_value1');
$comp=$rep->getComponents('commentaire_value1');
$test->assertClass("Xfer_Comp_Memo",$comp,'commentaire_value1');

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('IsSearch'=>1),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(0,count($comp->m_records),"result A");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('IsSearch'=>1,'nom_select'=>1,'nom_value1'=>'Nom1'),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(1,count($comp->m_records),"result B");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('IsSearch'=>1,'prenom_select'=>1,'prenom_value1'=>'Prenom2'),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(1,count($comp->m_records),"result C");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('IsSearch'=>1,'sexe_select'=>1,'sexe_value1'=>'1'),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(1,count($comp->m_records),"result D");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('IsSearch'=>1,'codePostal_select'=>1,'codePostal_value1'=>'38000'),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(1,count($comp->m_records),"result E");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('IsSearch'=>1,'ville_select'=>1,'ville_value1'=>'grenoble'),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(1,count($comp->m_records),"result F");
//@CODE_ACTION@
}

?>
