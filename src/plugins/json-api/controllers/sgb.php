<?php
/*
Controller name: SGB
Controller description: SGB introspection methods
*/

class JSON_API_SGB_Controller {

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

    $ttl = 3600*24;
    $ttl = 1;
    $key = 'hvw_data';
    $hvw = $this->load_cache( $key, $ttl );
    if ( !$hvw ) {
      $hvw = $this->get_events_from_hvw();
      $this->save_cache( $events, $key );
    }
    $ttl = 3600;
    $ttl = 1;
    $key = 'wp_data';
    $sgb = $this->load_cache( $key, $ttl );
    if ( !$sgb ) {
      $sgb = $this->get_events_from_wp();
      $this->save_cache( $events, $key );
    }

    $events = array_merge($sgb['events'], $hvw['events']);

    return $events;
  }

  public function get_events() {
    $start = $_GET["start"];
    $end = $_GET["end"];

    if (!$start) $start=0;
    if (!$end) $end=9999999999;

    $key = 'from_'.$start.'_till_'.$end;

    $ttl = 600;
    $ttl = 1;
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
      $this->save_cache($events, $key);
      $cached = false;
    }

    return array( 'cached' => $cached, 'start' => $start , 'end' => $end, 'events' => $events );
  }
}

?>