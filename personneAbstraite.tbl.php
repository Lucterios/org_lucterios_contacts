<?php
// 	This file is part of Lucterios/Diacamma, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// 	Thanks to have payed a retribution for using this module.
// 
// 	Lucterios/Diacamma is free software; you can redistribute it and/or modify
// 	it under the terms of the GNU General Public License as published by
// 	the Free Software Foundation; either version 2 of the License, or
// 	(at your option) any later version.
// 
// 	Lucterios/Diacamma is distributed in the hope that it will be useful,
// 	but WITHOUT ANY WARRANTY; without even the implied warranty of
// 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// 	GNU General Public License for more details.
// 
// 	You should have received a copy of the GNU General Public License
// 	along with Lucterios; if not, write to the Free Software
// 	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// 
// 		Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY// table file write by SDK tool
// --- Last modification: Date 26 October 2011 6:04:44 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_contacts_personneAbstraite extends DBObj_Basic
{
	public $Title="Personnes";
	public $tblname="personneAbstraite";
	public $extname="org_lucterios_contacts";
	public $__table="org_lucterios_contacts_personneAbstraite";

	public $DefaultFields=array();
	public $NbFieldsCheck=1;
	public $Heritage="";
	public $PosChild=-1;

	public $adresse;
	public $codePostal;
	public $ville;
	public $pays;
	public $fixe;
	public $portable;
	public $fax;
	public $mail;
	public $commentaire;
	public $allTel;
	public $__DBMetaDataField=array('adresse'=>array('description'=>'Adresse', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>200, 'Multi'=>true)), 'codePostal'=>array('description'=>'Code Postal', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>8, 'Multi'=>false)), 'ville'=>array('description'=>'Ville', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>70, 'Multi'=>false)), 'pays'=>array('description'=>'Pays', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>50, 'Multi'=>false)), 'fixe'=>array('description'=>'Tel. Fixe', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>15, 'Multi'=>false)), 'portable'=>array('description'=>'Tel. Portable', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>15, 'Multi'=>false)), 'fax'=>array('description'=>'Fax', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>15, 'Multi'=>false)), 'mail'=>array('description'=>'Courriel', 'type'=>2, 'notnull'=>false, 'params'=>array('Size'=>100, 'Multi'=>false)), 'commentaire'=>array('description'=>'Commentaire', 'type'=>7, 'notnull'=>false, 'params'=>array()), 'allTel'=>array('description'=>'Téléphones', 'type'=>11, 'notnull'=>false, 'params'=>array('Function'=>'org_lucterios_contacts_FCT_personneAbstraite_APAS_getAllTel', 'NbField'=>1)));

}

?>
