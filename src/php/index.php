<?php
/**
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
**/
get_header(); ?>
<?php
  $query = get_option( 'sticky_posts' );
  rsort( $query );
  $query = array_slice( $query, 0, 4 );
  $stickies= query_posts( array( 'post__in' => $query, 'caller_get_posts' => 1 ) );
?>

<div class="site-content container">
  <div class="row hidden-phone">
    <div class="span12">
      <!-- Carousel
      ================================================== -->
      <div id="slider" class="slider">
          <?php if ( have_posts() ) : ?>
          <?php /* Start the Loop */ ?>
          <?php $count = 0; ?>
            <?php while ( have_posts() ) : the_post(); ?>
              <?php $count = $count+1; ?>
              <?php
                $url = sgb_thumbnail('large',$post->ID);
              ?>
              <div class="slide">
                  <h1><?php echo the_title(); ?><?php comments_number('', '<span class="badge pull-right">1 Kommentar</span>', '<span class="badge pull-right">% Kommentare</span>' );?></h1>
                  <?php echo the_excerpt(); ?>
                  <figure class="vignette overlay inset">
                    <img src="<?php echo $url; ?>" alt="<?php echo the_title(); ?>">
                  </figure>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
          <nav class="slider-arrows">
            <span class="slider-arrows-prev"></span>
            <span class="slider-arrows-next"></span>
          </nav>
      </div><!-- /.da-slider -->
    </div>
  </div>
  <div class="row hidden-phone">
    <div class="span12">
      <?php echo do_shortcode( '[sponsoren count="12" span="1"]' ); ?>
    </div>
  </div>
  <hr class="hidden-phone">
  <div class="row">
    <div class="span8">
      <div class="row">
        <?php
          query_posts(array(
            'post__not_in'   => get_option('sticky_posts'),
            'post_type' => 'post',
            'showposts' => 5
          ));
        ?>
        <?php if ( have_posts() ) : ?>
          <?php /* Start the Loop */ ?>
          <?php while ( have_posts() ) : the_post(); ?>
        <div class="span8 media">
          <?php
            $url = sgb_thumbnail('post-thumbnail',$post->ID);
          ?>
          <a class="span2 pull-left" href="<?php the_permalink(); ?>">
            <img class="media-object img-circle img-shadow img-svg-120" src="<?php echo $url; ?>">
          </a>
          <div class="media-body">
            <h4 class="media-heading">
              <a href="<?php the_permalink(); ?>">
                <?php the_title(); ?><?php comments_number('', '<span class="badge pull-right">1 Kommentar</span>', '<span class="badge pull-right">% Kommentare</span>' );?>
              </a>
            </h4>
            <?php the_excerpt(); ?>
          </div>
          <hr>
        </div>
          <?php endwhile; ?>
        <?php endif; // end have_posts() check ?>
      </div>
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