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
<?php echo $post->ID;?>
<?php
  $child_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = ".$post->ID."    AND post_type = 'page' ORDER BY menu_order", 'OBJECT');    
  if ( $child_pages ) : foreach ( $child_pages as $pageChild ) : setup_postdata( $pageChild ); 
?>
  <div class="child-thumb">
   <a href="<?php echo  get_permalink($pageChild->ID); ?>" rel="bookmark" title="<?php echo $pageChild->post_title; ?>">
      <?php echo get_the_post_thumbnail($pageChild->ID, 'single-post-thumbnail'); ?>
      <?php echo $pageChild->post_title; ?>
   </a>
  </div>
<?php 
  endforeach; 
  endif;     
  if ( $child_pages ) : foreach ( $child_pages as $pageChild ) : setup_postdata( $pageChild ); 
?>
  <div class="child-thumb">
   <a href="<?php echo  get_permalink($pageChild->ID); ?>" rel="bookmark" title="<?php echo $pageChild->post_title; ?>">
      <?php echo get_the_post_thumbnail($pageChild->ID, 'single-post-thumbnail'); ?>
      <?php echo $pageChild->post_title; ?>
   </a>
  </div>
<?php 
  endforeach; 
  endif; 
  
  get_footer(); 
?>