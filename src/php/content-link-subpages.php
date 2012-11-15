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
      <?php
        $child_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = ".$post->ID." AND post_status = 'publish' AND post_type = 'page' ORDER BY menu_order", 'OBJECT');    
      ?>
      <?php if ( $child_pages ) : foreach ( $child_pages as $child_page ) : setup_postdata( $child_page ); ?>
        <section id="section-<?php echo $child_page->ID; ?>">
          <a name="#section-<?php echo $child_page->ID; ?>"></a>
          <div class="row">
            <div class="span3">
              <h2><?php echo get_the_title($child_page->ID); ?></h2>
            </div>
            <div class="span9">
              <?php
                $child_child_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = ".$child_page->ID." AND post_status = 'publish' AND post_type = 'page' ORDER BY menu_order", 'OBJECT');    
              ?>
              <div class="row">
              <?php $counter = 0; ?>
              <?php if ( $child_child_pages ) : foreach ( $child_child_pages as $child_child_page ) : setup_postdata( $child_child_page ); ?>
                <?php $counter++; ?>
                <div class="span3">
                  <?php $url = sgb_thumbnail('circle-thumb',$child_child_page->ID); ?>
                  <a class="" href="#">
                    <img class="media-object img-max-height-200" src="<?php echo $url; ?>">
                  </a>
                </div>
                <div class="span1">
                  <div class="media-body">
                    <h5 class="media-heading"><?php echo $child_child_page->post_title; ?></h5>
                  </div>
                </div>
                <?php 
                  if($counter == 2) {
                    echo '</div><div class="row">';
                    $counter = 0;
                  }
                ?>
              <?php endforeach; endif; ?>
              </div>
            </div>  
          </div>
        </section>
      <?php endforeach; endif; ?>  
    </div>
  </div>
</div>
<?php get_footer(); ?>