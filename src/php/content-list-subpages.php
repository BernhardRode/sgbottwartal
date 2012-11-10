<?php
/*
Template Name: Unterseiten einbetten
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
    <?php
      $child_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = ".$post->ID." AND post_status = 'publish' AND post_type = 'page' ORDER BY menu_order", 'OBJECT');    
    ?>
    <?php if ( $child_pages ) : foreach ( $child_pages as $pageChild ) : setup_postdata( $pageChild ); ?>
    <section id="section-<?php echo $pageChild->ID; ?>">
      <div class="row">
        <div class="span3">
          <a name="#section-<?php echo $pageChild->ID; ?>"></a>
          <h1 class="muted"><?php echo $pageChild->post_title; ?></h1>        
        </div>
        <div class="span9">
          <?php echo the_content(); ?>

          <?php echo do_shortcode( '[gallery]' ); ?>
        </div>   
      </div>
    </section>
    <?php endforeach; endif; ?>
</div>
<?php get_footer(); ?>