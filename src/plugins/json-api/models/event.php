<?php

class JSON_API_Event {
  
  var $id;          // Integer
  var $title;       // String
  var $description; // String
  var $url;         // String
  var $city;        // String
  var $street;      // String
  var $created;     // Date
  var $start;       // Date
  var $end;      		// Date
  var $allday;      // Boolean
  var $multiday;    // Boolean
  var $terms;       // Array of Strings

  
  function JSON_API_Event($id = null) {

  } 

  function event_from_hvw($game) {
    $this->id             = 'HVW'.$game['Nummer'];
    $this->title          = $game['Heim'] . ' - ' . $game['Gast'];
    $this->excerpt        = '<h1>'.$game['Hallenname'].' ('.$game['Hallennummer'].')</h1><p>'.$game['Haftmittel'].'</p><p>'.$game['Telefon'].'</p>';
    $this->street         = $game['Strasse'];
    $this->city           = $game['Plz'] . ' ' . $game['Ort'];
    $this->start          = $game['datetime']->getTimestamp();
    $this->end            = $game['datetime']->getTimestamp()+3600;
    $this->created        = date_timestamp_get( new DateTime() );
    // $this->url            = $game->meta['url'];
    // $this->allday         = false;
    // $this->multiday       = false;
    $this->terms          = $game['tags'];

    return $this;
  }

  function event_from_wp_post($post) {

    if ( is_null( $post->meta['end'] ) ) $post->meta['end'] = $post->meta['begin'];

    $this->id             = 'SGB'.$post->id;
    $this->title          = $post->title;
    #$this->excerpt        = preg_replace('~[\r\n]+~', '', strip_tags( $post->content ) );
    $this->excerpt        = $post->content;
    $this->street         = $post->meta['street'];
    $this->city           = $post->meta['city'];
    $this->start          = strtotime( $post->meta['begin'] );
    $this->end            = strtotime( $post->meta['end'] );
    $this->created        = strtotime( $post->date );
    $this->url            = $post->meta['url'];
    $this->allday         = false;
    $this->multiday       = false;
    $this->terms          = [];
    #$this->original       = $post;

    if ( date('H:i', $this->start) == '00:00' ) {
      $this->allday = true;
      if ( $this->start != $this->end ) $this->multiday = true;
    }

    foreach ($post->terms as $key => $value) {
      array_push( $this->terms, $value->name );
    }
    
    return $this;
  }

}