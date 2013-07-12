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
    </div>
    <div class="span9">
      <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sgb' ) ); ?>
    </div><!-- .entry-content -->
  </div>
  <div class="row">
    <div class="span3">
      <script async src="http://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <ins class="adsbygoogle"
         style="display:inline-block;width:970px;height:90px"
         data-ad-client="ca-pub-3681567567860543"
         data-ad-slot="6757902292"></ins>
      <script>(adsbygoogle = window.adsbygoogle || []).push({});</script>
    </div>
</div>
</article><!-- #post -->
