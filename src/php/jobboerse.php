<?php
/*
Template Name: Jobbörse
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
			<div class="span8">
				<?php 
				  $query = array( 'post_type' => 'jobs', 'posts_per_page' => '-1', 'orderby' => 'rand' );				  
				  $size = 'sponsor-large'; 
				  $angebote = get_posts( $query );
				  foreach($angebote as $angebot) :
				    $url_image = sgb_thumbnail( $size, $angebot->ID );
				    $url = get_permalink($angebot->ID);
				    #$tags = implode(',', get_tags() );
				    
				    echo '<h3 class="muted">'.$angebot->post_title.'</h3>';
				    echo '<div class="row">';
				    echo '<div class="span3">';
				    //echo '<a href="'.$url.'">';
				    echo '<img src="'.$url_image.'" class="img-polaroid img-grayscale" title="'.$angebot->post_title.'">';
				    //echo '</a>';
				    echo '</div>';  
				    echo '<div class="span5">';
						$content = $angebot->post_content;
						$content = apply_filters('the_content', $content);
						$content = str_replace(']]>', ']]&gt;', $content);
						echo $content;
				    echo '</div>';
				    echo '</div>';
				  endforeach;  
				?>
			</div>
			<div class="span4" id="tags">
      	<?php echo do_shortcode( '[sponsoren id="5708" span="4"]' ); ?>
      	<br/>
      	<?php echo do_shortcode( '[sponsoren id="5783" span="4"]' ); ?>
    	</div>
		</div>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>