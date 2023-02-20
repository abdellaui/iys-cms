<?php 
if ( 'editMVCVariabel.php' == basename($_SERVER['SCRIPT_FILENAME']) )
{
	die('(c) '.date("Y").' by Abdullah Sahin. All rights reserved.');
	exit;
}

?>
<section class="content-header">
          <h1>MVC Parameter bearbeiten</h1>
          <ol class="breadcrumb">
            <li><a href="/adm/startseite"><i class="fa fa-dashboard"></i> Adminpanel</a></li>
            <li class="active">MVC Parameter bearbeiten</li>
          </ol>
</section>
<section class="content">
		  <div class="row">
		  <div class="col-md-12">
		  <div class="callout callout-info">
			<h4>Information!</h4>

			<p>MVC Parameter sind Parameter, welche je nach Seite einen Inhalten annehmen können. Die MVC Parameter können vom Typ von Input, Bild, Textarea und CKEditor sein.</p>
			<p>MVC Parameter werden folgend initiallisiert: <b>{{$_GET::<u>name</u>}}</b></p>
		  </div>
		</div>
		  <div class="col-lg-8 col-md-12">
		 <div class="box box-success">
		  <div class="box-header with-border">
			<h3 class="box-title">MVC Parameter</h3>
		  </div>
		  <div class="box-body" id="parameterInhalt">
			<?php 
			$mvc = new MVCManager();
			$mvcDetails = $mvc->gibDaten();
			if(count($mvcDetails['parameters'])>0){
					foreach($mvcDetails['parameters'] as $k => $a){
			?><div class="btn-group btn-group-justified" role="group" id="paraBox_<?php echo $a->id;?>"><div class="btn-group" role="group"><button type="button" class="btn btn-default" abdullahValue="old" id="paraName_<?php echo $a->id;?>"><?php echo $a->name;?></button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default" id="paraTyp_<?php echo $a->id;?>" abdullahValue="<?php echo $a->type;?>"><?php echo $a->typename;?></button></div><div class="btn-group" role="group"><button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Aktion<span class="caret"></span></button><ul class="dropdown-menu"><li onclick="bearbeitePara(<?php echo $a->id;?>);"><a>Bearbeiten</a></li><li onclick="loeschePara(<?php echo $a->id;?>);"><a>Löschen</a></li></ul></div></div>
			<?php 
						}
			} else{ echo '<div class="alert alert-danger" role="alert">Kein Parameter vorhanden!</div>'; } 
			
			?>
		  </div>
		  </div>
		  </div>
		  <div class="col-lg-4 col-md-12">
		  <div class="box box-info">
		  <div class="box-header with-border">
			<h3 class="box-title">MVC Parameter hinzufügen</h3>
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
			  <optgroup label="Box als Typ">
			  <option value="6">Box Platzhalter</option>
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
			<p>
			<div class="row">
				<div class="col-md-12 col-sm-12" id="boxButtonBereich">
				<div class="btn btn-success col-md-12 col-sm-12 col-xs-12" id="mvcSpeichern">MVC Parameter speichern</div>
				</div>
			</div>
			</p>
		  </div>
		  </div>

		  </div>
		  </div>
</section>