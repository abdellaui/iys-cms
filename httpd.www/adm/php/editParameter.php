<?php 
if ( 'editParameter.php' == basename($_SERVER['SCRIPT_FILENAME']) )
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
	$parameter = new ParameterManager();
	$checking = $parameter->findeVeriableVomDB($getZahl);
	if($checking){
	$parameterDetails = $parameter->gebeParameter();
?>
<script type="text/javascript" src="/adm/plugins/ckfinder/ckfinder.js"></script>
<section class="content-header">
          <h1>Parameter bearbeiten: (Box) <?php echo $parameterDetails['boxname'];?></h1>
          <ol class="breadcrumb">
            <li><a href="/adm/startseite"><i class="fa fa-dashboard"></i> Adminpanel</a></li>
            <li class="active">Parameter bearbeiten: (Box) <?php echo $parameterDetails['boxname'];?></li>
          </ol>
		  <input class="hide" id="parameterInhaltBoxId" value="<?php echo $parameterDetails['boxid'];?>" type="hidden">
</section>
<section class="content">
		  <div class="row">
	
		  <div class="col-md-8" id="alleParameterBearbeitungsModus">
		  		<?php 
				if(count($parameterDetails['parameters'])>0){
				foreach($parameterDetails['parameters'] as $k => $a){
					if(substr($a->type,0,1)!=6){
						if(substr($a->type,0,1)==5){
							$boxcollapse = ' box-primary';
							$boxcollapsemp = 'plus';
							}else{
							$boxcollapse = ' box-warning';
							$boxcollapsemp = 'plus';
							}
				?>
				<a name="<?php echo $a->name;?>"></a>
				<div class="box<?php echo $boxcollapse; ?>">
				  <div class="box-header with-border">
					<h3 class="box-title"><?php echo $a->name;?></h3>
					<div class="box-tools pull-right">
                    <span class="label label-default"><?php echo $a->typename;?></span>
					<?php if(substr($a->type,0,1)==5){ echo '<span class="label label-success btn" onclick="panelitemhinzufuegen('.$a->id.')">Item zufügen</span>';} ?>
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-<?php echo $boxcollapsemp; ?>"></i>
                    </button>
                  </div>
				  </div>
				  <div class="box-body" id="abdullahBoxBody_<?php echo $a->id;?>">
						<?php echo new GenerateForm($a->id, $a->name, $a->type, $a->fremdid ,$a->sorte);?>
				  </div>
				</div>
				<?php
					}
				}
				} else{ 
				?>
				<div class="box">
				  <div class="box-header with-border">
					<h3 class="box-title">404 Fehler</h3>
				  </div>
				  <div class="box-body">
						Kein Parameter vorhanden!
				  </div>
				</div>
				<?php
				} 
				?>
			
		  </div>
		  <div class="col-md-4">
		  <div class="box box-danger">
		  <div class="box-header with-border">
			<h3 class="box-title">Einstellungen</h3>
		  </div>
		  <div class="box-body">
			<div class="row">
				<div class="col-md-12 col-sm-12">
				<div class="btn btn-success col-md-12 col-sm-12 col-xs-12" id="parameterInhaltSpeichern">Speichern</div>
				<br><br><div class="btn btn-danger col-md-12 col-sm-12 col-xs-12" id="abbrechenEgalWas">Abbrechen</div>
				</div>
			</div>
		  </div>
		  </div>
		  <div class="box box-success">
		  <div class="box-header with-border">
			<h3 class="box-title">Übersicht der Parameter</h3>
		  </div>
		  <div class="box-body">
		  		<?php 
				if(count($parameterDetails['parameters'])>0){
				foreach($parameterDetails['parameters'] as $k => $a){
				?>
				<div class="btn-group btn-group-justified" role="group"><div class="btn-group" role="group"><a type="button" class="btn btn-default" href="#<?php echo $a->name;?>"><?php echo $a->name;?></a></div><div class="btn-group" role="group"><button type="button" class="btn btn-default" ><?php echo $a->typename;?></button></div></div>
				<?php
				}
				} else{ echo '<div class="alert alert-danger" role="alert">Kein Parameter vorhanden!</div>'; } 
				?>
		  </div>
		  </div>
		  </div>
		  </div>
</section>
<div id="modalAlles" class="modal fade" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
		<button type="button" class="close" id="btnModalAbbrechen" aria-label="Schließen"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ladet...</h4>
      </div>
      <div class="modal-body">
        <p>Ladet...</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id="btnModalSpeichern">Speichern</button>
		<button type="button" class="btn btn-danger" id="btnModalAbbrechen">Abbrechen</button>
      </div>
    </div>
  </div>
</div>
<?php	 
 }else{
?>

<section class="content-header">
          <h1>Parameter konnte nicht gefunden werden</h1>
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
			  Die von dir gesuchte Parameter konnte leider nicht gefunden werden!
			  </div>
			</div>
		  </div>
		  </div>
</section>
<?php	 
 }
 
?>