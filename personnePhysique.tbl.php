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
//  // table file write by SDK tool
// --- Last modification: Date 11 May 2010 11:53:21 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_contacts_personnePhysique extends DBObj_Basic
{
	var $Title="Personnes physiques";
	var $tblname="personnePhysique";
	var $extname="org_lucterios_contacts";
	var $__table="org_lucterios_contacts_personnePhysique";

	var $DefaultFields=array();
	var $NbFieldsCheck=1;
	var $Heritage="org_lucterios_contacts/personneAbstraite";
	var $PosChild=3;

	var $sexe;
	var $nom;
	var $prenom;
	var $user;
	var $functions;
	var $__DBMetaDataField=array('sexe'=>array('description'=>'Civilité', 'type'=>8, 'notnull'=>false, 'params'=>array('Enum'=>array('Monsieur', 'Madame/Mademoiselle'))), 'nom'=>array('description'=>'Nom', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>30, 'Multi'=>false)), 'prenom'=>array('description'=>'Prénom', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>30, 'Multi'=>false)), 'user'=>array('description'=>'Connexion', 'type'=>10, 'notnull'=>false, 'params'=>array('TableName'=>'CORE_users')), 'functions'=>array('description'=>'Fonctions', 'type'=>11, 'notnull'=>false, 'params'=>array('Function'=>'org_lucterios_contacts_FCT_personnePhysique_APAS_getFunctions', 'NbField'=>2)));

	var $__toText='$nom $prenom';
}

?>
