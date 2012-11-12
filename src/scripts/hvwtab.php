<?php
// ©Beulscho
// Stand 2010-08-03
//
// Einbinden wie folgt

// include('hvwtab.php');
// $hvw = new hvwtab('http://www.hvw-online.org/Spielbetrieb/?club=122');
// print_r($hvw->Csv());

class hvwtab {
    var $Url = '';
    Var $ArrInhalt;
    Var $Mannschaft = '';
    var $TeamUrl = '';
    
    function hvwtab($sUrl) {
      $this->Url = $sUrl;
    }
    
    // "YYYY-MM-DD";"HH:MM(Beginn)";"HH:MM(Ende)";"TITLE";Hallennummer;Ergbniss
    function Csv() {
      $f = @fopen ($this->Url, 'r');
      $text = '';
      
      if($f) {

          $MusterA = '/.*<tr class="r[u|g][g|e]"><td class="gal">.*/i';
          $MusterB = '<td[^<]*>(.*)<\/td>';
          
          // Erweitere Muster auf die richtig Spaltenanzahl
          for ($i = 0; $i <= 10; $i++) {
            $MusterC = $MusterC.$MusterB;
          }
          $MusterC = '/'.$MusterC.'/';

          while(!feof($f)) {
            $zeile = fgets($f, 4096);
            
            // Suche nach der Tabelle für die Spiele
            if(preg_match($MusterA, $zeile)) {
              // Teile die Zeilen der Tabelle nach Spalten
              if (preg_match($MusterC, $zeile, $ergb)){
                $this->ArrInhalt[] = $ergb;
                
                if ($ergb[1] != ' ') {
                  $this->Mannschaft = $this->fMannschaft($ergb[1]);
                }
                
                $ergb[4] = $this->fHalle($ergb[4]);
                $event = $this->Mannschaft.': '.$ergb[5].' - '.$ergb[7];
                if ($this->fDatum($ergb[3]) != '') {
                  $text .= '"'.$this->fDatum($ergb[3]).'","'.$this->fUhrzeit($ergb[3]).'","'.$this->fEndzeit($this->fUhrzeit($ergb[3])).'","'.$event.'",'.$ergb[4].',"'.$ergb[8].':'.$ergb[10].'"'.chr(13);
                };
              }
            }
          }
          fclose($f);
      }
      return $text;
    }

    // Staffel, Nr., Datum, Uhr, H-Nr., Heim, Gast, Ergebnis, Bem.
    function CsvAll() {
      $f = @fopen ($this->Url, 'r');
      $inhalt = '';
      
      if($f) {

          $MusterA = '/.*<tr class="r[u|g][g|e]"><td class="gal">.*/i';
          $MusterB = '<td[^<]*>(.*)<\/td>';
          
          // Erweitere Muster auf die richtig Spaltenanzahl
          for ($i = 0; $i <= 10; $i++) {
            $MusterC = $MusterC.$MusterB;
          }
          $MusterC = '/'.$MusterC.'/';

          while(!feof($f)) {
            $zeile = fgets($f, 4096);
            
            // Suche nach der Tabelle für die Spiele
            if(preg_match($MusterA, $zeile)) {
              // Teile die Zeilen der Tabelle nach Spalten
              if (preg_match($MusterC, $zeile, $ergb)){
                $this->ArrInhalt[] = $ergb;
                
                // Wenn gleiche Staffel, wie die letzte Mannschaft, dann ...
                if ($ergb[1] != ' ') {
                  $this->Mannschaft = $this->fMannschaft($ergb[1]);
                  $this->TeamUrl = $ergb[1];
                }
                
                // Wenn die Mannschaft ein Spiel hat, dann ...
                if ($this->fDatum($ergb[3]) != '') {

                    $inhalt .= $this->fDatum($ergb[3]).",";
                    $inhalt .= $this->fUhrzeit($ergb[3]).",";
                    $inhalt .= $this->Mannschaft.",";
                    $inhalt .= $this->fRemLink($ergb[2]).",";
                    $inhalt .= $this->fRemLink($ergb[4]).",";
                    $inhalt .= $this->fRemLink($ergb[5]).",";
                    $inhalt .= $this->fRemLink($ergb[7]).",";
                    $inhalt .= $this->fRemLink($ergb[8]).",";
                    $inhalt .= $this->fRemLink($ergb[10]).",";
                    $inhalt .= $this->fRemLink($ergb[11]).",";
                    $inhalt .= ereg_replace("href=\"", "href=\"http://www.hvw-online.org/Spielbetrieb/",$this->TeamUrl).",";
                    $inhalt .= ereg_replace("href=\"", "href=\"http://www.hvw-online.org/Spielbetrieb/",$ergb[4]).chr(13);
                }
              }
            }
          }
          fclose($f);
      }
      return $inhalt;
    }

    function fDatum($text) {
      if(preg_match('/.*([0-9]{2})\.([0-9]{2})\.([0-9]{2}).*/i',$text, $ergb)) {
        return '20'.$ergb[3].'-'.$ergb[2].'-'.$ergb[1];
      } else {
        return '';
      }
    }

    function fUhrzeit($text) {
      if(preg_match('/.*([0-9]{2}):([0-9]{2})h.*/i',$text, $ergb)) {
        return $ergb[1].':'.$ergb[2];
      } else {
        return '';
      }
    }
    
    function fEndzeit($text) {
      $uhrzeit = strtotime($text)+3600;
      return date("H:i", $uhrzeit);
    }
    
    function fMannschaft($text) {
      if(preg_match('/<a.*>([^<>]*)<\/a>/i',$text, $ergb)) {
        return $ergb[1];
      } else {
        return '';
      }
    
    }
    
    function fHalle($text) {
      if(preg_match('/<a.*>([^<>]*)<\/a>/i',$text, $ergb)) {
        return $ergb[1];
      } else {
        return '';
      }
    
    }
    
       function fRemLink($text) {
      if(preg_match('/<a.*>([^<>]*)<\/a>/i',$text, $ergb)) {
        return $ergb[1];
      } else {
        return $text;
      }
    
    }

}

?>