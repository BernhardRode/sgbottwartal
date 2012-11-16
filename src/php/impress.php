<?php
/*
Template Name: Präsentation
*/
/**
* The template for displaying all pages.
*
* This is the template that displays all pages by default.
* Please note that this is the WordPress construct of pages
* and that other 'pages' on your WordPress site will use a
* different template.
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php wp_title( '', true, 'right' ); ?></title>
  <link rel="profile" href="http://gmpg.org/xfn/11" />
  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
  <?php wp_head(); ?>
  <!-- Fav and touch icons -->
  <link rel="shortcut icon" href="/wp-content/themes/sgbottwartal/img/sg.logo.quadrat.svg">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/wp-content/themes/sgbottwartal/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/wp-content/themes/sgbottwartal/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/wp-content/themes/sgbottwartal/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="/wp-content/themes/sgbottwartal/apple-touch-icon-57-precomposed.png">
</head>
<body onload="startTime()" id="impressbody">
<div id="clock"></div>
<div id="impress">
<?php
  $counter = 0;
  $args = array( 'numberposts' => '5' );
  $recent_posts = wp_get_recent_posts( $args );

  function output_slide($id,$content) {
    $class = 'step';
    $data_x = rand(-75000, 75000);
    $data_y = rand(-75000, 75000);
    $data_z =  rand(-3000, 3000);
    $data_rotate =  rand(0, 360);
    $data_scale = rand(0, 10);
    echo '<div id="'.$id.'" class="'.$class.'" data-x="'.$data_x.'" data-y="'.$data_y.'" data-z="'.$data_z.'" data-rotate="'.$data_rotate.'" data-scale="'.$data_scale.'">';
    echo $content;
    echo '</div>';
  }


  foreach( $recent_posts as $recent ){
    $id = $recent->ID;
    $content  = '<h1>'.$recent["post_title"].'</h1>';
    $content .= '<span class="date">'. get_the_time( 'D, d.m.Y H:i' , $recent ).' Uhr</span>';
    output_slide($id,$content);
    if ($counter == 3) {
      // $class = 'step'; 
      // $array = $sponsoren['topsponsoren'];
      // shuffle($array);
      // echo '<div class="'.$class.'" data-x="'.$data_x.'" data-y="'.$data_y.'" data-z="'.$data_z.'" data-rotate="'.$data_rotate.'" data-scale="'.$data_scale.'">';
      // echo '<h1>Danke an unsere Sponsoren!</h1>';
      // echo '<img src="http://www.sg-bottwartal.de/wp-content/themes/sgbottwartal/images/topsponsoren/'.$array[0]['image'].'" width="100">';
      // echo '<img src="http://www.sg-bottwartal.de/wp-content/themes/sgbottwartal/images/topsponsoren/'.$array[1]['image'].'" width="100">';
      // echo '<img src="http://www.sg-bottwartal.de/wp-content/themes/sgbottwartal/images/topsponsoren/'.$array[2]['image'].'" width="100">';
      // echo '</div>';
      $counter = 0;
    }
    $counter++;
    }
  ?>
</div>
<script src="/wp-content/themes/sgbottwartal/lib/impress.js"></script>
<script>
  var impress = impress();
  impress.init();
  var wochentage = ['So.','Mo.','Di.','Mi.','Do.','Fr.','Sa.'];
  var monate = ['Jan','Feb','Mrz','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez'];
  
  document.addEventListener('impress:stepenter', function(e){
    if (typeof timing !== 'undefined') clearInterval(timing);
    var duration = (e.target.getAttribute('data-transition-duration') ? e.target.getAttribute('data-transition-duration') : 2000); 
    timing = setInterval(impress.next, duration);
  });
  
  function startTime() {
    var today=new Date();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();
    var d=today.getDate();
    var y=today.getFullYear();
    var t = wochentage[today.getDay()];
    var monat = monate[today.getMonth()];
    // add a zero in front of numbers<10
    m=checkTime(m);
    s=checkTime(s);
    document.getElementById('clock').innerHTML = t+" "+d+" "+monat+" "+y+"&nbsp;&nbsp;"+h+":"+m+":"+s;
    t=setTimeout(function(){startTime()},500);
  }

  function checkTime(i) {
        if (i<10) { 
            i="0" + i;
        } return i;
  }
  
  function toggleFullscreen() {
    if ((document.fullScreenElement && document.fullScreenElement !== null) || (!document.mozFullScreen && !document.webkitIsFullScreen)) {  
        console.log('true');
        var elem = document.body;
        if (elem.requestFullScreen) {
          elem.requestFullScreen();
        } else if (elem.mozRequestFullScreen) {
          elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullScreen) {
          elem.webkitRequestFullScreen();
        }
    } else {
        console.log('false');
        if (document.cancelFullScreen) {
            document.cancelFullScreen();
        } else if (document.mozCancelFullScreen) {
            document.mozCancelFullScreen();
        } else if (document.webkitCancelFullScreen) {
            document.webkitCancelFullScreen();
        }
    }  
  }
</script>
<script>
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-318144-7']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
</body>
</html>

