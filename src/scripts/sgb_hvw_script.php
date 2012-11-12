<?php
include('hvwtab.php');

function pretty_json($json) {
  $result      = '';
  $pos         = 0;
  $strLen      = strlen($json);
  $indentStr   = '  ';
  $newLine     = "\n";
  $prevChar    = '';
  $outOfQuotes = true;
  for ($i=0; $i<=$strLen; $i++) {
      $char = substr($json, $i, 1);
      if ($char == '"' && $prevChar != '\\') {
          $outOfQuotes = !$outOfQuotes;
      } else if(($char == '}' || $char == ']') && $outOfQuotes) {
          $result .= $newLine;
          $pos --;
          for ($j=0; $j<$pos; $j++) {
              $result .= $indentStr;
          }
      }
      $result .= $char;
      if (($char == ',' || $char == '{' || $char == '[') && $outOfQuotes) {
          $result .= $newLine;
          if ($char == '{' || $char == '[') {
              $pos ++;
          }
          
          for ($j = 0; $j < $pos; $j++) {
              $result .= $indentStr;
          }
      }    
      $prevChar = $char;
  }
  return $result;
}

function decompress_first_file_from_zip($ZIPContentStr){ 
	if(strlen($ZIPContentStr)<102){ 
		printf('error: input data too short<br />\n'); 
		return ''; 
	} 
	$CompressedSize=binstrtonum(substr($ZIPContentStr,18,4)); 
	$UncompressedSize=binstrtonum(substr($ZIPContentStr,22,4)); 
	$FileNameLen=binstrtonum(substr($ZIPContentStr,26,2)); 
	$ExtraFieldLen=binstrtonum(substr($ZIPContentStr,28,2)); 
	$Offs=30+$FileNameLen+$ExtraFieldLen; 
	$ZIPData=substr($ZIPContentStr,$Offs,$CompressedSize); 
	$Data=gzinflate($ZIPData); 
	if(strlen($Data)!=$UncompressedSize){ 
		printf('error: uncompressed data have wrong size<br />\n'); 
		return ''; 
	} 
	else return $Data; 
}
function binstrtonum($Str){ 
	$Num=0; 
	for($TC1=strlen($Str)-1;$TC1>=0;$TC1--){ //go from most significant byte 
		$Num<<=8; //shift to left by one byte (8 bits) 
		$Num|=ord($Str[$TC1]); //add new byte 
	} 
	return $Num; 
}
function csv_to_array($input, $delimiter=';') { 
	$header = null; 
	$data = array(); 
	$csvData = str_getcsv($input, "\n");

	foreach($csvData as $csvLine){
		$csvLine = str_replace('"', '', $csvLine);
		if ( is_null($header) )  {
			$header = explode( $delimiter, $csvLine );
		} else {
			$items = explode( $delimiter, $csvLine ); 
			for($n = 0, $m = count($header); $n < $m; $n++){ 
				$prepareData[$header[$n]] = htmlentities( $items[$n] ); 
				//$prepareData[$header[$n]] = $items[$n]; 
			}
			$data[] = $prepareData; 
		}
	}
	return $data; 
}
function create_datetime($hvw_datum,$hvw_zeit) {
	$hvw_datum = explode('.', $hvw_datum); 
	$hvw_zeit = explode(':', $hvw_zeit); 
	$tz_string = 'Europe/Berlin';
	date_default_timezone_set($tz_string);
	$datetime = new DateTime();
	$datetime->setDate('20'.$hvw_datum[2], $hvw_datum[1], $hvw_datum[0]);
	$datetime->setTime($hvw_zeit[0], $hvw_zeit[1], 0);
	return $datetime;
}

function get_tags_by_hvw_staffel($staffel) {
	$tags = array();
	$classes = array(
		'M' => 'herren',
		'M40' => 'ah',
		'F' => 'damen',
		'F30' => 'ad',
		'mJA' => 'ma',
		'mJB' => 'mb',
		'mJC' => 'mc',
		'mJD' => 'md',
		'mJE' => 'me',
		'wJA' => 'wa',
		'wJB' => 'wb',
		'wJC' => 'wc',
		'wJD' => 'wd',
		'wJE' => 'we',
		'gJD' => 'd',
		'gJE' => 'e',
		'Minis' => 'minis',
	);
	$leagues = array(
		'3.Liga' => '3. Liga',
		'JBLH' => 'Jugend Bundesliga',
		'BWOL' => 'Baden-Württemberg Oberliga',
		'WL' => 'Württembergliga',
		'LL' => 'Landesliga',
		'BL' => 'Bezirksliga',
		'BK' => 'Bezirksklasse',
		'KLA' => 'Kreisliga A',
		'KLB' => 'Kreisliga B',
		'KLC' => 'Kreisliga C',
		'KLD' => 'Kreisliga D',
		'Pok' => 'Pokal',
		'1' => '',
		'3' => '',
		'4' => '',
		'5' => ''
	);

	$staffel = explode('-',$staffel);

	array_push($tags,$classes[$staffel[0]]);
	array_push($tags,$leagues[$staffel[1]]);
	array_push($tags,'Spiel');

	return $tags;
}


function get_page_as_string($url, $fields) {
// cURL Setup and Fields
foreach($fields as $key=>$value) { 
  $fields_string .= $key.'='.$value.'&'; 
}
rtrim($fields_string, '&');
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, count($fields));
curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_ENCODING, 'zip'); 
$data = curl_exec($ch);
curl_close($ch);
// cURL Setup and Fields
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$data = curl_exec($ch);
curl_close($ch);
// Convert the File to UTF-8
if( mb_detect_encoding($csv, 'auto') != 'UTF-8' ) {
  $csv = utf8_encode($csv);
}
// Read the data into an array
return $data;
}

function get_hvw_data($url, $fields) {
	// cURL Setup and Fields
	foreach($fields as $key=>$value) { 
		$fields_string .= $key.'='.$value.'&'; 
	}
	rtrim($fields_string, '&');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_POST, count($fields));
	curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_ENCODING, 'zip'); 
	$data = curl_exec($ch);
	curl_close($ch);
	// Uncompress the first Item from the retrieved File
	$csv = decompress_first_file_from_zip($data);
	// Convert the File to UTF-8
	if( mb_detect_encoding($csv, 'auto') != 'UTF-8' ) {
		echo 'Converting String';
		$csv = utf8_encode($csv);
	}
	// Read the data into an array
	$array = csv_to_array($csv);

	// Cleanup some Values
	foreach ($array as $k => $i) {
		$array[$k]['datetime'] = create_datetime($i['Datum'],$i['Zeit']);
		$array[$k]['tags'] = get_tags_by_hvw_staffel($i['Staffel']);

		if ( $i['Hallennummer'] == 1008 || $i['Hallennummer'] == 2046 ) {
			array_push( $array[$k]['tags'], 'Heimspiel' );
		} else {
		array_push( $array[$k]['tags'], 'Auswärtsspiel' );
		}
		$array[$k]['Haftmittel'] =  $array[$k]['Haftmittel?'].'.';

		unset($array[$k]['Datum']);
		unset($array[$k]['Zeit']);
		unset($array[$k]['Staffel']);
		unset($array[$k]['Haftmittel?']);
	}
	return $array;
}

function output_string_to_file($data, $file) {
  file_put_contents($file,$data);
}

function output_json_to_file($data, $file) {
  $json = json_encode($data);
  file_put_contents($file,$json);
}

function read_json_from_file($file) {
  $data = file_get_contents( $file );
  return json_decode($data,true);
}

function create_calendar( $name, $data ) {
	$ics  = "BEGIN:VCALENDAR"."\n";
	$ics .= "METHOD:PUBLISH"."\n";
	$ics .= "VERSION:2.0"."\n";
	$ics .= "X-WR-TIMEZONE:Europe/Berlin"."\n";
	$ics .= "X-WR-CALNAME:".$name.""."\n";
	$ics .= "PRODID:-//SGBottwartal/TermineUndEvents//NONSGML v1.0//EN"."\n";
	$ics .= "X-APPLE-CALENDAR-COLOR:#BAADBB"."\n";

	foreach ($data as $event) {

		$leage_url = 'http://www.hvw-online.org/?A=g_class&id=39&orgID=3&score=14609';
		$arena_url = 'http://www.hvw-online.org/?A=gym&id=39&orgID=3&gymID=73';

		$summary = $event['Heim'] . ' - ' . $event['Gast'] . ' ('.$event['tags'][0].' '.$event['tags'][1].')';
		$description = $event['tags'][1].'\n'.$event['Hallenname'].'\n'.$event['Telefon'].'\n'.'\n'.$event['Haftmittel'];
		$location = $event['Hallenname'].' '.$event['Plz'].' '.$event['Ort'].' '.$event['Strasse'];
		$url = 'http://sg-bottwartal.de';

		//Create Events
		$date = $event['datetime'];
		$dtstart = $date;
		$dtend = $date;
		$dtend = $date->modify('+2 hours');
		
		//echo $dtstart->format('H:i:s') . '-' . $dtend->format('H:i:s');

		$ics .= "BEGIN:VEVENT"."\n";
		$ics .= "UID:". md5(uniqid(mt_rand(), true)) ."@sgbottwartal.de"."\n";
		$ics .= "DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z"."\n";
		$ics .= "DTSTART;TZID=Europe/Berlin:".$dtstart->format('Ymd')."T".$dtstart->format('His')."\n";
		//$ics .= "DTEND;TZID=Europe/Berlin:".$dtend->format('Ymd')."T".$dtend->format('His').""."\n";
		$ics .= "LOCATION:".str_replace("\n", "\\n", $location)."\n";
		$ics .= "SUMMARY:".str_replace("\n", "\\n", $summary)."\n";
		$ics .= "DESCRIPTION:".str_replace("\n", "\\n", $description)."\n";
		$ics .= "URL;VALUE=URI:".$url."\n";
		$ics .= "END:VEVENT"."\n";

	}
	$ics .= "END:VCALENDAR";
	return clean_umlauts($ics);
}

function clean_umlauts($string) {
	$string = str_replace('&auml;', 'ä', $string);
	$string = str_replace('&Auml;', 'Ä', $string);
	$string = str_replace('&uuml;', 'ü', $string);
	$string = str_replace('&Uuml;', 'Ü', $string);
	$string = str_replace('&ouml;', 'ö', $string);
	$string = str_replace('&Ouml;', 'Ö', $string);
	$string = str_replace('&szlig;', 'ß', $string);
	return $string;
}


function hvw_csv_load() {
	//set POST variables
	$calendar_name = 'SG Bottwartal';
	$file = 'spielplan.json';
	$ics_file  = 'spielplan.ics';
  $url  = 'http://www.hvw-online.org/Spielbetrieb/mannschaftsspielplaene.php';
	$fields = array(
		'm' => 16,
		'club' => 0,
		'clubno' => 122,
		'own' => 1,
		'lgym' => 1,
		'onefile' => 1,
		'hvwsubmit' => 'dw',
		'nm' => 0
	);
	return get_hvw_data($url, $fields);
}


function hvw_weekly_overview() {
	$file = 'weekly.html';
	$url  = 'http://www.hvw-online.org/Spielbetrieb/?club=122';
	$fields = array(
	  'id' => 39,
	  'orgN' => 'DHB;ARGE;HVW;HF;EM;RS;ET;ST;AN;NZ;BD',
	  'A' => 'g_club',
	  'club' => 122,
	  'hvwsubmit' => 'club',
	  'submit' => 'Los',
	  'hvwsubmit' => 'dw',
	  'nm' => 0
	);
	include 'phpQuery-onefile.php';
	$html = get_page_as_string($url,$fields);
	//output_string_to_file($html,$file);
	//$content = file_get_contents($file);
	phpQuery::newDocument($content);
	$tr = array();
	//$gametable = pq('.gametable > tr > td');
	$games = array();
	foreach (pq('.gametable > tr') as $row) {
		$counter=0;
		$game = array();
		$staffel_last = '';
		foreach (pq('td',$row) as $cell) {
			$value = pq('',$cell)->text();
			switch ($counter) {
				case 0:
					if ( $value == ' ') {
						$staffel = $staffel; 
					} else {
						$staffel = $value; 
					}
					$game['staffel']=$staffel;
					break;
				case 1:
					$game['spiel_nr']=$value;
					break;
				case 2:
					if ( $value != ' ') {
						list($wochentag,$datum,$zeit) = explode(', ',$value);
						list($tag,$monat,$jahr) = explode('.',$datum);
						$jahr = '20'.$jahr;
						$zeit = str_replace('h', '', $zeit);
						list($stunde,$minute) = explode(':',$zeit);
						$date_string = $jahr.'-'.$monat.'-'.$tag.' '.$stunde.':'.$minute.':00';
						$date = new DateTime( $date_string );
						$game['datetime']=$date;
					}
					break;
				case 3:
					$game['halle_nr']=$value;
					break;
				case 4:
					$game['heim']=$value;
					break;
				case 6:
					$game['gast']=$value;
					break;
				case 7:
					$game['ergebnis_heim']=$value;
					break;
				case 9:
					$game['ergebnis_gast']=$value;
					break;
				case 0:
					$game['bemerkung']=$value;
					break;
			}
			$counter++;
		}
		if ($game['spiel_nr'] != '' && $game['spiel_nr'] != ' ' ) {
			array_push($games, $game);
		}
	}
	array_shift($games);
	return $games;
}

date_default_timezone_set( 'Europe/Berlin' );
$data = hvw_weekly_overview();
output_json_to_file($data,'../../data/overview.json');
$data = hvw_csv_load();
output_json_to_file($data,'../../data/calendar.json');
$calendar = create_calendar('SG Bottwartal',$data);
output_string_to_file($calendar,'../../data/calendar.ics');

?>