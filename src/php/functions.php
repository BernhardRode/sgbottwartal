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
  set_post_thumbnail_size( 120, 120, true ); // Normal post thumbnails
  add_image_size( 'featured-thumb', 1024, 9999 ); //1024 pixels wide (and unlimited height)
  add_image_size( 'page-thumb', 220, 9999 ); //220 pixels wide (and unlimited height)
  add_image_size( 'circle-thumb', 100, 100, true ); //(cropped)
  add_image_size( 'circle-mini', 30, 30, true ); //(cropped)
  add_image_size( 'sponsor-large', 150, 108 );
  add_image_size( 'sponsor-small', 70, 50 );
  //Disable the admin bar
  //show_admin_bar(false);
}
add_action( 'after_setup_theme', 'sgb_setup' );

function sgb_scripts_styles() {
  //wp_enqueue_script('head', get_template_directory_uri().'/lib/head.load.min.js', array(), '1.0', true);
  //wp_enqueue_script('sgb', get_template_directory_uri().'/js/app.js', array(), '1.0', true);
  wp_enqueue_script('modernizr', get_template_directory_uri().'/lib/modernizr.custom.70639.js', array(), '70639', false);
  wp_enqueue_script('jquery', get_template_directory_uri().'/lib/jquery.js', array(), '1.8.2', true);
  wp_enqueue_script('moment', get_template_directory_uri().'/lib/moment.js', array(), '1.7.2', true);
  wp_enqueue_script('moment-de', get_template_directory_uri().'/lib/de.js', array('moment'), '1.7.2', true);
  wp_enqueue_script('bootstrap-transition', get_template_directory_uri().'/lib/bootstrap-transition.js', array('jquery'), '2.2.1', true);
  //wp_enqueue_script('bootstrap-alert', get_template_directory_uri().'/lib/bootstrap-alert.js', array('jquery'), '2.2.1', true);
  wp_enqueue_script('bootstrap-modal', get_template_directory_uri().'/lib/bootstrap-modal.js', array('jquery'), '2.2.1', true);
  //wp_enqueue_script('bootstrap-dropdown', get_template_directory_uri().'/lib/bootstrap-dropdown.js', array('jquery'), '2.2.1', true);
  //wp_enqueue_script('bootstrap-scrollspy', get_template_directory_uri().'/lib/bootstrap-scrollspy.js', array('jquery'), '2.2.1', true);
  //wp_enqueue_script('bootstrap-tab', get_template_directory_uri().'/lib/bootstrap-tab.js', array('jquery'), '2.2.1', true);
  wp_enqueue_script('bootstrap-tooltip', get_template_directory_uri().'/lib/bootstrap-tooltip.js', array('jquery'), '2.2.1', true);
  wp_enqueue_script('bootstrap-popover', get_template_directory_uri().'/lib/bootstrap-popover.js', array('jquery'), '2.2.1', true);
  wp_enqueue_script('bootstrap-button', get_template_directory_uri().'/lib/bootstrap-button.js', array('jquery'), '2.2.1', true);
  wp_enqueue_script('bootstrap-collapse', get_template_directory_uri().'/lib/bootstrap-collapse.js', array('jquery'), '2.2.1', true);
  wp_enqueue_script('bootstrap-carousel', get_template_directory_uri().'/lib/bootstrap-carousel.js', array('jquery'), '2.2.1', true);
  //wp_enqueue_script('bootstrap-typeahead', get_template_directory_uri().'/lib/bootstrap-typeahead.js', array('jquery'), '2.2.1', true);
  //wp_enqueue_script('bootstrap-affix', get_template_directory_uri().'/lib/bootstrap-affix.js', array('jquery'), '2.2.1', true);
  //wp_enqueue_script('bootstrap-image-gallery', get_template_directory_uri().'/lib/bootstrap-image-gallery.js', array('jquery'), '2.8.1', true);
  //wp_enqueue_script('bootstrap-calendar', get_template_directory_uri().'/lib/bootstrap.calendar.js', array('jquery'), '2.2.1', true);
  wp_enqueue_script('bootstrap-calendar', get_template_directory_uri().'/lib/fullcalendar.js', array('jquery'), '1.5.4', true);
  wp_enqueue_script('svgeezy', get_template_directory_uri().'/lib/svgeezy.js', array('jquery'), '1.0', true);
  wp_enqueue_script('jquery-shuffle', get_template_directory_uri().'/lib/jquery.shuffle.js', array('jquery'), '1.0', true);
  //wp_enqueue_script('jquery-cslider', get_template_directory_uri().'/lib/jquery.cslider.js', array('jquery'), '1.0', true);
  wp_enqueue_script('jms', get_template_directory_uri().'/lib/jmpress.js', array('jquery'), '1.0', true);
  wp_enqueue_script('jquery-jms', get_template_directory_uri().'/lib/jquery.jmslideshow.js', array('jquery'), '1.0', true);
  //wp_enqueue_script('jquery-masonry', get_template_directory_uri().'/lib/jquery.masonry.js', array('jquery'), '1.0', true);
  //wp_enqueue_script('app', get_template_directory_uri().'/lib/socialite.js', array('jquery'), '1.0', true);
  //wp_enqueue_script('impress', get_template_directory_uri().'/lib/impress.js', array('jquery'), '1.0', true);
  //wp_enqueue_script('presentation', get_template_directory_uri().'/js/impress.js', array('jquery'), '1.0', true);
  wp_enqueue_script('app', get_template_directory_uri().'/js/app.js', array('jquery'), '8.0', true);
  //wp_enqueue_script('google-plus', 'https://apis.google.com/js/plusone.js', array(), '1.0', true);
  //wp_enqueue_script('facebook', 'http://connect.facebook.net/de_DE/all.js', array(), '1.0', true);

  wp_enqueue_style('sgb-style', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'sgb_scripts_styles' );

function remove_images( $content ) {
   $postOutput = preg_replace('/<img[^>]+./','', $content);
   return $postOutput;
}
#add_filter( 'the_content', 'remove_images', 100 );

/**
* Registers our main widget area and the front page widget areas.
*
* @since 2013
*/
function sgb_widgets_init() {
  register_sidebar( array(
    'name' => __( 'Sidebar', 'sgb' ),
    'id' => 'sidebar-1',
    'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'sgb' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget' => '</aside>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ) );

  register_sidebar( array(
    'name' => __( 'Footerbar', 'sgb' ),
    'id' => 'footerbar-1',
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
        # $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'admin_bar_remove_logo', 0);

function change_admin_logo() {
  echo '<style type="text/css"> #header-logo { background-image: url('.get_bloginfo('template_directory').'/images/admin_logo.png) !important; } </style>';
}
add_action('admin_head', 'change_admin_logo');

function wp_admin_logo_change_target_url($url) {
  return 'http://sg-bottwartal.de';
}
add_filter( 'login_headerurl', 'wp_admin_logo_change_target_url' );

add_action("login_head", "custom_login_logo");

function custom_login_logo() {
  echo "
  <style>
    body.login #login h1 a {
      background: url('/wp-content/themes/sgbottwartal/img/sg.panther.svg') no-repeat scroll center top transparent;
      background-size:cover;
      height: 110px;
      width: 325px;
    }
  </style>;
  ";
}

/**
* THIS INCLUDES THE THUMBNAIL IN OUR RSS FEED
*
* @since 2013
*/
//
add_filter( 'the_excerpt_rss',  'sgb_insertThumbnailRSS' );
add_filter( 'the_content_feed', 'sgb_insertThumbnailRSS' );
function sgb_insertThumbnailRSS( $content ) {
  global $post;
  $url = sgb_thumbnail( 'featured-thumb', $post->ID );
  if ($url == '/wp-content/themes/sgbottwartal/img/sg.logo.quadrat.svg')
    $url = 'http://sg-bottwartal.de/wp-content/themes/sgbottwartal/img/sg.logo.quadrat.png';

  $content = $url;
  #$content = '<img src="' . $url . '"><hr>' . $content;
  return $content;
}

/**
* Configure the excerpt.
*
* @since 2013
*/
function excerpt_ellipse($text) {
  return str_replace('[...]', ' ... &raquo;', $text);
}
add_filter('the_excerpt', 'excerpt_ellipse');

function custom_excerpt_length( $length ) {
  return 28;
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

add_filter('get_avatar','change_avatar_css');

function change_avatar_css($class) {
  return str_replace("class='avatar", "class='author_gravatar alignright_icon img-circle", $class) ;
}

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
              <?
                $avatar_size = 54;
                if ( '0' != $comment->comment_parent ) {
                  $avatar_size = 27;
                }
                echo get_avatar( $comment, $avatar_size);
              ?>
              <cite class="fn"><?php echo get_comment_author(); ?></cite>
              <time pubdate datetime="" class="pull-right hidden-phone">Am <?php comment_time('d,M Y'); ?> um <?php comment_time('H:i:s'); ?> Uhr</small></time>
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

  $date = sprintf( 'Veröffentlicht am <time class="entry-date" datetime="%3$s" pubdate>%4$s um %2$s Uhr</time>',
    esc_url( get_permalink() ),
    esc_attr( get_the_time() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() )
  );

  $author = sprintf( '<span class="author vcard">%1$s %2$s</span>',
    get_the_author_meta( 'first_name' ),
    get_the_author_meta( 'last_name' )
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

function get_the_post_thumbnail_by_slug($page_slug, $size='large') {
  $page = get_page_by_path( $page_slug );
  if ($page) :
    return wp_get_attachment_image_src( get_post_thumbnail_id( $page->ID ), $size);
  else :
    return null;
  endif;
}

function sgb_thumbnail( $size='large', $id = 0 ) {
  if ($id == 0) $id = $page->ID;
  $url = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );
  if (!empty($url[0])) $url = $url[0];

  if (!$url) {
    return get_fallback_post_thumbnail($size,$id);
  } else {
    return $url;
  }
}

//function to call first uploaded image in functions file
function get_fallback_post_thumbnail( $size='large', $id = 0 ) {
  if ($id == 0) $id = get_the_ID();

  if ( $url == '' ) :
    $category = get_the_category();
    if ( 'berichte' == $category[0]->slug ) :
      list($first, $title) = explode( ':', get_the_title(), 2 );
      $lc = strtolower( $first );
      $lc = rtrim($lc);
      $lc = str_replace(' ', '', $lc);
      global $wpdb;
      $id = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_name = %s AND post_type= 'page'", $lc ) );
      if ($id)
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id( $id ), $size );
        if ($thumb[0])
          return $thumb[0];
    endif;
  endif;

  return '/wp-content/themes/sgbottwartal/img/sg.logo.quadrat.svg';
}

function sgb_human_time( $id ) {
  $time_difference = current_time('timestamp') - get_the_time('U');
  if($time_difference < 86400) {
    echo 'vor ' . human_time_diff(get_the_time('U',$post), current_time('timestamp'));
  } else {
    echo get_the_time('H:i',$id) . ' Uhr';
  };
  //echo get_the_time('H:i',$id) . ' Uhr';
}

function sgb_sponsoren( $args ) {
  if(empty($args['count'])) $args['count'] = 1;

  $query = array( 'post_type' => 'sponsoren', 'posts_per_page' => $args['count'], 'orderby' => 'rand' );
  if( !empty($args['id']) || !empty($args['tag']) ) $query = array( 'post_type' => 'sponsoren', 'orderby' => 'rand', 'posts_per_page' => '-1' );

  $size = 'sponsor-large';
  if ($args['span'] <= 1 ) $size = 'sponsor-small';
  if ($args['span'] >= 3 ) $size = 'medium';
  $sponsoren = get_posts( $query );
  $output = '<div class="row">';
  foreach($sponsoren as $sponsor) :
    $url_image = sgb_thumbnail( $size, $sponsor->ID );
    $url = get_permalink($sponsor->ID);
    if(!empty($args['id'])) {
      if ( in_array($sponsor->ID, explode(',',$args['id']) ) ) $output .= '<div class="span'.$args['span'].'"><a href="'.$url.'" target="_blank"><img src="'.$url_image.'" class="img-polaroid img-grayscale" title="'.$sponsor->post_title.'"></a></div>';
    } elseif ( !empty($args['tag']) ) {
      $taxonomies = wp_get_post_terms( $sponsor->ID, 'sponsoren_kategorie' );
      foreach ( $taxonomies as $taxonomy) {
        if ( $taxonomy->name == $args['tag'] ) $output .= '<div class="span'.$args['span'].'"><a href="'.$url.'" target="_blank"><img src="'.$url_image.'" class="img-polaroid img-grayscale" title="'.$sponsor->post_title.'"></a></div>';
      }
    } else {
      $output .= '<div class="span'.$args['span'].'"><a href="'.$url.'" target="_blank"><img src="'.$url_image.'" class="img-polaroid img-grayscale" title="'.$sponsor->post_title.'"></a></div>';
    }
  endforeach;
  $output .= '</div>';
  echo $output;
}

function sgb_kommentare( $args ) {
  if(empty($args['count'])) $args['count'] = 5;
  $query = array( 'number' => $args['count'], 'status' => 'approve' );
  $comments = get_comments( $query );
  echo '<ul class="unstyled">';
  foreach($comments as $comment) :
    $avatar_size = 30;
    list($short) = explode("\n",wordwrap($comment->comment_content ,60));
    echo '<li><a href="'.get_permalink( $comment->comment_post_ID ).'">';
    echo get_avatar( $comment, $avatar_size ).' <strong>'.$comment->comment_author . ':</strong></a><span class="pull-right muted">'.sgb_nice_time($comment->comment_date).'</span>';
    echo '<blockquote>'.$short.'...</blockquote>';
    echo '</li>';
  endforeach;
  echo '</ul>';

  //echo $output;
}

function sgb_neuigkeiten( $args ) {
  if(empty($args['count'])) $args['count'] = 5;
  $query = array( 'numberposts' => $args['count'], 'category' => 3 );
  $neuigkeiten = get_posts( $query );
  echo '<ul class="unstyled sgb-ul-style">';
  foreach($neuigkeiten as $neuigkeit) :
    list($short) = explode("\n",wordwrap($neuigkeit->post_title ,100));
    echo '<li>';
    echo '<a href="'.get_permalink($neuigkeit->ID).'">'.$neuigkeit->post_title.'</a>&nbsp;<span class="muted">'.sgb_nice_time($neuigkeit->post_date).'</span>';
    echo '</li>';
  endforeach;
  echo '</ul>';
}

function sgb_berichte( $args ) {
  if(empty($args['count'])) $args['count'] = 5;
  $query = array( 'numberposts' => $args['count'], 'category' => 1 );
  $berichte = get_posts( $query );
  echo '<ul class="unstyled sgb-ul-style">';
  foreach($berichte as $bericht) :
    list($short) = explode("\n",wordwrap($bericht->post_title ,100));
    echo '<li>';
    echo '<a href="'.get_permalink($bericht->ID).'">'.$bericht->post_title.'</a>&nbsp;<span class="muted">'.sgb_nice_time($bericht->post_date).'</span>';
    echo '</li>';
  endforeach;
  echo '</ul>';
}

function sgb_fotos( $args ) {
  global $post;
  $args = array(
    'post_type' => 'attachment',
    'numberposts' => -1,
    'post_status' => null,
    'post_parent' => $post->ID
  );
  $attachments = get_posts( $args );
  ?>
<div id="main" style="display:none;">
  <div class="fotos">
    <div class="fotos-slides">
  <?php
  if ( $attachments ) {
    foreach ( $attachments as $attachment ) {
      #print_r($attachment);
      $thumb = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
      $large = wp_get_attachment_image_src( $attachment->ID, 'large' );
      $title = $attachment->post_title;
      if (!empty($thumb[0])) $thumb = $thumb[0];
      if (!empty($large[0])) $large = $large[0];
      echo '<div class="slide"><img src="'.$large.'" width="920" height="300" /></div>';
    }
  }
  ?>
    </div>
    <div class="fotos-menu">
      <ul>
        <li class="fbar">&nbsp;</li>

  <?php
  if ( $attachments ) {
    foreach ( $attachments as $attachment ) {
      #print_r($attachment);
      $thumb = wp_get_attachment_image_src( $attachment->ID, 'thumbnail' );
      $large = wp_get_attachment_image_src( $attachment->ID, 'large' );
      $title = $attachment->post_title;
      if (!empty($thumb[0])) $thumb = $thumb[0];
      if (!empty($large[0])) $large = $large[0];
      echo '<li class="item"><a href=""><img src="'.$thumb.'" /></a></li>';
    }
  }
  ?>
      </ul>
    </div>
  </div>
</div>
  <?php
  return $output;
}

function sgb_kalender( $args ) {
  $output  = '<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=de"></script>';
  $output .= '<div id="calendar" class="calendar hidden-phone"></div>';
  $output .= '<div id="loading" style="display:none">Loading...</div>';
  $output .= '<div class="modal hide fade" id="event-modal">';
  $output .= '<div class="modal-header">';
  $output .= '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>';
  $output .= '<h3 id="event-title">Modal header</h3>';
  $output .= '</div>';
  $output .= '<div class="modal-body">';
  $output .= '<p id="event-content">Body</p>';
  #$output .= '<div id="map"></div>';
  $output .= '</div>';
  $output .= '</div>';
  return $output;
}

function sgb_seiten( $args ) {
  $pages = '';
  $range = 2;
  $showitems = ($range * 2)+1;
  global $paged;

  if (empty($paged)) $paged = 1;

  if ($pages == '') {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages) {
      $pages = 1;
    }
  }

  if (1 != $pages) {
    echo "<div class='pagination pagination-centered'><ul>";
    if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>Erste Seite</a></li>";
    if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";

    for ($i=1; $i <= $pages; $i++) {
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
        echo ($paged == $i)? "<li class='active'><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
      }
    }

    if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
    if ($paged < $pages-1 && $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>Letzte Seite</a></li>";
    echo "</ul></div>\n";
  }
}

function register_shortcodes(){
  add_shortcode('seiten', 'sgb_seiten');
  add_shortcode('sponsoren', 'sgb_sponsoren');
  add_shortcode('fotos', 'sgb_fotos');
  add_shortcode('neuigkeiten', 'sgb_neuigkeiten');
  add_shortcode('berichte', 'sgb_berichte');
  add_shortcode('kommentare', 'sgb_kommentare');
  add_shortcode('kalender', 'sgb_kalender');
}
add_action( 'init', 'register_shortcodes');

/**
* Custom Meta Boxes
**/
function sgb_meta_boxes() {
  add_meta_box(
    'jobs_meta',
    __( 'Webseite', 'sgb' ),
    'url_meta_box',
    'jobs',
    'side',
    'core'
  );
  add_meta_box(
    'sponsoren_meta_url',
    __( 'Webseite', 'sgb' ),
    'url_meta_box',
    'sponsoren',
    'side',
    'core'
  );
  add_meta_box(
    'sponsoren_meta_adresse',
    __( 'Adresse', 'sgb' ),
    'address_meta_box',
    'sponsoren',
    'side',
    'core'
  );
  add_meta_box(
    'sponsoren_meta_email',
    __( 'E-Mail', 'sgb' ),
    'email_meta_box',
    'sponsoren',
    'side',
    'core'
  );
  add_meta_box(
    'sponsoren_meta_telefon',
    __( 'Telefon', 'sgb' ),
    'phone_meta_box',
    'sponsoren',
    'side',
    'core'
  );
  add_meta_box(
    'event_meta_address',
    __( 'Adresse', 'sgb' ),
    'address_meta_box',
    'event',
    'side',
    'core'
  );
  add_meta_box(
    'event_meta_date',
    __( 'Datum', 'sgb' ),
    'date_meta_box',
    'event',
    'side',
    'core'
  );
  add_meta_box(
    'event_meta_url',
    __( 'Webseite', 'sgb' ),
    'url_meta_box',
    'event',
    'side',
    'core'
  );
}
add_action( 'add_meta_boxes', 'sgb_meta_boxes' );
add_action( 'save_post', 'meta_box_save_postdata' );

function url_meta_box( $post ) {
  global $post;
  $meta = get_post_meta($post->ID,'meta',TRUE);

  wp_nonce_field( plugin_basename( __FILE__ ), 'sgb_noncename' );
  echo '<label for="meta[url]">';
  _e("URL", 'sgb' );
  echo '</label> ';
  echo '<input id="meta[url]" type="url" name="meta[url]" value="';
  if(!empty($meta['url'])) echo $meta['url'];
  echo '" size="25"/>';
}

function phone_meta_box( $post ) {
  global $post;
  $meta = get_post_meta($post->ID,'meta',TRUE);

  wp_nonce_field( plugin_basename( __FILE__ ), 'sgb_noncename' );
  echo '<label for="meta[phone]">';
  _e("Telefon", 'sgb' );
  echo '</label> ';
  echo '<input id="meta[phone]" type="phone" name="meta[phone]" value="';
  if(!empty($meta['phone'])) echo $meta['phone'];
  echo '" size="25"/>';
}

function email_meta_box( $post ) {
  global $post;
  $meta = get_post_meta($post->ID,'meta',TRUE);

  wp_nonce_field( plugin_basename( __FILE__ ), 'sgb_noncename' );
  echo '<label for="meta[email]">';
  _e("E-Mail", 'sgb' );
  echo '</label> ';
  echo '<input id="meta[email]" type="email" name="meta[email]" value="';
  if(!empty($meta['email'])) echo $meta['email'];
  echo '" size="25"/>';
}

function address_meta_box( $post ) {
  global $post;
  $meta = get_post_meta($post->ID,'meta',TRUE);

  wp_nonce_field( plugin_basename( __FILE__ ), 'sgb_noncename' );
  echo '<label for="meta[street]">';
  _e("Strasse", 'sgb' );
  echo '</label> ';
  echo '<input id="meta[street]" type="text" name="meta[street]" value="';
  if(!empty($meta['street'])) echo $meta['street'];
  echo '" size="25" />';
  echo '<label for="meta[city]">';
  _e("PLZ/Ort", 'sgb' );
  echo '</label> ';
  echo '<input id="meta[city]" type="text" name="meta[city]" value="';
  if(!empty($meta['city'])) echo $meta['city'];
  echo '" size="25" />';
}

function date_meta_box( $post ) {
  global $post;
  $meta = get_post_meta($post->ID,'meta',TRUE);

  wp_nonce_field( plugin_basename( __FILE__ ), 'sgb_noncename' );
  echo '<label for="meta[begin]">';
  _e("Beginn (TT.MM.JJJJ HH:MM)", 'sgb' );
  echo '</label> ';
  echo '<input id="meta[begin]" type="datetime" name="meta[begin]" value="';
  if(!empty($meta['begin'])) echo $meta['begin'];
  echo '" size="25"/>';
  echo '<label for="meta[end]">';
  _e("Ende (TT.MM.JJJJ HH:MM)", 'sgb' );
  echo '</label> ';
  echo '<input id="meta[end]" type="datetime" name="meta[end]" value="';
  if(!empty($meta['end'])) echo $meta['end'];
  echo '" size="25" />';
}

function meta_box_save_postdata( $post_id ) {
  if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
    return;
  if ( !wp_verify_nonce( $_POST['sgb_noncename'], plugin_basename( __FILE__ ) ) )
  if ( 'page' == $_POST['post_type'] )
  if ( !current_user_can( 'edit_page', $post_id ) ) {
    return;
  } else {
    if ( !current_user_can( 'edit_post', $post_id ) ) { return; }
  }

  $current_data = get_post_meta($post_id, 'meta', TRUE);
  $new_data = $_POST['meta'];
  sgb_meta_clean($new_data);

  if ($current_data) {
    if (is_null($new_data)) delete_post_meta($post_id,'meta');
    else update_post_meta($post_id,'meta',$new_data);
  } elseif (!is_null($new_data)) {
    add_post_meta($post_id,'meta',$new_data,TRUE);
  }
  return $post_id;
}

function sgb_meta_clean(&$arr) {
  if (is_array($arr)) {
    foreach ($arr as $i => $v) {
      if (is_array($arr[$i])) {
        sgb_meta_clean($arr[$i]);
        if (!count($arr[$i])) { unset($arr[$i]); }
      } else {
        if (trim($arr[$i]) == '') { unset($arr[$i]); }
      }
    }
    if (!count($arr)) { $arr = NULL; }
  }
}

/**
* Custom Taxonomies
**/
function sgb_taxonomy() {
  register_taxonomy(
    'sponsoren_kategorie',
    'sponsoren',
    array(
     'hierarchical' => false,
     'label' => 'Sponsoren Kategorie',
     'query_var' => true,
     'rewrite' => array('slug' => 'sponsoren-kategorie')
    )
  );
  register_taxonomy(
    'termin_kategorie',
    'termine',
    array(
     'hierarchical' => false,
     'label' => 'Termin Kategorie',
     'query_var' => true,
     'rewrite' => array('slug' => 'termin-kategorie')
    )
  );
}
add_action( 'init', 'sgb_taxonomy' );

/**
* Custom Post Types
**/
function sgb_custom_post_types() {
  /**
  * Sponsoren
  **/
  $labels = array(
    'name' => _x('Sponsoren', 'post type general name'),
    'singular_name' => _x('Sponsor', 'post type singular name'),
    'add_new' => _x('Hinzufügen', 'Event'),
    'add_new_item' => __('Sponsor hinzufügen'),
    'edit_item' => __('Sponsor bearbeiten'),
    'new_item' => __('Neuer Sponsor'),
    'view_item' => __('Sponsor anzeigen'),
    'search_items' => __('Search Events'),
    'not_found' =>  __('Keine Sponsoren gefunden'),
    'not_found_in_trash' => __('Keine Sponsoren im Papierkorb'),
    'parent_item_colon' => ''
  );
  $supports = array('title', 'thumbnail', 'editor');

  register_post_type( 'sponsoren',
    array(
      'labels' => $labels,
      'public' => true,
      'supports' => $supports
    )
  );
  register_taxonomy_for_object_type('sponsoren_kategorie', 'sponsoren');

  /**
  * Jobangebote
  **/
  $labels = array(
    'name' => _x('Jobbörse', 'post type general name'),
    'singular_name' => _x('Stellen', 'post type singular name'),
    'add_new' => _x('Hinzufügen', 'Event'),
    'add_new_item' => __('Stelle hinzufügen'),
    'edit_item' => __('Stelle bearbeiten'),
    'new_item' => __('Neue Stelle'),
    'view_item' => __('Stelle anzeigen'),
    'search_items' => __('Stellen suchen'),
    'not_found' =>  __('Keine Stellen gefunden'),
    'not_found_in_trash' => __('Keine Stellen im Papierkorb'),
    'parent_item_colon' => ''
  );
  $supports = array('title', 'editor', 'thumbnail');

  register_post_type( 'jobs',
    array(
      'labels' => $labels,
      'public' => true,
      'supports' => $supports
    )
  );

  /**
  * Events
  **/
  $labels = array(
    'name' => _x('Termine', 'post type general name'),
    'singular_name' => _x('Termin', 'post type singular name'),
    'add_new' => _x('Hinzufügen', 'Event'),
    'add_new_item' => __('Termin hinzufügen'),
    'edit_item' => __('Termin bearbeiten'),
    'new_item' => __('Neuer Termin'),
    'view_item' => __('Termin anzeigen'),
    'search_items' => __('Termin suchen'),
    'not_found' =>  __('Keine Termine gefunden'),
    'not_found_in_trash' => __('Keine Termine im Papierkorb'),
    'parent_item_colon' => ''
  );
  $supports = array('title', 'editor');

  register_post_type( 'event',
    array(
      'labels' => $labels,
      'public' => true,
      'supports' => $supports
    )
  );
  register_taxonomy_for_object_type('termin_kategorie', 'event');
}
add_action( 'init', 'sgb_custom_post_types' );
// Add action to wp_head
// add_action('wp_head','move_admin_bar_bottom');
// Move admin bar to bottom of page
function move_admin_bar_bottom() {
  if(is_user_logged_in()) {
    echo "
    <style type='text/css'>
      * html body { margin-top: 0 !important; }
      body.admin-bar { margin-top: -28px; padding-bottom: 28px; }
      body.wp-admin #footer { padding-bottom: 28px; }
      #wpadminbar { top: auto !important; bottom: 0; }
      #wpadminbar .quicklinks .ab-sub-wrapper { bottom: 28px; }
      #wpadminbar .quicklinks .ab-sub-wrapper ul .ab-sub-wrapper { bottom: -7px; }
    </style>
    ";
  }
}

if ( ! function_exists( 'sgbottwartal_nicetime' ) ) :

/**
 * Return a nice Time Value
 *
 * @since 3.0.0
 */
function sgb_nice_time($date) {
  if(empty($date)) {
    return "Kein Datum angegeben";
  }

  $periods = array("Sekunde", "Minute", "Stunde", "Tage", "Woche", "Monate", "Jahre", "Dekade");
  $lengths = array("60","60","24","7","4.35","12","10");

  $now = time()+7200; // Hack um Zeitproblem auszugleichen
  $unix_date = strtotime($date);

  if(empty($unix_date)) {
    return "Fehlerhaftes Datum (".$date.")";
  }

  if($now > $unix_date) {
    $difference = $now - $unix_date;
    $tense = "vor";
  } else {
    $difference = $unix_date - $now;
    $tense = "in";
  }

  for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
    $difference /= $lengths[$j];
  }

  $difference = round($difference);

  if($difference != 1) {
    $periods[$j].= "n";
  }

  return "{$tense} $difference $periods[$j]";
}
endif;



/**
* THESE FUNCTIONS ALLOW FOR ATTACHMENTS THAT BELONG TO PAGES TO BE REASSIGNED BETWEEN PAGES ON THE MEDIA EDIT SCREEN
*
*/

/**
 *
 * @param array $form_fields
 * @param object $post
 * @return array
 */
function my_image_attachment_fields_to_edit($form_fields, $post) {
  // only activate for images that already attached to pages, ignore images attached to posts
  if (get_post_type($post->post_parent) == 'page') {
    // get the list of pages for our select box
    $all_pages = get_pages();
    $select_code = get_pages_as_select_field($post, $all_pages);
    // $form_fields is a special array of fields to include in the attachment form
    // $post is the attachment record in the database
    // $post->post_type == 'attachment'
    // (attachments are treated as posts in WordPress)
    // add our custom field to the $form_fields array
    // input type="text" name/id="attachments[$attachment->ID][custom1]"
    $form_fields["post_parent"] = array(
      "label" => __("Attatched to page"),
      "input" => "html",
      "html" => $select_code
    );
  }
  return $form_fields;
}

/**
 *
 * @param object $post
 * @param object $all_pages
 * @return string
 */
function get_pages_as_select_field($post, $all_pages) {

    $content = "<select name='attachments[{$post->ID}][post_parent]' id='attachments[{$post->ID}][post_parent]'>";
    foreach ($all_pages as $page) {
      if ($page->ID == $post->post_parent) {
        $selected = ' SELECTED ';
      } else {
        $selected = ' ';
      }
      $option_line = "<option" . $selected . "value='" . $page->ID . "'>" . $page->post_title . "</option>";
      $content = $content . $option_line;
    }
    $content = $content . "</select>";
    return $content;
}

// attach our function to the correct hook
add_filter("attachment_fields_to_edit", "my_image_attachment_fields_to_edit", null, 2);

/**
 * @param array $post
 * @param array $attachment
 * @return array
 */
function my_image_attachment_fields_to_save($post, $attachment) {
  if( isset($attachment['post_parent']) ){
    if( trim($attachment['post_parent']) == '' ){
      // adding our custom error
      $post['errors']['post_parent']['errors'][] = __('No value found for post_parent.');
    }else{
      $post['post_parent'] = $attachment['post_parent'];
    }
  }
  return $post;
}
add_filter("attachment_fields_to_save", "my_image_attachment_fields_to_save", null, 2);

?>