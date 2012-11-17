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

              <div class="hidden-phone">
                <br/>
                <?php do_shortcode( '[sponsoren count="3" span="1"]' ); ?>
                <br/>
                <?php do_shortcode( '[sponsoren count="3" span="1"]' ); ?>
                <br/>
                <?php do_shortcode( '[sponsoren count="3" span="1"]' ); ?>
              </div>
            </div>
            <div class="span9">
              <?php
                $child_child_pages = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_parent = ".$child_page->ID." AND post_status = 'publish' AND post_type = 'page' ORDER BY menu_order", 'OBJECT');    
              ?>
              <div class="row">
              <?php $counter = 0; ?>
              <?php if ( $child_child_pages ) : foreach ( $child_child_pages as $child_child_page ) : setup_postdata( $child_child_page ); ?>
                <?php $counter++; ?>
                <div class="span4 <?php if ($counter == 2) echo 'offset1'; ?>">
                  <?php $url = sgb_thumbnail('page-thumb',$child_child_page->ID); ?>
                  <a class="" href="<?php echo get_permalink( $child_child_page->ID ); ?>">
                    <img class="img-polaroid img-max-height-200" src="<?php echo $url; ?>">
                  </a>
                  <h3 class="muted"><?php echo $child_child_page->post_title; ?></h3>
                  <!--<h3 class="muted"><?php echo $child_child_page->post_title; ?></h3>-->
                </div>
                <?php 
                  if($counter == 2) {
                    echo '</div><br/><div class="row">';
                    $counter = 0;
                  }
                ?>
              <?php endforeach; endif; ?>
              </div>
            </div> 
          </div> 
          <br/>
        </section>
      <?php endforeach; endif; ?>  
    </div>
  </div>
</div>
<?php get_footer(); ?>