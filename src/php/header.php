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
  <meta name="viewport" content="width=device-width" />
  <title><?php wp_title( '|', true, 'right' ); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <?php wp_head(); ?>
  <!-- Fav and touch icons -->
  <link rel="shortcut icon" href="/wp-content/themes/sgbottwartal/favicon.ico">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/wp-content/themes/sgbottwartal/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/wp-content/themes/sgbottwartal/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/wp-content/themes/sgbottwartal/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="/wp-content/themes/sgbottwartal/apple-touch-icon-57-precomposed.png">
</head>
<body>
<!-- NAVBAR
================================================== -->
<!-- Wrap the .navbar in .container to center it on the page and provide easy way to target it with .navbar-wrapper. -->
<div class="container navbar-wrapper" data-spy="affix">
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
<!-- Wrap the .navbar in .container to center it on the page and provide easy way to target it with .navbar-wrapper. -->
<div class="hidden-phone" data-offset-top="100" id="navbar-affixed" style="display:none;">
  <div class="navbar navbar-fixed-top">
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
<div class="bg-sg" data-spy="affix"></div>
