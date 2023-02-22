<?php
if(isset($_GET['seite'])&& ($_GET['seite']=='dienstleistungen')){
	$reText = '';
	$Connection = new Connection();
	$GeneratePage = new GeneratePage();
	$item = $Connection->query("SELECT * FROM ".Connection::PREFIX."parameterpanelitem WHERE panel_id  = :panelID;",array("panelID"=>38));
		if($item){
			$typSecondLetter = 7;
				foreach($item as $d => $i){
					$reText .= $GeneratePage->adapter_getPanel($typSecondLetter,2,$i['id']);
				}
		}
	echo htmlspecialchars_decode($reText,ENT_HTML5);
}else{
	die('(c) 2014-'.date("Y").' by Abdullah Sahin. All rights reserved.');
	exit;
}
?>