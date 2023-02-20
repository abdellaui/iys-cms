<?php 
if ( 'editPage.php' == basename($_SERVER['SCRIPT_FILENAME']) )
{
	die('(c) '.date("Y").' by Abdullah Sahin. All rights reserved.');
	exit;
}

?>
<script type="text/javascript" src="/adm/plugins/ckfinder/ckfinder.js"></script>
<section class="content-header">
          <h1>Seiten bearbeiten</h1>
          <ol class="breadcrumb">
            <li><a href="/adm/startseite"><i class="fa fa-dashboard"></i> Adminpanel</a></li>
            <li class="active">Seiten bearbeiten</li>
          </ol>
</section>
<section class="content">
		  <div class="row">
		  <div class="col-md-12">
				<div class="box box-info">
				  <div class="box-header with-border">
					<h3 class="box-title">Seitenliste</h3>
				  </div>
				  <div class="box-body">
				  <?php
				  echo new SeitenListe();
				  ?>
				  </div>
				</div>
		  </div>
		<div class="col-md-12">
				<div class="box box-success">
				  <div class="box-header with-border">
					<h3 class="box-title">Seite erstellen</h3>
				  </div>
				  <div class="box-body">
					<div class="row" id="seiteErstellen">
						<div class="col-md-2">
								<div class="form-group">
								  <label for="seiten_urls">URL:</label>
								  <input type="text" class="form-control" id="seiten_urls" placeholder="Bitte einen URL eingeben">
								</div>		
								</div>
								<div class="col-md-2">
								<div class="form-group">
								  <label for="seiten_names">Name der Seite:</label>
								  <input type="text" class="form-control" id="seiten_names" placeholder="Bitte eine Name eingeben">
								</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
									<label for="seiten_headtag">Head-Tag Box:</label>
									<select class="form-control" name="seiten_headtag" id="seiten_headtag"><option value="0" selected>Bitte einen Head-Tag Box wählen</option><?php echo new BoxListe(0,1);?></select>
									</div>
								</div>
								<div class="col-md-3">
									<div class="form-group">
									<label for="seiten_bodytag">Body-Tag Box:</label>
									<select class="form-control" name="seiten_bodytag" id="seiten_bodytag"><option value="0" selected>Bitte einen Body-Tag Box wählen</option><?php echo new BoxListe(0,1);?></select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="tools">&nbsp;</label>
										<div class="btn-group btn-group-justified" role="group">
										<div class="btn-group" role="group"><button type="button" class="btn btn-success" id="pageHinzufuegen">Hinzufügen</button></div>
										<div class="btn-group" role="group"><button type="button" class="btn btn-danger" id="abbrechenEgalWas">Abbrechen</button></div>
										</div>
									</div>
						</div>
					</div>
				  </div>
				</div>
		  </div>
		  </div>
</section>
<div id="modalAlles" abdullah="15" class="modal fade" role="dialog" aria-labelledby="myModalLabel">
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