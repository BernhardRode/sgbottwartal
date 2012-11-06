<?php
/**
* The template used for displaying page content in page.php
*
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
**/
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>
	<div class="row">
		<div class="span3">
      <?php 
        if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) {
          $image_id = get_post_thumbnail_id( $pageChild->ID );
          $url = wp_get_attachment_image_src($image_id,'large', true)[0];
        } else {
          $url = get_fallback_post_thumbnail( $pageChild->ID );
        } 
      ?>
      <a href="<?php echo  get_permalink($pageChild->ID); ?>" rel="bookmark" title="<?php echo $pageChild->post_title; ?>">
        <img src="<?php echo $url; ?>" alt="<?php echo the_title(); ?>" class="img-polaroid">
      </a>
      <?php
        $tag = strtolower(get_the_title());
        $tag = str_replace('-','',$tag);
        $tag = str_replace(' ','',$tag);
        $tag = str_replace('jugend','',$tag);
        if ($tag) {
          $args=array(
            'tag' => $tag,
            'showposts'=>5,
            'caller_get_posts'=>1
          );

          $my_query = new WP_Query($args);
          if( $my_query->have_posts() ) {
              ?>
              <h4>Aktuelle Artikel:</h4>
              <div class="well">
                <ul class="unstyled">
              <?php
            while ($my_query->have_posts()) : $my_query->the_post(); 
              $fulltitle = get_the_title();
              $link = get_permalink();
              list($tag,$title) = explode(':',$fulltitle,2);
              if ($title == '') {
                $title = $tag;
              }
              ?>
                <li><a href="<?php echo $link; ?>" rel="bookmark" title="Link zu <?php echo $title; ?>"><?php echo $title; ?></a></li>
              <?php
            endwhile;
            ?>
              </ul>
            </div>
            <?php
          }
          wp_reset_query();
        }
      ?>
		</div>
		<div class="entry-content span6">
			<?php the_content(); ?>

      <div class="row">
        <div class="span6">
          <?php echo do_shortcode( '[sponsoren count="3"]' ); ?>
        </div>
      </div>
		</div>
	</div><!-- .entry-content -->
  <div class="row">
    <div class="span9">
    </div>
  </div>
</article><!-- #post -->