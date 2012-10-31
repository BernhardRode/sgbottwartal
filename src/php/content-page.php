<?php
/**
* The template used for displaying page content in page.php
*
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
**/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
	<div class="row">
		<div class="span3">
      <?php 
        if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
          $image_id = get_post_thumbnail_id( $pageChild->ID );
          $url = wp_get_attachment_image_src($image_id,'large', true)[0];
        } else {
          $url = get_fallback_post_thumbnail( $pageChild->ID );
        } 
      ?>
      <a href="<?php echo  get_permalink($pageChild->ID); ?>" rel="bookmark" title="<?php echo $pageChild->post_title; ?>">
        <img src="<?php echo $url; ?>" alt="<?php echo the_title(); ?>" class="img-polaroid">
      </a>
		</div>
		<div class="entry-content span6">
			<?php the_content(); ?>
		</div>
	</div><!-- .entry-content -->
</article><!-- #post -->