<?php
/**
* The default template for displaying content. Used for both single and index/archive/search.
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
**/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<div class="row">
      <div class="span4">
        <?php 
          $large = sgb_thumbnail('large');
        ?>
        <img src="<?php echo $large; ?>" alt="<?php echo the_title(); ?>" class="img-polaroid">
        <div class="hidden-phone">
          <br/>
          <?php edit_post_link( __( '<i class="icon-edit"></i> Bearbeiten', 'sgb' ), '<br/><span class="edit-link">', '</span>' ); ?>
        </div>
      </div>
      <div class="span8"> 
        <?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sgb' ) ); ?>
        <?php

          $taxonomies=wp_get_post_terms($post->ID, 'sponsoren_kategorie', array("fields" => "all"));
          foreach ($taxonomies as $tag) {
            echo '<span class="label label-important">'. $tag->name .'</span> ';
          }
          echo '<br/>';
          $meta = get_post_meta($post->ID,'meta');
          foreach ($meta as $key) {
            echo '<address>';
            if ( $key['url'] ) {
              echo 'Webseite: <a href="'.$key['url'].'" title="Webseite: '.get_the_title().'" target="_blank"><i class="icon-external-link"></i> '.$key['url'].'</a><br/>';
            }
            if ( $key['email'] ) {
              echo 'E-Mail: <a href="mailto:'.$key['email'].'" title="Mail an '.$key['email'].'"><i class="icon-envelope"></i> '.$key['email'].'</a><br/>';
            }
            if ( $key['phone'] ) {
              echo 'Telefon: <a href="tel:'.$key['phone'].'" title="Anrufen '.$key['email'].'"><i class="icon-phone"></i> '.$key['phone'].'</a><br/>';
            }
            if ( $key['city'] && $key['street'] ) {
              echo 'Adresse: <i class="icon-map-marker"></i> '.$key['street'].', '. $key['city'];
              $address = $key['street'].', '. $key['city'] . ', Deutschland';
              #$geoCodeURL = "http://nominatim.openstreetmap.org/search?format=json&limit=1&addressdetails=0&q=".urlencode($address);
              #$geoCodeURL = "http://maps.google.com/maps/api/geocode/json?address=".urlencode($address)."&sensor=false";
              #$result = json_decode(file_get_contents($geoCodeURL), true);
              #$lat = $result["results"][0]["geometry"]["location"]["lat"];
              #$lng = <?php echo $result["results"][0]["geometry"]["location"]["lng"];
              ?>
                <hr/>
                <div id="map" class="well" data-address="<?php echo urlencode($address); ?>" style="display:none;"></div>
                <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=de"></script>            
              <?php
            }
            echo '</address>';
          }
        ?>
      </div><!-- .entry-content -->
    </div>
</div>

</article><!-- #post -->
