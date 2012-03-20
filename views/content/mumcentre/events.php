<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" src="js/jquery.pajinate.js"></script>
<div id="body2com">
    <div id="content1" class="clear1">
        <div id="content-main">
            <div id="section-head">
                <ul class="breadcrumb">
                    <li class="active">Events<span class="divider"><?= img('system/Header-Arrow.png'); ?></span></li>
                    <li class="active"><?php echo $age_group; ?><span class="divider"><?= img('system/Header-Arrow.png'); ?></span></li>
                    <li class="active"><?php echo $event_title; ?></li>
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
            <div id="event_itself"></div>
            <div id="section-head">
                <ul class="breadcrumb2">
                    <li class="active">Events<span class="divider"><?= img('system/Header-Arrow.png'); ?></span></li>
                    <li class="active">All Events</li>

                </ul>
                <div class="share-container">

                </div>
            </div>
            <div class="spacer5"></div>
            <form>
                <tr class="date_range">
                    <td width="172" height="40"><strong>Event Type</strong>
                        <select>
                            <option>Event Type1</option>
                        </select>
                    </td>
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
                    <ul id="event-listing" class="RCAA-ul"></ul>
                    <div id="RCAA-pagination"></div>
                </div>
            </div>
            <div class="ads sponsors fleft">
                <div class="sponsor-box box white fleft">
                    <?php echo $event_mumad1; ?>
                </div><!-- .sponsor-box -->
                <div class="sponsor-box box white fleft last">
                    <?php echo $event_mumad2; ?>
                </div><!-- .sponsor-box -->
            </div><!-- .ads .sponsonrs -->

            <div class="ads features">
                <div class="feat-box box white">
                    <?php echo $event_boxad1; ?>
                </div><!-- .feat-box -->
                <div class="feat-box box white">
                   <?php echo $event_boxad2; ?>
                </div><!-- .feat-box -->
            </div><!-- .ads .features -->    
        </div><!-- .section-body -->
    </div><!-- .content-main -->
</div>
<div id="sidebar2">
    <?= render_partial('global/observer/sidebar'); ?>
</div>
<?= render_partial('global/default_footer'); ?>
<input type="hidden" id="event_id" value="<?php echo $event_id; ?>" />
<div id="gmap_modal"><div id="map_canvas" style="width:660px; height:377px"></div></div>
<script type="text/html" id="event_listing_tpl">
    {{#events}} 
    {{#event}}
    <li>
        <div class="PSPE-Content-img">
            <img width="90" height="75" src="uploaded/provider/event/image/{{image_filepath}}"/>
        </div>
        <div class="PSPE-Content-info-cont">
            <div class="PSPE-info-header">
                <a href="events/{{seo_url}}">{{title}}</a>
            </div>
            <div class="PSPE-info-datecont">
                <div class="PSPE-datefrom">
                                	{{start_date}}
                </div>
                <div class="PSPE-date2">
                                	to
                </div>
                <div class="PSPE-dateto">
                                	{{end_date}}
                </div>
            </div> <!-- PSEPE-info-datecont -->
            <div class="PSPE-info-quotation">
                <!--                            	{{event_summary}}-->
            </div>
            <div class="PSPE-info-valuecont">
                <div class="PSPE-value-text">
                                	Venue:
                </div>
                <div class="PSPE-value-value">
                                	{{venue}}
                </div>
            </div> <!-- PSPE info valuecont -->
            <div class="PSPE-info-valuecont">
                <div class="PSPE-value-text">
                                	Contact Person:
                </div>
                <div class="PSPE-value-value">
                                	{{contact_person}}
                </div>
            </div> <!-- PSPE info valuecont -->
            <div class="PSPE-info-valuecont">
                <div class="PSPE-value-text">
                                	Time:
                </div>
                <div class="PSPE-value-value">
                                	{{time}}
                </div>
            </div> <!-- PSPE info valuecont -->
            <div class="PSPE-info-valuecont">
                <div class="PSPE-value-text">
                                	Cost:
                </div>
                <div class="PSPE-value-value">
                                	{{cost}}
                </div>
            </div> <!-- PSPE info valuecont -->
            <div class="PSPE-info-link">
                <a href="events/{{seo_url}}" >Click here for complete details on this this event.</a>
            </div>
        </div> <!-- end PSPE Ccontent info cont -->
    </li>
    {{/event}}
    {{^event}}
    <li>
        <span>Choose a date to show events</span>
    </li>   
    {{/event}}
    {{/events}}  
</script>
<script type="text/html" id="event_tpl">
    {{#event_data}}
    {{#event}}
    <div class="PSPE-CD-Container">
        <div class="PSPE-CD-topcont">
        </div> <!-- PSPE CD topcont -->
        <div class="PSPE-CD-info">
            <div class="PSPE-CD-Img">

                <img src="uploaded/provider/event/image/{{event_image}}" width="300" height="250" />                          </div>
            <h2>{{event_title}}</h2><br/>
            <div class="PSPE-info-datecont">
                <div class="PSPE-datefrom">
                                	{{start_date}} to {{end_date}}
                </div><br/>
                <!--                        <div class="PSPE-date2">
                                	to
                                        </div>
                                        <div class="PSPE-dateto">
                                	{{end_date}}
                                        </div>-->
            </div> <!-- PSEPE-info-datecont -->

            <div class="PSPE-info-valuecont">
                <div class="PSPE-value-text">
                                	Venue: {{event_venue}}
                </div>
                <!--                        <div class="PSPE-value-vlue">
                                                        
                                        </div>-->
            </div> <!-- PSPE info valuecont -->
            <br/><div class="PSPE-info-valuecont">
                <div class="PSPE-value-text">
                                	Contact Person: {{event_contact}}
                </div>
                <!--                        <div class="PSPE-value-value">
                                                        
                                        </div>-->
            </div> <!-- PSPE info valuecont --><br/>
            <div class="PSPE-info-valuecont">
                <div class="PSPE-value-text">
                                	Time: {{event_time}}
                </div>
                <!--                        <div class="PSPE-value-value">
                                                        
                                        </div>-->
            </div> <!-- PSPE info valuecont --><br/>
            <div class="PSPE-info-valuecont">
                <div class="PSPE-value-text">
                                	Cost: {{event_cost}}
                </div>
                <div class="PSPE-value-value">

                </div><br/>
                <div id="event_body" class="PSPE-info-quotation">
                            	{{{event_body}}}
                </div>
            </div> <!-- PSPE CD info -->
            <div class="PSPE-CD-socialB">
                <div class="PSPE-info-link" onclick="javascript:gmap({{gmap}})"><a class="blue" href="javascript:;;">Click here for map details</a> |</div>
            </div>
            <div class="PSPE-CD-socialB">
                <div class="PSPE-info-link blue" ><a class="blue" href="ps_providers/profile/{{provider_id}}">Click here for provider details</a></div>
            </div>
        </div>
        {{/event}}
        {{/event_data}}
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
        
            var event_id = $('#event_id').val();
            $.get("events/all_events_list", function(response) {
                var data = JSON.parse(response);
                var template = ich.event_listing_tpl(data);
                $('#event-listing').html('');
                $('#event-listing').append(template);
            
                $('#page_container').pajinate({
                    item_container_id : '#event-listing',
                    num_page_links_to_display : 4,
                    items_per_page : 5,
                    nav_panel_id : '#RCAA-pagination'
                });
                return false;
            });
            $.get("ps_providers/event_data/"+event_id, function(response) {
                var data = JSON.parse(response);
                var template = ich.event_tpl(data);
                $('#event_itself').html('');
                $('#event_itself').append(template);
            
  //              var html_data = $('#event_body').text();
 //               $('#event_body').text('');
   //             $('#event_body').html(html_data);
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
                    $.get("ps_providers/events_time/"+from+"/"+to, function(response) {
                        var data = JSON.parse(response);
                        var template = ich.event_listing_tpl(data);
                        $('#event-listing').html('');
                        $('#event-listing').append(template);
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
