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
    <div class="entry-meta span3">
      <?php 
        $thumb = sgb_thumbnail('post-thumbnail');
        $large = sgb_thumbnail('large');
      ?>
      <a href="<?php echo $large; ?>"><img src="<?php echo $thumb; ?>" alt="<?php echo the_title(); ?>" class="img-polaroid"></a>
      <?php sgb_entry_meta(); ?> 
      <?php edit_post_link( __( '<i class="icon-edit"></i> Bearbeiten', 'sgb' ), '<br/><span class="edit-link">', '</span>' ); ?>
    </div>
    <div class="entry-content span6">
      <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sgb' ) ); ?>
    </div><!-- .entry-content -->
  </div>
</article><!-- #post -->
