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
							
		            <p> 
		              <div class="g-plusone" data-size="medium" data-annotation="none" data-href="<?php the_permalink(); ?>"></div>
		              <div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="false" data-layout="button_count" data-width="450" data-show-faces="false"></div>
		              <a href="https://twitter.com/share" class="twitter-share-button" data-lang="de" data-url="<?php the_permalink(); ?>" data-count="none" data-related="sgbottwartal" data-hash="sgb">Tweet</a>
		            </p>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_type() ); ?>
	      		<?php //echo do_shortcode( '[gallery link="file" order="DESC" columns="10" orderby="title"]' ); ?>
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