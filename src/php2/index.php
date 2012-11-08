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
<!-- Carousel
================================================== -->
<div id="myCarousel" class="carousel slide" data-interval="1750">
  <div class="carousel-inner">
    <?php if ( have_posts() ) : ?>
    <?php /* Start the Loop */ ?>
    <?php $count = 0; ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <?php 
          if ( $count == 0 ) { 
            $class = "active";
          } else { 
            $class=""; 
          }; 
        ?>
        <?php $count = $count+1; ?>
        <?php 
          $url = sgb_thumbnail('large',$post->ID);
        ?> 
        <div class="item <?php echo $class; ?>">
          <img src="<?php echo $url; ?>" alt="<?php echo the_title(); ?>" class="overlay">
          <div class="container">
            <div class="carousel-caption ">
              <h1><?php echo the_title(); ?>.</h1>
              <div class="lead hidden-phone">
                <?php echo the_excerpt(); ?>
              </div>
              <a class="btn btn-large btn-primary" href="<?php echo the_permalink(); ?>">Weiter...</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
  <a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div><!-- /.carousel -->


<div class="container">

  <hr class="hidden-phone divider">
  <div class="row">
    <div class="span12">
      <?php echo do_shortcode( '[sponsoren count="8"]' ); ?>
    </div>
  </div>  
  <hr class="hidden-phone divider">
  <div class="row">
    <div class="span8">
      <!--<h1><i class="icon-trophy"></i> Spielerichte</h1>-->
      <div class="row">
        <?php
          query_posts('count=5'); 
        ?>
        <?php if ( have_posts() ) : ?>
          <?php /* Start the Loop */ ?>
          <?php while ( have_posts() ) : the_post(); ?>
        <div class="span8 media">
          <a class="pull-left" href="<?php the_permalink(); ?>">        
          <?php 
            $url = sgb_thumbnail('circle-thumb',$post->ID);
          ?> 
            <img class="media-object img-circle img-shadow" src="<?php echo $url; ?>">
          </a>
          <div class="media-body">
            <h4 class="media-heading"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <?php the_excerpt(); ?>
          </div>
          <hr>
        </div>
          <?php endwhile; ?>
        <?php endif; // end have_posts() check ?>
      </div>
    </div>
    <div class="span3 hidden-phone">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>