<div id="body2com">
    <div id="Header-cont">
        <div id="HgryBr"></div>
        <div id="headtxt-cont">
            <div id="headerText">
                <h1 class="custFontR"><?php echo $age_group_title; ?></h1>
            </div> 
            <!-- end headerText -->
            <div id="headerMid">
                <div class="ArrowBox">
                    <?= img('system/Header-Arrow.png'); ?>
                </div> <!-- end ArrowBox -->
                <div class="textBox">
                    <a href="pregnancy/all" class="Lblue">All Articles</a>
                </div> <!-- end textBox -->
            </div> <!-- end headerMid -->
            <div id="headtext">
                <div class="socialshare">
                    <!--                	Share-->
                </div> <!-- end socialbox -->
                <div class="socialbox">
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                        <a class="addthis_button_facebook_like" fb:like:action="recommend"></a>
                        <a class="addthis_button_twitter"></a>
                        <!--                        <a class="addthis_button_stumbleupon"></a>-->
                        <a class="addthis_button_google_plusone" g:plusone:count="false"></a>
                        <a class="addthis_button_email"></a>
                    </div>

                    <!-- AddThis Button END -->
                </div>
            </div> <!-- end headtext -->
        </div> <!-- end headtxt-cont -->
        <div id="HbleBr"></div>
    </div> <!-- end Head-cont -->
    <div id="RC2-body-cont">
        <div id="RC2-ArtLk-Head">
            <div id="RC2-ArtLk-cont">
                <span class="class3">
                    <div class="RC2-ALk-cont">
                        <div class="RC2-ALk-Lk">
                            <a href="#">Latest Articles</a>
                        </div> <!-- end RC2 ALk LK -->
                        <div class="RC2-ALk-Lklne"></div>
                        <div class="RC2-ALk-Lkcount-cont">
                            <div class="RC2-num">20</div>
                            <div class="RC2-word">articles</div>
                        </div> <!-- end RC2 ALk Lkcount -->
                    </div> <!-- end RC2 ALk cont -->
                    <div class="RC2-ALk-cont">
                        <div class="RC2-ALk-Lk">
                            <a href="#">Most Popular</a>
                        </div> <!-- end RC2 ALk LK -->
                        <div class="RC2-ALk-Lklne"></div>
                        <div class="RC2-ALk-Lkcount-cont">
                            <div class="RC2-num">40</div>
                            <div class="RC2-word">articles</div>
                        </div> <!-- end RC2 ALk Lkcount -->
                    </div> <!-- end RC2 ALk cont -->
                    <div class="RC2-ALk-contSP">
                        <div class="RC2-ALk-LkSP">
                            <a href="#">All Articles</a>
                        </div> <!-- end RC2 ALk LK -->
                        <div class="RC2-ALk-Lkcount-cont">
                            <div class="RC2-num">473</div>
                            <div class="RC2-word">articles</div>
                        </div> <!-- end RC2 ALk Lkcount -->
                    </div> <!-- end RC2 ALk cont -->
                </span>
            </div> <!-- end RC2 ArtLk cont -->
            <div id="RC2-ArtLk-line"></div>
        </div> <!-- end RC2 ArtLk Head -->
    </div> <!-- end RC2 body cont -->
    <div id="RCAA-Body-container">
        <div id="page_container">
            <div id="RCAA-pagination"></div>
            <ul id="article-listing" class="RCAA-ul"></ul>
            <div id="RCAA-pagination"></div>
        </div>
    </div> <!-- RCAA-Body-container -->
    <div id="MD-area">
        <div id="resallad_mini_1" class="MDad-cont">
            <?php echo $reshome_miniad1; ?>
        </div>
        <div id="resallad_mini_2" class="MDad-cont">
            <?php echo $reshome_miniad2; ?>
        </div>
    </div> <!-- MD area -->
    <div id="RnP-area">
        <div id="RnP-container">
            <div class="wrap">
                <div class="ps-title">
                    Product and Services
                    <div style="border-bottom: 2px solid #3399cc; width: 625px;"></div>
                </div>

                <div class="prodandservices">

                    <div style="">
                        <ul id="review-listing" class="ul-style"></ul>
                    </div>

                </div>


                <br /><br />
            </div>
        </div> <!-- RnP-container -->
    </div> <!-- RnP-Area -->
    <div id="Sponsor-cont">
        <div class="header-container">
            <div class="header-text-container">
                <hh2>Sponsors</hh2></div>
            <div class="header-line"></div>
        </div> <!-- end header-container -->
        <div class="spon-row">
            <div class="spon-col">
                <div id="resallad_sponad_1" class="ad180"><?php echo $reshome_mumad1; ?></div>
            </div> <!-- end spon-col -->
            <div class="spon-colSP">
                <div id="resallad_sponad_2" class="ad180"><?php echo $reshome_mumad2; ?></div>
            </div> <!-- end spon-col -->
            <div class="spon-col">
                <div id="resallad_sponad_3" class="ad180"><?php echo $reshome_mumad3; ?></div>
            </div> <!-- end spon-col -->
        </div> <!-- end spon-row -->
    </div> <!-- end spon cont -->
    <div id="special-container">
        <div id="col1-cont">
            <?= render_partial('global/product_and_service'); ?>
            <div id="PoWC-Cont">
                <div class="header-container">
                    <div class="header-text-container">
                        <hh2>Pic of the Week Contestants</hh2>
                    </div>
                    <div class="header-line"></div>
                </div>
                <div id="PoWC-Body">
                    <ul class="PoWC-ul">
                        <li class="PoWC-liL">
                            <div class="PoWC-pic-cont">
                                <div class="PoWC-pic"><a href="#"><?= img('system/temp-Image.jpg'); ?></a></div>
                                <div class="PoWC-text"><a href="#">#name</a></div>
                            </div>
                        </li>
                        <li class="PoWC-liL">
                            <div class="PoWC-pic-cont">
                                <div class="PoWC-pic"><a href="#"><?= img('system/temp-Image.jpg'); ?></a></div>
                                <div class="PoWC-text"><a href="#">#name</a></div>
                            </div>
                        </li>
                        <li class="PoWC-liL">
                            <div class="PoWC-pic-cont">
                                <div class="PoWC-pic"><a href="#"><?= img('system/temp-Image.jpg'); ?></a></div>
                                <div class="PoWC-text"><a href="#">#name</a></div>
                            </div>
                        </li>
                        <li class="PoWC-liM">
                            <div class="PoWC-pic-cont">
                                <div class="PoWC-pic"><a href="#"><?= img('system/temp-Image.jpg'); ?></a></div>
                                <div class="PoWC-text"><a href="#">#name</a></div>
                            </div>
                        </li>
                        <li class="PoWC-liR">
                            <div class="PoWC-pic-cont">
                                <div class="PoWC-pic"><a href="#"><?= img('system/temp-Image.jpg'); ?></a></div>
                                <div class="PoWC-text"><a href="#">#name</a></div>
                            </div>
                        </li>
                        <li class="PoWC-liR">
                            <div class="PoWC-pic-cont">
                                <div class="PoWC-pic"><a href="#"><?= img('system/temp-Image.jpg'); ?></a></div>
                                <div class="PoWC-text"><a href="#">#name</a></div>
                            </div>
                        </li>
                        <li class="PoWC-liR">
                            <div class="PoWC-pic-cont">
                                <div class="PoWC-pic"><a href="#"><?= img('system/temp-Image.jpg'); ?></a></div>
                                <div class="PoWC-text"><a href="#">#name</a></div>
                            </div>
                        </li>      
                    </ul>
                </div> <!-- end PoWC-Body --> 	      
            </div> <!-- end PoWC-Cont -->
        </div> <!-- col1-cont -->
        <div id="col2-cont">
            <div class="ad-container">
                <div id="resallad_vert_1" class="ad180"><?php echo $reshome_rec1; ?></div>
            </div>
            <div class="ad-spacer10"></div>
            <div class="ad-container">
                <div id="resallad_vert_2" class="ad180"><?php echo $reshome_rec2; ?></div>
            </div>
        </div> <!-- col2-cont -->
    </div> <!-- special container -->
</div> <!-- end body2com -->
<div id="sidebar2">
    <div id="c3spacer"></div>
    <?= render_partial('global/observer/sidebar'); ?>
</div>
<input type="hidden" id="age_group" value="<?php echo $age_group; ?>" />
<?= render_partial('global/default_footer'); ?>

<script type="text/javascript" src="js/jquery.pajinate.js"></script>
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/html" id="article_listing_tpl">
    {{#article_data}}  
    {{#articles}}
    <li class="RCAA-li">
        <div class="RCAA-Body-cont">
            <!--             <div class="RCAA-header"><a href="#" class="Lblue">{{article_title}}</a></div>-->
            <div class="RCAA-ABody-cont">
                <div class="img-cont"><img src="uploaded/article/image/{{article_image}}" width="80" height="90" /></div>
<!--                <div class="img-cont"><img src="images/art-1.jpg" width="80" height="90" /></div>-->
                <div class="RCAA-header"><a href="<?php echo $age_group_link; ?>/{{article_link}}" class="Lblue">{{article_title}}</a></div>
                <div class="text-cont">{{{article_summary}}}</div>
                <div class="link-cont"><a href="<?php echo $age_group_link; ?>/{{article_link}}" class="RCAA">Read more</a></div>
            </div>
        </div> 
    </li>
    {{/articles}}
    {{/article_data}}
</script>
<script type="text/html" id="review_listing_tpl">
    {{#reviews}}
    {{#review}}
<!--    <li class="RnP-Li">
        <div class="RnP-LHeader"><a href="reviews/{{seo_url}}">{{review_title}}</a></div>
        <div class="RnP-Ltxt">{{review_summary}}<a href="reviews/{{seo_url}}">» read more</a></div>
    </li>-->
    <li>
        <div class="ps-wrap">
            <div class="ps2-title">
                {{review_title}}
            </div>
            <div class="ps2-cont2">
                {{{review_summary}}} <a href="reviews/{{seo_url}}" style="text-decoration:none; color: #3399cc;"> read more</a>
            </div>
        </div>
    </li>
    {{/review}}
    {{/reviews}}
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var age_group = $('#age_group').val();
        $.get("resource/all_article_data/"+age_group, function(response){
            var data = JSON.parse(response);
            var template = ich.article_listing_tpl(data);
            $('#article-listing').html('');
            $('#article-listing').append(template);
        
            $('#page_container').pajinate({
                item_container_id : '#article-listing',
                num_page_links_to_display : 3,
                items_per_page : 5,
                nav_panel_id : '#RCAA-pagination'
            });
        });
        
        $.get("resource/latest_reviews/"+age_group, function(response){
            var data = JSON.parse(response);
            var template = ich.review_listing_tpl(data);
            $('#review-listing').html('');
            $('#review-listing').append(template);
        });    
    });
</script>