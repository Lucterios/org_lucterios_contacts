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
//  // Method file write by SDK tool
// --- Last modification: Date 04 May 2009 23:48:14 By  ---

require_once('CORE/xfer_exception.inc.php');
require_once('CORE/rights.inc.php');

//@TABLES@
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@

//@DESC@
//@PARAM@ classname
//@PARAM@ Params

function personneAbstraite_APAS_contactFound(&$self,$classname,$Params)
{
//@CODE_ACTION@
list($ext_name,$table_name) = split('/',$classname);
$table_name = trim($table_name);
$file="extensions/$ext_name/$table_name.tbl.php";
$class_name="DBObj_".$ext_name."_".$table_name;
include_once $file;
$contact=new $class_name;
$OrderBy="";
$key=array_keys($contact->getDBMetaDataField());
for($idx=0;$idx<$contact->NbFieldsCheck;$idx++) {
	if ($OrderBy!='') $OrderBy.=",";
	$OrderBy.=$key[$idx];
}
$query=$contact->setForSearch($Params,$OrderBy);
if ($query=='') {
	$query_txt="complète";
	$query="SELECT * FROM ".$contact->__table;
	if ($class_name=='DBObj_org_lucterios_contacts_personneMorale')
		$query.=" WHERE id!=1";
	if ($OrderBy!='') $query.=" ORDER BY $OrderBy";
	echo "<!-- query=$query -->\n";
	$contact->query($query);
}
else {
	$query_txt="filtré";
}
return array($contact,$query_txt);
//@CODE_ACTION@
}

?>
