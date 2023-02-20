<?php
error_reporting(0);
if ('api.php' == basename($_SERVER['SCRIPT_FILENAME'])) {
    die('(c) 2014-' . date("Y") . ' by Abdullah Sahin. All rights reserved.');
    exit;
}

require ('ApiClass.php');
$api = new ApiClass();

if (empty($_GET['seite']) || $_GET['seite'] != 'fahrzeuge') {
    $get = $api->listInserate();
    if ($get != -1) {
        echo $get;
    } else {
        echo '<br><br><h4 class="text-center">Momentan kein Fahrzeugsbestand vorhanden!</h4><br><br>';
    }
} elseif (isset($_GET['seite']) && $_GET['seite'] == 'fahrzeuge') {
    if (isset($_GET['fid']) && isset($_GET['p'])) {
        $get = -1;
        if ($_GET['p'] == 'mobile') {
            $get = $api->showInseratMobile($_GET['fid']);
        } elseif ($_GET['p'] == 'autoscout') {
            $get = $api->showInseratAutoscout($_GET['fid']);
        }
        if ($get == -1) {
            echo '<hr class="iysCmsAutoHaendler"><h1 class="iysCmsAutoHaendlerText">404 - Dieser Link ist ungültig.</h1><hr class="iysCmsAutoHaendler"><br><br><br><br><br><br><br><br><br><br><br>';
        } else {
            echo $get;
        }
    } else {
        if (!isset($_GET['page'])) {
            $seite = 1;
        } else {
            $seite = (int) $_GET['page'];
        }
        $get = $api->listInserate($seite);
        if ($get != -1) {
            echo $get.'<br><br>';
        } else {
            echo '<hr class="iysCmsAutoHaendler"><h1 class="iysCmsAutoHaendlerText">404 - Fahrzeugsbestand nicht gefunden oder dieser Link ist ungültig.</h1><hr class="iysCmsAutoHaendler"><br><br><br><br><br><br><br><br><br><br><br>';
        }
    }
} else {
    die('(c) 2014-' . date("Y") . ' by Abdullah Sahin. All rights reserved.');
    exit;
}
