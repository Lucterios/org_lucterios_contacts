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
// --- Last modification: Date 16 October 2009 0:50:28 By  ---

//@BEGIN@
function willMailSend() {
	include_once("Mail.php");
	require_once('CORE/extension_params.tbl.php');
	$DBParam=new DBObj_CORE_extension_params;
	$params=$DBParam->getParameters("org_lucterios_contacts");
	return class_exists('Mail') && ($params['MailSmtpServer']!='');
}

function sendEMail($from,$recipients,$Subject,$body) {
	include_once("Mail.php");

	require_once('CORE/extension_params.tbl.php');
	$DBParam=new DBObj_CORE_extension_params;
	$params=$DBParam->getParameters("org_lucterios_contacts");

	$params["host"] = $params['MailSmtpServer'];
	$params["port"] = "25";
	if ($params['MailSmtpUser']!='') {
		$params["auth"] = true;
		$params["username"] = $params['MailSmtpUser'];
		$params["password"] = $params['MailSmtpPass'];
	}

	$headers["From"] = $from;
	$headers["To"] = $recipients;
	$headers["Subject"] = $Subject;

	$mail_object =& Mail::factory("smtp", $params);
	$send=$mail_object->send($recipients, $headers, $body);
	if (PEAR::isError($send)) {
		require_once "CORE/Lucterios_Error.inc.php";
		throw new LucteriosException(IMPORTANT,$send->getMessage());
	}
}

function sendNewConnection($recipients,$Alias,$Password) {
	require_once('extensions/org_lucterios_contacts/personneMorale.tbl.php');
	$DBMoral=new DBObj_org_lucterios_contacts_personneMorale();
	$DBMoral->get(1);
	$from=$DBMoral->mail;
	$name=$DBMoral->raisonSociale;

	$Subject="Mot de passe de connexion";

	require_once('CORE/extension_params.tbl.php');
	$DBParam=new DBObj_CORE_extension_params;
	$params=$DBParam->getParameters("org_lucterios_contacts");
	$body=str_replace(array("{[newline]}"),array("\n"),$params['MailConnectionMsg'])."\n\n";
	$body.="\tAlias\t\t$Alias\n";
	$body.="\tMot de passe\t$Password\n";
	$body.="\n$name\n";
	sendEMail($from,$recipients,$Subject,$body);
}

function passwordGenerator() {
	$letter_string = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@$#%&*+=';
	$size_string = strlen($letter_string);
	$nb_caract = 10;
	$pass = "";
	while (strlen($pass) < $nb_caract) {
		$num = mt_rand(0,($size_string-1));
    		$pass.=$letter_string[$num];
	}
	return $pass;
}
//@END@
?>