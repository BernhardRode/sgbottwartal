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
          if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
            $image_id = get_post_thumbnail_id();
            $versions = wp_get_attachment_image_src($image_id,'large', true);
            $url = $version[0];
          } else {
            $url = get_fallback_post_thumbnail();
          } 
        ?> 
        <div class="item <?php echo $class; ?>">
          <img src="<?php echo $url; ?>" alt="<?php echo the_title(); ?>" class="carousel-background overlay">
          <div class="container">
            <div class="carousel-caption ">
              <h1><?php echo the_title(); ?>.</h1>
              <p class="lead">
                <?php echo the_excerpt(); ?>
              </p>
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
  <div class="row">
    <div class="span4">
      <h2>Berichte</h2>
      <ul class="ul-articles">
        <?php
          $news = query_posts($query_string . '&cat=3');
        ?>
        <?php if ( have_posts() ) : ?>
          <?php /* Start the Loop */ ?>
          <?php while ( have_posts() ) : the_post(); ?>
            <li>
              <?php get_template_part( 'preview', get_post_format() ); ?>
            </li>
          <?php endwhile; ?>
        <?php endif; // end have_posts() check ?>
      </ul>
    </div>
    <div class="span4">
      <h2>Neuigkeiten</h2>
      <ul class="ul-articles">
        <?php
          $articles = query_posts($query_string . '&cat=7');
        ?>
        <?php if ( have_posts() ) : ?>
          <?php /* Start the Loop */ ?>
          <?php while ( have_posts() ) : the_post(); ?>
            <li>
              <?php get_template_part( 'preview', get_post_format() ); ?>
            </li>
          <?php endwhile; ?>
        <?php endif; // end have_posts() check ?>
      </ul>
    </div>
    <div class="span4">
      <h2>Termine</h2>
      <ul class="ul-articles">
        <?php
          $articles = query_posts($query_string . '&cat=7');
        ?>
        <?php if ( have_posts() ) : ?>
          <?php /* Start the Loop */ ?>
          <?php while ( have_posts() ) : the_post(); ?>
            <li>
              <?php get_template_part( 'preview', get_post_format() ); ?>
            </li>
          <?php endwhile; ?>
        <?php endif; // end have_posts() check ?>
      </ul>
    </div>
  </div>
</div>
<?php get_footer(); ?>