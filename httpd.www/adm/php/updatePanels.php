<?php 
if ( 'updatePanels.php' == basename($_SERVER['SCRIPT_FILENAME']) )
{
	die('(c) '.date("Y").' by Abdullah Sahin. All rights reserved.');
	exit;
}
if(isset($_GET['id'])){
	$gettetZahl = $_GET['id'];
}else{
	$gettetZahl = 0;
}
 $getZahl = (int) $gettetZahl; 
 $panel = new PanelManager();
 $checking = $panel->findeVeriableVomDB($getZahl);
 if($checking){
 $panelDetails = $panel->gebePanel();
?>
	<script type="text/javascript" src="/adm/plugins/codemirror/lib/codemirror.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/mode/xml/xml.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/mode/javascript/javascript.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/mode/css/css.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/mode/php/php.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/mode/clike/clike.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
	<link rel="stylesheet" href="/adm/plugins/codemirror/lib/codemirror.css">
<section class="content-header">
          <h1 id="namePanelHeader1">Panel bearbeiten: <?php echo $panelDetails['panelname'];?></h1>
		  <small class="hidden">ID: <input type="hidden" id="panelID" value="<?php echo $panelDetails['panelid'];?>"> <input type="hidden" id="panelTYPE" value="update"></small>
          <ol class="breadcrumb">
            <li><a href="/adm/startseite"><i class="fa fa-dashboard"></i> Adminpanel</a></li>
            <li class="active" id="namePanelHeader2">Panel bearbeiten: <?php echo $panelDetails['panelname'];?></li>
          </ol>
</section>
<section class="content">
		  <div class="row">
		  <div class="col-md-8">
			<div class="box box-warning">
			  <div class="box-header with-border">
				<h3 class="box-title">HTML-Editor</h3>
			  </div>
			  <div class="box-body">
					<textarea name="panelSource" id="panelSource" rows="25" cols="130"><?php echo $panelDetails['source'];?></textarea>
					<textarea class="hidden" id="panelSourceInhalt"><?php echo $panelDetails['source'];?></textarea>
			  </div>
			</div>
		  </div>
		  <div class="col-md-4">
		  <div class="box box-danger">
		  <div class="box-header with-border">
			<h3 class="box-title">Einstellungen</h3>
		  </div>
		  <div class="box-body">
			<div class="input-group input-group-lg" id="panelNameWrapAlert">
			  <span class="input-group-addon" id="sizing-addon1">Name</span>
			  <input type="text" class="form-control" placeholder="Name des Panels" aria-describedby="sizing-addon1" id="panelName" value="<?php echo $panelDetails['panelname'];?>">
			</div>
			<p>
			<div class="row">
				<div class="col-md-12 col-sm-12" id="panelButtonBereich">
				<div class="btn btn-success col-md-12 col-sm-12 col-xs-12" id="panelHinzufuegen">Panel speichern</div>
				<br><br><div class="btn btn-danger col-md-12 col-sm-12 col-xs-12" onclick="loeschePanel(<?php echo $panelDetails['panelid'];?>);">Panel löschen</div>
				</div>
			</div>
			</p>
		  </div>
		  </div>
		  <div class="box box-success">
		  <div class="box-header with-border">
			<h3 class="box-title">Parameter</h3>
		  </div>
		  <div class="box-body" id="parameterInhalt">
		<?php 
		if(count($panelDetails['parameters'])>0){
				foreach($panelDetails['parameters'] as $k => $a){
		?><div class="btn-group btn-group-justified" role="group" id="paraBox_<?php echo $a->id;?>"><div class="btn-group" role="group"><button type="button" class="btn btn-default" abdullahValue="old" id="paraName_<?php echo $a->id;?>"><?php echo $a->name;?></button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default" id="paraTyp_<?php echo $a->id;?>" abdullahValue="<?php echo $a->type;?>"><?php echo $a->typename;?></button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aktion<span class="caret"></span></button><ul class="dropdown-menu"><li onclick="bearbeitePara(<?php echo $a->id;?>);"><a>Bearbeiten</a></li><li onclick="loeschePara(<?php echo $a->id;?>);"><a>Löschen</a></li></ul></div></div>
		<?php 
					}
		} else{ echo '<div class="alert alert-danger" role="alert">Kein Parameter vorhanden!</div>'; } 
		
		?>
		  </div>
		  </div>
		  <div class="box box-info">
		  <div class="box-header with-border">
			<h3 class="box-title">Parameter hinzufügen</h3>
		  </div>
		  <div class="box-body">
		  <div id="paramBearbeitenBox">
			<div class="input-group input-group-lg" id="paraNameGroup">
			  <span class="input-group-addon" id="sizing-addon1">Name</span>
			  <input type="text" id="parameterName" class="form-control" placeholder="Name des Parameters" aria-describedby="sizing-addon1">
			</div>
			<br>
			<div class="input-group input-group-lg" id="paraTypGroup">
			<span class="input-group-addon" id="sizing-addon1">Typ</span>
			<select class="form-control" id="parameterTyp">
			  <option value="0" selected>-- Bitte einen Typ wählen --</option>
			  <optgroup label="Standarttypen">
			  <option value="1">Input</option>
			  <option value="2">Bild</option>
			  <option value="3">Textarea</option>
			  <option value="4">CKEditor</option>
			  </optgroup>
			</select>
			</div>
		  </div>
			<p>
			<br>
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-6">
				<div class="btn btn-success col-md-12" id="parameterHinzufuegen">Hinzufügen</div>
				</div>
				<div class="col-md-6 col-sm-6 col-xs-6">
				<div class="btn btn-danger col-md-12" id="parameterAbbrechen">Abbrechen</div>
				</div>
			</div>
			</p>
		  </div>
		  </div>
		  </div>
		  </div>
</section>
<?php	 
 }else{
?>

<section class="content-header">
          <h1>Panel konnte nicht gefunden werden</h1>
          <ol class="breadcrumb">
            <li><a href="/adm/startseite"><i class="fa fa-dashboard"></i> Adminpanel</a></li>
			<li class="active">404 Error</li>
          </ol>
</section>
<section class="content">
		  <div class="row">
		  <div class="col-md-12">
			<div class="box box-danger">
			  <div class="box-header with-border">
				<h3 class="box-title">Fehler</h3>
			  </div>
			  <div class="box-body">
			  Die von dir gesuchte Panel konnte leider nicht gefunden werden!
			  </div>
			</div>
		  </div>
		  </div>
</section>
	 
<?php	 
 }
 
?>