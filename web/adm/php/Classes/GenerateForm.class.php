<?php
class GenerateForm{
	public $id, $name, $type, $fremdid ,$sorte, $Connection;
	
	public function __construct($id=0, $name=0, $type=0, $fremdid=0,$sorte=0){
		$this->id = $id;
		$this->name = $name;
		$this->type = $type;
		$this->fremdid = $fremdid;
		$this->sorte = $sorte;
		$this->Connection = new Connection();
	}
	public function __toString(){
		return $this->erstellForm();
	}
	
	private function hatEinWert($id, $fremdid, $parentid){
		$qry1 = $this->Connection->query("SELECT COUNT(id) AS anzahl, type, wert, id FROM parameterinhalt WHERE paraid = :paraID AND fremdid = :fremdID AND parentid = :parentID;", array("paraID"=>$id, "fremdID"=>$fremdid, "parentID"=>$parentid));
		if($qry1[0]['anzahl']>0){
			if($qry1[0]['wert']!=''){
			if($qry1[0]['type']==1||$qry1[0]['type']==2||$qry1[0]['type']==3){
				return htmlspecialchars($qry1[0]['wert']);
			}else{
				return $qry1[0]['wert'];
			}
			}else{
				return ' ';
			}
		}else{
		return false;
		}
	}
	
	
	public function erstellFormMitParams($id, $name, $type, $fremdid ,$sorte, $typename, $parentid){
	
	$typFirst = substr($type, 0, 1);
	$return = '<div class="box box-solid box-default">
				  <div class="box-header with-border">
					<h3 class="box-title">'.$name.'</h3>
					<div class="box-tools pull-right">
                    <span class="label label-primary">'.$typename.'</span>
                  </div>
				  </div>
				  <div class="box-body">';
	$genSuf = $id.'_'.$fremdid.'_'.$type.'_'.$parentid;
	if($typFirst==1){
		if($this->hatEinWert($id, $fremdid, $parentid)){
		$return .= '<div class="input-group input-group-lg"><span class="input-group-addon" id="sizing-addon1"><i class="fa fa-file-text-o"></i></span><input type="text" class="form-control" placeholder="Ein Wert für '.$name.'" aria-describedby="sizing-addon1" id="input'.$genSuf.'" value="'.$this->hatEinWert($id, $fremdid, $parentid).'"></div>';
		$return .= '<div class="hidden" paraarbeit="update" parasuche="var" paranick="input" paraid="'.$id.'" parafremdid="'.$fremdid.'" paratype="'.$type.'" parafremdsorte="'.$sorte.'" paraparent="'.$parentid.'"></div>';
		}else{
		$return .= '<div class="input-group input-group-lg"><span class="input-group-addon" id="sizing-addon1"><i class="fa fa-file-text-o"></i></span><input type="text" class="form-control" placeholder="Ein Wert für '.$name.'" aria-describedby="sizing-addon1" id="input'.$genSuf.'"></div>';	
		$return .= '<div class="hidden" paraarbeit="new" parasuche="var" paranick="input" paraid="'.$id.'" parafremdid="'.$fremdid.'" paratype="'.$type.'" parafremdsorte="'.$sorte.'" paraparent="'.$parentid.'"></div>';
		}
	}elseif($typFirst==2){
		if($this->hatEinWert($id, $fremdid, $parentid)){
		$return .= '<div class="input-group input-group-lg"><span class="input-group-addon" id="sizing-addon1"><a href="#" title="Bildvorschau" id="vorschauimage'.$genSuf.'" data-toggle="popover" title="Bildvorschau" data-html="true" data-content="<img src=\''.$this->hatEinWert($id, $fremdid, $parentid).'\' class=\'img-responsive center-block\' alt=\'Bitte einen gültigen Bild laden!\'/>"><i class="fa fa-picture-o"></i></a></span><input type="text" class="form-control" placeholder="Ein Wert für '.$name.'" aria-describedby="sizing-addon1" id="image'.$genSuf.'" value="'.$this->hatEinWert($id, $fremdid, $parentid).'"><span class="input-group-btn" id="sizing-addon1"><button type="button" class="btn btn-default" aria-describedby="sizing-addon1" onclick="BrowseServer(\'image'.$genSuf.'\');">Durchsuchen</button></span></div>';
		$return .= '<div class="hidden" paraarbeit="update" parasuche="var" paranick="image" paraid="'.$id.'" parafremdid="'.$fremdid.'" paratype="'.$type.'" parafremdsorte="'.$sorte.'" paraparent="'.$parentid.'"></div>';
		}else{
		$return .= '<div class="input-group input-group-lg"><span class="input-group-addon" id="sizing-addon1"><a href="#" title="Bildvorschau" id="vorschauimage'.$genSuf.'" data-toggle="popover" title="Bildvorschau" data-html="true" data-content="<img src=\'/adm/dist/img/bildvorschaudefault.jpg\' class=\'img-responsive center-block\' alt=\'Bitte einen gültigen Bild laden!\'/>"><i class="fa fa-picture-o"></i></a></span><input type="text" class="form-control" placeholder="Ein Wert für '.$name.'" aria-describedby="sizing-addon1" id="image'.$genSuf.'"><span class="input-group-btn" id="sizing-addon1"><button type="button" class="btn btn-default" aria-describedby="sizing-addon1" onclick="BrowseServer(\'image'.$genSuf.'\');">Durchsuchen</button></span></div>';
		$return .= '<div class="hidden" paraarbeit="new" parasuche="var" paranick="image" paraid="'.$id.'" parafremdid="'.$fremdid.'" paratype="'.$type.'" parafremdsorte="'.$sorte.'" paraparent="'.$parentid.'"></div>';
		}
	}elseif($typFirst==3){
		if($this->hatEinWert($id, $fremdid, $parentid)){
		$return .= '<div class="form-group"><label for="textarea'.$genSuf.'">Inhalt für '.$name.':</label><textarea class="form-control" rows="5" id="textarea'.$genSuf.'" style="resize:none">'.$this->hatEinWert($id, $fremdid, $parentid).'</textarea></div>';
		$return .= '<div class="hidden" paraarbeit="update" parasuche="var" paranick="textarea" paraid="'.$id.'" parafremdid="'.$fremdid.'" paratype="'.$type.'" parafremdsorte="'.$sorte.'" paraparent="'.$parentid.'"></div>';
		}else{
		$return .= '<div class="form-group"><label for="textarea'.$genSuf.'">Inhalt für '.$name.':</label><textarea class="form-control" rows="5" id="textarea'.$genSuf.'" style="resize:none"></textarea></div>';
		$return .= '<div class="hidden" paraarbeit="new" parasuche="var" paranick="textarea" paraid="'.$id.'" parafremdid="'.$fremdid.'" paratype="'.$type.'" parafremdsorte="'.$sorte.'" paraparent="'.$parentid.'"></div>';
		}
	}elseif($typFirst==4){
		if($this->hatEinWert($id, $fremdid, $parentid)){
		$return .= '<div id="ckeditorFrame'.$genSuf.'" class="form-group"><label for="ckeditor'.$genSuf.'">Inhalt für '.$name.':</label><textarea class="ckeditorGenerator hidden" abdullahvalue="'.$genSuf.'" name="ckeditor'.$genSuf.'" id="ckeditor'.$genSuf.'" rows="10" cols="80">'.$this->hatEinWert($id, $fremdid, $parentid).'</textarea><textarea class="hidden" id="ckeditorInhalt'.$genSuf.'">'.$this->hatEinWert($id, $fremdid, $parentid).'</textarea>';
		$return .= '<div class="hidden" paraarbeit="update" parasuche="html" paranick="ckeditorInhalt" paraid="'.$id.'" parafremdid="'.$fremdid.'" paratype="'.$type.'" parafremdsorte="'.$sorte.'" paraparent="'.$parentid.'"></div></div>';
		}else{
		$return .= '<div id="ckeditorFrame'.$genSuf.'" class="form-group"><label for="ckeditor'.$genSuf.'">Inhalt für '.$name.':</label><textarea class="ckeditorGenerator hidden" abdullahvalue="'.$genSuf.'" name="ckeditor'.$genSuf.'" id="ckeditor'.$genSuf.'" rows="10" cols="80"></textarea><textarea class="hidden" id="ckeditorInhalt'.$genSuf.'"></textarea>';	
		$return .= '<div class="hidden" paraarbeit="new" parasuche="html" paranick="ckeditorInhalt" paraid="'.$id.'" parafremdid="'.$fremdid.'" paratype="'.$type.'" parafremdsorte="'.$sorte.'" paraparent="'.$parentid.'"></div></div>';
		}
	}
	$return .= '</div></div>';
	return $return;
	
	
	}
	
	private function erstellForm(){
	$typFirst = substr($this->type, 0, 1);
	$return = '';
	$genSufix = $this->id.'_'.$this->fremdid.'_'.$this->type.'_'.$this->id;
	if($typFirst==1){
		if($this->hatEinWert($this->id, $this->fremdid, $this->id)){
		$return .= '<div class="input-group input-group-lg"><span class="input-group-addon" id="sizing-addon1"><i class="fa fa-file-text-o"></i></span><input type="text" class="form-control" placeholder="Ein Wert für '.$this->name.'" aria-describedby="sizing-addon1" id="input'.$genSufix.'" value="'.$this->hatEinWert($this->id, $this->fremdid, $this->id).'"></div>';
		$return .= '<div class="hidden" paraarbeit="update" parasuche="var" paranick="input" paraid="'.$this->id.'" parafremdid="'.$this->fremdid.'" paratype="'.$this->type.'" parafremdsorte="'.$this->sorte.'" paraparent="'.$this->id.'"></div>';
		}else{
		$return .= '<div class="input-group input-group-lg"><span class="input-group-addon" id="sizing-addon1"><i class="fa fa-file-text-o"></i></span><input type="text" class="form-control" placeholder="Ein Wert für '.$this->name.'" aria-describedby="sizing-addon1" id="input'.$genSufix.'"></div>';
		$return .= '<div class="hidden" paraarbeit="new" parasuche="var" paranick="input" paraid="'.$this->id.'" parafremdid="'.$this->fremdid.'" paratype="'.$this->type.'" parafremdsorte="'.$this->sorte.'" paraparent="'.$this->id.'"></div>';
		}
	}elseif($typFirst==2){
		if($this->hatEinWert($this->id, $this->fremdid, $this->id)){
		$return .= '<div class="input-group input-group-lg"><span class="input-group-addon" id="sizing-addon1"><a href="#" title="Bildvorschau" id="vorschauimage'.$genSufix.'" data-toggle="popover" title="Bildvorschau" data-html="true" data-content="<img src=\''.$this->hatEinWert($this->id, $this->fremdid, $this->id).'\' class=\'img-responsive center-block\' alt=\'Bitte einen gültigen Bild laden!\'/>"><i class="fa fa-picture-o"></i></a></span><input type="text" class="form-control" placeholder="Ein Wert für '.$this->name.'" aria-describedby="sizing-addon1" id="image'.$genSufix.'" value="'.$this->hatEinWert($this->id, $this->fremdid, $this->id).'"><span class="input-group-btn" id="sizing-addon1"><button type="button" class="btn btn-default" aria-describedby="sizing-addon1" onclick="BrowseServer(\'image'.$genSufix.'\');">Durchsuchen</button></span></div>';
		$return .= '<div class="hidden" paraarbeit="update" parasuche="var" paranick="image" paraid="'.$this->id.'" parafremdid="'.$this->fremdid.'" paratype="'.$this->type.'" parafremdsorte="'.$this->sorte.'" paraparent="'.$this->id.'"></div>';
		}else{
		$return .= '<div class="input-group input-group-lg"><span class="input-group-addon" id="sizing-addon1"><a href="#" title="Bildvorschau" id="vorschauimage'.$genSufix.'" data-toggle="popover" title="Bildvorschau" data-html="true" data-content="<img src=\'/adm/dist/img/bildvorschaudefault.jpg\' class=\'img-responsive center-block\' alt=\'Bitte einen gültigen Bild laden!\'/>"><i class="fa fa-picture-o"></i></a></span><input type="text" class="form-control" placeholder="Ein Wert für '.$this->name.'" aria-describedby="sizing-addon1" id="image'.$genSufix.'"><span class="input-group-btn" id="sizing-addon1"><button type="button" class="btn btn-default" aria-describedby="sizing-addon1" onclick="BrowseServer(\'image'.$genSufix.'\');">Durchsuchen</button></span></div>';
		$return .= '<div class="hidden" paraarbeit="new" parasuche="var" paranick="image" paraid="'.$this->id.'" parafremdid="'.$this->fremdid.'" paratype="'.$this->type.'" parafremdsorte="'.$this->sorte.'" paraparent="'.$this->id.'"></div>';
		}
	}elseif($typFirst==3){
		if($this->hatEinWert($this->id, $this->fremdid, $this->id)){
		$return .= '<div class="form-group"><label for="textarea'.$this->id.'_'.$this->fremdid.'_'.$this->fremdid.'">Inhalt für '.$this->name.':</label><textarea class="form-control" rows="5" id="textarea'.$genSufix.'" style="resize:none">'.$this->hatEinWert($this->id, $this->fremdid, $this->id).'</textarea></div>';
		$return .= '<div class="hidden" paraarbeit="update" parasuche="var" paranick="textarea" paraid="'.$this->id.'" parafremdid="'.$this->fremdid.'" paratype="'.$this->type.'" parafremdsorte="'.$this->sorte.'" paraparent="'.$this->id.'"></div>';
		}else{
		$return .= '<div class="form-group"><label for="textarea'.$this->id.'_'.$this->fremdid.'_'.$this->fremdid.'">Inhalt für '.$this->name.':</label><textarea class="form-control" rows="5" id="textarea'.$genSufix.'" style="resize:none"></textarea></div>';
		$return .= '<div class="hidden" paraarbeit="new" parasuche="var" paranick="textarea" paraid="'.$this->id.'" parafremdid="'.$this->fremdid.'" paratype="'.$this->type.'" parafremdsorte="'.$this->sorte.'" paraparent="'.$this->id.'"></div>';
		}
	}elseif($typFirst==4){
		if($this->hatEinWert($this->id, $this->fremdid, $this->id)){
		$return .= '<div id="ckeditorFrame'.$genSufix.'" class="form-group"><label for="ckeditor'.$genSufix.'">Inhalt für '.$this->name.':</label><textarea class="ckeditorGenerator hidden" abdullahvalue="'.$genSufix.'" name="ckeditor'.$genSufix.'" id="ckeditor'.$genSufix.'" rows="10" cols="80">'.$this->hatEinWert($this->id, $this->fremdid, $this->id).'</textarea><textarea class="hidden" id="ckeditorInhalt'.$genSufix.'">'.$this->hatEinWert($this->id, $this->fremdid, $this->id).'</textarea>';
		$return .= '<div class="hidden" paraarbeit="update" parasuche="html" paranick="ckeditorInhalt" paraid="'.$this->id.'" parafremdid="'.$this->fremdid.'" paratype="'.$this->type.'" parafremdsorte="'.$this->sorte.'" paraparent="'.$this->id.'"></div></div>';
		}else{
		$return .= '<div id="ckeditorFrame'.$genSufix.'" class="form-group"><label for="ckeditor'.$genSufix.'">Inhalt für '.$this->name.':</label><textarea class="ckeditorGenerator hidden" abdullahvalue="'.$genSufix.'" name="ckeditor'.$genSufix.'" id="ckeditor'.$genSufix.'" rows="10" cols="80"></textarea><textarea class="hidden" id="ckeditorInhalt'.$genSufix.'"></textarea>';
		$return .= '<div class="hidden" paraarbeit="new" parasuche="html" paranick="ckeditorInhalt" paraid="'.$this->id.'" parafremdid="'.$this->fremdid.'" paratype="'.$this->type.'" parafremdsorte="'.$this->sorte.'" paraparent="'.$this->id.'"></div></div>';
		}

	}elseif($typFirst==5){
		$typSecond = substr($this->type, 2);
		$item = $this->Connection->query("SELECT * FROM parameterpanelitem WHERE panel_id = :getPanelID ORDER BY id ASC;", array("getPanelID"=>$this->id));
		$return .='<ul class="list-group">';
		if($item){
		foreach($item as $k => $a){
		$return .= $this->erstelleItemlist($a['id'], $this->id, $a['name']);
		}
		}else{
		$return .= '<li class="list-group-item list-group-item-danger">Panel hat keinen Item</li>';	
		}
		$return .= '</ul>';
		
		/*$qry = $this->Connection->query("SELECT * FROM parameter WHERE fremdid = :boxID AND sorte = '2';", array("boxID"=>$typSecond),PDO::FETCH_CLASS, 'ParameterTypeArray');
		if($qry){
		foreach($qry as $k => $a){
		$return .= $this->erstellFormMitParams($a->id, $a->name, $a->type, $a->fremdid ,$a->sorte, $a->typename, $this->id);	
		}
		}else{
		$return .= '<div class="box box-solid box-default"><div class="box-header with-border"><h3 class="box-title">404 Error</h3><small> Panel hat keinen Parameter</small></div></div>';		
		}*/
	}
	/*
	elseif($typFirst==6){
	
		$typSecond = substr($this->type, 2);
		$Connection = new Connection();
		$qry = $Connection->query("SELECT * FROM parameter WHERE fremdid = :boxID AND sorte = '1';", array("boxID"=>$typSecond),PDO::FETCH_CLASS, 'ParameterTypeArray');
		if($qry){
		foreach($qry as $k => $a){
		$return .= '<div class="box box-solid box-default"><div class="box-header with-border"><h3 class="box-title">'.$a->name.'</h3><small> Typ: '.$a->typename.'</small></div></div>';	
		}
		}else{
		$return .= '<div class="box box-solid box-default"><div class="box-header with-border"><h3 class="box-title">404 Error</h3><small> Box hat keinen Parameter</small></div></div>';		
		}
		
	}*/
	return $return;
	}
	
	private function erstelleItemlist($id, $paraId, $name){
		$r = '<li class="list-group-item list-group-item-info" id="item_controller_'.$id.'"><div class="row"><div class="col-md-6 col-sm-4"><div class="input-group"><span class="input-group-addon"><span class="glyphicon glyphicon-asterisk"></span></span><input type="text" class="form-control" id="item_name_'.$id.'" placeholder="Bitte einen Item Namen angeben" value="'.$name.'" aria-describedby="item_name"></div></div><div class="col-md-6 col-sm-8"><div class="btn-group btn-group-justified" role="group"><div class="btn-group" role="group" onclick="panelItemBearbeiten(\'Item bearbeiten: '.$name.'\',\''.$id.'\');"><button type="button" class="btn btn-default">Ansehen</button></div><div class="btn-group" role="group" onclick="panelItemSpeichern('.$paraId.',\''.$id.'\');"><button type="button" class="btn btn-success">Speichern</button></div><div class="btn-group" role="group" onclick="panelItemLoeschen('.$paraId.',\''.$id.'\');"><button type="button" class="btn btn-danger">Löschen</button></div></div></div></div></li>';
		return $r;
	}
}
?>      