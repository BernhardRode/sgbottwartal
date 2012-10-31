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
  add_image_size( 'featured-thumb', 1024, 9999 ); //300 pixels wide (and unlimited height)
  add_image_size( 'page-thumb', 220, 9999 ); //300 pixels wide (and unlimited height)
  add_image_size( 'circle-thumb', 100, 100, true ); //(cropped)
  //Disable the admin bar
  //show_admin_bar(false);
}
add_action( 'after_setup_theme', 'sgb_setup' );

function sgb_scripts_styles() { 
  //wp_enqueue_script('head', get_template_directory_uri().'/lib/head.load.min.js', array(), '1.0', true);
  //wp_enqueue_script('sgb', get_template_directory_uri().'/js/app.js', array(), '1.0', true);
  wp_enqueue_script('jquery', get_template_directory_uri().'/lib/jquery.js', array(), '1.8.2', true);
  wp_enqueue_script('moment', get_template_directory_uri().'/lib/moment.js', array(), '1.0', true);
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
  wp_enqueue_script('app', get_template_directory_uri().'/js/app.js', array('jquery'), '1.0', true);
  //wp_enqueue_script('google-plus', 'https://apis.google.com/js/plusone.js', array(), '1.0', true);
  //wp_enqueue_script('facebook', 'http://connect.facebook.net/de_DE/all.js', array(), '1.0', true);
  
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
* Change the howdy text in admin bar
*
* @since 2013
*/
function replace_howdy( $wp_admin_bar ) {
    $my_account=$wp_admin_bar->get_node('my-account');
    $newtitle = str_replace( 'Howdy,', '', $my_account->title );            
    $wp_admin_bar->add_node( array(
        'id' => 'my-account',
        'title' => $newtitle,
    ) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );

/**
* Disable image compression - set jpeg quality to 100%
*
* @since 2013
*/
add_filter('jpeg_quality', function($arg){return 100;});

/**
* Select the first imageas featured image, if no image has been selected.
*
* @since 2013
*/
function autoset_featured_image() {
  global $post;
  $already_has_thumb = has_post_thumbnail($post->ID);
  if (!$already_has_thumb)  {
    $attached_image = get_children( "post_parent=$post->ID&post_type=attachment&post_mime_type=image&numberposts=1" );
    if ($attached_image) {
      foreach ($attached_image as $attachment_id => $attachment) {
        set_post_thumbnail($post->ID, $attachment_id);
      }
    }
  }
}
add_action('the_post', 'autoset_featured_image');
add_action('save_post', 'autoset_featured_image');
add_action('draft_to_publish', 'autoset_featured_image');
add_action('new_to_publish', 'autoset_featured_image');
add_action('pending_to_publish', 'autoset_featured_image');
add_action('future_to_publish', 'autoset_featured_image');

/**
* Configure Wordpress basics.
*
* @since 2013
*/
function admin_bar_remove_logo() {
        global $wp_admin_bar;

        /* Remove their stuff */
        $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'admin_bar_remove_logo', 0);

function change_admin_logo() {
  echo '&lt;style type=&quot;text/css&quot;&gt; #header-logo { background-image: url('.get_bloginfo('template_directory').'/images/admin_logo.png) !important; } &lt;/style&gt;';
}
add_action('admin_head', 'custom_admin_logo');

function wp_admin_logo_change_target_url($url) {
  return 'http://sgbottwartal.de';
}
add_filter( 'login_headerurl', 'wp_admin_logo_change_target_url' );
/**
* Configure the excerpt.
*
* @since 2013
*/
function excerpt_ellipse($text) {
  return str_replace('[...]', ' ...', $text); 
}
add_filter('the_excerpt', 'excerpt_ellipse');

function custom_excerpt_length( $length ) {
  return 30;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

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
        break;
      case 'trackback' :
        break;
      default :
        global $post;
        ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
          <article id="comment-<?php comment_ID(); ?>" class="comment">
            <header class="comment-meta comment-author vcard">
              <img src="http://0.gravatar.com/avatar/68769f5cda1d84cfb4aea5cbb4e4a023?s=38&d=http%3A%2F%2F0.gravatar.com%2Favatar%2Fad516503a11cd5ca435acc9bb6523536%3Fs%3D38&r=G" class="img-circle">
              <cite class="fn"><?php echo get_comment_author(); ?></cite>
              <time pubdate datetime="" class="pull-right"><?php sgb_human_time_comment(); ?></time>
            </header>
            <section class="comment-content comment well well-small">
              <span class="reply pull-right btn">
                  <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<span class="hidden-phone">Antworten</span> <i class="icon-comments-alt"></i>', 'sgb' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
              </span>
              <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation"><?php _e( 'Ihr Kommentar wartet auf seine Freischaltung.', 'sgb' ); ?></p>
              <?php endif; ?>
              <?php comment_text(); ?>
            </section>
            <footer>
          </article>
        </li>
        <?php
    endswitch;
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
    esc_attr( sprintf( __( 'Alle Einträge von %s', 'sgb' ), get_the_author() ) ),
    get_the_author()
  );

  // Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
  $utility_text = __( '%3$s <span class="by-author"> von %4$s</span>.', 'sgb' );

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
    $classesarray() = 'full-width';

  if ( is_page_template( 'page-templates/front-page.php' ) ) {
    $classesarray() = 'template-front-page';
    if ( has_post_thumbnail() )
      $classesarray() = 'has-post-thumbnail';
    if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
      $classesarray() = 'two-sidebars';
  }

  if ( empty( $background_color ) )
    $classesarray() = 'custom-background-empty';
  elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )
    $classesarray() = 'custom-background-white';

  // Enable custom font class only if the font CSS is queued to load.
  if ( wp_style_is( 'sgb-fonts', 'queue' ) )
    $classesarray() = 'custom-font-enabled';

  if ( ! is_multi_author() )
    $classesarray() = 'single-author';

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

function the_slug($id=false, $echo=false){
  $slug = basename(get_permalink($id));
  do_action('before_slug', $slug);
  $slug = apply_filters('slug_filter', $slug);
  if( $echo ) echo $slug;
  do_action('after_slug', $slug);
  return $slug;
}


//function to call first uploaded image in functions file
function get_fallback_post_thumbnail( $id=false, $echo=false ) {
  //$imgsrc = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), "Full");

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

  if ( $url == '' ) :
    $category = get_the_category();
    if ( $category[0]->slug) :
      $url = '/wp-content/themes/sgbottwartal/img/bg.'.$category[0]->slug.'.jpg';
    endif;
  endif;

  if ( $url == '' && $id ) :
    $slug = the_slug( $id );
    if ( $slug ) :
      $url = '/wp-content/hd/'.$slug.'.jpg';
    endif;
  endif;

  if ( $url == '' ) :
    $url = 'bg.publikum.jpg';
  endif;

  if ( $echo ) : 
    echo '<pre>';
    print_r( $id );
    echo '</pre>';
  endif;

  return $url;
}

function sgb_human_time_content() {
  $time_difference = current_time('timestamp') - get_the_time('U');
  if($time_difference < 86400) {
    echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago';
  } else {
    the_time();
  };
}
function sgb_human_time_comment() {
  $time_difference = current_time('timestamp') - get_the_time('U');
  if($time_difference < 86400) {
    echo human_time_diff(get_comment_time('U'), current_time('timestamp')) . ' ago'; 
  } else {
    the_time();
  };
}

/*
function sgb_get_sponsoren($count = 12, $echo = false) {

}

function sgb_custom_post_types() {
  register_post_type( 'event',
    array(
      'labels' => array(
      'name' => __( 'Termine' ),
      'singular_name' => __( 'Termin' )),
      'public' => true,
      'has_archive' => false,
      'rewrite' => array('slug' => 'termine'),
      'supports' => array('title', 'editor')
    )
  );
  register_post_type( 'team',
    array(
      'labels' => array(
      'name' => __( 'Mannschaften' ),
      'singular_name' => __( 'Mannschaft' )),
      'public' => true,
      'has_archive' => false,
      'rewrite' => array( 'slug' => 'mannschaften' ),
      'supports' => array( 'title', 'editor', 'thumbnail' )
    )
  );
}
add_action( 'init', 'sgb_custom_post_types' );

*/
?>