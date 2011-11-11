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

class DBObj_org_lucterios_contacts_fonctions extends DBObj_Basic
{
	public $Title="Fonctions";
	public $tblname="fonctions";
	public $extname="org_lucterios_contacts";
	public $__table="org_lucterios_contacts_fonctions";

	public $DefaultFields=array(array('@refresh@'=>true, 'id'=>'1', 'nom'=>'Président', 'readonly'=>'o'), array('@refresh@'=>true, 'id'=>'2', 'nom'=>'Vice-Président', 'readonly'=>'o'), array('@refresh@'=>true, 'id'=>'3', 'nom'=>'Trésorier', 'readonly'=>'o'), array('@refresh@'=>true, 'id'=>'4', 'nom'=>'Trésorier-Adjoint', 'readonly'=>'o'), array('@refresh@'=>true, 'id'=>'5', 'nom'=>'Secrétaire', 'readonly'=>'o'), array('@refresh@'=>true, 'id'=>'6', 'nom'=>'Secrétaire-Adjoint', 'readonly'=>'o'), array('@refresh@'=>true, 'id'=>'7', 'nom'=>'Directeur', 'readonly'=>'o'), array('@refresh@'=>true, 'id'=>'8', 'nom'=>'Directeur-Adjoint', 'readonly'=>'o'));
	public $NbFieldsCheck=1;
	public $Heritage="";
	public $PosChild=-1;

	public $nom;
	public $readonly;
	public $__DBMetaDataField=array('nom'=>array('description'=>'Nom', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>50, 'Multi'=>false)), 'readonly'=>array('description'=>'Non supprimable', 'type'=>3, 'notnull'=>true, 'params'=>array()));

	public $__toText='$nom';
}

?>
