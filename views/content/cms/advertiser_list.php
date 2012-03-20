<div id="content">
    	<ul class="ulsubnav">
        <li><a href="cms_ads_listing">Ads Listing / List</a></li>
        <li><a href="cms_advertiser">Advertiser List</a></li>
       </ul >
        
     


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
    	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0">
        	<tr>
            	<td width="3%">ID</td>
                <td width="5%">Logo</td>
                <td width="20%">Provider Name</td>
                <td width="10%">Age Group</td>
                <td width="10%">Provider Listing</td>
                <td width="15%">Location</td>
                
                <td width="15%">Command</td>
        	</tr>
		</table>
        <div id="provider-listing"></div>
<!--        <div class='pager'>
                      <span class='pageNumbers'></span>
                      Page <span class='currentPage'></span> of <span class='totalPages'></span>
                    </div>-->
    </div>
    
       
</div>

<script type="text/html" id="provider_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
            {{#provider_list}}
            {{#provider}}
        	<tr>

        	  <td width="3%">{{id}}</td>
        	  <td width="5%"><img src="uploaded/provider/logo/{{provider_logo}}" width="65" height="65" /></td>
        	  <td width="20%">{{provider_name}}</td>
                  <td width="10%">{{age_group_name}}</td>
                  <td width="10%">{{provider_listing_name}}</td>
        	  <td width="15%">{{provider_location}}</td>
        	  <td width="15%"></br><a class="actionbtn" href="cms_advertiser/pending_ads/{{id}}"> View Ads Listings </a></td>

      	  </tr>
          {{/provider}}
          {{/provider_list}}
        </table>
</script>

<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
       
        
        $.get("cms_advertiser/provider_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#provider-listing').html('');
            $('#provider-listing').append(template);
            return false;
        });
    });
</script>



