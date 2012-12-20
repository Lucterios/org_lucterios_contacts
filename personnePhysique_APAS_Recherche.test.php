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
// Test file write by Lucterios SDK tool


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

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('Filtreraison'=>''),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(2,count($comp->m_records),"Initial");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('Filtreraison'=>'Nom1'),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(1,count($comp->m_records),"Initial 2");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_Search",array(),"Xfer_Container_Custom");
$test->assertEquals(14,$rep->getComponentCount(),"nb");
$test->assertEquals(3,count($rep->m_actions),"m_actions nb");
$comp=$rep->getComponents('searchSelector');
$test->assertClass("Xfer_Comp_Select",$comp,'searchSelector');
$test->assertEquals(11,count($comp->m_select),'searchSelector nb');
$comp=$rep->getComponents('searchOperator');
$test->assertClass("Xfer_Comp_Select",$comp,'searchOperator');

$comp=$rep->getComponents('searchValueFloat');
$test->assertClass("Xfer_Comp_Float",$comp,'searchValueFloat');
$comp=$rep->getComponents('searchValueStr');
$test->assertClass("Xfer_Comp_Edit",$comp,'searchValueStr');
$comp=$rep->getComponents('searchValueBool');
$test->assertClass("Xfer_Comp_Check",$comp,'searchValueBool');
$comp=$rep->getComponents('searchValueDate');
$test->assertClass("Xfer_Comp_Date",$comp,'searchValueDate');
$comp=$rep->getComponents('searchValueTime');
$test->assertClass("Xfer_Comp_Time",$comp,'searchValueTime');
$comp=$rep->getComponents('searchValueList');
$test->assertClass("Xfer_Comp_CheckList",$comp,'searchValueList');
$comp=$rep->getComponents('searchButtonAdd');
$test->assertClass("Xfer_Comp_Button",$comp,'searchButtonAdd');

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('IsSearch'=>1),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(0,count($comp->m_records),"result A");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('IsSearch'=>1,'CRITERIA'=>'nom||5||Nom1||array%28%27fieldname%27%3D%3E%27nom%27%2C+%27description%27%3D%3E%27Nom%27%2C+%27list%27%3D%3E%27%27%2C+%27type%27%3D%3E%27str%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personnePhysique.nom%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personnePhysique%27%29%2C+%27wheres%27%3D%3Earray%28%29%29'),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(1,count($comp->m_records),"result B");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('IsSearch'=>1,'CRITERIA'=>'prenom||6||Prenom2||array%28%27fieldname%27%3D%3E%27prenom%27%2C+%27description%27%3D%3E%27Pr%E9nom%27%2C+%27list%27%3D%3E%27%27%2C+%27type%27%3D%3E%27str%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personnePhysique.prenom%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personnePhysique%27%29%2C+%27wheres%27%3D%3Earray%28%29%29'),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(1,count($comp->m_records),"result C");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('IsSearch'=>1,'CRITERIA'=>'sexe||8||1||array%28%27fieldname%27%3D%3E%27sexe%27%2C+%27description%27%3D%3E%27Civilit%E9%27%2C+%27list%27%3D%3E%270%7C%7CMonsieur%3B1%7C%7CMadame%2FMademoiselle%3B%27%2C+%27type%27%3D%3E%27list%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personnePhysique.sexe%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personnePhysique%27%29%2C+%27wheres%27%3D%3Earray%28%29%29'),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(1,count($comp->m_records),"result D");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('IsSearch'=>1,'CRITERIA'=>'codePostal||6||380||array%28%27fieldname%27%3D%3E%27codePostal%27%2C+%27description%27%3D%3E%27Code+Postal%27%2C+%27list%27%3D%3E%27%27%2C+%27type%27%3D%3E%27str%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personneAbstraite.codePostal%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personneAbstraite%27%2C+%27org_lucterios_contacts_personnePhysique%27%29%2C+%27wheres%27%3D%3Earray%28%27org_lucterios_contacts_personnePhysique.superId%3Dorg_lucterios_contacts_personneAbstraite.id%27%29%29'),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(1,count($comp->m_records),"result E");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_List",array('IsSearch'=>1,'CRITERIA'=>'ville||1||grenoble||array%28%27fieldname%27%3D%3E%27ville%27%2C+%27description%27%3D%3E%27Ville%27%2C+%27list%27%3D%3E%27%27%2C+%27type%27%3D%3E%27str%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personneAbstraite.ville%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personneAbstraite%27%2C+%27org_lucterios_contacts_personnePhysique%27%29%2C+%27wheres%27%3D%3Earray%28%27org_lucterios_contacts_personnePhysique.superId%3Dorg_lucterios_contacts_personneAbstraite.id%27%29%29'),"Xfer_Container_Custom");
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(1,count($comp->m_records),"result F");
//@CODE_ACTION@
}

?>
