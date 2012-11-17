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
	        <div class="hidden-phone">
      			<?php echo do_shortcode( '[sponsoren id="5708,5783" span="2"]' ); ?>
	          <br/>
	          <?php do_shortcode( '[sponsoren count="4" span="1"]' ); ?>
	          <br/>
	          <?php do_shortcode( '[sponsoren count="4" span="1"]' ); ?>
	          <br/>
	          <?php do_shortcode( '[sponsoren count="4" span="1"]' ); ?>
	        </div>
				</div>
        <?php $url = sgb_thumbnail('large',$child_child_page->ID); ?>
				<div class="span8 visible-phone">
          <img src="<?php echo $url; ?>" class="img-polaroid">
				</div>
				<div class="span8 hidden-phone">
          <div id="image-viewer" class="img-polaroid">
          	<img src="<?php echo $url; ?>">
        	</div>
      		<?php echo do_shortcode( '[gallery link="file" order="DESC" columns="10" orderby="title"]' ); ?>
          <?php //$url = sgb_thumbnail('full',$child_child_page->ID); ?>
          <!--<a href="<?php echo $url; ?>" title="<?php the_title(); ?>" target="_blank">Aktuelle Mannschaft in voller Aufl&ouml;sung herunterladen.</a>-->
				</div>
			<?php endwhile; // end of the loop. ?>
		</div> 
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>