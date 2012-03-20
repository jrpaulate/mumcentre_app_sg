<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $('#base_url').val();
        var listing_id = $('#listing_id').val();
        
         $("#upload").uploadify({
            'uploader'      : '/js/uploadify/uploadify.swf',
            'script'        : '/js/uploadify/uploadify.php',
            'cancelImg'     : '/js/uploadify/cancel.png',
            'folder'        : '/uploaded/ads',
            'buttonImg'     : 'assets/img/system/btn_browse.png',
            'wmode'         : 'transparent',
            'width'         : 83,
            'height'        : 25,
            'queueID'       : 'fileQueue',
            'scriptAccess'  : 'always',
            'fileDesc'      : 'Image Files',
            'fileExt'       : '*.jpg;*.jpeg;*.png;*.gif;*.swf',
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
                $.post('<?php echo site_url('cms_purchased/uploadify'); ?>',{filearray: response},function(info){
                    $('#avatar').attr('src', '/uploaded/ads/'+info);
                    $('#image_url').val(base_url+'uploaded/ads/'+info);
                    $('#hidden_avatar').val(info);
//                                            alert(info);
                });
            }
        });
        
        
        
             $('#start_date').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
                });


                $('#end_date').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'
                });
                
                
                
                
            $('#create_ad').click(function(e) {
          
            var provider_name = $('#provider_name').val();
            var campaign_name = $('#campaign_name').val();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var image_url = $('#image_url').val();
            var ad_title = $('#ad_title').val();
            var width = $('#width').val();
            var height = $('#height').val();
            var advertiser_id = $('#advertiser_id').val();
            var url = $('#url').val();
            
            if(provider_name.length == 0) {
                alert("Provider name cannot be empty!");
            } else if(campaign_name.length == 0) {
                alert("Campaign Name cannot be empty!");
            } else if(start_date.length == 0) {
                alert("Start date cannot be empty!");
            } else if(end_date.length == 0) {
                alert("End Date cannot be empty!");
            } else if(image_url.length == 0) {
                alert("Please upload an image for the ad!");
            } else if(ad_title.length == 0) {
                alert("Ad title cannot be empty!");
            } else if(!advertiser_id) {
                alert("Please select a provider");    
            } else {
                $.post("cms_purchased/create_ad", {
                   
                    provider_name: provider_name,
                    campaign_name: campaign_name,
                    start_date: start_date,
                    end_date: end_date,
                    image_url: image_url,
                    ad_title: ad_title,
                    advertiser_id: advertiser_id,
                    width: width,
                    height: height,
                    listing_id: listing_id,
                    url: url
                   
                },
                function(data){
                    var rurl = data.split(":");
                    var code = rurl[0];
                    var msg = rurl[1];
                    if (code != 0) {
                        alert('error: '+data);
                    } else {
                        alert(msg);
                         window.location = 'cms_ads_listing';
                    }
                });
            }
            e.preventDefault();
        });
        
        
      
      $.get("cms_purchased/ads1_list/"+listing_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.ads1_list_tpl(data);
            $('#ads1_list').html('');
            $('#ads1_list').append(template);
            return false;
        });
                
                
               
        
        $.get("cms_purchased/provider_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#provider_name').html('');
            $('#provider_name').append(template);
            return false;
        });

        
        
       
});
    function get_advertiser_id(id){
        $.post('cms_purchased/get_advertiser_id/',
        {id:id},
        function(response){
            $('#advertiser_id').val(response);
        });
    }
</script>




<script type="text/html" id="provider_listing_tpl">
    {{#provider_list}}
            <option value="0">Select a Provider</option>
            {{#provider}}
            <option value="{{id}}" onclick="javascript:get_advertiser_id({{id}})">{{name}}</option>
            {{/provider}}
    {{/provider_list}}
</script>

<script type="text/html" id="ads1_list_tpl">
                       
                        
 {{#ads1_list}}
            {{#ads1}}
                        <dt><label for="section">Ads Listing:</label></dt>
                        <dd><input type="text" id="ads_listing" name="ads_listing" value="{{name}}" /> <font color="red">*</font></dd>
                        
                        <dt><label for="section">Section:</label></dt>
                        <dd><input type="text" id="section" name="name" value="{{section}}" /> <font color="red">*</font></dd>

                        <dt><label for="duration">Duration:</label></dt>
                        <dd><input type="text" id="duration" name="duration" value="{{duration}}" /> <font color="red">*</font></dd>

                        <dt><label for="price">Price:</label></dt>
                        <dd><input type="text" id="price" name="price" value="{{price}}"/> <font color="red">*</font></dd>
                        
                        <dt><label for="width">Width:</label></dt>
                        <dd><input type="text" name="width" id="width" value="{{width}}"/> <font color="red">*</font></dd>
      
                        <dt><label for="height">Height:</label></dt>
                        <dd><input type="text" name="height" id="height" value="{{height}}"/> <font color="red">*</font></dd>
      
                        
          {{/ads1}}              
          {{/ads1_list}} 
                       
</script>



<input type="hidden" id="base_url" value="<?php echo base_url(); ?>"/>
<input type="hidden" id="listing_id" value="<?php echo $listing_id; ?>"/>
<input type="hidden" id="advertiser_id"/>
<form id="frmMain" name="frmMain">

    <div id="content">
        <ul class="ulsubnav">
            <li>Purchased Ads CMS</li>
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Add New Ads Purchase</h2>

                <div id="ads_listing_info">
                    <p><i><font color="red">Campaign Details</font> </i></p>
      
                   
                    <dl>
                        
                        <dt><label for="provider">Create Campaign For Provider:</label></dt>
                        <dd><select id="provider_name" name="provider_name"></select> </dd>
                        </br>
                        </br>
                        <dt><label for="size">Campaign Name:</label></dt>
                        <dd><input type="text" name="campaign_name" id="campaign_name"/> <font color="red">*</font></dd>

                        <dt><label for="start_date">Start Date</label></dt>
                        <dd><input type="text" name="start_date" id="start_date" class="text-ep-textinput"/></dd>

                       <dt><label for="end_date">End Date</label></dt>
                       <dd><input type="text" name="end_date" id="end_date" class="text-ep-textinput"/></dd>


                       
                        <p><i><font color="red">*Ad Details</font>  </i></p>
                        
                        

                        <div id="ads1_list"> </div>

         
                       
                        <dt>Article Image</dt>
                        <dd><img id="avatar" alt="" src="assets/img/system/ArticleImageMIA.jpg" style="width: 212px; height: 235px;"/></dd>
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
                        
                        <dt><label for="image_url">Image Upload Url:</label></dt>
                        <dd><input type="text" id="image_url" name="image_url" /> <font color="red">*</font></dd>

                        <dt><label for="title">Ads Title:</label></dt>
                        <dd><input type="text" id="ad_title" name="ad_title" /> <font color="red">*</font></dd>
                        
                        
                        <dt><label for="title">Ads/Banner Link Url:</label></dt>
                        <dd><input type="text" id="url" name="url" /> <font color="red">*</font></dd>
                        
                    </dl>
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="#" id="create_ad" class="cssanchor">SUBMIT</a></div>
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
