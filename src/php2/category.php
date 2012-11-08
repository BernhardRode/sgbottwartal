<?php
/**
* The template for displaying Category pages.
*
* Used to display archive-type pages for posts in a category.
*
* Learn more: http://codex.wordpress.org/Template_Hierarchy
*
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
*/

get_header(); ?>

	<section id="primary" class="site-content container">
		<div id="content" role="main">
			<div class="row">
				<div class="span9">
		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php printf( __( 'Kategorie: %s', 'sgb' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h1>

			<?php if ( category_description() ) : // Show an optional category description ?>
				<div class="archive-meta"><?php echo category_description(); ?></div>
			<?php endif; ?>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;

			sgb_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

				</div>
				<div class="span3">
					<?php get_sidebar(); ?>
				</div>
		</div><!-- #content -->
		</div><!-- #content -->
	</section><!-- #primary -->
	</div><!-- #primary -->
<?php get_footer(); ?>