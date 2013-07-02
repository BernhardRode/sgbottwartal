<?php
/*
Controller name: SGB
Controller description: SGB introspection methods
*/

include("json_api_event.php");
include("json_api_hvw.php");
// include("json_api_sgb.php");

class json_api_sgb_controller {

  public function save_cache($data, $key) {
    $key = md5($key);
    $data = serialize($data);
    file_put_contents(getcwd().'/wp-content/cache/'.$key, $data);
  }

  public function load_cache($key, $expire) {
    $key = md5($key);
    $path = getcwd().'/wp-content/cache/'.$key;
    if(time() < (filemtime($path) + $expire)) {
        return unserialize(file_get_contents($path));
    }
    unlink($path);
    return false;
  }


  public function clean_umlauts($string) {
    $tmp = $string;
    #$string = utf8_decode($string);
    #$string = htmlentities($string);
    $string = str_replace("Ã¶","ö",$string);
    $string = str_replace("Ã¼","ü",$string);
    $string = str_replace("Ã","Ä",$string);
    $string = str_replace("Ã","Ö",$string);
    $string = str_replace("Ã","Ü",$string);
    $string = str_replace("Ã","ß",$string);
    $string = str_replace("\u00fc","ü",$string);
    $string = str_replace("\u00e4","ä",$string);
    $string = str_replace("\u00f6","ö",$string);
    $string = str_replace("\u00dc","Ü",$string);
    $string = str_replace("\u00d6","Ö",$string);
    $string = str_replace("\u00c4","Ä",$string);
    $string = str_replace("\u00df","ß",$string);
    $string = str_replace('&auml;', 'ä', $string);
    $string = str_replace('&Auml;', 'Ä', $string);
    $string = str_replace('&uuml;', 'ü', $string);
    $string = str_replace('&Uuml;', 'Ü', $string);
    $string = str_replace('&ouml;', 'ö', $string);
    $string = str_replace('&Ouml;', 'Ö', $string);
    $string = str_replace('&szlig;', 'ß', $string);
    return $string;
  }

  public function create_ical_from_events_by_tag($events,$tag='Komplett') {

    $title = 'SG Bottwartal';
    if ($tag != 'Komplett') $title = $title . ' - ' . $tag;

    $ics  = "BEGIN:VCALENDAR"."\n";
    $ics .= "METHOD:PUBLISH"."\n";
    $ics .= "VERSION:2.0"."\n";
    $ics .= "X-WR-TIMEZONE:Europe/Berlin"."\n";
    $ics .= "X-WR-CALNAME:".$title. "\n";
    $ics .= "PRODID:-//SGBottwartal/TermineUndEvents//NONSGML v1.0//EN"."\n";
    $ics .= "X-APPLE-CALENDAR-COLOR:#BAADBB"."\n";

    foreach ($events as $event) {
      if ( $event->tags[0] == $tag || $tag == 'Komplett' ) {
        #$leage_url = 'http://www.hvw-online.org/?A=g_class&id=39&orgID=3&score=14609';
        #$arena_url = 'http://www.hvw-online.org/?A=gym&id=39&orgID=3&gymID=73';

        $ics .= "BEGIN:VEVENT"."\n";
        $ics .= "UID:". md5($event->id)."\n";
        $ics .= "DTSTAMP:" . gmdate('Ymd').'T'. gmdate('His') . "Z"."\n";
        $ics .= "DTSTART;TZID=Europe/Berlin:".date('Ymd',$event->start)."T".date('His',$event->start)."\n";
        $ics .= "DTEND;TZID=Europe/Berlin:".date('Ymd',$event->end)."T".date('His',$event->end)."\n";
        $ics .= "LOCATION:".$this->clean_umlauts( $event->street.', '.$event->city ) ."\n";
        $ics .= "SUMMARY:".$this->clean_umlauts( $event->title ) ."\n";
        $ics .= "DESCRIPTION:". strip_tags( $event->excerpt ) ."\n";
        $ics .= "URL;VALUE=URI:".$event->url."\n";
        $ics .= "END:VEVENT"."\n";
      }
    }
    $ics .= "END:VCALENDAR";

    #$data = serialize($ics);
    $filename = str_replace(" ", "", $title );
    $filename = trim( $filename );
    $filename = strtolower( $filename );
    $filename = $filename.'.ics';

    file_put_contents(getcwd().'/wp-content/cache/'.$filename, $ics);
    return $ics;
  }

  public function get_events_from_wp() {
    global $json_api;
    $pages = array();
    $events = array();

    $wp_posts = get_posts(array(
      'post_type' => 'event',
      'status' => 'publish',
      'numberposts' => -1
    ));
    foreach ($wp_posts as $wp_post) {
      $pages[] = new JSON_API_Post($wp_post);
    }
    foreach ($pages as $page) {
      $terms = wp_get_post_terms($page->id);
      $page->terms = $terms;

      $meta  = get_post_meta($page->id,'meta',true);
      $page->meta = $meta;
      $event = new JSON_API_Event();
      array_push( $events, $event->event_from_wp_post($page) );
    }
    return array(
      'results' => count( $events ),
      'events' => $events
    );
  }

  public function get_events_from_hvw() {
    global $json_api;


    $events = array();

    $games = new JSON_API_HVW();
    $games = $games->getCSVfromHVW();

    foreach ($games as $game) {
      $event = new JSON_API_Event();
      array_push( $events, $event->event_from_hvw($game) );
    }

    return array(
      'results' => count( $events ),
      'events' => $events
    );
  }

  public function update_events() {
    global $json_api;
    $debug = false;
    $ttl = 3600*24*7;
    if ($debug) $ttl = 1;
    $key = 'hvw_data';
    $hvw = $this->load_cache( $key, $ttl );
    if ( !$hvw ) {
      $hvw = $this->get_events_from_hvw();
      $this->save_cache( $events, $key );
    }
    $ttl = 3600;
    if ($debug) $ttl = 1;
    $key = 'wp_data';
    $sgb = $this->load_cache( $key, $ttl );
    if ( !$sgb ) {
      $sgb = $this->get_events_from_wp();
      $this->save_cache( $events, $key );
    }

    $events = array_merge($sgb['events'], $hvw['events']);

    return $events;
  }

  public function get_ical() {
    $events = $this->get_events_from_hvw();
    $this->create_ical_from_events_by_tag( $events );
    return array( $events );
  }

  public function get_events() {
    $start = $_GET["start"];
    $end = $_GET["end"];
    $debug = false;
    if (!$start) $start=0;
    if (!$end) $end=9999999999;

    $key = 'from_'.$start.'_till_'.$end;

    $ttl = 3600;
    if ($debug) $ttl = 1;

    $events = $this->load_cache($key, $ttl);
    $cached = true;
    if ( !$events ) {
      $all_events = $this->update_events();
      $events = array();
      foreach ($all_events as $value) {
        if ( $value->start >= $start && $value->end <= $end ) {
          array_push( $events, $value );
        }
      }
      $this->create_ical_from_events_by_tag( $all_events );

      $this->save_cache($events, $key);
      $cached = false;
    }
    header('Content-Type: text/plain; charset=utf-8'); // plain text file
    return array( 'cached' => $cached, 'start' => $start , 'end' => $end, 'events' => $events );
  }
}

?>