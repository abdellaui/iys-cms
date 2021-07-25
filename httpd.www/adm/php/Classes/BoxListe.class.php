<?php
class BoxListe{
	public $vars, $id;
	public function __construct($id, $typ, $selectedId=0){
		$this->vars = '';
		$this->id = $id;
		$this->typ = $typ;
		$this->selectedId = $selectedId;
		$Connection = new Connection();
		if($this->id!=0){
		$q = $Connection->query("SELECT id, name FROM boxes WHERE id != :boxID ORDER BY name ASC;", array("boxID"=>$this->id));
		}else{
		$q = $Connection->query("SELECT id, name FROM boxes ORDER BY name ASC;");
		}
		if($q){
		if($this->typ == 1){
			$this->boxListOption($q);
		}else{
			$this->boxListMenu($q);
		}
		}else{
			$this->vars ='';
		}
		return $this->vars;
	}
	public function __toString() {
        return $this->vars;
    }
	private function boxListOption($c){
		$this->vars .='<optgroup label="Box als Typ">';
		foreach($c as $k => $a){
			if($this->selectedId==$a['id']){
			$this->vars .='<option value="6_'.$a['id'].'" selected>Box: '.$a['name'].'</option>';
			}else{
			$this->vars .='<option value="6_'.$a['id'].'">Box: '.$a['name'].'</option>';
			}
		}
		$this->vars .='</optgroup>';
		
	}
	private function boxListMenu($c){
		if(isset($_GET['page']) && $_GET['page']=='boxupdate' && isset($_GET['id'])){
			$activeLink = ' active';
		}else{
			$activeLink = '';
		}
		$this->vars .='<li class="treeview'.$activeLink.'" id="boxVerwaltungListeTree"><a href="#"><i class="fa fa-cubes"></i> <span>Box verwalten</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu" id="boxVerwaltungListe"> ';
		foreach($c as $k => $a){
			if(isset($_GET['id']) && $_GET['id']==$a['id']){
				$activeSubLink = ' class="active"';
			}else{
				$activeSubLink = '';
			}
			$this->vars .='<li'.$activeSubLink.' id="boxVerwaltungListePunkt_'.$a['id'].'"><a href="/adm/boxupdate/'.$a['id'].'">'.$a['name'].'</a></li>';
		}
		$this->vars .='</ul></li>';	
	}
}
?>