<?php
session_start();
require("adm/php/Classes/Connection.class.php");
require("adm/php/Classes/Logs.class.php");
require("adm/php/Classes/GeneratePage.class.php");
$Connection = new Connection();
if(isset($_GET['seite'])){
	$get = addslashes($_GET['seite']);
}else{
	$get ='';
}
if(isset($_GET['seite']) && ($Connection->query("SELECT * FROM ".Connection::PREFIX."seiten WHERE urls = :getUrl;", array("getUrl"=>$get)))){
$getSeite = $get;
}else{
$getSeite = 'startseite';
}
$qry = $Connection->query("SELECT * FROM ".Connection::PREFIX."seiten WHERE urls = :getUrl;", array("getUrl"=>$getSeite));
$get_MVC = $Connection->query("SELECT mvci.wert as wert , mvcp.type AS type, mvcp.name AS name FROM ".Connection::PREFIX."mvc_parameterinhalt AS mvci, ".Connection::PREFIX."mvc_parameter AS mvcp WHERE mvci.parentid = mvcp.id AND mvci.pageid = :pageid;", array("pageid"=>$qry[0]['id']));
$page = new GeneratePage();
?>
<!DOCTYPE html>
<!--
                          
			  /)    
			 (/_    
			/_) (_/_
			   .-/  
			  (_/   

      /)   /)     /) /)    /) 
 _   (/_ _(/     // // _  (/  
(_(_/_) (_(_(_(_(/_(/_(_(_/ )_                             
                   
			 /)   ,    
	 _   _  (/     __  
	/_)_(_(_/ )__(_/ (_

-->
<?php
  echo $page->gebeSeite($get_MVC, $qry[0]['headtag'], $qry[0]['bodytag']);

?>
