<div id="body2com">
    <div id="fb-root"></div>
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId  : '261024107269619',
          status : true, // check login status
          cookie : true, // enable cookies to allow the server to access the session
          xfbml  : true  // parse XFBML
        });
      };

      (function() {
        var e = document.createElement('script');
        e.src = document.location.protocol + '//connect.facebook.net/en_US/all.js';
        e.async = true;
        document.getElementById('fb-root').appendChild(e);
      }());
    </script>
    <div id="Header-cont">
        <div id="HgryBr"></div>
        <div id="headtxt-cont">
            <div id="crumbs"></div>
            <div id="headtext">
                <div class="socialshare">
                	Share
                </div><div class="socialbox">
                    <!-- AddThis Button BEGIN -->
                                    <div class="addthis_toolbox addthis_default_style ">
                                        <a class="addthis_button_facebook"></a>
                                        <a class="addthis_button_twitter"></a>
                                        <a class="addthis_button_stumbleupon"></a>
                                        <a class="addthis_button_google_plusone" g:plusone:count="false"></a>
                                        <a class="addthis_button_email"></a>
                                    </div>
                   
                    <!-- AddThis Button END -->
                </div>
            </div> <!-- end headtext -->
        </div> <!-- end headtxt-cont -->
        <div id="HbleBr"></div>
    </div> <!-- end Head-cont -->
    <div id="article-listing"></div>
<!--    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e72c7d97e2d14f7"></script>-->
    <div class="Social-comment-cont">
        <fb:comments num-posts="2" width="660" href="<?php echo current_url();?>"></fb:comments>
    </div> <!-- end Social-comment-cont -->
    <div id="Sponsor-cont">
        <div class="header-container">
            <div class="header-text-container">
                <hh2>Sponsors</hh2></div>
            <div class="header-line"></div>
        </div> <!-- end header-container -->
        <div class="spon-row">
            <div id="resart_sponad_1" class="spon-col">
                <img src="img/ads/ad_word4.jpg" width="180" height="290"/>
            </div> <!-- end spon-col -->
            <div id="resart_sponad_2" class="spon-colSP">
                <img src="img/ads/ad_word3.gif" width="180" height="290"/>
            </div> <!-- end spon-col -->
            <div id="resart_sponad_3" class="spon-col">
                <img src="img/ads/ad_word4.jpg" width="180" height="290"/>
            </div> <!-- end spon-col -->
        </div> <!-- end spon-row -->
    </div>
</div> <!-- end body2com -->
<div id="sidebar2">
    <div id="c3spacer"></div>
    <div class="cont-250">
        <img src="img/ads/MREC.jpg" width="300" height="250"/>
    </div> <!-- end cont-250 -->
    <?= render_partial('global/pow'); ?>
    <?= render_partial('global/create_photoblog'); ?>
    <?= render_partial('global/mum_tools'); ?>
    <div class="cont-250">
        <img src="img/ads/MREC.jpg" width="300" height="250"/>
    </div> <!-- end cont-250 -->
    <div class="cont-250">
        <img src="img/ads/mini_ad.jpg" width="300" height="100"/>
    </div> <!-- end cont-250 -->
    <div class="cont-250">
        <img src="img/ads/mini_ad.jpg" width="300" height="100"/>
    </div> <!-- end cont-250 -->
    <div class="cont-250">
        <?= render_partial('global/fb_recent_activity'); ?>
    </div> <!-- end cont-250 -->
    <div class="cont-250">
        <?= render_partial('global/deal_of_day'); ?>
    </div> <!-- end cont-250 -->
    <!-- end .container --></div>
<div id="features-area">
    <div class="feature-cont">
        <a href="#"><img src="assets/img/system/temp-feature.jpg" width="280" height="145" /></a>
    </div>
    <div class="feature-contSP">
        <a href="#"><img src="assets/img/system/temp-feature.jpg" width="280" height="145" /></a>
    </div>
    <div class="feature-cont">
        <a href="#"><img src="assets/img/system/temp-feature.jpg" width="280" height="145" /></a>
    </div>
</div>
<input type="hidden" id="article_id" value="<?php echo $id; ?>" />
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e72c7d97e2d14f7"></script>
<?= render_partial('global/default_footer'); ?>

<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/html" id="article_tpl">
    {{#article_data}}
    <div id="RC-body-cont">
        <div id="RC-body-header">
            {{#article}}
            <h2>{{article_title}}</h2>
        </div> <!-- end rc-body-header -->
        <div id="RC-body">
            <div class="RC-text-cont">
                <div id="RC-img-cont">
                    <img src="uploaded/article/image/{{article_image}}" width="212" height="235" />
                </div> <!-- end RC-img-cont -->
                <div id="articlecontain">{{article_body}}</div>
                <div id="RC-boxR-cont">
                    <div id="ERV-container">
                        <div id="ERV-Header">
                            <div id="ERV-Text">
                                <ptxt>E</ptxt>vent | <ptxt>R</ptxt>eviews | <ptxt>P</ptxt>rograms
                            </div>
                            <div id="ERV-bar"></div>
                        </div> <!-- end ERV-Header -->
                        <div id="ERV-Body">
                            <div class="ERV-Row">
                                <div class="ERV-IT-cont">
                                    <div class="ERV-icon">
                                        <div class="ERV-icon-text">E</div>
                                    </div> <!-- end ERV-icon -->
                                    <div class="ERV-text-cont">
                                        <a href="#" class="DLblue">Pregnant after 35</a></div> <!-- end ERV-text-container -->
                                </div> <!-- end ERV-IT-Cont -->
                            </div> <!-- end ERV-Row -->
                            <div class="ERV-Row">
                                <div class="ERV-IT-cont">
                                    <div class="ERV-icon">
                                        <div class="ERV-icon-text">P</div>
                                    </div> <!-- end ERV-icon -->
                                    <div class="ERV-text-cont">
                                        <a href="#" class="DLblue">Surviving Morning Sickness</a>
                                    </div> <!-- end ERV-text-container -->
                                </div> <!-- end ERV-IT-Cont -->
                            </div> <!-- end ERV-Row -->
                            <div class="ERV-Row">
                                <div class="ERV-IT-cont">
                                    <div class="ERV-icon">
                                        <div class="ERV-icon-text">R</div>
                                    </div> <!-- end ERV-icon -->
                                    <div class="ERV-text-cont">
                                        <a href="#" class="DLblue">Is She Pregnant?</a>
                                    </div> <!-- end ERV-text-container -->
                                </div> <!-- end ERV-IT-Cont -->
                            </div> <!-- end ERV-Row -->
                            <div class="ERV-Row">
                                <div class="ERV-IT-cont">
                                    <div class="ERV-icon">
                                        <div class="ERV-icon-text">R</div>
                                    </div> <!-- end ERV-icon -->
                                    <div class="ERV-text-cont">
                                        <a href="#" class="DLblue">Menopausal Baby</a>
                                    </div> <!-- end ERV-text-container -->
                                </div> <!-- end ERV-IT-Cont -->
                            </div> <!-- end ERV-Row -->
                            <div class="ERV-Row">
                                <div class="ERV-IT-cont">
                                    <div class="ERV-icon">
                                        <div class="ERV-icon-text">E</div>
                                    </div> <!-- end ERV-icon -->
                                    <div class="ERV-text-cont">
                                        <a href="#" class="DLblue">Gas pain Relief</a>
                                    </div> <!-- end ERV-text-container -->
                                </div> <!-- end ERV-IT-Cont -->
                            </div> <!-- end ERV-Row -->
                            <div class="ERV-Row">
                                <div class="ERV-IT-cont">
                                    <div class="ERV-icon">
                                        <div class="ERV-icon-text">R</div>
                                    </div> <!-- end ERV-icon -->
                                    <div class="ERV-text-cont">
                                        <a href="#" class="DLblue">Pregnant after 35</a>
                                    </div> <!-- end ERV-text-container -->
                                </div> <!-- end ERV-IT-Cont -->
                            </div> <!-- end ERV-Row -->
                            <div class="ERV-Row">
                                <div class="ERV-IT-cont">
                                    <div class="ERV-icon">
                                        <div class="ERV-icon-text">P</div>
                                    </div> <!-- end ERV-icon -->
                                    <div class="ERV-text-cont">
                                        <a href="#" class="DLblue">Morning Sickness..</a>
                                    </div> <!-- end ERV-text-container -->
                                </div> <!-- end ERV-IT-Cont -->
                            </div> <!-- end ERV-Row -->
                            <div class="ERV-Row">
                                <div class="ERV-IT-cont">
                                    <div class="ERV-icon">
                                        <div class="ERV-icon-text">E</div>
                                    </div> <!-- end ERV-icon -->
                                    <div class="ERV-text-cont">
                                        <a href="#" class="DLblue">Is She Pregnant?</a>
                                    </div> <!-- end ERV-text-container -->
                                </div> <!-- end ERV-IT-Cont -->
                            </div> <!-- end ERV-Row -->
                        </div> <!-- end ERV-Body -->
                    </div> <!-- end ERV-container -->
                </div><!-- end RC-boxR-cont -->
                <p>However, not everyone is eligible. Just like any other airlines, they too have certain restriction on pregnancy.            	  </p>
                <p>In this regard, your doctor can help you verify your condition with a medical clearance. When you're fit to travel during pregnancy, you can fly as you wish provided that you are not over in your 35th pregnancy week.</p>
                <p>How about if you're expecting twins or more? You can still secure flights but you will be restricted from flying once you're in your 32nd pregnancy week. Pregnancy week is determined based on the expected due date.</p>

                <p>Singapore Airlines will require you to submit a medical clearance during flight reservation. 
                <div id="RC-boxLbot-cont">
                    <div id="RC-boxL-cont">
                        <div id="PRRT-container">
                            <div id="PRRT-Header">
                                <div id="PRRT-Text">
                                                	People Who Read This Article Read this:
                                </div>
                                <div id="PRRT-bar"></div>
                            </div> <!-- end ERV-Header -->
                            <div id="PRRT-Body">
                                <div class="PRRT-Row">
                                    <div class="PRRT-IT-cont">
                                        <div class="PRRT-text-cont">
                                            <a href="#" class="DLblue">Pregnant after 35</a>
                                        </div> <!-- end ERV-text-container -->
                                    </div> <!-- end ERV-IT-Cont -->
                                </div> <!-- end ERV-Row -->
                                <div class="PRRT-Row">
                                    <div class="PRRT-IT-cont">
                                        <div class="PRRT-text-cont">
                                            <a href="#" class="DLblue">Surviving Morning Sickness for the first timers</a>
                                        </div> <!-- end ERV-text-container -->
                                    </div> <!-- end ERV-IT-Cont -->
                                </div> <!-- end ERV-Row -->
                                <div class="PRRT-Row">
                                    <div class="PRRT-IT-cont">
                                        <div class="PRRT-text-cont">
                                            <a href="#" class="DLblue">Is She Pregnant?</a>
                                        </div> <!-- end ERV-text-container -->
                                    </div> <!-- end ERV-IT-Cont -->
                                </div> <!-- end ERV-Row -->
                                <div class="PRRT-Row">
                                    <div class="PRRT-IT-cont">
                                        <div class="PRRT-text-cont">
                                            <a href="#" class="DLblue">Menopausal Baby</a>
                                        </div> <!-- end ERV-text-container -->
                                    </div> <!-- end ERV-IT-Cont -->
                                </div> <!-- end ERV-Row -->
                                <div class="PRRT-Row">
                                    <div class="PRRT-IT-cont">
                                        <div class="PRRT-text-cont">
                                            <a href="#" class="DLblue">Gas Pain Relief</a>
                                        </div> <!-- end ERV-text-container -->
                                    </div> <!-- end ERV-IT-Cont -->
                                </div> <!-- end ERV-Row -->
                                <div class="PRRT-Row">
                                    <div class="PRRT-IT-cont">
                                        <div class="PRRT-text-cont">
                                            <a href="#" class="DLblue">Pregnant after 35</a>
                                        </div> <!-- end ERV-text-container -->
                                    </div> <!-- end ERV-IT-Cont -->
                                </div> <!-- end ERV-Row -->
                                <div class="PRRT-Row">
                                    <div class="PRRT-IT-cont">
                                        <div class="PRRT-text-cont">
                                            <a href="#" class="DLblue">Surviving Morning Sickness</a>
                                        </div> <!-- end ERV-text-container -->
                                    </div> <!-- end ERV-IT-Cont -->
                                </div> <!-- end ERV-Row -->
                            </div> <!-- end ERV-Body -->
                        </div> <!-- end ERV-container -->
                    </div> <!-- end rc-boxL-cont -->
                    <div id="resart_adword_1" id="RC-boxAD-cont">
                        <img src="img/ads/ad_word4.jpg" width="180" height="290"/>
                    </div> <!-- end rc-boxAD-cont -->
                </div> <!-- end rc-boxLbot-cont -->
                <p>                You can get it from your gynecologist indicating your fitness to travel, exact pregnancy week, and estimated due date.            	  </p>
                <p>If your flight is about a month away from the date of your flight you need to bring with you a new medical certificate issued three days before the departure date. You will present this certificate at the check-in upon request.            	  </p>
                <p>If you have plans on traveling during pregnancy, you should consult your gynecologist as early as now to know if you can still go on flights.            	  </p>
                <p>Secure a medical clearance, which you will need when making a reservation. Be sure that you are not only aware of the pregnancy policies imposed in the airlines but also in the country you plan to visit. </p><br />
                {{/article}}
                {{/article_data}}
                <div id="AF-cont">
                    <div id="AF-cont-body">
                        <div id="AFSocial-buts">
                            <div id="toolbox" class="addthis_toolbox addthis_default_style addthis_32x32_style" ></div>
                        </div>  
                        
                        <div class="AFpignation">
                            <a href="#" class="gray">1</a> | 
                            <a href="#" class="gray">2</a> | 
                            <a href="#" class="gray">3</a>
                        </div>
                    </div> <!-- end Af-cont-body -->
                    <div class="AF-article-cont">
                        <a href="#">
                            <div id="AFblue-box">Next Article &gt;&gt;</div>
                            <div id="AFblue-textarea">
                                &nbsp;Most Trusted Hospitals and Clinic in Pregnancy Care and Chi...
                            </div>
                        </a>
                    </div>
                    <div class="AF-article-cont">
                        <a href="#">
                            <div id="AFgray-box">&lt;&lt; Previous Article</div>
                            <div id="AFgray-textarea">
                                &nbsp;So True So False - Motherhood Myths
                            </div>
                        </a>
                    </div>
                </div> <!-- end AF-cont -->
            </div><!-- end rc-text-cont -->
        </div> <!-- end rc-body -->
    </div> <!-- end rc-body-cont -->
{{/article}}
{{/article_data}}
</script>
<script type="text/html" id="crumbs_tpl">
{{#resource_crumbs}}
{{#crumbs}}
<div id="headerText">
                <h1>{{age_group_name}}</h1>
            </div> 
            <!-- end headerText -->
            <div id="headerMid">
                <div class="ArrowBox">
                    <?= img('system/Header-Arrow.png'); ?>
                </div> <!-- end ArrowBox -->
                <div class="textBox">
                    <a href="<?php echo base_url();?>{{age_group_name}}" class="Lblue">Home</a>
                </div> <!-- end textBox -->
                <div class="ArrowBox">
                    <?= img('system/Header-Arrow.png'); ?>
                </div> <!-- end ArrowBox -->
                <div class="textBox">
                    <a href="#" class="Lblue">Articles</a>
                </div> <!-- end textBox -->
            </div> <!-- end headerMid -->
{{/crumbs}}
{{/resource_crumbs}}
</script>            
<script type="text/javascript">
$(document).ready(function(){
    var article_id = $('#article_id').val();
    $('#soc').css('display','none');
    $.get("resource/article_data/"+article_id, function(response) {
        var data = JSON.parse(response);
        var template = ich.article_tpl(data);
        $('#article-listing').html('');
        $('#article-listing').append(template);
            
        var html_data = $('#articlecontain').text();
        $('#articlecontain').text('');
        $('#articlecontain').html(html_data);
        
        var addthis = "<script type='text/javascript'>"
            addthis+="var tbx = document.getElementById('toolbox'),";
            addthis+="svcs = {facebook_like: '', tweet: '', stumbleupon_badge: '', google_plusone: '', email: ''};";
            addthis+="var ctr = 1;";
//            addthis+="var addthis_share = {templates: {twitter: '{{title}} {{url}} (via @[Your Twitter Username])'}};";
            addthis+="for (var s in svcs) {";
            addthis+="if (ctr == 1) {tbx.innerHTML += '<a class=";
            addthis+="\"addthis_button_'+s+'\""; 
            addthis+="fb:like:layout=\"box_count\">'+svcs[s]+'</a>';}";
            addthis+="else if (ctr == 2) {tbx.innerHTML += '<a class=";
            addthis+="\"addthis_button_'+s+'\""; 
            addthis+="tw:count=\"vertical\"  tw:via=\"[Your Twitter Username]\">'+svcs[s]+'</a>';}";
            addthis+="else if (ctr == 3) {tbx.innerHTML += '<a class=";
            addthis+="\"addthis_button_'+s+'\""; 
            addthis+="su:badge:style=\"5\">'+svcs[s]+'</a>';}";
            addthis+="else if (ctr == 4) {tbx.innerHTML += '<a class=";
            addthis+="\"addthis_button_'+s+'\""; 
            addthis+="g:plusone:size=\"tall\">'+svcs[s]+'</a>';}";
            addthis+="else {tbx.innerHTML += '<a class=";
            addthis+="\"addthis_button_'+s+'\"";
            addthis+=">'+svcs[s]+'</a>';}";
            addthis+="ctr++;";
            addthis+="}";
            addthis+="addthis.toolbox('#toolbox');";
            addthis+="<";
            addthis+="/script>";
//            alert(addthis);
            $('#toolbox').append(addthis);
        //            var addthis = "<div class='addthis_toolbox addthis_default_style addthis_32x32_style'><a class='addthis_button_facebook_like' fb:like:layout='box_count'></a><a class='addthis_button_tweet' tw:count='vertical'></a><a class='addthis_button_stumbleupon_badge' su:badge:style='5'></a><a class='addthis_button_google_plusone' g:plusone:size='tall'></a><a class='addthis_button_email'></a></div>";
        //            $('#AFSocial-buts').append(addthis);

//        var social_data = $('#soc').html();
////        alert(social_data);
//        $('#AFSocial-buts').html('');
//        $('#AFSocial-buts').html(social_data);
        return false;
    });
        $.get("resource/resource_crumbs/"+article_id, function(response) {
        var data = JSON.parse(response);
        var template = ich.crumbs_tpl(data);
        $('#crumbs').html('');
        $('#crumbs').append(template);
    }); 
});
</script>


                            <!--<a class="addthis_button_facebook_like" fb:like:layout="box_count"></a>
                                <a class="addthis_button_tweet" tw:count="vertical"></a>
                                <a class="addthis_button_stumbleupon_badge" su:badge:style="5"></a>
                                <a class="addthis_button_google_plusone" g:plusone:size="tall"></a>
                                <a class="addthis_button_email"></a>-->