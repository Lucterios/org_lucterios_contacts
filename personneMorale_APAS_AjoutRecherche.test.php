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
// --- Last modification: Date 15 November 2011 21:41:30 By  ---


//@TABLES@
require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
//@TABLES@

//@DESC@Ajouter et rechercher des personnes moraux
//@PARAM@ 

function org_lucterios_contacts_personneMorale_APAS_AjoutRecherche(&$test)
{
//@CODE_ACTION@
// --- list vide initial -----
$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_List",array(),"Xfer_Container_Custom");
$test->assertEquals(3,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("_Imprimer",$act->m_title,'Titre action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #1');
$test->assertEquals("personneMorale_APAS_PrintList",$act->m_action,'Act action #1');
$act=$rep->m_actions[1];
$test->assertEquals("_Etiquettes",$act->m_title,'Titre action #2');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #2');
$test->assertEquals("personneMorale_APAS_PrintEtiquettes",$act->m_action,'Act action #2');
$act=$rep->m_actions[2];
$test->assertEquals("_Fermer",$act->m_title,'Titre action #3');
$test->assertEquals("",$act->m_extension,'Ext action #3');
$test->assertEquals("",$act->m_action,'Act action #3');
$test->assertEquals(7,$rep->getComponentCount(),'nb component');
//IMAGE - img
$comp=$rep->getComponents('img');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_contacts/images/contactMoral.png","".$comp->m_value,"Valeur de img");
//LABELFORM - titre
$comp=$rep->getComponents('titre');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de titre");
$test->assertEquals("{[center]}{[bold]}Liste des personnes morales{[/bold]}{[/center]}","".$comp->m_value,"Valeur de titre");
//LABELFORM - filtre
$comp=$rep->getComponents('filtre');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de filtre");
$test->assertEquals("{[italic]}Filtrer par catégorie{[/italic]}","".$comp->m_value,"Valeur de filtre");
//SELECT - Filtretype
$comp=$rep->getComponents('Filtretype');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de Filtretype");
$test->assertEquals("1","".$comp->m_value,"Valeur de Filtretype");
$test->assertEquals(2,COUNT($comp->m_select),'Nb select de Filtretype');
//GRID - personneMorale
$comp=$rep->getComponents('personneMorale');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de personneMorale");
$test->assertEquals(4,count($comp->m_headers),"Nb grid headers de personneMorale");
$test->assertEquals(0,count($comp->m_records),"Nb grid records de personneMorale");
$act=$comp->m_actions[0];
$test->assertEquals("_Editer",$act->m_title,'Titre grid action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext grid action #1');
$test->assertEquals("personneMorale_APAS_Fiche",$act->m_action,'Act grid action #1');
$act=$comp->m_actions[1];
$test->assertEquals("_Ajouter",$act->m_title,'Titre grid action #2');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext grid action #2');
$test->assertEquals("personneMorale_APAS_AddModify",$act->m_action,'Act grid action #2');
$headers=$comp->m_headers;
$test->assertEquals("Raison Sociale",$headers["raisonSociale"]->m_descript,'Header #1');
$test->assertEquals("Tel. Fixe",$headers["fixe"]->m_descript,'Header #2');
$test->assertEquals("Fax",$headers["fax"]->m_descript,'Header #3');
$test->assertEquals("Courriel",$headers["mail"]->m_descript,'Header #4');
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre total : 0","".$comp->m_value,"Valeur de nb");
//LINK - emailAll
$comp=$rep->getComponents('emailAll');
$test->assertClass("Xfer_Comp_LinkLabel",$comp,"Classe de emailAll");
$test->assertEquals("Ecrire a tous","".$comp->m_value,"Valeur de emailAll");
$test->assertEquals("mailto:",$comp->m_Link,"Liens de emailAll");

// --- Ajout entreprise
$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_AddModify",array("Filtretype"=>"1",),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("_Ok",$act->m_title,'Titre action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #1');
$test->assertEquals("personneMorale_APAS_AddModifyAct",$act->m_action,'Act action #1');
$act=$rep->m_actions[1];
$test->assertEquals("_Annuler",$act->m_title,'Titre action #2');
$test->assertEquals("",$act->m_extension,'Ext action #2');
$test->assertEquals("",$act->m_action,'Act action #2');
$test->assertEquals(28,$rep->getComponentCount(),'nb component');
//IMAGE - img
$comp=$rep->getComponents('img');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_contacts/images/contactMoral.png","".$comp->m_value,"Valeur de img");
//EDIT - raisonSociale
$comp=$rep->getComponents('raisonSociale');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de raisonSociale");
$test->assertEquals("","".$comp->m_value,"Valeur de raisonSociale");
//MEMO - adresse
$comp=$rep->getComponents('adresse');
$test->assertClass("Xfer_Comp_Memo",$comp,"Classe de adresse");
$test->assertEquals("","".$comp->m_value,"Valeur de adresse");
//EDIT - codePostal
$comp=$rep->getComponents('codePostal');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de codePostal");
$test->assertEquals("","".$comp->m_value,"Valeur de codePostal");
//EDIT - ville
$comp=$rep->getComponents('ville');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de ville");
$test->assertEquals("","".$comp->m_value,"Valeur de ville");
//EDIT - pays
$comp=$rep->getComponents('pays');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de pays");
$test->assertEquals("","".$comp->m_value,"Valeur de pays");
//EDIT - fixe
$comp=$rep->getComponents('fixe');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de fixe");
$test->assertEquals("","".$comp->m_value,"Valeur de fixe");
//EDIT - portable
$comp=$rep->getComponents('portable');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de portable");
$test->assertEquals("","".$comp->m_value,"Valeur de portable");
//EDIT - fax
$comp=$rep->getComponents('fax');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de fax");
$test->assertEquals("","".$comp->m_value,"Valeur de fax");
//EDIT - mail
$comp=$rep->getComponents('mail');
$test->assertClass("Xfer_Comp_Edit",$comp,"Classe de mail");
$test->assertEquals("","".$comp->m_value,"Valeur de mail");
//SELECT - type
$comp=$rep->getComponents('type');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de type");
$test->assertEquals("1","".$comp->m_value,"Valeur de type");
$test->assertEquals(2,COUNT($comp->m_select),'Nb select de type');
//MEMO - siren
$comp=$rep->getComponents('siren');
$test->assertClass("Xfer_Comp_Memo",$comp,"Classe de siren");
$test->assertEquals("","".$comp->m_value,"Valeur de siren");
//MEMO - commentaire
$comp=$rep->getComponents('commentaire');
$test->assertClass("Xfer_Comp_Memo",$comp,"Classe de commentaire");
$test->assertEquals("","".$comp->m_value,"Valeur de commentaire");
//LABELFORM - Lbl_uploadlogo
$comp=$rep->getComponents('Lbl_uploadlogo');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de Lbl_uploadlogo");
$test->assertEquals("{[bold]}Image{[/bold]}","".$comp->m_value,"Valeur de Lbl_uploadlogo");
//UPLOAD - uploadlogo
$comp=$rep->getComponents('uploadlogo');
$test->assertClass("Xfer_Comp_UpLoad",$comp,"Classe de uploadlogo");
$test->assertEquals("","".$comp->m_value,"Valeur de uploadlogo");
//LABELFORM - Lbl_warning
$comp=$rep->getComponents('Lbl_warning');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de Lbl_warning");
$test->assertEquals("{[center]}{[italic]}{[font size='-2']}Importer de préférence une image JPEG de 100x100 pts.{[/font]}{[/italic]}{[/center]}","".$comp->m_value,"Valeur de Lbl_warning");

$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_AddModifyAct",array("Filtretype"=>"1","ORIGINE"=>"personneMorale_APAS_AddModify","RECORD_ID"=>"","TABLE_NAME"=>"org_lucterios_contacts_personneMorale","adresse"=>"place de la république","codePostal"=>"69002","commentaire"=>"","fax"=>"","fixe"=>"04.72.12.45.78.96","mail"=>"sansos@free.fr","pays"=>"FRANCE","portable"=>"","raisonSociale"=>"Boucherie Sans-Os","siren"=>"","type"=>"1","ville"=>"LYON 2EME ARRONDISSEMENT",),"Xfer_Container_Acknowledge");
$act=$rep->Redirect;
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action');
$test->assertEquals("personneMorale_APAS_Fiche",$act->m_action,'Act action');

$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_Fiche",array("personneMorale"=>"100",),"Xfer_Container_Custom");
$test->assertEquals(4,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("_Modifier",$act->m_title,'Titre action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #1');
$test->assertEquals("personneMorale_APAS_AddModify",$act->m_action,'Act action #1');
$act=$rep->m_actions[1];
$test->assertEquals("_Imprimer",$act->m_title,'Titre action #2');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #2');
$test->assertEquals("personneMorale_APAS_PrintFile",$act->m_action,'Act action #2');
$act=$rep->m_actions[2];
$test->assertEquals("_Suppression",$act->m_title,'Titre action #3');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #3');
$test->assertEquals("personneAbstraite_APAS_Delete",$act->m_action,'Act action #3');
$act=$rep->m_actions[3];
$test->assertEquals("_Fermer",$act->m_title,'Titre action #4');
$test->assertEquals("",$act->m_extension,'Ext action #4');
$test->assertEquals("",$act->m_action,'Act action #4');
$test->assertEquals(33,$rep->getComponentCount(),'nb component');
//IMAGE - img
$comp=$rep->getComponents('img');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_contacts/images/contactMoral.png","".$comp->m_value,"Valeur de img");
//LABELFORM - title_personne
$comp=$rep->getComponents('title_personne');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de title_personne");
$test->assertEquals("{[bold]}{[center]}{[newline]}Personne morale{[/center]}{[/bold]}","".$comp->m_value,"Valeur de title_personne");
//IMAGE - logo
$comp=$rep->getComponents('logo');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de logo");
$test->assertEquals("extensions/org_lucterios_contacts/images/NoImage.png","".$comp->m_value,"Valeur de logo");
//LABEL - raisonSociale
$comp=$rep->getComponents('raisonSociale');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de raisonSociale");
$test->assertEquals("Boucherie Sans-Os","".$comp->m_value,"Valeur de raisonSociale");
//LABEL - adresse
$comp=$rep->getComponents('adresse');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de adresse");
$test->assertEquals("place de la république","".$comp->m_value,"Valeur de adresse");
//LINK - plan
$comp=$rep->getComponents('plan');
$test->assertClass("Xfer_Comp_LinkLabel",$comp,"Classe de plan");
$test->assertEquals("plan","".$comp->m_value,"Valeur de plan");
$test->assertEquals("http://maps.google.fr/maps?near=place+de+la+république+69002+LYON 2EME ARRONDISSEMENT",$comp->m_Link,"Liens de plan");
//LABEL - codePostal
$comp=$rep->getComponents('codePostal');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de codePostal");
$test->assertEquals("69002","".$comp->m_value,"Valeur de codePostal");
//LABEL - ville
$comp=$rep->getComponents('ville');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de ville");
$test->assertEquals("LYON 2EME ARRONDISSEMENT","".$comp->m_value,"Valeur de ville");
//LABEL - pays
$comp=$rep->getComponents('pays');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de pays");
$test->assertEquals("FRANCE","".$comp->m_value,"Valeur de pays");
//LINK - mail
$comp=$rep->getComponents('mail');
$test->assertClass("Xfer_Comp_LinkLabel",$comp,"Classe de mail");
$test->assertEquals("sansos@free.fr","".$comp->m_value,"Valeur de mail");
$test->assertEquals("mailto:sansos@free.fr",$comp->m_Link,"Liens de mail");
//LABEL - fixe
$comp=$rep->getComponents('fixe');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de fixe");
$test->assertEquals("04.72.12.45.78.","".$comp->m_value,"Valeur de fixe");
//LABEL - portable
$comp=$rep->getComponents('portable');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de portable");
$test->assertEquals("","".$comp->m_value,"Valeur de portable");
//LABEL - fax
$comp=$rep->getComponents('fax');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de fax");
$test->assertEquals("","".$comp->m_value,"Valeur de fax");
//LABEL - type
$comp=$rep->getComponents('type');
$test->assertClass("Xfer_Comp_Label",$comp,"Classe de type");
$test->assertEquals("Entreprise","".$comp->m_value,"Valeur de type");
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
$test->assertEquals(5,count($comp->m_headers),"Nb grid headers de liaison_physique");
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
$test->assertEquals("Nom",$headers["nom"]->m_descript,'Header #1');
$test->assertEquals("Prénom",$headers["prenom"]->m_descript,'Header #2');
$test->assertEquals("Fonctions",$headers["functions"]->m_descript,'Header #3');
$test->assertEquals("Téléphones",$headers["allTel"]->m_descript,'Header #4');
$test->assertEquals("Courriel",$headers["mail"]->m_descript,'Header #5');
//LABELFORM - nbresponsable
$comp=$rep->getComponents('nbresponsable');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nbresponsable");
$test->assertEquals("Nombre de responsables : 0","".$comp->m_value,"Valeur de nbresponsable");
//LINK - email
$comp=$rep->getComponents('email');
$test->assertClass("Xfer_Comp_LinkLabel",$comp,"Classe de email");
$test->assertEquals("Ecrire a tous","".$comp->m_value,"Valeur de email");
$test->assertEquals("mailto:",$comp->m_Link,"Liens de email");

$rep=$test->CallAction("CORE","UNLOCK",array("ORIGINE"=>"personneMorale_APAS_Fiche","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_contacts_personneMorale","abstractContact"=>"101","personneMorale"=>"100",),"Xfer_Container_Acknowledge");

// --- liste 1 contact ---
$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_List",array(),"Xfer_Container_Custom");
//SELECT - Filtretype
$comp=$rep->getComponents('Filtretype');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de Filtretype");
$test->assertEquals("1","".$comp->m_value,"Valeur de Filtretype");
$test->assertEquals(2,COUNT($comp->m_select),'Nb select de Filtretype');
//GRID - personneMorale
$comp=$rep->getComponents('personneMorale');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de personneMorale");
$test->assertEquals(4,count($comp->m_headers),"Nb grid headers de personneMorale");
$test->assertEquals(1,count($comp->m_records),"Nb grid records de personneMorale");
$rec=$comp->m_records[100];
$test->assertEquals("Boucherie Sans-Os",$rec["raisonSociale"],"Valeur de grid [100,raisonSociale]");
$test->assertEquals("04.72.12.45.78.",$rec["fixe"],"Valeur de grid [100,fixe]");
$test->assertEquals("",$rec["fax"],"Valeur de grid [100,fax]");
$test->assertEquals("sansos@free.fr",$rec["mail"],"Valeur de grid [100,mail]");
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertEquals("Nombre total : 1","".$comp->m_value,"Valeur de nb");
//LINK - emailAll
$comp=$rep->getComponents('emailAll');
$test->assertEquals("mailto:sansos@free.fr",$comp->m_Link,"Liens de emailAll");

// --- Ajouter association ---
$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_List",array("Filtretype"=>"2",),"Xfer_Container_Custom");
//SELECT - Filtretype
$comp=$rep->getComponents('Filtretype');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de Filtretype");
$test->assertEquals("2","".$comp->m_value,"Valeur de Filtretype");
$test->assertEquals(2,COUNT($comp->m_select),'Nb select de Filtretype');
//GRID - personneMorale
$comp=$rep->getComponents('personneMorale');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de personneMorale");
$test->assertEquals(4,count($comp->m_headers),"Nb grid headers de personneMorale");
$test->assertEquals(0,count($comp->m_records),"Nb grid records de personneMorale");
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertEquals("Nombre total : 0","".$comp->m_value,"Valeur de nb");
//LINK - emailAll
$comp=$rep->getComponents('emailAll');
$test->assertEquals("mailto:",$comp->m_Link,"Liens de emailAll");

$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_AddModify",array("Filtretype"=>"2",),"Xfer_Container_Custom");
//EDIT - raisonSociale
$comp=$rep->getComponents('raisonSociale');
$test->assertEquals("","".$comp->m_value,"Valeur de raisonSociale");
//MEMO - adresse
$comp=$rep->getComponents('adresse');
$test->assertEquals("","".$comp->m_value,"Valeur de adresse");
//EDIT - codePostal
$comp=$rep->getComponents('codePostal');
$test->assertEquals("","".$comp->m_value,"Valeur de codePostal");
//EDIT - ville
$comp=$rep->getComponents('ville');
$test->assertEquals("","".$comp->m_value,"Valeur de ville");
//EDIT - pays
$comp=$rep->getComponents('pays');
$test->assertEquals("","".$comp->m_value,"Valeur de pays");
//EDIT - fixe
$comp=$rep->getComponents('fixe');
$test->assertEquals("","".$comp->m_value,"Valeur de fixe");
//EDIT - portable
$comp=$rep->getComponents('portable');
$test->assertEquals("","".$comp->m_value,"Valeur de portable");
//EDIT - fax
$comp=$rep->getComponents('fax');
$test->assertEquals("","".$comp->m_value,"Valeur de fax");
//EDIT - mail
$comp=$rep->getComponents('mail');
$test->assertEquals("","".$comp->m_value,"Valeur de mail");
//SELECT - type
$comp=$rep->getComponents('type');
$test->assertEquals("2","".$comp->m_value,"Valeur de type");
$test->assertEquals(2,COUNT($comp->m_select),'Nb select de type');
//MEMO - siren
$comp=$rep->getComponents('siren');
$test->assertEquals("","".$comp->m_value,"Valeur de siren");
//MEMO - commentaire
$comp=$rep->getComponents('commentaire');
$test->assertEquals("","".$comp->m_value,"Valeur de commentaire");

$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_AddModifyAct",array("Filtretype"=>"2","ORIGINE"=>"personneMorale_APAS_AddModify","RECORD_ID"=>"","TABLE_NAME"=>"org_lucterios_contacts_personneMorale","adresse"=>"Cours de la libération","codePostal"=>"13004","commentaire"=>"","fax"=>"","fixe"=>"","mail"=>"bilboquet13@gmail.fr","pays"=>"FRANCE","portable"=>"06.87.95.42.48","raisonSociale"=>"Club de Bilboquet","siren"=>"","type"=>"2","ville"=>"MARSEILLE 4EME ARRONDISSEMENT",),"Xfer_Container_Acknowledge");
$act=$rep->Redirect;
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action');
$test->assertEquals("personneMorale_APAS_Fiche",$act->m_action,'Act action');

$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_Fiche",array("personneMorale"=>"101",),"Xfer_Container_Custom");
$test->assertEquals(4,COUNT($rep->m_actions),'nb action');
$test->assertEquals(33,$rep->getComponentCount(),'nb component');
//IMAGE - logo
$comp=$rep->getComponents('logo');
$test->assertEquals("extensions/org_lucterios_contacts/images/NoImage.png","".$comp->m_value,"Valeur de logo");
//LABEL - raisonSociale
$comp=$rep->getComponents('raisonSociale');
$test->assertEquals("Club de Bilboquet","".$comp->m_value,"Valeur de raisonSociale");
//LABEL - adresse
$comp=$rep->getComponents('adresse');
$test->assertEquals("Cours de la libération","".$comp->m_value,"Valeur de adresse");
//LINK - plan
$comp=$rep->getComponents('plan');
$test->assertEquals("plan","".$comp->m_value,"Valeur de plan");
$test->assertEquals("http://maps.google.fr/maps?near=Cours+de+la+libération+13004+MARSEILLE 4EME ARRONDISSEMENT",$comp->m_Link,"Liens de plan");
//LABEL - codePostal
$comp=$rep->getComponents('codePostal');
$test->assertEquals("13004","".$comp->m_value,"Valeur de codePostal");
//LABEL - ville
$comp=$rep->getComponents('ville');
$test->assertEquals("MARSEILLE 4EME ARRONDISSEMENT","".$comp->m_value,"Valeur de ville");
//LABEL - pays
$comp=$rep->getComponents('pays');
$test->assertEquals("FRANCE","".$comp->m_value,"Valeur de pays");
//LINK - mail
$comp=$rep->getComponents('mail');
$test->assertEquals("bilboquet13@gmail.fr","".$comp->m_value,"Valeur de mail");
$test->assertEquals("mailto:bilboquet13@gmail.fr",$comp->m_Link,"Liens de mail");
//LABEL - fixe
$comp=$rep->getComponents('fixe');
$test->assertEquals("","".$comp->m_value,"Valeur de fixe");
//LABEL - portable
$comp=$rep->getComponents('portable');
$test->assertEquals("06.87.95.42.48","".$comp->m_value,"Valeur de portable");
//LABEL - fax
$comp=$rep->getComponents('fax');
$test->assertEquals("","".$comp->m_value,"Valeur de fax");
//LABEL - type
$comp=$rep->getComponents('type');
$test->assertEquals("Association","".$comp->m_value,"Valeur de type");
//LABEL - siren
$comp=$rep->getComponents('siren');
$test->assertEquals("","".$comp->m_value,"Valeur de siren");
//LABEL - commentaire
$comp=$rep->getComponents('commentaire');
$test->assertEquals("","".$comp->m_value,"Valeur de commentaire");
//GRID - liaison_physique
$comp=$rep->getComponents('liaison_physique');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de liaison_physique");
$test->assertEquals(5,count($comp->m_headers),"Nb grid headers de liaison_physique");
$test->assertEquals(0,count($comp->m_records),"Nb grid records de liaison_physique");

$rep=$test->CallAction("CORE","UNLOCK",array("ORIGINE"=>"personneMorale_APAS_Fiche","RECORD_ID"=>"101","TABLE_NAME"=>"org_lucterios_contacts_personneMorale","abstractContact"=>"102","personneMorale"=>"101",),"Xfer_Container_Acknowledge");


// --- liste 2 contact ---
$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_List",array("Filtretype"=>"2",),"Xfer_Container_Custom");
$test->assertEquals(3,COUNT($rep->m_actions),'nb action');
$test->assertEquals(7,$rep->getComponentCount(),'nb component');
//SELECT - Filtretype
$comp=$rep->getComponents('Filtretype');
$test->assertEquals("2","".$comp->m_value,"Valeur de Filtretype");
$test->assertEquals(2,COUNT($comp->m_select),'Nb select de Filtretype');
//GRID - personneMorale
$comp=$rep->getComponents('personneMorale');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de personneMorale");
$test->assertEquals(4,count($comp->m_headers),"Nb grid headers de personneMorale");
$test->assertEquals(1,count($comp->m_records),"Nb grid records de personneMorale");
$rec=$comp->m_records[101];
$test->assertEquals("Club de Bilboquet",$rec["raisonSociale"],"Valeur de grid [101,raisonSociale]");
$test->assertEquals("",$rec["fixe"],"Valeur de grid [101,fixe]");
$test->assertEquals("",$rec["fax"],"Valeur de grid [101,fax]");
$test->assertEquals("bilboquet13@gmail.fr",$rec["mail"],"Valeur de grid [101,mail]");
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertEquals("Nombre total : 1","".$comp->m_value,"Valeur de nb");
//LINK - emailAll
$comp=$rep->getComponents('emailAll');
$test->assertEquals("mailto:bilboquet13@gmail.fr",$comp->m_Link,"Liens de emailAll");

// --- modif entreprise ---
$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_List",array("Filtretype"=>"1",),"Xfer_Container_Custom");
//GRID - personneMorale
$comp=$rep->getComponents('personneMorale');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de personneMorale");
$test->assertEquals(4,count($comp->m_headers),"Nb grid headers de personneMorale");
$test->assertEquals(1,count($comp->m_records),"Nb grid records de personneMorale");
$rec=$comp->m_records[100];
$test->assertEquals("Boucherie Sans-Os",$rec["raisonSociale"],"Valeur de grid [100,raisonSociale]");

$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_Fiche",array("Filtretype"=>"1","personneMorale"=>"100",),"Xfer_Container_Custom");
$test->assertEquals(4,COUNT($rep->m_actions),'nb action');
$test->assertEquals(33,$rep->getComponentCount(),'nb component');
//IMAGE - logo
$comp=$rep->getComponents('logo');
$test->assertEquals("extensions/org_lucterios_contacts/images/NoImage.png","".$comp->m_value,"Valeur de logo");
//LABEL - raisonSociale
$comp=$rep->getComponents('raisonSociale');
$test->assertEquals("Boucherie Sans-Os","".$comp->m_value,"Valeur de raisonSociale");
//LABEL - adresse
$comp=$rep->getComponents('adresse');
$test->assertEquals("place de la république","".$comp->m_value,"Valeur de adresse");
//LINK - plan
$comp=$rep->getComponents('plan');
$test->assertEquals("http://maps.google.fr/maps?near=place+de+la+république+69002+LYON 2EME ARRONDISSEMENT",$comp->m_Link,"Liens de plan");
//LABEL - codePostal
$comp=$rep->getComponents('codePostal');
$test->assertEquals("69002","".$comp->m_value,"Valeur de codePostal");
//LABEL - ville
$comp=$rep->getComponents('ville');
$test->assertEquals("LYON 2EME ARRONDISSEMENT","".$comp->m_value,"Valeur de ville");
//LABEL - pays
$comp=$rep->getComponents('pays');
$test->assertEquals("FRANCE","".$comp->m_value,"Valeur de pays");
//LINK - mail
$comp=$rep->getComponents('mail');
$test->assertEquals("sansos@free.fr","".$comp->m_value,"Valeur de mail");
$test->assertEquals("mailto:sansos@free.fr",$comp->m_Link,"Liens de mail");
//LABEL - fixe
$comp=$rep->getComponents('fixe');
$test->assertEquals("04.72.12.45.78.","".$comp->m_value,"Valeur de fixe");
//LABEL - portable
$comp=$rep->getComponents('portable');
$test->assertEquals("","".$comp->m_value,"Valeur de portable");
//LABEL - fax
$comp=$rep->getComponents('fax');
$test->assertEquals("","".$comp->m_value,"Valeur de fax");
//LABEL - type
$comp=$rep->getComponents('type');
$test->assertEquals("Entreprise","".$comp->m_value,"Valeur de type");
//LABEL - siren
$comp=$rep->getComponents('siren');
$test->assertEquals("","".$comp->m_value,"Valeur de siren");
//LABEL - commentaire
$comp=$rep->getComponents('commentaire');
$test->assertEquals("","".$comp->m_value,"Valeur de commentaire");
//GRID - liaison_physique
$comp=$rep->getComponents('liaison_physique');
$test->assertEquals(2,count($comp->m_actions),"Nb grid actions de liaison_physique");
$test->assertEquals(5,count($comp->m_headers),"Nb grid headers de liaison_physique");
$test->assertEquals(0,count($comp->m_records),"Nb grid records de liaison_physique");
$rep=$test->CallAction("CORE","UNLOCK",array("Filtretype"=>"1","ORIGINE"=>"personneMorale_APAS_Fiche","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_contacts_personneMorale","abstractContact"=>"101","personneMorale"=>"100",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_AddModify",array("Filtretype"=>"1","ORIGINE"=>"personneMorale_APAS_Fiche","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_contacts_personneMorale","abstractContact"=>"101","personneMorale"=>"100",),"Xfer_Container_Custom");
$test->assertEquals(2,COUNT($rep->m_actions),'nb action');
$test->assertEquals(28,$rep->getComponentCount(),'nb component');
$rep=$test->CallAction("CORE","UNLOCK",array("Filtretype"=>"1","ORIGINE"=>"personneMorale_APAS_AddModify","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_contacts_personneMorale","abstractContact"=>"101","personneMorale"=>"100",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_AddModifyAct",array("Filtretype"=>"1","ORIGINE"=>"personneMorale_APAS_AddModify","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_contacts_personneMorale","abstractContact"=>"101","adresse"=>"place de la république","codePostal"=>"69002","commentaire"=>"","fax"=>"","fixe"=>"04.72.12.45.78.","mail"=>"sansos@free.fr","pays"=>"FRANCE","personneMorale"=>"100","portable"=>"","raisonSociale"=>"Boucherie Sans-Os","siren"=>"SIRET: 123456RTE565","type"=>"1","ville"=>"LYON 2EME ARRONDISSEMENT",),"Xfer_Container_Acknowledge");
$act=$rep->Redirect;
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action');
$test->assertEquals("personneMorale_APAS_Fiche",$act->m_action,'Act action');

$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_Fiche",array("personneMorale"=>"100",),"Xfer_Container_Custom");
//LABEL - raisonSociale
$comp=$rep->getComponents('raisonSociale');
$test->assertEquals("Boucherie Sans-Os","".$comp->m_value,"Valeur de raisonSociale");
//LABEL - siren
$comp=$rep->getComponents('siren');
$test->assertEquals("SIRET: 123456RTE565","".$comp->m_value,"Valeur de siren");
$rep=$test->CallAction("CORE","UNLOCK",array("ORIGINE"=>"personneMorale_APAS_Fiche","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_contacts_personneMorale","abstractContact"=>"101","personneMorale"=>"100",),"Xfer_Container_Acknowledge");

// --- Recherche ---
$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_Search",array(),"Xfer_Container_Custom");
$test->assertEquals(3,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("_Rechercher",$act->m_title,'Titre action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #1');
$test->assertEquals("personneMorale_APAS_List",$act->m_action,'Act action #1');
$act=$rep->m_actions[1];
$test->assertEquals("_Doublons",$act->m_title,'Titre action #2');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #2');
$test->assertEquals("personneMorale_APAS_rechercheDoublon",$act->m_action,'Act action #2');
$act=$rep->m_actions[2];
$test->assertEquals("_Annuler",$act->m_title,'Titre action #3');
$test->assertEquals("",$act->m_extension,'Ext action #3');
$test->assertEquals("",$act->m_action,'Act action #3');
$test->assertEquals(14,$rep->getComponentCount(),'nb component');
//IMAGE - img
$comp=$rep->getComponents('img');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_contacts/images/contactMoralFind.png","".$comp->m_value,"Valeur de img");
//LABELFORM - title
$comp=$rep->getComponents('title');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de title");
$test->assertEquals("{[center]}{[underline]}{[bold]}Séléctionnez vos critères de recherche{[/bold]}{[/underline]}{[/center]}","".$comp->m_value,"Valeur de title");
//SELECT - searchSelector
$comp=$rep->getComponents('searchSelector');
$test->assertClass("Xfer_Comp_Select",$comp,"Classe de searchSelector");
$test->assertEquals(10,COUNT($comp->m_select),'Nb select de searchSelector');
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
$test->assertEquals("personneMorale_APAS_Search",$act->m_action,'Act action btn');
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

$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_List",array("ACT"=>"ADD","CRITERIA"=>"type||8||1||array%28%27fieldname%27%3D%3E%27type%27%2C+%27description%27%3D%3E%27Cat%E9gorie%27%2C+%27list%27%3D%3E%271%7C%7CEntreprise%3B2%7C%7CAssociation%3B%27%2C+%27type%27%3D%3E%27list%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personneMorale.type%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personneMorale%27%29%2C+%27wheres%27%3D%3Earray%28%29%29//raisonSociale||5||sans||array%28%27fieldname%27%3D%3E%27raisonSociale%27%2C+%27description%27%3D%3E%27Raison+Sociale%27%2C+%27list%27%3D%3E%27%27%2C+%27type%27%3D%3E%27str%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personneMorale.raisonSociale%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personneMorale%27%29%2C+%27wheres%27%3D%3Earray%28%29%29","IsSearch"=>"1","searchOperator"=>"5","searchSelector"=>"raisonSociale","searchValueBool"=>"n","searchValueDate"=>"2011-11-08","searchValueFloat"=>"0.00","searchValueList"=>"","searchValueStr"=>"","searchValueTime"=>"00:00",),"Xfer_Container_Custom");
$test->assertEquals(4,COUNT($rep->m_actions),'nb action');
$act=$rep->m_actions[0];
$test->assertEquals("_Imprimer",$act->m_title,'Titre action #1');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #1');
$test->assertEquals("personneMorale_APAS_PrintList",$act->m_action,'Act action #1');
$act=$rep->m_actions[1];
$test->assertEquals("_Etiquettes",$act->m_title,'Titre action #2');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #2');
$test->assertEquals("personneMorale_APAS_PrintEtiquettes",$act->m_action,'Act action #2');
$act=$rep->m_actions[2];
$test->assertEquals("Nouvelle _Recherche",$act->m_title,'Titre action #3');
$test->assertEquals("org_lucterios_contacts",$act->m_extension,'Ext action #3');
$test->assertEquals("personneMorale_APAS_Search",$act->m_action,'Act action #3');
$act=$rep->m_actions[3];
$test->assertEquals("_Fermer",$act->m_title,'Titre action #4');
$test->assertEquals("",$act->m_extension,'Ext action #4');
$test->assertEquals("",$act->m_action,'Act action #4');
$test->assertEquals(5,$rep->getComponentCount(),'nb component');
//IMAGE - img
$comp=$rep->getComponents('img');
$test->assertClass("Xfer_Comp_Image",$comp,"Classe de img");
$test->assertEquals("extensions/org_lucterios_contacts/images/contactMoral.png","".$comp->m_value,"Valeur de img");
//LABELFORM - titre
$comp=$rep->getComponents('titre');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de titre");
$test->assertEquals('{[center]}{[bold]}Résultat de la recherche{[/bold]}{[newline]}{[newline]}{[underline]}Vos critères de recherche:{[/underline]} {[bold]}Catégorie{[/bold]} correspond à {[italic]}"Entreprise"{[/italic]} et {[bold]}Raison Sociale{[/bold]} contient {[italic]}"sans"{[/italic]}{[/center]}',"".$comp->m_value,"Valeur de titre");
//GRID - personneMorale
$comp=$rep->getComponents('personneMorale');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de personneMorale");
$test->assertEquals(4,count($comp->m_headers),"Nb grid headers de personneMorale");
$test->assertEquals(1,count($comp->m_records),"Nb grid records de personneMorale");
$rec=$comp->m_records[100];
$test->assertEquals("Boucherie Sans-Os",$rec["raisonSociale"],"Valeur de grid [100,raisonSociale]");
$test->assertEquals("04.72.12.45.78.",$rec["fixe"],"Valeur de grid [100,fixe]");
$test->assertEquals("",$rec["fax"],"Valeur de grid [100,fax]");
$test->assertEquals("sansos@free.fr",$rec["mail"],"Valeur de grid [100,mail]");
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre total : 1","".$comp->m_value,"Valeur de nb");
//LINK - emailAll
$comp=$rep->getComponents('emailAll');
$test->assertClass("Xfer_Comp_LinkLabel",$comp,"Classe de emailAll");
$test->assertEquals("Ecrire a tous","".$comp->m_value,"Valeur de emailAll");
$test->assertEquals("mailto:sansos@free.fr",$comp->m_Link,"Liens de emailAll");

// suppression
$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_Fiche",array("ACT"=>"ADD","CLASSNAME"=>"DBObj_org_lucterios_contacts_personneMorale","CRITERIA"=>"type||8||1||array%28%27fieldname%27%3D%3E%27type%27%2C+%27description%27%3D%3E%27Cat%E9gorie%27%2C+%27list%27%3D%3E%271%7C%7CEntreprise%3B2%7C%7CAssociation%3B%27%2C+%27type%27%3D%3E%27list%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personneMorale.type%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personneMorale%27%29%2C+%27wheres%27%3D%3Earray%28%29%29//raisonSociale||5||sans||array%28%27fieldname%27%3D%3E%27raisonSociale%27%2C+%27description%27%3D%3E%27Raison+Sociale%27%2C+%27list%27%3D%3E%27%27%2C+%27type%27%3D%3E%27str%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personneMorale.raisonSociale%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personneMorale%27%29%2C+%27wheres%27%3D%3Earray%28%29%29","IsSearch"=>"1","PARAMNAME"=>"personneMorale","personneMorale"=>"100","searchOperator"=>"5","searchSelector"=>"raisonSociale","searchValueBool"=>"n","searchValueDate"=>"2011-11-08","searchValueFloat"=>"0.00","searchValueList"=>"","searchValueStr"=>"","searchValueTime"=>"00:00",),"Xfer_Container_Custom");
$test->assertEquals(4,COUNT($rep->m_actions),'nb action');
$test->assertEquals(33,$rep->getComponentCount(),'nb component');
//LABEL - raisonSociale
$comp=$rep->getComponents('raisonSociale');
$test->assertEquals("Boucherie Sans-Os","".$comp->m_value,"Valeur de raisonSociale");

$rep=$test->CallAction("org_lucterios_contacts","personneAbstraite_APAS_Delete",array("ACT"=>"ADD","CLASSNAME"=>"DBObj_org_lucterios_contacts_personneMorale","CONFIRME"=>"YES","CRITERIA"=>"type||8||1||array%28%27fieldname%27%3D%3E%27type%27%2C+%27description%27%3D%3E%27Cat%E9gorie%27%2C+%27list%27%3D%3E%271%7C%7CEntreprise%3B2%7C%7CAssociation%3B%27%2C+%27type%27%3D%3E%27list%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personneMorale.type%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personneMorale%27%29%2C+%27wheres%27%3D%3Earray%28%29%29//raisonSociale||5||sans||array%28%27fieldname%27%3D%3E%27raisonSociale%27%2C+%27description%27%3D%3E%27Raison+Sociale%27%2C+%27list%27%3D%3E%27%27%2C+%27type%27%3D%3E%27str%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personneMorale.raisonSociale%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personneMorale%27%29%2C+%27wheres%27%3D%3Earray%28%29%29","IsSearch"=>"1","ORIGINE"=>"personneMorale_APAS_Fiche","PARAMNAME"=>"personneMorale","RECORD_ID"=>"100","TABLE_NAME"=>"org_lucterios_contacts_personneMorale","abstractContact"=>"101","personneMorale"=>"100","searchOperator"=>"5","searchSelector"=>"raisonSociale","searchValueBool"=>"n","searchValueDate"=>"2011-11-08","searchValueFloat"=>"0.00","searchValueList"=>"","searchValueStr"=>"","searchValueTime"=>"00:00",),"Xfer_Container_Acknowledge");

$rep=$test->CallAction("org_lucterios_contacts","personneMorale_APAS_List",array("ACT"=>"ADD","CLASSNAME"=>"DBObj_org_lucterios_contacts_personneMorale","CRITERIA"=>"type||8||1||array%28%27fieldname%27%3D%3E%27type%27%2C+%27description%27%3D%3E%27Cat%E9gorie%27%2C+%27list%27%3D%3E%271%7C%7CEntreprise%3B2%7C%7CAssociation%3B%27%2C+%27type%27%3D%3E%27list%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personneMorale.type%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personneMorale%27%29%2C+%27wheres%27%3D%3Earray%28%29%29//raisonSociale||5||sans||array%28%27fieldname%27%3D%3E%27raisonSociale%27%2C+%27description%27%3D%3E%27Raison+Sociale%27%2C+%27list%27%3D%3E%27%27%2C+%27type%27%3D%3E%27str%27%2C+%27table.name%27%3D%3E%27org_lucterios_contacts_personneMorale.raisonSociale%27%2C+%27tables%27%3D%3Earray%28%27org_lucterios_contacts_personneMorale%27%29%2C+%27wheres%27%3D%3Earray%28%29%29","IsSearch"=>"1","PARAMNAME"=>"personneMorale","searchOperator"=>"5","searchSelector"=>"raisonSociale","searchValueBool"=>"n","searchValueDate"=>"2011-11-08","searchValueFloat"=>"0.00","searchValueList"=>"","searchValueStr"=>"","searchValueTime"=>"00:00",),"Xfer_Container_Custom");
$test->assertEquals(4,COUNT($rep->m_actions),'nb action');
$test->assertEquals(5,$rep->getComponentCount(),'nb component');
//GRID - personneMorale
$comp=$rep->getComponents('personneMorale');
$test->assertEquals(4,count($comp->m_actions),"Nb grid actions de personneMorale");
$test->assertEquals(4,count($comp->m_headers),"Nb grid headers de personneMorale");
$test->assertEquals(0,count($comp->m_records),"Nb grid records de personneMorale");
//LABELFORM - nb
$comp=$rep->getComponents('nb');
$test->assertClass("Xfer_Comp_LabelForm",$comp,"Classe de nb");
$test->assertEquals("Nombre total : 0","".$comp->m_value,"Valeur de nb");
//LINK - emailAll
$comp=$rep->getComponents('emailAll');
$test->assertClass("Xfer_Comp_LinkLabel",$comp,"Classe de emailAll");
$test->assertEquals("Ecrire a tous","".$comp->m_value,"Valeur de emailAll");
$test->assertEquals("mailto:",$comp->m_Link,"Liens de emailAll");
//@CODE_ACTION@
}

?>
