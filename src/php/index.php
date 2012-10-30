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
<div id="myCarousel" class="carousel slide">
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
            $url = wp_get_attachment_image_src($image_id,'large', true)[0];
          } else {
            $url = get_fallback_post_thumbnail();
          } 
        ?> 
        <div class="item <?php echo $class; ?>">
          <img src="<?php echo $url; ?>" alt="<?php echo the_title(); ?>" class="carousel-background">
          <div class="container">
            <div class="carousel-caption ">
              <h1><?php echo the_title(); ?>.</h1>
              <p class="lead">
                <?php echo the_excerpt(); ?>
                <?php echo $url; ?>
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
<?php
  $articles = query_posts($query_string . '&cat=7');
?>
<div id="primary" class="site-content container">
  <div id="content" role="main">
  <?php if ( have_posts() ) : ?>

    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'content', get_post_format() ); ?>
    <?php endwhile; ?>

    <?php sgb_content_nav( 'nav-below' ); ?>

  <?php else : ?>

    <article id="post-0" class="post no-results not-found">

    <?php if ( current_user_can( 'edit_posts' ) ) :
      // Show a different message to a logged-in user who can add posts.
    ?>
      <header class="entry-header">
        <h1 class="entry-title"><?php _e( 'No posts to display', 'sgb' ); ?></h1>
      </header>

      <div class="entry-content">
        <p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'sgb' ), admin_url( 'post-new.php' ) ); ?></p>
      </div><!-- .entry-content -->

    <?php else :
      // Show the default message to everyone else.
    ?>
      <header class="entry-header">
        <h1 class="entry-title"><?php _e( 'Nothing Found', 'sgb' ); ?></h1>
      </header>

      <div class="entry-content">
        <p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'sgb' ); ?></p>
        <?php get_search_form(); ?>
      </div><!-- .entry-content -->
    <?php endif; // end current_user_can() check ?>

    </article><!-- #post-0 -->

  <?php endif; // end have_posts() check ?>

  </div><!-- #content -->
</div><!-- #primary -->
<?php
  $news = query_posts($query_string . '&cat=3');
?>
<div id="primary" class="site-content">
  <div id="content" role="main">
  <?php if ( have_posts() ) : ?>

    <?php /* Start the Loop */ ?>
    <?php while ( have_posts() ) : the_post(); ?>
      <?php get_template_part( 'content', get_post_format() ); ?>
    <?php endwhile; ?>

    <?php sgb_content_nav( 'nav-below' ); ?>

  <?php else : ?>

    <article id="post-0" class="post no-results not-found">

    <?php if ( current_user_can( 'edit_posts' ) ) :
      // Show a different message to a logged-in user who can add posts.
    ?>
      <header class="entry-header">
        <h1 class="entry-title"><?php _e( 'No posts to display', 'sgb' ); ?></h1>
      </header>

      <div class="entry-content">
        <p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'sgb' ), admin_url( 'post-new.php' ) ); ?></p>
      </div><!-- .entry-content -->

    <?php else :
      // Show the default message to everyone else.
    ?>
      <header class="entry-header">
        <h1 class="entry-title"><?php _e( 'Nothing Found', 'sgb' ); ?></h1>
      </header>

      <div class="entry-content">
        <p><?php _e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'sgb' ); ?></p>
        <?php get_search_form(); ?>
      </div><!-- .entry-content -->
    <?php endif; // end current_user_can() check ?>

    </article><!-- #post-0 -->

  <?php endif; // end have_posts() check ?>

  </div><!-- #content -->
</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>