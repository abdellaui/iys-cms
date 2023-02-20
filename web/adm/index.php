<?php
require("php/autoload.php");
if(isset($_SESSION['login'])){
	require("php/admin_eingeloggt.php");
}else{
	require("php/admin_loginfenster.php");
}
?>