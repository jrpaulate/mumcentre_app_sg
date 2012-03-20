<div id="content">
    <input type="hidden" id="advertiser_id" value="<?php echo $advertiser_id; ?>"/>
    <input type="hidden" id="provider_id" value="<?php echo $provider_id; ?>"/>
    <ul class="ulsubnav">
        <li><a href="cms_ads_listing">Ads Listing / List</a></li>
        <li><a href="cms_advertiser">Advertiser List</a></li>
       </ul >
        
       
        <ul class="ulsubnav" align="right" > 
            
            <li><a href=""cms_advertiser/active_ads/<?php echo $advertiser_id; ?>">Active Ads Ads</a> </li>
            <li><a href="cms_advertiser/add_advertiser">Expired Ads</a> </li>
        </ul>


  <form id="frmMain" name="frmMain">
                <div class="searchbar">
                    <ul>
                        <li><label for="search_key">Search by name:</label>
                        <input type="text" id="search_key" name="search_key" /></li>
                        <li><a href="#" id="search_member"><input type="image" src="assets/img/system/img_search.png" /></a></li>
                    </ul>
                </div>
                </form>
    <div class="tableholder">
<!--    <div class='pager'>
                      <span class='pageNumbers'></span>
                      Page <span class='currentPage'></span> of <span class='totalPages'></span>
                    </div>-->
        <span>Ads for <?php echo $provider_name; ?></span>
    	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0">
        	<tr>
            	<td width="3%">ID</td>
                <td width="5%">Ad image</td>
                <td width="20%">ad URL</td>
                <td width="20%">Ad name</td>
                <td width="10%">Width</td>
                <td width="10%">Height</td>
                <td width="15%">Location</td>
                
             	</tr>
		</table>
        <div id="active-listing"></div>
<!--        <div class='pager'>
                      <span class='pageNumbers'></span>
                      Page <span class='currentPage'></span> of <span class='totalPages'></span>
                    </div>-->
    </div>
    
       
</div>

<script type="text/html" id="active_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
            {{#active_list}}
            {{#active}}
        	<tr>

        	  <td width="3%">{{id}}</td>
        	  <td width="5%"><img src="{{image_url}}" width="65" height="65" /></td>
        	  <td width="20%">{{image_url}}</td>
                  <td width="20%">{{name}}</td>
                  <td width="10%">{{width}}</td>
                  <td width="10%">{{height}}</td>
        	  <td width="15%">{{provider_location}}</td>
        	  <input id="banner_id" type="hidden" value="{{banner_id}}"/>
      	  </tr>
          {{/active}}
          {{/active_list}}
        </table>
</script>



<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
     
        var advertiser_id = $('#advertiser_id').val();
        $.get("cms_advertiser/active_list/"+advertiser_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.active_listing_tpl(data);
            $('#active-listing').html('');
            $('#active-listing').append(template);
            return false;
        });
        
    });
    
    
 
</script>



