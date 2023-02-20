<?php
require("autoload.php");
if ((!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') || !isset($_SESSION['login'])) {
	die('(c) '.date("Y").' by Abdullah Sahin. All rights reserved.');
	exit;
}
$page = (int) $_GET['id'];
if($page==1 && isset($_POST['statusBox']) && isset($_POST['boxId'])  && isset($_POST['name']) && isset($_POST['source'])){

if(empty($_POST['parameters'])|| $_POST['parameters'] == 'noParameters'){$varPara ='null';}else{$varPara = $_POST['parameters'];}
$b = new BoxManager();
$b->setzeVariable($_POST['statusBox'], $_POST['boxId'], $_POST['name'], $_POST['source'], $varPara);
$b->createBox();
echo json_encode($b->gebeBox());
}elseif($page==2 && isset($_POST['boxId'])){
 $getZahl = (int) $_POST['boxId']; 
 $box = new BoxManager();
 $checking = $box->findeVeriableVomDB($getZahl);
 if($checking){
	 $box->deleteBox();
	 echo 'deleted';
 }
}elseif($page==3 && isset($_POST['statusPanel']) && isset($_POST['panelId'])  && isset($_POST['name']) && isset($_POST['source'])){

if(empty($_POST['parameters'])|| $_POST['parameters'] == 'noParameters'){$varPara ='null';}else{$varPara = $_POST['parameters'];}
$p = new PanelManager();
$p->setzeVariable($_POST['statusPanel'], $_POST['panelId'], $_POST['name'], $_POST['source'], $varPara);
$p->createPanel();
echo json_encode($p->gebePanel());
}elseif($page==4 && isset($_POST['panelId'])){
 $getZahl = (int) $_POST['panelId']; 
 $panel = new PanelManager();
 $checking = $panel->findeVeriableVomDB($getZahl);
 if($checking){
	 $panel->deletePanel();
	 echo 'deleted';
 }
}elseif($page==5 && (isset($_POST['boxId']) || isset($_POST['itemId']))&& isset($_POST['parameterInhalt']) && (is_array($_POST['parameterInhalt']) || is_object($_POST['parameterInhalt']))){
if(empty($_POST['parameterInhalt'])|| $_POST['parameterInhalt'] == 'noParameters'){$varPara ='null';}else{$varPara = $_POST['parameterInhalt'];}
$paraInhalt=new ParameterInhaltManager();
$paraInhalt->setzeVariable($varPara);
$paraInhalt->updateParameters();
if(isset($_POST['boxId'])){
	$postZahl = (int) $_POST['boxId']; 
	$parameter = new ParameterManager();
	$checking = $parameter->findeVeriableVomDB($postZahl);
	if($checking){
	$parameterDetails = $parameter->gebeParameter();
		if(count($parameterDetails['parameters'])>0){
		$parameterDetailsNew = $parameter->gebeParameter();		
		$r = '';		
		foreach($parameterDetailsNew['parameters'] as $k => $a){
		if(substr($a->type,0,1)!=6){
						if(substr($a->type,0,1)==5){
							$boxcollapse = ' box-primary';
							$boxcollapsemp = 'plus';
							}else{
							$boxcollapse = ' box-warning';
							$boxcollapsemp = 'plus';
							}
				$r .= '<a name="'.$a->name.'"></a>
				<div class="box'.$boxcollapse.'">
				  <div class="box-header with-border">
					<h3 class="box-title">'.$a->name.'</h3>
					<div class="box-tools pull-right">
                    <span class="label label-default">'.$a->typename.'</span>';
					
					if(substr($a->type,0,1)==5){ $r .= '<span class="label label-success btn" onclick="panelitemhinzufuegen('.$a->id.')">Item zufügen</span>';}
					
                    $r .= '<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-'.$boxcollapsemp.'"></i>
                    </button>
                  </div>
				  </div>
				  <div class="box-body" id="abdullahBoxBody_'.$a->id.'">'.new GenerateForm($a->id, $a->name, $a->type, $a->fremdid ,$a->sorte).'
				  </div>
				</div>';
		}
		}
		echo $r;
		
		}else{
		echo 0;	
		}
	}else{
	echo 0;	
	}
}elseif(isset($_POST['itemId'])){
	$c = new PanelItem();
	echo $c->gibForm($_POST['itemId']);
}
}elseif($page==6 && isset($_POST['pageconfigid']) && isset($_POST['pageconfiginhalt'])){
	$postedZahl = (int) $_POST['pageconfigid'];
	if($postedZahl > 0 && $postedZahl <9){
	$configFile = array(
					1 => array(
						 'name' => 'style.css',
						 'url' => 'css/'
						 ),
					2 => array(
						 'name' => 'javascript.js',
						 'url' => 'js/'
						 ),
					3 => array(
						 'name' => 'cache.manifest',
						 'url' => ''
						 ),
					4 => array(
						 'name' => 'sitemap.xml',
						 'url' => ''
						 ),
					5 => array(
						 'name' => 'urllist.txt',
						 'url' => ''
						 ),
					6 => array(
						 'name' => 'manifest.json',
						 'url' => ''
						 ),
					7 => array(
						 'name' => 'browserconfig.xml',
						 'url' => ''
						 ),
					8 => array(
						 'name' => 'map.js',
						 'url' => 'js/'
						 )
				  );
	$conf = $configFile[$postedZahl];
	$datenname = dirname(__FILE__).'/../../'.$conf['url'].$conf['name'];
	$current_inhalt = file_get_contents($datenname);
	if($current_inhalt != $_POST['pageconfiginhalt']){
	if(file_put_contents($datenname, $_POST['pageconfiginhalt'])){
		$logs = new Logs(str_replace('.', '-', $conf['name']));
		$logs->write($current_inhalt);
		echo $postedZahl;
	}
	} else{
		echo 'a';
	}
	}
}elseif($page==7 && isset($_POST['doing'])){
	session_destroy();
	echo 1;
}elseif($page==8 && isset($_POST['alte']) && isset($_POST['neue'])){
$user = new UserDetail($_SESSION['login']);
echo $user->passwordAendern($_POST['alte'],$_POST['neue']);
}elseif($page==9 && isset($_POST['neue'])){
$user = new UserDetail($_SESSION['login']);
echo $user->mailAendern($_POST['neue']);
}elseif($page==10 && isset($_POST['tool']) && ((isset($_POST['urls']) && isset($_POST['names']) && isset($_POST['hbox']) && isset($_POST['bbox']) && (isset($_POST['id'])&&$_POST['tool']=='upd'||$_POST['tool']=='ins') ) || (isset($_POST['id'])&&$_POST['tool']=='del'))){
$seite = new SeitenListe();
if($_POST['tool']=='ins'){
	$b = $seite->insertPage($_POST['urls'],$_POST['names'],substr($_POST['hbox'],2),substr($_POST['bbox'],2));
	echo $b;
}elseif($_POST['tool']=='upd'){
	$b = $seite->updatePage($_POST['id'],$_POST['urls'],$_POST['names'],substr($_POST['hbox'],2),substr($_POST['bbox'],2));
	echo $b;	
}elseif($_POST['tool']=='del'){
	$b = $seite->deletePage($_POST['id']);
	echo $b;		
}else{
	echo 0;
}
	
}elseif($page==11 && isset($_POST['tool']) && ((isset($_POST['panel_id'])&&isset($_POST['name'])&&$_POST['tool']=='ins') || (isset($_POST['id'])&&isset($_POST['name'])&&$_POST['tool']=='upd') || (isset($_POST['id'])&&$_POST['tool']=='del'))){
$seite = new PanelItem();
if($_POST['tool']=='ins'){
	$b = $seite->insertItem($_POST['panel_id'],$_POST['name']);
	echo $b;
}elseif($_POST['tool']=='upd'){
	$b = $seite->updateItem($_POST['id'],$_POST['name']);
	echo $b;	
}elseif($_POST['tool']=='del'){
	$b = $seite->deleteItem($_POST['id']);
	echo $b;		
}else{
	echo 0;
}
	
}elseif($page==12 && isset($_POST['id'])){
	$c = new PanelItem();
	echo $c->gibForm($_POST['id']);
}elseif($page==13 && isset($_POST['neue'])){
$user = new UserDetail($_SESSION['login']);
echo $user->modusAendern($_POST['neue']);
}elseif($page==14){

if(empty($_POST['parameters'])|| $_POST['parameters'] == 'noParameters'){$varPara ='null';}else{$varPara = $_POST['parameters'];}
$b = new MVCManager();
$b->updateParameters($varPara);
echo json_encode($b->gibDaten());
}elseif($page==15 && isset($_POST['itemId']) && isset($_POST['parameterInhalt']) && (is_array($_POST['parameterInhalt']) || is_object($_POST['parameterInhalt']))){
if(empty($_POST['parameterInhalt'])|| $_POST['parameterInhalt'] == 'noParameters'){$varPara ='null';}else{$varPara = $_POST['parameterInhalt'];}
	$paraInhalt=new MVCManager();
	$paraInhalt->updateParametersContent($varPara);
	echo $paraInhalt->gibForm($_POST['itemId']);
}elseif($page==16 && isset($_POST['id'])){
	$c = new MVCManager();
	echo $c->gibForm($_POST['id']);
}else{
echo 0;
}
?>