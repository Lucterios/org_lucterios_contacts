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
//  // setup file write by SDK tool
// --- Last modification: Date 11 September 2008 19:39:11 By  ---

$extention_name="org_lucterios_contacts";
$extention_description="Module de gestion des contacts physiques (hommes ou femmes) ou moraux (entreprise, association, administration,...)";
$extention_appli="";
$extention_famille="contacts";
$extention_titre="Gestion des contacts";
$extension_libre=true;

$version_max=0;
$version_min=20;
$version_release=75;
$version_build=1;

$depencies=array();
$depencies[0] = new Param_Depencies("CORE", 0, 20, 0, 15, false);
$depencies[1] = new Param_Depencies("contacts", 0, 13, 0, 13, true);

$rights=array();
$rights[0] = new Param_Rigth("Voir/Lister",80);
$rights[1] = new Param_Rigth("Ajouter/Modifier",40);
$rights[2] = new Param_Rigth("Gestion des param�tres",75);

$menus=array();
$menus[0] = new Param_Menu("_Contacts", "", "", "contacts.png", "", 50 , 0, "Gestion d'hommes ou de femmes et d'organisations de personnes enregistr�s");
$menus[1] = new Param_Menu("Personnes _morales", "_Contacts", "personneMorale_APAS_List", "contactMoral.png", "ctrl alt M", 10 , 0, "Gestion d'une structure ou d'une organisation de personne (entreprose, association, administration, ...)");
$menus[2] = new Param_Menu("_Personnes physiques", "_Contacts", "personnePhysique_APAS_List", "contactPhyique.png", "", 40 , 0, "Gestion des hommes et des femmes enregistr�s");
$menus[3] = new Param_Menu("_Recherche de personne physique", "_Contacts", "personnePhysique_APAS_Search", "contactPhyiqueFind.png", "ctrl alt R", 20 , 1, "Pour trouver une personne physique suivant un ensemble de crit�res.");
$menus[4] = new Param_Menu("R_echerche de personne morale", "_Contacts", "personneMorale_APAS_Search", "contactMoralFind.png", "", 30 , 1, "Pour trouver une personne morale suivant un ensemble de crit�res.");
$menus[5] = new Param_Menu("_Contact", "_Extensions (conf.)", "", "", "", 30 , 0, "");
$menus[6] = new Param_Menu("Fonctions", "_Contact", "fonctions_APAS_list", "contactFonction.png", "", 10 , 1, "Gestion des fonctions utilis�es pour associer des personnes physiques � un contact moral.");
$menus[7] = new Param_Menu("Cat�gories de personnes morales", "_Contact", "typesMorales_APAS_liste", "contactCategorie.png", "", 20 , 1, "Gestion des cat�gories utilis�es pour classer vos contacts.");
$menus[8] = new Param_Menu("Codes postaux / villes", "_Contact", "CodePostal_APAS_list", "contactCodePostal.png", "", 30 , 1, "Gestion des codes postaux associ�s � leurs communes.");

$actions=array();
$actions[0] = new Param_Action("Validation", "CodePostal_APAS_ajouteract", 0);
$actions[1] = new Param_Action("Ajouter Code postal/Ville", "CodePostal_APAS_ajout", 0);
$actions[2] = new Param_Action("Liste des Codes Postaux/Villes", "CodePostal_APAS_list", 0);
$actions[3] = new Param_Action("Valider l'ajout", "fonctions_APAS_ajouteract", 0);
$actions[4] = new Param_Action("Ajouter une fonction", "fonctions_APAS_ajout", 0);
$actions[5] = new Param_Action("Liste des fonctions", "fonctions_APAS_list", 0);
$actions[6] = new Param_Action("Suppression d`une fonction", "fonctions_APAS_suppr", 0);
$actions[7] = new Param_Action("Valider un liaison", "liaison_APAS_AddModifyAct", 1);
$actions[8] = new Param_Action("Ajouter/Modifier une liaison", "liaison_APAS_AddModify", 1);
$actions[9] = new Param_Action("Ajouter un responsable", "liaison_APAS_AddSearchSelect", 1);
$actions[10] = new Param_Action("Valider la recherche", "liaison_APAS_AddSearchyAct", 1);
$actions[11] = new Param_Action("Rechercher une personne pour ajout", "liaison_APAS_AddSearch", 1);
$actions[12] = new Param_Action("Supprimer un liaison", "liaison_APAS_Del", 1);
$actions[13] = new Param_Action("Fiche d'un liaison", "liaison_APAS_Fiche", 0);
$actions[14] = new Param_Action("", "liaison_APAS_addFunctionAct", 1);
$actions[15] = new Param_Action("", "liaison_APAS_addFunction", 1);
$actions[16] = new Param_Action("Valider un personneMorale", "personneMorale_APAS_AddModifyAct", 1);
$actions[17] = new Param_Action("Ajouter/Modifier un personneMorale", "personneMorale_APAS_AddModify", 1);
$actions[18] = new Param_Action("Fiche d'une personne morale", "personneMorale_APAS_Fiche", 0);
$actions[19] = new Param_Action("Liste des personnes morales", "personneMorale_APAS_List", 0);
$actions[20] = new Param_Action("Imprimer un personneMorale", "personneMorale_APAS_PrintFile", 0);
$actions[21] = new Param_Action("Imprimer une liste de personneMorale", "personneMorale_APAS_PrintList", 0);
$actions[22] = new Param_Action("Rechercher une personne morale", "personneMorale_APAS_Search", 0);
$actions[23] = new Param_Action("Valider une personne physique", "personnePhysique_APAS_AddModifyAct", 1);
$actions[24] = new Param_Action("Ajouter/Modifier une personne physique", "personnePhysique_APAS_AddModify", 1);
$actions[25] = new Param_Action("Fiche d'une personne physique", "personnePhysique_APAS_Fiche", 0);
$actions[26] = new Param_Action("Liste des personnes physiques", "personnePhysique_APAS_List", 0);
$actions[27] = new Param_Action("Imprimer une personne physique", "personnePhysique_APAS_PrintFile", 0);
$actions[28] = new Param_Action("Imprimer une liste de personnes physiques", "personnePhysique_APAS_PrintList", 0);
$actions[29] = new Param_Action("Rechercher une personne physique", "personnePhysique_APAS_Search", 0);
$actions[30] = new Param_Action("ajouts de cat�gorie de personne morale", "typesMorales_APAS_ajouteract", 0);
$actions[31] = new Param_Action("Ajouter une cat�gorie de personne morale", "typesMorales_APAS_ajout", 0);
$actions[32] = new Param_Action("Liste des cat�gories de personnes morales", "typesMorales_APAS_liste", 0);
$actions[33] = new Param_Action("Suppression de cat�gorie de personne morale", "typesMorales_APAS_suppr", 0);

$params=array();

$extend_tables=array();
$extend_tables["CodePostal"] = array("Code postal","");
$extend_tables["fonctions"] = array("Fonctions","");
$extend_tables["liaison"] = array("R�sponsabilit�","");
$extend_tables["personneAbstraite"] = array("Personnes","");
$extend_tables["personneMorale"] = array("Personnes morales","org_lucterios_contacts/personneAbstraite");
$extend_tables["personnePhysique"] = array("Personnes physiques","org_lucterios_contacts/personneAbstraite");
$extend_tables["typesMorales"] = array("Type de structures","");

?>