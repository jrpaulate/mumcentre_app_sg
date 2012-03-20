<div id="body2com">
    <input type="hidden" id="article_id" value="<?php echo $id; ?>" />
    <input type="hidden" id="forum_group" value="<?php echo $forum_group; ?>" />
    <div id="content1" class="clear1">
        <div id="content-main">
            <div 	id="section-head">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url(); ?>">Home</a> <span class="divider">/</span></li>
                    <li><a href="<?php
$age = str_replace('-', '', $age_group);
echo url_title($age, 'dash', TRUE);
?>"><?php echo $age_group; ?></a> <span class="divider">/</span></li>
                    <li class="active"><?php echo $article_title; ?></li>
                </ul>
                
                <div class="socialshare">
<!--                	Share-->
                </div> <!-- end socialbox -->
                <div class="socialbox">
                    <!-- AddThis Button BEGIN -->
                    

                    <!-- AddThis Button END -->
                </div>
            
            </div><!-- #section-head --><div class="sher"><div class="addthis_toolbox addthis_default_style ">
                        <a class="addthis_button_facebook_like" fb:like:action="recommend"></a>
                        <a class="addthis_button_twitter"></a>
<!--                        <a class="addthis_button_stumbleupon"></a>-->
                        <a class="addthis_button_google_plusone" g:plusone:count="false"></a>
                        <a class="addthis_button_email"></a>
                    </div></div>
            <div id="section-body">
                <div id="article-body">
                    <div id="article-content">
                        <div class="article-content-wrapper">
                        </div><!-- .article-content-wrapper -->
                        <div class="share-count-container">
                            <ul>
                                <li>
                                    <div id="toolbox" class="addthis_toolbox addthis_default_style addthis_32x32_style" >
                                        <a class="addthis_button_facebook_like" fb:like:layout="box_count" fb:like:action="recommend"></a>
                                        <a class="addthis_button_tweet" tw:count="vertical" tw:via="[Your Twitter Username]"></a>
                                        <a class="addthis_button_google_plusone" g:plusone:size="tall"></a>
                                        <a class="addthis_button_email"></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--                        <div class="pagination fright clearfix">
                                                    <ul>
                                                        <li class="prev disabled"><a href="#">&larr; Previous</a></li>
                                                        <li class="active"><a href="#">1</a></li>
                                                        <li><a href="#">2</a></li>
                                                        <li><a href="#">3</a></li>
                                                        <li><a href="#">4</a></li>
                                                        <li><a href="#">5</a></li>
                                                        <li class="next"><a href="#">Next &rarr;</a></li>
                                                    </ul>
                                                </div> .pagination --><br/>
                        <div id="article-sequence"class="article-sequence">								
                        </div><!-- .article-sequence -->

                        <div id="fl_menu2" class="aside-right"></div><!-- .aside-right -->
                        <div id="fl_menu" class="aside-left">
                            <div class="article-suggestions">
                                <ul id="read_this" class="aside-list">
                                    <!--                                    <li class="list-header">People Who Read This Article Also Read:</li>
                                                                        <li><a href="#" title="Link title">Pregnant after 35</a></li>
                                                                        <li><a href="#" title="Link title">Surviving Morning Sickness for the first timers</a></li>
                                                                        <li><a href="#" title="Link title">Is She Pregnant?</a></li>
                                                                        <li><a href="#" title="Link title">Menopausal Baby</a></li>
                                                                        <li><a href="#" title="Link title">Gas Pain Relief</a></li>
                                                                        <li><a href="#" title="Link title">Pregnant after 35</a></li>
                                                                        <li><a href="#" title="Link title">Surviving Morning Sickness</a></li>-->
                                </ul>
                            </div>
                        </div><!-- .aside-left -->
                        <script>
                           
                        </script>
                    </div><!-- .article-content -->
                    <div id="fbcomment-box" class="clear">
                        <fb:comments num-posts="2" width="660" href="<?php echo current_url(); ?>"></fb:comments>
                    </div><!-- #fbcomment-box -->

                </div><!-- #article body -->
                
                <div class="ads sponsors fleft">
                    <div class="forum box white">
                        <h4 class="lblue custFontR">Latest Forum Discussions</h4>
                        <ul id="forum-listing">
                        </ul>
                    </div><!-- .forum -->
                    <div id="res_mumad2" class="sponsor-box box white fleft">
                        <?php echo $res_mumad2; ?>
                    </div><!-- .sponsor-box -->
                    <div id="res_mumad3" class="sponsor-box box white fleft last">
                        <?php echo $res_mumad3; ?>
                    </div><!-- .sponsor-box -->
                    
                    <div id="res_mumad4"class="sponsor-box box white fleft">
                        <?php echo $res_mumad4; ?>
                    </div><!-- .sponsor-box -->
                    <div id="res_mumad5"class="sponsor-box box white fleft last">
                        <?php echo $res_mumad5; ?>
                    </div><!-- .sponsor-box -->
                </div><!-- .ads .sponsonrs -->

                <div class="ads features">
                    <div id="res_miniad1" class="feat-box box white">
                        <?php echo $res_miniad1; ?>
                    </div><!-- .feat-box -->
                    <div id="res_miniad2" class="feat-box box white">
                        <?php echo $res_miniad2; ?>
                    </div><!-- .feat-box -->
                    <div id="res_miniad3" class="feat-box box white">
                        <?php echo $res_miniad3; ?>
                    </div><!-- .feat-box -->
                    <div id="res_miniad4" class="feat-box box white">
                        <?php echo $res_miniad4; ?>
                    </div><!-- .feat-box -->
                </div><!-- .ads .features -->
            </div><!-- .section-body -->
        </div><!-- .content-main -->
    </div>
</div>
<div id="sidebar2">
    <?= render_partial('global/observer/sidebar'); ?>
</div>
<?= render_partial('global/default_footer'); ?>
<style type="text/css">
    /*    <!--
        body{margin:0px; padding:0px;}
        #fl_menu{
            position:absolute;
            top:570px;
            left:3px;
            z-index:9999;
            width:172px;
            height:50px;
        }
        #fl_menu2{
            position:absolute;
            top:50px;
            left:1162px;
            z-index:9999;
            width:172px;
            height:50px;
        }
        .content{width:520px; margin:50px auto;}
        -->*/
</style>
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/html" id="article_tpl">
    {{#article_data}}
    {{#article}}
    <h1>{{article_title}}</h1>
    <img class="article-thumb" src="uploaded/article/image/{{article_image}}" alt="article image" width="212" height="235"/>
    <div id="art_body" class="article-content-wrapper-text">{{article_body}}</div>
    <input type="hidden" id="age_group" value="{{age_group}}"/>
    <input type="hidden" id="created_date" value="{{created_date}}"/>
    {{/article}}        
    {{/article_data}}        
</script>
<script type="text/html" id="right_list_tpl">
    {{#right_side_data}}
    <div class="article-featured">
        <p class="label"><span>E</span>vent&nbsp;|&nbsp;<span>R</span>eviews&nbsp;|&nbsp;<span>P</span>rograms</p>
        <ul class="aside-list">
            {{#right_side}}  
            <li><span class="legend">{{letter}}</span><a href="<?php echo base_url(); ?>ps_providers/{{type}}/{{provider_id}}/{{id}}" title="{{title}}">{{title}}</a></li>
            {{/right_side}}
        </ul>
    </div>
    {{/right_side_data}}
</script>
<script type="text/html" id="article_sequence_tpl">
    {{#article_data}}
    {{#previous_article}}
    <p class="prev fleft">
        <span class="label">&laquo; Previous Article</span>
        <span class="link"><a href="<?php echo base_url(); ?>{{age_group_name}}/{{link}}" title="Article Title">{{article_title}}</a></span>
    </p>
    {{/previous_article}}
    {{^previous_article}}
    <p class="prev fleft">
        <span class="label">&laquo; Previous Article</span>
        <span class="link">No articles left</span>
    </p>
    {{/previous_article}}
    {{#next_article}}
    <p class="next fright">
        <span class="label">Next Article &raquo;</span>
        <span class="link"><a href="<?php echo base_url(); ?>{{age_group_name}}/{{link}}" title="Article Title">{{article_title}}</a></span>
    </p>
    {{/next_article}}
    {{^next_article}}
    <p class="next fright">
        <span class="label">Next Article &raquo;</span>
        <span class="link">No articles left</span>
    </p>
    {{/next_article}}
    {{/article_data}}  
</script>
<script type="text/html" id="forum_listing_tpl">
    {{#forum_list}}
    {{#forum}}
    <li>
        <a href="<?php echo base_url(); ?>forum/index.php?topic={{id_topic}}">{{subject}}</a>
    </li>
    {{/forum}}
    {{/forum_list}}
</script>
<script type="text/html" id="read_this_tpl">
    {{#read_this}}    
    <li class="list-header">People Who Read This Article Also Read:</li>
    {{#read}}
    <li><a href="<?php echo base_url(); ?>{{age_group_name}}/{{link}}" title="{{article_title}}">{{article_title}}</a></li>
    {{/read}}
    {{/read_this}}   
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var forum_group = $('#forum_group').val();
        var article_id = $('#article_id').val();
        //    $('#soc').css('display','none');
        $.get("resource/forum_list_article/"+forum_group, function(response){
            var data = JSON.parse(response);
            var template = ich.forum_listing_tpl(data);
            $('#forum-listing').html('');
            $('#forum-listing').append(template);
        });
        
        $.get("resource/article_data/"+article_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.article_tpl(data);
            $('.article-content-wrapper').html('');
            $('.article-content-wrapper').append(template);
            
            var html_data = $('.article-content-wrapper-text').text();
            $('.article-content-wrapper-text').text('');
            $('.article-content-wrapper-text').html(html_data);
            
            var age_group_id = $('#age_group').val();
            
            var total_words = $('#art_body').text().split(' ').length;
            var total_p = $('#art_body').html().split('<p>').length - 1;
            //                var words_per_p = $('#art_body p:nth-of-type(1)').text().split(' ').length;
            //                alert(words_per_p);
            var i;
            var count = 0;
            $.get("resource/right_side_data/"+age_group_id, function(response) {
                var data = JSON.parse(response);
                var template = ich.right_list_tpl(data);
                $('#fl_menu2').html('');
                $('#fl_menu2').append(template)
                
                
                for(i = 1; i <= total_p; i++ ){
                    var words_per_p = $('#art_body p:nth-of-type('+i+')').text().split(' ').length;
                    count = count + words_per_p;
                    //                    alert(count);
                    if(count >= (0.2*total_words)){
                        $('#fl_menu2').insertBefore($('#art_body p:nth-of-type('+i+')'));
                        
                        $.get("resource/read_this/"+article_id, function(response){
                            var data = JSON.parse(response);
                            var template = ich.read_this_tpl(data);
//                            $('#read_this').html('');
                            $('#read_this').append(template);
                            $('#fl_menu2').append($('#fl_menu'));
//                            $('#fl_menu').insertAfter($('#fl_menu2'));
                        });
                        break;
                    }
                }
                count = 0;
//                for(i = 1; i <= total_p; i++ ){
//                    var words_per_p = $('#art_body p:nth-of-type('+i+')').text().split(' ').length;
//                    count = count + words_per_p;
//                    //                    alert(count);
//                    if(count >= (0.90*total_words)){
//                        $('#fl_menu').insertBefore($('#art_body p:nth-of-type('+i+')'));
//                        break;
//                    }
//                }
                 
                return false;
            });
            var article_date = $('#created_date').val()
            $.get("resource/article_sequence/"+age_group_id+"/"+article_date, function(response) {
                var data = JSON.parse(response);
                var template = ich.article_sequence_tpl(data);
                $('.article-sequence').html('');
                $('.article-sequence').append(template);

                return false;
            });
            return false;
        });
        
        
//        var html_data = $('#res_mumad1').text();
//        $('#res_mumad1').text('');
//        $('#res_mumad1').html(html_data);
//        var html_data = $('#res_mumad2').text();
//        $('#res_mumad2').text('');
//        $('#res_mumad2').html(html_data);
//        var html_data = $('#res_mumad3').text();
//        $('#res_mumad3').text('');
//        $('#res_mumad3').html(html_data);
//        var html_data = $('#res_mumad4').text();
//        $('#res_mumad4').text('');
//        $('#res_mumad4').html(html_data);
//        var html_data = $('#res_mumad5').text();
//        $('#res_mumad5').text('');
//        $('#res_mumad5').html(html_data);
//        var html_data = $('#res_miniad1').text();
//        $('#res_miniad1').text('');
//        $('#res_miniad1').html(html_data);
//        var html_data = $('#res_miniad2').text();
//        $('#res_miniad2').text('');
//        $('#res_miniad2').html(html_data);
//        var html_data = $('#res_miniad3').text();
//        $('#res_miniad3').text('');
//        $('#res_miniad3').html(html_data);
//        var html_data = $('#res_miniad4').text();
//        $('#res_miniad4').text('');
//        $('#res_miniad4').html(html_data);        
    });
</script>
