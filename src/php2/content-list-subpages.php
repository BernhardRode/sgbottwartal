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
  <div class="row">
    <div class="span12">
      <h1 class="page-title">Verein. <small>mehr als nur ein Sportverein</small></h1>
    </div>
  </div>
  <section>
    <div class="row">
      <div class="span12">
        <?php get_template_part( 'content', 'page' ); ?>
      </div>
    </div>
  </section>
  <?php
    $child_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = ".$post->ID." AND post_status = 'publish' AND post_type = 'page' ORDER BY menu_order", 'OBJECT');    
  ?>
  <?php if ( $child_pages ) : foreach ( $child_pages as $pageChild ) : setup_postdata( $pageChild ); ?>
    <section id="section-<?php echo $pageChild->ID; ?>">
      <a name="#section-<?php echo $pageChild->ID; ?>"></a>
        <h2><?php echo $pageChild->post_title; ?></h2>
        <?php echo the_content(); ?>
    </section>
  <?php endforeach; endif; ?>    
</div>
<?php get_footer(); ?>