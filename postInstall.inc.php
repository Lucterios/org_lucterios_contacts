<?php
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
	if (($nb==0) ||(!is_file($testtag_file) && version_compare($ExensionVersions[0], '1.5.1', '<'))) {
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
		$error_msg .= "Pas de mise à jour de Code Postal/Ville{[newline]}";
	// Fonction appelèe en fin d'installation.
	return $error_msg;
}
//@END@
?>
