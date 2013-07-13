<?php
/**
* The Header for our theme.
*
* Displays all of the <head> section and everything up till <div id="main">
*
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
**/
?><!DOCTYPE html>
<!--[if IE 7 | IE 8]>
<html class="ie" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
  <meta charset="<?php bloginfo( 'charset' ); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <title><?php wp_title( '', true, 'right' ); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <?php wp_head(); ?>
  <!-- Fav and touch icons -->
  <meta name="google-site-verification" content="ZXzfo9-BI4VNFPCnGzDykahqXF8PuSpIvFdtkMHYYTA" />
  <link rel="shortcut icon" href="/wp-content/themes/sgbottwartal/img/sg.logo.quadrat.svg">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/wp-content/themes/sgbottwartal/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/wp-content/themes/sgbottwartal/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/wp-content/themes/sgbottwartal/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="/wp-content/themes/sgbottwartal/apple-touch-icon-57-precomposed.png">
  <!-- <script type="text/javascript" src="//use.typekit.net/lxy8qkj.js"></script> -->
  <!-- <script type="text/javascript">try{Typekit.load();}catch(e){}</script>-->
  <link rel="dns-prefetch" href="//twitter.com">
  <link rel="dns-prefetch" href="//www.twitter.com">
  <link rel="dns-prefetch" href="//facebook.com">
  <link rel="dns-prefetch" href="//www.facebook.com">
  <link rel="dns-prefetch" href="//google.com">
  <link rel="dns-prefetch" href="//www.google.com">
  <link rel="dns-prefetch" href="//maps.google.com">
  <link rel="dns-prefetch" href="//plus.google.com">
  <link rel="dns-prefetch" href="//youtube.com">
  <link rel="dns-prefetch" href="//www.youtube.com">
</head>
<body class="hidden">
<div id="fb-root"></div>

<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = '//connect.facebook.net/de_DE/all.js#xfbml=1&appId=354752577944082';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })(document, 'script', 'facebook-jssdk');
</script>
<script type="text/javascript">
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://platform.twitter.com/widgets.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })(document,"script","twitter-wjs");
</script>
<script type="text/javascript">
  window.___gcfg = {lang: 'de'};
  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<!-- NAVBAR
================================================== -->
<!-- Wrap the .navbar in .container to center it on the page and provide easy way to target it with .navbar-wrapper. -->
<header>
    <div class="container navbar-wrapper">
    <div class="navbar">
      <div class="navbar-inner">
        <!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
        <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>
        <a class="brand" href="/">sg<span>bottwartal</span></a>
        <!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
        <div class="nav-collapse collapse">
          <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav' ) ); ?>
        </div><!--/.nav-collapse -->
      </div><!-- /.navbar-inner -->
    </div><!-- /.navbar -->
  </div><!-- /.container -->
  <div class="container hidden-phone header">
    <div class="row">
      <div class="span8">
          <h3 class="muted"><?php is_home() ? bloginfo('description') : wp_title(''); ?></h3>
      </div>
      <div class="span4">
        <h3 class="pull-right">
          <a href="mailto:info@sg-bottwartal.de" class="muted" rel="tooltip" data-placement="bottom" data-original-title="E-Mail"><i class="icon-envelope-alt"></i></a>
          <a href="/gemeinschaft/gastebuch" class="muted" rel="tooltip" data-placement="bottom" data-original-title="Gästebuch"><i class="icon-comments"></i></a>
          <a href="http://www.twitter.com/sgbottwartal" class="muted" target="_blank" rel="tooltip" data-placement="bottom" data-original-title="Twitter"><i class="icon-twitter"></i></a>
          <a href="https://www.facebook.com/SG.Bottwartal" class="muted" target="_blank" rel="tooltip" data-placement="bottom" data-original-title="Facebook"><i class="icon-facebook"></i></a>
          <a href="https://plus.google.com/115598032861617067767" class="muted" target="_blank" rel="tooltip" data-placement="bottom" data-original-title="Google+"><i class="icon-google-plus"></i></a>
          <a href="http://www.youtube.com/user/SGBottwartal" class="muted" target="_blank" rel="tooltip" data-placement="bottom" data-original-title="Youtube"><i class="icon-facetime-video"></i></a>
        </h3>
      </div>
    </div>
  </div>
</header>
<div class="bg"></div>
<!-- Wrap the .navbar in .container to center it on the page and provide easy way to target it with .navbar-wrapper. -->