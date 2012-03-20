<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" src="js/jquery.pajinate.js"></script>
<div id="body2com">
    <div id="content1" class="clear1">
        <div id="content-main">
            <div id="section-head">
                <ul class="breadcrumb">
                    <li class="active">Programs<span class="divider"><?= img('system/Header-Arrow.png'); ?></span></li>
                    <li class="active"><?php echo $age_group; ?><span class="divider"><?= img('system/Header-Arrow.png'); ?></span></li>
                    <li class="active"><?php echo $program_title; ?></li>
                </ul>
                <div class="share-container">
                    <ul>
                        <li class="list-header">Share</li>
                        <li><div class="socialbox">
                                <!-- AddThis Button BEGIN -->
                                <div class="addthis_toolbox addthis_default_style ">
                                    <a class="addthis_button_facebook_like" fb:like:action="recommend"></a>
                                    <a class="addthis_button_twitter"></a>
                                    <a class="addthis_button_google_plusone" g:plusone:count="false"></a>
                                    <a class="addthis_button_email"></a>
                                </div>

                                <!-- AddThis Button END -->
                            </div></li>
                    </ul>
                </div>
            </div><!-- #section-head -->
            <div id="program_itself"></div>
            <div id="section-head">
                <ul class="breadcrumb2">
                    <li class="active">Programs<span class="divider"><?= img('system/Header-Arrow.png'); ?></span></li>
                    <li class="active">All Programs</li>

                </ul>
                <div class="share-container">

                </div>
            </div>
            <div class="spacer5"></div>
            <form>
                <tr class="date_range">
                    <td width="209"><strong>From:</strong>&nbsp;
                        <input type="text" name="from" id="from" style="width:120px;"/>
                        <img src="images/calendar-thumb.gif" width="21" height="21" border="0"  />
                    </td>
                    <td width="197"><strong>To:</strong>&nbsp;
                        <input type="text" name="to" id="to" style="width:120px;"/>
                        &nbsp;<img src="images/calendar-thumb.gif" width="21" height="21" border="0"  /></td>
                    <td width="74"><input id="event_prog_time" type="button" name="set" class="go_btn" value="" /></td>
                </tr>
            </form>
            <div class="spacer5"></div>
            <div id="PSPE-MBcontainer">
                <div id="page_container">
                    <div id="RCAA-pagination"></div>
                    <ul id="program-listing" class="RCAA-ul"></ul>
                    <div id="RCAA-pagination"></div>
                </div>
            </div>
            <div class="ads sponsors fleft">
                <div class="sponsor-box box white fleft">
                    <h4>Math Monkey</h4>
                    <div><a href="#" title="Deal"><img src="images/sample-dealday-small.jpg" alt="" /></a>
                        <p>The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.<br/>
                            <a href="#">view details</a></p></div>
                </div><!-- .sponsor-box -->
                <div class="sponsor-box box white fleft last">
                    <h4>Children House</h4>
                    <div><a href="#" title="Deal"><img src="images/sample-dealday-small.jpg" alt="" /></a>
                        <p>The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.<br/>
                            <a href="#">view details</a></p></div>
                </div><!-- .sponsor-box -->
            </div><!-- .ads .sponsonrs -->

            <div class="ads features">
                <div class="feat-box box white">
                    <h4>Featured Reviews</h4>
                    <a class="feat-box-more-link fright" href="#" title="See more deals!">more</a>
                    <hr />
                    <div>
                        <p><strong>Learn Mathematics in a Systematic, Fun and Stress-Free Approach</strong><br/>
                            The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo. </p></div>
                </div><!-- .feat-box -->
                <div class="feat-box box white">
                    <h4>Upcoming Event</h4>
                    <a class="feat-box-more-link fright" href="#" title="See more deals!">more</a>
                    <hr />
                    <div>
                        <p><strong>Learn Mathematics in a Systematic, Fun and Stress-Free Approach</strong><br/>
                            The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo. </p></div>
                </div><!-- .feat-box -->
            </div><!-- .ads .features -->    
        </div><!-- .section-body -->
    </div><!-- .content-main -->
</div>
<div id="sidebar2">
    <?= render_partial('global/observer/sidebar'); ?>
</div>
<?= render_partial('global/default_footer'); ?>
<input type="hidden" id="program_id" value="<?php echo $program_id; ?>" />
<div id="gmap_modal"><div id="map_canvas" style="width:660px; height:377px"></div></div>
<script type="text/html" id="program_list_tpl">
    {{#programs}}
            {{#program}}
            <li>
                <div class="PSPE-Content-img">
                    <img width="90" height="75" src="uploaded/provider/program/image/{{image_filepath}}"/>
                </div>
                <div class="PSPE-Content-info-cont">
                    <div class="PSPE-info-header">
                        <a href="programs/{{seo_url}}">{{title}}</a>
                    </div><br/>
                    <div class="PSPE-info-quotation" style="height: 100px"><br/>
                            	{{{summary}}}
                    </div>
                    <div class="PSPE-info-link">
                        <a href="programs/{{seo_url}}">Click here for complete details on this this program.</a>
                    </div>
                </div> <!-- end PSPE Ccontent info cont -->
            </li>
            {{/program}}
            {{^program}}
            <li>
                <span>No programs available for the chosen time period.</span>
            </li> 
            {{/program}}
        {{/programs}}
</script>
<script type="text/html" id="program_tpl">
    {{#program_data}}
    {{#program}}
    <div class="PSPE-CD-Container">
        <div class="PSPE-CD-topcont">
        </div> <!-- PSPE CD topcont -->
        <div class="PSPE-CD-info">
            <div class="PSPE-CD-Img">

                <img src="uploaded/provider/program/image/{{program_image}}" width="300" height="250" />                          </div>
            <h2>{{program_title}}</h2><br/>
            <div id="program_body">{{{program_body}}}</div>
            <div class="PSPE-CD-socialB">
                <div class="PSPE-info-link" onclick="javascript:gmap({{gmap}})"><a class="blue" href="javascript:;;">Click here for map details</a> |</div>
            </div>
            <div class="PSPE-CD-socialB">
                <div class="PSPE-info-link blue" ><a class="blue" href="ps_providers/profile/{{provider_id}}">Click here for provider details</a></div>
            </div>
        </div>
        {{/program}}
        {{/program_data}}
</script>
<script type="text/javascript">
        $(document).ready(function(){
            var d = new Date();
            var curr_year = d.getFullYear();
            var year_range = '1800:'+ curr_year;
            $('#gmap_modal').dialog({
                autoOpen: false,
                width: 680
            });
            $('#from').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                yearRange: year_range
            });
        
            $('#to').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                yearRange: year_range
            });
        
            var program_id = $('#program_id').val();
            $.get("programs/all_programs_list", function(response) {
                var data = JSON.parse(response);
                var template = ich.program_list_tpl(data);
                $('#program-listing').html('');
                $('#program-listing').append(template);
            
                $('#page_container').pajinate({
                    item_container_id : '#program-listing',
                    num_page_links_to_display : 4,
                    items_per_page : 5,
                    nav_panel_id : '#RCAA-pagination'
                });
                return false;
            });
            $.get("ps_providers/program_data/"+program_id, function(response) {
                var data = JSON.parse(response);
                var template = ich.program_tpl(data);
                $('#program_itself').html('');
                $('#program_itself').append(template);
            
                var html_data = $('#program_body').text();
                $('#program_body').text('');
                $('#program_body').html(html_data);
                return false;
            });
        
            $('#event_prog_time').click(function(e){
                var from = $('#from').val();
                var to = $('#to').val();
                if (from.length == 0){
                    alert('Select "from" date');
                } 
                else if (to.length == 0){
                    alert('Select "to" date');
                }
                else if(to < from){
                    alert('"to" date must be later than the "from" date')
                } else {
                    //                alert('get event by date');
                    $.get("ps_providers/programs_time/"+from+"/"+to, function(response) {
                        var data = JSON.parse(response);
                        var template = ich.program_list_tpl(data);
                        $('#program-listing').html('');
                        $('#program-listing').append(template);
                        return false;
                    });
                }
                e.preventDefault(); 
            });
        });
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
