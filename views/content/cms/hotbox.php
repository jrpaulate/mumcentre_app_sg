<div id="content">
	<ul class="ulsubnav">
   
    </ul>
  
  <form id="frmMain" name="frmMain">
                <div class="searchbar">
                    <ul>
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
                <td width="10%">Image</td>
                <td width="10%">Country</td>
                <td width="20%">Title</td>
                <td width="10%">Status</td>
                <td width="18%">Command</td>
        	</tr>
        </table>
        <div id="hotbox-listing"></div>

        </br>
        </br>
        </br>
        
         <div id="hotboxunpub-listing"></div>
    </div>

    
</div>

<script type="text/html" id="hotbox_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
           
          {{#hotbox_list}}
            {{#hotbox}}
        	<tr>
                    
        	  <td width="5%">{{id}}</td>
        	  <td width="10%"><img src="{{{hotbox_image}}}" width="65" height="65" /></td>             
                  <td width="10%">{{country_name}}</td>
                  <td width="20%">{{title}}</td>
                  <td width="10%">{{status}}</td>
        	  <td width="17%"> </br><a class="actionbtn" onclick="javascript:publish({{id}})" href="javascript:;;" >Publish</a> | <a class="actionbtn" onclick="javascript:unpublish({{id}})" href="javascript:;;" >Unpublish </a> </br> </br><a class="actionbtn" onclick="javascript:remove({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>
                  
      	  </tr>
          {{/hotbox}}
          {{/hotbox_list}}
       
        </table>
</script>



<script type="text/html" id="hotboxunpub_listing_tpl">
    <table class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0">
        	<tr>
            	<td width="5%">ID</td>
                <td width="10%">Image</td>
                <td width="10%">Country</td>
                <td width="20%">Title</td>
                <td width="10%">Status</td>
                <td width="18%">Command</td>
        	</tr>
    </table>

    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
           
        
          {{#hotboxunpub_list}}
            {{#hotboxunpub}}
        	<tr>
                    
        	  <td width="5%">{{id}}</td>
        	  <td width="10%"><img src="{{{hotbox_image}}}" width="65" height="65" /></td>             
                  <td width="10%">{{country_name}}</td>
                  <td width="20%">{{title}}</td>
                  <td width="10%">{{status}}</td>
        	  <td width="17%"> </br><a class="actionbtn" onclick="javascript:publish({{id}})" href="javascript:;;" >Publish</a> | <a class="actionbtn" onclick="javascript:unpublish({{id}})" href="javascript:;;" >Unpublish </a> </br> </br><a class="actionbtn" onclick="javascript:remove({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>
                  
      	  </tr>
          {{/hotboxunpub}}
          {{/hotboxunpub_list}}
       
        </table>
</script>


<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>

<script type="text/javascript">
    $(document).ready(function(){

        $.get("cms_hotbox/hotbox_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.hotbox_listing_tpl(data);
            $('#hotbox-listing').html('');
            $('#hotbox-listing').append(template);
            return false;
        });
        
        
        $.get("cms_hotbox/hotboxunpub_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.hotboxunpub_listing_tpl(data);
            $('#hotboxunpub-listing').html('');
            $('#hotboxunpub-listing').append(template);
            return false;
        });
        
  
    });
</script>




<script>

 function unpublish (hotbox_id) {

           $.post("cms_hotbox/unpublish/"+ hotbox_id) 
           

           alert('Hotbox Unpublished')             
            
           
           window.location = 'cms_hotbox';   
          }
       

</script>


<script>

 function publish (hotbox_id) {

           $.post("cms_hotbox/force_publish/"+ hotbox_id) 
           

           alert('Hotbox Published')             
            
           
           window.location = 'cms_hotbox';   
          }
       

</script>


<script>

 function remove (hotbox_id) {

           $.post("cms_hotbox/force_delete/"+ hotbox_id) 
           

           alert('Hotbox Removed')             
            
           
           window.location = 'cms_hotbox';   
          }
       

</script>
