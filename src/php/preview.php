<?php 
  list($slug, $title) = explode( ':', get_the_title(), 2 ); 
  echo '<a href="'.get_permalink().'">';
  if ( $title == '' ) :
    echo $slug;
  else :
    echo $title.'<span class="label">'.$slug.'</span>';
  endif;
  echo '</a>'

?>