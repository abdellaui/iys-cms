<?php
error_reporting(0);
session_start();
if ( 'autoload.php' == basename($_SERVER['SCRIPT_FILENAME']) )
{
	die('(c) '.date("Y").' by Abdullah Sahin. All rights reserved.');
	exit;
}
require("Classes/Connection.class.php");

require("Classes/Logs.class.php");

require("Classes/SeitenListe.class.php");

require("Classes/BoxManager.class.php");
require("Classes/BoxListe.class.php");

require("Classes/PanelManager.class.php");
require("Classes/PanelListe.class.php");

require("Classes/ParameterManager.class.php");
require("Classes/ParameterListe.class.php");
require("Classes/ParameterTypeArray.class.php");
require("Classes/ParameterInhaltManager.class.php");
require("Classes/Paneltem.class.php");
require("Classes/GenerateForm.class.php");

require("Classes/UserDetail.class.php");
?>