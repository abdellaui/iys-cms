<?php
class SeitenListe{
	public $vars,$Connection;
	
	public function __construct(){
		$this->vars = '';
		$this->Connection = new Connection();
	}
	
	public function __toString() {
		$this->seitenListeOutput();
        return $this->vars;
    }
	private function seitenListeOutput(){
		$c = $this->Connection->query("SELECT id, urls, names, headtag, bodytag FROM seiten ORDER BY id DESC;");
		if($c){
		$this->vars .='<ul class="list-group" id="seitenLister">';
		foreach($c as $k => $a){
			$this->vars .='<li class="list-group-item">
			<div class="row" abdullahSeitenId="'.$a['id'].'">
			<div class="col-md-2">
			<div class="form-group">
			  <label for="seiten_urls">URL:</label>
			  <input type="text" class="form-control" id="seiten_urls" value="'.$a['urls'].'">
			</div>		
			</div>
			<div class="col-md-2">
			<div class="form-group">
			  <label for="seiten_names">Name der Seite:</label>
			  <input type="text" class="form-control" id="seiten_names" value="'.$a['names'].'">
			</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
				<label for="seiten_headtag">Head-Tag Box:</label>
				<select class="form-control" name="seiten_headtag" id="seiten_headtag">'.$this->getBoxName($a['headtag']).'</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
				<label for="seiten_bodytag">Body-Tag Box:</label>
				<select class="form-control" name="seiten_bodytag" id="seiten_bodytag">'.$this->getBoxName($a['bodytag']).'</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="tools">&nbsp;</label>
					<div class="btn-group btn-group-justified" role="group" id="seite_'.$a['id'].'">
					<div class="btn-group" role="group" onclick="pageLoeschen('.$a['id'].');"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Löschen</button></div>
					</div>
				</div>
			</div>
			</div>
			</li>';
		}
		$this->vars .='</ul>';
		}else{
			$this->vars ='';
		}
		
	}
	
	private function getBoxName($id){
			return new BoxListe(0,1,$id);
	}
	public function insertPage($url, $name, $hbox, $bbox){
		if(isset($url)&&isset($name)&&isset($hbox)&&isset($bbox)){
			$c = $this->Connection->query("INSERT INTO seiten (urls, names, headtag, bodytag) VALUES (:seiteUrls, :seiteNames, :seiteHeadtag, :seiteBodytag);", array("seiteUrls"=>strtolower($url),"seiteNames"=>$name, "seiteHeadtag"=>$hbox, "seiteBodytag"=>$bbox));
			if($c){ 
			return 1;
			}else{
			return 0;
			}
		}else{
		return 0;
		}
	}
	public function updatePage($id, $url, $name, $hbox, $bbox){
		if(isset($id)&&isset($url)&&isset($name)&&isset($hbox)&&isset($bbox)){
			$c = $this->Connection->query("UPDATE seiten SET urls = :seiteUrls, names = :seiteNames, headtag = :seiteHeadtag, bodytag = :seiteBodytag WHERE id = :seiteId LIMIT 1;", 
			array(  "seiteUrls"=>strtolower($url),
					"seiteNames"=>$name,
					"seiteHeadtag"=>$hbox,
					"seiteBodytag"=>$bbox,
					"seiteId"=>$id)
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
	public function deletePage($id){
		$c = $this->Connection->query("DELETE FROM seiten WHERE id = :idToDel LIMIT 1;", array("idToDel"=>$id));
		if($c){ 
		return 1;
		}else{
		return 0;
		}
	}
}
?>