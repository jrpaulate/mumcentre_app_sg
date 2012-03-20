<div id="content">
	<ul class="ulsubnav">
        <li><a href="cms_ads_listing">Ads Listing / List</a></li>
        <li><a href="cms_advertiser">Advertiser List</a></li>
       </ul >
    

  
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
            	<td width="5%">ID</td>
                <td width="25%">Name</td>
                <td width="10%">Size</td>
                <td width="20%">Section</td>
                <td width="10%">Price</td>
                <td width="10%">Duration</td>
               
        	</tr>
		</table>

        <div id="ads-listing"></div>
<!--        <div class='pager'>
                      <span class='pageNumbers'></span>
                      Page <span class='currentPage'></span> of <span class='totalPages'></span>
                    </div>-->
    </div>
</div>

<script type="text/html" id="ads_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
    
         {{#ads_list}}
            {{#ads}}
        	<tr>
                    
        	  <td width="5%">{{id}}</td>
        	  <td width="25%"><a href="cms_ads_listing/purchased_ads/{{zone_id}}">{{name}}</a></td>
                  <td width="10%">{{width}} x {{height}} </td>
                  <td width="20%">{{section}} </td>
                  <td width="10%">{{price}} </td>
                  <td width="10%">{{duration}} </td>
        	  
      	  </tr>
          {{/ads}}
          {{/ads_list}}    
        
        
    </table>
</script>

<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>

<script type="text/javascript">
     $(document).ready(function(){
        $.get("cms_ads_listing/ads_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.ads_listing_tpl(data);
            $('#ads-listing').html('');
            $('#ads-listing').append(template);
            return false;
        });

    });
</script>