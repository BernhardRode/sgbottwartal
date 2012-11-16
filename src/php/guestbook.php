<?php
/*
Template Name: Gästebuch
*/
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
			<?php while ( have_posts() ) : the_post(); ?>
				<div class="span3">
      		<?php echo do_shortcode( '[sponsoren id="5708,5783" span="2"]' ); ?>
	        <div class="hidden-phone">
	          <br/>
	          <?php do_shortcode( '[sponsoren count="3" span="1"]' ); ?>
	          <br/>
	          <?php do_shortcode( '[sponsoren count="3" span="1"]' ); ?>
	          <br/>
	          <?php do_shortcode( '[sponsoren count="3" span="1"]' ); ?>
	        </div>
				</div>
				<div class="span9">
					<?php
						// If comments are open or we have at least one comment, load up the comment template
						if ( comments_open() || '0' != get_comments_number() ) comments_template( '', true );
					?>
				</div>
			<?php endwhile; // end of the loop. ?>
		</div>
	  <div class="row hidden-phone">
	    <div class="span12">
	      <?php do_shortcode( '[sponsoren count="6" span="2"]' ); ?>
	    </div>
	  </div>  
		<div class="row">
			<div class="span12">
      			<?php echo do_shortcode( '[fotos]' ); ?>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->


<div id="primary" class="site-content container">
	<div id="content" role="main">
		<div class="row">
			<div class="span12">
				<?php while ( have_posts() ) : the_post(); ?>
				<?php the_content(); ?>

				<?php endwhile; // end of the loop. ?>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>