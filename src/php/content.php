<?php
/**
* The default template for displaying content. Used for both single and index/archive/search.
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
**/
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
  <div class="featured-post">
    <?php _e( 'Featured post', 'sgb' ); ?>
  </div>
  <?php endif; ?>
  <header class="entry-header">
    <?php if ( is_single() ) : ?> 
    <h1 class="entry-title">
      <?php the_title(); ?>
    </h1>
    <hr class="divider">
    <?php else : ?>
    <h1 class="entry-title">
      <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'sgb' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
    </h1>
    <?php endif; // is_single() ?>
  </header><!-- .entry-header -->

  <?php if ( is_search() ) : // Only display Excerpts for Search ?>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div><!-- .entry-summary -->
  <?php else : ?>
  <div class="row">
    <div class="entry-meta span3">
      <?php 
        if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
          $image_id = get_post_thumbnail_id( $pageChild->ID );
          $url = wp_get_attachment_image_src($image_id,'large', true)[0];
        } else {
          $url = get_fallback_post_thumbnail( $pageChild->ID );
        } 
      ?>
      <img src="<?php echo $url; ?>" alt="<?php echo the_title(); ?>" class="img-polaroid">
      
      <?php sgb_entry_meta(); ?> 
      <?php edit_post_link( __( '<i class="icon-edit"></i> Bearbeiten', 'sgb' ), '<br/><span class="edit-link">', '</span>' ); ?>
    </div>
    <div class="entry-content span6">
      <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sgb' ) ); ?>
    </div><!-- .entry-content -->
  </div>
  <?php endif; ?>
</article><!-- #post -->
