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
      <div id="myCarousel" class="carousel slide">
        <ol class="carousel-indicators">
          <?php if ( have_posts() ) : ?>
          <?php /* Start the Loop */ ?>
          <?php $count = 0; ?>
            <?php while ( have_posts() ) : the_post(); ?>
              <?php $count = $count+1; ?>
              <li data-target="#myCarousel" data-slide-to="<?php echo $count; ?>" class="<?php if ( $count  == 0 ) { echo "active"; } ?>"></li>
            <?php endwhile; ?>
          <?php endif; ?>
        </ol>
        <!-- Carousel items -->
        <div class="carousel-inner">
          <?php if ( have_posts() ) : ?>
          <?php /* Start the Loop */ ?>
          <?php $count = 0; ?>
            <?php while ( have_posts() ) : the_post(); ?>
              <?php $count = $count+1; ?>
              <?php
                $url = sgb_thumbnail('medium',$post->ID);
              ?>
              <div class="<?php if ( $count  == 0 ) { echo "active"; } ?> item">
                    <img src="<?php echo $url; ?>">
                    <div class="carousel-caption">
                      <h4><?php echo the_title(); ?></h4>
                      <p><?php echo the_excerpt(); ?></p>
                    </div>
                  </div>
              </div>
            <?php endwhile; ?>
          <?php endif; ?>
        </div>
        <!-- Carousel nav -->
        <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
        <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
      </div>
      </div>
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
            'ignore_sticky_posts' => 1,
            'post_type' => 'post',
            'showposts' => 8,
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
      <?php echo do_shortcode( '[sponsoren tag="Premium" span="4" count="1"]' ); ?>
      <br/>
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>