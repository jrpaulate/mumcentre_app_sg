<div id="floating">
    <div id="floatmenu">
        <div id="welcome_image" class="fm_item_log">
             <img width="25" height="25" src="uploaded/user/avatar/<?php echo $this->session->userdata('avatar');?>"/>
        </div>
        <div id="welcome_text" class="fm_item_log">
             <a href="user/profile"><?php echo $this->session->userdata('name');?></a>
        </div>
         <div class="fm_item_log">
            <iframe src="//www.facebook.com/plugins/like.php?locale=en_US&href=https%3A%2F%2Fmumcentre.com.sg&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:46px; height:27px; position:relative; top:3px;" allowTransparency="true" width="50px" height="27px"></iframe>
            <!--                <fb:like data-href="http://www.facebook.com/MumCentre.Singapore" send="true" layout="button_count" width="80" show_faces="false" action="recommend"></fb:like>-->
        </div>
        <div class="fm_item_log">
            <a href="https://twitter.com/share" data-url="<?php base_url(); ?>" data-count="none" target="_blank">
                <img src="assets/img/system/float-tweet.png" style="padding: 0px 5px 0px 3px;"/>
                
            </a>
            <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
        </div>
        <div class="fm_item_log">
            <g:plusone annotation="none"></g:plusone>
            <script type="text/javascript">
            </script>
        </div>
     
        
           
        <div class="fm_item_log">
            <a href="#" target="">
                <img src="assets/img/system/float-rss.png" style="margin: 0px 2px 0px 5px;"/>
            </a>
        </div>
    
        
        <div class="fm_item_right">
            <a href="#" id="logout">
                <?= img('system/logout.png'); ?>
            </a>    
          
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