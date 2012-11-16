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
      <div class="span3">
        <?php 
          $thumb = sgb_thumbnail('page-thumb');
        ?>
        <img src="<?php echo $thumb; ?>" alt="<?php echo the_title(); ?>" class="img-polaroid img-max-height-200">

        <div class="row">
          <div class="span1">
            <?php sgc_plusone_button(); ?>
          </div>
          <div class="span1">
            <?php sgc_plusone_button(); ?>
          </div>
          <div class="span1">
            <?php sgc_plusone_button(); ?>
          </div>
        </div>
        <div class="hidden-phone">
          <br/>
          <?php do_shortcode( '[sponsoren count="3" span="1"]' ); ?>
          <br/>
          <?php do_shortcode( '[sponsoren count="3" span="1"]' ); ?>
          <br/>
          <?php do_shortcode( '[sponsoren count="3" span="1"]' ); ?>
          <br/>
          <?php sgb_entry_meta(); ?> 
          <br/>
          <?php edit_post_link( __( '<i class="icon-edit"></i> Bearbeiten', 'sgb' ), '<br/><span class="edit-link">', '</span>' ); ?>
        </div>
      </div>
      <div class="span9">
        <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sgb' ) ); ?>
      </div><!-- .entry-content -->
    </div>
</div>

</article><!-- #post -->
