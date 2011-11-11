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
// --- Last modification: Date 21 July 2010 8:57:00 By  ---

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
list($ext_name,$table_name) = explode('/',$classname);
$table_name = trim($table_name);
$file="extensions/$ext_name/$table_name.tbl.php";
$class_name="DBObj_".$ext_name."_".$table_name;
include_once $file;
$contact=new $class_name;

$FirstOrder="";
$OrderBy="";
foreach($contact->getDBMetaDataField() as $field_names => $field_item) {
	if ($field_item['type']<8) {
		if ($OrderBy!='')
			$OrderBy.=",";
		$OrderBy.=$field_names;
		if ($FirstOrder=="")
			$FirstOrder=$field_names;
	}
}

$contact->setForSearch($Params,$OrderBy);
include_once("CORE/DBFind.inc.php");
$query_txt=DBFind::getCriteriaText($contact,$Params);
return array($contact,$query_txt);
//@CODE_ACTION@
}

?>
