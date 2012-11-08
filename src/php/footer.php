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
        <?php do_shortcode( '[neuigkeiten count="5"]' ); ?>
    </div>
    <div class="span4">
        <h3 class="muted">Spielberichte</h3>
        <?php do_shortcode( '[berichte count="5"]' ); ?>
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
      <div class="span2 hidden-phone hidden-tablet">
        <embed src="/wp-content/themes/sgbottwartal/img/sg.svg" type="image/svg+xml"  width="100" height="110" />
      </div>
      <div class="span4">
        <ul class="unstyled">
          <li><h1><a class="brand" href="/">sg<span>bottwartal</span></a></h1></li>
          <li><h4 class="muted">mehr als ein Sportverein</h4></li>
          <li><a href="mailto:info@sg-bottwartal.de"><i class="icon-envelope"></i> info@sg-bottwartal.de</a></li>
          <li><a href="https://maps.google.com/maps?q=Albert+Einstein+Strasse+20,+71717+Beilstein"><i class="icon-map-marker"></i>Albert-Einstein-Straße 20, 71717 Beilstein‎</a></li>
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
        <p class="muted"><i class="icon-heart"></i> powered by <a href="http://www.wordpress.org">wordpress</a>, <a href="http://twitter.github.com/bootstrap/index.html">bootstrap</a> &amp; <a href="http://fortawesome.github.com">font awesome</a> &middot; created by <a href="http://bernahrdrode.de">@ebbo</a></p>
      </div>    
    </div>
    <div class="row">
      <div class="span12 class="muted"">
        <?php wp_footer(); ?>
      </div>    
    </div>
  </div>
</footer>
<div id="modal-gallery" class="modal modal-gallery hide fade" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image"></div></div>
    <div class="modal-footer">
        <a class="btn btn-primary modal-next">Next <i class="icon-arrow-right icon-white"></i></a>
        <a class="btn btn-info modal-prev"><i class="icon-arrow-left icon-white"></i> Previous</a>
        <a class="btn btn-success modal-play modal-slideshow" data-slideshow="5000"><i class="icon-play icon-white"></i> Slideshow</a>
        <a class="btn modal-download" target="_blank"><i class="icon-download"></i> Download</a>
    </div>
</div>
<script type="text/javascript">

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