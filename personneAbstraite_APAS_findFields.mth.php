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
require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
//@TABLES@

//@DESC@Recherche un personneAbstraite
//@PARAM@ posY
//@PARAM@ simple
//@PARAM@ xfer_result

function personneAbstraite_APAS_findFields(&$self,$posY,$simple,$xfer_result)
{
//@CODE_ACTION@
$fields=array();
$fields[]="codePostal";
$fields[]="ville";
$fields[]="commentaire";
$fields[]="mail";
$fields[]="fixe";
$fields[]="portable";
$fields[]="pays";

$class_list = $self->get_classes_herited();
$DBChampPerso=new DBObj_org_lucterios_contacts_champPerso;
$DBChampPerso->find();
while ($DBChampPerso->fetch()) {
	$classname_expected = "DBObj_".str_replace('/','_',$DBChampPerso->class);
	if (in_array($classname_expected,$class_list)) {
		$new_field=array();
		$new_field['fieldname']=urlencode($DBChampPerso->description);
		$new_field['description']=$DBChampPerso->description;
		if ($DBChampPerso->param!='') {
			$cmd='$extend='.$DBChampPerso->param.';';
			eval($cmd);
		}
		else
			$extend=array();
		switch($DBChampPerso->type) {
			case 0: // str
				$new_field['list']='';
				$new_field['type']='str';
				break;
			case 1: // entier
				$new_field['list']=$extend['Min'].';'.$extend['Max'].';0';
				$new_field['type']='float';
				break;
			case 2: // réel
				$new_field['list']=$extend['Min'].';'.$extend['Max'].';'.$extend['Prec'];
				$new_field['type']='float';
				break;
			case 3: // bool
				$new_field['list']='';
				$new_field['type']='bool';
				break;
			case 4: // énumération
				$new_field['type']='list';
				$list="";
				foreach($extend['Enum'] as $id=>$val)
					$list.="$id||$val;";
				$new_field['list']=$list;
				break;
		}
		// spécial base
		$new_field['table.name']='org_lucterios_contacts_personneChamp.value';
		$new_field['tables']=array('org_lucterios_contacts_personneChamp','org_lucterios_contacts_personneAbstraite');
		$new_field['wheres']=array('org_lucterios_contacts_personneChamp.contact=org_lucterios_contacts_personneAbstraite.id', 'org_lucterios_contacts_personneChamp.champ='.$DBChampPerso->id);

		$fields[]=$new_field;
	}
}

return $fields;
//@CODE_ACTION@
}

?>
