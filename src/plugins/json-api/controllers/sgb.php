<?php
/*
Controller name: SGB
Controller description: SGB introspection methods
*/

class JSON_API_SGB_Controller {
  public function get_events() {
    $start = $_GET["start"];
    $end = $_GET["end"];

    if (!$start) $start=0;
    if (!$end) $end=99999999999;

    $args = array( 'post_type' => 'event' );
    $loop = new WP_Query( $args );

    $events = array();
    $tmp = array();
    while ( $loop->have_posts() ) : $loop->the_post();
      $allday = false;
      $meta  = get_post_meta(get_the_ID(),'meta');
      $evt_start = '';
      $evt_end = '';

      if ($meta[0]['begin']) $evt_start = new DateTime($meta[0]['begin']);
      if ($meta[0]['end']) $evt_end = new DateTime($meta[0]['end']);


      if (!$evt_end) {
        $evt_end = $evt_start;
        $allday = true;
      }
      //if ($evt_end) $evt_end = $evt_start;

      if ($allday) {
        $time_start = date('Y-m-d',$evt_start->getTimestamp());
      } else {
        $time_start = date('Y-m-d H:m',$evt_start->getTimestamp());
        $time_end = date('Y-m-d H:m',$evt_end->getTimestamp());
      }

      $tmp = array();
      $tmp['id'] = intval( get_the_ID() );
      $tmp['title'] = get_the_title();
      $tmp['start'] = $time_start;
      if ($allday) {
        $tmp['allDay'] = $allday;
      } else {
        $tmp['end'] = $time_end;
      }

      if ( $evt_start->getTimestamp() >= $start && $evt_start->getTimestamp() <= $end ) {
        array_push($events, $tmp); 
      }
    endwhile;

    $string = file_get_contents("wp-content/plugins/json-api/controllers/spielplan.json");
    $json   = json_decode($string,true);

    foreach ( $json as $game) :

      $game_start = new DateTime( $game['datetime']['date']);

      if ( $game_start->getTimestamp() >= $start && $game_start->getTimestamp() <= $end ) {
        $tmp = array();
        $year = date('Y');
        $month = date('m');
        $tmp['id'] = intval( $game['Nummer'] );
        $tmp['title'] = $game['Heim'] . ' - ' . $game['Gast'];
        $tmp['start'] = $game_start->getTimestamp();
        $tmp['end'] = $game_start->getTimestamp()+3600;
        $tmp['allDay'] = false;


        array_push($events, $tmp); 
      }
    endforeach;

    return array($events);
  }
}

?>