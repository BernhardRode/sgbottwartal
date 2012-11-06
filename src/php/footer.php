<?php
/**
* @package SGBottwartal
* @subpackage SG_Bottwartal
* @since 2013
**/
?>
  </div><!-- #main .wrapper -->
</div><!-- /.container -->
<div class="bg-sg hidden-phone"></div>
<!-- FOOTER -->
<div class="container">
  <div class="row">
    <div class="span12">
      <?php 
      echo 'helo';
      get_sidebar('footerbar-1'); ?>
    </div>
  </div>
</div>
<footer class="site-footer">
  <div class="container">
    <div class="row">
      <div class="span1">
        <embed src="/wp-content/themes/sgbottwartal/img/sg.logo.svg" type="image/svg+xml"  width="100" height="110" />
      </div>
      <div class="span5">
        <ul>
          <li><a class="brand" href="/">sg<span>bottwartal</span></a></li>
          <li><a href="mailto:info@sg-bottwartal.de"><i class="icon-envelope"></i> info@sg-bottwartal.de</a></li>
          <li><a href="https://maps.google.com/maps?q=Albert+Einstein+Strasse+20,+71717+Beilstein"><i class="icon-map-marker"></i>Albert-Einstein-Straße 20, 71717 Beilstein‎</a></li>
        </ul>
      </div>
      <div class="span2">
        <ul>
          <li><a href="http://www.twitter.com/sgbottwartal"><i class="icon-twitter"></i> Twitter</a></li>
          <li><a href="https://www.facebook.com/SG.Bottwartal"><i class="icon-facebook"></i> Facebook</a></li>
        </ul>
      </div>
      <div class="span2">
        <ul>
          <li><a href="https://www.facebook.com/SG.Bottwartal"><i class="icon-google-plus"></i><span class="hidden-phone"> Google+</span></a></li>
          <li><a href="http://www.youtube.com/user/SGBottwartal"><i class="icon-facetime-video"></i> Youtube</a></li>
        </ul>
      </div>
      <div class="span2">
        <a href="#" class="pull-right">Nach oben <i class="icon-chevron-up"></i></a>
      </div>
    </div>    
    <div class="row grayed">
      <div class="offset1 span5">
        <p>&copy; 2010-<?php echo date('Y'); ?></p>
      </div>    
      <div class="span6">
        <p><i class="icon-heart"></i> powered by <a href="http://www.wordpress.org">wordpress</a>, <a href="http://twitter.github.com/bootstrap/index.html">bootstrap</a> &amp; <a href="http://fortawesome.github.com">font awesome</a> &middot; created by <a href="http://bernahrdrode.de">@ebbo</a></p>
      </div>    
    </div>
    <div class="row">
      <div class="span12">
        <?php wp_footer(); ?>
      </div>    
    </div>
  </div>
</footer>
</body>
</html>