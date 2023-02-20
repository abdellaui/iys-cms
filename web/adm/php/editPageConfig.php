<?php 
if ( 'editPageConfig.php' == basename($_SERVER['SCRIPT_FILENAME']) )
{
	die('(c) '.date("Y").' by Abdullah Sahin. All rights reserved.');
	exit;
}
if(isset($_GET['id'])){
	$gettetZahl = (int) $_GET['id'];
}else{
	$gettetZahl = 0;
}
	if($gettetZahl > 0 && $gettetZahl <9){
	$configFile = array(
					1 => array(
						 'name' => 'style.css',
						 'type' => 'text/css',
						 'url' => 'css/'
						 ),
					2 => array(
						 'name' => 'javascript.js',
						 'type' => 'text/typescript',
						 'url' => 'js/'
						 ),
					3 => array(
						 'name' => 'cache.manifest',
						 'type' => 'htmlmixed',
						 'url' => ''
						 ),
					4 => array(
						 'name' => 'sitemap.xml',
						 'type' => 'application/xml',
						 'url' => ''
						 ),
					5 => array(
						 'name' => 'urllist.txt',
						 'type' => 'htmlmixed',
						 'url' => ''
						 ),
					6 => array(
						 'name' => 'manifest.json',
						 'type' => 'text/typescript',
						 'url' => ''
						 ),
					7 => array(
						 'name' => 'browserconfig.xml',
						 'type' => 'application/xml',
						 'url' => ''
						 ),
					8 => array(
						 'name' => 'map.js',
						 'type' => 'text/typescript',
						 'url' => 'js/'
						 )
				  );
	$conf = $configFile[$gettetZahl];
	$datenname = dirname(__FILE__).'/../../'.$conf['url'].$conf['name'];
	$inhalt = file_get_contents($datenname, FILE_USE_INCLUDE_PATH);
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
          <h1>Konfiguration bearbeiten: <?php echo $conf['name'];?></h1>
          <ol class="breadcrumb">
            <li><a href="/adm/startseite"><i class="fa fa-dashboard"></i> Adminpanel</a></li>
            <li class="active">Konfiguration bearbeiten: <?php echo $conf['name'];?></li>
          </ol>
</section>
<section class="content">
		  <div class="row">
		  		  <div class="col-md-12">
		  <div class="callout callout-info">
			<h4>Information!</h4>

			<p>Bitte nur mit aussreichenden Kenntnissen bearbeiten!</p>
		  </div>
		</div>
		  <div class="col-md-12">
			<div class="box box-warning">
			  <div class="box-header with-border">
				<h3 class="box-title">Inhalt: <?php echo $conf['name'];?></h3>
				<span class="pull-right"><div class="btn btn-success col-md-6 col-sm-6 col-xs-12" id="configPageSpeichern">Speichern</div> <div class="btn btn-danger col-md-6 col-sm-6 col-xs-12" id="abbrechenEgalWas">Abbrechen</div></span>
			  </div>
			  <div class="box-body">
					<textarea name="pageConfig" id="pageConfig" rows="25" cols="130"><?php echo $inhalt;?></textarea>
					<textarea class="hidden" id="pageConfigInhalt" abdullahValue="<?php echo $conf['type'];?>" abdullahValueIki="<?php echo $gettetZahl;?>"><?php echo $inhalt;?></textarea>
			  </div>
			</div>
		  </div>
		  </div>
</section>
<?php	 
 }else{
?>

<section class="content-header">
          <h1>Konfiguration konnte nicht gefunden werden</h1>
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
			  Die von dir gesuchte Konfiguration konnte leider nicht gefunden werden!
			  </div>
			</div>
		  </div>
		  </div>
</section>
<?php	 
 }
 
?>