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

      <script type="text/javascript">
      <!--
      google_ad_client = "ca-pub-3681567567860543";
      /* SG Bottwartal Skyscraper */
      google_ad_slot = "8234635492";
      google_ad_width = 120;
      google_ad_height = 600;
      //-->
      </script>
      <!-- <script type="text/javascript"src="http://pagead2.googlesyndication.com/pagead/show_ads.js"></script>-->

    </div>
    <div class="span9">
      <div class="">
        <div class="g-plusone" data-size="medium" data-annotation="bubble" data-count="true" data-href="<?php the_permalink(); ?>"></div>
          <a href="https://twitter.com/share" class="twitter-share-button" data-lang="de" data-url="<?php the_permalink(); ?>" data-count="true" data-via="sgbottwartal" data-hashtags="SGB">Tweet</a>
          <div class="fb-like" data-href="http://sg-bottwartal.de/2013/07/die-neuen-trikots-sind-da/" data-send="false" data-layout="button_count" data-width="65" data-show-faces="false"></div>
      </div>
      <hr>
      <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sgb' ) ); ?>
      <meta name="twitter:card" content="summary">
      <meta name="twitter:site" content="@sgbottwartal">
      <meta name="twitter:creator" content="@sgbottwartal">
      <meta name="twitter:title" content="<?php echo the_title(); ?>">
      <meta name="twitter:description" content="<?php the_excerpt( ); ?>">
      <meta name="twitter:image" content="<?php echo $thumb; ?>">
    </div><!-- .entry-content -->
  </div>
</article><!-- #post -->
