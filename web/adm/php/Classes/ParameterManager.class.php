<?php
class ParameterManager{
public $boxId, $name, $Connection;
public function __construct(){
	$this->Connection = new Connection();
}
public function findeVeriableVomDB($getboxId){
	$qry = $this->Connection->query("SELECT id, name FROM ".Connection::PREFIX."boxes WHERE id = :boxID AND id IN(SELECT fremdid FROM ".Connection::PREFIX."parameter WHERE sorte = '1' AND type NOT LIKE '6\_%');", array("boxID"=>$getboxId));
	if ($qry) {
	$this->boxId = $qry[0]['id'];
	$this->name = $qry[0]['name'];
	return true;
	}else{
	return false;
	}
}

public function gebeParameter(){
	$var['boxid'] = $this->boxId;
	$var['boxname'] = $this->name;
	$var['parameters'] = $this->findeAlleParameter();
	return $var;
}

private function findeAlleParameter(){
	$qry = $this->Connection->query("SELECT * FROM ".Connection::PREFIX."parameter WHERE fremdid = :boxID AND sorte = '1';", array("boxID"=>$this->boxId),PDO::FETCH_CLASS, 'ParameterTypeArray');
	return $qry;
}
}