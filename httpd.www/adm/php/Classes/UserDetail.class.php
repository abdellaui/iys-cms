<?php
class UserDetail{
	public $id, $Connection, $qry;
	public function __construct($id){
		$this->id = $id;
		$this->Connection = new Connection();
		$this->qry = $this->Connection->query("SELECT * FROM admin WHERE id = :userID LIMIT 1;", array("userID"=>$this->id));
	}
	public function getDetails() {
        return $this->qry[0];
    }
	public function passwordAendern($alte,$neue){
		if(md5($alte)==$this->qry[0]['psw']){
			if(strlen($neue)>2){
				$this->Connection->query("UPDATE admin SET psw = :neuePSW WHERE id = :userID LIMIT 1;", array("userID"=>$this->id,"neuePSW"=>md5($neue)));
				return 1;
			}else{
				return "Neues Passwort muss mindestens 3 Zeichen beinhalten!";
			}
		}else{
			return "Altes Passwort stimmt nicht überein!";
		}
	}
	
	public function mailAendern($neue){
			if(strlen($neue)>5){
				$this->Connection->query("UPDATE admin SET mail = :neueMAIL WHERE id = :userID LIMIT 1;", array("userID"=>$this->id,"neueMAIL"=>$neue));
				return 1;
			}else{
				return "Neue E-Mail muss mindestens 5 Zeichen beinhalten!";
			}
	}
}
?>