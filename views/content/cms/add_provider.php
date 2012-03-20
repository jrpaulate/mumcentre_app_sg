<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
         initialize();
         
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
                $.post('<?php echo site_url('cms_provider/uploadify'); ?>',{filearray: response},function(info){
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
        
        $.get("cms/country_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.country_listing_tpl(data);
            $('#country-listing').html('');
            $('#country-listing').append(template);
            return false;
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
                    
                  
                    var provider_listing = $('#provider_listing').val();
                    
                    var publish_date = $('#publish_date').val();
                
                    var sending_date = $('#sending_date').val();
                   
                    var expiry_date = $('#expiry_date').val();
                    
                    var countries="";
					var selcountries=$("input[name='chkcountry[]']:checked");
					for(var i=0; i < selcountries.length; i++){
						if(selcountries[i].checked){
							if(countries != "")
							countries+="|";
							countries+=selcountries[i].value;
						}
					}
                                        
                     var age_group="";
                     var selage=$("input[name='chkage[]']:checked");
				for(var i=0; i < selage.length; i++){
					if(selage[i].checked){
						if(age_group != "")
						age_group+="|";
						age_group+=selage[i].value;
					}
				}                   
		          
		    if(selcountries.length == 0) {
		    alert("Please select a country!");  
		    } else if(provider_name.length == 0) {
                        alert("Name cannot be empty!");
                    } else if(provider_email.length == 0) {
                        alert("Email cannot be empty!");
                    } else if(provider_details.length == 0) {
                        alert("details cannot be empty!");
                    } else if(provider_contact.length == 0) {
                        alert("Contact cannot be empty!");
                    } else {
                        $.post("cms_provider/create_provider", {
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
                            sending_date: sending_date,
                            publish_date: publish_date,
                            expiry_date: expiry_date,
                            category: category,
			    countries: countries
                        },
                        function(data){
                            var rurl = data.split(":");
                            var code = rurl[0];
                            var msg = rurl[1];
                            if (code < 0) {
                              alert(msg);
                            } else {
                              alert(msg);
                              window.location = 'cms_provider';
                            } 
                        });
                    }
                    e.preventDefault();
                });
         
          
          
          
          
         $.get("cms_provider/age_group_list", function(response) {
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
        
        $.get("cms_provider/category_list", function(response) {
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
    {{#age_groups}}
    <dd><input type="checkbox" id="chkage" name="chkage[]" id="chkage" value="{{age_group_id}}">		
			{{age_group_name}}
    </dd>
    {{/age_groups}}
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

<script type="text/html" id="country_listing_tpl">
	{{#country_list}}
		{{#countries}}
		<dd><input type="checkbox" id="chkcountry" name="chkcountry[]" id="chkcountry" value="{{country_id}}">		
			{{country_name}}
			</dd>
		{{/countries}}
	{{/country_list}}
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
    
    <div id="content">
        <ul class="ulsubnav">
            <li>Provider CMS</li>
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Add New Provider</h2>

                <div id="articleinfo">
                    <p><i><font color="red">*</font> = Required Field</i></p>
                    
                        <dt><label for="country">Select Country:</label></dt>
                      	<div id="country-listing"></div>
    					
                        </br>
                        </br>
                    
                        <dt><label for="age_group">Age Group:</label></dt>
                        <div id="age-group-listing"></div>
                    
                        </br>
                        </br>
                        
                        <dt><label for="category">Category:</label></dt>
                        <div id="category-listing"></div>
                        
                        </br>
                        </br>
                        
                        <dt><label for="provider_listing">Provider Listing:</label></dt>
                        <div id="provider-listing"></div>
                       
                        
                        </br>
                        </br>
                        
                        <dt>Provider Image</dt>
                        <dd><img id="avatar" alt="" src="assets/img/system/avatar_female.jpg" style="width: 300px; height: 250px;"/></dd>
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
                        
                        
                          <dt>Provider Logo</dt>
                        <dd><img id="avatar1" alt="" src="assets/img/system/avatar_female.jpg" style="width: 100px; height: 70px;"/></dd>
                        <dt class="empty"></dt>
                        <dd><div id="uploadContainer1">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload1')); ?>
                                <a href="javascript:$('#upload1').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                            </div></dd>
                        <div id="fileQueue1"></div>
                        <br />
                        <input type="hidden" id="hidden_avatar1"/>
                        
                        </br>
                        </br>
                        
                        
                        <dt>Provider Ticker</dt>
                        <dd><img id="avatar2" alt="" src="assets/img/system/avatar_female.jpg" style="width: 77px; height: 34px;"/></dd>
                        <dt class="empty"></dt>
                        <dd><div id="uploadContainer2">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload2')); ?>
                                <a href="javascript:$('#upload2').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                        </div></dd>
						<br />
                        <div id="fileQueue2"></div>
                        <br />
                        <input type="hidden" id="hidden_avatar2"/>
                        
                        </br>
                        </br>
                        
 
                        
                        
                        <dt><label for="provider_name">Provider Name:</label></dt>
                        <dd><input type="text" id="provider_name" name="provider_name" /> <font color="red">*</font></dd>
                 
                        </br>
                        </br>
                        
                        <dt><label for="provider_details">Provider Details:</label></dt>
                        <dd><textarea id="tadescription" name="tadescription"></textarea></dd>
                        
                        </br>
                        </br>
                        
                        <dt><label for="provider_location">Provider Location:</label></dt>
                        <dd><input type="text" name="provider_location" id="provider_location"/> <font color="red">*</font>                        
                        <dt><label for="geocoding">Geocoding:</label></dt>
                        <dd><input type="text" name="geocoding" id="geocoding"/><input type="button" value="Get geocode" onclick="geo()"></dd>
                        <dt class="empty"></dt>
                        <dd><div id="map_canvas" style="width:660px; height:377px"></div></dd>
                        <dt class="empty"></dt>    
                        <dd><input type="text" id="geocode"/></dd>
                        
                        
                        </br>
                        </br>
                        
                        <dt><label for="provider_email">Provider Email:</label></dt>
                        <dd><input type="text" name="provider_email" id="provider_email"/> <font color="red">*</font></dd>
                        
                        </br>
                        </br>
                        
                        <dt><label for="provider_contact">Telephone Number:</label></dt>
                        <dd><input type="text" name="provider_contact" id="provider_contact"/> <font color="red">*</font></dd>
                        
                        </br>
                        </br>
                        
                        <dt><label for="provider_link">Provider Link:</label></dt>
                        <dd><input type="text" name="provider_link" id="provider_link"/> <font color="red">*</font></dd>
                        

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
                       
                       <dt><label for="sending_date">Alerts Send Date</label></dt>
                       <dd><input type="text" name="sending_date" id="sending_date" class="text-ep-textinput" value="<?php echo set_value('sending_date'); ?>"/></dd>

                       </br>
                       </br>
                       
                       <dt><label for="sending_date">Expiry Date</label></dt>
                       <dd><input type="text" name="expiry_date" id="expiry_date" class="text-ep-textinput" value="<?php echo set_value('expiry_date'); ?>"/></dd>

                       
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="#" id="create_provider" class="cssanchor">SUBMIT</a></div>
                <div class="cssanchor"><a href="<?php echo base_url(); ?>cms_provider" class="cssanchor">BACK</a></div>
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
            
</script>
