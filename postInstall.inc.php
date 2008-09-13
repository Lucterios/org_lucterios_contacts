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
//  // library file write by SDK tool
// --- Last modification: Date 12 September 2008 22:37:16 By  ---

//@BEGIN@
include_once("CORE/log.inc.php");
require_once("conf/cnf.inc.php");
require_once"CORE/dbcnx.inc.php";

function readCodePostalFile($codePostalFile) {
	global $connect; logAutre("install_contacts - Openfile=$codePostalFile");
	$q = "";
	$nb = 0;
	$lines = file($codePostalFile);
	$q = "INSERT IGNORE INTO org_lucterios_contacts_CodePostal (codePostal,ville,pays) VALUES ('75001','PARIS','FRANCE')";
	foreach($lines as $line) {
		list($codePostal,$ville,$pays) = split(';',$line);
		if($pays == '')$pays = 'FRANCE';
		else $pays = strtoupper( trim($pays));
		$ville = strtoupper( trim($ville));
		$ville = str_replace("'",'`',$ville);
		$q .= ",('$codePostal','$ville','$pays')";
		$nb++;
	}
	$r = $connect->dbh->query($q);
	if(! DB:: isError($r)) {
		if( get_class($r) == 'DB_result')$r->free();
		$q = "";
	}
	else { logAutre("install_contacts - Erreur=".$r->getMessage()."\nQuery=". substr($q,0,300));
		$nb = 0;
	} logAutre("install_contacts - read$nb=$codePostalFile");
	return $nb;
}

function install_org_lucterios_contacts($ExensionVersions) {
	$error_msg = "";
	global $rootPath;
	if(!isset($rootPath))$rootPath = "./";
	$dir = "extensions/org_lucterios_contacts/"; logAutre("install_contacts - dir=$dir");
	global $connect;
	$q = "CREATE UNIQUE INDEX IDX_UNIQUE ON org_lucterios_contacts_CodePostal(codePostal,ville,pays)";
	$id = $connect->execute($q);
	if($id === false) logAutre("install_contacts - Error=".$connect->errorMsg);
	$dh = opendir($rootPath.$dir);
	$nb = 0;
	while(($file = readdir($dh)) != false) {
		if( is_file($rootPath.$dir.$file) && ( substr($file,0,16) == "codepostal_ville") && ( substr($file,-4,4) == ".csv"))$nb = $nb+(int) readCodePostalFile($rootPath.$dir.$file);
	}
	if($nb>0)$error_msg .= "Import/controle de ".$nb." CodesPostals/Villes{[newline]}";
	else $error_msg .= "Pas d'import de Code Postal/Ville{[newline]}";
	// Fonction appelée en fin d'installation.
	if( is_dir('extensions/contacts')) {
		global $connect;
		require_once('extensions/org_lucterios_contacts/personneAbstraite.tbl.php');
		$pers = new DBObj_org_lucterios_contacts_personneAbstraite;
		$nb = $pers->find();
		if($nb == 1) {
			//
			$table_conversion = array();
			$table_conversion[] = array('contacts/personneMorale','org_lucterios_contacts/personneMorale',1);
			$table_conversion[] = array('contacts/personnePhysique','org_lucterios_contacts/personnePhysique',1);
			$table_conversion[] = array('contacts/liaison','org_lucterios_contacts/liaison',0);
			$table_conversion[] = array('contacts/fonctions','org_lucterios_contacts/fonctions',0);
			$table_conversion[] = array('contacts/typesMorales','org_lucterios_contacts/typesMorales',0);
			//
			foreach($table_conversion as $table_info) {
				$nb = 0;
				require_once('extensions/'.$table_info[0].'.tbl.php');
				require_once('extensions/'.$table_info[1].'.tbl.php');
				$table_name_old = "DBObj_". str_replace('/','_',$table_info[0]);
				$table_name_new = "DBObj_". str_replace('/','_',$table_info[1]);
				$obj_old = new $table_name_old;
				$obj_old->find();
				while($obj_old->fetch()) {
					
					try {
						$obj_new = new $table_name_new;
						$obj_new->get($obj_old->id);
					}
					 catch( Exception$e) {
						if($table_info[1]) {
							$pers_id = $pers->insert();
							$q = "INSERT INTO ". str_replace('/','_',$table_info[1])." (id,superId) VALUES (".$obj_old->id.",".$pers_id.")";
						}
						else $q = "INSERT INTO ". str_replace('/','_',$table_info[1])." (id) VALUES (".$obj_old->id.")";
						$r = $connect->dbh->query($q);
						if(! DB:: isError($r) && ( get_class($r) == 'DB_result'))$r->free();
						$obj_new = new $table_name_new;
						$obj_new->get($obj_old->id);
					}
					$obj_new->setFrom($obj_old);
					$obj_new->update();
					$nb++;
				}
				$error_msg .= "Ajout/Correction de ".$nb." enregistrement sur ". str_replace('/','_',$table_info[1])."{[newline]}";
			}
		}
		$q = "DELETE FROM CORE_menu WHERE extensionId='contacts'";
		$r = $connect->execute($q);
	}
	return $error_msg;
}

//@END@
?>
