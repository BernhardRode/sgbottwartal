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
					<h1 class="archive-title"><?php
						if ( is_day() ) :
							printf( __( 'Veröffentlicht am: %s', 'twentytwelve' ), '<span>' . get_the_date() . '</span>' );
						elseif ( is_month() ) :
							printf( __( 'Veröffentlicht im: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'sgb' ) ) . '</span>' );
						elseif ( is_year() ) :
							printf( __( 'Veröffentlicht in: %s', 'twentytwelve' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'sgb' ) ) . '</span>' );
						else :
							_e( 'Archiv', 'sgb' );
						endif;
					?></h1>
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