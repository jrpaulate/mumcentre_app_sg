<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        
        var curriculum_id = $('#curriculum_id').val();
    
        $.get("edit_curriculum/curriculum_data/"+ curriculum_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.curriculum_listing_tpl(data);
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
            'folder'        : '/uploaded/provider/curriculum/image',
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
                $.post('<?php echo site_url('edit_curriculum/uploadify'); ?>',{filearray: response},function(info){
                    $('#avatar').attr('src', 'uploaded/provider/curriculum/image/'+info);
                    $('#hidden_avatar').val(info);
//                                            alert(info);
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
        $('#articlecontain').append(curriculum_body);
         
        });
 
        
         
        
        $('#update_curriculum').click(function(e) {
                    var curriculum_title = $('#curriculum_title').val();
                    curriculum_title = curriculum_title.replace("'", "`");
                    

                    var avatar = $('#hidden_avatar').val();
                    var curriculum_body = tinyMCE.get('tadescription').getContent();
                    
                    var curriculum_summary = $('#txtarea').val();
                    var id = $('#curriculum_id').val();
                    var provider = $('#provider').val();
                    var age_group = $('#age_group').val();
                    var seo_url = $('#seo_url').val();
                    var gmap = $('#geocode').val();
                    gmap = gmap.replace(/[()]+/g,'');
                    var seo_summary = $('#seo_summary').val();
                    var seo_keywords = $('#seo_keywords').val();
                    var publish_date = $('#publish_date').val();
                    var sending_date = $('#sending_date').val();
                    var expiry_date = $('#expiry_date').val();
                    var contact_number = $('#contact_number').val();
                    
                    if(curriculum_title.length == 0) {
                         alert("Title cannot be empty!");
                    } else if(curriculum_body.length == 0) {
                        alert("Curriculum Body cannot be empty!");
                    } else if(curriculum_summary.length == 0) {
                        alert("Summary cannot be empty!");
                    } else {
                        $.post("edit_curriculum/update_curriculum/" + id, {
                            curriculum_title: curriculum_title,
                            provider: provider,
                            curriculum_summary: curriculum_summary,
                            curriculum_body: curriculum_body,
                            age_group: age_group,
                            seo_url: seo_url,
                            gmap: gmap,
                            seo_summary: seo_summary,
                            seo_keywords: seo_keywords,
                            avatar:avatar,
                            publish_date:publish_date,
                            sending_date:sending_date,
                            expiry_date:expiry_date,
                            contact_number: contact_number
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
          
         $.get("edit_curriculum/provider_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#provider-listing').html('');
            $('#provider-listing').append(template);
            return false;
        });
        
        
         $.get("edit_curriculum/age_group_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.age_group_listing_tpl(data);
            $('#age-group-listing').html('');
            $('#age-group-listing').append(template);
            return false;
        });




        $('#geocode').attr('disabled','true');


});

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

<script type="text/html" id="provider_listing_tpl">
    {{#provider_list}}
    <dd><select name="provider" id="provider">
            {{#providers}}
            <option value="{{{id}}}">{{provider_name}}</option>
            {{/providers}}
        </select></dd>
    {{/provider_list}}
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



<script type="text/html" id="curriculum_listing_tpl">
    {{#curriculum_data}}
    {{#curriculum}}
<p><i><font color="red">*</font> = Required Field</i></p>
        <dl>
                         <dt><label for="provider">Provider:</label></dt>
                         <dd><input type="text" id="provider_name" name="provider" value="{{{provider_name}}}" /><font color="red">*</font></dd>
        
                        
                        </br></br>
                    
                        <input type="hidden" id="provider" value="{{{provider_id}}}"/>
                        <input type="hidden" id="age_group" value="{{{age_group_id}}}"/>
                           </br></br>  
                          
                        <dt><label for="title">Curriculum Title:</label></dt>
                        <dd><input type="text" id="curriculum_title" name="curriculum_title" value="{{{curriculum_title}}}" /><font color="red">*</font></dd>
        
                       
                        
                        <dt>Curriculum Image</dt>
                        <dd><img id="avatar" alt="" src="uploaded/provider/curriculum/image/{{{curriculum_image}}}" value="uploaded/provider/curriculum/image/{{{curriculum_image}}}" style="width: 255px; height: 255px;"/></dd>
                        <dt class="empty"></dt>
                        <dd><div id="uploadContainer">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
                                <a href="javascript:$('#upload').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                            </div></dd>
                        <div id="fileQueue"></div>
                        <br />
                        <input type="hidden" id="hidden_avatar" value="{{curriculum_image}}"/>
                        
                   
                        
                        <dt><label for="summary">Curriculum Summary:</label></dt>
                        <dd><textarea id="txtarea"  cols="20"  rows="3"  style="width: 498px; height: 80px;"> {{curriculum_summary}}</textarea></dd>
               
                       
                        <dt>Curriculum Body </dt>
                        <dd><textarea id="tadescription" name="tadescription"  style="width: 498px; height: 100px;" >{{curriculum_body}}</textarea></dd>

                        
                        
                        <dt><label for="geocoding">Geocoding:</label></dt>
                        <dd><input type="text" name="geocoding" id="geocoding"/><input type="button" value="Get geocode" onclick="geo()">(Just leave this blank if there's no venue.)</dd></br>
                        <dt class="empty"></dt>
                        <dd><div id="map_canvas" style="width:660px; height:377px"></div></dd>
                        <dt class="empty"></dt>   </br> 
                        <dd><input type="text" id="geocode" value="{{gmap}}"/></dd>

                        
                        
                        <dt><label for="title">Telephone Number:</label></dt>
                        <dd><input type="text" id="contact_number" name="contact_number" value="{{contact_number}}" /> </dd>

                        
                        
                        <dt><label for="title">SEO URL Overide:</label></dt>
                        <dd><input type="text" id="seo_url" name="seo_url" value="{{seo_url}}" /> </dd>


                        <dt><label for="title">SEO Short Description:</label></dt>
                        <dd><input type="text" id="seo_summary" name="seo_summary" value="{{seo_summary}}" /> </dd>

                        <dt><label for="title">Keyword:</label></dt>
                        <dd><input type="text" id="seo_keywords" name="seo_keywords" value="{{seo_keywords}}" /></dd>
                    
                       <dt><label for="publish_date">Publish Date</label></dt>
                       <dd><input type="text" name="publish_date" id="publish_date" class="text-ep-textinput" value="{{publish_date}}"/></dd>

                       <dt><label for="sending_date">Sending Date</label></dt>
                       <dd><input type="text" name="sending_date" id="sending_date" class="text-ep-textinput" value="{{sending_date}}"/></dd>
                       
                       
                       <dt><label for="sending_date">Expiry Date</label></dt>
                       <dd><input type="text" name="expiry_date" id="expiry_date" class="text-ep-textinput" value="{{expiry_date}}"/></dd>
                        
                                    
        
                        </dl>
{{/curriculum}}
{{/curriculum_data}}
</script>


<form id="frmMain" name="frmMain">
<input type="hidden" id="curriculum_id" value="<?php echo $id;?>" />


    <div id="content">
        <ul class="ulsubnav">
            <li>Provider Curriculum CMS</li>
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Edit Curriculum</h2>
               
                <div id="articleinfo">
               
                       
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="#" id="update_curriculum" class="cssanchor">SUBMIT</a></div>
                <div class="cssanchor"><a href="cms_provider_content/content" class="cssanchor">BACK</a></div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
    	Mumcentre CMS.
        </div>
    </div>
</form>
