<?php
class PanelItem{
	public $Connection;
	
	public function __construct(){
		$this->Connection = new Connection();
	}
	public function gibForm($id){
			$d = $this->Connection->query("SELECT * FROM parameterpanelitem WHERE id = :getId LIMIT 1;",array("getId"=>$id));
			if($d){
				$a = $this->Connection->query("SELECT * FROM parameter WHERE id = :getId LIMIT 1;",array("getId"=>$d[0]['panel_id']));
				if($a){
					$item = new GenerateForm();
					$qry = $this->Connection->query("SELECT * FROM parameter WHERE fremdid = :boxID AND sorte = '2';", array("boxID"=>substr($a[0]['type'], 2)),PDO::FETCH_CLASS, 'ParameterTypeArray');
					if($qry){
					$return ='';
					foreach($qry as $k => $c){
					$return .= $item->erstellFormMitParams($c->id, $c->name, $c->type, $c->fremdid ,$c->sorte, $c->typename, $d[0]['id']);	
					}
					}else{
					$return .= '<div class="box box-solid box-default"><div class="box-header with-border"><h3 class="box-title">404 Error</h3><small> Panel hat keinen Parameter</small></div></div>';		
					}
					return $return;
					}else{
				return 0;
					}
			}else{
				return 0;
			}
	}
	public function insertItem($panelid, $name){
		if(isset($panelid)&&isset($name)){
			$c = $this->Connection->query("INSERT INTO parameterpanelitem (panel_id, name) VALUES (:panelId, :itemName);", array("panelId"=>$panelid,"itemName"=>$name));
			if($c){ 
			return $this->Connection->lastInsertId();
			}else{
			return 0;
			}
		}else{
		return 0;
		}
	}
	public function updateItem($id, $name){
		if(isset($id)&&isset($name)){
			$c = $this->Connection->query("UPDATE parameterpanelitem SET name = :itemName WHERE id = :itemId LIMIT 1;", 
			array(  "itemId"=>$id,
					"itemName"=>$name)
			);
			if($c){ 
			return 1;
			}else{
			return 0;
			}
		}else{
		return 0;
		}
	}
	public function deleteItem($id){
		$b = $this->Connection->query("DELETE FROM parameterinhalt WHERE id IN(SELECT id FROM ( SELECT t3.id AS id FROM parameterpanelitem AS t1, parameter AS t2, parameterinhalt AS t3 WHERE t1.id = :idToDel AND t1.panel_id =t2.id AND t1.id = t3.parentid AND t3.fremdid = SUBSTRING(t2.type,3)) AS cid);",array("idToDel"=>$id));
		$c = $this->Connection->query("DELETE FROM parameterpanelitem WHERE id = :idToDel LIMIT 1;", array("idToDel"=>$id));
		if($c){ 
		return 1;
		}else{
		return 0;
		}
	}
}
?>