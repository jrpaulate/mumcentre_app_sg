<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var base_url = $('#base_url').val();
        var id = $('#id').val();
        
        
  
        
        
          $.get("cms_edit_ads/banner_data/"+ id, function(response) {
            var data = JSON.parse(response);
            var template = ich.banner_listing_tpl(data);
            $('#banner-listing').html('');
            $('#banner-listing').append(template);
            
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
                
                
            
             return false;
           
        });
        
        
        
        
        
        
        
             
                
                
            $('#update_ad').click(function(e) {
          
            
            var campaign_name = $('#campaign_name').val();
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var campaign_id = $('#campaign_id').val();
            var banner_id = $('#banner_id').val();
            var a_id = $('#a_id').val();
            var c_id = $('#c_id').val();
          
           
            var advertiser_id = $('#advertiser_id').val();
            var url = $('#url').val();
            
            if(campaign_name.length == 0) {
                alert("Campaign Name cannot be empty!");
            } else if(start_date.length == 0) {
                alert("Start date cannot be empty!");
            } else if(end_date.length == 0) {
                alert("End Date cannot be empty!");         
            } else if(!advertiser_id) {
                alert("Please select a provider");    
            } else {
                $.post("cms_edit_ads/update_ad", {                  
                    campaign_id: campaign_id,
                    banner_id: banner_id,
                    campaign_name: campaign_name,
                    start_date: start_date,
                    end_date: end_date,                  
                    advertiser_id: advertiser_id,          
                    url: url,
                    a_id: a_id,
                    c_id: c_id
                   
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






<script type="text/html" id="banner_listing_tpl">

 {{#banner_data}}     
   {{#banner}}    
   
                        <dt><label for="size">Campaign Name:</label></dt>
                        <dd><input type="text" name="campaign_name" id="campaign_name" value="{{campaign_name}}"/> </dd>

                        <dt><label for="start_date">Start Date</label></dt>
                        <dd><input type="text" name="start_date" id="start_date" class="text-ep-textinput" value="{{start_date}}"/></dd>

                       <dt><label for="end_date">End Date</label></dt>
                       <dd><input type="text" name="end_date" id="end_date" class="text-ep-textinput" value="{{end_date}}"/></dd>
                     
   

                        <dt>Ads Image</dt>
                        <dd><img id="avatar" src="{{{image_url}}}" value="{{{image_url}}}" style="width: 255px; height: 255px;"/></dd>
                        <dt class="empty"></dt>
                      
                        <input type="hidden" id="hidden_avatar"/>
                        
                        <input type="hidden" id="campaign_id" value="{{campaign_id}}"/>
                        <input type="hidden" id="a_id" value="{{a_id}}"/>
                        <input type="hidden" id="c_id" value="{{c_id}}"/>
                        <input type="hidden" id="banner_id" value="{{banner_id}}"/>
                
                        
                        <dt><label for="title">Ads/Banner Link Url:</label></dt>
                        <dd><input type="text" id="url" name="url" value="{{{url}}}" /> <font color="red">*</font></dd>

  {{/banner}}
  {{/banner_data}}

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
<input type="hidden" id="id" value="<?php echo $id; ?>"/>
<input type="hidden" id="advertiser_id"/>
<form id="frmMain" name="frmMain">

    <div id="content">
        <ul class="ulsubnav">
            <li>Edit Ads CMS</li>
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Edit Ads</h2>

                <div id="ads_listing_info">
                    <p><i><font color="red">Campaign Details</font> </i></p>
      
                   
                    <dl>
                        
                        <dt><label for="provider">Campaign For Provider:</label></dt>
                        <dd><select id="provider_name" name="provider_name"></select> </dd>
                        </br>
                        </br>
                        


                        
                         <div id="banner-listing"> </div>   

                        <div id="ads1_list"> </div>

         
                       
                        
                    </dl>
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="#" id="update_ad" class="cssanchor">SUBMIT</a></div>
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
