<?php
/*
Template Name: Unterseiten verlinken
*/
/**
* The template for displaying an aggregatet view of subpages.
*
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
**/
get_header(); ?>
<div class="container site-content">
  <div class="row">
    <div class="span8">
      <div class="row">
        <?php
          $counter = 0;
          $child_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = ".$post->ID."    AND post_type = 'page' ORDER BY menu_order", 'OBJECT');    
          if ( $child_pages ) : foreach ( $child_pages as $pageChild ) : setup_postdata( $pageChild );
            $counter = $counter +1;
        ?>
          <div class="span4 centered">
            <?php 
              if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
                $image_id = get_post_thumbnail_id( $pageChild->ID );
                $url = wp_get_attachment_image_src($image_id,'large', true)[0];
              } else {
                $url = get_fallback_post_thumbnail( $pageChild->ID );
              } 
            ?>
            <a href="<?php echo  get_permalink($pageChild->ID); ?>" rel="bookmark" title="<?php echo $pageChild->post_title; ?>">
              <img src="<?php echo $url; ?>" alt="<?php echo the_title(); ?>" class="img-polaroid">
            </a>
            <h1>
              <a href="<?php echo  get_permalink($pageChild->ID); ?>" rel="bookmark" title="<?php echo $pageChild->post_title; ?>">
                <?php echo $pageChild->post_title; ?>
              </a>
            </h1>
          </div>
        <?php 
          if ($counter == 2 ) :
            echo '</div><hr class="divider"/><div class="row">';
            $counter = 0;
          endif;
          endforeach; 
          endif; 
          if ($counter != 0 ) :
            echo '</div>';
          endif; 
        ?>
    </div>
    <div class="offset1 span3">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>