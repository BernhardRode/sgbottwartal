<?php
/*
Template Name: Mannschaft
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
				<div class="span4">
					<?php the_content(); ?>
      		<?php echo do_shortcode( '[sponsoren id="5708,5783" span="2"]' ); ?>
	        <div class="hidden-phone">
	          <br/>
	          <?php do_shortcode( '[sponsoren count="4" span="1"]' ); ?>
	          <br/>
	          <?php do_shortcode( '[sponsoren count="4" span="1"]' ); ?>
	          <br/>
	          <?php do_shortcode( '[sponsoren count="4" span="1"]' ); ?>
	        </div>
				</div>
				<div class="span8">
          <?php $url = sgb_thumbnail('large',$child_child_page->ID); ?>
          <img class="img-polaroid" src="<?php echo $url; ?>">
          <?php $url = sgb_thumbnail('full',$child_child_page->ID); ?>
          <a href="<?php echo $url; ?>" title="<?php the_title(); ?>">Download in voller Aufl&ouml;sung</a>
          <hr>
      		<?php echo do_shortcode( '[gallery]' ); ?>
				</div>
			<?php endwhile; // end of the loop. ?>
		</div> 
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>