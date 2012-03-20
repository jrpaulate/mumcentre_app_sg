<div id="content">
	<ul class="ulsubnav">
        <li><a href="cms_ads_listing">Ads Listing / List</a></li>
        <li><a href="cms_purchased/add_purchased/<?php echo $listing_id; ?>"> Create Ad Banner </a></li>
       </ul>
    
  
  <form id="frmMain" name="frmMain">
                <div class="searchbar">
                    <ul>
                        <li><label for="search_key">Search by title:</label>
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
    	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0">
        	<tr>
            	<td width="10%">ID</td>
                <td width="15%">Provider</td>
                <td width="15%">Ads Name</td>
                <td width="20%">Section</td>
                <td width="10%">Duration</td>
                <td width="10%">Start Date</td>
                <td width="10%">Expiry Date</td>
                <td width="10%">Command</td>
        	</tr>
		</table>

        <div id="ads-listing"></div>
<!--        <div class='pager'>
                      <span class='pageNumbers'></span>
                      Page <span class='currentPage'></span> of <span class='totalPages'></span>
                    </div>-->
    </div>
</div>
<input type="hidden" id="listing_id" value="<?php echo $listing_id; ?>" />
<script type="text/html" id="ads_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
    
         {{#ads_list}}
            {{#ads}}
        	<tr>
                    
        	  <td width="10%">{{id}}</td>
                  <td width="15%">{{provider_name}} </td>
        	  <td width="15%">{{ads_name}}</td>
                  <td width="20%">{{section}}</td>
                  <td width="10%">{{duration}} </td>
                  <td width="10%">{{start_date}} </td>
                  <td width="10%">{{end_date}} </td>
                  <td width="10%" type="hidden">{{campaign_id}} </td>
        	  <td width="10%"></br><a class="actionbtn" href="cms_edit_ads/edit/{{id}}" id ="">Edit</a> </br> </td>
                  
      	  </tr>
          {{/ads}}
          {{/ads_list}}    
        
        
    </table>
</script>

<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>

<script type="text/javascript">
     $(document).ready(function(){
        var listing_id = $('#listing_id').val();
//        alert(listing_id);
        $.get("cms_ads_listing/purchased_list_by_type/"+listing_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.ads_listing_tpl(data);
            $('#ads-listing').html('');
            $('#ads-listing').append(template);
            return false;
        });
    });
</script>