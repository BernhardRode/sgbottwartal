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

function remove_images( $content ) {
   $postOutput = preg_replace('/<img[^>]+./','', $content);
   return $postOutput;
}
add_filter( 'the_content', 'remove_images', 100 );

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
        $wp_admin_bar->remove_menu('wp-logo');
}
add_action('wp_before_admin_bar_render', 'admin_bar_remove_logo', 0);

function change_admin_logo() {
  echo '<style type="text/css"> #header-logo { background-image: url('.get_bloginfo('template_directory').'/images/admin_logo.png) !important; } </style>';
}
add_action('admin_head', 'change_admin_logo');

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
    if ( $category[0]->slug == 'berichte') :
      list($first, $title) = explode( ':', get_the_title(), 2 );
      $lc = strtolower( $first );
      if ( preg_match('/herren/',$lc) || preg_match('/damen/',$lc) ) :
        $prefix = '/mannschaften/aktive/';
        $lc =substr_replace($lc,'-', strlen($lc)-1, 0);
      elseif ( preg_match('/jugend/',$lc) || preg_match('/minis/',$lc) || preg_match('/ballschule/',$lc) || preg_match('/technik-athletik/',$lc) ) :
        $prefix = '/mannschaften/jugend/';
      else:
        $prefix = '/';
      endif;
      
      $url = get_the_post_thumbnail_by_slug($prefix.$lc,$size);    
      $url = $url[0];
    endif;
  endif;

  if ( $url == '' && $id ) :
    $slug = the_slug( $id );
    if ( $slug ) :
    $url = '/wp-content/themes/sgbottwartal/img/logo.sg.'.$slug.'.png';
    endif;
  endif;
  if ( $url == '' ) :
    $url = '/wp-content/themes/sgbottwartal/img/logo.sg.'.$size.'.png';
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

function sgb_sponsoren( $args ) {
  if(empty($args['count'])) $args['count'] = 1;
  $args = array( 'post_type' => 'sponsoren', 'posts_per_page' => $args['count'], 'orderby' => 'rand' );
  $loop = new WP_Query( $args );
  $output = '<ul class="unstyled sponsoren hidden-phone">';
  while ( $loop->have_posts() ) : $loop->the_post();
    $url_image = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
    $url_external = get_post_meta( get_the_ID(), meta, TRUE );
    if(empty($url_external['url'])) $url_external['url'] = '';
    $output .= '<li class="span2">';
    if( $url_external ) $output .= '<a href="'.$url_external.'" target="_blank">';
    $output .= '<img src="'.$url_image.'" class="img-polaroid">';
    if( $url_external ) $output .= '</a>';
    $output .= '</li>';
  endwhile;
  $output .= '</ul>';

  return $output;  
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
<div id="main">
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

function register_shortcodes(){
  add_shortcode('sponsoren', 'sgb_sponsoren'); 
  add_shortcode('fotos', 'sgb_fotos'); 
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
    'sponsoren_meta',
    __( 'Webseite', 'sgb' ),
    'url_meta_box',
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
  $supports = array('title', 'thumbnail');

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
  $supports = array('title', 'excerpt');

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

?>