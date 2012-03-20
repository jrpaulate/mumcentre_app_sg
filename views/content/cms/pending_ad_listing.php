<div id="content">
    <input type="hidden" id="advertiser_id" value="<?php echo $advertiser_id; ?>"/>
    <input type="hidden" id="provider_id" value="<?php echo $provider_id; ?>"/>
    <ul class="ulsubnav">
        <li><a href="cms_ads_listing">Ads Listing / List</a></li>
        <li><a href="cms_advertiser">Advertiser List</a></li>
       </ul >
        
       
        <ul class="ulsubnav" align="right" > 
            
            <li><a href="cms_advertiser/pending_ads/">Pending Ads</a> </li>
            <li><a href="cms_advertiser/active_ads/<?php echo $advertiser_id; ?>">Active Ads Ads</a> </li>
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
                
                <td width="15%">Command</td>
        	</tr>
		</table>
        <div id="ad-listing"></div>
<!--        <div class='pager'>
                      <span class='pageNumbers'></span>
                      Page <span class='currentPage'></span> of <span class='totalPages'></span>
                    </div>-->
    </div>
    
       
</div>
<div id="placement">
    <div id="pub-listing"></div>
    <br/><br/><br/>
    <div id="zone-listing"></div>
    <br/><br/><br/>
    <a href="#" id="link_banner">Set Ad Placement</a>
</div>
<script type="text/html" id="ad_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
            {{#ad_list}}
            {{#ads}}
        	<tr>

        	  <td width="3%">{{id}}</td>
        	  <td width="5%"><img src="{{image_url}}" width="65" height="65" /></td>
        	  <td width="20%">{{image_url}}</td>
                  <td width="20%">{{name}}</td>
                  <td width="10%">{{width}}</td>
                  <td width="10%">{{height}}</td>
        	  <td width="15%">{{provider_location}}</td>
        	  <td width="15%"></br><a class="actionbtn" href="javascript:;;" onclick="javascript:ad_placement({{banner_id}})"> Placement </a></td>
                  <input id="banner_id" type="hidden" value="{{banner_id}}"/>
      	  </tr>
          {{/ads}}
          {{/ad_list}}
        </table>
</script>

<script type="text/html" id="pub_listing_tpl">
    {{#publisher_list}}
    <dd><select name="pub_list" id="ads_listing" >
            <option value="0">Choose country/publisher</option>
            {{#publisher}}
            <option value="{{publisher_id}}" onclick="javascript:load_zone({{publisher_id}})">{{publisher_name}}</option>
            {{/publisher}}
        </select></dd>
    {{/publisher_list}}
</script>

<script type="text/html" id="zone_listing_tpl">
    {{#zone_list}}
    <dd><select name="zone_list" id="zone_list" >
            <option value="0">Choose zone/placement</option>
            {{#zone}}
            <option value="{{zone_id}}">{{zone_name}}</option>
            {{/zone}}
        </select></dd>
    {{/zone_list}}
</script>

<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        $('#placement').dialog({
            autoOpen: false,
            width: 300,
            height: 300
        });
        var advertiser_id = $('#advertiser_id').val();
        $.get("cms_advertiser/ad_list/"+advertiser_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.ad_listing_tpl(data);
            $('#ad-listing').html('');
            $('#ad-listing').append(template);
            return false;
        });
        
    });
    function ad_placement(banner_id){
        $.get("cms_advertiser/publisher_list/", function(response) {
            var data = JSON.parse(response);
            var template = ich.pub_listing_tpl(data);
            $('#pub-listing').html('');
            $('#pub-listing').append(template);
            return false;
        });
            
        $('#placement').dialog('open');
        $('#link_banner').click(function(e){
            var zone = $('#zone_list').val();
//            var banner = $('#banner_id').val();
//            alert('zone id: '+zone+'; banner id: '+banner);
            $.post("cms_advertiser/link_banner", {
              zone_id: zone,
              banner_id: banner_id
            },
            function(data) {
//                alert(data);
                var rurl = data.split(":");
                    var code = rurl[0];
                    var msg = rurl[1];
                    if (code != 0) {
                        alert('error: '+data);
                    } else {
                        alert(msg);
                        var provider_id = $('#provider_id').val();
                      window.location = 'cms_advertiser/pending_ads/'+provider_id;

                    }
            });
            e.preventDefault();
        })
    }
    
    function load_zone(pub_id){
        $.get("cms_advertiser/zone_list/"+pub_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.zone_listing_tpl(data);
            $('#zone-listing').html('');
            $('#zone-listing').append(template);
            return false;
            
        });
    }
 
</script>



