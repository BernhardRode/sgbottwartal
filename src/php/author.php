<?php
/**
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
**/
get_header(); ?>

<div class="site-content container">
  <div class="row">
   	<div class="span8">
			<?php if ( have_posts() ) : ?>
				<header class="archive-header">
					<h1 class="archive-title"><?php printf( __( 'Veröffentlich von: %s', 'sgb' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
				</header><!-- .archive-header -->
        <?php while ( have_posts() ) : the_post(); ?>
	        <div class="row media">
	        	<div class="span2">
		          <?php
		            $url = sgb_thumbnail('post-thumbnail',$post->ID);
		          ?>
		          <a class="span2" href="<?php the_permalink(); ?>">
		            <img class="media-object img-circle img-shadow img-svg-120" src="<?php echo $url; ?>">
		          </a>
	        	</div>
	          <div class="span6 media-body">
	            <h4 class="media-heading">
	              <a href="<?php the_permalink(); ?>">
	                <?php the_title(); ?><?php comments_number('', '<span class="badge pull-right">1 Kommentar</span>', '<span class="badge pull-right">% Kommentare</span>' );?>
	              </a>
	            </h4>
	            <?php the_excerpt(); ?>
	          </div>
	        </div>
        <?php endwhile; ?>
        <div class="row">
        	<div class="span8">
        		<div class="centered">
      				<?php echo do_shortcode( '[seiten]' ); ?>
						</div>
        	</div>
        </div>
      <?php endif; // end have_posts() check ?>
    </div>
    <div class="span4 hidden-phone">
      <?php echo do_shortcode( '[sponsoren id="5708" span="4"]' ); ?>
      <br/>
      <?php echo do_shortcode( '[sponsoren id="5783" span="4"]' ); ?>
      <br/>
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>