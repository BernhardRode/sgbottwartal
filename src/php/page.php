<?php
/**
* The template for displaying all pages.
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site will use a
* different template.
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
				<?php the_content(); ?>
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() ) comments_template( '', true );
				?>
				<?php endwhile; // end of the loop. ?>
			</div>
		</div>
		<div class="row">
			<div class="offset3 span9">
        	<?php $url = sgb_thumbnail('large'); ?>
          <div id="image-viewer" class="img-polaroid">
          	<img src="<?php echo $url; ?>">
        	</div>
      		<?php echo do_shortcode( '[gallery link="file" order="DESC" columns="10" orderby="title"]' ); ?>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>