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
//  // Test file write by SDK tool
// --- Last modification: Date 18 November 2009 12:25:56 By  ---


//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@

//@DESC@Ajouter, modifier, supprimer une personne
//@PARAM@ 

function org_lucterios_contacts_personnePhysique_APAS_AjoutModifier(&$test)
{
//@CODE_ACTION@
$DBPersonne=new DBObj_org_lucterios_contacts_personnePhysique;
$test->assertEquals(0,$DBPersonne->find(),"INIT NB");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_AddModify",array(),"Xfer_Container_Custom");
$test->assertEquals(2,count($rep->m_actions),"nb actions");
$comp=$rep->getComponents('nom');
$test->assertClass("Xfer_Comp_Edit",$comp,'nom');
$test->assertEquals('',$comp->m_value,'nom value');
$test->assertEquals(true,$comp->needed,'nom non null');
$comp=$rep->getComponents('prenom');
$test->assertClass("Xfer_Comp_Edit",$comp,'prenom');
$test->assertEquals('',$comp->m_value,'prenom value');
$test->assertEquals(true,$comp->needed,'prenom non null');
$comp=$rep->getComponents('adresse');
$test->assertClass("Xfer_Comp_Memo",$comp,'adresse');
$test->assertEquals('',$comp->m_value,'adresse value');
$test->assertEquals(true,$comp->needed,'adresse non null');
$comp=$rep->getComponents('codePostal');
$test->assertClass("Xfer_Comp_Edit",$comp,'codePostal');
$test->assertEquals('',$comp->m_value,'codePostal value');
$test->assertEquals(true,$comp->needed,'codePostal non null');
$comp=$rep->getComponents('ville');
$test->assertClass("Xfer_Comp_Edit",$comp,'ville');
$test->assertEquals('',$comp->m_value,'ville value');
//$test->assertEquals(true,$comp->needed,'ville non null');
$comp=$rep->getComponents('pays');
$test->assertClass("Xfer_Comp_Edit",$comp,'pays');
$test->assertEquals('',$comp->m_value,'pays value');
$test->assertEquals(false,$comp->needed,'pays non null');
$comp=$rep->getComponents('fixe');
$test->assertClass("Xfer_Comp_Edit",$comp,'fixe');
$test->assertEquals('',$comp->m_value,'fixe value');
$test->assertEquals(false,$comp->needed,'fixe non null');
$comp=$rep->getComponents('portable');
$test->assertClass("Xfer_Comp_Edit",$comp,'gsm');
$test->assertEquals('',$comp->m_value,'gsm value');
$test->assertEquals(false,$comp->needed,'gsm non null');
$comp=$rep->getComponents('fax');
$test->assertClass("Xfer_Comp_Edit",$comp,'fax');
$test->assertEquals('',$comp->m_value,'fax value');
$test->assertEquals(false,$comp->needed,'fax non null');
$comp=$rep->getComponents('mail');
$test->assertClass("Xfer_Comp_Edit",$comp,'mail');
$test->assertEquals('',$comp->m_value,'mail value');
$test->assertEquals(false,$comp->needed,'mail non null');
$comp=$rep->getComponents('commentaire');
$test->assertClass("Xfer_Comp_Memo",$comp,'commentaire');
$test->assertEquals('',$comp->m_value,'commentaire value');
$test->assertEquals(false,$comp->needed,'commentaire non null');
$comp=$rep->getComponents('sexe');
$test->assertClass("Xfer_Comp_Select",$comp,'sexe');

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_AddModifyAct",array('nom'=>'Nom','prenom'=>'Prenom','adresse'=>'adresse1 adresse2',
'codePostal'=>'38000','ville'=>'GRENOBLE','pays'=>'FRANCE','fixe'=>'041234567','portable'=>'065432109','fax'=>'041234567',
'mail'=>'nom.prenom@free.fr','commentaire'=>'aa bb cc','sexe'=>1),"Xfer_Container_Acknowledge");

$DBpresonne=new DBObj_org_lucterios_contacts_personnePhysique;
$test->assertEquals(1,$DBPersonne->find(),"ADD NB");
$DBPersonne->fetch();
$test->assertEquals('100',$DBPersonne->id,"ID");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_Fiche",array('personnePhysique'=>100),"Xfer_Container_Custom");
$test->assertEquals(4,count($rep->m_actions),"nb actions");
$comp=$rep->getComponents('nom');
$test->assertEquals('Nom',$comp->m_value,'nom value');
$comp=$rep->getComponents('prenom');
$test->assertEquals('Prenom',$comp->m_value,'prenom value');
$comp=$rep->getComponents('adresse');
$test->assertEquals('adresse1 adresse2',$comp->m_value,'adresse value');
$comp=$rep->getComponents('codePostal');
$test->assertEquals('38000',$comp->m_value,'codePostal value');
$comp=$rep->getComponents('ville');
$test->assertEquals('GRENOBLE',$comp->m_value,'ville value');
$comp=$rep->getComponents('pays');
$test->assertEquals('FRANCE',$comp->m_value,'pays value');
$comp=$rep->getComponents('fixe');
$test->assertEquals('041234567',$comp->m_value,'fixe value');
$comp=$rep->getComponents('portable');
$test->assertEquals('065432109',$comp->m_value,'gsm value');
$comp=$rep->getComponents('fax');
$test->assertEquals('041234567',$comp->m_value,'fax value');
$comp=$rep->getComponents('mail');
$test->assertEquals('nom.prenom@free.fr',$comp->m_value,'mail value');
$comp=$rep->getComponents('commentaire');
$test->assertEquals('aa bb cc',$comp->m_value,'commentaire value');
$comp=$rep->getComponents('sexe');
$test->assertEquals('Femme',$comp->m_value,'sexe value');

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_AddModifyAct",array('personnePhysique'=>'100','nom'=>'Nom','prenom'=>'Prenom',
'adresse'=>'adresse2 adresse1','codePostal'=>'38000','ville'=>'GRENOBLE','pays'=>'FRANCE','fixe'=>'041234567','portable'=>'065432109',
'fax'=>'049876543','mail'=>'nom.prenom@free.fr','commentaire'=>'aa bb cc dd ee','sexe'=>1),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_Fiche",array('personnePhysique'=>100),"Xfer_Container_Custom");
$test->assertEquals(4,count($rep->m_actions),"nb actions");
$comp=$rep->getComponents('nom');
$test->assertEquals('Nom',$comp->m_value,'nom value');
$comp=$rep->getComponents('prenom');
$test->assertEquals('Prenom',$comp->m_value,'prenom value');
$comp=$rep->getComponents('adresse');
$test->assertEquals('adresse2 adresse1',$comp->m_value,'adresse value');
$comp=$rep->getComponents('codePostal');
$test->assertEquals('38000',$comp->m_value,'codePostal value');
$comp=$rep->getComponents('ville');
$test->assertEquals('GRENOBLE',$comp->m_value,'ville value');
$comp=$rep->getComponents('pays');
$test->assertEquals('FRANCE',$comp->m_value,'pays value');
$comp=$rep->getComponents('fixe');
$test->assertEquals('041234567',$comp->m_value,'fixe value');
$comp=$rep->getComponents('portable');
$test->assertEquals('065432109',$comp->m_value,'gsm value');
$comp=$rep->getComponents('fax');
$test->assertEquals('049876543',$comp->m_value,'fax value');
$comp=$rep->getComponents('mail');
$test->assertEquals('nom.prenom@free.fr',$comp->m_value,'mail value');
$comp=$rep->getComponents('commentaire');
$test->assertEquals('aa bb cc dd ee',$comp->m_value,'commentaire value');
$comp=$rep->getComponents('sexe');
$test->assertEquals('Femme',$comp->m_value,'sexe value');

$pers=new DBObj_org_lucterios_contacts_personnePhysique;
$pers->get(100);
$contact=$pers->getSuperObject('org_lucterios_contacts_personneAbstraite');
$test->CallAction("org_lucterios_contacts","personneAbstraite_APAS_Delete",array('abstractContact'=>$contact->id,'CONFIRME'=>'YES'),"Xfer_Container_Acknowledge");

$DBPersonne=new DBObj_org_lucterios_contacts_personnePhysique;
$test->assertEquals(0,$DBPersonne->find(),"FINAL NB");

$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_Fiche",array('personnePhysique'=>100),"LucteriosException");
//@CODE_ACTION@
}

?>
