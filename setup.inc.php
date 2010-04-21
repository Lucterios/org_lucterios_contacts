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
// --- Last modification: Date 20 April 2010 16:52:20 By  ---

$extention_name="org_lucterios_contacts";
$extention_description="Module de gestion des contacts physiques (hommes ou femmes){[newline]}ou moraux (entreprise, association, administration,...)";
$extention_appli="";
$extention_famille="contacts";
$extention_titre="Gestion des contacts";
$extension_libre=true;

$version_max=1;
$version_min=1;
$version_release=3;
$version_build=470;

$depencies=array();
$depencies[0] = new Param_Depencies("CORE", 1, 2, 1, 1, false);

$rights=array();
$rights[0] = new Param_Rigth("Voir/Lister",40);
$rights[1] = new Param_Rigth("Ajouter/Modifier",60);
$rights[2] = new Param_Rigth("Gestion des paramètres",75);
$rights[3] = new Param_Rigth("Suppression/Fusion",70);
$rights[4] = new Param_Rigth("Voir structure local",0);
$rights[5] = new Param_Rigth("Voir/modifier fiche personnel",20);

$menus=array();
$menus[0] = new Param_Menu("Adresses et _Contacts", "Bureautique", "", "contacts.png", "", 50 , 0, "Gestion d'hommes ou de femmes{[newline]}et d'organisations de personnes enregistrés");
$menus[1] = new Param_Menu("Personnes _morales", "Adresses et _Contacts", "personneMorale_APAS_List", "contactMoral.png", "ctrl alt M", 10 , 0, "Gestion d'une structure ou d'une organisation de personne{[newline]}(entreprise, association, administration, ...)");
$menus[2] = new Param_Menu("_Personnes physiques", "Adresses et _Contacts", "personnePhysique_APAS_List", "contactPhyique.png", "", 40 , 0, "Gestion des hommes et des femmes enregistrés");
$menus[3] = new Param_Menu("_Recherche de personne physique", "Adresses et _Contacts", "personnePhysique_APAS_Search", "contactPhyiqueFind.png", "ctrl alt R", 20 , 1, "Pour trouver une personne physique{[newline]}suivant un ensemble de critères.");
$menus[4] = new Param_Menu("R_echerche de personne morale", "Adresses et _Contacts", "personneMorale_APAS_Search", "contactMoralFind.png", "", 30 , 1, "Pour trouver une personne morale{[newline]}suivant un ensemble de critères.");
$menus[5] = new Param_Menu("_Contact", "_Extensions (conf.)", "", "", "", 30 , 0, "");
$menus[8] = new Param_Menu("Codes postaux / villes", "_Contact", "CodePostal_APAS_list", "contactCodePostal.png", "", 30 , 1, "Gestion des codes postaux associés à leurs communes.");
$menus[9] = new Param_Menu("Bureautique", "", "", "bureau.png", "", 60 , 0, "Outils bureautiques");
$menus[10] = new Param_Menu("Configuration des contacts", "_Contact", "configuration", "contactsConfig.png", "", 15 , 1, "Gestion des fonctions des personnes physiques {[newline]}et des catégorie des structures morales.");
$menus[11] = new Param_Menu("Mon compte", "Ad_ministration", "FichePersonnel", "fiche.png", "shift ctrl alt M", 1 , 1, "Visualiser la fiche de mon compte.");
$menus[12] = new Param_Menu("Nos coordonnées", "Ad_ministration", "StructureLocal", "nousContact.png", "shift ctrl alt N", 8 , 1, "Fiche complete de notre structure et de ses responsables");
$menus[13] = new Param_Menu("Configuration couriel", "_Contact", "confMailSMS", "contacts_telmail.png", "", 40 , 1, "Configuration des paramètres pour l'envoir de couriel");
$menus[14] = new Param_Menu("Mot de passe perdu", "Adresses et _Contacts", "passForgot", "", "", 100 , 1, "Mot de passe perdu");
$menus[15] = new Param_Menu("Nouveau contact", "Adresses et _Contacts", "newContact", "", "", 110 , 1, "Nouveau contact");

$actions=array();
$actions[0] = new Param_Action("Changer la configuration courriel", "ChangeParamMail", 2);
$actions[1] = new Param_Action("Changer les options des contacts", "ChangeParamOptions", 2);
$actions[2] = new Param_Action("Changer les paramètres", "ChangeParams", 2);
$actions[3] = new Param_Action("Validation", "CodePostal_APAS_ajouteract", 0);
$actions[4] = new Param_Action("Ajouter Code postal/Ville", "CodePostal_APAS_ajout", 0);
$actions[5] = new Param_Action("Liste des Codes Postaux/Villes", "CodePostal_APAS_list", 0);
$actions[6] = new Param_Action("Mon compte", "FichePersonnel", 5);
$actions[7] = new Param_Action("Imprimer nos contacts", "ImpressionLocal", 4);
$actions[8] = new Param_Action("Nos coordonnées", "StructureLocal", 4);
$actions[9] = new Param_Action("Configuration courriel", "confMailSMS", 2);
$actions[10] = new Param_Action("Configuration des contacts", "configuration", 2);
$actions[11] = new Param_Action("Valider l'ajout", "fonctions_APAS_ajouteract", 0);
$actions[12] = new Param_Action("Ajouter une fonction", "fonctions_APAS_ajout", 0);
$actions[13] = new Param_Action("Liste des fonctions", "fonctions_APAS_list", 0);
$actions[14] = new Param_Action("Suppression d`une fonction", "fonctions_APAS_suppr", 0);
$actions[15] = new Param_Action("Valider un liaison", "liaison_APAS_AddModifyAct", 1);
$actions[16] = new Param_Action("Ajouter/Modifier une liaison", "liaison_APAS_AddModify", 1);
$actions[17] = new Param_Action("Ajouter un responsable", "liaison_APAS_AddSearchSelect", 1);
$actions[18] = new Param_Action("Valider la recherche", "liaison_APAS_AddSearchyAct", 1);
$actions[19] = new Param_Action("Rechercher une personne pour ajout", "liaison_APAS_AddSearch", 1);
$actions[20] = new Param_Action("Supprimer un liaison", "liaison_APAS_Del", 1);
$actions[21] = new Param_Action("Fiche d'un liaison", "liaison_APAS_Fiche", 0);
$actions[22] = new Param_Action("Ajouter une fonction", "liaison_APAS_addFunctionAct", 1);
$actions[23] = new Param_Action("Ajouter une fonction", "liaison_APAS_addFunction", 1);
$actions[24] = new Param_Action("Nouveau contact", "newContactAct", 4);
$actions[25] = new Param_Action("Nouveau contact", "newContact", 4);
$actions[26] = new Param_Action("Mot de passe perdu", "passForgotAct", 4);
$actions[27] = new Param_Action("Mot de passe perdu", "passForgot", 4);
$actions[28] = new Param_Action("Valider un contact", "personneAbstraite_APAS_AddModifyAct", 1);
$actions[29] = new Param_Action("Modifier un contact", "personneAbstraite_APAS_AddModify", 1);
$actions[30] = new Param_Action("Suppression en cascade", "personneAbstraite_APAS_Delete", 3);
$actions[31] = new Param_Action("Fiche d'un contact", "personneAbstraite_APAS_Fiche", 0);
$actions[32] = new Param_Action("Fusionne des contacts", "personneAbstraite_APAS_Merge", 3);
$actions[33] = new Param_Action("Imprimer un contact", "personneAbstraite_APAS_PrintFile", 0);
$actions[34] = new Param_Action("Selectionner les personnes à fusionner", "personneAbstraite_APAS_SelectMerge", 3);
$actions[35] = new Param_Action("Valider un personneMorale", "personneMorale_APAS_AddModifyAct", 1);
$actions[36] = new Param_Action("Ajouter/Modifier un personneMorale", "personneMorale_APAS_AddModify", 1);
$actions[37] = new Param_Action("Fiche d'une personne morale", "personneMorale_APAS_Fiche", 0);
$actions[38] = new Param_Action("Liste des personnes morales", "personneMorale_APAS_List", 0);
$actions[39] = new Param_Action("Ma structure moral", "personneMorale_APAS_MaStructure", 5);
$actions[40] = new Param_Action("Modifier mon organisation", "personneMorale_APAS_ModifyMaStructureAct", 5);
$actions[41] = new Param_Action("Modifier mon organisation", "personneMorale_APAS_ModifyMaStructure", 5);
$actions[42] = new Param_Action("Imprimer des étiquettes", "personneMorale_APAS_PrintEtiquettes", 0);
$actions[43] = new Param_Action("Imprimer un personneMorale", "personneMorale_APAS_PrintFile", 0);
$actions[44] = new Param_Action("Imprimer une liste de personneMorale", "personneMorale_APAS_PrintList", 0);
$actions[45] = new Param_Action("Rechercher une personne morale", "personneMorale_APAS_Search", 0);
$actions[46] = new Param_Action("Afficher les ou la organisation de l'utilisateur connecté", "personneMorale_APAS_currentMoral", 5);
$actions[47] = new Param_Action("Valider une personne physique", "personnePhysique_APAS_AddModifyAct", 1);
$actions[48] = new Param_Action("Ajouter/Modifier une personne physique", "personnePhysique_APAS_AddModify", 1);
$actions[49] = new Param_Action("Modifier ma fiche personnelle", "personnePhysique_APAS_EditerPerso", 5);
$actions[50] = new Param_Action("Fiche d'une personne physique", "personnePhysique_APAS_Fiche", 0);
$actions[51] = new Param_Action("Liste des personnes physiques", "personnePhysique_APAS_List", 0);
$actions[52] = new Param_Action("Modifier ma fiche personnelle", "personnePhysique_APAS_ModifFichePerso", 5);
$actions[53] = new Param_Action("Imprimer les étiquettes", "personnePhysique_APAS_PrintEtiquettes", 0);
$actions[54] = new Param_Action("Imprimer une personne physique", "personnePhysique_APAS_PrintFile", 0);
$actions[55] = new Param_Action("Imprimer une liste de personnes physiques", "personnePhysique_APAS_PrintList", 0);
$actions[56] = new Param_Action("Rechercher une personne physique", "personnePhysique_APAS_Search", 0);
$actions[57] = new Param_Action("Modifier la connexion", "personnePhysique_APAS_login", 2);
$actions[58] = new Param_Action("Valider une connexion", "personnePhysique_APAS_validerLogin", 2);
$actions[59] = new Param_Action("ajouts de catégorie de personne morale", "typesMorales_APAS_ajouteract", 0);
$actions[60] = new Param_Action("Ajouter une catégorie de personne morale", "typesMorales_APAS_ajout", 0);
$actions[61] = new Param_Action("Liste des catégories de personnes morales", "typesMorales_APAS_liste", 0);
$actions[62] = new Param_Action("Suppression de catégorie de personne morale", "typesMorales_APAS_suppr", 0);

$params=array();
$params["MailToConfig"] = new Param_Parameters("MailToConfig", "0", "Type de destinataire de courriel", 4, array('Enum'=>array('Pour', 'Copie à', 'Copie caché à')));
$params["MailSmtpServer"] = new Param_Parameters("MailSmtpServer", "", "Serveur SMTP", 0, array('Multi'=>false));
$params["MailSmtpUser"] = new Param_Parameters("MailSmtpUser", "", "Authentification SMTP", 0, array('Multi'=>false));
$params["MailSmtpPass"] = new Param_Parameters("MailSmtpPass", "", "Mot de passe SMTP", 0, array('Multi'=>false));
$params["MailConnectionMsg"] = new Param_Parameters("MailConnectionMsg", "", "Message de confirmation de connexion", 0, array('Multi'=>true));
$params["defaultFunction"] = new Param_Parameters("defaultFunction", "1", "Fonction par défaut", 1, array('Min'=>1, 'Max'=>100000));
$params["defaultType"] = new Param_Parameters("defaultType", "1", "Catégorie par défaut", 1, array('Min'=>1, 'Max'=>100000));
$params["defaultGroup"] = new Param_Parameters("defaultGroup", "99", "Groupe par défaut", 1, array('Min'=>1, 'Max'=>100000));

$extend_tables=array();
$extend_tables["CodePostal"] = array("Code postal","",array());
$extend_tables["fonctions"] = array("Fonctions","",array());
$extend_tables["liaison"] = array("Résponsabilité","",array("org_lucterios_contacts_personnePhysique"=>"physique","org_lucterios_contacts_personneMorale"=>"morale","org_lucterios_contacts_fonctions"=>"fonction",));
$extend_tables["personneAbstraite"] = array("Personnes","",array());
$extend_tables["personneMorale"] = array("Personnes morales","org_lucterios_contacts/personneAbstraite",array("org_lucterios_contacts_typesMorales"=>"type",));
$extend_tables["personnePhysique"] = array("Personnes physiques","org_lucterios_contacts/personneAbstraite",array("CORE_users"=>"user",));
$extend_tables["typesMorales"] = array("Type de structures","",array());

?>