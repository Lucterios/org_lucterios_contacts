<?php
// This file is part of Lucterios, a software developped by "Le Sanglier du Libre" (http://www.sd-libre.fr)
// Thanks to have payed a donation for using this module.
// 
// Lucterios is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
// 
// Lucterios is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Lucterios; if not, write to the Free Software
// Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// Method file write by Lucterios SDK tool

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/champPerso.tbl.php');
require_once('extensions/org_lucterios_contacts/personneChamp.tbl.php');
//@TABLES@

//@DESC@Rajoute les nouveaux champs des contacts
//@PARAM@ 

function personneChamp_APAS_checkContact(&$self)
{
//@CODE_ACTION@
require_once('CORE/extensionManager.inc.php');
$DBChamp=new DBObj_org_lucterios_contacts_champPerso;
$DBChamp->find();
while ($DBChamp->fetch()) {
	$where = array();
	$from=array();
	$current_class = $DBChamp->class;
	$last_table='';
	while ($current_class!='') {
		$new_table=str_replace('/','_',$current_class);
		$from[]=$new_table;
		if ($last_table!='')
			$where[]="$last_table.superId=$new_table.id";
		$last_table=$new_table;
		list($file_class_name,$class_name) = DBObj_Abstract::getTableAndClass($current_class);
		require_once($file_class_name);
		$DBObj= new $class_name;
		$current_class=$DBObj->Heritage;
	}
	$where[]="NOT org_lucterios_contacts_personneAbstraite.id in (SELECT contact FROM org_lucterios_contacts_personneChamp WHERE champ=".$DBChamp->id.")";
	$query = "SELECT org_lucterios_contacts_personneAbstraite.id FROM ".implode(",",$from)." WHERE ".implode(" AND ",$where);
	global $connect;
	$qId=$connect->execute($query,true);
	while($row=$connect->getRow($qId)) {
		$DBpersonneChamp=new DBObj_org_lucterios_contacts_personneChamp;
		$DBpersonneChamp->contact=$row[0];
		$DBpersonneChamp->champ=$DBChamp->id;
		$DBpersonneChamp->value="";
		$DBpersonneChamp->insert();
	}
}
//@CODE_ACTION@
}

?>
