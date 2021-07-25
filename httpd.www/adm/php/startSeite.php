<?php 
if ( 'editPage.php' == basename($_SERVER['SCRIPT_FILENAME']) )
{
	die('(c) '.date("Y").' by Abdullah Sahin. All rights reserved.');
	exit;
}

?>
<section class="content-header">
          <h1>Startseite</h1>
          <ol class="breadcrumb">
            <li><a href="/adm/startseite"><i class="fa fa-dashboard"></i> Adminpanel</a></li>
            <li class="active">Startseite</li>
          </ol>
</section>
<section class="content">
<div class="row">
        <div class="col-lg-6 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{google.analytics.api.online}}</h3>

              <p>Online Besucher</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
        <div class="col-lg-6 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{google.analytics.api.total}}</h3>

              <p>Besucher gesamt</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer"></a>
          </div>
        </div>
		 <div class="col-lg-12 col-xs-12">
		<div class="box box-info">
			  <div class="box-body">
					<h1>Willkommen!</h1>
					<p>Du befindest dich momentan auf der Startseite des IYS-CMS Adminpanels.</p>
					<p>Links im Menü kannst du deine Seite bearbeiten, berückstichtige dabei auf geltende Regeln!.</p>
					<p>Regeln: kommt noch..</p>
			  </div>
			</div>
		</div>
      </div>
      </div>
</section>