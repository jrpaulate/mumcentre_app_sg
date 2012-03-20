<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
     
        
        var provider_id = $('#provider_id').val();
    
        $.get("edit_provider/provider_data/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#articleinfo').html('');
            $('#articleinfo').append(template);
            
               initialize();
            
             tinyMCE.init({
                // General options
                width : "900",
                height:"700",
                mode : 'exact',
                elements: 'tadescription,description',
                theme : "advanced",
                plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

                // Theme options
                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink|,forecolor,backcolor",
                theme_advanced_buttons3 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft|,table,removeformat,code",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : false

                // Example word content CSS (should be your site CSS) this one removes paragraph margins
                //                content_css : "css/word.css"
            });
            
            
            
            $("#upload").uploadify({
	    'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : '/js/uploadify/uploadify.php',
            'cancelImg'     : '/js/uploadify/cancel.png',
            'folder'        : '/uploaded/provider/image',
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
                $.post('<?php echo site_url('cms_provider/uploadify'); ?>',{filearray: response},function(info){
                    $('#avatar').attr('src', 'uploaded/provider/image/'+info);
                    $('#hidden_avatar').val(info);

                });
            }
        });
        
        
        
         $("#upload1").uploadify({
           
	    'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : '/js/uploadify/uploadify.php',
            'cancelImg'     : '/js/uploadify/cancel.png',
            'folder'        : '/uploaded/provider/image',
            'buttonImg'     : 'assets/img/system/btn_browse.png',
            'wmode'         : 'transparent',
            'width'         : 83,
            'height'        : 25,
            'queueID'       : 'fileQueue1',
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
                $.post('<?php echo site_url('cms_logo/uploadify'); ?>',{filearray: response},function(info){
                    $('#avatar1').attr('src', 'uploaded/provider/logo/'+info);
                    $('#hidden_avatar1').val(info);

                });
            }
        });
        
        
         $("#upload2").uploadify({
    
	    'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : '/js/uploadify/uploadify.php',
            'cancelImg'     : '/js/uploadify/cancel.png',
            'folder'        : '/uploaded/provider/image',
            'buttonImg'     : 'assets/img/system/btn_browse.png',
            'wmode'         : 'transparent',
            'width'         : 83,
            'height'        : 25,
            'queueID'       : 'fileQueue2',
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
                $.post('<?php echo site_url('cms_ticker/uploadify'); ?>',{filearray: response},function(info){
                    $('#avatar2').attr('src', 'uploaded/provider/ticker/'+info);
                    $('#hidden_avatar2').val(info);

                });
            }
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
            
            return false;
            $('#articlecontain').html('');
            $('#articlecontain').append(provider_body);
        });
 
        
        
        
        $('#update_provider').click(function(e) {
                    var provider_name = $('#provider_name').val();
                    provider_name = provider_name.replace("'", "`");
                    
                    var provider_details = tinyMCE.get('tadescription').getContent();
             
                    var provider_email = $('#provider_email').val();
                    provider_email = provider_email.replace("'", "`");
                    
                    var provider_location = $('#provider_location').val();
                    provider_location = provider_location.replace("'", "`");
                    
                    var provider_link = $('#provider_link').val();
                    provider_link = provider_link.replace("'", "`");
                    
                    var provider_contact = $('#provider_contact').val();
                    provider_contact = provider_contact.replace("'", "`");
                    
    
                    var avatar = $('#hidden_avatar').val();
                    
                    var avatar1 = $('#hidden_avatar1').val();
                    
                    var avatar2 = $('#hidden_avatar2').val();
                    
                    var id = $('#provider_id').val();
                    
                    var seo_url = $('#seo_url').val();
                    seo_url = seo_url.replace("'", "`");
                    
                    var seo_keyword = $('#seo_keyword').val();
                    seo_keyword = seo_keyword.replace("'", "`");
                    
                    var seo_summary = $('#seo_summary').val();
                    seo_summary = seo_summary.replace("'", "`");
                    

                    var publish_date = $('#publish_date').val();
                    var sending_date = $('#sending_date').val();
                    var expiry_date = $('#expiry_date').val();
                    
                    var gmap = $('#geocode').val();
                    gmap = gmap.replace(/[()]+/g,'');
                    
                    if(provider_name.length == 0) {
                        alert("Name cannot be empty!");
                    } else if(provider_email.length == 0) {
                        alert("Email cannot be empty!");
                    } else {
                        $.post("provider_profile_edit/update_provider/" + id, {
                            provider_name: provider_name,
                            provider_details: provider_details,
                            provider_location: provider_location,
                            provider_email: provider_email,
                            provider_contact: provider_contact,
                            provider_link: provider_link,
                            gmap: gmap,
                            avatar: avatar,
                            avatar1: avatar1,
                            avatar2: avatar2,
                            seo_url: seo_url,
                            seo_summary: seo_summary,
                            seo_keyword: seo_keyword,
                            publish_date: publish_date,
                            sending_date: sending_date,
                            expiry_date: expiry_date
                       
                        },
                        function(data){
                            var rurl = data.split(":");
                            var code = rurl[0];
                            var msg = rurl[1];
                            if (code < 0) {
                              alert(msg);
                            } else {
                              alert(msg);
                              window.location = 'cms_provider_content/content';
                            } 
                        });
                    }
                    e.preventDefault();
                });
                
                
                
          $('#txtarea').keydown(function() {
          var max_limit = 231;
          var chars_left;
          var txt = $('#txtarea').val();
//          alert(txt);
          if (txt.length > max_limit){
              txt = txt.substr(0, max_limit);
              $('#txtarea').val(txt);
          }
          chars_left = max_limit - txt.length;
          $('#chars_left').html('');
          $('#chars_left').append(chars_left);
//          e.preventDefault();
          });
          
         
        
         $.get("edit_provider/age_group_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.age_group_listing_tpl(data);
            $('#age-group-listing').html('');
            $('#age-group-listing').append(template);
            return false;
        });
        
        
              
         $.get("cms_provider/provider_listing_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#provider-listing').html('');
            $('#provider-listing').append(template);
            return false;
        });
        
        
        
         $('#geocode').attr('disabled','true');


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
  
        

</script>



<script type="text/html" id="age_group_listing_tpl">
    {{#age_group_list}}
    <dd><select name="age_group" id="age_group">
            {{#age_groups}}
            <option value="{{id}}">{{age_group_name}}</option>
            {{/age_groups}}
        </select></dd>
    {{/age_group_list}}
</script>


<script type="text/html" id="provider_listing_tpl">
    {{#provider_data}}
    {{#provider}}
<p><i><font color="red">*</font> = Required Field</i></p>
        <dl>
            
            <dt>Provider Image</dt>
                        <dd><img id="avatar" alt="" src="uploaded/provider/image/{{{provider_image}}}" value="uploaded/provider/image/{{{provider_image}}}" style="width: 250px; height: 250px;"/></dd>
                        <dt class="empty"></dt>
                        <dd><div id="uploadContainer">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
                                <a href="javascript:$('#upload').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                            </div></dd>
                        <div id="fileQueue"></div>
                        <br />
                        <input type="hidden" id="hidden_avatar" value="{{{provider_image}}}"/>
                        
                        
                          <dt>Provider Logo</dt>
                        <dd><img id="avatar1" alt="" src="uploaded/provider/image/{{provider_logo}}" style="width: 150px; height: 150px;"/></dd>
                        <dt class="empty"></dt>
                        <dd><div id="uploadContainer1">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload1')); ?>
                                <a href="javascript:$('#upload1').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                            </div></dd>
                        <div id="fileQueue1"></div>
                        <br />
                        <input type="hidden" id="hidden_avatar1" value="{{{provider_logo}}}"/>
                        
                        
                          <dt>Provider Ticker</dt>
                        <dd><img id="avatar2" alt="" src="uploaded/provider/image/{{provider_ticker}}" style="width: 100px; height: 100px;"/></dd>
                        <dt class="empty"></dt>
                        <dd><div id="uploadContainer2">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload2')); ?>
                                <a href="javascript:$('#upload2').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                            </div></dd>
                        <div id="fileQueue2"></div>
                        <br />
                        <input type="hidden" id="hidden_avatar2" value="{{{provider_ticker}}}"/>
                        
                        
                         

                         </br></br>  
                          
                      
                        <dt><label for="provider_name">Provider Name:</label></dt>
                        <dd><input type="text" id="provider_name" name="provider_name" value="{{provider_name}}" /> </dd>
                 
                        <dt><label for="provider_details">Provider Details:</label></dt>
                        <dd><textarea id="tadescription" name="tadescription"  style="width: 498px; height: 100px;" >{{{provider_details}}}</textarea></dd>

                        
                       <dt><label for="provider_location">Provider Location:</label></dt>
                        <dd><input type="text" name="provider_location" id="provider_location" value="{{{provider_location}}"/>  </dd>                     
                       
                        <dt><label for="geocoding">Geocoding:</label></dt>
                        <dd><input type="text" name="geocoding" id="geocoding"/><input type="button" value="Get geocode" onclick="geo()">(Just leave this blank if there's no venue.)</dd></br>
                        <dt class="empty"></dt>
                        <dd><div id="map_canvas" style="width:660px; height:377px"></div></dd>
                        <dt class="empty"></dt>   </br> 
                        <dd><input type="text" id="geocode"/></dd>
                        
                        
                        <dt><label for="provider_email">Provider Email:</label></dt>
                        <dd><input type="text" name="provider_email" id="provider_email" value="{{provider_email}}"/> </dd>
                        
                        <dt><label for="provider_contact">Telephone Number:</label></dt>
                        <dd><input type="text" name="provider_contact" id="provider_contact" value="{{provider_contact}}"/> </dd>
                        
                        <dt><label for="provider_link">Provider Link:</label></dt>
                        <dd><input type="text" name="provider_link" id="provider_link" value="{{provider_link}}" /></dd>
                        

                        <dt><label for="title">SEO URL Overide:</label></dt>
                        <dd><input type="text" id="seo_url" name="seo_url" value="{{{seo_url}}}" /> </dd>


                        <dt><label for="title">SEO Short Description:</label></dt>
                        <dd><input type="text" id="seo_summary" name="seo_summary" value="{{seo_summary}} " /> </dd>

                        <dt><label for="title">Keyword:</label></dt>
                        <dd><input type="text" id="seo_keyword" name="seo_keyword" value="{{seo_keywords}}"  /> </dd>
                    
                       <dt><label for="publish_date">Publish Date</label></dt>
                       <dd><input type="text" name="publish_date" id="publish_date" class="text-ep-textinput" value="{{{publish_date}}}"/></dd>

                       <dt><label for="sending_date">Alerts Sending Date</label></dt>
                       <dd><input type="text" name="sending_date" id="sending_date" class="text-ep-textinput" value="{{{sending_date}}}"/></dd>
                       
                       <dt><label for="sending_date">Expiry Date</label></dt>
                       <dd><input type="text" name="expiry_date" id="expiry_date" class="text-ep-textinput" value="{{{expiry_date}}}"/></dd>
                        
        
        </dl>
{{/provider}}
{{/provider_data}}
</script>


<form id="frmMain" name="frmMain">
<input type="hidden" id="provider_id" value="<?php echo $id;?>" />


    <div id="content">
        <ul class="ulsubnav">
            <li>Provider CMS</li>
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Edit Provider</h2>
               
                <div id="articleinfo">
               
                        <input type="hidden" id="hidden_avatar"/>
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="#" id="update_provider" class="cssanchor">SUBMIT</a></div>
                <div class="cssanchor"><a href="<?php echo base_url(); ?>cms_provider_content/content" class="cssanchor">BACK</a></div>
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