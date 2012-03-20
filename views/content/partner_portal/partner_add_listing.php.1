<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
         initialize();
         
         $('#publish_date').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
               
              
                });


//                $('#sending_date').datepicker({
//                changeMonth: true,
//                changeYear: true,
//                dateFormat: 'yy-mm-dd'
//            
//                });
//         
         
         $('#geocode').attr('disabled','true');
         $("#upload").uploadify({
            'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : '../js/uploadify/uploadify.php',
            'cancelImg'     : 'js/uploadify/cancel.png',
            'folder'        : '../uploaded/provider/image',
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
                $.post('<?php echo site_url('partner_content_listing/uploadify'); ?>',{filearray: response},function(info){
                    $('#avatar').attr('src', 'uploaded/provider/image/'+info);
                    $('#hidden_avatar').val(info);

                });
            }
        });
        
        
        
         $("#upload1").uploadify({
            'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : '../js/uploadify/uploadify.php',
            'cancelImg'     : 'js/uploadify/cancel.png',
            'folder'        : '../uploaded/provider/image',
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
            'script'        : '../js/uploadify/uploadify.php',
            'cancelImg'     : 'js/uploadify/cancel.png',
            'folder'        : '../uploaded/provider/image',
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
        
        
        
        $('#create_provider').click(function(e) {                    
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
                    
                    var gmap = $('#geocode').val();
                    gmap = gmap.replace(/[()]+/g,'');
                    
                    var category = $('#category').val();
                    
                    var seo_link = $('#seo_link').val();
                    seo_link = seo_link.replace("'", "`");
                    
                    var se_keywords = $('#se_keywords').val();
                    se_keywords = se_keywords.replace("'", "`");
                    
                    var se_summary = $('#se_summary').val();
                    se_summary = se_summary.replace("'", "`");
                    

                    var age_group = $('#age_group').val();
                    
                    var provider_listing = $('#provider_listing').val();
                    
                    var publish_date = $('#publish_date').val();
                    publish_date = publish_date.replace("'", "`");
                    
                    
                    
                    if(provider_name.length == 0) {
                        alert("Name cannot be empty!");
                    } else if(provider_email.length == 0) {
                        alert("Email cannot be empty!");
                    } else if(provider_details.length == 0) {
                        alert("details cannot be empty!");
                    } else if(provider_contact.length == 0) {
                        alert("Contact cannot be empty!");
                    } else {
                        $.post("partner_content_listing/create_provider", {
                            provider_name: provider_name,
                            provider_details: provider_details,
                            provider_location: provider_location,
                            provider_email: provider_email,
                            provider_contact: provider_contact,
                            provider_link: provider_link,
                            provider_listing: provider_listing,
                            avatar: avatar,
                            avatar1: avatar1,
                            avatar2: avatar2,
                            seo_link: seo_link,
                            se_summary: se_summary,
                            se_keywords: se_keywords,
                            age_group: age_group,
                            gmap: gmap,
                            publish_date: publish_date,
                            category: category
                        },
                        function(data){
                            var rurl = data.split(":");
                            var code = rurl[0];
                            var msg = rurl[1];
                            if (code < 0) {
                              alert(msg);
                            } else {
                              alert(msg);
                              window.location = 'partner/listing';
                            } 
                        });
                    }
                    e.preventDefault();
                });
         
          
          
          
          
         $.get("partner_content_listing/age_group_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.age_group_listing_tpl(data);
            $('#age-group-listing').html('');
            $('#age-group-listing').append(template);
            return false;
        });
        
             
         $.get("partner_content_listing/provider_listing_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#provider-listing').html('');
            $('#provider-listing').append(template);
            return false;
        });
        
        $.get("partner_content_listing/category_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.category_listing_tpl(data);
            $('#category-listing').html('');
            $('#category-listing').append(template);
            return false;
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

<script type="text/html" id="category_listing_tpl">
    {{#category_list}}
    <dd><select name="category" id="category">
            {{#categories}}
            <option value="{{id}}">{{category_name}}</option>
            {{/categories}}
        </select></dd>  
    {{/category_list}}
</script>



<script type="text/html" id="provider_listing_tpl">
    {{#provider_listing_list}}
    <dd><select name="provider_listing" id="provider_listing">
            {{#provider_listing}}
            <option value="{{id}}">{{provider_listing_name}}</option>
            {{/provider_listing}}
        </select></dd>  
    {{/provider_listing_list}}
</script>

<form id="frmMain" name="frmMain">



    <div style="border-bottom: 2px solid #2490ce; width: 921px;">
        <span class="fontcomfortaa">Partner Portal</span> &nbsp;&nbsp;<img src="images/Header-Arrow.png"> 
        <span style="font-size: 18px; color: #2490ce;">Add new Listing</span>
    </div>
    <!--------------------------------------------------------------------------------------------->   
    <br />

    <div class="event-form" align="center">
        <br /> <br />
        <table width="917" border="0" cellspacing="0" cellpadding="0">
            
               <tr>
                <td align="right" class="fontcomfortaa2">
                    Provider Image:
                </td>
                <td>&nbsp;</td>
                <td>
                    <img id="avatar" alt="" src="assets/img/system/ArticleImageMIA.jpg" style="width: 300px; height: 250px;"/>
                    <br /><br />
                   <div id="uploadContainer">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
                                <a href="javascript:$('#upload').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                  </div>
                    
                     <div id="fileQueue"></div>
                     <input type="hidden" id="hidden_avatar"/>
                </td>
            </tr>
            
            
            
              <tr>
                <td align="right" class="fontcomfortaa2">
                    Provider Logo:
                </td>
                <td>&nbsp;</td>
                <td>
                    <img id="avatar1" alt="" src="assets/img/system/ArticleImageMIA.jpg" style="width: 100px; height: 70px;"/>
                    <br /><br />
                   <div id="uploadContainer1">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload1')); ?>
                                <a href="javascript:$('#upload1').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                  </div>
                    
                     <div id="fileQueue1"></div>
                     <input type="hidden" id="hidden_avatar1"/>
                </td>
            </tr>
            
            
            
            
             <tr>
                <td align="right" class="fontcomfortaa2">
                    Provider Ticker:
                </td>
                <td>&nbsp;</td>
                <td>
                    <img id="avatar2" alt="" src="assets/img/system/ArticleImageMIA.jpg" style="width: 100px; height: 70px;"/>
                    <br /><br />
                   <div id="uploadContainer2">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload2')); ?>
                                <a href="javascript:$('#upload2').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                  </div>
                    
                     <div id="fileQueue2"></div>
                     <input type="hidden" id="hidden_avatar2"/>
                </td>
            </tr>
            
             <tr>
                <td></br></td>
                <td></br></td>
                <td></br></td>
            </tr>
            
            
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
           
             <tr>
                <td width="332" align="right" class="fontcomfortaa2"> Provider Listing:</td>
                <td width="16">&nbsp;</td>
                <td width="569">
                    <div id="provider-listing"></select>
                </td>
            </tr>
            
             <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
            <tr>
                <td width="332" align="right" class="fontcomfortaa2"> Age Group:</td>
                <td width="13">&nbsp;</td>
                <td width="569">
                    <div id="age-group-listing"></select>
                </td>
            </tr>
             <tr>
                <td></br></td>
                <td></br></td>
               
            </tr>
            
             <tr>
                <td width="332" align="right" class="fontcomfortaa2"> Category Listing:</td>
                <td width="13">&nbsp;</td>
                <td width="569">
                    <div id="category-listing"></select>
                </td>
            </tr>
             <tr>
                <td></br>;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
            <tr>
                <td align="right" class="fontcomfortaa2">Provider Name:</td>
                <td></td>
                <td>
                    <input type="text" class="textbox" id="provider_name" name="provider_name"/>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
         
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
        
        
            <tr>
                <td align="right" class="fontcomfortaa2" valign="top">
                    Provider Details:
                </td>
                <td>&nbsp;</td>
                <td>
                    <textarea id="tadescription" name="tadescription"></textarea>
                </td>
            </tr>
            
             <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
           
           
          
            <tr>
                <td align="right" class="fontcomfortaa2">
                    Provider Location:
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="text" id="provider_location" name="provider_location" class="textbox" />
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" class="fontcomfortaa2">
                    Geocoding:
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="text" class="textbox" name="geocoding" id="geocoding" />
                    <input type="button" value="Get geocode" onclick="geo()" src="images/geocoding.png">

                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" class="fontcomfortaa2">
                </td>
                <td>&nbsp;</td>
                <td>
                    <div id="map_canvas" style="width:400px; height:300px"></div>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" class="fontcomfortaa2">
                    
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="text" class="textbox" id="geocode" />
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
              <tr>
                <td align="right" class="fontcomfortaa2">
                    Provider Email:
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="text" id="provider_email" name="provider_email" class="textbox" />
                </td>
            </tr>
            
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
            
            
              <tr>
                <td align="right" class="fontcomfortaa2">
                    Provider Link:
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="text" id="provider_link" name="provider_link" class="textbox" />
                </td>
            </tr>
            
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
            
            <tr>
                <td align="right" class="fontcomfortaa2">
                    Provider Contact:
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="text" id="provider_contact" name="provider_contact" class="textbox" />
                </td>
            </tr>
            
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" class="fontcomfortaa2">
                    SEO URL:
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="text" id="seo_link" name="seo_link" class="textbox" />
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" class="fontcomfortaa2">SEO Short Description:</td>
                <td>&nbsp;</td>
                <td>
                    <input type="text" id="se_summary" name="se_summary" class="textbox" /><br />
                    <span style="font-size:11px;">300 characters</span>

                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" class="fontcomfortaa2"> Keyword:</td>
                <td>&nbsp;</td>
                <td>
                    <input type="text" name="se_keywords" id="se_keywords" class="textbox" />
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
            <tr>
                <td align="right" class="fontcomfortaa2">
                   Publish Date:
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="text" name="publish_date" id="publish_date" class="textbox" value="<?php echo set_value('publish_date'); ?>" />
                </td>
            </tr>
            
            
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
            <tr>
                <td align="right" class="fontcomfortaa2">
                </td>
                <td>&nbsp;</td>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="95"><a href="#" id="create_provider" class="cssanchor"><img src="images/submit.png"></a></td>
                            <td width="474"><a href="<?php echo base_url(); ?>partner" class="cssanchor"><img src="images/CANCEL.png"></a></td>
                        </tr>
                        
                          <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                        </tr>
                    </table>

                </td>
            </tr>
        </table>


        <!--------------------------------------------------------------------------------------------->       
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