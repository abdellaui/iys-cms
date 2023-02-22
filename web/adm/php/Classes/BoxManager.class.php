<?php
class BoxManager{
public $statusBox, $boxId, $name, $source, $parameters, $Connection;
public function __construct(){
	$this->Connection = new Connection();
}
public function setzeVariable($statusBox, $boxId, $name, $source, $parameters){
	$this->statusBox = $statusBox;
	$this->boxId = $boxId;
	$this->name = $name;
	$this->source = $source;
	$this->parameters = $parameters;
}
public function findeVeriableVomDB($getboxId){
	$qry = $this->Connection->query("SELECT id, name, source FROM ".Connection::PREFIX."boxes WHERE id = :boxID;", array("boxID"=>$getboxId));
	if ($qry) {
	$this->statusBox = 'update';
	$this->boxId = $qry[0]['id'];
	$this->name = $qry[0]['name'];
	$this->source = $qry[0]['source'];
	$this->parameters = '';
	return true;
	}else{
	return false;
	}
}
public function createBox(){
	if($this->statusBox=="new"){
    $this->addBoxes();
	}elseif($this->statusBox=="update"){
	$this->updateBoxes();
	}
}

private function addBoxes(){
$qry = $this->Connection->query("INSERT INTO ".Connection::PREFIX."boxes (name, source) VALUES (:nameBox, :sourceBox);", array("nameBox"=>$this->name,"sourceBox"=>$this->source));
$this->boxId = $this->Connection->lastInsertId();
$this->addParameters();
}

private function updateBoxes(){
$qry = $this->Connection->query("UPDATE ".Connection::PREFIX."boxes SET name = :nameBox, source = :sourceBox WHERE id = :id;", array("nameBox"=>$this->name,"sourceBox"=>$this->source,"id"=>$this->boxId));
$this->updateParameters();
}

private function addParameters(){
	if(is_array($this->parameters) || is_object($this->parameters)){
	foreach($this->parameters as $k => $a){
		if($a[0]=="new"){
		$qry = $this->Connection->query("INSERT INTO ".Connection::PREFIX."parameter (name, type, fremdid , sorte) VALUES (:namePara, :typePara, :boxId , '1');", array("namePara"=>$a[2],"typePara"=>$a[3],"boxId"=>$this->boxId));
		}
	}
	}
}

private function updateParameters(){
	if(is_array($this->parameters) || is_object($this->parameters)){
	foreach($this->parameters as $k => $a){
		if($a[0]=="new"){
		$qry = $this->Connection->query("INSERT INTO ".Connection::PREFIX."parameter (name, type, fremdid , sorte) VALUES (:namePara, :typePara, :boxId , '1');", array("namePara"=>$a[2],"typePara"=>$a[3],"boxId"=>$this->boxId));
		}elseif($a[0]=="update"){
		$qry = $this->Connection->query("UPDATE ".Connection::PREFIX."parameter SET name = :namePara , type = :typePara WHERE id = :paraID;", array("namePara"=>$a[2],"typePara"=>$a[3],"paraID"=>$a[1]));
		$qry1 = $this->Connection->query("DELETE FROM ".Connection::PREFIX."parameterinhalt WHERE paraid = :paraID AND sorte = '1';", array("paraID"=>$a[1]));
		}elseif($a[0]=="delete"){
			$qry = $this->Connection->query("DELETE FROM ".Connection::PREFIX."parameter WHERE id = :paraID", array("paraID"=>$a[1]));
			$qry = $this->Connection->query("DELETE FROM ".Connection::PREFIX."parameterinhalt WHERE paraid = :paraID AND sorte = 1", array("paraID"=>$a[1]));
		}
		
	}
	}
}

public function gebeBox(){
	$qry1 = $this->Connection->query("SELECT * FROM ".Connection::PREFIX."parameter WHERE fremdid = :boxId AND sorte = '1';", array("boxId"=>$this->boxId),PDO::FETCH_CLASS, 'ParameterTypeArray');
	$var =array();
	$var['boxstatusbox'] = 'update';
	$var['boxid'] = $this->boxId;
	$var['boxname'] = $this->name;
	$var['source'] = $this->source;
	$var['parameters'] =$qry1;
	$var['menuparameter'] = new ParameterListe(2);
	return $var;
}
public function deleteBox(){
	$qry2 = $this->Connection->query("DELETE FROM ".Connection::PREFIX."parameterinhalt WHERE sorte = '1' AND paraid IN (SELECT id FROM ".Connection::PREFIX."parameter WHERE fremdid = :boxID AND sorte = '1');", array("boxID"=>$this->boxId));
	$qry1 = $this->Connection->query("DELETE FROM ".Connection::PREFIX."parameter WHERE (fremdid  = :boxID AND sorte = '1') OR (type = :boxTypID AND sorte = '1');", array("boxID"=>$this->boxId, "boxTypID"=>'6_'.$this->boxId));
	$qry0 = $this->Connection->query("DELETE FROM ".Connection::PREFIX."boxes WHERE id = :boxID;", array("boxID"=>$this->boxId));
}

public function gebeBoxDaten(){
	$var =array();
	$var['boxid'] = $this->boxId;
	$var['boxname'] = $this->name;
	return $var;
}

}
?>