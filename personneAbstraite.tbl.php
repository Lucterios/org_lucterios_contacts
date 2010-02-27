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
// --- Last modification: Date 26 February 2010 23:14:56 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_contacts_personneAbstraite extends DBObj_Basic
{
	var $Title="Personnes";
	var $tblname="personneAbstraite";
	var $extname="org_lucterios_contacts";
	var $__table="org_lucterios_contacts_personneAbstraite";

	var $DefaultFields=array();
	var $NbFieldsCheck=1;
	var $Heritage="";
	var $PosChild=-1;

	var $adresse;
	var $codePostal;
	var $ville;
	var $pays;
	var $fixe;
	var $portable;
	var $fax;
	var $mail;
	var $commentaire;
	var $allTel;
	var $__DBMetaDataField=array('adresse'=>array('description'=>'Adresse', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>200, 'Multi'=>true)), 'codePostal'=>array('description'=>'Code Postal', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>8, 'Multi'=>false)), 'ville'=>array('description'=>'Ville', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>70, 'Multi'=>false)), 'pays'=>array('description'=>'Pays', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>50, 'Multi'=>false)), 'fixe'=>array('description'=>'Tel. Fixe', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>15, 'Multi'=>false)), 'portable'=>array('description'=>'Tel. Portable', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>15, 'Multi'=>false)), 'fax'=>array('description'=>'Fax', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>15, 'Multi'=>false)), 'mail'=>array('description'=>'Courriel', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>100, 'Multi'=>false)), 'commentaire'=>array('description'=>'Commentaire', 'type'=>7, 'notnull'=>false, 'params'=>array()), 'allTel'=>array('description'=>'Téléphones', 'type'=>11, 'notnull'=>false, 'params'=>array('Function'=>'org_lucterios_contacts_FCT_personneAbstraite_APAS_getAllTel', 'NbField'=>1)));

}

?>
