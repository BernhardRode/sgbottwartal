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
		<?php while ( have_posts() ) : the_post(); ?>
			<div class="row">
				<div class="span4">
					<p>
						<?php the_content(); ?>
					</p>
	        <div class="hidden-phone">
      			<?php echo do_shortcode( '[sponsoren id="5708,5783" span="2"]' ); ?>
	        </div>
				</div>
        <?php $url = sgb_thumbnail('large',$child_child_page->ID); ?>
				<div class="span8" id="image-viewer">
          <img src="<?php echo $url; ?>" class="img-polaroid">
      		<?php echo do_shortcode( '[gallery link="file" order="DESC" columns="10" orderby="title"]' ); ?>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="span4">
	          <?php do_shortcode( '[sponsoren count="4" span="1"]' ); ?>
	          <br/>
	          <?php do_shortcode( '[sponsoren count="4" span="1"]' ); ?>
	          <br/>
	          <?php do_shortcode( '[sponsoren count="4" span="1"]' ); ?>
				</div>
				<div class="span8">
          <h3>Aktuelles</h3>
          <?php 
          	$title = strtolower(get_the_title());
          	$title = str_replace('-', '', $title);
          	$title = str_replace(' ', '', $title);
          	$args = array(
          		'numberposts' => 10,
							'tax_query' => array(
								array(
									'taxonomy' => 'post_tag',
									'field' => 'slug',
									'terms' => $title
								)
							)
						);
						$postslist = get_posts( $args );
						
						?>
						<ul class="unstyled">
						<?php
							foreach( $postslist as $post ) :	setup_postdata($post); ?>
								<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
							<?php endforeach; ?>
						</ul>
				</div>
			</div> 				
		<?php endwhile; // end of the loop. ?>
	</div><!-- #content -->
</div><!-- #primary -->
<?php get_footer(); ?>