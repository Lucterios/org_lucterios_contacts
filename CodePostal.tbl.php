<?php
//
//  This file is part of Lucterios.
//
//  Lucterios is free software; you can redistribute it and/or modify
//  it under the terms of the GNU General Public License as published by
//  the Free Software Foundation; either version 2 of the License, or
//  (at your option) any later version.
//
//  Lucterios is distributed in the hope that it will be useful,
//  but WITHOUT ANY WARRANTY; without even the implied warranty of
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//  GNU General Public License for more details.
//
//  You should have received a copy of the GNU General Public License
//  along with Lucterios; if not, write to the Free Software
//  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
//
//	Contributeurs: Fanny ALLEAUME, Pierre-Olivier VERSCHOORE, Laurent GAY
//
// table file write by SDK tool
// --- Last modification: Date 30 May 2008 22:31:16 By  ---

require_once('CORE/DBObject.inc.php');

class DBObj_org_lucterios_contacts_CodePostal extends DBObj_Basic
{
	var $Title="Code postal";
	var $tblname="CodePostal";
	var $extname="org_lucterios_contacts";
	var $__table="org_lucterios_contacts_CodePostal";

	var $DefaultFields=array();
	var $NbFieldsCheck=1;
	var $Heritage="";
	var $PosChild=-1;

	var $codePostal;
	var $ville;
	var $pays;
	var $__DBMetaDataField=array('codePostal'=>array('description'=>'Code Postal', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>6, 'Multi'=>false)), 'ville'=>array('description'=>'Ville', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>70, 'Multi'=>false)), 'pays'=>array('description'=>'Pays', 'type'=>2, 'notnull'=>true, 'params'=>array('Size'=>50, 'Multi'=>false)));

	var $__toText='$codePostal $ville';
}

?>
