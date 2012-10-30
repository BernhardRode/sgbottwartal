<?php
/**
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
**/

 /**
 * Declaring the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
  $content_width = 770; /* pixels */

function sgb_setup() {
  load_theme_textdomain( 'sgb', get_template_directory() . '/languages' );
  // Adds RSS feed links to <head> for posts and comments.
  add_theme_support( 'automatic-feed-links' );
  // This theme supports a variety of post formats.
  add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
  // This theme uses wp_nav_menu() in one location.
  register_nav_menu( 'primary', __( 'Primary Menu', 'sgb' ) );
  // This theme supports custom backgrounds & images
  add_theme_support( 'custom-background', array( 'default-color' => 'e6e6e6') );
  // This theme uses post thumbnails
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 200, 200, true ); // Normal post thumbnails
  add_image_size( 'single-post-thumbnail', 400, 9999 ); // Permalink thumbnail size
}
add_action( 'after_setup_theme', 'sgb_setup' );

function sgb_scripts_styles() { 
  //wp_enqueue_script('head', get_template_directory_uri().'/lib/head.load.min.js', [], '1.0', true);
  //wp_enqueue_script('sgb', get_template_directory_uri().'/js/app.js', [], '1.0', true);
  wp_enqueue_script('jquery', get_template_directory_uri().'/lib/jquery.js', [], '1.8.2', true);
  wp_enqueue_script('moment', get_template_directory_uri().'/lib/moment.js', [], '1.0', true);
  wp_enqueue_script('bootstrap-transition', get_template_directory_uri().'/lib/bootstrap-transition.js', array('jquery'), '2.2.0', true);
  wp_enqueue_script('bootstrap-alert', get_template_directory_uri().'/lib/bootstrap-alert.js', array('jquery'), '2.2.0', true);
  wp_enqueue_script('bootstrap-modal', get_template_directory_uri().'/lib/bootstrap-modal.js', array('jquery'), '2.2.0', true);
  wp_enqueue_script('bootstrap-dropdown', get_template_directory_uri().'/lib/bootstrap-dropdown.js', array('jquery'), '2.2.0', true);
  wp_enqueue_script('bootstrap-scrollspy', get_template_directory_uri().'/lib/bootstrap-scrollspy.js', array('jquery'), '2.2.0', true);
  wp_enqueue_script('bootstrap-tab', get_template_directory_uri().'/lib/bootstrap-tab.js', array('jquery'), '2.2.0', true);
  wp_enqueue_script('bootstrap-tooltip', get_template_directory_uri().'/lib/bootstrap-tooltip.js', array('jquery'), '2.2.0', true);
  wp_enqueue_script('bootstrap-popover', get_template_directory_uri().'/lib/bootstrap-popover.js', array('jquery'), '2.2.0', true);
  wp_enqueue_script('bootstrap-button', get_template_directory_uri().'/lib/bootstrap-button.js', array('jquery'), '2.2.0', true);
  wp_enqueue_script('bootstrap-collapse', get_template_directory_uri().'/lib/bootstrap-collapse.js', array('jquery'), '2.2.0', true);
  wp_enqueue_script('bootstrap-carousel', get_template_directory_uri().'/lib/bootstrap-carousel.js', array('jquery'), '2.2.0', true);
  wp_enqueue_script('bootstrap-typeahead', get_template_directory_uri().'/lib/bootstrap-typeahead.js', array('jquery'), '2.2.0', true);
  wp_enqueue_script('bootstrap-affix', get_template_directory_uri().'/lib/bootstrap-affix.js', array('jquery'), '2.2.0', true);
  wp_enqueue_script('app', get_template_directory_uri().'/js/sgb/sgb.js', array('jquery'), '1.0', true);
  wp_enqueue_style('sgb-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'sgb_scripts_styles' );

/**
* Registers our main widget area and the front page widget areas.
*
* @since 2013
*/
function sgb_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Main Sidebar', 'sgb' ),
    'id' => 'sidebar-1',
    'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'sgb' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => __( 'First Front Page Widget Area', 'sgb' ),
    'id' => 'sidebar-2',
    'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'sgb' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => __( 'Second Front Page Widget Area', 'sgb' ),
    'id' => 'sidebar-3',
    'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'sgb' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );
}
add_action( 'widgets_init', 'sgb_widgets_init' );


/**
* Displays navigation to next/previous pages when applicable.
*
* @since 2013
*/
function excerpt_ellipse($text) {
  return str_replace('[...]', ' ...', $text); 
}
add_filter('the_excerpt', 'excerpt_ellipse');

if ( ! function_exists( 'sgb_content_nav' ) ) :
/**
* Displays navigation to next/previous pages when applicable.
*
* @since 2013
*/
function sgb_content_nav( $nav_id ) {
  global $wp_query;

  if ( $wp_query->max_num_pages > 1 ) : ?>
    <nav id="<?php echo $nav_id; ?>" class="navigation" role="navigation">
      <h3 class="assistive-text"><?php _e( 'Post navigation', 'sgb' ); ?></h3>
      <div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sgb' ) ); ?></div>
      <div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sgb' ) ); ?></div>
    </nav><!-- #<?php echo $nav_id; ?> .navigation -->
  <?php endif;
}
endif;

if ( ! function_exists( 'sgb_comment' ) ) :
/**
* Template for comments and pingbacks.
*
* To override this walker in a child theme without modifying the comments template
* simply create your own sgb_comment(), and that function will be used instead.
*
* Used as a callback by wp_list_comments() for displaying the comments.
*
* @since 2013
**/
function sgb_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
    case 'pingback' :
    case 'trackback' :
    // Display trackbacks differently than normal comments.
  ?>
  <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
    <p><?php _e( 'Pingback:', 'sgb' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'sgb' ), '<span class="edit-link">', '</span>' ); ?></p>
  <?php
      break;
    default :
    // Proceed with normal comments.
    global $post;
  ?>
  <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment">
      <header class="comment-meta comment-author vcard">
        <?php
          echo get_avatar( $comment, 44 );
          printf( '<cite class="fn">%1$s %2$s</cite>',
            get_comment_author_link(),
            // If current post author is also comment author, make it known visually.
            ( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'sgb' ) . '</span>' : ''
          );
          printf( '<a href="%1$s"><time pubdate datetime="%2$s">%3$s</time></a>',
            esc_url( get_comment_link( $comment->comment_ID ) ),
            get_comment_time( 'c' ),
            /* translators: 1: date, 2: time */
            sprintf( __( '%1$s at %2$s', 'sgb' ), get_comment_date(), get_comment_time() )
          );
        ?>
      </header><!-- .comment-meta -->

      <?php if ( '0' == $comment->comment_approved ) : ?>
        <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'sgb' ); ?></p>
      <?php endif; ?>

      <section class="comment-content comment">
        <?php comment_text(); ?>
        <?php edit_comment_link( __( 'Edit', 'sgb' ), '<p class="edit-link">', '</p>' ); ?>
      </section><!-- .comment-content -->

      <div class="reply">
        <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply <span>&darr;</span>', 'sgb' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
      </div><!-- .reply -->
    </article><!-- #comment-## -->
  <?php
    break;
  endswitch; // end comment_type check
}
endif;

if ( ! function_exists( 'sgb_entry_meta' ) ) :
/**
* Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
*
* Create your own sgb_entry_meta() to override in a child theme.
* @since 2013
*/
function sgb_entry_meta() {
  // Translators: used between list items, there is a space after the comma.
  $categories_list = get_the_category_list( __( ', ', 'sgb' ) );

  // Translators: used between list items, there is a space after the comma.
  $tag_list = get_the_tag_list( '', __( ', ', 'sgb' ) );

  $date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a>',
    esc_url( get_permalink() ),
    esc_attr( get_the_time() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() )
  );

  $author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    esc_attr( sprintf( __( 'View all posts by %s', 'sgb' ), get_the_author() ) ),
    get_the_author()
  );

  // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
  if ( $tag_list ) {
    $utility_text = __( 'This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'sgb' );
  } elseif ( $categories_list ) {
    $utility_text = __( 'This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'sgb' );
  } else {
    $utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'sgb' );
  }

  printf(
    $utility_text,
    $categories_list,
    $tag_list,
    $date,
    $author
  );
}
endif;

/**
* Extends the default WordPress body class to denote:
* 1. Using a full-width layout, when no active widgets in the sidebar
*    or full-width template.
* 2. Front Page template: thumbnail in use and number of sidebars for
*    widget areas.
* 3. White or empty background color to change the layout and spacing.
* 4. Custom fonts enabled.
* 5. Single or multiple authors.
*
* @since 2013
*
* @param array Existing class values.
* @return array Filtered class values.
**/
function sgb_body_class( $classes ) {
  $background_color = get_background_color();

  if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
    $classes[] = 'full-width';

  if ( is_page_template( 'page-templates/front-page.php' ) ) {
    $classes[] = 'template-front-page';
    if ( has_post_thumbnail() )
      $classes[] = 'has-post-thumbnail';
    if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
      $classes[] = 'two-sidebars';
  }

  if ( empty( $background_color ) )
    $classes[] = 'custom-background-empty';
  elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
    $classes[] = 'custom-background-white';

  // Enable custom font class only if the font CSS is queued to load.
  if ( wp_style_is( 'sgb-fonts', 'queue' ) )
    $classes[] = 'custom-font-enabled';

  if ( ! is_multi_author() )
    $classes[] = 'single-author';

  return $classes;
}
add_filter( 'body_class', 'sgb_body_class' );

/**
* Adjusts content_width value for full-width and single image attachment
* templates, and when there are no active widgets in the sidebar.
*
* @since 2013
*/
function sgb_content_width() {
  if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
    global $content_width;
    $content_width = 960;
  }
}
add_action( 'template_redirect', 'sgb_content_width' );

/**
 * sets the featured image automatically
 *
 * @since 2013
 */
function set_featured_image_for_posts() {
  // Get all posts so set higher number, 
  // you can increase to any number if you have big amount of posts
  $args = array( 'numberposts' => 5000); 
  // all posts
  $all_posts = get_posts( $args );  
  foreach($all_posts as $k=>$v) {
    $args = array(
      'numberposts' => 1,
      'order'=> 'ASC',
      'post_mime_type' => 'image',
      'post_parent' => $v->ID,
      'post_type' => 'attachment'
    );  
    // Get attachments
    $attachments = get_children( $args );
    $i=0;
    foreach($attachments as $attach)
    {
      // Get only first image
      if($i==0)
        $attachmentsid = $attach->ID;
      $i++;
    }
    // Set Featured image
    set_post_thumbnail($v->ID,$attachmentsid);
  }
}

//function to call first uploaded image in functions file
function get_fallback_post_thumbnail() {
  $url = '';
  $files = get_children('post_parent='.get_the_ID().'&post_type=attachment&post_mime_type=image&order=desc');
  if($files) :
    $keys = array_reverse(array_keys($files));
    $j=0;
    $num = $keys[$j];
    $image=wp_get_attachment_image($num, 'thumb', true);
    $imagepieces = explode('"', $image);
    $imagepath = $imagepieces[1];
    $url=wp_get_attachment_url($num);
  endif;

  if($url == '') :
    $category = get_the_category();
    $url = '/wp-content/themes/sgbottwartal/img/'.$category[0]->slug.'.png';
  endif;

  if($url == '') :
    $category = get_the_category();
    $url = '/wp-content/themes/sgbottwartal/img/logo.png';
  endif;

  //echo '<pre>';
  //print_r( $category[0]->slug );
  //echo '</pre>';

  return $url;
}

?>