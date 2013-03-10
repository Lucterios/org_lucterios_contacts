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
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
require_once('extensions/org_lucterios_contacts/personneChamp.tbl.php');
//@TABLES@

//@DESC@importer via dictionnaire
//@PARAM@ contact
//@PARAM@ dico

function personneChamp_APAS_import(&$self,$contact,$dico)
{
//@CODE_ACTION@
$DBContact=new DBObj_org_lucterios_contacts_personneAbstraite;
$DBContact->get($contact);
$class_list = $DBContact->get_classes_herited();

$DBPerso=new DBObj_org_lucterios_contacts_champPerso;
$DBPerso->find();
while ($DBPerso->fetch()) {
	$classname_expected = "DBObj_".str_replace('/','_',$DBPerso->class);
	if (in_array($classname_expected,$class_list)) {
		if (array_key_exists($DBPerso->description,$dico))
			$text_value=trim($dico[$DBPerso->description]);
		else
			$text_value="";
		$item_value="";
		if ($DBPerso->param!='') {
			$cmd='$extend='.$DBPerso->param.';';
			eval($cmd);
		}
		else
			$extend=array();
		switch ($DBPerso->type) {
		    case 0: // text
			$item_value=$text_value;
		     	break;
		    case 1: // int
			$item_value=intval($text_value);
			$item_value=min($item_value,$extend['Max']);
			$item_value=max($item_value,$extend['Min']);
	     		break;
		    case 2: // float
			$item_value=floatval(str_replace(',','.',$text_value));
			$item_value=min($item_value,$extend['Max']);
			$item_value=max($item_value,$extend['Min']);
		     	break;
		    case 3: // bool
			$item_value=strtolower($text_value[0]);
	     		break;
		    case 4: // enum
			if (is_numeric($text_value)) {
				$item_value=$text_value;
			}
			else {
				$item_value=0;
				foreach($extend['Enum'] as $numId=>$enum)
					if ($enum==$text_value)
						$item_value=$numId;
			}
		     	break;
		}
		$DBNewChamp=new DBObj_org_lucterios_contacts_personneChamp;
		$DBNewChamp->contact=$contact;
		$DBNewChamp->champ=$DBPerso->id;
		$DBNewChamp->find();
		if ($DBNewChamp->fetch())  {
			$DBNewChamp->value=$item_value;
			$DBNewChamp->update();
		}
		else {
			$DBNewChamp=new DBObj_org_lucterios_contacts_personneChamp;
			$DBNewChamp->contact=$contact;
			$DBNewChamp->champ=$DBPerso->id;
			$DBNewChamp->value=$item_value;
			$DBNewChamp->insert();
		}
	}
}
//@CODE_ACTION@
}

?>
