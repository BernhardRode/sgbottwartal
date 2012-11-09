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
    <div class="span12">
      <h1><?php echo the_title(); ?></h1>
      <?php
        $child_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = ".$post->ID." AND post_status = 'publish' AND post_type = 'page' ORDER BY menu_order", 'OBJECT');    
      ?>
      <?php if ( $child_pages ) : foreach ( $child_pages as $child_page ) : setup_postdata( $child_page ); ?>
        <section id="section-<?php echo $child_page->ID; ?>">
          <a name="#section-<?php echo $child_page->ID; ?>"></a>
          <h2><?php echo get_the_title($child_page->ID); ?></h2>
          <?php echo $child_page->post_content; ?>
          <?php
            $child_child_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = ".$child_page->ID." AND post_status = 'publish' AND post_type = 'page' ORDER BY menu_order", 'OBJECT');    
          ?>
          <?php if ( $child_child_pages ) : foreach ( $child_child_pages as $child_child_page ) : setup_postdata( $child_child_page ); ?>
            <h3><?php echo $child_child_page->post_title; ?></h3>
            <?php $url = sgb_thumbnail('circle-thumb',$child_child_page->ID); ?>
            <img src="<?php echo sgb_thumbnail('circle-thumb',$child_child_page->ID); ?>" class="img-circle img-shadow">
          <?php endforeach; endif; ?>  
        </section>
      <?php endforeach; endif; ?>  
    </div>
  </div>
</div>
<?php get_footer(); ?>