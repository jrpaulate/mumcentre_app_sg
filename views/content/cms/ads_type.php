<div id="content">
	<ul class="ulsubnav">
            <li><a href="cms_ads_type">Ads Type</a></li>
            <li><a href="cms_ads_listing">Ads Listing / List</a></li>
            <li><a href="cms_purchased_ads">Ads Purchased List</a></li>
        </ul>
    
        <ul class="ulsubnav" align="right" > 
            <li><a href="">Add New Ad Type</a> </li>
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
                    <td width="30%">Type Name</td>
                    <td width="30%">Ad Class</td>
                    <td width="30%">Command</td>
        	</tr>
        </table>

        <div id="type-listing"></div>
<!--        <div class='pager'>
                      <span class='pageNumbers'></span>
                      Page <span class='currentPage'></span> of <span class='totalPages'></span>
                    </div>-->
    </div>
</div>

<script type="text/html" id="type_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
    
        {{#type_list}}
            {{#type}}
        	<tr>
                    
        	  <td width="10%">{{id}}</td>
        	  <td width="30%">{{name}}</td>
                  <td width="30%"> </td>
        	  <td width="30%"></br><a class="actionbtn" onclick="" href="javascript:;;" id ="">Edit</a> </br> </td>
                  
      	  </tr>
          {{/type}}
          {{/type_list}}
        
        
        
        
    </table>
</script>

<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>

<script type="text/javascript">
   $(document).ready(function(){
        $.get("cms_ads_type/type_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.type_listing_tpl(data);
            $('#type-listing').html('');
            $('#type-listing').append(template);
            return false;
        });

    });
</script>