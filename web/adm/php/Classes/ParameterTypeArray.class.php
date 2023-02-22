<?php
class ParameterTypeArray{
	public $id, $name, $type, $fremdid ,$sorte, $typename;
	public function __construct(){
	$this->typename = $this->getParaTypList();
	}
	public function getParaTypList(){
		$array = array(
		'1'=>'Input',
		'2'=>'Bild',
		'3'=>'Textarea',
		'4'=>'CKEditor',
		'6'=>'Box Platzhalter'
		);
		$Connection = new Connection();
		$p = $Connection->query("SELECT id, name FROM ".Connection::PREFIX."panels ORDER BY name ASC;");
		foreach($p as $k => $a){
			$array['5_'.$a['id'].'']= 'Panel: '.$a['name'];
		}
		$q = $Connection->query("SELECT id, name FROM ".Connection::PREFIX."boxes ORDER BY name ASC;");
		foreach($q as $k => $a){
			$array['6_'.$a['id'].'']= 'Box: '.$a['name'];
		}
		return $array[$this->type];
	}

}
?>