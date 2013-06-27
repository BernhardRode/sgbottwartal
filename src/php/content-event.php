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
          $taxonomies=wp_get_post_terms($post->ID, 'termin_kategorie', array("fields" => "all"));
          foreach ($taxonomies as $tag) {
            echo '<span class="label label-important">'. $tag->name .'</span> ';
          }
          echo '<br/>';
          $meta = get_post_meta($post->ID,'meta');
          //print_r($meta);
          foreach ($meta as $key) {
            echo '<address>';
            if ( $key['begin'] ) {
              echo 'Anfang: '.$key['begin'].'<br/>';
            }
            if ( $key['end'] ) {
              echo 'Ende: '.$key['end'].'<br/>';
            }
            if ( $key['city'] || $key['street'] ) {
              echo 'Adresse: <i class="icon-map-marker"></i> '.$key['street'].', '. $key['city'];
              $address = $key['street'].', '. $key['city'] . ', Deutschland';
              ?>
              <?php the_excerpt( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sgb' ) ); ?>        
              <?php
            }
            echo '</address>';
          }
        ?>

        <div class="hidden-phone">
          <br/>
          <?php edit_post_link( __( '<i class="icon-edit"></i> Bearbeiten', 'sgb' ), '<br/><span class="edit-link">', '</span>' ); ?>
        </div>
      </div>
      <div class="span8"> 

        <div id="map-sponsor"></div>
        <div id="map" class="well" data-address="<?php echo urlencode($address); ?>" style="display:none;"></div>
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=places&sensor=true&language=de"></script> 
      </div><!-- .entry-content -->
    </div>
</div>

</article><!-- #post -->
