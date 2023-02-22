<?php
class ParameterInhaltManager{
public $parameterInhalt, $Connection;
public function __construct(){
	$this->Connection = new Connection();
}
public function setzeVariable($parameterInhalt){
	$this->parameterInhalt = $parameterInhalt;
}

public function updateParameters(){
	if(is_array($this->parameterInhalt) || is_object($this->parameterInhalt)){
	foreach($this->parameterInhalt as $k => $a){
		if($a[0]=="new"){
		$qry1 = $this->Connection->query("SELECT COUNT(id) AS anzahl FROM ".Connection::PREFIX."parameterinhalt WHERE paraid = :paraID AND fremdid = :fremdID AND parentid = :parentID;", array("paraID"=>$a[1], "fremdID"=>$a[2], "parentID"=>$a[5]));
		if($qry1[0]['anzahl']==0){
		$qry = $this->Connection->query("INSERT INTO ".Connection::PREFIX."parameterinhalt (paraid, parentid, type , sorte, fremdid, wert) VALUES (:paraID, :parentID, :type , :sorte, :fremdID, :wert);", 
		array("paraID"=>$a[1],
			  "parentID"=>$a[5],
			  "type"=>$a[3],
			  "sorte"=>$a[4],
			  "fremdID"=>$a[2],
			  "wert"=>$a[6]
			  )
		);
		}else{
		$qry = $this->Connection->query("UPDATE ".Connection::PREFIX."parameterinhalt SET wert = :wert WHERE paraid = :paraID AND parentid = :parentID AND fremdid = :fremdID AND type = :type AND sorte = :sorte;", 
		array("wert"=>$a[6],
			  "paraID"=>$a[1],
			  "parentID"=>$a[5],
			  "fremdID"=>$a[2],
			  "type"=>$a[3],
			  "sorte"=>$a[4]
			  )
		);
		}
		}elseif($a[0]=="update"){
		$qry = $this->Connection->query("UPDATE ".Connection::PREFIX."parameterinhalt SET wert = :wert WHERE paraid = :paraID AND parentid = :parentID AND fremdid = :fremdID AND type = :type AND sorte = :sorte;", 
		array("wert"=>$a[6],
			  "paraID"=>$a[1],
			  "parentID"=>$a[5],
			  "fremdID"=>$a[2],
			  "type"=>$a[3],
			  "sorte"=>$a[4]
			  )
		);
		}
	}
	}
}

}