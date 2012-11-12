<?php
$debug = false;

header("Content-Type: text/html;charset=utf-8");
$heute = date("Y-m-d",strtotime("last Sunday"));
$wtag = array("Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag", "Sonntag");
include('hvwtab.php');

$club = 122;
if (isset($_GET['club'])) {
  $club = $_GET['club'];
}

$hvw = new hvwtab('http://www.hvw-online.org/Spielbetrieb/?club='.$club.'&do='.$heute);

$spdatum = $heute;
$csvarr = split(chr(13), $hvw->CsvAll());
//array_multisort($csvarr);

if (strlen($hvw->CsvAll()) > 0) {

$inhalt = "<table>\n";
foreach ($csvarr as $zeile) {
    $zeile = ereg_replace("\"", "", $zeile);
        $spiel = split(",", $zeile);
    if ($zeile != "") {
        $inhalt .= "<tr><td><strong>".$spiel[10]."</strong></td><td>".$spiel[5]."</td><td>-</td><td>".$spiel[6]."</td><td style=\"text-align: center;\">".$spiel[7].":".$spiel[8]."</td></tr>\n";
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
		"title" => new xmlrpcval ('Ergebnisse vom Wochenende (KW '.date("W",strtotime($heute)).')', 'string' ),
		"description" => new xmlrpcval($inhalt, 'string'),
		"mt_allow_comments" => new xmlrpcval(0, 'int'),
		"mt_allow_pings" => new xmlrpcval(0, 'int')
	), "struct"
);

$msg->addParam($struct);
$msg->addParam(new xmlrpcval(1,'int'));

if ($debug) {
    echo 'Ergebnisse vom Wochenende (KW '.date("W",strtotime($heute)).')'.$heute;
    echo $inhalt;
} else {
    $ans = $client->send($msg);
};
}
echo "1";
?>
