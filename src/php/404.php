<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package SGBottwartal
 * @subpackage SG_Bottwartal
 * @since 2013
**/

get_header(); ?>
  <div id="primary" class="site-content">
    <div id="content" role="main">
      <article id="post-0" class="post error404 no-results not-found">
        <header class="entry-header">
          <h1 class="entry-title"><?php _e( 'Das ist jetzt aber peinlich, nicht wahr?', 'sgb' ); ?></h1>
        </header>

        <div class="entry-content">
          <p><?php _e( 'Der aufgerufene Inhalt kann leider nicht gefunden werden. Vieleicht hilft eine Suche weiter.', 'sgb' ); ?></p>
          <?php get_search_form(); ?>
        </div><!-- .entry-content -->
      </article><!-- #post-0 -->

    </div><!-- #content -->
  </div><!-- #primary -->
<?php get_footer(); ?>