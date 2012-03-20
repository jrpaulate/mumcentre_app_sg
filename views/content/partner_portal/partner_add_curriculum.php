<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
             var provider_id = $('#provider_id').val();
             var provider_name = $('#provider_name').val();
             
             
            $.get("partner_content_curriculum/provider_data/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#providerinfo').html('');
            $('#providerinfo').append(template);
            return false;
            $('#providercontain').html('');
            $('#providercontain').append(provider_body);
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
        
        initialize();
        $('#geocode').attr('disabled','true');
        $("#upload").uploadify({
            'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : '../js/uploadify/uploadify.php',
            'cancelImg'     : 'js/uploadify/cancel.png',
            'folder'        : '../uploaded/provider/curriculum/image',
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
                $.post('<?php echo site_url('cms_curriculum/uploadify'); ?>',{filearray: response},function(info){
                    $('#avatar').attr('src', 'uploaded/provider/curriculum/image/'+info);
                    $('#hidden_avatar').val(info);
                });
            }
        });
        $('#create_curriculum').click(function(e) {
            var title = $('#title').val();
            title = title.replace("'", "`");
           
      
            var avatar = $('#hidden_avatar').val();
            var provider = $('#provider_id').val();

            var summary = $('#txtarea').val();
            var gmap = $('#geocode').val();
            gmap = gmap.replace(/[()]+/g,'');
            var curriculum = tinyMCE.get('tadescription').getContent();
            var age_group = $('#age_group').val();
            
            var seo_link = $('#seo_link').val();
           seo_link = seo_link.replace("'", "`");
                    
           var se_keywords = $('#se_keywords').val();
           se_keywords = se_keywords.replace("'", "`");
                    
           var se_summary = $('#se_summary').val();
           se_summary = se_summary.replace("'", "`");
                    
            
            var publish_date = $('#publish_date').val();
            publish_date = publish_date.replace("'", "`");
                    
            var sending_date = $('#sending_date').val();
            sending_date = sending_date.replace("'", "`");
            
            if(title.length == 0) {
                alert("Title cannot be empty!");
            } else if(summary.length == 0) {
                alert("Summary cannot be empty!");
            } else if(curriculum.length == 0) {
                alert("Curriculum cannot be empty!");
            } else {
                $.post("cms_curriculum/create_curriculum", {
                    title: title,
                    avatar: avatar,
                    provider: provider,
                    summary: summary,
                    curriculum: curriculum,
                    age_group: age_group,
                    seo_link: seo_link,
                    se_summary: se_summary,
                    se_keywords: se_keywords,
                    sending_date: sending_date,
                    publish_date: publish_date,
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
                        window.location = 'partner_content_curriculum/read/<?php echo $id; ?>';
                    }
                });
            }
            e.preventDefault();
        });


        $.get("cms_curriculum/provider_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#provider-listing').html('');
            $('#provider-listing').append(template);
            return false;
        });

         $.get("cms_curriculum/age_group_list", function(response) {
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

<script type ="text/html" id="provider_listing_tpl">
 <table width="917" border="0" cellspacing="0" cellpadding="0">
   {{#provider_data}}
     {{#provider}}
     <tr class="provider">
  
   <div><span class="fontcomfortaa">Partner Listing</span> &nbsp;&nbsp;<img src="images/Header-Arrow.png">
   <span class="fontcomfortaa" style="font-size: 25px; color: #2490ce;">Add New Curriculum </span> &nbsp;&nbsp;<img src="images/Header-Arrow.png">
   <span class="fontcomfortaa" style="font-size: 25px; color: #2490ce; font-weight: bold;">{{provider_name}}</div>

  
   </tr>  
   {{/provider}}
   {{/provider_data}}
</table>
</script>

<script type="text/html" id="age_group_listing_tpl">
    {{#age_group_list}}
    <select name="age_group" id="age_group" class="list">
            {{#age_groups}}
            <option value="{{id}}">{{age_group_name}}</option>
            {{/age_groups}}
        </select>
    {{/age_group_list}}
</script>

<table width="917" border="0" cellspacing="0" cellpadding="0" align="center">

    <tr>
    <td>

    
    <div style="height:35px; background-color:#b0daef; float:right; width: 377px; border-right: 2px solid #FFF;"></div>
    
    
    
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="partner_content_profile/read/<?php echo $id; ?>">profile </a></div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="partner_content_event/read/<?php echo $id; ?>">events</a></div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="partner_content_program/read/<?php echo $id; ?>">programs</a></div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center; height:28px; background-color:#2281b1; float:left; width: 106px; border-right: 2px solid #FFF; color:#000;"><a href="partner_content_curriculum/read/<?php echo $id; ?>">curriculum</a>
    
    
    </div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="partner_content_review/read/<?php echo $id; ?>">reviews</a></div>
    </div>
   
    <div style="height:20px; background-color:#2281b1; float:left;  width: 921px; border-right: 2px solid #FFF;"></div>
   
    
    </td>
  </tr>
 
  
 
 
   
</table>




<br />



<input type="hidden" id="provider_id" value="<?php echo $id;?>" />
<form id="frmMain" name="frmMain">

    <div style="border-bottom: 2px solid #2490ce; width: 917px;">
        <tr class="provider">
        <td> <div id="providerinfo"></div></td>
        <td> <div id="provider-listing"></div></td>
    </tr>
    </div>
    
    <br />

    <div class="event-form" align="center">
        <br /> <br />
        <table width="917" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td width="332" align="right" class="fontcomfortaa2"> Age Group:</td>
                <td width="16">&nbsp;</td>
                <td width="569">
                    <div id="age-group-listing"></select>
                </td>
            </tr>
            <tr>
                <td>
                </td>
                <td >&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" class="fontcomfortaa2">Curriculum Title:</td>
                <td></td>
                <td>
                    <input type="text" class="textbox" id="title" name="title"/>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" class="fontcomfortaa2">
                    Curriculum Image:
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
                    Location Geocoding:
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
                    Curriculum Summary:
                </td>
                <td>&nbsp;</td>
                <td>
                    <textarea id="txtarea" cols="20"  rows="3"  style="width: 320px; height: 80px;"></textarea><br />
                    <span style="font-size:11px;">300 characters</span>

                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" class="fontcomfortaa2" valign="top">
                    Curriculum Body:
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
                    Content Publish Date:
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
                <td align="right" class="fontcomfortaa2">
                    Content Sending Date for Alerts:
                </td>
                <td>&nbsp;</td>
                <td>
                    <input type="text" name="sending_date" id="sending_date" class="textbox" value="<?php echo set_value('sending_date'); ?>" />
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
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="95"><a href="#" id="create_curriculum" class="cssanchor"><img src="images/submit.png"></a></td>
                            <td width="474"><a href="partner_content_curriculum/read/<?php echo $id; ?>"> <img src="images/CANCEL.png"></a></td>
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






