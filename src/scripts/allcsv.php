<?php
date_default_timezone_set( 'Europe/Berlin' );
header("Content-Type: text/html;charset=utf-8");
$heute = date("Y-m-d",strtotime("last Sunday"));

include('hvwtab.php');
$hvw = new hvwtab('http://www.hvw-online.org/Spielbetrieb/?club=122&do='.$heute);
echo ereg_replace(chr(13), "<br />\n",$hvw->CsvAll());
?>