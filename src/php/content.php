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

      <script type="text/javascript"><!--
      google_ad_client = "ca-pub-3681567567860543";
      /* SG Bottwartal Skyscraper */
      google_ad_slot = "8234635492";
      google_ad_width = 120;
      google_ad_height = 600;
      //-->
      </script>
      <script type="text/javascript"
      src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
      </script>
      
    </div>
    <div class="span9">
      <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sgb' ) ); ?>
    </div><!-- .entry-content -->
  </div>
  <div class="row">
    <div class="span12">
      <script type="text/javascript">
        <!--
          google_ad_client = "ca-pub-3681567567860543";
          /* SG Bottwartal - Text */
          google_ad_slot = "6757902292";
          google_ad_width = 970;
          google_ad_height = 90;
        //-->
      </script>
      <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
      </script>
    </div>
  </div>
</article><!-- #post -->
