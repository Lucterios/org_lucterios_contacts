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
// --- Last modification: Date 15 November 2011 21:39:22 By  ---


//@TABLES@
//@TABLES@

//@DESC@Ajouter un responsable à la structure courante
//@PARAM@ 

function org_lucterios_contacts_AjouterResponsable(&$test)
{
//@CODE_ACTION@
// --- initial ---
$rep=$test->CallAction("org_lucterios_contacts","StructureLocal",array(),"Xfer_Container_Custom");
$test->assertEquals(3,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("_Modifier",$act->m_title,'Titre action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #1');
$test->assertEquals("personneMorale_APAS_AddModify",$act->m_action,'Act action #1');
$act=$rep->m_actions[1];
$test->assertEquals("_Imprimer",$act->m_title,'Titre action #2');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #2');
$test->assertEquals("ImpressionLocal",$act->m_action,'Act action #2');
$act=$rep->m_actions[2];
$test->assertEquals("_Fermer",$act->m_title,'Titre action #3');
$test->assertEquals("",$act->m_extension,'Ext action #3');
$test->assertEquals("",$act->m_action,'Act action #3');
$test->assertEquals(31,$rep->getComponentCount(),'nb component');
//IMAGE - img
$comp=$rep->getComponents('img');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_contacts/images/nousContact.png","".$comp->m_value,"Valeur de img");
//LABELFORM - title_personne
$comp=$rep->getComponents('title_personne');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de title_personne");
$test->assertEquals("{[center]}{[bold]}Coordonnées de notre structure{[newline]}et de nos responsables{[/bold]}{[/center]}","".$comp->m_value,"Valeur de title_personne");
//IMAGE - logo
$comp=$rep->getComponents('logo');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de logo");
$test->assertEquals("extensions/org_lucterios_contacts/images/NoImage.png","".$comp->m_value,"Valeur de logo");
//LABEL - raisonSociale
$comp=$rep->getComponents('raisonSociale');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de raisonSociale");
$test->assertEquals("","".$comp->m_value,"Valeur de raisonSociale");
//LABEL - adresse
$comp=$rep->getComponents('adresse');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de adresse");
$test->assertEquals("","".$comp->m_value,"Valeur de adresse");
//LINK - plan
$comp=$rep->getComponents('plan');
$test->assertClass("Xfer_Comp_LinkLabel",$comp,"Classe de plan");
$test->assertEquals("plan","".$comp->m_value,"Valeur de plan");
$test->assertEquals("http://maps.google.fr/maps?near=++",$comp->m_Link,"Liens de plan");
//LABEL - codePostal
$comp=$rep->getComponents('codePostal');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de codePostal");
$test->assertEquals("","".$comp->m_value,"Valeur de codePostal");
//LABEL - ville
$comp=$rep->getComponents('ville');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de ville");
$test->assertEquals("","".$comp->m_value,"Valeur de ville");
//LABEL - pays
$comp=$rep->getComponents('pays');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de pays");
$test->assertEquals("","".$comp->m_value,"Valeur de pays");
//LINK - mail
$comp=$rep->getComponents('mail');
$test->assertClass("Xfer_Comp_LinkLabel",$comp,"Classe de mail");
$test->assertEquals("","".$comp->m_value,"Valeur de mail");
$test->assertEquals("mailto:",$comp->m_Link,"Liens de mail");
//LABEL - fixe
$comp=$rep->getComponents('fixe');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de fixe");
$test->assertEquals("","".$comp->m_value,"Valeur de fixe");
//LABEL - portable
$comp=$rep->getComponents('portable');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de portable");
$test->assertEquals("","".$comp->m_value,"Valeur de portable");
//LABEL - fax
$comp=$rep->getComponents('fax');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de fax");
$test->assertEquals("","".$comp->m_value,"Valeur de fax");
//LABEL - siren
$comp=$rep->getComponents('siren');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de siren");
$test->assertEquals("","".$comp->m_value,"Valeur de siren");
//LABEL - commentaire
$comp=$rep->getComponents('commentaire');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de commentaire");
$test->assertEquals("","".$comp->m_value,"Valeur de commentaire");
//GRID - liaison_physique
$comp=$rep->getComponents('liaison_physique');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de liaison_physique");
$test->assertEquals(6,count($comp->m_headers),"Nb grid headers de liaison_physique");
$test->assertEquals(0,count($comp->m_records),"Nb grid records de liaison_physique");
$act=$comp->m_actions[0];
$test->assertEquals("_Editer",$act->m_title,'Titre grid action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext grid action #1');
$test->assertEquals("liaison_APAS_Fiche",$act->m_action,'Act grid action #1');
$act=$comp->m_actions[1];
$test->assertEquals("_Rechercher/Ajouter",$act->m_title,'Titre grid action #2');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext grid action #2');
$test->assertEquals("liaison_APAS_AddSearch",$act->m_action,'Act grid action #2');
$headers=$comp->m_headers;
$test->assertEquals("Photo",$headers["Photo#|##getPhoto"]->m_descript,'Header #1');
$test->assertEquals("Nom",$headers["nom"]->m_descript,'Header #2');
$test->assertEquals("Prénom",$headers["prenom"]->m_descript,'Header #3');
$test->assertEquals("Fonctions",$headers["functions"]->m_descript,'Header #4');
$test->assertEquals("Téléphones",$headers["allTel"]->m_descript,'Header #5');
$test->assertEquals("Courriel",$headers["mail"]->m_descript,'Header #6');
//LABELFORM - nbresponsable
$comp=$rep->getComponents('nbresponsable');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nbresponsable");
$test->assertEquals("Nombre de responsables : 0","".$comp->m_value,"Valeur de nbresponsable");
//LINK - email
$comp=$rep->getComponents('email');
$test->assertClass("Xfer_Comp_LinkLabel",$comp,"Classe de email");
$test->assertEquals("Ecrire a tous","".$comp->m_value,"Valeur de email");
$test->assertEquals("mailto:",$comp->m_Link,"Liens de email");

// --- modifier structure ---
$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_AddModify",array("personneMorale"=>"1",),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
$test->assertEquals(26,$rep->getComponentCount(),'nb component');
$rep=$test->CallAction("CORE","UNLOCK",array("ORIGINE"=>"personneMorale_APAS_AddModify","RECORD_ID"=>"1","TABLE_NAME"=>"org_lucterios_contacts_personneMorale","adresse"=>"Place de la mairie","codePostal"=>"49600","commentaire"=>"","fax"=>"","fixe"=>"","mail"=>"","pays"=>"","personneMorale"=>"1","portable"=>"","raisonSociale"=>"Ma structure","siren"=>"","ville"=>"",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_AddModifyAct",array("ORIGINE"=>"personneMorale_APAS_AddModify","RECORD_ID"=>"1","TABLE_NAME"=>"org_lucterios_contacts_personneMorale","adresse"=>"Place de la mairie","codePostal"=>"49600","commentaire"=>"","fax"=>"","fixe"=>"","mail"=>"structure@hotmail.fr","pays"=>"FRANCE","personneMorale"=>"1","portable"=>"","raisonSociale"=>"Ma structure","siren"=>"","ville"=>"LA CHAPELLE DU GENET",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","StructureLocal",array("personneMorale"=>"1",),"Xfer_Container_Custom");
$test->assertEquals(3,COUNT($rep->m_actions),'nb action');
$test->assertEquals(31,$rep->getComponentCount(),'nb component');
//LABEL - raisonSociale
$comp=$rep->getComponents('raisonSociale');
$test->assertEquals("Ma structure","".$comp->m_value,"Valeur de raisonSociale");
//LABEL - adresse
$comp=$rep->getComponents('adresse');
$test->assertEquals("Place de la mairie","".$comp->m_value,"Valeur de adresse");
//LINK - plan
$comp=$rep->getComponents('plan');
$test->assertEquals("http://maps.google.fr/maps?near=Place+de+la+mairie+49600+LA CHAPELLE DU GENET",$comp->m_Link,"Liens de plan");
//LABEL - codePostal
$comp=$rep->getComponents('codePostal');
$test->assertEquals("49600","".$comp->m_value,"Valeur de codePostal");
//LABEL - ville
$comp=$rep->getComponents('ville');
$test->assertEquals("LA CHAPELLE DU GENET","".$comp->m_value,"Valeur de ville");
//LABEL - pays
$comp=$rep->getComponents('pays');
$test->assertEquals("FRANCE","".$comp->m_value,"Valeur de pays");
//LINK - mail
$comp=$rep->getComponents('mail');
$test->assertEquals("structure@hotmail.fr","".$comp->m_value,"Valeur de mail");
$test->assertEquals("mailto:structure@hotmail.fr",$comp->m_Link,"Liens de mail");
//GRID - liaison_physique
$comp=$rep->getComponents('liaison_physique');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de liaison_physique");
$test->assertEquals(6,count($comp->m_headers),"Nb grid headers de liaison_physique");
$test->assertEquals(0,count($comp->m_records),"Nb grid records de liaison_physique");
//LABELFORM - nbresponsable
$comp=$rep->getComponents('nbresponsable');
$test->assertEquals("Nombre de responsables : 0","".$comp->m_value,"Valeur de nbresponsable");
//LINK - email
$comp=$rep->getComponents('email');
$test->assertEquals("mailto:",$comp->m_Link,"Liens de email");

// --- Ajouter président ---
$rep=$test->CallAction("org_lucterios_contacts","liaison_APAS_AddSearch",array("personneMorale"=>"1",),"Xfer_Container_Custom");
$test->assertEquals(3,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("_Ok",$act->m_title,'Titre action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #1');
$test->assertEquals("liaison_APAS_AddSearchyAct",$act->m_action,'Act action #1');
$act=$rep->m_actions[1];
$test->assertEquals("_Créer",$act->m_title,'Titre action #2');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #2');
$test->assertEquals("liaison_APAS_AddModify",$act->m_action,'Act action #2');
$act=$rep->m_actions[2];
$test->assertEquals("_Annuler",$act->m_title,'Titre action #3');
$test->assertEquals("",$act->m_extension,'Ext action #3');
$test->assertEquals("",$act->m_action,'Act action #3');
$test->assertEquals(16,$rep->getComponentCount(),'nb component');
//LABEL - morale
$comp=$rep->getComponents('morale');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de morale");
$test->assertEquals("Ma structure","".$comp->m_value,"Valeur de morale");
//SELECT - fonction
$comp=$rep->getComponents('fonction');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de fonction");
$test->assertEquals("1","".$comp->m_value,"Valeur de fonction");
$test->assertEquals(8,COUNT($comp->m_select),'Nb select de fonction');
//SELECT - searchSelector
$comp=$rep->getComponents('searchSelector');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de searchSelector");
$test->assertEquals(11,COUNT($comp->m_select),'Nb select de searchSelector');
//SELECT - searchOperator
$comp=$rep->getComponents('searchOperator');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de searchOperator");
$test->assertEquals(0,COUNT($comp->m_select),'Nb select de searchOperator');
//FLOAT - searchValueFloat
$comp=$rep->getComponents('searchValueFloat');
$test->assertClass("Xfer_Comp_Float",$comp,"Classe de searchValueFloat");
//BUTTON - searchButtonAdd
$comp=$rep->getComponents('searchButtonAdd');
$test->assertClass("Xfer_Comp_Button",$comp,"Classe de searchButtonAdd");
$act=$comp->m_action;
$test->assertEquals("",$act->m_title,'Titre action btn');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action btn');
$test->assertEquals("liaison_APAS_AddSearch",$act->m_action,'Act action btn');
//EDIT - searchValueStr
$comp=$rep->getComponents('searchValueStr');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de searchValueStr");
//CHECK - searchValueBool
$comp=$rep->getComponents('searchValueBool');
$test->assertClass("Xfer_Comp_Check",$comp,"Classe de searchValueBool");
//DATE - searchValueDate
$comp=$rep->getComponents('searchValueDate');
$test->assertClass("Xfer_Comp_Date",$comp,"Classe de searchValueDate");
//TIME - searchValueTime
$comp=$rep->getComponents('searchValueTime');
$test->assertClass("Xfer_Comp_Time",$comp,"Classe de searchValueTime");
//CHECKLIST - searchValueList
$comp=$rep->getComponents('searchValueList');
$test->assertClass("Xfer_Comp_CheckList",$comp,"Classe de searchValueList");

$rep=$test->CallAction("org_lucterios_contacts","liaison_APAS_AddSearchyAct",array("ACT"=>"ADD","CRITERIA"=>"nom||5||toto||array%28%27fieldname%27%3D%3E%27nom%27%2C+%27description%27%3D%3E%27Nom%27%2C+%27list%27%3D%3E%27%27%2C+%27type%27%3D%3E%27str%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personnePhysique.nom%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personnePhysique%27%29%2C+%27wheres%27%3D%3Earray%28%29%29","fonction"=>"1","personneMorale"=>"1","searchOperator"=>"5","searchSelector"=>"nom","searchValueBool"=>"n","searchValueDate"=>"2011-11-08","searchValueFloat"=>"0.00","searchValueList"=>"","searchValueStr"=>"","searchValueTime"=>"00:00",),"Xfer_Container_Custom");
$test->assertEquals(0,COUNT($rep->m_actions),'nb action');
$test->assertEquals(6,$rep->getComponentCount(),'nb component');
//LABEL - morale
$comp=$rep->getComponents('morale');
$test->assertEquals("Ma structure","".$comp->m_value,"Valeur de morale");
//LABEL - fonction
$comp=$rep->getComponents('fonction');
$test->assertEquals("Président","".$comp->m_value,"Valeur de fonction");
//LABELFORM - titreFind
$comp=$rep->getComponents('titreFind');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de titreFind");
$test->assertEquals('{[underline]}Vos critères de recherche:{[/underline]} {[bold]}Nom{[/bold]} contient {[italic]}"toto"{[italic]}',"".$comp->m_value,"Valeur de titreFind");
//GRID - personnePhysique
$comp=$rep->getComponents('personnePhysique');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de personnePhysique");
$test->assertEquals(5,count($comp->m_headers),"Nb grid headers de personnePhysique");
$test->assertEquals(0,count($comp->m_records),"Nb grid records de personnePhysique");

$rep=$test->CallAction("org_lucterios_contacts","liaison_APAS_AddModify",array("ACT"=>"ADD","CRITERIA"=>"nom||5||toto||array%28%27fieldname%27%3D%3E%27nom%27%2C+%27description%27%3D%3E%27Nom%27%2C+%27list%27%3D%3E%27%27%2C+%27type%27%3D%3E%27str%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personnePhysique.nom%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personnePhysique%27%29%2C+%27wheres%27%3D%3Earray%28%29%29","fonction"=>"1","personneMorale"=>"1","searchOperator"=>"5","searchSelector"=>"nom","searchValueBool"=>"n","searchValueDate"=>"2011-11-08","searchValueFloat"=>"0.00","searchValueList"=>"","searchValueStr"=>"","searchValueTime"=>"00:00",),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("_Ok",$act->m_title,'Titre action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #1');
$test->assertEquals("liaison_APAS_AddModifyAct",$act->m_action,'Act action #1');
$act=$rep->m_actions[1];
$test->assertEquals("_Annuler",$act->m_title,'Titre action #2');
$test->assertEquals("",$act->m_extension,'Ext action #2');
$test->assertEquals("",$act->m_action,'Act action #2');
$test->assertEquals(32,$rep->getComponentCount(),'nb component');
//LABEL - morale
$comp=$rep->getComponents('morale');
$test->assertEquals("Ma structure","".$comp->m_value,"Valeur de morale");
//SELECT - fonction
$comp=$rep->getComponents('fonction');
$test->assertEquals("1","".$comp->m_value,"Valeur de fonction");
$test->assertEquals(8,COUNT($comp->m_select),'Nb select de fonction');
//SELECT - sexe
$comp=$rep->getComponents('sexe');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de sexe");
$test->assertEquals(2,COUNT($comp->m_select),'Nb select de sexe');
//EDIT - nom
$comp=$rep->getComponents('nom');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de nom");
//EDIT - prenom
$comp=$rep->getComponents('prenom');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de prenom");
//MEMO - adresse
$comp=$rep->getComponents('adresse');
$test->assertClass("Xfer_Comp_Memo",$comp,"Classe de adresse");
//EDIT - codePostal
$comp=$rep->getComponents('codePostal');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de codePostal");
//EDIT - ville
$comp=$rep->getComponents('ville');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de ville");
//EDIT - pays
$comp=$rep->getComponents('pays');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de pays");
//EDIT - fixe
$comp=$rep->getComponents('fixe');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de fixe");
//EDIT - portable
$comp=$rep->getComponents('portable');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de portable");
//EDIT - fax
$comp=$rep->getComponents('fax');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de fax");
//EDIT - mail
$comp=$rep->getComponents('mail');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de mail");
//MEMO - commentaire
$comp=$rep->getComponents('commentaire');
$test->assertClass("Xfer_Comp_Memo",$comp,"Classe de commentaire");
$rep=$test->CallAction("CORE","UNLOCK",array("ACT"=>"ADD","CRITERIA"=>"nom||5||toto||array%28%27fieldname%27%3D%3E%27nom%27%2C+%27description%27%3D%3E%27Nom%27%2C+%27list%27%3D%3E%27%27%2C+%27type%27%3D%3E%27str%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personnePhysique.nom%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personnePhysique%27%29%2C+%27wheres%27%3D%3Earray%28%29%29","ORIGINE"=>"liaison_APAS_AddModify","RECORD_ID"=>"","TABLE_NAME"=>"org_lucterios_contacts_liaison","adresse"=>"chemin du halage","codePostal"=>"49600","commentaire"=>"","fax"=>"","fixe"=>"","fonction"=>"1","mail"=>"","nom"=>"TOTO","pays"=>"","personneMorale"=>"1","portable"=>"","prenom"=>"Paul","searchOperator"=>"5","searchSelector"=>"nom","searchValueBool"=>"n","searchValueDate"=>"2011-11-08","searchValueFloat"=>"0.00","searchValueList"=>"","searchValueStr"=>"","searchValueTime"=>"00:00","sexe"=>"0","ville"=>"",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","liaison_APAS_AddModifyAct",array("ACT"=>"ADD","CRITERIA"=>"nom||5||toto||array%28%27fieldname%27%3D%3E%27nom%27%2C+%27description%27%3D%3E%27Nom%27%2C+%27list%27%3D%3E%27%27%2C+%27type%27%3D%3E%27str%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personnePhysique.nom%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personnePhysique%27%29%2C+%27wheres%27%3D%3Earray%28%29%29","ORIGINE"=>"liaison_APAS_AddModify","RECORD_ID"=>"","TABLE_NAME"=>"org_lucterios_contacts_liaison","adresse"=>"chemin du halage","codePostal"=>"49600","commentaire"=>"","fax"=>"","fixe"=>"","fonction"=>"1","mail"=>"","nom"=>"TOTO","pays"=>"FRANCE","personneMorale"=>"1","portable"=>"06.98.76.54.32","prenom"=>"Paul","searchOperator"=>"5","searchSelector"=>"nom","searchValueBool"=>"n","searchValueDate"=>"2011-11-08","searchValueFloat"=>"0.00","searchValueList"=>"","searchValueStr"=>"","searchValueTime"=>"00:00","sexe"=>"0","ville"=>"LA CHAPELLE DU GENET",),"Xfer_Container_Acknowledge");
$act=$rep->Redirect;
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action');
$test->assertEquals("liaison_APAS_Fiche",$act->m_action,'Act action');

$rep=$test->CallAction("org_lucterios_contacts","liaison_APAS_Fiche",array("liaison_physique"=>"100","personneMorale"=>"1",),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("_Modifier",$act->m_title,'Titre action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #1');
$test->assertEquals("personnePhysique_APAS_AddModify",$act->m_action,'Act action #1');
$act=$rep->m_actions[1];
$test->assertEquals("_Fermer",$act->m_title,'Titre action #2');
$test->assertEquals("",$act->m_extension,'Ext action #2');
$test->assertEquals("",$act->m_action,'Act action #2');
$test->assertEquals(37,$rep->getComponentCount(),'nb component');
//LABEL - morale
$comp=$rep->getComponents('morale');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de morale");
$test->assertEquals("Ma structure","".$comp->m_value,"Valeur de morale");
//CHECKLIST - liaison
$comp=$rep->getComponents('liaison');
$test->assertClass("Xfer_Comp_CheckList",$comp,"Classe de liaison");
$test->assertEquals(1,COUNT($comp->m_select),'Nb check de liaison');
//BUTTON - add
$comp=$rep->getComponents('add');
$test->assertClass("Xfer_Comp_Button",$comp,"Classe de add");
$act=$comp->m_action;
$test->assertEquals("_Ajouter",$act->m_title,'Titre action btn');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action btn');
$test->assertEquals("liaison_APAS_addFunction",$act->m_action,'Act action btn');
//BUTTON - del
$comp=$rep->getComponents('del');
$test->assertClass("Xfer_Comp_Button",$comp,"Classe de del");
$act=$comp->m_action;
$test->assertEquals("_Supprimer",$act->m_title,'Titre action btn');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action btn');
$test->assertEquals("liaison_APAS_Del",$act->m_action,'Act action btn');
//LABEL - sexe
$comp=$rep->getComponents('sexe');
$test->assertEquals("Monsieur","".$comp->m_value,"Valeur de sexe");
//IMAGE - logo
$comp=$rep->getComponents('logo');
$test->assertEquals("extensions/org_lucterios_contacts/images/NoImage.png","".$comp->m_value,"Valeur de logo");
//LABEL - nom
$comp=$rep->getComponents('nom');
$test->assertEquals("TOTO","".$comp->m_value,"Valeur de nom");
//LABEL - prenom
$comp=$rep->getComponents('prenom');
$test->assertEquals("Paul","".$comp->m_value,"Valeur de prenom");
//LABEL - adresse
$comp=$rep->getComponents('adresse');
$test->assertEquals("chemin du halage","".$comp->m_value,"Valeur de adresse");
//LINK - plan
$comp=$rep->getComponents('plan');
$test->assertEquals("http://maps.google.fr/maps?near=chemin+du+halage+49600+LA CHAPELLE DU GENET",$comp->m_Link,"Liens de plan");
//LABEL - codePostal
$comp=$rep->getComponents('codePostal');
$test->assertEquals("49600","".$comp->m_value,"Valeur de codePostal");
//LABEL - ville
$comp=$rep->getComponents('ville');
$test->assertEquals("LA CHAPELLE DU GENET","".$comp->m_value,"Valeur de ville");
//LABEL - pays
$comp=$rep->getComponents('pays');
$test->assertEquals("FRANCE","".$comp->m_value,"Valeur de pays");
//LINK - mail
$comp=$rep->getComponents('mail');
$test->assertEquals("mailto:",$comp->m_Link,"Liens de mail");
//LABEL - fixe
$comp=$rep->getComponents('fixe');
$test->assertEquals("","".$comp->m_value,"Valeur de fixe");
//LABEL - portable
$comp=$rep->getComponents('portable');
$test->assertEquals("06.98.76.54.32","".$comp->m_value,"Valeur de portable");
//LABEL - fax
$comp=$rep->getComponents('fax');
$test->assertEquals("","".$comp->m_value,"Valeur de fax");
//LABELFORM - user
$comp=$rep->getComponents('user');
$test->assertEquals("---","".$comp->m_value,"Valeur de user");
//BUTTON - buttonLogin
$comp=$rep->getComponents('buttonLogin');
$test->assertClass("Xfer_Comp_Button",$comp,"Classe de buttonLogin");
$act=$comp->m_action;
$test->assertEquals("Créer un a_lias",$act->m_title,'Titre action btn');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action btn');
$test->assertEquals("personnePhysique_APAS_login",$act->m_action,'Act action btn');
//LABEL - commentaire
$comp=$rep->getComponents('commentaire');
$test->assertEquals("","".$comp->m_value,"Valeur de commentaire");

$rep=$test->CallAction("org_lucterios_contacts","StructureLocal",array("personneMorale"=>"1",),"Xfer_Container_Custom");
$test->assertEquals(3,COUNT($rep->m_actions),'nb action');
$test->assertEquals(31,$rep->getComponentCount(),'nb component');
//LABEL - raisonSociale
$comp=$rep->getComponents('raisonSociale');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de raisonSociale");
$test->assertEquals("Ma structure","".$comp->m_value,"Valeur de raisonSociale");
//GRID - liaison_physique
$comp=$rep->getComponents('liaison_physique');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de liaison_physique");
$test->assertEquals(6,count($comp->m_headers),"Nb grid headers de liaison_physique");
$test->assertEquals(1,count($comp->m_records),"Nb grid records de liaison_physique");
$rec=$comp->m_records[100];
$test->assertEquals("",$rec["Photo#|##getPhoto"],"Valeur de grid [100,Photo#|##getPhoto]");
$test->assertEquals("TOTO",$rec["nom"],"Valeur de grid [100,nom]");
$test->assertEquals("Paul",$rec["prenom"],"Valeur de grid [100,prenom]");
$test->assertEquals("Président",$rec["functions"],"Valeur de grid [100,functions]");
$test->assertEquals("{[newline]}06.98.76.54.32",$rec["allTel"],"Valeur de grid [100,allTel]");
$test->assertEquals("",$rec["mail"],"Valeur de grid [100,mail]");
//LABELFORM - nbresponsable
$comp=$rep->getComponents('nbresponsable');
$test->assertEquals("Nombre de responsables : 1","".$comp->m_value,"Valeur de nbresponsable");
//LINK - email
$comp=$rep->getComponents('email');
$test->assertEquals("mailto:",$comp->m_Link,"Liens de email");

// --- Ajouter connexion ---
$rep=$test->CallAction("org_lucterios_contacts","liaison_APAS_Fiche",array("liaison_physique"=>"100","personneMorale"=>"1",),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
$test->assertEquals(37,$rep->getComponentCount(),'nb component');
//LABEL - morale
$comp=$rep->getComponents('morale');
$test->assertEquals("Ma structure","".$comp->m_value,"Valeur de morale");
//CHECKLIST - liaison
$comp=$rep->getComponents('liaison');
$test->assertClass("Xfer_Comp_CheckList",$comp,"Classe de liaison");
$test->assertEquals(1,COUNT($comp->m_select),'Nb check de liaison');
//LABELFORM - title
$comp=$rep->getComponents('title');
$test->assertEquals("{[bold]}{[center]}{[newline]}Personne physique{[/center]}{[/bold]}","".$comp->m_value,"Valeur de title");
//LABEL - nom
$comp=$rep->getComponents('nom');
$test->assertEquals("TOTO","".$comp->m_value,"Valeur de nom");
//LABEL - prenom
$comp=$rep->getComponents('prenom');
$test->assertEquals("Paul","".$comp->m_value,"Valeur de prenom");
//LABELFORM - user
$comp=$rep->getComponents('user');
$test->assertEquals("---","".$comp->m_value,"Valeur de user");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_login",array("liaison"=>"","liaison_physique"=>"100","personneMorale"=>"1","personnePhysique"=>"100",),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("_OK",$act->m_title,'Titre action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #1');
$test->assertEquals("personnePhysique_APAS_validerLogin",$act->m_action,'Act action #1');
$act=$rep->m_actions[1];
$test->assertEquals("_Annuler",$act->m_title,'Titre action #2');
$test->assertEquals("",$act->m_extension,'Ext action #2');
$test->assertEquals("",$act->m_action,'Act action #2');
$test->assertEquals(11,$rep->getComponentCount(),'nb component');
//IMAGE - img
$comp=$rep->getComponents('img');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("images/user.png","".$comp->m_value,"Valeur de img");
//EDIT - login
$comp=$rep->getComponents('login');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de login");
$test->assertEquals("","".$comp->m_value,"Valeur de login");
//CHECK - actif
$comp=$rep->getComponents('actif');
$test->assertClass("Xfer_Comp_Check",$comp,"Classe de actif");
$test->assertEquals(true,$comp->m_value,"Valeur de actif");
//SELECT - groupId
$comp=$rep->getComponents('groupId');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de groupId");
$test->assertEquals("99","".$comp->m_value,"Valeur de groupId");
$test->assertEquals(2,COUNT($comp->m_select),'Nb select de groupId');
//LABELFORM - lab1
$comp=$rep->getComponents('lab1');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de lab1");
$test->assertEquals("{[bold]}mot de passe{[/bold]}","".$comp->m_value,"Valeur de lab1");
//PASSWD - newpass1
$comp=$rep->getComponents('newpass1');
$test->assertClass("Xfer_Comp_Passwd",$comp,"Classe de newpass1");
$test->assertEquals("","".$comp->m_value,"Valeur de newpass1");
//LABELFORM - lab2
$comp=$rep->getComponents('lab2');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de lab2");
$test->assertEquals("{[bold]}re-mot de passe{[/bold]}","".$comp->m_value,"Valeur de lab2");
//PASSWD - newpass2
$comp=$rep->getComponents('newpass2');
$test->assertClass("Xfer_Comp_Passwd",$comp,"Classe de newpass2");
$test->assertEquals("","".$comp->m_value,"Valeur de newpass2");

$rep=$test->CallAction("org_lucterios_contacts","personnePhysique_APAS_validerLogin",array("actif"=>"o","groupId"=>"1","liaison"=>"","liaison_physique"=>"100","login"=>"toto","newpass1"=>"toto","newpass2"=>"toto","personneMorale"=>"1","personnePhysique"=>"100",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","liaison_APAS_Fiche",array("liaison_physique"=>"100","personneMorale"=>"1","personnePhysique"=>"100",),"Xfer_Container_Custom");
//LABEL - nom
$comp=$rep->getComponents('nom');
$test->assertEquals("TOTO","".$comp->m_value,"Valeur de nom");
//LABEL - prenom
$comp=$rep->getComponents('prenom');
$test->assertEquals("Paul","".$comp->m_value,"Valeur de prenom");
//LABELFORM - user
$comp=$rep->getComponents('user');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de user");
$test->assertEquals("toto [Admin]","".$comp->m_value,"Valeur de user");

// --- Controler connexion ---
$rep=$test->CallAction("CORE","users_APAS_list",array(),"Xfer_Container_Custom");
$test->assertEquals(1,COUNT($rep->m_actions),'nb action');
$test->assertEquals(7,$rep->getComponentCount(),'nb component');
//LABELFORM - title
$comp=$rep->getComponents('title');
$test->assertEquals("{[center]}{[underline]}{[bold]}Utilisateurs du logiciel{[/bold]}{[/underline]}{[/center]}","".$comp->m_value,"Valeur de title");
//GRID - user_actif
$comp=$rep->getComponents('user_actif');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de user_actif");
$test->assertEquals(4,count($comp->m_headers),"Nb grid headers de user_actif");
$test->assertEquals(2,count($comp->m_records),"Nb grid records de user_actif");
$headers=$comp->m_headers;
$test->assertEquals("Alias",$headers["login"]->m_descript,'Header #1');
$test->assertEquals("Nom réel",$headers["realName"]->m_descript,'Header #2');
$test->assertEquals("Groupe",$headers["groupId"]->m_descript,'Header #3');
$rec=$comp->m_records[100];
$test->assertEquals("admin",$rec["login"],"Valeur de grid [100,login]");
$test->assertEquals("Administrateur",$rec["realName"],"Valeur de grid [100,realName]");
$test->assertEquals("Admin",$rec["groupId"],"Valeur de grid [100,groupId]");
$rec=$comp->m_records[101];
$test->assertEquals("toto",$rec["login"],"Valeur de grid [101,login]");
$test->assertEquals("TOTO Paul",$rec["realName"],"Valeur de grid [101,realName]");
$test->assertEquals("Admin",$rec["groupId"],"Valeur de grid [101,groupId]");
//GRID - user_desactif
$comp=$rep->getComponents('user_desactif');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de user_desactif");
$test->assertEquals(3,count($comp->m_headers),"Nb grid headers de user_desactif");
$test->assertEquals(1,count($comp->m_records),"Nb grid records de user_desactif");
$rec=$comp->m_records[99];
$test->assertEquals("",$rec["login"],"Valeur de grid [99,login]");
$test->assertEquals("Visiteur",$rec["realName"],"Valeur de grid [99,realName]");
$test->assertEquals("Visiteur",$rec["groupId"],"Valeur de grid [99,groupId]");
//@CODE_ACTION@
}

?>
