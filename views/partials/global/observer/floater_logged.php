<div id="floating">
    <div id="floatmenu">
        <div id="welcome_image" class="fm_item_log">
             <img width="25" height="25" src="http://graph.facebook.com/<?php echo $this->session->userdata('fb_id');?>/picture"/>
        </div>
        <div id="welcome_text" class="fm_item_log">
             <?php echo $this->session->userdata('name');?>
        </div>
        <div class="fm_item_log">
            <a href="https://twitter.com/share" data-url="<?php base_url();?>" data-count="none" target="_blank">
                <?= img('system/float-tweet.png'); ?>          
            </a>
            <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
        </div>
        <div class="fm_item_log">
            <a href="#" target="">
                <?= img('system/float-rss.png'); ?> 
            </a>
        </div>
        <div class="fm_item_log">
            <script src="http://www.stumbleupon.com/hostedbadge.php?s=6"></script>
        </div>
        <div class="fm_item_log">
            <iframe src="//www.facebook.com/plugins/like.php?locale=en_US&href=https%3A%2F%2Fwww.facebook.com%2FMumCentre.Singapore&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:46px; height:27px; position:relative; top:3px;" allowTransparency="true" width="50px" height="27px"></iframe>
        </div>
        <div class="fm_item_log">
            <g:plusone annotation="none"></g:plusone>
            <script type="text/javascript">
            </script>
        </div>
        <div class="fm_item_log">
            <?= img('system/float-getupdated.png'); ?> 
        </div>
        <div class="fm_item_log">
            <input type="text" id="su_newsletter_email" value="Type in your email address" title="Type in your email address"/>
        </div>
        <div id="out" class="fm_item_log">
            <a href="javascript::;" id="logout">Log-out?</a>
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