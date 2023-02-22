<?php
class PanelManager{
public $statusPanel, $panelId, $name, $source, $parameters, $Connection;
public function __construct(){
	$this->Connection = new Connection();
}
public function setzeVariable($statusPanel, $panelId, $name, $source, $parameters){
	$this->statusPanel = $statusPanel;
	$this->panelId = $panelId;
	$this->name = $name;
	$this->source = $source;
	$this->parameters = $parameters;
}
public function findeVeriableVomDB($getpanelId){
	$qry = $this->Connection->query("SELECT id, name, source FROM ".Connection::PREFIX."panels WHERE id = :panelID;", array("panelID"=>$getpanelId));
	if ($qry) {
	$this->statusPanel = 'update';
	$this->panelId = $qry[0]['id'];
	$this->name = $qry[0]['name'];
	$this->source = $qry[0]['source'];
	$this->parameters = '';
	return true;
	}else{
	return false;
	}
}
public function createPanel(){
	if($this->statusPanel=="new"){
    $this->addPanels();
	}elseif($this->statusPanel=="update"){
	$this->updatePanels();
	}
}

private function addPanels(){
$qry = $this->Connection->query("INSERT INTO ".Connection::PREFIX."panels (name, source) VALUES (:namePanel, :sourcePanel);", array("namePanel"=>$this->name,"sourcePanel"=>$this->source));
$this->panelId = $this->Connection->lastInsertId();
$this->addParameters();
}

private function updatePanels(){
$qry = $this->Connection->query("UPDATE ".Connection::PREFIX."panels SET name = :namePanel, source = :sourcePanel WHERE id = :id;", array("namePanel"=>$this->name,"sourcePanel"=>$this->source,"id"=>$this->panelId));
$this->updateParameters();
}

private function addParameters(){
	if(is_array($this->parameters) || is_object($this->parameters)){
	foreach($this->parameters as $k => $a){
		if($a[0]=="new"){
		$qry = $this->Connection->query("INSERT INTO ".Connection::PREFIX."parameter (name, type, fremdid, sorte) VALUES (:namePara, :typePara, :panelId, '2');", array("namePara"=>$a[2],"typePara"=>$a[3],"panelId"=>$this->panelId));
		}
	}
	}
}

private function updateParameters(){
	if(is_array($this->parameters) || is_object($this->parameters)){
	foreach($this->parameters as $k => $a){
		if($a[0]=="new"){
		$qry = $this->Connection->query("INSERT INTO ".Connection::PREFIX."parameter (name, type, fremdid, sorte) VALUES (:namePara, :typePara, :panelId, '2');", array("namePara"=>$a[2],"typePara"=>$a[3],"panelId"=>$this->panelId));
		}elseif($a[0]=="update"){
		$qry = $this->Connection->query("UPDATE ".Connection::PREFIX."parameter SET name = :namePara , type = :typePara WHERE id = :paraID;", array("namePara"=>$a[2],"typePara"=>$a[3],"paraID"=>$a[1]));
		$qry1 = $this->Connection->query("DELETE FROM ".Connection::PREFIX."parameterinhalt WHERE paraid = :paraID AND sorte = '2';", array("paraID"=>$a[1]));
		}elseif($a[0]=="delete"){
			$qry = $this->Connection->query("DELETE FROM ".Connection::PREFIX."parameter WHERE id = :paraID", array("paraID"=>$a[1]));
			$qry = $this->Connection->query("DELETE FROM ".Connection::PREFIX."parameterinhalt WHERE paraid = :paraID AND sorte = 2", array("paraID"=>$a[1]));
		}
		
	}
	}
}

public function gebePanel(){
	$qry1 = $this->Connection->query("SELECT * FROM ".Connection::PREFIX."parameter WHERE fremdid = :panelId AND sorte = '2';", array("panelId"=>$this->panelId),PDO::FETCH_CLASS, 'ParameterTypeArray');
	$var =array();
	$var['panelstatuspanel'] = 'update';
	$var['panelid'] = $this->panelId;
	$var['panelname'] = $this->name;
	$var['source'] = $this->source;
	$var['parameters'] =$qry1;
	return $var;
}
public function deletePanel(){
	$qry3 = $this->Connection->query("DELETE FROM ".Connection::PREFIX."parameterpanelitem  WHERE id IN ( SELECT id FROM (SELECT t1.id AS id FROM ".Connection::PREFIX."parameterpanelitem AS t1, parameter AS t2 WHERE t1.panel_id =t2.id AND t2.type= :panelID3) AS cid);", array("panelID3"=>'5_'.$this->panelId));
	$qry2 = $this->Connection->query("DELETE FROM ".Connection::PREFIX."parameterinhalt WHERE sorte = '2' AND paraid IN (SELECT id FROM ".Connection::PREFIX."parameter WHERE fremdid = :panelID AND sorte = '2');", array("panelID"=>$this->panelId));
	
	$qry1 = $this->Connection->query("DELETE FROM ".Connection::PREFIX."parameter WHERE (fremdid  = :panelID AND sorte = '2') OR (type = :panelTypID AND sorte = '1');", array("panelID"=>$this->panelId, "panelTypID"=>'5_'.$this->panelId));
	$qry0 = $this->Connection->query("DELETE FROM ".Connection::PREFIX."panels WHERE id = :panelID;", array("panelID"=>$this->panelId));
}
}