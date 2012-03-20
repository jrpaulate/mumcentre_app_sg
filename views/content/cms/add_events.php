<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#event_title').bind('input',function(){
             var link = $('#event_title').val();
             link = link.replace(/\s/g , "-");
            $('#seo_url').val(link); 
         });
        
        $('#publish_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
               
              
        });


        $('#sending_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
            
        });
        
        
         $('#expiry_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
            
        });
        
        initialize();
        $('#geocode').attr('disabled','true');
        $('#start_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
            // dateFormat: 'MM dd, yy',
              
        });


        $('#end_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
            // dateFormat: 'MM dd, yy',
            
        });
                


        $("#upload").uploadify({
            'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : '../js/uploadify/uploadify.php',
            'cancelImg'     : 'js/uploadify/cancel.png',
            'folder'        : '../uploaded/provider/event/image',
            'buttonImg'     : 'assets/img/system/btn_browse.png',
            'wmode'         : 'transparent',
            'width'         : 83,
            'height'        : 25,
            'queueID'       : 'fileQueue',
            'scriptAccess'  : 'always',
            'fileDesc'      : 'Image Files',
            'fileExt'       : '*.jpg;*.jpeg;*.png;*.gif',
            'onError' : function (a, b, c, d) {
                if (d.status == 404)
                    alert('Could not find upload script.');
                else if (d.type === "HTTP")
                    alert('error '+d.type+": "+d.status);
                else if (d.type ==="File Size")
                    alert(c.name+' '+d.type+' Limit: '+Math.round(d.sizeLimit/1024)+'KB');
                else
                    alert('error '+d.type+": "+d.text);
            },
            'onComplete'   : function (event, queueID, fileObj, response, data) {
                $.post('<?php echo site_url('cms_event/uploadify'); ?>',{filearray: response},function(info){
                    $('#avatar').attr('src', 'uploaded/provider/event/image/'+info);
                    $('#hidden_avatar').val(info);
                });
            }
        });
        
        $('#create_event').click(function(e) {
            var event_title = $('#event_title').val();
            event_title = event_title.replace("'", "`");

            var event_summary = $('#txtarea').val();
            
            var event_venue = $('#event_venue').val();
            
            var avatar = $('#hidden_avatar').val();
            
            var event_body = tinyMCE.get('tadescription').getContent();
            
            var contact_number = $('#contact_number').val();
           
            
            var start_date = $('#start_date').val();
           
                    
            var end_date = $('#end_date').val();
            
                    
            
            var event_time = $('#event_time').val();
            

            var event_cost = $('#event_cost').val();
            event_cost = event_cost.replace("'", "`");
            
            var gmap = $('#geocode').val();
            gmap = gmap.replace(/[()]+/g,'');
            
            var provider = $('#provider').val();

            var seo_url = $('#seo_url').val();
            seo_url = seo_url.replace("'", "`");
                    
            var seo_keywords = $('#seo_keywords').val();
            seo_keywords = seo_keywords.replace("'", "`");
                    
            var seo_summary = $('#seo_summary').val();
            seo_summary = seo_summary.replace("'", "`");

          
            var publish_date = $('#publish_date').val();
            
                    
            var sending_date = $('#sending_date').val();
          
            var expiry_date = $('#expiry_date').val();
            
            var age_group="";
                var selage=$("input[name='chkage[]']:checked");
				for(var i=0; i < selage.length; i++){
					if(selage[i].checked){
						if(age_group != "")
						age_group+="|";
						age_group+=selage[i].value;
					}
				}
            
            
             if(selage.length == 0) {
                    alert("Please select a Age Group!");  
            } else if(event_title.length == 0) {
                alert("Event Title cannot be empty!");
            } else if(event_summary.length == 0) {
                alert("Event Summary cannot be empty!");
            } else if(event_body.length == 0) {
                alert("Event Body cannot be empty!");
            } else if(start_date.length == 0) {
                alert("Start Date cannot be empty!");
            } else if(end_date.length == 0) {
                alert("End Date cannot be empty!");
            } else {
                $.post("cms_event/create_event", {
                    event_title: event_title,
                    event_summary: event_summary,
                    event_body: event_body,
                    event_venue: event_venue,
                    contact_number: contact_number,
                    start_date: start_date,
                    end_date: end_date,
                    event_time: event_time,
                    event_cost: event_cost,
                    avatar: avatar,
                    provider: provider,    
                    seo_url: seo_url,
                    seo_summary: seo_summary,
                    seo_keywords: seo_keywords,
                    age_group: age_group,
                    sending_date: sending_date,
                    publish_date: publish_date,
                    expiry_date: expiry_date,
                    gmap: gmap
                },
                function(data){
                    var rurl = data.split(":");
                    var code = rurl[0];
                    var msg = rurl[1];
                    if (code < 0) {
                        alert(msg);
                    } else {
                        alert(msg);
                        window.location = 'cms_event';
                    }
                });
            }
            e.preventDefault();
        });

      

        $.get("cms_event/provider_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#provider-listing').html('');
            $('#provider-listing').append(template);
            return false;
        });

        $.get("cms_event/age_group_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.age_group_listing_tpl(data);
            $('#age-group-listing').html('');
            $('#age-group-listing').append(template);
            return false;
        });
        
        $.post("ps_providers/getmap/", {
            profile_id : 1
        },
        function(data){
            var rurl = data.split(":");
            var mapper = rurl[1];
            var mapper = mapper.replace(/[}]]+/g,'');
            var mapper = mapper.replace(/[""]+/g,'');
            
            var latlng = new google.maps.LatLng(-34.397, 150.644); //initialize google map
            var myOptions = {
                zoom: 14,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);
            var geocoder;       //start geocoding
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
                    }
                    $('#geocode').val(results[0].geometry.location);
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });
            
        });
    });
</script>
<script type="text/html" id="provider_listing_tpl">
    {{#provider_list}}
    <dd><select name="provider" id="provider" onchange="javascript:init_geo()">    
            {{#providers}}
            <option value="{{id}}">{{provider_name}}</option>
            {{/providers}}
        </select></dd>
    {{/provider_list}}
</script>

<script type="text/html" id="age_group_listing_tpl">
    {{#age_group_list}}
    {{#age_groups}}
    <dd><input type="checkbox" id="chkage" name="chkage[]" id="chkage" value="{{age_group_id}}">		
			{{age_group_name}}
    </dd>
    {{/age_groups}}
    {{/age_group_list}}
</script>


<form id="frmMain" name="frmMain">

    <div id="content">
        <ul class="ulsubnav">
            <li>Events CMS</li>
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Add New Events</h2>

                <div id="articleinfo">
                    <p><i><font color="red">*</font> = Required Field</i></p>
                 
                        <dt><label for="provider">Provider:</label></dt>
                        <div id="provider-listing"></div>

                        </br>
                        </br>
                        
                        <dt><label for="age_group">Age Group:</label></dt></br>
                        <div id="age-group-listing"></div>

                        </br>
                        </br>
                        
                        <dt><label for="event_title">Event Title:</label></dt></br>
                        <dd><input type="text" id="event_title" name="event_title" /> <font color="red">*</font></dd>

                        </br>
                        </br>
                        
                        <dt>Event Image</dt>
                        <dd><img id="avatar" alt="" src="assets/img/system/ArticleImageMIA.jpg" style="width: 300px; height: 250px;"/></dd>
                        <dt class="empty"></dt>
                        <dd><div id="uploadContainer">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
                                <a href="javascript:$('#upload').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                            </div></dd>
                        <div id="fileQueue"></div>
                        <br />
                        <input type="hidden" id="hidden_avatar"/>

                        </br>
                        </br>
                        
                        <dt><label for="start_date">Event Start Date</label></dt></br>
                        <dd><input type="text" name="start_date" id="start_date" class="text-ep-textinput" value="<?php echo set_value('start_date'); ?>"/></dd>


                        </br>
                        </br>
                        
                        <dt><label for="end_date">Event End Date</label></dt></br>
                        <dd><input type="text" name="end_date" id="end_date" class="text-ep-textinput" value="<?php echo set_value('end_date'); ?>"/></dd>

                        </br>
                        </br>
                        
                        <dt><label for="event_time">Event Time:</label></dt></br>
                        <dd><input type="text" id="event_time" name="event_time" /> </dd>

                        </br>
                        </br>

                        <dt><label for="event_cost">Event Cost:</label></dt></br>
                        <dd><input type="text" id="event_cost" name="event_cost" /> </dd>

                        </br>
                        </br>

                        <dt><label for="event_venue">Event Venue:</label></dt>
                        <dd><input type="text" id="event_venue" name="event_venue"/></dd>
                        
                        </br>
                        </br>
                        
                        <dt><label for="contact_number">Telephone Number:</label></dt>
                        <dd><input type="text" id="contact_number" name="contact_number"/></dd>

                        </br>
                        </br>
                        
                        <dt><label for="geocoding">Geocoding:</label></dt>
                        <dd><input type="text" name="geocoding" id="geocoding"/><input type="button" value="Get geocode" onclick="geo()">(Just leave this blank if there's no venue.)</dd></br>
                        <dt class="empty"></dt>
                        <dd><div id="map_canvas" style="width:660px; height:377px"></div></dd>
                        <dt class="empty"></dt>   </br> 
                        <dd><input type="text" id="geocode"/></dd>


                        </br>
                        </br>
                        
                        <dt><label for="event_summary">Event Summary:</label></dt>
                        <dd><textarea id="txtarea" cols="20"  rows="3"  style="width: 498px; height: 80px;"></textarea></dd>
                        <dt class="empty"></dt><dd><span id="chars_left">231</span> characters left.</dd><br/>

                        </br>
                        </br>
                        
                        <dt>Event Body </dt>
                        <dd><textarea id="tadescription" name="tadescription" width="700px"></textarea></dd>

                        </br>
                        </br>
                        
                        <dt><label for="title">SEO URL Overide:</label></dt>
                        <dd><input type="text" id="seo_url" name="seo_url" /> </dd>


                        </br>
                        </br>
                        
                        <dt><label for="title">SEO Short Description:</label></dt>
                        <dd><input type="text" id="seo_summary" name="seo_summary" /> </dd>

                        </br>
                        </br>
                        
                        <dt><label for="title">Keyword:</label></dt>
                        <dd><input type="text" id="seo_keywords" name="seo_keywords" /> </dd>

                        </br>
                        </br>
                        
                        <dt><label for="publish_date">Publish Date</label></dt>
                        <dd><input type="text" name="publish_date" id="publish_date" class="text-ep-textinput" value="<?php echo set_value('publish_date'); ?>"/></dd>

                        </br>
                        </br>
                        
                        <dt><label for="sending_date">Sending Date</label></dt>
                        <dd><input type="text" name="sending_date" id="sending_date" class="text-ep-textinput" value="<?php echo set_value('sending_date'); ?>"/></dd>


                        </br>
                        </br>

                        <dt><label for="expiry_date">Expiry Date</label></dt>
                        <dd><input type="text" name="expiry_date" id="expiry_date" class="text-ep-textinput" value="<?php echo set_value('expiry_date'); ?>"/></dd>


                        </br>
                        </br>

                    
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="cms/cms_event" id="create_event" class="cssanchor">SUBMIT</a></div>
                <div class="cssanchor"><a href="<?php echo base_url(); ?>cms" class="cssanchor">BACK</a></div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
    	Mumcentre CMS.
        </div>
    </div>
</form>


<script>
    var geocoder;
    var map;
    var marker;
    
    function initialize(){
        var latlng = new google.maps.LatLng(1.352083, 103.81983600000001); //initialize google map
        var myOptions = {
            zoom: 14,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);
    }    
    
    function geo(){
        var latlng = $('#geocoding').val();
        //                alert(latlng);
        if(marker){
            marker.setMap(null);
        }
        var latlng1 = new google.maps.LatLng(-34.397, 150.644); //initialize google map
        var myOptions = {
            zoom: 14,
            center: latlng1,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map_canvas"),
        myOptions);
        geocoder = new google.maps.Geocoder();
        geocoder.geocode( { 'address': latlng}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    draggable: true
                });
                //                            alert(results[0].geometry.location);
                $('#geocode').val(results[0].geometry.location);
                google.maps.event.addListener(marker, 'dragend', function() {
                    //                        updateMarkerStatus('Drag ended');
                    //                        alert(marker.getPosition());
                    $('#geocode').val(marker.getPosition());
                });
            } else {
                alert("Geocode was not successful for the following reason: " + status);
            }
        }); 
    }
    function init_geo(){
        if(marker){
            marker.setMap(null);
        }
        var id = $('#provider').val();
        $.post("ps_providers/getmap/", {
            profile_id : id
        },
        function(data){
            var rurl = data.split(":");
            var mapper = rurl[1];
            var mapper = mapper.replace(/[}]]+/g,'');
            var mapper = mapper.replace(/[""]+/g,'');
            
            var latlng = new google.maps.LatLng(-34.397, 150.644); //initialize google map
            var myOptions = {
                zoom: 14,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            var map = new google.maps.Map(document.getElementById("map_canvas"),
            myOptions);
            var latlngStr = mapper.split(",",2);
            var lat = parseFloat(latlngStr[0]);
            var lng = parseFloat(latlngStr[1]);
            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'latLng': latlng}, function(results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        map.setZoom(16);
                        map.setCenter(latlng);
                        marker = new google.maps.Marker({
                            position: latlng,
                            map: map
                        });
                    }
                    $('#geocode').val(results[0].geometry.location);
                } else {
                    alert("Geocoder failed due to: " + status);
                }
            });
        });
            
    }
  
            
</script>
