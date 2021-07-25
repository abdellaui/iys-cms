<?php
if (basename(__FILE__) == basename($_SERVER['SCRIPT_FILENAME'])) {
    die('(c) 2014-' . date("Y") . ' by Abdullah Sahin. All rights reserved.');
    exit;
}
echo menuLo();
echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.6/owl.carousel.min.js"></script><div class="container-fluid backGroundToplist"><div class="container"><div class="row"><div class="col-md-8 col-md-offset-2"><img src="/img/habbolar_happybirthday.png" height="246" width="412" alt="Happy Birthday!" class="center-block img-responsive">';

echo '<div class="birhtday_takvimCarouselHolder"><div class="owl-carousel" id="birhtday_takvimCarousel">';

$monate = array(1 => "Ocak",
    2 => "Şubat",
    3 => "Mart",
    4 => "Nisan",
    5 => "Mayıs",
    6 => "Haziran",
    7 => "Temmuz",
    8 => "Ağustos",
    9 => "Eylül",
    10 => "Ekim",
    11 => "Kasım",
    12 => "Aralık");
if (isset($_GET['sayfa']) && $_GET['sayfa'] > 0) {
    $seite = safe($_GET['sayfa']);
} else {
    $seite = 1;
}
$eintraege_pro_seite = 30;
$start = $seite * $eintraege_pro_seite - $eintraege_pro_seite;
if (isset($_GET['m']) && isset($_GET['d']) && $_GET['m'] > 0 && $_GET['m'] < 13 && $_GET['d'] > 0 && $_GET['d'] < 32) {
    $month = (int) $_GET['m'];
    $day = (int) $_GET['d'];
    $getedTime = mktime(0, 0, 0, $month, $day, date("Y", time()));
} else {
    $getedTime = time();
}

for ($x = 1; $x <= 12; $x++) {
    $jetz = time();
    $current_month_nr = date('m', $jetz);
    $current_year = date('Y', $jetz);
    $last_month_nr = $x;
    $kal_datum = mktime(0, 0, 0, $last_month_nr, 1, $current_year);
    $kal_tage_gesamt = date("t", $kal_datum);
    $kal_start_timestamp = mktime(0, 0, 0, date("n", $kal_datum), 1, date("Y", $kal_datum));
    $kal_start_tag = date("N", $kal_start_timestamp);
    $kal_ende_tag = date("N", mktime(0, 0, 0, date("n", $kal_datum), $kal_tage_gesamt, date("Y", $kal_datum)));
    if (date("m", $getedTime) == $x) {
        $isnow = ' id="suankietkinlik"';
    } else {
        $isnow = '';
    }
    echo '<div class="item" abdullahmetingoester="birthday_takvim-' . $x . '"' . $isnow . '>
<div class="birthday_takvim-background"><div class="birthday_takvim-background-shadow"></div>';
    echo '<div class="birthday_takvim_ay"><h2>' . $monate[date("n", $kal_datum)] . '</h2></div>
<div class="table-responsive">
<table class="table birthday_takvim_table">
      <thead>
        <tr>
          <th>Pt</th>
          <th>Sa</th>
          <th>Ça</th>
          <th>Pe</th>
          <th>Cu</th>
          <th>Ct</th>
          <th>Pz</th>
        </tr></thead><tbody>';

    for ($i = 1; $i <= $kal_tage_gesamt + ($kal_start_tag - 1) + (7 - $kal_ende_tag); $i++) {
        $kal_anzeige_akt_tag = $i - $kal_start_tag;
        $kal_anzeige_heute_timestamp = strtotime($kal_anzeige_akt_tag . " day", $kal_start_timestamp);
        $kal_anzeige_heute_tag = date("j", $kal_anzeige_heute_timestamp);
        $kal_anzeige_heute_tag_link = date("d-m", $kal_anzeige_heute_timestamp);
        if (date("N", $kal_anzeige_heute_timestamp) == 1) {
            echo '<tr>';
        }

        if (date("dmY", $getedTime) == date("dmY", $kal_anzeige_heute_timestamp)) {
            echo '<td class="success"><span>' . $kal_anzeige_heute_tag . '</span></td>';
        } elseif ((date("dmY", time()) == date("dmY", $kal_anzeige_heute_timestamp)) && date("dmY", $getedTime) != date("dmY", time())) {
            echo '<td class="info"><a href="/dogumgunu/' . $kal_anzeige_heute_tag_link . '-1/"><div class="birthday_takvim_link"></div> ' . $kal_anzeige_heute_tag . '</a></td>';
        } elseif ($kal_anzeige_akt_tag >= 0 and $kal_anzeige_akt_tag < $kal_tage_gesamt) {
            echo '<td><a href="/dogumgunu/' . $kal_anzeige_heute_tag_link . '-1/"><div class="birthday_takvim_link"></div> ' . $kal_anzeige_heute_tag . '</a></td>';
        } else {
            echo '<td></td>';
        }

        if (date("N", $kal_anzeige_heute_timestamp) == 7) {
            echo '</tr>';
        }

    }

    echo '</tbody></table></div>';
    echo '</div></div>';
}

echo '</div></div>';
echo '<div class="row">';
$today = date("d.m", $getedTime);
$qry = mysqli_query(CON(), "SELECT name, bday from badge_scorelist WHERE bday LIKE '" . $today . "%' ORDER BY bday DESC LIMIT " . $start . ", " . $eintraege_pro_seite . ";");
$result = mysqli_query(CON(), "SELECT name, bday from badge_scorelist WHERE bday LIKE '" . $today . "%' ORDER BY bday DESC;");
$menge = mysqli_num_rows($result);
while ($row = mysqli_fetch_assoc($qry)) {
    echo '<div class="col-lg-4 col-md-6 col-sm-12">';

    echo '<div class="birthday_holder">
<div class="birhtday_imgHolder birthday_imgHolder_animation">
<div class="birhtday_img" style="background-image:url(https://www.habbo.com.tr/habbo-imaging/avatarimage?user=' . $row['name'] . '&direction=2&head_direction=3&gesture=sml&action=crr=667&size=b&img_format=gif);"></div>
</div>
<div class="birthday_info">
<a href="/scanner/com.tr/' . urlnameencode(htmlspecialchars($row['name'])) . '/"><div class="birthday_name">' . $row['name'] . '</div></a>
<div class="birthday_date"><span class="glyphicon glyphicon-gift"></span> ' . $row['bday'] . '</div>
</div>
</div>';

    echo '</div>';
}
echo '<div>';
$wieviel_seiten = ceil($menge / $eintraege_pro_seite);
echo blaetterfunktion($seite, $wieviel_seiten, '/dogumgunu/' . date("d-m", $getedTime), '8', '-');
echo '</div>';
echo '</div></div></div></div></div><script>$(document).ready(function(){var i=$("#birhtday_takvimCarousel");i.owlCarousel({loop:!0,margin:30,center:!0,autoplay:!1,items:1,nav:!0,startPosition:$("#birhtday_takvimCarousel div#suankietkinlik").index(),navText:[\'<div class="birthday_takvim-oksol"><span class="glyphicon glyphicon-chevron-left"></span></div>\',\'<div class="birthday_takvim-oksag"><span class="glyphicon glyphicon-chevron-right"></span><div>\'],responsiveClass:!0,responsive:{0:{items:1},600:{items:1},800:{items:2},1200:{items:2},1600:{items:3},2e3:{items:4},2400:{items:5},2800:{items:6}}})});</script>';
echo werbung();