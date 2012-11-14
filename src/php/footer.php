<?php
/**
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
**/
?>
  </div><!-- #main .wrapper -->
</div><!-- /.container -->
<div class="container hidden-phone">
  <hr>
  <div class="row">
    <div class="span4">
        <h3 class="muted">Neuigkeiten</h3>
        <?php do_shortcode( '[neuigkeiten count="10"]' ); ?>
    </div>
    <div class="span4">
        <h3 class="muted">Spielberichte</h3>
        <?php do_shortcode( '[berichte count="10"]' ); ?>
    </div>
    <div class="span4">
        <h3 class="muted">Kommentare</h3>
        <?php do_shortcode( '[kommentare count="5"]' ); ?>
    </div>
  </div>
</div>
<div class="container hidden-phone">
  <hr>
  <div class="row">
    <div class="span12">
      <?php do_shortcode( '[sponsoren count="6" span="2"]' ); ?>
    </div>
  </div>  
</div>
<footer class="site-footer">
  <div class="container">
  <hr>
    <div class="row">
      <div class="span2">
        <img src="/wp-content/themes/sgbottwartal/img/sg.logo.svg" class="sgb-footer-logo" />
      </div>
      <div class="span4">
        <ul class="unstyled">
          <li><h1><a class="brand" href="/">sg<span>bottwartal</span></a></h1></li>
          <li><h4 class="muted">mehr als ein Sportverein</h4></li>
          <li><a href="mailto:info@sg-bottwartal.de"><i class="icon-envelope"></i> info@sg-bottwartal.de</a></li>
          <li><a href="https://maps.google.com/maps?q=Albert+Einstein+Strasse+20,+71717+Beilstein"><i class="icon-map-marker"></i>Albert-Einstein-Straße 20 // 71717 Beilstein‎</a></li>
        </ul>
      </div>
      <div class="span2 hidden-phone">
        <ul class="unstyled">
          <li><a href="http://www.twitter.com/sgbottwartal"><i class="icon-twitter"></i> Twitter</a></li>
          <li><a href="https://www.facebook.com/SG.Bottwartal"><i class="icon-facebook"></i> Facebook</a></li>
        </ul>
      </div>
      <div class="span2 hidden-phone">
        <ul class="unstyled">
          <li><a href="https://www.facebook.com/SG.Bottwartal"><i class="icon-google-plus"></i> Google+</a></li>
          <li><a href="http://www.youtube.com/user/SGBottwartal"><i class="icon-facetime-video"></i> Youtube</a></li>
        </ul>
      </div>
      <div class="span4 visible-phone">
        <h1>
          <a href="http://www.twitter.com/sgbottwartal"><i class="icon-twitter"></i></a>
          <a href="https://www.facebook.com/SG.Bottwartal"><i class="icon-facebook"></i></a>
          <a href="https://www.facebook.com/SG.Bottwartal"><i class="icon-google-plus"></i></a>
          <a href="http://www.youtube.com/user/SGBottwartal"><i class="icon-facetime-video"></i></a>
        </h1>
      </div>
      <div class="span2">
        <a href="#" class="pull-right">Nach oben <i class="icon-chevron-up"></i></a>
      </div>
    </div>    
    <div class="row grayed hidden-phone hidden-tablet">
      <div class="span6">
        <p class="muted">&copy; 2010-<?php echo date('Y'); ?></p>
      </div>    
      <div class="span6">
        <p class="muted">powered by <a href="http://www.wordpress.org">wordpress</a>, <a href="http://twitter.github.com/bootstrap/index.html">bootstrap</a> &amp; <a href="http://fortawesome.github.com">font awesome</a> with <i class="icon-heart"></i> by <a href="http://bernahrdrode.de">@ebbo</a></p>
      </div>    
    </div>
  </div>
</footer>
<?php wp_footer(); ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/chrome-frame/1/CFInstall.min.js"></script>
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