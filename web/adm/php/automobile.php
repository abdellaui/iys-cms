<?php
session_start();
error_log(0);
date_default_timezone_set('Europe/Berlin'); 

require(__DIR__ . "./../../secrets.php");

ini_set("SMTP", SMTP_HOST);
ini_set("smtp_port", SMTP_PORT);
ini_set("sendmail_from", SMTP_USER);
ini_set("auth_username", SMTP_USER);
ini_set("auth_password", SMTP_PASSWORD);

if ((!isset($_SERVER['HTTP_X_REQUESTED_WITH']) && empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest')) {
	die('(c) '.date("Y").' by Abdullah Sahin. All rights reserved.');
	exit;
}
/*
#
#    FUNCTIONS
#
#
#
*/
function mail_att($to,$subject,$message,$attachments,$typ)
   {
   $absender = $_SERVER['SERVER_NAME'];
   $absender_mail = SMTP_USER;
   $mailAdresse = SMTP_USER;
   $mime_boundary = "-----=" . md5(uniqid(mt_rand(), 1));
   $header = "From:".$absender."<".$absender_mail.">\n";
   $header .= "To:".$to."\n";
   $header .= "Reply-To:".$to."\n";
   $header .= "Bcc:".$mailAdresse."\n";
   $header .= "Subject: ".$subject."\n";
   $header .= "Date: ".date("r")."\n";
   $header .= "Message-ID:<".time()." info@".$_SERVER['SERVER_NAME'].">\n";
   $header .= "X-Mailer: PHP v".phpversion()."\n";
   $header .= "MIME-Version: 1.0\n";
   $header .= "Content-Type: multipart/mixed;\n";
   $header .= " boundary=\"".$mime_boundary."\"\n";
   $content = "";
   $content.= "--".$mime_boundary."\n";
   $content.= "Content-Type: text/html; charset=\"UTF-8\"\n";
   $content.= "Content-Transfer-Encoding: 8bit\n\n";
   $content.= $message."\n";
 
   if(is_array($attachments) && is_array(current($attachments))){
      foreach($attachments AS $dat)
         {
         $data = chunk_split(str_replace('data:' . $dat['type'] . ';base64,','',$dat['base64']));
         $content.= "--".$mime_boundary."\n";
         $content.= "Content-Disposition: attachment;\n";
         $content.= "\tfilename=\"".$dat['name']."\";\n";
         $content.= "Content-Length: .".$dat['size'].";\n";
         $content.= "Content-Type: ".$dat['type']."; name=\"".$dat['name']."\"\n";
         $content.= "Content-Transfer-Encoding: base64\n\n";
         $content.= $data."\n";
         }
      }
	  $content .= "--".$mime_boundary."--"; 
	  if($typ==1){
  if(isset($_SESSION['zuletz_angebot'])){
	  $lasttime = $_SESSION['zuletz_angebot'];
  }else{
	  $lasttime = 0;
  }
  $sendezeit = (time() - $lasttime);
  if($sendezeit >= 60){
  if(@mail($to, $subject, $content, $header)){
	$_SESSION['zuletz_angebot'] = time();
    return '<div class="alert alert-success">Ihre Anfrage wurde entgegengenommen! Sie erhalten in Kürze die Bestätigungsmail!</div>';
   }else{
	return '<div class="alert alert-danger">Es ist leider ein unerwartetes Fehler aufgetretten! Bitte prüfen Sie, ob Sie die Bestätigungsmail erhalten haben. Falls Sie Keines <b>innerhalb der nächsten 5 Minuten</b> erhalten, versuchen Sie erneuert eine Anfrage zu stellen!</div>';
   }
  }else{
	return '<div class="alert alert-warning">Sie haben vor etwa <b>'.$sendezeit.' Sekunden</b> eine Anfrage gestellt. Aus Sicherheitsgründen können Sie <b>pro Minuten</b> eine Anfrage stellen! </div>';  
  }
   }elseif($typ==2){
		   if(isset($_SESSION['zuletz_mail'])){
	  $lasttime = $_SESSION['zuletz_mail'];
  }else{
	  $lasttime = 0;
  }
  $sendezeit = (time() - $lasttime);
  if($sendezeit >= 60){
  if(@mail($absender_mail, $subject, $content, $header)){
	$_SESSION['zuletz_mail'] = time();
    return '<div class="alert alert-success">Ihre Kontaktanfrage wurde entgegengenommen! Sie erhalten in Kürze die Bestätigungsmail!</div>';
   }else{
	return '<div class="alert alert-danger">Es ist leider ein unerwartetes Fehler aufgetretten! Bitte prüfen Sie, ob Sie die Bestätigungsmail erhalten haben. Falls Sie Keines <b>innerhalb der nächsten 5 Minuten</b> erhalten, versuchen Sie erneuert Kontakt aufzunehmen!</div>';
   }
  }else{
	return '<div class="alert alert-warning">Sie haben vor etwa <b>'.$sendezeit.' Sekunden</b> eine Kontaktanfrage gestellt. Aus Sicherheitsgründen können Sie <b>pro Minuten</b> eine Kontaktanfrage stellen! </div>';  
  }  
   }elseif($typ==3){
		   if(isset($_SESSION['zuletz_bewerbung'])){
	  $lasttime = $_SESSION['zuletz_bewerbung'];
  }else{
	  $lasttime = 0;
  }
  $sendezeit = (time() - $lasttime);
  if($sendezeit >= 60){
  if(@mail($absender_mail, $subject, $content, $header)){
	$_SESSION['zuletz_bewerbung'] = time();
    return '<div class="alert alert-success">Ihre Bewerbung wurde entgegengenommen! Sie erhalten in Kürze die Bestätigungsmail!</div>';
   }else{
	return '<div class="alert alert-danger">Es ist leider ein unerwartetes Fehler aufgetretten! Bitte prüfen Sie, ob Sie die Bestätigungsmail erhalten haben. Falls Sie Keines <b>innerhalb der nächsten 5 Minuten</b> erhalten, bewerben Sie sich erneuert!</div>';
   }
  }else{
	return '<div class="alert alert-warning">Sie haben sich vor etwa <b>'.$sendezeit.' Sekunden</b>  beworben. Aus Sicherheitsgründen können Sie <b>pro Minuten</b> eine Bewerbung absenden! </div>';  
  }  
   }
  }
   
function templateMail($subject, $body){
	
	$message ='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>'.$subject.'</title>
  <style type="text/css">
  body {
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   padding-top: 0 !important;
   padding-bottom: 0 !important;
   margin:0 !important;
   width: 100% !important;
   -webkit-text-size-adjust: 100% !important;
   -ms-text-size-adjust: 100% !important;
   -webkit-font-smoothing: antialiased !important;
   font-family:Helvetica, sans-serif;
   background: #00A4F0!important;
 }
 .tableContent img {
   border: 0 !important;
   display: inline-block !important;
   outline: none !important;
 }

p, h1,h2,h3,ul,ol,li,div{
  margin:0;
  padding:0;
}

h1,h2{
  font-weight: normal;
  background:transparent !important;
  border:none !important;
}

td,table{
  vertical-align: top;
}
td.middle{
  vertical-align: middle;
}

a{
  text-decoration: none;
  display:inline-block;
}

a.link1{
text-decoration: none;
font-size: 16px;
font-weight: normal;
padding: 15px 25px;
background: #065a65;
color: #000000;
border-radius:6px;
-moz-border-radius:6px;
-webkit-border-radius:6px;
}

a.link2{
font-size: 15px;
font-weight: bold;
text-decoration: underline;
color:#000000;
}



h2{
font-size: 25px;
line-height: 120%;
color: #000000;
}

p{
font-size: 15px;
color: #000000;
line-height: 120%;
}

.bgItem{
background: #ffffff;
}

.rounded{
  border-radius:3px;
-moz-border-radius:3px;
-webkit-border-radius:3px;
}

</style>

<script type="colorScheme" class="swatch active">
{
    "name":"Default",
    "bgBody":"00A4F0",
    "link":"ffffff",
    "color":"ffffff",
    "bgItem":"ffffff",
    "title":"ffffff"
}
</script>

</head>
<body paddingwidth="0" paddingheight="0" class=\'bgBody\'  style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; font-family:Helvetica, sans-serif;background: #00A4F0!important;" offset="0" toppadding="0" leftpadding="0">
  <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent bgBody" align="center"  style=\'font-family:Arial, sans-serif;\'>
    
    
  <tr>
    <td align=\'center\'>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" >
        <tr>
          <td align=\'center\' class=\'movableContentContainer\'>
            <div class=\'movableContent\'>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr><td height=\'20\'></td></tr>
                <tr>
                  <td>
                    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td width=\'10\'></td>
                        <td>
                          <table width="307" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                              <td align="middle">
                                <div class="contentEditableContainer contentImageEditable">
                                  <div class="contentEditable">
                                  <br>
								  <br>
								  </div>
                                </div>
                              </td>
                            </tr>
                          </table>
                        </td>
                        <td width=\'10\'></td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </div>

            <div class=\'movableContent\'>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td>
                    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td width=\'20\'></td>
                        <td>
                          <table width="560" border="0" cellspacing="0" cellpadding="0" align="center" class=\'rounded bgItem\'>
                            <tr><td  height=\'15\'></td></tr>
                            <tr>
                              <td align="middle" >
                                <div class="contentEditableContainer contentTextEditable">
                                  <div class="contentEditable">
								    <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
                                     '.$body.'
									</table>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr><td  height=\'15\'></td></tr>
                          </table>
                        </td>
                        <td width=\'20\'></td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </div>
                   <br>
                   <br>
                   <br>
                   <br>
            <div class=\'movableContent\'>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td>
                    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td width=\'20\'></td>
                        <td>
                          <table width="560" border="0" cellspacing="0" cellpadding="0" align="center" class=\'rounded bgItem\'>
                            <tr><td  height=\'15\'></td></tr>
                            <tr>
                              <td align="middle" >
                                <div class="contentEditableContainer contentTextEditable">
                                  <div class="contentEditable">
								    <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center">
									<tr><td><center>';

									 
									$message .= '</center>
									</td></tr>
									<tr><td>
									<hr>
									</td></tr>
									</table>
                                  </div>
                                </div>
                              </td>
                            </tr>
                            <tr><td  height=\'15\'></td></tr>
                          </table>
                        </td>
                        <td width=\'20\'></td>
                      </tr>
                    </table>
                    <br>
                    <br>
                    <br>
                    <br>
                  </td>
                </tr>
              </table>
            </div>
                   <br>
                   <br>
                   <br>
                   <br>
          </td>
        </tr>   
      </table>
    </td>
  </tr>
</table>

  </body>
  </html>
';
	return $message;
 }

 function keineAngabe($in){
 	if($in){
 		return htmlspecialchars($in);
 	}else{
 		return '<i>keine Angabe</i>';
 	}
 }
/*
#
#    FUNCTIONS
#
#
#
*/

if(isset($_GET['page'])){
	
if($_GET['page'] == 1 && isset($_POST['stadt_angebot']) && isset($_POST['ihr_name']) && isset($_POST['email'])){

$subject = '[Anfrage] '.htmlspecialchars($_POST['stadt_angebot']).'';
$body = '<tr>
			<td>
				<p>Vielen Dank <b>'.htmlspecialchars($_POST['anrede']).' '.htmlspecialchars($_POST['ihr_name']).'</b>,</p>
				<p>dass Sie uns als Dienstleister Ihres Vertrauens anerkennen und eine Anfrage stellen!</p>
				<p>Sie erhalten hiermit die Bestätigung Ihrer erfolgreich eingereichte Anfrage. Bitte haben Sie etwas Geduld, bis wir Ihnen mit einem Antwort entgegenkommen.</p>
				<p>Ihre Anfrage wird unverändert wie folgend an uns eingereicht:</p>
			</td>
		</tr>
		<tr><td><hr></td></tr>
		<tr>
			<td><h2>Anforderungen</h2></td>
		</tr>
		<tr>
			<td>Stadt: <b>'.htmlspecialchars($_POST['stadt_angebot']).'</b></td>
		</tr>
		<tr>
			<td>Fläche in qm: <b>'.keineAngabe($_POST['qm_A']).'</b></td>
		</tr>
		<tr><td><hr></td></tr>
		<tr>
			<td><h2>Weitere Information</h2></td>
		</tr>
		<tr>
			<td>Angaben:
			  <fieldset>
			    <legend></legend>
					<b>'.nl2br(keineAngabe($_POST['weitere_info'])).'</b>
			  </fieldset><br>
			</td>
		</tr>
		<tr> 
			<td>Anhänge: ';
		if(isset($_POST['bild'])){
			if(count($_POST['bild'])<=1){
				$sinist= 'befindet sich <b>'.count($_POST['bild']).' Datei</b>';
			}else{
				$sinist= 'befinden sich <b>'.count($_POST['bild']).' Dateien</b>';
			}
			$body .= 'Es '.$sinist.' im Anhang';
		}else{
			$body .= '<i>Es wurden keine Dateien angehängt!</i>';
		}
		$body .= '</b></td>
		</tr>
		<tr><td><hr></td></tr>
		<tr>
			<td><h2>Kontaktdaten</h2></td>
		</tr>
		<tr>
			<td>Ansprechperson: <b>'.htmlspecialchars($_POST['anrede']).' '.htmlspecialchars($_POST['ihr_name']).'</b></td>
		</tr>
		<tr>
			<td>Strasse: <b>'.keineAngabe($_POST['strasse']).'</b></td>
		</tr>
		<tr>
			<td>PLZ: <b>'.keineAngabe($_POST['plz']).'</b></td>
		</tr>
		<tr>
			<td>Ort: <b>'.keineAngabe($_POST['ort']).'</b></td>
		</tr>
		<tr>
			<td>Telefonnummer: <b>'.keineAngabe($_POST['tel']).'</b></td>
		</tr>
		<tr>
			<td>E-Mail: <b>'.htmlspecialchars($_POST['email']).'</b></td>
		</tr>
		';
if(isset($_POST['bild'])){
$attachments = $_POST['bild'];
}else{
$attachments = '';
}
echo mail_att($_POST['email'],$subject,templateMail($subject,$body),$attachments,1);

}elseif($_GET['page'] == 1){
	$error ='<div class="alert alert-danger">Es ist/sind leider folgende/s Fehler entstanden! <ul>';
	if(empty($_POST['stadt_angebot'])){
	$error .= '<li>Inhalt für [stadt] wurde nicht gefunden!</li>'; }
	if(empty($_POST['ihr_name'])){
	$error .= '<li>Inhalt für [ihr_name] wurde nicht gefunden!</li>'; }
	if(empty($_POST['email'])){
	$error .= '<li>Inhalt für [email] wurde nicht gefunden!</li>'; }
	$error .='</ul></div>';
	echo $error;
}elseif($_GET['page'] == 2 && isset($_POST['vorname']) && isset($_POST['email']) && isset($_POST['betreff']) && isset($_POST['text']) ){
		$subject = '[Kontaktanfrage] '.htmlspecialchars($_POST['betreff']).'';
		$body = '		<tr><td><p>Liebe/r <b>'.htmlspecialchars($_POST['vorname']).'</b>,</p><p>Sie erhalten hiermit die Bestätigung Ihrer erfolgreich eingereichte Kontaktanfrage. Bitte haben Sie etwas Geduld, bis wir Ihnen mit einem Antwort entgegenkommen.</p></td>
						</tr>
						<tr><td><hr></td></tr>
						<tr><td><h2>Kontaktanfrage</h2></td>
						</tr>
						<tr><td>Name: <b>'.htmlspecialchars($_POST['vorname']).'</b></td>
						</tr>
						<tr><td>E-Mail: <b>'.htmlspecialchars($_POST['email']).'</b></td>
						</tr>
						<tr><td>Betreff: <b>'.htmlspecialchars($_POST['betreff']).'</b></td>
						</tr>
						<tr>
							<td>
							  Inhalt:
							  <fieldset>
							    <legend></legend>
									<b>'.nl2br(keineAngabe($_POST['text'])).'</b>
							  </fieldset><br>
							</td>
						</tr>
						';
 
	echo mail_att($_POST['email'],$subject,templateMail($subject, $body),'',2);
}elseif($_GET['page'] == 2){
	$error ='<div class="alert alert-danger">Es ist/sind leider folgende/s Fehler entstanden! <ul>';
	if(empty($_POST['vorname'])){
	$error .= '<li>Inhalt für [vorname] wurde nicht gefunden!</li>'; }
	if(empty($_POST['email'])){
	$error .= '<li>Inhalt für [email] wurde nicht gefunden!</li>'; }
	if(empty($_POST['betreff'])){
	$error .= '<li>Inhalt für [betreff] wurde nicht gefunden!</li>'; }
	if(empty($_POST['text'])){
	$error .= '<li>Inhalt für [text] wurde nicht gefunden!</li>'; }
	$error .='</ul></div>';
	echo $error;
}if($_GET['page'] == 3 && isset($_POST['bewerbung']) && isset($_POST['ihr_name']) && isset($_POST['email'])){

$subject = '[Bewerbung] '.htmlspecialchars($_POST['anrede']).' '.htmlspecialchars($_POST['ihr_name']).'';
$body = '<tr>
			<td>
				<p>Vielen Dank <b>'.htmlspecialchars($_POST['anrede']).' '.htmlspecialchars($_POST['ihr_name']).'</b>,</p>
				<p>dass Sie sich bei uns beworben haben!</p>
				<p>Sie erhalten hiermit die Bestätigung Ihrer erfolgreich eingereichten Bewerbung. Bitte haben Sie etwas Geduld, bis wir Ihnen mit einem Antwort entgegenkommen.</p>
				<p>Ihre Bewerbung wird unverändert wie folgend an uns eingereicht:</p>
			</td>
		</tr>
		<tr><td><hr></td></tr>
		<tr>
			<td><h2>Kontaktdaten</h2></td>
		</tr>
		<tr>
			<td>Ansprechperson: <b>'.htmlspecialchars($_POST['anrede']).' '.htmlspecialchars($_POST['ihr_name']).'</b></td>
		</tr>
		<tr>
			<td>Telefonnummer: <b>'.keineAngabe($_POST['tel']).'</b></td>
		</tr>
		<tr>
			<td>E-Mail: <b>'.htmlspecialchars($_POST['email']).'</b></td>
		</tr>
		<tr><td><hr></td></tr>
		<tr>
			<td><h2>Bewerbungstext</h2></td>
		</tr>
		<tr>
			<td>Angaben:
			  <fieldset>
			    <legend></legend>
					<b>'.nl2br(keineAngabe($_POST['bewerbung'])).'</b>
			  </fieldset><br>
			</td>
		</tr>
		<tr><td><hr></td></tr>
		<tr>
			<td><h2>Anhänge</h2></td>
		</tr>
		<tr> 
			<td>Information: ';
		if(isset($_POST['bild'])){
			if(count($_POST['bild'])<=1){
				$sinist= 'befindet sich <b>'.count($_POST['bild']).' Datei</b>';
			}else{
				$sinist= 'befinden sich <b>'.count($_POST['bild']).' Dateien</b>';
			}
			$body .= 'Es '.$sinist.' im Anhang';
		}else{
			$body .= '<i>Es wurden keine Dateien angehängt!</i>';
		}
		$body .= '</b></td>
		</tr>
		';
if(isset($_POST['bild'])){
$attachments = $_POST['bild'];
}else{
$attachments = '';
}
echo mail_att($_POST['email'],$subject,templateMail($subject,$body),$attachments,1);

}elseif($_GET['page'] == 3){
	$error ='<div class="alert alert-danger">Es ist/sind leider folgende/s Fehler entstanden! <ul>';
	if(empty($_POST['bewerbung'])){
	$error .= '<li>Inhalt für [bewerbung] wurde nicht gefunden!</li>'; }	
	if(empty($_POST['ihr_name'])){
	$error .= '<li>Inhalt für [ihr_name] wurde nicht gefunden!</li>'; }
	if(empty($_POST['email'])){
	$error .= '<li>Inhalt für [email] wurde nicht gefunden!</li>'; }
	$error .='</ul></div>';
	echo $error;
}
}
?>