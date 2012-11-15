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
				<div class="span3">
					<?php the_content(); ?>
	        <div class="hidden-phone">
	          <br/>
	          <?php do_shortcode( '[sponsoren count="3" span="1"]' ); ?>
	          <br/>
	          <?php do_shortcode( '[sponsoren count="3" span="1"]' ); ?>
	          <br/>
	          <?php do_shortcode( '[sponsoren count="3" span="1"]' ); ?>
	          <br/>
	          <?php sgb_entry_meta(); ?> 
	          <br/>
	          <?php edit_post_link( __( '<i class="icon-edit"></i> Bearbeiten', 'sgb' ), '<br/><span class="edit-link">', '</span>' ); ?>
	        </div>
				</div>
				<div class="span9">
          <?php $url = sgb_thumbnail('large',$child_child_page->ID); ?>
          <img class="img-polaroid" src="<?php echo $url; ?>">
				</div>
			<?php endwhile; // end of the loop. ?>
		</div>
		<div class="row">
			<div class="span12">
      			<?php echo do_shortcode( '[fotos]' ); ?>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>