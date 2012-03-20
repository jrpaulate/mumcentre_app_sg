<div id="body2com">
    <input type="hidden" id="profile_id" value="<?php echo $provider_id; ?>" />
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
                    <a id="active" href="ps_providers/location/<?php echo $provider_id; ?>" class="pspplnk">
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
        <div id="map_canvas" style="width:660px; height:377px"></div>
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
                <div id="PSPP-PBI-Social">
                    <div id="toolbox" class="addthis_default_style"></div>
                </div>
            </div> <!-- PSPP-PBI info cont -->
        </div> <!-- PSPP-PBI-rightcontainer -->
    </div> <!-- PSPP PBI cont -->
    <div id="PSPP-Loc-Container">
            <div id="PSPP-MAP-container">
            	
            </div>
        </div> <!-- PSPP Loc Container -->
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
            
            var addthis = "<script type='text/javascript'>"
            addthis+="var tbx = document.getElementById('toolbox'),";
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
        
         $.post("ps_providers/getmap/", {
            profile_id : profile_id
        },

        function(data){
//            alert(data);
            var rurl = data.split(":");
            var map = rurl[1];
            var map = map.replace(/[}]]+/g,'');
            var mapper = map.replace(/[""]+/g,'');
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
            var latlngStr = mapper.split(",",2);
            var lat = parseFloat(latlngStr[0]);
            var lng = parseFloat(latlngStr[1]);
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
           
        });
    });
</script>