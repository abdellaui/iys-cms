<?php
if ( 'admin_loginfenster.php' == basename($_SERVER['SCRIPT_FILENAME']) || isset($_SESSION['login']))
{
	die('/* (c) '.date("Y").' by Abdullah Sahin. All rights reserved. */');
	exit;
}
if(isset($_POST['psw']) && $_GET['login']){
	if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest'){
	die('(c) '.date("Y").' by Abdullah Sahin. All rights reserved.');
	exit;
	}else{
	$passwordHash = md5($_POST['psw']);
	$Connection = new Connection();
	$qry = $Connection->query("SELECT * FROM admin WHERE psw = :passwordHash AND id = :adminId LIMIT 1;", array('passwordHash'=> $passwordHash, 'adminId'=>'1'));
	if($qry){
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		$upd = $Connection->query("UPDATE admin SET ip = :userIP, last_login = NOW() WHERE id = :adminId;", array('userIP'=>$ip, 'adminId'=>$qry[0]['id']));
			$_SESSION['login'] = $qry[0]['id'];
			die('1');
			exit;
	}else{
	die('error');
	exit;
	}
	}
}
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
  <body class="hold-transition layout-boxed lockscreen">
    <div class="lockscreen-wrapper">
      <div class="lockscreen-logo">
        <a href="#"><b>IYS</b>-CMS</a>
      </div>
      <div class="lockscreen-name">Administrator</div>
      <div class="lockscreen-item">
        <div class="lockscreen-image">
          <img src="/adm/dist/img/avatar5.png" alt="User Image">
        </div>
        <form class="lockscreen-credentials" id="einloggenForm">
          <div class="input-group">
            <input type="password" class="form-control" placeholder="passwort" id="einloggenPasswort">
            <div class="input-group-btn">
              <button class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
            </div>
          </div>
        </form>
      </div>
      <div class="lockscreen-footer text-center">
        Copyright &copy; <?php echo date("Y");?> <b>IYS-CMS</b><br>
        All rights reserved
      </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
	<script>
	$(document).ready(function() {

    $('#einloggenForm').on("submit", function(e) {
			if($('div#fehlerMeldung')){
			$('div#fehlerMeldung').each(function() {$(this).remove();});
			}
		var post_psw = $('#einloggenPasswort').val();
		if(post_psw.length > 0){
		$.post("/adm/login", { psw : post_psw}).done(function(data) {
			console.log(data);
			if($.isNumeric(data)){
			alertToast('success', 'Einen Moment bitte !', 'Du hast dich erfolgreich angemeldet!');
			window.location.pathname = '/adm/startseite';
			}else{
			alertToast('error', 'Fehler !', 'Die von dir eingegebene Passwort stimmt nicht überein!');
			}
		});
		}else{
			alertToast('warning', 'Achtung !', 'Du musst einen Passwort eingeben !');
		}
	e.preventDefault(); return false;
    });
	function alertToast(typ, title, content){
toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-right",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "300",
  "hideDuration": "1000",
  "timeOut": "6000",
  "extendedTimeOut": "1000",
  "showEasing": "swing",
  "hideEasing": "linear",
  "showMethod": "fadeIn",
  "hideMethod": "fadeOut"
}
toastr[typ](content, title);
}
	});
	</script>
  </body>
</html>