<div id="body2com">
    <input type="hidden" id="provider_id" value="<?php echo $provider_id; ?>" />
    <input type="hidden" id="part_id" value="<?php echo $part_id; ?>" />
    <div id="Header-cont">
        <div id="headtxt-cont">
            <div id="headerText">
                <h1 class="class-smaller custFontR">Providers</h1>
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
                    <a href="ps_providers/profile/<?php echo $provider_id; ?>" class="pspplnk">
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
                    <a id="active" href="ps_providers/programs/<?php echo $provider_id; ?>" class="pspplnk">
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
        <div id="PSPE-BI-container">
            <div id="provider_info"></div>
            <div class="PSPE-BBar"></div>
        </div> <!-- PSPE BI container-->
        <div id="PSPE-MBody">
            <div id="PSPE-MBHeader">
            	Programs
            </div>
            <div id="PSPE-MBcontainer">
                <div id="page_container">
                    <div id="RCAA-pagination"></div>
                    <ul id="program-listing"></ul>
                    <div id="RCAA-pagination"></div>
                </div>  
            </div>
        </div> <!-- end PSPE MBody -->
        <div id="gmap_modal"><div id="map_canvas" style="width:660px; height:377px"></div></div>
    </div> <!-- PSPP body cont -->
</div> <!-- end body2com -->
<div id="sidebar2">
    <div id="c3spacer"></div>
    <?= render_partial('global/observer/sidebar'); ?>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e72c7d97e2d14f7"></script>
<?= render_partial('global/default_footer'); ?>
<script type="text/html" id="provider_info_tpl">
    {{#provider_profile}}
    {{#providers}}   
    <div id="PSPE-Img">
        <img width="100" height="70" src="uploaded/provider/logo/{{provider_logo}}"/>
    </div>
    <input id="provider_gmap" type="hidden" value="{{gmap}}"/>
    <div id="PSPE-BI-infob-cont">
        <div id="PSPE-header">
                   {{provider_name}}
                </div>
                {{#if provider_location}}
                <div id="PSPE-address">
                    {{provider_location}}
                </div>
                {{/if}}
                {{#if provider_contact}}
                <div id="PSPE-telp-cont">
                    <div id="PSPE-telp-text">
                        Tel no. :
                    </div>
                    <div id="PSPE-telp">
                        {{provider_contact}}
                    </div>
                </div>
                {{/if}}
                {{#if provider_link}}
                <div id="PSPE-webbie">
                    <a href="{{provider_link}}" target="_blank">
                        {{provider_link}}
                    </a>
                </div>
                {{/if}}
                {{#if provider_email}}
                <div id="PSPE-email">
                    <a href="mailto:{{provider_email}}">
                        {{provider_email}}
                    </a>
                </div>
    </div> <!-- PSPE infob cont -->
    {{/providers}}
    {{/provider_profile}}
</script>
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
<script type="text/html" id="program_list_tpl">
    {{#program_list}}
    {{#programs}}
    <li id="program_{{id}}">
        <div class="PSPE-Content-img">
            <img width="100" height="70" src="uploaded/provider/program/image/{{program_image}}"/>
        </div>
        <div class="PSPE-Content-info-cont">
            <div class="PSPE-info-header">
                <a href="javascript:;;">{{program_title}}</a>
            </div><br/>
            <div class="PSPE-info-quotation"><br/>
                            	{{program_summary}}
            </div>
            <div id="program_{{id}}" class="PSPE-info-link" onclick="javascript:expand({{id}})">
                <a href="javascript:;;">Click here for complete details of this program.</a>
            </div>
            <div class="PSPE-info-socialicons">
                <div class="PSPE-info-link" onclick="javascript:gmap({{gmap}})"><a href="javascript:;;">Click here for map details</a></div>
            </div>
        </div> <!-- end PSPE Ccontent info cont -->
    </li>
    {{/programs}}
    {{/program_list}}
</script>
<script type="text/html" id="program_tpl">
    {{#program_data}}
    <div class="PSPE-CD-Container">
        {{#program}}
        <!--                    	<div class="PSPE-dot-bar"></div>-->
        <div class="PSPE-CD-topcont">
            <div class="PSPE-CD-socialT">
                <div id="toolbox_{{id}}" class="addthis_default_style" addthis:url="<?php echo base_url(); ?>ps_providers/programs/<?php echo $provider_id; ?>/{{id}}"></div>
            </div>
            <div id="shrinker_{{id}}" class="PSPE-CD-close">
                <a href="javascript:;;" onclick="javascript:shrink({{id}})" class="closebut"></a>
            </div>
        </div> <!-- PSPE CD topcont -->
        <div class="PSPE-CD-info">
            <div class="PSPE-CD-Img">	
                <img src="uploaded/provider/program/image/{{program_image}}" width="300" height="250" />                          </div>
            <h2>{{program_title}}</h2><br/>
            <div id="program_body_{{id}}">{{program_body}}</div>
        </div> <!-- PSPE CD info -->

    </div><div class="PSPE-info-socialicons">
        <div class="PSPE-info-link" onclick="javascript:gmap({{gmap}})"><a href="javascript:;;">Click here for map details</a></div>
    </div>
    <!--                    	<div class="PSPE-dot-bar"></div>-->
    {{/program}}
</div> <!-- PSPE CD Container -->
{{/program_data}}
</script>
<script type="text/html" id="program_close">
    {{#program_data}}
    {{#program}}
    <div class="PSPE-Content-img">
        <img width="100" height="70" src="uploaded/provider/program/image/{{program_image}}"/>
    </div>
    <div class="PSPE-Content-info-cont">
        <div class="PSPE-info-header">
            <a href="javascript:;;">{{program_title}}</a>
        </div><br/>
        <div class="PSPE-info-quotation"><br/>
                            	{{program_summary}}
        </div>
        <div id="program_{{id}}" class="PSPE-info-link" onclick="javascript:expand({{id}})">
            <a href="javascript:;;">Click here for complete details of this program.</a>
        </div>
        <div class="PSPE-info-socialicons">
            <div class="PSPE-info-link" onclick="javascript:gmap({{gmap}})"><a href="javascript:;;">Click here for map details</a></div>
        </div>
    </div> <!-- end PSPE Ccontent info cont -->
    {{/program}}
    {{/program_data}}
</script>
<script type="text/javascript" src="js/jquery.pajinate.js"></script>
<script type="text/javascript" src="js/ICanHandlebarz.js"></script>
<script type="text/javascript" src="js/handlebars.js"></script>
<script type="text/javascript">
    var provider_id = $('#provider_id').val();
    var part_id = $('#part_id').val();
    $(document).ready(function(){
        //        initialize();
        $('#gmap_modal').dialog({
            autoOpen: false,
            width: 680
        });
        $.get("ps_providers/menu_items/"+provider_id+"/"+1, function(response){
            if(response == 0){
                $('#menu_review').css('display','none');
            }
        });
        $.get("ps_providers/menu_items/"+provider_id+"/"+2, function(response){
            if(response == 0){
                $('#menu_program').css('display','none');
            }
        });
        $.get("ps_providers/menu_items/"+provider_id+"/"+3, function(response){
            if(response == 0){
                $('#menu_event').css('display','none');
            }
        });
        $.get("ps_providers/menu_items/"+provider_id+"/"+4, function(response){
            if(response == 0){
                $('#menu_curriculum').css('display','none');
            }
        });
        $.get("ps_providers/program_list/"+provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.program_list_tpl(data);
            $('#program-listing').html('');
            $('#program-listing').append(template);
            
            if(part_id > 0) {
                $('html, body').animate({ scrollTop: $("#program_"+part_id).offset().top }, 500);
                expand(part_id);
            }
            
            $('#page_container').pajinate({
                item_container_id : '#program-listing',
                num_page_links_to_display : 3,
                items_per_page : 6,
                nav_panel_id : '#RCAA-pagination'
            });
            
            return false;
        });
        $.get("ps_providers/provider_profile/"+provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_info_tpl(data);
            $('#provider_info').html('');
            $('#provider_info').append(template);
            return false;
        });
        $.get("ps_providers/provider_crumbs/"+provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.crumbs_listing_tpl(data);
            $('#crumbs-details').html('');
            $('#crumbs-details').append(template);
            return false;
        });
        
    });
    function shrink(id){
        $('div#shrinker_'+id).html('');
        $('div#shrinker_'+id).append('<img src="assets/img/system/loading.gif" alt="Loading" id="loading" />');
        $.get("ps_providers/program_data/"+id, function(response) {
            var data = JSON.parse(response);
            var template = ich.program_close(data);
            $('li#program_'+id).html('');
            $('li#program_'+id).append(template);
            $('li#program_'+id).css('height','185');
        });  
    } 
</script>

<script type="text/javascript">
    function expand(id){
        $('div#program_'+id).html('');
        $('div#program_'+id).append('<img src="assets/img/system/loading.gif" alt="Loading" id="loading" />');
        $.get("ps_providers/program_data/"+id, function(response) {
            var data = JSON.parse(response);
            var template = ich.program_tpl(data);
            $('li#program_'+id).html('');
            $('li#program_'+id).append(template);
            $('li#program_'+id).css('height','auto');
            var html_data = $('#program_body_'+id).text();
            $('#program_body_'+id).text('');
            $('#program_body_'+id).html(html_data);
            
            var addthis = "<script type='text/javascript'>"
            addthis+="var tbx = document.getElementById('toolbox_"+id+"'),";
            addthis+="svcs = {facebook: '', twitter: '', google_plusone: '', email: ''};";
            addthis+="var ctr = 1;";
            //            addthis+="var addthis_share = {url: 'www.google.com'};";
            addthis+="for (var s in svcs) {";
            addthis+="if (ctr == 3) {tbx.innerHTML += '<a class=";
            addthis+="\"addthis_button_'+s+'\""; 
            addthis+="g:plusone:count=\"false\">'+svcs[s]+'</a>';}";
            addthis+="else {tbx.innerHTML += '<a class=";
            addthis+="\"addthis_button_'+s+'\"";
            addthis+=">'+svcs[s]+'</a>';}";
            addthis+="ctr++;";
            addthis+="}";
            addthis+="addthis.toolbox('#toolbox_"+id+"');";
            addthis+="<";
            addthis+="/script>";
            //            alert(addthis);
            $('#toolbox_'+id).append(addthis);
            return false;
        });
        
        
    }
</script>

<script>
    function gmap(num1,num2){
        $('#gmap_modal').dialog('open');
        //            var mapper = '1.347525,103.869617';
        //            alert(mapper);
        var latlng = new google.maps.LatLng(-34.397, 150.644); //initialize google map
        var myOptions = {
            zoom: 14,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);
                
        var geocoder;       //start geocoding
        var map;
        var infowindow = new google.maps.InfoWindow();
        var marker;
        geocoder = new google.maps.Geocoder();
        var lat = parseFloat(num1);
        var lng = parseFloat(num2);
        var latlng = new google.maps.LatLng(lat, lng);
        geocoder.geocode({'latLng': latlng}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if (results[1]) {
                    map.setZoom(16);
                    map.setCenter(latlng);
                    marker = new google.maps.Marker({
                        position: latlng,
                        map: map
                    });
                    infowindow.setContent(results[0].formatted_address);
                    infowindow.open(map, marker);
                }
            } else {
                alert("Geocoder failed due to: " + status);
            }
        });
    }
</script>