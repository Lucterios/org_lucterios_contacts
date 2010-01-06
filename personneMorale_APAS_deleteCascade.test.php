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
// --- Last modification: Date 07 January 2010 0:13:27 By  ---


//@TABLES@
require_once('extensions/org_lucterios_contacts/liaison.tbl.php');
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
require_once('extensions/org_lucterios_contacts/personnePhysique.tbl.php');
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@

//@DESC@Suppression en cascade physique
//@PARAM@ 

function org_lucterios_contacts_personneMorale_APAS_deleteCascade(&$test)
{
//@CODE_ACTION@
global $connect;
$connect->execute("DELETE FROM org_lucterios_contacts_personneMorale WHERE id=101");
$connect->execute("DELETE FROM org_lucterios_contacts_personnePhysique WHERE id=101");
$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=101");
$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=102");
$connect->execute("DELETE FROM org_lucterios_contacts_liaison WHERE id=101");

$connect->execute("INSERT INTO org_lucterios_contacts_personneAbstraite (id,adresse,codePostal,ville) VALUES (101,'rue machine','38000','Grenoble')",true);
$connect->execute("INSERT INTO org_lucterios_contacts_personneAbstraite (id,adresse,codePostal,ville) VALUES (102,'place truc','38600','Fontaine')",true);
$connect->execute("INSERT INTO org_lucterios_contacts_personneMorale (id,raisonSociale,type,superId) VALUES (101,'abc',1,101)",true);
$connect->execute("INSERT INTO org_lucterios_contacts_personnePhysique (id,nom,prenom,sexe,superId) VALUES (101,'AAA','BBB',1,102)",true);
$connect->execute("INSERT INTO org_lucterios_contacts_liaison (id,physique,morale,fonction) VALUES (101,101,101,1)",true);
try {
	$abstr=new DBObj_org_lucterios_contacts_personneAbstraite;
	$test->assertEquals(3,$abstr->find(),'IN Abstraite nb');
	$moral=new DBObj_org_lucterios_contacts_personneMorale;
	$test->assertEquals(2,$moral->find(),'IN Moral nb');
	$lien=new DBObj_org_lucterios_contacts_liaison;
	$test->assertEquals(1,$lien->find(),'IN lien nb');
	$phys=new DBObj_org_lucterios_contacts_personnePhysique;
	$test->assertEquals(1,$phys->find(),'IN phys nb');

	$test->CallAction("org_lucterios_contacts","personneAbstraite_APAS_Delete",array("abstractContact"=>"101","CONFIRME"=>"YES"),"Xfer_Container_Acknowledge");

	$abstr=new DBObj_org_lucterios_contacts_personneAbstraite;
	$test->assertEquals(2,$abstr->find(),'OUT Abstraite nb');
	$moral=new DBObj_org_lucterios_contacts_personneMorale;
	$test->assertEquals(1,$moral->find(),'OUT Moral nb');
	$lien=new DBObj_org_lucterios_contacts_liaison;
	$test->assertEquals(0,$lien->find(),'OUT lien nb');
	$phys=new DBObj_org_lucterios_contacts_personnePhysique;
	$test->assertEquals(1,$phys->find(),'OUT phys nb');

	$test->CallAction("org_lucterios_contacts","personneAbstraite_APAS_Delete",array("abstractContact"=>"1","CONFIRME"=>"YES"),"LucteriosException");

	$connect->execute("DELETE FROM org_lucterios_contacts_personneMorale WHERE id=101");
	$connect->execute("DELETE FROM org_lucterios_contacts_personnePhysique WHERE id=101");
	$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=101");
	$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=102");
	$connect->execute("DELETE FROM org_lucterios_contacts_liaison WHERE id=101");
} catch(Exception $e) {
	$connect->execute("DELETE FROM org_lucterios_contacts_personneMorale WHERE id=101");
	$connect->execute("DELETE FROM org_lucterios_contacts_personnePhysique WHERE id=101");
	$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=101");
	$connect->execute("DELETE FROM org_lucterios_contacts_personneAbstraite WHERE id=102");
	$connect->execute("DELETE FROM org_lucterios_contacts_liaison WHERE id=101");
	throw $e;
}
//@CODE_ACTION@
}

?>
