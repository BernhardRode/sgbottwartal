<?php
/**
* The template for displaying posts in the Image post format
*
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
**/
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'sgb' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'sgb' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
				<h1><?php the_title(); ?></h1>
				<h2><time class="entry-date" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" pubdate><?php echo get_the_date(); ?></time></h2>
				<?php edit_post_link( __( 'Edit', 'sgb' ), '<span class="edit-link">', '</span>' ); ?>
			</a>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
