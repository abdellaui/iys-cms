<?php
class ParameterListe{
	public $vars;
	public function __construct($typ){
		$this->vars = '';
		$Connection = new Connection();
		$q = $Connection->query("SELECT id, name FROM ".Connection::PREFIX."boxes WHERE id IN(SELECT fremdid FROM ".Connection::PREFIX."parameter WHERE sorte = '1' AND type NOT LIKE '6\_%') ORDER BY name ASC");
		if($q){
			if($typ==1){
			$this->parameterListMenu($q);
			}else{
			$this->parameterList($q);
			}
		}else{
			$this->vars ='';
		}
		return $this->vars;
	}
	public function __toString() {
        return $this->vars;
    }

	private function parameterListMenu($c){
		if(isset($_GET['page']) && $_GET['page']=='parameteredit' && isset($_GET['id'])){
			$activeLink = ' active';
		}else{
			$activeLink = '';
		}
		$this->vars .='<li class="header">PARAMETERS</li><li class="treeview'.$activeLink.'"><a href="#"><i class="fa fa-pencil-square-o"></i> <span>Parameter verwalten</span> <i class="fa fa-angle-left pull-right"></i></a><ul class="treeview-menu" id="parameterListeMenu"> ';
		foreach($c as $k => $a){
			if(isset($_GET['id']) && $_GET['id']==$a['id']){
				$activeSubLink = ' class="active"';
			}else{
				$activeSubLink = '';
			}
			$this->vars .='<li'.$activeSubLink.'><a href="/adm/parameteredit/'.$a['id'].'">'.$a['name'].'</a></li>';
		}
		$this->vars .='</ul></li>';	
	}
	private function parameterList($c){
		if(isset($_GET['page']) && $_GET['page']=='parameteredit' && isset($_GET['id'])){
			$activeLink = ' active';
		}else{
			$activeLink = '';
		}
		foreach($c as $k => $a){
			if(isset($_GET['id']) && $_GET['id']==$a['id']){
				$activeSubLink = ' class="active"';
			}else{
				$activeSubLink = '';
			}
			$this->vars .='<li'.$activeSubLink.'><a href="/adm/parameteredit/'.$a['id'].'">'.$a['name'].'</a></li>';
		}
	}
}
?>