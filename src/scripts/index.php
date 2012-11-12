<?php
//$heute = date("Y-m-d",strtotime("next Friday"));
$heute = date("Y-m-d",strtotime("next Sunday"));
header("Content-Type: text/html;charset=utf-8");
?>
<html>
<head>
    <title>Spiele am Wochenende - <?php echo $heute ?></title>
<style type="text/css">
body {
    font-family: "Verdana";
    font-size: 10pt;    
}
</style>
</head>
<body>
<?php
$wtag = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag");
include('hvwtab.php');
$hvw = new hvwtab('http://www.hvw-online.org/Spielbetrieb/?club=122&do='.$heute);

$inhalt = "<strong>Spiele am Wochenende</strong><br>\n";
$spdatum = $heute;
$csvarr = split(chr(13), $hvw->csv());
array_multisort($csvarr);

foreach ($csvarr as $zeile) {
    $zeile = ereg_replace("\"", "", $zeile);
        $spiel = split(",", $zeile);
    if ($zeile != "") {
        if ($spdatum != $spiel[0]) {
    	    $inhalt .= "<strong>".$wtag[date("w", strtotime($spiel[0]))].", ".date("d.m.Y", strtotime($spiel[0]))."</strong><br>\n";
        }
        $zusatzA = "";
        $zusatzB = "";
        if ((strlen(strstr($spiel[3],"F-BL"))>0) || (strlen(strstr($spiel[3],"M-"))>0)) {
          $zusatzA = "<strong>";
          $zusatzB = "</strong>";
        }
        $halle = array(1008 => "LHH B.", 2064 => "MZH G.");
	      $inhalt .= $spiel[1]." Uhr, ".$zusatzA.$spiel[3].$zusatzB;
	      if ($spiel[4] == "1008" || $spiel[4] == "2064") {
          $inhalt .= " (".$halle[$spiel[4]].")";
	      }
	      $inhalt .="<br> \n";
        $spdatum  = $spiel[0];
    }
}
echo $inhalt."<br><br>\n";
//print_r($spiel);
?>
</body>
</html>