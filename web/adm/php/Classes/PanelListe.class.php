<?php
class PanelListe{
	public $vars, $id;
	public function __construct($typ){
		$this->vars = '';
		$this->typ = $typ;
		$Connection = new Connection();
		$q = $Connection->query("SELECT id, name FROM ".Connection::PREFIX."panels ORDER BY name ASC;");
		if($q){
		if($this->typ == 1){
			$this->panelListOption($q);
		}else{
			$this->panelListMenu($q);
		}
		}else{
			$this->vars ='';
		}
		return $this->vars;
	}
	public function __toString() {
        return $this->vars;
    }
	private function panelListOption($c){
		$this->vars .='<optgroup label="Panel als Typ">';
		foreach($c as $k => $a){
			$this->vars .='<option value="5_'.$a['id'].'">Panel: '.$a['name'].'</option>';
		}
		$this->vars .='</optgroup>';
		
	}
	private function panelListMenu($c){
		if(isset($_GET['page']) && $_GET['page']=='panelupdate' && isset($_GET['id'])){
			$activeLink = ' active';
		}else{
			$activeLink = '';
		}
		$this->vars .='<li class="treeview'.$activeLink.'" id="panelVerwaltungListeTree"><a href="#"><i class="fa fa-cogs"></i> <span>Panel verwalten</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu" id="panelVerwaltungListe"> ';
		foreach($c as $k => $a){
			if(isset($_GET['id']) && $_GET['id']==$a['id']){
				$activeSubLink = ' class="active"';
			}else{
				$activeSubLink = '';
			}
			$this->vars .='<li'.$activeSubLink.' id="panelVerwaltungListePunkt_'.$a['id'].'"><a href="/adm/panelupdate/'.$a['id'].'">'.$a['name'].'</a></li>';
		}
		$this->vars .='</ul></li>';	
	}
}
?>