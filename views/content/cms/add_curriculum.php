<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
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
            var provider = $('#provider').val();

            var summary = $('#txtarea').val();
            var gmap = $('#geocode').val();
            gmap = gmap.replace(/[()]+/g,'');
            var curriculum = tinyMCE.get('tadescription').getContent();
         
            
            var seo_link = $('#seo_link').val();
           seo_link = seo_link.replace("'", "`");
                    
           var se_keywords = $('#se_keywords').val();
           se_keywords = se_keywords.replace("'", "`");
                    
           var se_summary = $('#se_summary').val();
           se_summary = se_summary.replace("'", "`");
                    
            
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
                    alert("Please select Age Group!");  
            } else if(title.length == 0) {
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
                    gmap: gmap,
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
                        window.location = 'cms_curriculum';
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
            <li>Curriculum CMS</li>
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Add New Curriculum</h2>

                <div id="articleinfo">
                    <p><i><font color="red">*</font> = Required Field</i></p>
                   
                        
                         <dt><label for="provider">Provider Name:</label></dt>
                        <div id="provider-listing"></div>
                        
                         </br>
                        </br>
                        
                        <dt><label for="age_group">Age Group:</label></dt>
                        <div id="age-group-listing"></div>
                        
                        </br>
                        </br>
                        
                        <dt><label for="title">Curriculum Title:</label></dt>
                        <dd><input type="text" id="title" name="title" /> <font color="red">*</font></dd>

                        </br>
                        </br>
      
                        <dt>Curriculum Image</dt>
                        <dd><img id="avatar" alt="" src="assets/img/system/ArticleImageMIA.jpg" style="width: 300px; height: 250px;"/></dd>
                        <dt class="empty"></dt>
                        <dd><div id="uploadContainer">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
                                <a href="javascript:$('#upload').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                            </div></dd>
                        <div id="fileQueue"></div>
                        <input type="hidden" id="hidden_avatar"/>
                        
                        </br>
                        </br>
                        
                        <dt><label for="summary">Summary:</label></dt>
                        <dd><textarea id="txtarea" cols="20"  rows="3"  style="width: 498px; height: 80px;"></textarea></dd>
                        <dt class="empty"></dt><dd><span id="chars_left">231</span> characters left.</dd><br/>
                        
                        </br>
                        </br>
                        
                        <dt>Curriculum Body </dt>
                        <dd><textarea id="tadescription" name="tadescription"></textarea></dd>
                        
                        </br>
                        </br>
                        
                        <dt><label for="geocoding">Geocoding:</label></dt>
                        <dd><input type="text" name="geocoding" id="geocoding"/><input type="button" value="Get geocode" onclick="geo()">(Just leave this blank if there's no venue.)</dd></br>
                        <dt class="empty"></dt>
                        <dd><div id="map_canvas" style="width:660px; height:377px"></div></dd>
                        <dt class="empty"></dt>    </br>
                        <dd><input type="text" id="geocode"/></dd>
                        
                         </br>
                        </br>
                        
                        <dt><label for="title">SEO URL Overide:</label></dt>
                        <dd><input type="text" id="seo_link" name="seo_link" /> <font color="red">*</font></dd>

                        </br>
                        </br>

                        <dt><label for="title">SEO Short Description:</label></dt>
                        <dd><input type="text" id="se_summary" name="se_summary" /> <font color="red">*</font></dd>

                        </br>
                        </br>
                        
                        <dt><label for="title">Keyword:</label></dt>
                        <dd><input type="text" id="se_keywords" name="se_keywords" /> <font color="red">*</font></dd>
                        
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
                    
                       
                       <dt><label for="sending_date">Expiry Date</label></dt>
                       <dd><input type="text" name="expiry_date" id="expiry_date" class="text-ep-textinput" value="<?php echo set_value('expiry_date'); ?>"/></dd>

                       
                        </br>
                        </br>
                    
                   
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="#" id="create_curriculum" class="cssanchor">SUBMIT</a></div>
                <div class="cssanchor"><a href="<?php echo base_url(); ?>cms_curriculum" class="cssanchor">BACK</a></div>
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