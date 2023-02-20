<?php
class MVCManager{
	public $Connection;
	
	public function __construct(){
		$this->Connection = new Connection();
	}
	public function getList() {
		$r = '';
		$qry1 = $this->Connection->query("SELECT * FROM mvc_parameter ORDER BY id ASC;",[],PDO::FETCH_CLASS, 'ParameterTypeArray');
	    $r .= '<div class="box box-success">
		  		<div class="box-header with-border">
				<h3 class="box-title">MVC Parameter</h3>
		  		</div>
		  		<div class="box-body" id="get_parameterInhalt">';
		if(count($qry1)>0){
			foreach($qry1 as $k => $a){
			$r .= '<div class="btn-group btn-group-justified" role="group"><div class="btn-group" role="group"><button type="button" class="btn btn-default">$_GET::'.$a->name.'</button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default">'.$a->typename.'</button></div></div>';
			
			}
		} else{ 
			$r .= '<div class="alert alert-danger" role="alert">Kein Parameter vorhanden!</div>'; 
		} 
		
		$r .= '</div></div>';
		return $r;
	}
	public function gibDaten() {
		$qry1 = $this->Connection->query("SELECT * FROM mvc_parameter ORDER BY id ASC;",[],PDO::FETCH_CLASS, 'ParameterTypeArray');
		$return = ['success'=>'1', 'parameters'=>$qry1];

        return $return;
    }

	public function updateParameters($parameters){
		if(is_array($parameters) || is_object($parameters)){
			foreach($parameters as $k => $a){
				if($a[0]=="new"){
				$qry = $this->Connection->query("INSERT INTO mvc_parameter (name, type) VALUES (:namePara, :typePara);", array("namePara"=>$a[2],"typePara"=>$a[3]));
				}elseif($a[0]=="update"){
				$qry = $this->Connection->query("UPDATE mvc_parameter SET name = :namePara , type = :typePara WHERE id = :paraID;", array("namePara"=>$a[2],"typePara"=>$a[3],"paraID"=>$a[1]));
				$qry1 = $this->Connection->query("DELETE FROM mvc_parameterinhalt WHERE parentid = :paraID;", array("paraID"=>$a[1]));
				}elseif($a[0]=="delete"){
					$qry = $this->Connection->query("DELETE FROM mvc_parameter WHERE id = :paraID;", array("paraID"=>$a[1]));
					$qry = $this->Connection->query("DELETE FROM mvc_parameterinhalt WHERE parentid = :paraID;", array("paraID"=>$a[1]));
				}
				
			}
		}
	}
	public function gibForm($id){
				$array = array(
					'1'=>'Input',
					'2'=>'Bild',
					'3'=>'Textarea',
					'4'=>'CKEditor',
					'6'=>'Box Platzhalter'
					);
			$return ='';
			$qry = $this->Connection->query("SELECT * FROM mvc_parameter ORDER by id ASC;");
			if($qry){
				foreach($qry as $k => $c){
							$par=1;
							$item = new GenerateForm($c['id'], $c['name'], $c['type'], $id , 1, $id, 2);	
							$return .= '<div class="box box-solid box-default">
				  <div class="box-header with-border">
					<h3 class="box-title">'.$c['name'].'</h3>
					<div class="box-tools pull-right">
                    <span class="label label-primary">'.$array[$c['type']].'</span>
                  </div>
				  </div>
				  <div class="box-body">'.$item->getErstellForm().'</div></div>';
				
					
				}
			}else{
				$return .= '<div class="box box-solid box-default"><div class="box-header with-border"><h3 class="box-title">404 Error</h3><small> Es sind keine MVC Panels vorhanden</small></div></div>';		
			}
			return $return;
		
		
	}


	public function updateParametersContent($parameterInhalt){
		if(is_array($parameterInhalt) || is_object($parameterInhalt)){
			foreach($parameterInhalt as $k => $a){
				if($a[0]=="new"){
				$qry1 = $this->Connection->query("SELECT COUNT(id) AS anzahl FROM mvc_parameterinhalt WHERE pageid = :paraID AND parentid = :parentID;", 
				array(
				"paraID"=>$a[5], 
				"parentID"=>$a[1]
				)
				);
				if($qry1[0]['anzahl']==0){
				$qry = $this->Connection->query("INSERT INTO mvc_parameterinhalt (pageid, parentid, wert) VALUES (:paraID, :parentID, :wert);", 
				array("paraID"=>$a[5],
					  "parentID"=>$a[1],
					  "wert"=>$a[6]
					  )
				);
				}else{
				$qry = $this->Connection->query("UPDATE mvc_parameterinhalt SET wert = :wert WHERE pageid = :paraID AND parentid = :parentID;", 
				array("wert"=>$a[6],
					  "paraID"=>$a[5],
					  "parentID"=>$a[1]
					  )
				);
				}
				}elseif($a[0]=="update"){
				$qry = $this->Connection->query("UPDATE mvc_parameterinhalt SET wert = :wert WHERE pageid = :paraID AND parentid = :parentID;", 
				array("wert"=>$a[6],
					  "paraID"=>$a[5],
					  "parentID"=>$a[1]
					  )
				);
				}
			}
		}
	}
}
?>