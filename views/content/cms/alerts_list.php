<div id="content">
	<ul class="ulsubnav">
    	<li><a href="">Recipient's List</a></li>
        <li><a href="cms_alerts">Alerts Queue / List</a></li>
        <li><a href="">Archieved / Sent List</a></li>
        <li><a href="cms_alerts/campaign">Generate</a></li>
      
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
            	<td width="3%">ID</td>
                <td width="5%">Age Group</td>
                <td width="6%">Content Type</td>
                <td width="10%">Content Title</td>
                <td width="15%">Content Url</td>
                <td width="15%">Content Summary</td>
                <td width="5%">ads</td>
                <td width="5%">Sending Date</td>
        	</tr>
		</table>

        <div id="alerts-listing"></div>
<!--        <div class='pager'>
                      <span class='pageNumbers'></span>
                      Page <span class='currentPage'></span> of <span class='totalPages'></span>
                    </div>-->
    </div>
</div>

<script type="text/html" id="alerts_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
            {{#alerts_list}}
            {{#alerts}}
        	<tr>
                    
        	  <td width="3%">{{id}}</td>
        	  <td width="8%">{{age_group_name}}</td>
        	  <td width="10%">{{content_type}}</td>
        	  <td width="15%">{{content_title}}</td>
                  <td width="5%"> <a class="" href="{{content_link}}" id ="">{{content_link}}</a> </td>
                  <td width="30%">{{content_summary}}</td>
                  <td width="10%">{{ads}}</td>
                  <td width="10%">{{sending_date}}</td>
        	
      	  </tr>
          {{/alerts}}
          {{/alerts_list}}
        </table>
</script>

<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $.get("cms_alerts/alerts_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.alerts_listing_tpl(data);
            $('#alerts-listing').html('');
            $('#alerts-listing').append(template);
            return false;
        });

    });
    
    
      $('#Generate').click(function(e){
                  $.post("cms_alerts/campaign")
              // alert('wew')
               e.preventDefault();
        });
</script>