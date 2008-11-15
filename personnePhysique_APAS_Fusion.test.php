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
// --- Last modification: Date 15 November 2008 1:48:43 By  ---


//@TABLES@
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
//@TABLES@

//@DESC@Fusion
//@PARAM@ 

function org_lucterios_contacts_personnePhysique_APAS_Fusion(&$test)
{
//@CODE_ACTION@
global $connect;
$connect->execute("DELETE FROM org_lucterios_contacts_personneMorale WHERE id=101");
$connect->execute("DELETE FROM org_lucterios_contacts_personnePhysique WHERE id=101");
$connect->execute("DELETE FROM org_lucterios_contacts_personnePhysique WHERE id=102");
$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=101");
$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=102");
$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=103");
$connect->execute("DELETE FROM org_lucterios_contacts_liaison WHERE id=101");
$connect->execute("DELETE FROM org_lucterios_contacts_liaison WHERE id=102");

$connect->execute("INSERT INTO org_lucterios_contacts_personneMorale (id,raisonSociale,type,superId) VALUES (101,'abc',1,101)",true);
$connect->execute("INSERT INTO org_lucterios_contacts_personnePhysique (id,nom,prenom,sexe,superId) VALUES (101,'AAA','BBB',1,102)",true);
$connect->execute("INSERT INTO org_lucterios_contacts_personnePhysique (id,nom,prenom,sexe,superId) VALUES (102,'AAA','BBBB',1,103)",true);
$connect->execute("INSERT INTO org_lucterios_contacts_personneAbstraite (id,adresse,codePostal,ville) VALUES (101,'rue machine','38000','Grenoble')",true);
$connect->execute("INSERT INTO org_lucterios_contacts_personneAbstraite (id,adresse,codePostal,ville) VALUES (102,'place truc','38600','Fontaine')",true);
$connect->execute("INSERT INTO org_lucterios_contacts_personneAbstraite (id,adresse,codePostal,ville) VALUES (103,'place truc','38600','Fontaine')",true);
$connect->execute("INSERT INTO org_lucterios_contacts_liaison (id,physique,morale,fonction) VALUES (101,101,101,1)",true);
$connect->execute("INSERT INTO org_lucterios_contacts_liaison (id,physique,morale,fonction) VALUES (102,102,101,2)",true);
try {
	$abstr=new DBObj_org_lucterios_contacts_personneAbstraite;
	$test->assertEquals(4,$abstr->find(),'IN Abstraite nb');
	$moral=new DBObj_org_lucterios_contacts_personneMorale;
	$test->assertEquals(2,$moral->find(),'IN Moral nb');
	$lien=new DBObj_org_lucterios_contacts_liaison;
	$test->assertEquals(2,$lien->find(),'IN lien nb');
	$phys=new DBObj_org_lucterios_contacts_personnePhysique;
	$test->assertEquals(2,$phys->find(),'IN phys nb');

	$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_SelectMerge",array("personnePhysique"=>"101;102"),"Xfer_Container_Custom");
	$test->assertEquals(3,$rep->getComponentCount());

	$comp=$rep->getComponents(0);
	$test->assertClass("Xfer_Comp_Image",$comp);
	$test->assertEquals("img",$comp->m_name);

	$comp=$rep->getComponents(1);
	$test->assertClass("Xfer_Comp_LabelForm",$comp);
	$test->assertEquals("title",$comp->m_name);

	$comp=$rep->getComponents(2);
	$test->assertClass("Xfer_Comp_Grid",$comp);
	$test->assertEquals("contact",$comp->m_name);
	$test->assertEquals(2,count($comp->m_headers),"headers");
	$test->assertEquals(2,count($comp->m_records),"records");
	$headers=array_keys($comp->m_headers);
	$test->assertEquals("Référence",$comp->m_headers[$headers[0]]->m_descript);
	$test->assertEquals("Désignation",$comp->m_headers[$headers[1]]->m_descript);
	$test->assertEquals("Oui",$comp->m_records["102"]["select"]);
	$test->assertEquals("Non",$comp->m_records["103"]["select"]);
	$test->assertEquals("AAA BBB",$comp->m_records["102"]["text"]);
	$test->assertEquals("AAA BBBB",$comp->m_records["103"]["text"]);

	$test->assertEquals(2,count($comp->m_actions),"actions grid");
	$test->assertEquals(2,COUNT($rep->m_actions),"actions");

	$rep=$test->CallAction("org_lucterios_contacts","personneAbstraite_APAS_Merge",array("PERSONNE"=>"101;102","CLASSNAME"=>"DBObj_org_lucterios_contacts_personnePhysique","contact"=>102),"Xfer_Container_Acknowledge");

	$lien=new DBObj_org_lucterios_contacts_liaison;
	$test->assertEquals(2,$lien->find(),'OUT lien nb');
	$abstr=new DBObj_org_lucterios_contacts_personneAbstraite;
	$test->assertEquals(3,$abstr->find(),'OUT Abstraite nb');
	$moral=new DBObj_org_lucterios_contacts_personneMorale;
	$test->assertEquals(2,$moral->find(),'OUT Moral nb');
	$phys=new DBObj_org_lucterios_contacts_personnePhysique;
	$test->assertEquals(1,$phys->find(),'OUT phys nb');
	$phys->fetch();
	$test->assertEquals("101",$phys->id,'OUT phys id');

	$connect->execute("DELETE FROM org_lucterios_contacts_personneMorale WHERE id=101");
	$connect->execute("DELETE FROM org_lucterios_contacts_personnePhysique WHERE id=101");
	$connect->execute("DELETE FROM org_lucterios_contacts_personnePhysique WHERE id=102");
	$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=101");
	$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=102");
	$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=103");
	$connect->execute("DELETE FROM org_lucterios_contacts_liaison WHERE id=101");
	$connect->execute("DELETE FROM org_lucterios_contacts_liaison WHERE id=102");
} catch(Exception $e) {
	$connect->execute("DELETE FROM org_lucterios_contacts_personneMorale WHERE id=101");
	$connect->execute("DELETE FROM org_lucterios_contacts_personnePhysique WHERE id=101");
	$connect->execute("DELETE FROM org_lucterios_contacts_personnePhysique WHERE id=102");
	$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=101");
	$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=102");
	$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=103");
	$connect->execute("DELETE FROM org_lucterios_contacts_liaison WHERE id=101");
	$connect->execute("DELETE FROM org_lucterios_contacts_liaison WHERE id=102");
	throw $e;
}
//@CODE_ACTION@
}

?>
