<div id="floating">
  <div id="floatmenu">
    <div class="fm_item">
        <?= img('system/float-welcome.png'); ?>        
    </div>
    <div class="fm_item">
      <a href="#">
          <?= img('system/float-login.png'); ?> 
      </a>
    </div>
    <div class="fm_item">
      <a href="register">
          <?= img('system/float-register.png'); ?>
      </a>
    </div>
    <div class="fm_item">
        <?= img('system/float-or.png'); ?>
    </div>
    <div class="fm_item">
      <a href="#">
          <?= img('system/float-fconnect.png'); ?>
      </a>
    </div>
    <div class="fm_item">
      <a href="http://twitter.com/mumcentre" target="_blank">
          <?= img('system/float-tweet.png'); ?>          
      </a>
    </div>
    <div class="fm_item">
      <a href="#" target="">
          <?= img('system/float-rss.png'); ?> 
      </a>
    </div>
    <div class="fm_item">
      <script src="http://www.stumbleupon.com/hostedbadge.php?s=6"></script>
    </div>
    <div class="fm_item">
      <a href="#" id="fblike">
          <?= img('system/float-fb-like.png'); ?>
      </a></div>
    <div class="fm_item">
      <g:plusone annotation="none"></g:plusone>
      <script type="text/javascript">
        (function() {
          var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
          po.src = 'https://apis.google.com/js/plusone.js';
          var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
        })();
      </script>
    </div>
    <div class="fm_item">
        <?= img('system/float-getupdated.png'); ?> 
    </div>
    <div class="fm_item">
      <input type="text" id="su_newsletter_email" value="Type in your email address" title="Type in your email address"/>
    </div>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#su_newsletter_email').focus(function () {
      if ($(this).val() == $(this).attr("title")) {
        $(this).val("");
      }
    }).blur(function () {
      if ($(this).val() == "") {
        $(this).val($(this).attr("title"));
      }
    });
  });
</script>