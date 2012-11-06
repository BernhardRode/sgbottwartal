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
<?php
  $child_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = ".$post->ID." AND post_status = 'publish' AND post_type = 'page' ORDER BY menu_order", 'OBJECT');    
?>
<div class="container site-content">
  <div class="row">
    <div class="span3">
      <ul class="nav nav-list sidenav affix">
        <?php if ( $child_pages ) : foreach ( $child_pages as $pageChild ) : setup_postdata( $pageChild ); ?>
          <li><a href="#section-<?php echo $pageChild->ID; ?>"><i class="icon-chevron-right"></i> <?php echo $pageChild->post_title; ?></a></li>
        <?php endforeach; endif; ?>          
      </ul>
    </div>
    <div class="span9">
      <section class="hero">
        <h1><? echo $post->post_title; ?></h1>
        <p><? echo $post->post_content; ?></p>
      </section>
      <?php if ( $child_pages ) : foreach ( $child_pages as $pageChild ) : setup_postdata( $pageChild ); ?>
        <section id="section-<?php echo $pageChild->ID; ?>">
          <div class="page-header">
            <h2><?php echo $pageChild->post_title; ?></h2>
          </div>
          <p class="lead">
            <?php echo get_the_post_thumbnail($pageChild->ID, 'single-post-thumbnail'); ?>
            <?php echo the_content(); ?>
          </p>
        </section>
      <?php endforeach; endif; ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>