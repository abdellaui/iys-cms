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
   $absender = $_SERVER['SE67RVER_NAME'];
   $absender_mail = SMTP_USER;
   $mailAdresse = SMTP_USER;
   $mime_boundary = "-----=" . md5(uniqid(mt_rand(), 1));
   $header = "From:".$absender."<".$absender_mail.">\r\n";
   $header .= "To:".$to."\r\n";
   $header .= "Reply-To:".$to."\r\n";
   $header .= "Bcc:".$mailAdresse."\r\n";
   $header .= "Subject: ".$subject."\r\n";
   $header .= "Date: ".date("r")."\r\n";
   $header .= "MIME-Version: 1.0\r\n";
   $header .= "Content-Type: multipart/mixed;\r\n";
   $header .= " boundary=\"".$mime_boundary."\"\r\n";
   $content = "";
   $content.= "--".$mime_boundary."\r\n";
   $content.= "Content-Type: text/html; charset=\"UTF-8\"\r\n";
   $content.= "Content-Transfer-Encoding: 8bit\r\n\r\n";
   $content.= $message."\r\n";
 
   if(is_array($attachments) AND is_array(current($attachments)))
      {
      foreach($attachments AS $dat)
         {
         $data = chunk_split(str_replace('data:' . $dat['type'] . ';base64,','',$dat['base64']));
         $content.= "--".$mime_boundary."\r\n";
         $content.= "Content-Disposition: attachment;\r\n";
         $content.= "\tfilename=\"".$dat['name']."\";\r\n";
         $content.= "Content-Length: .".$dat['size'].";\r\n";
         $content.= "Content-Type: ".$dat['type']."; name=\"".$dat['name']."\"\r\n";
         $content.= "Content-Transfer-Encoding: base64\r\n\r\n";
         $content.= $data."\r\n";
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
    return '<div class="alert alert-success">Ihr Angebot wurde entgegengenommen! Sie erhalten in Kürze die Bestätigungsmail!</div>';
   }else{
	return '<div class="alert alert-danger">Es ist leider ein unerwartetes Fehler aufgetretten! Bitte prüfen Sie, ob Sie die Bestätigungsmail erhalten haben. Falls Sie Keines <b>innerhalb der nächsten 5 Minuten</b> erhalten, versuchen Sie erneuert einen Angebot zu stellen!</div>';
   }
  }else{
	return '<div class="alert alert-warning">Sie haben vor etwa <b>'.$sendezeit.' Sekunden</b> einen Angebot gestellt. Aus Sicherheitsgründen können Sie <b>pro Minuten</b> einen Angebot stellen! </div>';  
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
   }
   }
   
 function file_get_contents_curl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);    
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; WOW64; rv:48.0) Gecko/20100101 Firefox/48.0');
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
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
   background: #000000!important;
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
    "bgBody":"000000",
    "link":"ffffff",
    "color":"ffffff",
    "bgItem":"ffffff",
    "title":"ffffff"
}
</script>

</head>
<body paddingwidth="0" paddingheight="0" class=\'bgBody\'  style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased; font-family:Helvetica, sans-serif;background: #000000!important;" offset="0" toppadding="0" leftpadding="0">
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
                          <table width="480" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr>
                              <td align="middle">
                                <div class="contentEditableContainer contentImageEditable">
                                  <div class="contentEditable">
                                    <img src="https://sahin.cloud//img/icons/grossesIcon.png" width=\'480\' data-default="placeholder" data-max-width="480">
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
                                     
                  $arr = [
                  ['Startseite', 'https://sahin.cloud/startseite'],
                  ['Fahrzeuge', 'https://sahin.cloud/fahrzeuge'],
                  ['Ankauf', 'https://sahin.cloud/ankauf'],
                  ['Standort', 'https://sahin.cloud/standort'],
                  ['Kontakt','https://sahin.cloud/kontakt']
                  ]; 
                  foreach($arr AS $k => $v){
                    $message .= '
                     <a href="'.$v[1].'" title="'.$v[0].'"> [ '.$v[0].' ] </a>
                    ';
                  }
                   
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



/*
#
#    FUNCTIONS
#
#
#
*/

if(isset($_GET['page'])){
	
if($_GET['page'] == 1 && isset($_GET['id']) && $_GET['id']){
	header("Content-type: application/json; charset=utf-8");
	echo file_get_contents_curl('https://auto-verkaufen.mobile.de/anbieten/syi/listCarModels.json?makeId='.$_GET['id'].'&lang=de');
}elseif($_GET['page'] == 2 && $_POST['dsgvo']==1 && (isset($_POST['vorname']) && isset($_POST['telefonnummer']) && isset($_POST['email']) && isset($_POST['preisvorstellung']) && isset($_POST['marke']) && isset($_POST['modell']) && isset($_POST['erstzulassung_monat']) && isset($_POST['erstzulassung_jahr']) && isset($_POST['kategorie']) && isset($_POST['getriebe']) && isset($_POST['kraftstoffart']) && isset($_POST['beschaedigtes_fahrzeug']) && isset($_POST['unfallfahrzeug']) && isset($_POST['fahrtauglich']) && isset($_POST['kilometerstand']) && isset($_POST['leistung']) && isset($_POST['leistung_art']) && isset($_POST['hu_min_monat']) && isset($_POST['hu_min_jahr']) && isset($_POST['fahrzeughalter']) && isset($_POST['schadstoffklasse']) && isset($_POST['innenausstattung_typ']) && isset($_POST['farbe_innenausstattung']) && isset($_POST['fahrzeugbeschreibung']))){
$markeArray = array('140'=>'Abarth','203'=>'AC','375'=>'Acura','800'=>'Aixam','900'=>'Alfa Romeo','1100'=>'ALPINA','121'=>'Artega','1750'=>'Asia Motors','1700'=>'Aston Martin','1900'=>'Audi','2000'=>'Austin','1950'=>'Austin Healey','3100'=>'Bentley','3500'=>'BMW','3850'=>'Borgward','4025'=>'Brilliance','4350'=>'Bugatti','4400'=>'Buick','4700'=>'Cadillac','112'=>'Casalini','5300'=>'Caterham','83'=>'Chatenet','5600'=>'Chevrolet','5700'=>'Chrysler','5900'=>'Citroën','6200'=>'Cobra','6325'=>'Corvette','6600'=>'Dacia','6800'=>'Daewoo','7000'=>'Daihatsu','7400'=>'DeTomaso','7700'=>'Dodge','255'=>'Donkervoort','235'=>'DS Automobiles','8600'=>'Ferrari','8800'=>'Fiat','172'=>'Fisker','9000'=>'Ford','205'=>'GAC Gonow','204'=>'Gemballa','9900'=>'GMC','122'=>'Grecav','186'=>'Hamann','10850'=>'Holden','11000'=>'Honda','11050'=>'Hummer','11600'=>'Hyundai','11650'=>'Infiniti','11900'=>'Isuzu','12100'=>'Iveco','12400'=>'Jaguar','12600'=>'Jeep','13200'=>'Kia','13450'=>'Koenigsegg','13900'=>'KTM','14400'=>'Lada','14600'=>'Lamborghini','14700'=>'Lancia','14800'=>'Land Rover','14845'=>'Landwind','15200'=>'Lexus','15400'=>'Ligier','15500'=>'Lincoln','15900'=>'Lotus','16200'=>'Mahindra','16600'=>'Maserati','16700'=>'Maybach','16800'=>'Mazda','137'=>'McLaren','17200'=>'Mercedes-Benz','17300'=>'MG','30011'=>'Microcar','17500'=>'MINI','17700'=>'Mitsubishi','17900'=>'Morgan','18700'=>'Nissan','18875'=>'NSU','18975'=>'Oldsmobile','19000'=>'Opel','149'=>'Pagani','19300'=>'Peugeot','19600'=>'Piaggio','19800'=>'Plymouth','20000'=>'Pontiac','20100'=>'Porsche','20200'=>'Proton','20700'=>'Renault','21600'=>'Rolls-Royce','21700'=>'Rover','125'=>'Ruf','21800'=>'Saab','22000'=>'Santana','22500'=>'Seat','22900'=>'Skoda','23000'=>'Smart','188'=>'speedART','100'=>'Spyker','23100'=>'Ssangyong','23500'=>'Subaru','23600'=>'Suzuki','23800'=>'Talbot','23825'=>'Tata','189'=>'TECHART','135'=>'Tesla','24100'=>'Toyota','24200'=>'Trabant','24400'=>'Triumph','24500'=>'TVR','25200'=>'Volkswagen','25100'=>'Volvo','25300'=>'Wartburg','113'=>'Westfield','25650'=>'Wiesmann','1400'=>'Andere');
$subject = '[Angebot] '.htmlspecialchars($markeArray[$_POST['marke']]).' - '.htmlspecialchars($_POST['modell']).'';
$message = '<tr><td><p>Vielen Dank <b>'.htmlspecialchars($_POST['vorname']).'</b>,</p><p>dass Sie uns als Händler Ihres Vertrauens anerkennen und Ihr Auto uns zum Ankauf vorstellen!</p><p>Sie erhalten hiermit die Bestätigung Ihres erfolgreich eingereichten Angebotes. Bitte haben Sie etwas Geduld, bis wir Ihnen mit einem Antwort entgegenkommen.</p><p>Ihr Angebot wird unverändert wie folgend an uns eingereicht:</p></td>
						</tr>
						<tr><td><h1>Angaben zur Person</h1></td>
						</tr>
						<tr><td>Name: <b>'.htmlspecialchars($_POST['vorname']).'</b></td>
						</tr>
						<tr><td>Telefonnummer: <b>'.htmlspecialchars($_POST['telefonnummer']).'</b></td>
						</tr>
						<tr><td>E-Mail: <b>'.htmlspecialchars($_POST['email']).'</b></td>
						</tr>
						<tr><td><h1>Bilder zur Auto</h1></td>
						</tr>
						<tr><td>';
						if(isset($_POST['bild'])){
							if(count($_POST['bild'])<=1){
								$sinist= 'ist <b>'.count($_POST['bild']).' Bild</b>';
							}else{
								$sinist= 'sind <b>'.count($_POST['bild']).' Bilder</b>';
							}
							$message .= 'Es '.$sinist.' im Anhang';
						}else{
							$message .= '<i>Es wurden keine Bilder hinzugefügt!</i>';
						}
						$message .= '</b></td>
						</tr>
						<tr><td><h1>Angaben zum Auto</h1></td>
						</tr>
						<tr><td>Preisvorstelleung: <b>'.htmlspecialchars($_POST['preisvorstellung']).' €</b></td>
						</tr>
						<tr><td>Marke: <b>'.htmlspecialchars($markeArray[$_POST['marke']]).'</b></td>
						</tr>
						<tr><td>Modell: <b>'.htmlspecialchars($_POST['modell']).'</b></td>
						</tr>
						<tr><td>Erstzulassung: <b>'.htmlspecialchars($_POST['erstzulassung_monat']).' '.htmlspecialchars($_POST['erstzulassung_jahr']).'</b></td>
						</tr>
						<tr><td>Kategorie: <b>'.htmlspecialchars($_POST['kategorie']).'</b></td>
						</tr>
						<tr><td>Getriebe: <b>'.htmlspecialchars($_POST['getriebe']).'</b></td>
						</tr>
						<tr><td>Kraftstoffart: <b>'.htmlspecialchars($_POST['kraftstoffart']).'</b></td>
						</tr>
						<tr><td>Fahrzeugstand: <b>'.htmlspecialchars($_POST['beschaedigtes_fahrzeug']).'</b></td>
						</tr>
						<tr><td>Unfallfahrzeug: <b>'.htmlspecialchars($_POST['unfallfahrzeug']).'</b></td>
						</tr>
						<tr><td>Fahrtauglich: <b>'.htmlspecialchars($_POST['fahrtauglich']).'</b></td>
						</tr>
						<tr><td><h1>Weitere technische Daten</h1></td>
						</tr>
						<tr><td>Kilometerstand: <b>'.htmlspecialchars($_POST['kilometerstand']).' km</b></td>
						</tr>
						<tr><td>Leistung: <b>'.htmlspecialchars($_POST['leistung']).' '.htmlspecialchars($_POST['leistung_art']).'</b></td>
						</tr>
						<tr><td>HU (TÜV) mind. gültig bis: <b>'.htmlspecialchars($_POST['hu_min_monat']).' '.htmlspecialchars($_POST['hu_min_jahr']).'</b></td>
						</tr>
						<tr><td>Fahrzeughalter: <b>'.htmlspecialchars($_POST['fahrzeughalter']).'</b></td>
						</tr>
						<tr><td>Sitzplaetze: <b>'.htmlspecialchars($_POST['sitzplaetze']).'</b></td>
						</tr>
						<tr><td>Türe: <b>'.htmlspecialchars($_POST['tuere']).'</b></td>
						</tr>
						<tr><td>Hubraum: <b>'.htmlspecialchars($_POST['hubraum']).' cm³</b></td>
						</tr>
						<tr><td>Ø Kraftstoffverbrauch innerorts: <b>'.htmlspecialchars($_POST['kraftstoffverbr_inner']).' l/100k</b></td>
						</tr>
						<tr><td>Ø Kraftstoffverbrauch außerorts: <b>'.htmlspecialchars($_POST['kraftstoffverbr_ausser']).' l/100k</b></td>
						</tr>
						<tr><td>CO<sup>2</sup>-Emissionen komb.: <b>'.htmlspecialchars($_POST['co2-emissionen']).' g/km</b></td>
						</tr>
						<tr><td>Schadstoffklasse: <b>'.htmlspecialchars($_POST['schadstoffklasse']).'</b></td>
						</tr>
						<tr><td>Umweltplakette: <b>'.htmlspecialchars($_POST['umweltplakette']).'</b></td>
						</tr>
						<tr><td>Farbe: <b>';
						foreach($_POST['farbe'] AS $a => $b){
							$message .= $b.' ';
						}
						$message .= '</b></td>
						</tr>
						<tr><td>Innenausstattung: <b>'.htmlspecialchars($_POST['innenausstattung_typ']).'</b></td>
						</tr>
						<tr><td>Farbe der Innenausstattung: <b>'.htmlspecialchars($_POST['farbe_innenausstattung']).'</b></td>
						</tr>
						<tr><td><h1>Ausstattung</h1></td>
						</tr>
						<tr><td>Innenausstattung: 
						<ul>';
						if(isset($_POST['innenaustattung'])){
						foreach($_POST['innenaustattung'] AS $a => $b){
							$message .= '<li><b>'.htmlspecialchars($b).'</b></li>';
						}
						}else{
							$message .= '<li><i>Keine Angaben</i></li>';
						}
						$message .='</ul>
						</td>
						</tr>
						<tr><td>Außenausstattung: 
						<ul>';
						if(isset($_POST['aussenaustattung'])){
						foreach($_POST['aussenaustattung'] AS $a => $b){
							$message .= '<li><b>'.htmlspecialchars($b).'</b></li>';
						}
						}else{
							$message .= '<li><i>Keine Angaben</i></li>';
						}
						$message .='</ul>
						</td>
						</tr>
						<tr><td>Extras: 
						<ul>';
						if(isset($_POST['extrasaustattung'])){
						foreach($_POST['extrasaustattung'] AS $a => $b){
							$message .= '<li><b>'.htmlspecialchars($b).'</b></li>';
						}
						}else{
							$message .= '<li><i>Keine Angaben</i></li>';
						}
						$message .='</ul>
						</td>
						</tr>
						<tr><td>Sicherheit & Umwelt: 
						<ul>';
						if(isset($_POST['sicherheitundumweltaustattung'])){
						foreach($_POST['sicherheitundumweltaustattung'] AS $a => $b){
							$message .= '<li><b>'.htmlspecialchars($b).'</b></li>';
						}
						}else{
							$message .= '<li><i>Keine Angaben</i></li>';
						}
						$message .='</ul>
						</td>
						</tr>
						<tr><td><h1>Fahrzeugbeschreibung</h1></td>
						</tr>
						<tr>
							<td>Ergänzende  Beschreibung:
							  <fieldset>
							    <legend></legend>
									<b>'.nl2br(htmlspecialchars($_POST['fahrzeugbeschreibung'])).'</b>
							  </fieldset><br>
							</td>
						</tr>';
if(isset($_POST['bild'])){
$attachments = $_POST['bild'];
}else{
$attachments = '';
}
echo mail_att($_POST['email'], $subject,templateMail($subject, $message),$attachments,1);

}elseif($_GET['page'] == 2){
	if($_POST['dsgvo']!=1 || empty($_POST['dsgvo'])){
		$error .= '<li>Akzeptieren Sie die Datenschutzerklärung.</li>'; 
	}

	$error ='<div class="alert alert-danger">Es ist/sind leider folgende/s Fehler entstanden! <ul>';
	if(empty($_POST['vorname'])){
	$error .= '<li>Inhalt für [vorname] wurde nicht gefunden!</li>'; }
	if(empty($_POST['telefonnummer'])){
	$error .= '<li>Inhalt für [telefonnummer] wurde nicht gefunden!</li>'; }
	if(empty($_POST['email'])){
	$error .= '<li>Inhalt für [email] wurde nicht gefunden!</li>'; }
	if(empty($_POST['preisvorstellung'])){
	$error .= '<li>Inhalt für [preisvorstellung] wurde nicht gefunden!</li>'; }
	if(empty($_POST['marke'])){
	$error .= '<li>Inhalt für [marke] wurde nicht gefunden!</li>'; }
	if(empty($_POST['modell'])){
	$error .= '<li>Inhalt für [modell] wurde nicht gefunden!</li>'; }
	if(empty($_POST['erstzulassung_monat'])){
	$error .= '<li>Inhalt für [erstzulassung_monat] wurde nicht gefunden!</li>'; }
	if(empty($_POST['erstzulassung_jahr'])){
	$error .= '<li>Inhalt für [erstzulassung_jahr] wurde nicht gefunden!</li>'; }
	if(empty($_POST['kategorie'])){
	$error .= '<li>Inhalt für [kategorie] wurde nicht gefunden!</li>'; }
	if(empty($_POST['getriebe'])){
	$error .= '<li>Inhalt für [getriebe] wurde nicht gefunden!</li>'; }
	if(empty($_POST['kraftstoffart'])){
	$error .= '<li>Inhalt für [kraftstoffart] wurde nicht gefunden!</li>'; }
	if(empty($_POST['beschaedigtes_fahrzeug'])){
	$error .= '<li>Inhalt für [beschaedigtes_fahrzeug] wurde nicht gefunden!</li>'; }
	if(empty($_POST['unfallfahrzeug'])){
	$error .= '<li>Inhalt für [unfallfahrzeug] wurde nicht gefunden!</li>'; }
	if(empty($_POST['fahrtauglich'])){
	$error .= '<li>Inhalt für [fahrtauglich] wurde nicht gefunden!</li>'; }
	if(empty($_POST['kilometerstand'])){
	$error .= '<li>Inhalt für [kilometerstand] wurde nicht gefunden!</li>'; }
	if(empty($_POST['leistung'])){
	$error .= '<li>Inhalt für [leistung] wurde nicht gefunden!</li>'; }
	if(empty($_POST['leistung_art'])){
	$error .= '<li>Inhalt für [leistung_art] wurde nicht gefunden!</li>'; }
	if(empty($_POST['hu_min_monat'])){
	$error .= '<li>Inhalt für [hu_min_monat] wurde nicht gefunden!</li>'; }
	if(empty($_POST['hu_min_jahr'])){
	$error .= '<li>Inhalt für [hu_min_jahr] wurde nicht gefunden!</li>'; }
	if(empty($_POST['fahrzeughalter'])){
	$error .= '<li>Inhalt für [fahrzeughalter] wurde nicht gefunden!</li>'; }
	if(empty($_POST['schadstoffklasse'])){
	$error .= '<li>Inhalt für [schadstoffklasse] wurde nicht gefunden!</li>'; }
	if(empty($_POST['innenausstattung_typ'])){
	$error .= '<li>Inhalt für [innenausstattung_typ] wurde nicht gefunden!</li>'; }
	if(empty($_POST['farbe_innenausstattung'])){
	$error .= '<li>Inhalt für [farbe_innenausstattung] wurde nicht gefunden!</li>'; }
	if(empty($_POST['fahrzeugbeschreibung'])){
	$error .= '<li>Inhalt für [fahrzeugbeschreibung] wurde nicht gefunden!</li>'; }
	$error .='</ul></div>';
	echo $error;
}elseif($_GET['page'] == 3 && isset($_POST['vorname']) && isset($_POST['email']) && isset($_POST['betreff']) && isset($_POST['text']) && $_POST['dsgvo']==1 ){
$subject = '[Kontaktanfrage] '.htmlspecialchars($_POST['betreff']).'';
$message = ' <tr><td><p>Liebe/r <b>'.htmlspecialchars($_POST['vorname']).'</b>,</p><p>Sie erhalten hiermit die Bestätigung Ihrer erfolgreich eingereichte Kontaktanfrage. Bitte haben Sie etwas Geduld, bis wir Ihnen mit einem Antwort entgegenkommen.</p></td>
						</tr>
						<tr><td><h1>Kontaktanfrage</h1></td>
						</tr>
						<tr><td>Name: <b>'.htmlspecialchars($_POST['vorname']).'</b></td>
						</tr>
						<tr><td>E-Mail: <b>'.htmlspecialchars($_POST['email']).'</b></td>
						</tr>
						<tr><td>Betreff: <b>'.htmlspecialchars($_POST['betreff']).'</b></td>
						</tr>
						<tr>
							<td>Inhalt:
							  <fieldset>
							    <legend></legend>
									<b>'.nl2br(htmlspecialchars($_POST['text'])).'</b>
							  </fieldset><br>
							</td>
						</tr>';
	echo mail_att($_POST['email'], $subject,templateMail($subject, $message),'',2);
}elseif($_GET['page'] == 3){
	$error ='<div class="alert alert-danger">Es ist/sind leider folgende/s Fehler entstanden! <ul>';
	if($_POST['dsgvo']!=1 || empty($_POST['dsgvo'])){
		$error .= '<li>Akzeptieren Sie die Datenschutzerklärung.</li>'; 
	}

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
}
}
?>