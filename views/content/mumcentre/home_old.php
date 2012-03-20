<div id="hotboxarea">
    <table width="980" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td width="680">
                <div id="hotbox">
                    <div id="featured" >
                        <ul class="ui-tabs-nav">
                            <li class="ui-tabs-nav-item ui-tabs-selected" id="nav-fragment-1"><a href="#fragment-1">
                                    <h2>Learning with HeARTs</h2>
                                    <p>Come join us for many extraordinary experiences during the school holidays!</p></a></li>
                            <div class="spacer"></div>
                            <li class="ui-tabs-nav-item" id="nav-fragment-2"><a href="#fragment-2">
                                    <h2>Getting your Toddler to Sleep on Her Own Bed</h2><p>Toddlers love to pick their own bed.</p></a></li>
                            <div class="spacer"></div>
                            <li class="ui-tabs-nav-item" id="nav-fragment-3"><a href="#fragment-3">
                                    <h2>Deal of the Day</h2>
                                    <p>Enjoy the featured goods and many more</p></a></li>
                            <div class="spacer"></div>
                            <li class="ui-tabs-nav-item" id="nav-fragment-4"><a href="#fragment-4">
                                    <h2>April Photo Blog Winners</h2><p>Congratulations to the winners for the month of April!</p></a></li>
                        </ul>

                        <!-- First Content -->
                        <div id="fragment-1" class="ui-tabs-panel" style="">
                            <div id="hotboxad_1">
                            <img src="img/hotbox/mum1.jpg" alt="" />
                            </div>
                            <div class="info" >
                                <!--                                <h2><a href="#" >Leaning with HeARTs</a></h2>
                                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla tincidunt condimentum lacus. Pellentesque ut diam....<a href="#" >read more</a></p>-->
                            </div>
                        </div>

                        <!-- Second Content -->
                        <div id="fragment-2" class="ui-tabs-panel ui-tabs-hide" style="">
                            <div id="hotboxad_2">
                            <img src="img/hotbox/mum2.jpg" alt="" />
                            </div>
                            <div class="info" >
                                <!--                                <h2><a href="#" >Getting your Toddler to Sleep on Her Own Bed</a></h2>
                                                                <p>Vestibulum leo quam, accumsan nec porttitor a, euismod ac tortor. Sed ipsum lorem, sagittis non egestas id, suscipit....<a href="#" >read more</a></p>-->
                            </div>
                        </div>

                        <!-- Third Content -->
                        <div id="fragment-3" class="ui-tabs-panel ui-tabs-hide" style="">
                            <div id="hotboxad_3">
                            <img src="img/hotbox/mum3.jpg" alt="" />
                            </div>
                            <div class="info" >
                                <!--                                <h2><a href="#" >Deal of the Day</a></h2>
                                                                <p>liquam erat volutpat. Proin id volutpat nisi. Nulla facilisi. Curabitur facilisis sollicitudin ornare....<a href="#" >read more</a></p>-->
                            </div>
                        </div>

                        <!-- Fourth Content -->
                        <div id="fragment-4" class="ui-tabs-panel ui-tabs-hide" style="">
                            <div id="hotboxad_4">
                            <img src="img/hotbox/mum4.jpg" alt="" />
                            </div>
                            <div class="info" >
                                <!--                                <h2><a href="#" >April Photo Blog Winners</a></h2>
                                                                <p>Quisque sed orci ut lacus viverra interdum ornare sed est. Donec porta, erat eu pretium luctus, leo augue sodales....<a href="#" >read more</a></p>-->
                            </div>
                        </div>

                    </div>
                </div></td>
            <td width="300" align="right">
                <div class="featmrec">
                    <img src="img/ads/mrec.jpg" width="300" height="250"/>
                </div>
            </td>
        </tr>
    </table>
</div>
<!--<marquee behavior="scroll" scrollamount="5" direction="left">
<?= img('system/thicker.jpg'); ?>
        </marquee>-->
<div id="slider">
    <div id="sli-partners"><img src="assets/img/system/sli-partners.jpg" width="20" height="58" /></div>
    <div id="slider-container">
        <div id="ticker1" class="ticker">
            <ul> <?php foreach ($ticker_list->result() as $ticker) {
    ?>
                    <li><a href="ps_providers/profile/<?php echo $ticker->id;?>" target="_blank"><img src="uploaded/provider/ticker/<?php echo $ticker->provider_ticker; ?>"/></a></li>
                <?php } ?>
            </ul>

        </div>
    </div>
</div>
<script type="text/javascript">
    var ticker, stories;
    
    $(function() {
        ticker = $('#ticker1').ticker({pxpersec:20});	
        var newid = ticker.addMsg('');
        setTimeout(function() {
            ticker.removeMsg(newid);
        }, 60000);
    });

</script>
<div id="sidebar1">
    <div id="sponsad"><?= img('system/sponAdwrd.png'); ?></div>
    <div id="c1topbar"></div>
    <div id="sponsad_vert_1" class="ad180"><img src="img/ads/vertical_banner.jpg" width="180" height="150"/></div>
    <div id="sponsad_vert_2" class="ad180"><img src="img/ads/vertical_banner.gif" width="180" height="150"/></div>
    <div id="sponsad_adword_1" class="ad180"><img src="img/ads/ad_word4.jpg" width="180" height="290"/></div>
    <div id="sponsad_adword_2" class="ad180"><img src="img/ads/ad_word3.gif" width="180" height="290"/></div>
    <div id="sponsad_vert_3" class="ad180"><img src="img/ads/vertical_banner.jpg" width="180" height="150"/></div>
    <div id="sponsad_vert_4" class="ad180"><img src="img/ads/vertical_banner.jpg" width="180" height="150"/></div>
</div>

<div id="content">
    <div id="latestArticlesCont">
        <div class="header-container">
            <div class="header-text-container">
                <hh2 class="custFontR">Latest Articles</hh2>
            </div>
            <div class="header-line"></div>
        </div>
        <div class="col2-links-cont">
            <div id="links-but-containerLA">
                <div class="links-but-box">
                    <a href="#" class="class2" style="background-position: 0 0;color: #FFF;" id="pregnancy_link">
                        <div class="links-but-text">Pregnancy</div>
                    </a>
                </div>
                <div class="links-but-spacer"></div>
                <div class="links-but-box">
                    <a href="#" class="class2" id="baby_link">
                        <div class="links-but-text">Baby</div>
                    </a>
                </div>
                <div class="links-but-spacer"></div>
                <div class="links-but-box">
                    <a href="#" class="class2" id="toddler_link">
                        <div class="links-but-text">Toddlers</div>
                    </a>
                </div>
                <div class="links-but-spacer"></div>
                <div class="links-but-box">
                    <a href="#" class="class2" id="preschool_link">
                        <div class="links-but-text">Preschoolers</div>
                    </a>
                </div>
                <div class="links-but-spacer"></div>
                <div class="links-but-box">
                    <a href="#" class="class2" id="parent_link">
                        <div class="links-but-text">Parents</div>
                    </a>
                </div>
            </div>
            <div class="col2line-link"></div>
        </div>
        <div id="article-listing"></div>
    </div>
    <div id="HighLights-Cont">
        <div class="header-containerMCH">
            <div class="header-text-containerMCH">
                <hh2 class="custFontR">MumCentre Highlights</hh2>
            </div>
            <div class="header-line"></div>
        </div>
        <div class="col2-links-cont">
            <div id="links-but-containerMCH">
                <div class="links-but-box">
                    <a href="#" class="class2" style="background-position: 0 0;color: #FFF;" id="review_link">
                        <div class="links-but-text">Reviews</div>
                    </a>
                </div>
                <div class="links-but-spacer"></div>
                <div class="links-but-spacer"></div>
                <div class="links-but-box">
                    <a href="#" class="class2" id="event_link">
                        <div class="links-but-text">Events</div>
                    </a>
                </div>
                <div class="links-but-spacer"></div>
                <div class="links-but-spacer"></div>
                <div class="links-but-box">
                    <a href="#" class="class2" id="program_link">
                        <div class="links-but-text">Programs</div>
                    </a>
                </div>
                <div class="links-but-spacer"></div>
                <div class="links-but-spacer"></div>
                <div class="links-but-box">
                    <a href="#" class="class2" id="curriculum_link">
                        <div class="links-but-text">Curriculums</div>
                    </a>
                </div>
            </div>
            <div class="col2line-link"></div>
        </div><div id="highlights-listing"></div>
    </div>
    <div id="Poll-PhotoBlog-Cont">
        <div id="MumPoll-Cont">
            <div id="MumPoll-header">
                <div id="header-text-containerMP"><hh2 class="custFontR">Mum's Poll</hh2></div>
                <div id="header-lineMP"></div>
            </div>
            <div id="MumPoll-Body">
                <div id="MumP-Questiontxt">
                            	What texture of clothing do you usually choose for your toddler?</div>
                <div id="MumP-allans-cont">
                    <div class="MumP-ans-cont">
                        <div class="MP-radio-cont"><input name="Mum'sPoll" type="radio" value="Anything" checked /></div>
                        <div class="MP-textans-cont">Strictly made in cotton.</div>
                    </div>
                    <div class="MumP-ans-cont">
                        <div class="MP-radio-cont"><input name="Mum'sPoll" type="radio" value="Anything" /></div>
                        <div class="MP-textans-cont">All kinds of linen but should be white in color.</div>
                    </div>
                    <div class="MumP-ans-cont">
                        <div class="MP-radio-cont"><input name="Mum'sPoll" type="radio" value="Anything" /></div>
                        <div class="MP-textans-cont">Soft textured clothes.</div>
                    </div>
                </div> <!-- end MumP-allans-cont -->
                <div id="MP-botm">
                    <div id="MP-VOP"><a href="#">View Other Polls</a></div>
                    <div id="MP-VoteB">
                        <a href="#"><?= img('system/Hm-MP-VoteBT.png'); ?></a>
                    </div>
                </div>
            </div>
        </div>
        <div id="PhotoBlogs-Cont">
            <div id="PhotoBlogs-header">
                <div id="header-text-containerPB"><hh2 class="custFontR">Recent Photo Blogs</hh2></div>
                <div id="header-linePB"></div>
            </div>
            <div id="PhotoBlogs-text">Upload a cover photo, an album or a video of your kids everyday; get the most number of views and be our lucky winner each month. <a href="#"><strong>Create a blog.</strong></a></div>
            <div id="photoblog-listing"></div>
        </div> <!-- end Photoblogs-Conts -->
    </div> <!-- end of MPRPB body -->
    <div id="ActiveMums-Cont">
        <div class="header-container">
            <div class="header-text-container">
                <hh2 class="custFontR">Active Mums</hh2>
            </div>
            <div class="header-line"></div>
        </div>
        <div id="activemums-listing"></div>
    </div> <!-- end ActiveMums-Cont -->
<?= render_partial('global/product_and_service'); ?>
</div> <!-- end .content -->
<div id="sidebar2">
    <div id="c3spacer"></div>
<?= render_partial('global/pow'); ?>
    <?= render_partial('global/create_photoblog'); ?>
    <?= render_partial('global/mum_tools'); ?>
    <div id="sidead_mrec_1" class="cont-250">
        <img src="img/ads/mrec.jpg" width="300" height="250"/>
    </div> <!-- end cont-250 -->
    <div id="sidead_miniad_1" class="cont-250">
        <img src="img/ads/mini_ad.jpg" width="300" height="100"/>
    </div> <!-- end cont-250 -->
    <div id="sidead_miniad_2" class="cont-250">
        <img src="img/ads/mini_ad.jpg" width="300" height="100"/>
    </div> <!-- end cont-250 -->
    <div class="cont-250">
<?= render_partial('global/fb_recent_activity'); ?>
        <!--    <img src="img/ads/MREC.jpg" width="300" height="250"/>-->
    </div>
</div>
<?= render_partial('global/default_footer'); ?>
<script type="text/html" id="baby_article_listing_tpl">
    {{#baby_article_data}}
    <div id="latest-article">    
        {{#latest}}
        <div id="latest-article-img">
            <img width="80" height="80" src="uploaded/article/image/{{article_image}}"/>
        </div>
        <div id="latest-article-text">
            <div id="latest-article-title">
                <a href="baby/{{article_link}}" id="link" class="blueHH">{{article_title}}</a>
            </div>
            <div id="latest-article-summary">
                <span>{{article_summary}}...</span>
                <a href="baby/{{article_link}}" class="article-read-more">» read more </a>
            </div>
        </div>
        {{/latest}}    
    </div>
    <div id="featured-articles">
        <ul>
            {{#featured}}
            <li>
                <div class="featured-article-text">
                    <div id="featured-article-title">
                        <a href="baby/{{article_link}}" id="link" class="blueHH">{{article_title}}</a>
                    </div>
                    <div id="featured-article-summary">
                        <span>{{article_summary}}...<a href="baby/{{article_link}}" class="article-read-more">» read more </a></span>

                    </div>
                </div>
            </li>
            {{/featured}}
        </ul>
    </div>
    {{/baby_article_data}}
</script>
<script type="text/html" id="pregnancy_article_listing_tpl">
    {{#pregnancy_article_data}}
    <div id="latest-article">    
        {{#latest}}
        <div id="latest-article-img">
            <img width="80" height="80" src="uploaded/article/image/{{article_image}}"/>
        </div>
        <div id="latest-article-text">
            <div id="latest-article-title">
                <a href="pregnancy/{{article_link}}" id="link" class="blueHH">{{article_title}}</a>
            </div>
            <div id="latest-article-summary">
                <span>{{article_summary}}...</span>
                <a href="pregnancy/{{article_link}}" class="article-read-more">» read more </a>
            </div>
        </div>
        {{/latest}}    
    </div>
    <div id="featured-articles">
        <ul>
            {{#featured}}
            <li>
                <div class="featured-article-text">
                    <div id="featured-article-title">
                        <a href="pregnancy/{{article_link}}" id="link" class="blueHH">{{article_title}}</a>
                    </div>
                    <div id="featured-article-summary">
                        <span>{{article_summary}}...<a href="pregnancy/{{article_link}}" class="article-read-more">» read more </a></span>

                    </div>
                </div>
            </li>
            {{/featured}}
        </ul>
    </div>
    {{/pregnancy_article_data}}
</script>
<script type="text/html" id="toddler_article_listing_tpl">
    {{#toddler_article_data}}
    <div id="latest-article">    
        {{#latest}}
        <div id="latest-article-img">
            <img width="80" height="80" src="uploaded/article/image/{{article_image}}"/>
        </div>
        <div id="latest-article-text">
            <div id="latest-article-title">
                <a href="toddler/{{article_link}}" id="link" class="blueHH">{{article_title}}</a>
            </div>
            <div id="latest-article-summary">
                <span>{{article_summary}}...</span>
                <a href="toddler/{{article_link}}" class="article-read-more">» read more </a>
            </div>
        </div>
        {{/latest}}    
    </div>
    <div id="featured-articles">
        <ul>
            {{#featured}}
            <li>
                <div class="featured-article-text">
                    <div id="featured-article-title">
                        <a href="toddler/{{article_link}}" id="link" class="blueHH">{{article_title}}</a>
                    </div>
                    <div id="featured-article-summary">
                        <span>{{article_summary}}...<a href="toddler/{{article_link}}" class="article-read-more">» read more </a></span>

                    </div>
                </div>
            </li>
            {{/featured}}
        </ul>
    </div>
    {{/toddler_article_data}}
</script>
<script type="text/html" id="preschool_article_listing_tpl">
    {{#preschool_article_data}}
    <div id="latest-article">    
        {{#latest}}
        <div id="latest-article-img">
            <img width="80" height="80" src="uploaded/article/image/{{article_image}}"/>
        </div>
        <div id="latest-article-text">
            <div id="latest-article-title">
                <a href="preschooler/{{article_link}}" id="link" class="blueHH">{{article_title}}</a>
            </div>
            <div id="latest-article-summary">
                <span>{{article_summary}}...</span>
                <a href="preschooler/{{article_link}}" class="article-read-more">» read more </a>
            </div>
        </div>
        {{/latest}}    
    </div>
    <div id="featured-articles">
        <ul>
            {{#featured}}
            <li>
                <div class="featured-article-text">
                    <div id="featured-article-title">
                        <a href="preschooler/{{article_link}}" id="link" class="blueHH">{{article_title}}</a>
                    </div>
                    <div id="featured-article-summary">
                        <span>{{article_summary}}...<a href="preschooler/{{article_link}}" class="article-read-more">» read more </a></span>

                    </div>
                </div>
            </li>
            {{/featured}}
        </ul>
    </div>
    {{/preschool_article_data}}
</script>
<script type="text/html" id="parent_article_listing_tpl">
    {{#parent_article_data}}
    <div id="latest-article">    
        {{#latest}}
        <div id="latest-article-img">
            <img width="80" height="80" src="uploaded/article/image/{{article_image}}"/>
        </div>
        <div id="latest-article-text">
            <div id="latest-article-title">
                <a href="parents/{{article_link}}" id="link" class="blueHH">{{article_title}}</a>
            </div>
            <div id="latest-article-summary">
                <span>{{article_summary}}...</span>
                <a href="parents/{{article_link}}" class="article-read-more">» read more </a>
            </div>
        </div>
        {{/latest}}    
    </div>
    <div id="featured-articles">
        <ul>
            {{#featured}}
            <li>
                <div class="featured-article-text">
                    <div id="featured-article-title">
                        <a href="parents/{{article_link}}" id="link" class="blueHH">{{article_title}}</a>
                    </div>
                    <div id="featured-article-summary">
                        <span>{{article_summary}}...<a href="parents/{{article_link}}" class="article-read-more">» read more </a></span>

                    </div>
                </div>
            </li>
            {{/featured}}
        </ul>
    </div>
    {{/parent_article_data}}
</script>
<script type="text/html" id="review_listing_tpl">
    {{#review_data}}   
    <div id="HighLights-articleBody">
        <ul class="MCH-ul">
            {{#highlights}}
            <li class="MCH-Li">
                <div class="HighLights-article-cont">
                    <div class="HighLights-article-image"><img width="100" height="70" src="uploaded/provider/review/image/{{review_image}}"/></div>
                    <div class="HighLights-article-text"><a href="#" id="link" class="blueHH">{{review_title}}</a><br />
                        <span>{{review_summary}}</span>
                    </div>
            </li>
            {{/highlights}}
        </ul>
    </div>
    {{/review_data}}           
</script>
<script type="text/html" id="program_listing_tpl">
    {{#program_data}}   
    <div id="HighLights-articleBody">
        <ul class="MCH-ul">
            {{#highlights}}
            <li class="MCH-Li">
                <div class="HighLights-article-cont">
                    <div class="HighLights-article-image"><img width="100" height="70" src="uploaded/provider/program/image/{{program_image}}"/></div>
                    <div class="HighLights-article-text"><a href="#" id="link" class="blueHH">{{program_title}}</a><br />
                        <span>{{program_summary}}</span>
                    </div>
            </li>
            {{/highlights}}
        </ul>
    </div>
    {{/program_data}}           
</script>
<script type="text/html" id="photoblog_listing_tpl">
    {{#photoblog_data}}
    <ul class="phb-ul">
        {{#photoblog}}
        <li class="phb-li">
            <div class="PB-cont">
                <div class="PhotoBlogs-pic-cont">
                    <div class="PhotoBlogs-pic"><a href="#"><img width="50" height="50" src="uploaded/user/photoblog/{{photo_file}}"/></a></div>
                    <div class="PhotoBlogs-text" align="center"><a href="#">{{name}}</a></div>
                </div> <!-- end PB-pic-cont -->
            </div> <!-- end PB-cont -->
        </li>
        {{/photoblog}}
    </ul>
    {{/photoblog_data}}
</script>
<script type="text/html" id="activemums_listing_tpl">
    <div id="ActiveMums-Body">
        {{#activemums_data}}
        <ul class="AM-ul">
            {{#activemums}}
            <li>
                <div class="AM-pic-cont">
                    <div class="AM-pic"><a href="#"><img src="uploaded/user/avatar/{{avatar_filepath}}" width="50" height="50" /></a></div>
                    <div class="AM-text"><a href="#">{{first_name}}</a></div>
                </div>
            </li>
            <div class="ActiveMums-SpacerL"></div>
            {{/activemums}}
        </ul>
        {{/activemums_data}}
    </div> <!-- end ActiveMums-Body -->
</script>    
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $.get("home/pregnancy_article_data", function(response) {
            var data = JSON.parse(response);
            var template = ich.pregnancy_article_listing_tpl(data);
            $('#article-listing').html('');
            $('#article-listing').append(template);
            return false;
        });
        $.get("home/review_data", function(response){
            var data = JSON.parse(response);
            var template = ich.review_listing_tpl(data);
            $('#highlights-listing').html('');
            $('#highlights-listing').append(template);
        });
        $.get("home/photoblog_data", function(response){
            var data = JSON.parse(response);
            var template = ich.photoblog_listing_tpl(data);
            $('#photoblog-listing').html('');
            $('#photoblog-listing').append(template);
        });
        $.get("home/activemums_data", function(response){
            var data = JSON.parse(response);
            var template = ich.activemums_listing_tpl(data);
            $('#activemums-listing').html('');
            $('#activemums-listing').append(template);
        });
        $("#featured").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
        $('#review_link').click(function(e) {
            $.get("home/review_data", function(response){
            var data = JSON.parse(response);
            var template = ich.review_listing_tpl(data);
            $('#highlights-listing').html('');
            $('#highlights-listing').append(template);
        });
            $(this).css({'background-position':'0 0', 'color': '#FFF'});
            $('#event_link,#program_link,#curriculum_link').css({'background-position':'', 'color': '#666'});
            e.preventDefault();
        });
        $('#program_link').click(function(e) {
            $.get("home/program_data", function(response){
            var data = JSON.parse(response);
            var template = ich.program_listing_tpl(data);
            $('#highlights-listing').html('');
            $('#highlights-listing').append(template);
        });
            $(this).css({'background-position':'0 0', 'color': '#FFF'});
            $('#event_link,#review_link,#curriculum_link').css({'background-position':'', 'color': '#666'});
            e.preventDefault();
        });
        $('#pregnancy_link').click(function(e) {
            $.get("home/pregnancy_article_data", function(response) {
                var data = JSON.parse(response);
                var template = ich.pregnancy_article_listing_tpl(data);
                $('#article-listing').html('');
                $('#article-listing').append(template);
                return false;
            });
            $(this).css({'background-position':'0 0', 'color': '#FFF'});
            $('#baby_link,#toddler_link,#preschool_link,#parent_link').css({'background-position':'', 'color': '#666'});
            e.preventDefault();
        });
        $('#baby_link').click(function(e) {
            $.get("home/baby_article_data", function(response) {
                var data = JSON.parse(response);
                var template = ich.baby_article_listing_tpl(data);
                $('#article-listing').html('');
                $('#article-listing').append(template);
                return false;
            });
            $(this).css({'background-position':'0 0', 'color': '#FFF'});
            $('#pregnancy_link,#toddler_link,#preschool_link,#parent_link').css({'background-position':'', 'color': '#666'});
            e.preventDefault();
        });
        $('#toddler_link').click(function(e) {
            $.get("home/toddler_article_data", function(response) {
                var data = JSON.parse(response);
                var template = ich.toddler_article_listing_tpl(data);
                $('#article-listing').html('');
                $('#article-listing').append(template);
                return false;
            });
            $(this).css({'background-position':'0 0', 'color': '#FFF'});
            $('#pregnancy_link,#baby_link,#preschool_link,#parent_link').css({'background-position':'', 'color': '#666'});
            e.preventDefault();
        });
        $('#preschool_link').click(function(e) {
            $.get("home/preschool_article_data", function(response) {
                var data = JSON.parse(response);
                var template = ich.preschool_article_listing_tpl(data);
                $('#article-listing').html('');
                $('#article-listing').append(template);
                return false;
            });
            $(this).css({'background-position':'0 0', 'color': '#FFF'});
            $('#pregnancy_link,#baby_link,#toddler_link,#parent_link').css({'background-position':'', 'color': '#666'});
            e.preventDefault();
        });
        $('#parent_link').click(function(e) {
            $.get("home/parent_article_data", function(response) {
                var data = JSON.parse(response);
                var template = ich.parent_article_listing_tpl(data);
                $('#article-listing').html('');
                $('#article-listing').append(template);
                return false;
            });
            $(this).css({'background-position':'0 0', 'color': '#FFF'});
            $('#pregnancy_link,#baby_link,#preschool_link,#toddler_link').css({'background-position':'', 'color': '#666'});
            e.preventDefault();
        });
    });
</script>
<style type="text/css">
    #ticker1 { 
        font-size: 25px; 
        width: 958px; 
    }
    .ticker { 
        margin:0; 
        padding: 0; 
        width: 100%; 
        height: 58px; 
        font-family: Arial, Helvetica; 
        font-size: 30px; 
        position: absolute; 
    }
    .ticker li {
        float:left; 
        padding-right: 20px;
        padding-top: 7px;
        padding-bottom: 12px;
        overflow: hidden;
    }
</style>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.1/jquery.min.js" ></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.5.3/jquery-ui.min.js" ></script>
<script type="text/javascript" src="js/jquery.ticker.js" ></script>


