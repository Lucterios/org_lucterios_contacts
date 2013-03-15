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
//@TABLES@

//@DESC@Ensemble des parametrage de contacts (hors courriel)
//@PARAM@ 

function org_lucterios_contacts_Parametrage(&$test)
{
//@CODE_ACTION@
// ---- Configuration par defaut ----
$rep=$test->CallAction("org_lucterios_contacts","configuration",array(),"Xfer_Container_Custom");
$test->assertEquals(1,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals(24,$rep->getComponentCount(),'nb component');
//IMAGE - imgParams
$comp=$rep->getComponents('imgParams');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de imgParams");
$test->assertEquals("extensions/org_lucterios_contacts/images/contactsConfig.png","".$comp->m_value,"Valeur de imgParams");
//LABELFORM - titleParams
$comp=$rep->getComponents('titleParams');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de titleParams");
$test->assertEquals("{[newline]}{[center]}{[bold]}Paramètres des contacts{[/bold]}{[/center]}","".$comp->m_value,"Valeur de titleParams");
//LABELFORM - defaultGrouplbl
$comp=$rep->getComponents('defaultGrouplbl');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de defaultGrouplbl");
$test->assertEquals("{[bold]}Groupe par défaut{[/bold]}","".$comp->m_value,"Valeur de defaultGrouplbl");
//LABELFORM - defaultGroup
$comp=$rep->getComponents('defaultGroup');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de defaultGroup");
$test->assertEquals("Visiteur","".$comp->m_value,"Valeur de defaultGroup");
//LABELFORM - defaultTypelbl
$comp=$rep->getComponents('defaultTypelbl');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de defaultTypelbl");
$test->assertEquals("{[bold]}Catégorie par défaut{[/bold]}","".$comp->m_value,"Valeur de defaultTypelbl");
//LABELFORM - defaultType
$comp=$rep->getComponents('defaultType');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de defaultType");
$test->assertEquals("Entreprise","".$comp->m_value,"Valeur de defaultType");
//LABELFORM - defaultFunctionlbl
$comp=$rep->getComponents('defaultFunctionlbl');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de defaultFunctionlbl");
$test->assertEquals("{[bold]}Fonction par défaut{[/bold]}","".$comp->m_value,"Valeur de defaultFunctionlbl");
//LABELFORM - defaultFunction
$comp=$rep->getComponents('defaultFunction');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de defaultFunction");
$test->assertEquals("Président","".$comp->m_value,"Valeur de defaultFunction");
//BUTTON - Params
$comp=$rep->getComponents('Params');
$test->assertClass("Xfer_Comp_Button",$comp,"Classe de Params");
$act=$comp->m_action;
$test->assertEquals("Modifier",$act->m_title,'Titre action btn');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action btn');
$test->assertEquals("ChangeParams",$act->m_action,'Act action btn');
//IMAGE - img
$comp=$rep->getComponents('imgFonction');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_contacts/images/contactFonction.png","".$comp->m_value,"Valeur de img");
//LABELFORM - title
$comp=$rep->getComponents('titleFonction');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de title");
$test->assertEquals("{[newline]}{[center]}{[undeline]}{[bold]}Liste des fonctions{[/bold]}{[/undeline]}{[/center]}","".$comp->m_value,"Valeur de title");
//GRID - fonction
$comp=$rep->getComponents('fonction');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de fonction");
$test->assertEquals(1,count($comp->m_headers),"Nb grid headers de fonction");
$test->assertEquals(8,count($comp->m_records),"Nb grid records de fonction");
$act=$comp->m_actions[0];
$test->assertEquals("_Ajouter",$act->m_title,'Titre grid action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext grid action #1');
$test->assertEquals("fonctions_APAS_ajout",$act->m_action,'Act grid action #1');
$act=$comp->m_actions[1];
$test->assertEquals("_Supprimer",$act->m_title,'Titre grid action #2');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext grid action #2');
$test->assertEquals("fonctions_APAS_suppr",$act->m_action,'Act grid action #2');
$headers=$comp->m_headers;
$test->assertEquals("Nom",$headers["nom"]->m_descript,'Header #1');
$rec=$comp->m_records[1];
$test->assertEquals("Président",$rec["nom"],"Valeur de grid [1,nom]");
$rec=$comp->m_records[2];
$test->assertEquals("Vice-Président",$rec["nom"],"Valeur de grid [2,nom]");
$rec=$comp->m_records[3];
$test->assertEquals("Trésorier",$rec["nom"],"Valeur de grid [3,nom]");
$rec=$comp->m_records[4];
$test->assertEquals("Trésorier-Adjoint",$rec["nom"],"Valeur de grid [4,nom]");
$rec=$comp->m_records[5];
$test->assertEquals("Secrétaire",$rec["nom"],"Valeur de grid [5,nom]");
$rec=$comp->m_records[6];
$test->assertEquals("Secrétaire-Adjoint",$rec["nom"],"Valeur de grid [6,nom]");
$rec=$comp->m_records[7];
$test->assertEquals("Directeur",$rec["nom"],"Valeur de grid [7,nom]");
$rec=$comp->m_records[8];
$test->assertEquals("Directeur-Adjoint",$rec["nom"],"Valeur de grid [8,nom]");
//LABELFORM - nb
$comp=$rep->getComponents('nbFonction');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre de fonctions affichés : 8","".$comp->m_value,"Valeur de nb");
//IMAGE - img
$comp=$rep->getComponents('imgType');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_contacts/images/contactCategorie.png","".$comp->m_value,"Valeur de img");
//LABELFORM - title
$comp=$rep->getComponents('titleType');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de title");
$test->assertEquals("{[newline]}{[center]}{[underline]}{[bold]}Liste des catégories{[/bold]}{[/underline]}{[/center]}","".$comp->m_value,"Valeur de title");
//GRID - typeMorale
$comp=$rep->getComponents('typeMorale');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de typeMorale");
$test->assertEquals(1,count($comp->m_headers),"Nb grid headers de typeMorale");
$test->assertEquals(2,count($comp->m_records),"Nb grid records de typeMorale");
$act=$comp->m_actions[0];
$test->assertEquals("_Ajouter",$act->m_title,'Titre grid action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext grid action #1');
$test->assertEquals("typesMorales_APAS_ajout",$act->m_action,'Act grid action #1');
$act=$comp->m_actions[1];
$test->assertEquals("_Supprimer",$act->m_title,'Titre grid action #2');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext grid action #2');
$test->assertEquals("typesMorales_APAS_suppr",$act->m_action,'Act grid action #2');
$headers=$comp->m_headers;
$test->assertEquals("Catégorie",$headers["nom"]->m_descript,'Header #1');
$rec=$comp->m_records[1];
$test->assertEquals("Entreprise",$rec["nom"],"Valeur de grid [1,nom]");
$rec=$comp->m_records[2];
$test->assertEquals("Association",$rec["nom"],"Valeur de grid [2,nom]");
//LABELFORM - nb
$comp=$rep->getComponents('nbType');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre de types affichés : 2","".$comp->m_value,"Valeur de nb");

// --- Modification des params ---------
$rep=$test->CallAction("org_lucterios_contacts","ChangeParams",array(),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
//IMAGE - img
$comp=$rep->getComponents('img');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_contacts/images/contactsConfig.png","".$comp->m_value,"Valeur de img");
//LABELFORM - title
$comp=$rep->getComponents('title');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de title");
$test->assertEquals("{[newline]}{[center]}{[bold]}Paramètres des contacts{[/bold]}{[/center]}","".$comp->m_value,"Valeur de title");
//LABELFORM - defaultGrouplbl
$comp=$rep->getComponents('defaultGrouplbl');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de defaultGrouplbl");
$test->assertEquals("{[bold]}Groupe par défaut{[/bold]}","".$comp->m_value,"Valeur de defaultGrouplbl");
//SELECT - defaultGroup
$comp=$rep->getComponents('defaultGroup');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de defaultGroup");
$test->assertEquals("99","".$comp->m_value,"Valeur de defaultGroup");
$test->assertEquals(2,COUNT($comp->m_select),'Nb select de defaultGroup');
//LABELFORM - defaultTypelbl
$comp=$rep->getComponents('defaultTypelbl');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de defaultTypelbl");
$test->assertEquals("{[bold]}Type par défaut{[/bold]}","".$comp->m_value,"Valeur de defaultTypelbl");
//SELECT - defaultType
$comp=$rep->getComponents('defaultType');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de defaultType");
$test->assertEquals("1","".$comp->m_value,"Valeur de defaultType");
$test->assertEquals(2,COUNT($comp->m_select),'Nb select de defaultType');
//LABELFORM - defaultFunctionlbl
$comp=$rep->getComponents('defaultFunctionlbl');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de defaultFunctionlbl");
$test->assertEquals("{[bold]}Fonction par défaut{[/bold]}","".$comp->m_value,"Valeur de defaultFunctionlbl");
//SELECT - defaultFunction
$comp=$rep->getComponents('defaultFunction');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de defaultFunction");
$test->assertEquals("1","".$comp->m_value,"Valeur de defaultFunction");
$test->assertEquals(8,COUNT($comp->m_select),'Nb select de defaultFunction');

$rep=$test->CallAction("CORE","extension_params_APAS_validerModif",array("defaultFunction"=>"3","defaultGroup"=>"1","defaultType"=>"2","extensionName"=>"org_lucterios_contacts",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","configuration",array(),"Xfer_Container_Custom");
$test->assertEquals(1,COUNT($rep->m_actions),'nb action');
//LABELFORM - defaultGroup
$comp=$rep->getComponents('defaultGroup');
$test->assertEquals("Admin","".$comp->m_value,"Valeur de defaultGroup");
//LABELFORM - defaultType
$comp=$rep->getComponents('defaultType');
$test->assertEquals("Association","".$comp->m_value,"Valeur de defaultType");
//LABELFORM - defaultFunction
$comp=$rep->getComponents('defaultFunction');
$test->assertEquals("Trésorier","".$comp->m_value,"Valeur de defaultFunction");

// --- Ajout/suppression fonctions ----
$rep=$test->CallAction("org_lucterios_contacts","fonctions_APAS_ajout",array(),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("Ajouter",$act->m_title,'Titre action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #1');
$test->assertEquals("fonctions_APAS_ajouteract",$act->m_action,'Act action #1');
$act=$rep->m_actions[1];
$test->assertEquals("Annuler",$act->m_title,'Titre action #2');
$test->assertEquals("",$act->m_extension,'Ext action #2');
$test->assertEquals("",$act->m_action,'Act action #2');
$test->assertEquals(5,$rep->getComponentCount(),'nb component');
//IMAGE - img
$comp=$rep->getComponents('img');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_contacts/images/contactFonction.png","".$comp->m_value,"Valeur de img");
//EDIT - nom
$comp=$rep->getComponents('nom');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de nom");
$test->assertEquals("","".$comp->m_value,"Valeur de nom");
//CHECK - readonly
$comp=$rep->getComponents('readonly');
$test->assertClass("Xfer_Comp_Check",$comp,"Classe de readonly");
$test->assertEquals(true,$comp->m_value,"Valeur de readonly");

$rep=$test->CallAction("org_lucterios_contacts","fonctions_APAS_ajouteract",array("nom"=>"Membre du C.A.","readonly"=>"n",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","configuration",array(),"Xfer_Container_Custom");
$test->assertEquals(1,COUNT($rep->m_actions),'nb action');
//GRID - fonction
$comp=$rep->getComponents('fonction');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de fonction");
$test->assertEquals(1,count($comp->m_headers),"Nb grid headers de fonction");
$test->assertEquals(9,count($comp->m_records),"Nb grid records de fonction");
$headers=$comp->m_headers;
$test->assertEquals("Nom",$headers["nom"]->m_descript,'Header #1');
$rec=$comp->m_records[1];
$test->assertEquals("Président",$rec["nom"],"Valeur de grid [1,nom]");
$rec=$comp->m_records[2];
$test->assertEquals("Vice-Président",$rec["nom"],"Valeur de grid [2,nom]");
$rec=$comp->m_records[3];
$test->assertEquals("Trésorier",$rec["nom"],"Valeur de grid [3,nom]");
$rec=$comp->m_records[4];
$test->assertEquals("Trésorier-Adjoint",$rec["nom"],"Valeur de grid [4,nom]");
$rec=$comp->m_records[5];
$test->assertEquals("Secrétaire",$rec["nom"],"Valeur de grid [5,nom]");
$rec=$comp->m_records[6];
$test->assertEquals("Secrétaire-Adjoint",$rec["nom"],"Valeur de grid [6,nom]");
$rec=$comp->m_records[7];
$test->assertEquals("Directeur",$rec["nom"],"Valeur de grid [7,nom]");
$rec=$comp->m_records[8];
$test->assertEquals("Directeur-Adjoint",$rec["nom"],"Valeur de grid [8,nom]");
$rec=$comp->m_records[100];
$test->assertEquals("Membre du C.A.",$rec["nom"],"Valeur de grid [100,nom]");
//LABELFORM - nb
$comp=$rep->getComponents('nbFonction');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre de fonctions affichés : 9","".$comp->m_value,"Valeur de nb");

$rep=$test->CallAction("org_lucterios_contacts","fonctions_APAS_suppr",array("CONFIRME"=>"YES","ORIGINE"=>"fonctions_APAS_suppr","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_contacts_fonctions","fonction"=>"100",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","configuration",array(),"Xfer_Container_Custom");
//GRID - fonction
$comp=$rep->getComponents('fonction');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de fonction");
$test->assertEquals(1,count($comp->m_headers),"Nb grid headers de fonction");
$test->assertEquals(8,count($comp->m_records),"Nb grid records de fonction");
//LABELFORM - nb
$comp=$rep->getComponents('nbFonction');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre de fonctions affichés : 8","".$comp->m_value,"Valeur de nb");

// --- Ajout/suppression de types morales ----
$rep=$test->CallAction("org_lucterios_contacts","typesMorales_APAS_ajout",array(),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("Ajouter",$act->m_title,'Titre action #2');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #2');
$test->assertEquals("typesMorales_APAS_ajouteract",$act->m_action,'Act action #2');
$act=$rep->m_actions[1];
$test->assertEquals("Annuler",$act->m_title,'Titre action #1');
$test->assertEquals("",$act->m_extension,'Ext action #1');
$test->assertEquals("",$act->m_action,'Act action #1');
$test->assertEquals(5,$rep->getComponentCount(),'nb component');
//IMAGE - img
$comp=$rep->getComponents('img');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_contacts/images/contactCategorie.png","".$comp->m_value,"Valeur de img");
//EDIT - nom
$comp=$rep->getComponents('nom');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de nom");
$test->assertEquals("","".$comp->m_value,"Valeur de nom");
//CHECK - readonly
$comp=$rep->getComponents('readonly');
$test->assertClass("Xfer_Comp_Check",$comp,"Classe de readonly");
$test->assertEquals(false,$comp->m_value,"Valeur de readonly");

$rep=$test->CallAction("org_lucterios_contacts","typesMorales_APAS_ajouteract",array("nom"=>"Administration","readonly"=>"n",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","configuration",array(),"Xfer_Container_Custom");
//GRID - typeMorale
$comp=$rep->getComponents('typeMorale');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de typeMorale");
$test->assertEquals(1,count($comp->m_headers),"Nb grid headers de typeMorale");
$test->assertEquals(3,count($comp->m_records),"Nb grid records de typeMorale");
$headers=$comp->m_headers;
$test->assertEquals("Catégorie",$headers["nom"]->m_descript,'Header #1');
$rec=$comp->m_records[1];
$test->assertEquals("Entreprise",$rec["nom"],"Valeur de grid [1,nom]");
$rec=$comp->m_records[2];
$test->assertEquals("Association",$rec["nom"],"Valeur de grid [2,nom]");
$rec=$comp->m_records[100];
$test->assertEquals("Administration",$rec["nom"],"Valeur de grid [100,nom]");
//LABELFORM - nb
$comp=$rep->getComponents('nbType');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre de types affichés : 3","".$comp->m_value,"Valeur de nb");

$rep=$test->CallAction("org_lucterios_contacts","typesMorales_APAS_suppr",array("CONFIRME"=>"YES","ORIGINE"=>"typesMorales_APAS_suppr","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_contacts_typesMorales","typeMorale"=>"100",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","configuration",array(),"Xfer_Container_Custom");
//GRID - typeMorale
$comp=$rep->getComponents('typeMorale');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de typeMorale");
$test->assertEquals(1,count($comp->m_headers),"Nb grid headers de typeMorale");
$test->assertEquals(2,count($comp->m_records),"Nb grid records de typeMorale");
//LABELFORM - nb
$comp=$rep->getComponents('nbType');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre de types affichés : 2","".$comp->m_value,"Valeur de nb");
//@CODE_ACTION@
}

?>
