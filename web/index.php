<?php
require("adm/php/Classes/Connection.class.php");
require("adm/php/Classes/Logs.class.php");
require("adm/php/Classes/GeneratePage.class.php");
$Connection = new Connection();
if(isset($_GET['seite'])){
	$get = addslashes($_GET['seite']);
}else{
	$get ='';
}
if(isset($_GET['seite']) && ($Connection->query("SELECT * FROM seiten WHERE urls = :getUrl;", array("getUrl"=>$get)))){
$getSeite = $get;
}else{
$getSeite = 'startseite';
}
$qry = $Connection->query("SELECT * FROM seiten WHERE urls = :getUrl;", array("getUrl"=>$getSeite));
$page = new GeneratePage();
/*
 manifest="/cache.manifest"
*/
?>
<!DOCTYPE html><html class="carmix" lang="de"><head><?php echo htmlspecialchars_decode($page->gibAlleParameters($qry[0]['headtag'],1),ENT_HTML5);?></head><body class="carmixBackgroundCover"><?php eval ("?>".htmlspecialchars_decode($page->gibAlleParameters($qry[0]['bodytag'],1),ENT_HTML5));?>
</html>
