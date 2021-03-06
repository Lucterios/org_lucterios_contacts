<?php
// This file is part of Lucterios/Diacamma, a software developped by 'Le Sanglier du Libre' (http://www.sd-libre.fr)
// thanks to have payed a retribution for using this module.
// 
// Lucterios/Diacamma is free software; you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License, or
// (at your option) any later version.
// 
// Lucterios/Diacamma is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
// 
// You should have received a copy of the GNU General Public License
// along with Lucterios; if not, write to the Free Software
// Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// library file write by Lucterios SDK tool

//@BEGIN@
include_once("CORE/log.inc.php");
require_once("conf/cnf.inc.php");
require_once"CORE/dbcnx.inc.php";

function readCodePostalFile($codePostalFile) {
	global $connect;
	logAutre("install_contacts - Openfile=$codePostalFile");
	$q = "";
	$nb = 0;
	$lines = file($codePostalFile);
	$q = "INSERT IGNORE INTO org_lucterios_contacts_CodePostal (codePostal,ville,pays) VALUES ('75001','PARIS','FRANCE')";
	foreach($lines as $line) {
		list($codePostal,$ville,$pays) = explode(';',$line);
		if($pays == '')$pays = 'FRANCE';
		else $pays = strtoupper( trim($pays));
		$ville = strtoupper( trim($ville));
		$ville = str_replace("'",'`',$ville);
		$q .= ",('$codePostal','$ville','$pays')";
		$nb++;
	}
	$id = $connect->execute($q);
	if($id === false) {
		logAutre("install_contacts - Erreur=".$connect->errorMsg."\nQuery=". substr($q,0,300));
		$nb = 0;
	}
        logAutre("install_contacts - read $nb=$codePostalFile");
	return $nb;
}

function install_org_lucterios_contacts($ExensionVersions) {
	$error_msg = "";
	global $rootPath;
	if(!isset($rootPath))
		$rootPath = "./";
	$dir = "extensions/org_lucterios_contacts/";
	logAutre("install_contacts - dir=$dir");
	global $connect;
	$id = $connect->execute("SELECT count(*) FROM org_lucterios_contacts_CodePostal",true);
	list($nb)=$connect->getRow($id);
	$nb=(int)$nb;
	$testtag_file='conf/testtag.file';
	if (($nb==0) ||(!is_file($testtag_file) && version_compare($ExensionVersions[0], '1.5.2', '<'))) {
		$q = "DELETE FROM org_lucterios_contacts_CodePostal where pays='FRANCE' AND (codePostal LIKE '98%' OR codePostal LIKE '97%')";
		$id = $connect->execute($q);
		if($id === false)
			logAutre("install_contacts - Error=".$connect->errorMsg);

		$q = "CREATE UNIQUE INDEX IDX_UNIQUE ON org_lucterios_contacts_CodePostal(codePostal,ville,pays)";
		$id = $connect->execute($q);
		if($id === false)
			logAutre("install_contacts - Error=".$connect->errorMsg);
		$dh = opendir($rootPath.$dir);
		$nb = 0;
		while(($file = readdir($dh)) != false) {
			if( is_file($rootPath.$dir.$file) && ( substr($file,0,16) == "codepostal_ville") && ( substr($file,-4,4) == ".csv"))
				$nb = $nb+(int)readCodePostalFile($rootPath.$dir.$file);
		}
		if($nb>0)
			$error_msg .= "Import/controle de ".$nb." CodesPostals/Villes{[newline]}";
		else
			$error_msg .= "Pas d'import de Code Postal/Ville{[newline]}";
	}
	else
		$error_msg .= "Pas de mise � jour de Code Postal/Ville{[newline]}";
	// Fonction appel�e en fin d'installation.
	return $error_msg;
}
//@END@
?>
