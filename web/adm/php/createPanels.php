<?php
if ( 'createPanels.php' == basename($_SERVER['SCRIPT_FILENAME']) )
{
	die('(c) '.date("Y").' by Abdullah Sahin. All rights reserved.');
	exit;
}
?>
	<script type="text/javascript" src="/adm/plugins/codemirror/lib/codemirror.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/mode/xml/xml.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/mode/javascript/javascript.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/mode/css/css.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/mode/php/php.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/mode/clike/clike.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/addon/mode/overlay.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/addon/dialog/dialog.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/addon/search/searchcursor.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/addon/search/search.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/addon/scroll/annotatescrollbar.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/addon/search/matchesonscrollbar.js"></script>
	<script type="text/javascript" src="/adm/plugins/codemirror/addon/search/jump-to-line.js"></script>
	<link rel="stylesheet" href="/adm/plugins/codemirror/lib/codemirror.css">
	<link rel="stylesheet" href="/adm/plugins/codemirror/addon/dialog/dialog.css">
	<link rel="stylesheet" href="/adm/plugins/codemirror/addon/search/matchesonscrollbar.css">
<section class="content-header">
          <h1 id="namePanelHeader1">Panel erstellen</h1>
		  <small class="hidden">ID: <input type="hidden" id="panelID" value="<?php echo time();?>"> <input type="hidden" id="panelTYPE" value="new"></small>
          <ol class="breadcrumb">
            <li><a href="/adm/startseite"><i class="fa fa-dashboard"></i> Adminpanel</a></li>
            <li class="active" id="namePanelHeader2">Panel erstellen</li>
          </ol>
</section>
<section class="content">
		  <div class="row">
		  <div class="col-md-12">
		  <div class="callout callout-info">
			<h4>Information!</h4>

			<p>Panels beinhalten Items, welche in der Parameterverwaltungs-Ansicht unbegrenzt eingefügt werden können. Die Items können Parameter im Typ von Input, Bild, Textarea und CKEditor besitzen.</p>
			<p>Parameter werden folgend initiallisiert: <b>{{<u>name</u>}}</b></p>
		  </div>
		</div>
		  <div class="col-lg-8 col-md-12">
			<div class="box box-warning">
			  <div class="box-header with-border">
				<h3 class="box-title">HTML-Editor</h3>
			  </div>
			  <div class="box-body">
					<textarea name="panelSource" id="panelSource" rows="25" cols="10"></textarea>
					<textarea class="hidden" id="panelSourceInhalt"></textarea>
			  </div>
			</div>
		  </div>
		  <div class="col-lg-4 col-md-12">
		  <?php
		  $mvc = new MVCManager();
		  echo $mvc->getList();
		  ?>
		  <div class="box box-success">
		  <div class="box-header with-border">
			<h3 class="box-title">Parameter</h3>
		  </div>
		  <div class="box-body" id="parameterInhalt">
		  <div class="alert alert-danger" role="alert">Kein Parameter vorhanden!</div>
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
		  <div class="box box-danger">
		  <div class="box-header with-border">
			<h3 class="box-title">Einstellungen</h3>
		  </div>
		  <div class="box-body">
			<div class="input-group input-group-lg" id="panelNameWrapAlert">
			  <span class="input-group-addon" id="sizing-addon1">Name</span>
			  <input type="text" class="form-control" placeholder="Name des Panels" aria-describedby="sizing-addon1" id="panelName">
			</div>
			<p>
			<div class="row">
				<div class="col-md-12 col-sm-12" id="panelButtonBereich">
				<div class="btn btn-success col-md-12 col-sm-12 col-xs-12" id="panelHinzufuegen">Panel hinzufügen</div>
				</div>
			</div>
			</p>
		  </div>
		  </div>
		  </div>
		  </div>
</section>