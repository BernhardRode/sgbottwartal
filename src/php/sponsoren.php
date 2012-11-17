<?php
/*
Template Name: Sponsoren
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
			<div class="span12">
				<h1>Premium Sponsoren</h1>
      	<?php echo do_shortcode( '[sponsoren tag="Premium" span="4" count="-1"]' ); ?>
    	</div>
    </div>
		<div class="row">
			<div class="span12">
				<h1>Unsere Sponsoren</h1>
    		<?php echo do_shortcode( '[sponsoren span="2" count="-1"]' ); ?>
			</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>