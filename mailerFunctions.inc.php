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
// library file write by SDK tool
// --- Last modification: Date 10 April 2012 21:04:42 By  ---

//@BEGIN@
function willMailSend() {
	include_once("extensions/org_lucterios_contacts/smtp.inc.php");
	require_once('CORE/extension_params.tbl.php');
	$DBParam=new DBObj_CORE_extension_params;
	$params=$DBParam->getParameters("org_lucterios_contacts");
	return class_exists('smtp_class') && ($params['MailSmtpServer']!='');
}

function sendEMail($from,$recipients,$Subject,$body,$contentFile='',$fileName='') {
	include_once("extensions/org_lucterios_contacts/smtp.inc.php");

	require_once('CORE/extension_params.tbl.php');
	$DBParam=new DBObj_CORE_extension_params;
	$params=$DBParam->getParameters("org_lucterios_contacts");

	$smtp=new smtp_class;
	$smtp->host_name=$params['MailSmtpServer'];
	$smtp->host_port=$params['MailSmtpPort'];

	$smtp_params["host"] = $params['MailSmtpServer'];
	$smtp_params["port"] = 25;
	if ($params['MailSmtpUser']!='') {
		$smtp->user=$params['MailSmtpUser'];
		$smtp->realm=$params['MailSmtpPass'];
		$smtp->password=$params['MailSmtpPass'];
	}
	else  {
		$smtp->user="";
		$smtp->realm="";
		$smtp->password="";
	}
	if ($params['MailSmtpSecurity']==1)
            		$smtp->start_tls=1;
	if ($params['MailSmtpSecurity']==2)
		$smtp->ssl=1;
	$smtp->localhost="localhost";
	$smtp->debug=0;
	$smtp->timeout=10;
	$smtp->data_timeout=0;

	$random_hash = md5(date('r', time()));
	$extendbody ='';
	if ($contentFile!='') {
		if ($fileName=='') $fileName='FichierJoint';
		$extendbody.='--'.$random_hash."\n";
		$Conttype='Content-Type: multipart/mixed; boundary="'.$random_hash.'"';
		$extendbody.="Content-Type: text/plain;charset=iso-8859-1\r\n\n";
		$extendbody.=$body."\n\n";
		$extendbody.='--'.$random_hash."\n";
		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$extendbody.='Content-Type: '.$finfo->buffer($contentFile).'; name="'.$fileName.'"'."\r\n";
		$extendbody.="Content-Transfer-Encoding: base64\r\n";
		$extendbody.='Content-Disposition: attachment; filename="'.$fileName.'"'."\r\n\n";
		$extendbody.=chunk_split(base64_encode($contentFile));
		$extendbody.='--'.$random_hash.'--'."\n";
	}
	else {
		$Conttype="Content-Type: text/plain;charset=iso-8859-1";
		$extendbody.=$body."\n";
	}
	$ret=$smtp->SendMessage($from,explode(',',$recipients),array(
		"From: $from",
		"To: $recipients",
		"Subject: $Subject",
		"Date: ".strftime("%a, %d %b %Y %H:%M:%S %Z"),
		$Conttype),
		$extendbody);

	if (!$ret) {
		require_once "CORE/Lucterios_Error.inc.php";
		throw new LucteriosException(IMPORTANT,$smtp->error);
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
