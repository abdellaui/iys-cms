<?php
if ( 'admin_eingeloggt.php' == basename($_SERVER['SCRIPT_FILENAME']) || !isset($_SESSION['login']))
{
	die('(c) '.date("Y").' by Abdullah Sahin. All rights reserved.');
	exit;
}
  $user = new UserDetail($_SESSION['login']);
  $userdata = $user->getDetails();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>IYS-CMS Adminpanel</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="/adm/dist/css/admin.min.css">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-black sidebar-mini">
    <div class="wrapper">
      <header class="main-header">
        <a href="/" class="logo">
          <span class="logo-mini"><b>I</b>CMS</span>
          <span class="logo-lg"><b>IYS</b>-CMS</span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">NAVIGATION</span>
          </a>
		  	<div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li>
            <a href="#" id="logoutpanel"><i class="fa fa-power-off"></i> Abmelden</a>
          </li>
		            <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
    </div>
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $userdata['bild'];?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $userdata['name'];?></p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <ul class="sidebar-menu">
		  	<li class="header">SEITEN</li>
			<?php if(isset($_GET['page']) && $_GET['page']=='pagemanager'){
					$activeLinkStartseite = ' class="active"';
					}else{
					$activeLinkStartseite = '';
					}?>
			<li<?php echo $activeLinkStartseite; ?>><a href="/adm/pagemanager"><i class="fa fa-map"></i> <span>Seiten bearbeiten</span></a></li>
			<?php 
			if($userdata['admin_mode']){
				
					if(isset($_GET['page']) && $_GET['page']=='pageconfigmanager' && isset($_GET['id'])){
						$activeLinkConfig = ' active';
					}else{
						$activeLinkConfig = '';
					}
					if(isset($_GET['page']) && $_GET['page']=='pagegetpara'){
						$activeLinkGets = ' class="active"';
					}else{
						$activeLinkGets = '';
					}
		?>
			<li<?php echo $activeLinkGets; ?>><a href="/adm/pagegetpara"><i class="fa fa-code-fork"></i> <span>MVC Parameter</span></a></li>
			<li class="treeview<?php echo $activeLinkConfig; ?>">
              <a href="#"><i class="fa fa-gear"></i> <span>Konfiguration</span> <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="/adm/pageconfigmanager/1">style.css</a></li>
                <li><a href="/adm/pageconfigmanager/2">javascript.js</a></li>
				<li><a href="/adm/pageconfigmanager/3">cache.manifest</a></li>
				<li><a href="/adm/pageconfigmanager/4">sitemap.xml</a></li>
				<li><a href="/adm/pageconfigmanager/5">urllist.txt</a></li>
				<li><a href="/adm/pageconfigmanager/6">manifest.json</a></li>
				<li><a href="/adm/pageconfigmanager/7">browserconfig.xml</a></li>
				<li><a href="/adm/pageconfigmanager/8">map.js</a></li>
              </ul>
            </li>
            <li class="header">BOXEN</li>
			<?php if(isset($_GET['page']) && $_GET['page']=='boxcreate'){
					$activeLink = ' class="active"';
					}else{
					$activeLink = '';
					}?>
            <li<?php echo $activeLink; ?> id="boxErstellenListeTree"><a href="/adm/boxcreate"><i class="fa fa-cube"></i> <span>Box erstellen</span></a></li>
				<?php
				$c = new BoxListe(0,2);
				echo $c;
				?>
			<li class="header">PANELS</li>
			<?php if(isset($_GET['page']) && $_GET['page']=='panelcreate'){
					$activeLink = ' class="active"';
					}else{
					$activeLink = '';
					}?>
            <li<?php echo $activeLink; ?> id="panelErstellenListeTree"><a href="/adm/panelcreate"><i class="fa fa-tasks"></i> <span>Panel erstellen</span></a></li>
				<?php
				$c = new PanelListe(2);
				echo $c;
				
				} // Ende Expertenmodus
				
				$d = new ParameterListe(1);
				echo $d;
				?>
          </ul>
        </section>

      </aside>

      <div class="content-wrapper">
	  
       <?php 
	   if(isset($_GET['page']) && $_GET['page']!='startseite'){
		if($_GET['page']=='pagemanager'){
			 require("editPage.php");
		}if($_GET['page']=='pagegetpara'){
			 require("editMVCVariabel.php");
		}elseif($_GET['page']=='pageconfigmanager' && isset($_GET['id'])){
			require("editPageConfig.php");
		}elseif($_GET['page']=='boxcreate'){
			require("createBoxes.php");
	   }elseif($_GET['page']=='boxupdate' && isset($_GET['id'])){
			require("updateBoxes.php");  
	   }elseif($_GET['page']=='panelcreate'){
			require("createPanels.php");   
	   }elseif($_GET['page']=='panelupdate' && isset($_GET['id'])){
			require("updatePanels.php");  
	   }elseif($_GET['page']=='parameteredit' && isset($_GET['id'])){
		   require("editParameter.php");
	   }
	   }else{
		   
		   require("startSeite.php");
	   }
	   ?>
	   

      </div>
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          IYS-CMS by Abdullah Sahin
        </div>

        <strong>Copyright &copy; 2016 <a href="/#">Abdullah Sahin</a>.</strong> All rights reserved.
      </footer>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li class="active"><a href="#control-sidebar-settings-tab" data-toggle="tab">PROFIL EINSTELLUNGEN</a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="control-sidebar-settings-tab">
         <img src="<?php echo $userdata['bild'];?>" class="img-circle center-block" width="65" alt="User Image">
	     <h3 class="control-sidebar-heading">Persönliche Daten</h3>
		 	<label class="control-sidebar-subheading">
              Benutzername:
			  <p><b><?php echo $userdata['name'];?></b></p>
            </label>
            <label class="control-sidebar-subheading">
              zuletzt angemeldet:
			  <p><b><?php echo $userdata['last_login'];?></b></p>
            </label>
			<label class="control-sidebar-subheading">
              E-Mail:
			  <p><b id="e-mail-geaendert"><?php echo $userdata['mail'];?></b></p>
            </label>
        <h3 class="control-sidebar-heading">Passwort ändern</h3>
            <label class="control-sidebar-subheading">
              Altes Passwort:
			  <input class="form-control" placeholder="Altes Passwort" aria-describedby="sizing-addon1" id="einstellung_password_1" type="password">
            </label>
			<label class="control-sidebar-subheading">
			  Neues Passwort:
             <input class="form-control" placeholder="Neues Passwort" aria-describedby="sizing-addon1" id="einstellung_password_2" type="password">
            </label>
			<label class="control-sidebar-subheading">
			 Neues Passwort (wdh.):
             <input class="form-control" placeholder="Neues Passwort (wdh.)" aria-describedby="sizing-addon1" id="einstellung_password_3" type="password">
            </label>
			<div class="btn btn-success col-md-12 col-sm-12 col-xs-12" id="einstellung_passwort_aendern">Passwort ändern</div>
			<br>
		<h3 class="control-sidebar-heading">E-Mail ändern</h3>
			<label class="control-sidebar-subheading">
              Neues E-Mail:
			  <input class="form-control" placeholder="E-Mail" aria-describedby="sizing-addon1" id="einstellung_email" type="text">
            </label>
			<div class="btn btn-success col-md-12 col-sm-12 col-xs-12" id="einstellung_email_aendern">E-Mail ändern</div>
			<br>
		<h3 class="control-sidebar-heading">Modus ändern</h3>
			<label class="control-sidebar-subheading">
			  <input id="einstellung_modus" type="checkbox" <?php echo ($userdata['admin_mode'])?'checked=checked':'';?>>
              Expertenmodus
            </label>
			<!--<div class="btn btn-success col-md-12 col-sm-12 col-xs-12" id="einstellung_modus_aendern">E-Mail ändern</div>-->
      </div>
    </div>
  </aside>
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script src="/adm/plugins/ckeditor/ckeditor.js"></script>
    <script src="/adm/dist/js/app.min.js"></script>
	<script src="/adm/dist/js/adminPanel.js"></script>
  </body>
</html>
