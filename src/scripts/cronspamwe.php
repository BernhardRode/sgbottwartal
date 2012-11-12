<?php
header("Content-Type: text/html;charset=utf-8");
$heute = date("Y-m-d",strtotime("next Sunday"));
$wtag = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag");
include('hvwtab.php');

$club = 122;
if (isset($_GET['club'])) {
  $club = $_GET['club'];
}

$hvw = new hvwtab('http://www.hvw-online.org/Spielbetrieb/?club=122&do='.$heute);

$spdatum = $heute;
$csvarr = split(chr(13), $hvw->CsvAll());
array_multisort($csvarr);

// print_r($csvarr);

if (strlen($hvw->CsvAll()) > 0) {

$inhalt = "<table>\n";
foreach ($csvarr as $zeile) {
    //$zeile = ereg_replace("\"", "", $zeile);
    $spiel = split(",", $zeile);
    if ($zeile != "") {
        $zusatzA = "";
        $zusatzB = "";

        if ((strlen(strstr($spiel[2],"F-BL"))>0) || (strlen(strstr($spiel[2],"M-"))>0)) {
          $zusatzA = "<strong>";
          $zusatzB = "</strong>";
        }

        $halle = array(1008 => "in Beilstein", 2064 => "in Gronau");
	      if ($spiel[4] == "1008" || $spiel[4] == "2064") {
          $heimspiel = $halle[$spiel[4]];          
	      } else {
          $heimspiel = $spiel[11];
        }

        if ($spdatum != $spiel[0]) {
    	    $inhalt .= "<tr><td colspan=\"6\"><strong>".$wtag[date("w", strtotime($spiel[0]))].", ".date("d.m.Y", strtotime($spiel[0]))."</strong></td></tr>\n";
        }
        
        $inhalt .= "<tr><td>".$spiel[1]." Uhr</td><td>".$zusatzA.$spiel[2].$zusatzB."</td><td>".$spiel[5]."</td><td>-</td><td>".$spiel[6]."</td><td>".$heimspiel."</td></tr>\n";
        $spdatum  = $spiel[0];
    }
}
$inhalt .= "</table>\n";

require_once("xmlrpc.inc");
$user = "Beule";
$pass = "mbtgvmb!";

$client = new xmlrpc_client ("/xmlrpc.php", "www.sg-bottwartal.de", 80);
$msg = new xmlrpcmsg ("metaWeblog.newPost");
$msg->addParam(new xmlrpcval(1, 'int'));
$msg->addParam(new xmlrpcval($user, 'string'));
$msg->addParam(new xmlrpcval($pass, 'string'));

$struct = new xmlrpcval (
	array (
		"title" => new xmlrpcval ('Spiele am Wochenende (KW'.date("W",strtotime($heute)).')', 'string' ),
		"description" => new xmlrpcval($inhalt, 'string'),
		"mt_allow_comments" => new xmlrpcval(0, 'int'),
		"mt_allow_pings" => new xmlrpcval(0, 'int')
	), "struct"
);

$msg->addParam($struct);
$msg->addParam(new xmlrpcval(1,'int'));

$ans = $client->send($msg);
} 
//print_r($ans);
//echo $inhalt;
echo "1";
?>
