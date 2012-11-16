<?php
/**
* The Template for displaying all single posts.
*
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
**/

get_header(); ?>
	<div id="primary" class="site-content container">
		<div id="content" role="main">
			<div class="row">
				<div class="span12">
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_type() ); ?>
				</div>
			</div>
			<div class="row">
				<div class="offset3 span9">
						<?php
							// If comments are open or we have at least one comment, load up the comment template
							if ( comments_open() || '0' != get_comments_number() )
								comments_template( '', true );
						?>
				</div>
			</div>
					<?php endwhile; // end of the loop. ?>
				</div>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_footer(); ?>