<div id="body2com">
    <input type="hidden" id="profile_id" value="<?php echo $provider_id; ?>" />
    <div id="Header-cont">
        <div id="headtxt-cont">
            <div id="headerText">
                <a href="ps_providers" class="Lblue"><h1 class="class-smaller custFontR">Providers</h1></a>
            </div> 
            <!-- end headerText -->
            <div id="headerMid">
                <div id="crumbs-details"></div>
            </div> <!-- end headerMid -->
        </div> <!-- end headtxt-cont -->
    </div> <!-- end Head-cont -->
    <div id="PSPP-body-cont">
        <div id="PSPP-head-cont">
            <div id="PSPP-head-Lkcont">
                <div class="PSPP-Hlk-cont">
                    <a id="active" href="ps_providers/profile/<?php echo $provider_id; ?>" class="pspplnk">
                        <div class="PSPP-HlK-box">
                            <div class="PSPP-HlK-text">
                                Profile
                            </div>
                        </div>
                    </a>
                </div>
                <div id="menu_review" class="PSPP-Hlk-cont">
                    <a href="ps_providers/reviews/<?php echo $provider_id; ?>" class="pspplnk">
                        <div class="PSPP-HlK-box">
                            <div class="PSPP-HlK-text">
                                Reviews
                            </div>
                        </div>
                    </a>
                </div>
                <div id="menu_program" class="PSPP-Hlk-cont">
                    <a href="ps_providers/programs/<?php echo $provider_id; ?>" class="pspplnk">
                        <div class="PSPP-HlK-box">
                            <div class="PSPP-HlK-text">
                                Programs
                            </div>
                        </div>
                    </a>
                </div>
                <div id="menu_event" class="PSPP-Hlk-cont">
                    <a href="ps_providers/events/<?php echo $provider_id; ?>" class="pspplnk">
                        <div class="PSPP-HlK-box">
                            <div class="PSPP-HlK-text">
                                Event
                            </div>
                        </div>
                    </a>
                </div>
                <div id="menu_curriculum" class="PSPP-Hlk-cont">
                    <a href="ps_providers/curriculums/<?php echo $provider_id; ?>" class="pspplnk">
                        <div class="PSPP-HlK-box">
                            <div class="PSPP-HlK-text-alt">
                                Curriculum
                            </div>
                        </div>
                    </a>
                </div>
                <div id="menu_location" class="PSPP-Hlk-cont">
                    <a href="ps_providers/location/<?php echo $provider_id; ?>" class="pspplnk">
                        <div class="PSPP-HlK-box">
                            <div class="PSPP-HlK-text">
                                Location
                            </div>
                        </div>
                    </a>
                </div>
            </div> <!-- PSPP head LKcont -->
            <div class="PSPP-BBar"></div>
        </div> <!-- PSPP head cont -->
        <div id="provider-details"></div>
    </div> <!-- PSPP body cont -->
</div> <!-- end body2com -->
<div id="sidebar2">
    <div id="c3spacer"></div>
    <?= render_partial('global/observer/sidebar'); ?>
</div>
<?= render_partial('global/default_footer'); ?>
<script type="text/javascript" src="js/ICanHandlebarz.js"></script>
<script type="text/javascript" src="js/handlebars.js"></script>
<script type="text/html" id="crumbs_listing_tpl"> 
    <div class="ArrowBox">
        <?= img('system/Header-Arrow.png'); ?>
    </div> <!-- end ArrowBox -->
    {{#provider_crumbs}}
    {{#crumbs}}
    <div class="textBox">
        <a href="ps_providers/category/{{category_id}}" class="Lblue">{{category_name}}</a>
    </div> <!-- end textBox -->
    <div class="ArrowBox">
        <?= img('system/Header-Arrow.png'); ?>
    </div> <!-- end ArrowBox -->
    <div class="textBox">
        <a href="javascript:;;" class="Lblue">{{provider_name}}</a>
    </div> <!-- end textBox -->
    {{/crumbs}}
    {{/provider_crumbs}}
</script>
<script type="text/html" id="provider_detail_listing_tpl">
    <div id="PSPP-PBI-cont">
        {{#provider_profile}}
        {{#providers}}
        <div id="PSPP-PBI-img">
            <img width="300" height="250" src="uploaded/provider/image/{{provider_image}}"/>
        </div>
        <div id="PSPP-PBI-rightcontainer">
            <div id="PSPP-PBI-companyname">
                {{provider_name}}</div>
            {{#if provider_logo}}
            <div id="PSPP-PBI-Logo-cont">
                <img width="100" height="70" src="uploaded/provider/logo/{{provider_logo}}"/>
            </div>
            {{/if}}
            <div id="PSPP-PBI-info-cont">
                {{#if provider_location}}
                <div id="PSPP-PBI-address">
                    {{provider_location}}
                </div>
                {{/if}}
                {{#if provider_contact}}
                <div id="PSPP-PBI-Tel-cont">
                    <div id="PSPP-PBI-tel-text">
                        Tel no. :
                    </div>
                    <div id="PSPP-PBI-telnum-cont">
                        {{provider_contact}}
                    </div>
                </div> <!-- PSPP PBI Tel cont -->
                {{/if}}
                {{#if provider_link}}
                <div id="PSPP-PBI-webbie">
                    <a href="{{provider_link}}" target="_blank">{{provider_link}}</a>
                </div>
                {{/if}}
                {{#if provider_email}}
                <div id="PSPP-PBI-email">
                    <a href="mailto:{{provider_email}}">{{provider_email}}</a>
                </div>
                {{/if}}
                <div id="PSPP-PBI-Social"><div id="toolbox" class="addthis_toolbox addthis_default_style addthis_32x32_style"></div></div>
            </div> <!-- PSPP-PBI info cont -->
        </div> <!-- PSPP-PBI-rightcontainer -->
    </div> <!-- PSPP PBI cont -->
    <div id="PSPP-PBI-BodyText">
        	{{ provider_details }}
    </div> <!-- PSPP PBI BodyText -->
    {{/providers}}
    {{/provider_profile}}
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var profile_id = $('#profile_id').val();
        $.get("ps_providers/menu_items/"+profile_id+"/"+1, function(response){
           if(response == 0){
               $('#menu_review').css('display','none');
           }
        });
        $.get("ps_providers/menu_items/"+profile_id+"/"+2, function(response){
           if(response == 0){
               $('#menu_program').css('display','none');
           }
        });
        $.get("ps_providers/menu_items/"+profile_id+"/"+3, function(response){
           if(response == 0){
               $('#menu_event').css('display','none');
           }
        });
        $.get("ps_providers/menu_items/"+profile_id+"/"+4, function(response){
           if(response == 0){
               $('#menu_curriculum').css('display','none');
           }
        });
        $.get("ps_providers/provider_profile/"+profile_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_detail_listing_tpl(data);
            
            $('#provider-details').html('');
            $('#provider-details').append(template);
            
            var html_data = $('#PSPP-PBI-BodyText').text();
            $('#PSPP-PBI-BodyText').text('');
            $('#PSPP-PBI-BodyText').html(html_data);
            
            var addthis = "<script type='text/javascript'>"
            addthis+="var tbx = document.getElementById('toolbox'),";
            addthis+="svcs = {facebook_like: '', tweet: '', google_plusone: '', email: ''};";
            addthis+="var ctr = 1;";
            //            addthis+="var addthis_share = {url: 'www.google.com'};";
            addthis+="for (var s in svcs) {";
            addthis+="if (ctr == 1) {tbx.innerHTML += '<a class=";
            addthis+="\"addthis_button_'+s+'\""; 
            addthis+="fb:like:action=\"recommend\" fb:like:layout=\"box_count\">'+svcs[s]+'</a>';}";
            addthis+="else if (ctr == 2) {tbx.innerHTML += '<a class=";
            addthis+="\"addthis_button_'+s+'\""; 
            addthis+="tw:count=\"vertical\" tw:via=\"[Your Twitter Username]\">'+svcs[s]+'</a>';}";
            addthis+="else if (ctr == 3) {tbx.innerHTML += '<a class=";
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
            return false;
        });
        $.get("ps_providers/provider_crumbs/"+profile_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.crumbs_listing_tpl(data);
            $('#crumbs-details').html('');
            $('#crumbs-details').append(template);
            return false;
        });
       
        
        
       
        
  
  
//            $('#PSPP-PBI-BodyText').text('');
//            $('#PSPP-PBI-BodyText').html(map_data);
     });
</script>

<script type="text/javascript">
    function review(){
        var profile_id = $('#profile_id').val();
        window.location = "ps_providers/reviews/"+profile_id;
    }
     
</script>

