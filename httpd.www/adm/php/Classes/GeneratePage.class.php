<?php
class GeneratePage{
	public $Connection;
	public function __construct(){
		$this->Connection = new Connection();
	}
	public function gibAlleParameters($getId, $getSorte, $itemId=0){
		$Suche = array();
		$Finde = array();
			if($getSorte==1){
				$panelOderBox = $this->Connection->query("SELECT * FROM boxes WHERE id = :getId;", array("getId"=>$getId));
			}else{
				$panelOderBox = $this->Connection->query("SELECT * FROM panels WHERE id = :getId;", array("getId"=>$getId));
			}
		$dbGetId = $panelOderBox[0]['id'];
		$dbGetName = $panelOderBox[0]['name'];
		$dbGetSource = $panelOderBox[0]['source'];
		$qry = $this->Connection->query("SELECT * FROM parameter WHERE fremdid = :dbGetId AND sorte = :sorteGet ORDER BY id ASC;", array("dbGetId"=>$dbGetId,"sorteGet"=>$getSorte));
		foreach($qry as $k => $a){
			//START
			if($getSorte==1){
					$typFirstLetter = substr($a['type'],0,1);
					$parentId = $a['id'];
					$sorte=$a['sorte'];
					$_dbGetId=$dbGetId;
			}else{
					$typFirstLetter = $a['type'];
					$parentId = $itemId;
					$sorte=2;
					$_dbGetId=$getId;
			}
				if($typFirstLetter==1 || $typFirstLetter==2 || $typFirstLetter==3 || $typFirstLetter==4){
					$getInhalt = $this->Connection->query("SELECT * FROM parameterinhalt WHERE paraid = :paraId AND parentid = :parentId AND type= :paraTyp AND sorte = :sorteGet AND fremdid = :dbGetId;",array(
					"paraId"=>$a['id'],
					"parentId"=>$parentId,
					"paraTyp"=>$a['type'],
					"sorteGet"=>$sorte,
					"dbGetId"=>$_dbGetId
					)
					);
					$nameToSe='{{'.$a['name'].'}}';
						if($getInhalt){
							$Suche[] = $nameToSe;
							if($getInhalt[0]['wert']!='' || $getInhalt[0]['wert']!=' '){
								if($typFirstLetter==3){
								$Finde[] = nl2br ($getInhalt[0]['wert'] );
								}else{
								$Finde[] = $getInhalt[0]['wert'];
								}
							}else{
								$Finde[] = $nameToSe;
							}
						}else{
							$Suche[] = $nameToSe;
							$Finde[] = $nameToSe;
						}
				}elseif($typFirstLetter==5){
					$item = $this->Connection->query("SELECT * FROM parameterpanelitem WHERE panel_id  = :panelID;",array("panelID"=>$a['id']));
						if($item){
							$typSecondLetter = substr($a['type'],2);
								$test='';
								foreach($item as $d => $i){
									$test.='{{'.$a['name'].$i['id'].'}}';
								}
								$Suche[] = '{{'.$a['name'].'}}';
								$Finde[] = $test;
								foreach($item as $d => $i){
									$Suche[] = '{{'.$a['name'].$i['id'].'}}';
									$Finde[] = $this->gibAlleParameters($typSecondLetter,2,$i['id']);
								}
						}
				}elseif($typFirstLetter==6){
					$typSecondLetter = substr($a['type'],2);
					$Suche[] = '{{'.$a['name'].'}}';
					$Finde[] = $this->gibAlleParameters($typSecondLetter,1);
					
				}
		}
		//return str_replace($Suche,$Finde,$dbGetSource);
		return preg_replace('/\t|\n|\r|  |\x0B|\0/','',str_replace($Suche,$Finde,$dbGetSource));
		}
}
?>