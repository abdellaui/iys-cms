<?php
class GeneratePage{
	public $Connection;
	public function __construct(){
		$this->Connection = new Connection();
	}
	private function ersetzeParameterMitInhalt($getId, $getSorte, $itemId=0){
		$Suche = array();
		$Finde = array();
			if($getSorte==1){
				$panelOderBox = $this->Connection->query("SELECT * FROM boxes WHERE id = :getId;", array("getId"=>$getId));
			}else{
				$panelOderBox = $this->Connection->query("SELECT * FROM panels WHERE id = :getId;", array("getId"=>$getId));
			}
		if(count($panelOderBox)>0){
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
									$Finde[] = $this->ersetzeParameterMitInhalt($typSecondLetter,2,$i['id']);
								}
						}
				}elseif($typFirstLetter==6){
					$typSecondLetter = substr($a['type'],2);
					$Suche[] = '{{'.$a['name'].'}}';
					$Finde[] = $this->ersetzeParameterMitInhalt($typSecondLetter,1);
					
				}
		}
		return str_replace($Suche,$Finde,$dbGetSource);
		}else{
			return '';
		}
	}
		



		private function gibGetParameter($getter){
		$Suche = array();
		$Finde = array();
			foreach ($getter  as $key => $value) {
				$GLOBALS['mvcNameToIndex'][$value['name']]=count($Suche);
				$typFirstLetter = $value['type'];
				if($typFirstLetter==1 || $typFirstLetter==2 || $typFirstLetter==3 || $typFirstLetter==4){
									$nameToSe='{{$_GET::'.$value['name'].'}}';
										if($value['wert']){
											$Suche[] = $nameToSe;
			
											$valueP = $value['wert'];

											if($valueP!='' || $valueP!=' '){
												if($typFirstLetter==3){
												$Finde[] = nl2br($valueP);
												}else{
												$Finde[] = $valueP;
												}
											}else{
												$Finde[] = $nameToSe;
											}
										}else{
											$Suche[] = $nameToSe;
											$Finde[] = $nameToSe;
										}
				}elseif($typFirstLetter==6){
					$Suche[] = '{{$_GET::'.$value['name'].'}}';
					$panelOderBox = $this->Connection->query("SELECT * FROM boxes WHERE name = :getName;", array("getName"=>$value['wert']));
					if(count($panelOderBox)>0){
						$Finde[] = $this->ersetzeParameterMitInhalt($panelOderBox[0]['id'],1);
					}else{
						$Finde[] = '{{$_GET::'.$value['name'].'}}';
					}
			
					
				}
			}
			return array($Suche,$Finde);
		}



		public function gebeSeite($getter, $head, $body){
			$GLOBALS['replacer'] = $this->gibGetParameter($getter);

			$var = '<html lang="de"><head>';
			$var .= htmlspecialchars_decode($this->ersetzeParameterMitInhalt($head, 1),ENT_HTML5);
			$var .='</head><body>';
			ob_start();
			eval('?>'.htmlspecialchars_decode($this->ersetzeParameterMitInhalt($body, 1),ENT_HTML5));
			$var .= ob_get_contents();
			ob_end_clean();
			$var .= '</body></html>';
			$returnInhalt = str_replace($GLOBALS['replacer'][0], $GLOBALS['replacer'][1], $var);

			return preg_replace('/\t|\n|\r|   |\x0B|\0/','',$returnInhalt);
		}
}
?>