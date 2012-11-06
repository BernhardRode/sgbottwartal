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
    <div class="span9">
      <div class="row">
        <?php
          $counter = 0;
          $child_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = ".$post->ID." AND post_status = 'publish' AND post_type = 'page' ORDER BY menu_order", 'OBJECT');    
          if ( $child_pages ) : foreach ( $child_pages as $pageChild ) : setup_postdata( $pageChild );
            $counter = $counter +1;
        ?>
          <div class="span3" style="text-align:center;">
            <?php 
              if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
                $image_id = get_post_thumbnail_id( $pageChild->ID );
                $url = wp_get_attachment_image_src($image_id,'post-thumbnail', true)[0];
              } else {
                $url = get_fallback_post_thumbnail( $pageChild->ID );
              } 
            ?>
            <a href="<?php echo  get_permalink($pageChild->ID); ?>" rel="bookmark" title="<?php echo $pageChild->post_title; ?>">
              <img src="<?php echo $url; ?>" alt="<?php echo the_title(); ?>" class="img-circle img-shadow">
            </a>
            <h3>
              <a href="<?php echo  get_permalink($pageChild->ID); ?>" rel="bookmark" title="<?php echo $pageChild->post_title; ?>">
                <?php echo $pageChild->post_title; ?>
              </a>
            </h3>
          </div>
        <?php 
          if ($counter == 3 ) :
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
    <div class="span3">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>