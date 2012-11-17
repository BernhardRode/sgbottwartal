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
			<div class="span8" id="masonry">
				<?php 
				  $query = array( 'post_type' => 'sponsoren', 'posts_per_page' => '-1', 'orderby' => 'rand' );				  
				  $size = 'sponsor-large'; 
				  $sponsoren = get_posts( $query );
				  foreach($sponsoren as $sponsor) :
				    $url_image = sgb_thumbnail( $size, $sponsor->ID );
				    $url = get_permalink($sponsor->ID);
				    #$tags = implode(',', get_tags() );
				    $tags = implode(',',wp_get_post_terms($sponsor->ID, 'sponsoren_kategorie', array("fields" => "names")));
				    $output .= '<div class="box span2" data-tags="'.$tags.'"><img src="'.$url_image.'" style="width:100px;" class="img-polaroid img-grayscale img-max-height-120" title="'.$sponsor->post_title.'"></a></div>';  
				  endforeach;
				  echo $output;  
				?>
			</div>
			<div class="span4" id="tags">
				<a href="#" class="tag-link-all" title="Alle Sponsoren" style="font-size: 24pt;">Beliebig</a><br/>
				<?php $tags = wp_tag_cloud( array( 'taxonomy' => 'sponsoren_kategorie' ) ); ?>
				<?php print_r($tags); ?>
				<br/>
      	<?php echo do_shortcode( '[sponsoren id="5708" span="3"]' ); ?>
      	<br/>
      	<?php echo do_shortcode( '[sponsoren id="5783" span="3"]' ); ?>
    	</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>