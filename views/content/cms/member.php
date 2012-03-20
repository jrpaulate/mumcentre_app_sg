<div id="content">
	<ul class="ulsubnav">
    	<li><a href="cms_member/add_member">Add New Member</a></li>
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
    	<table class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0">
        	<tr>
            	<td width="3%">ID</td>
                <td width="5%">Avatar</td>
                <td width="25%">Name</td>
                <td width="30%">Email</td>
                <td width="10%">Age</td>
                <td width="20%">Command</td>
        	</tr>
		</table>
        <div id="user-listing"></div>
<!--        <div class='pager'>
                      <span class='pageNumbers'></span>
                      Page <span class='currentPage'></span> of <span class='totalPages'></span>
                    </div>-->
    </div>
    
     <div id="preview"><div id="preview_container" ></div></div>
    
</div>

<script type="text/html" id="user_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
            {{#user_list}}
            {{#users}}
        	<tr>
                    
        	  <td width="3%">{{id}}</td>
        	  <td width="5%"><img src="uploaded/user/avatar/{{avatar_filepath}}" width="65" height="65" /></td>
        	  <td width="25%">{{first_name}} {{last_name}}</td>
                  <td width="30%">{{email}}</td>
        	  <td width="10%">{{age}}</td>
        	  <td width="20%"></br><a class="actionbtn" href="">Preview</a> | <a class="actionbtn" href="edit_member/read/{{id}}">Edit</a> | <a class="actionbtn" onclick="javascript:preview({{id}})" href="javascript:;;">Set Permission</a> </br> </br> <a class="actionbtn" href="#">Activate</a>  |  <a class="actionbtn" href="#">De-Activate</a></br></br></a></td>
                  
      	  </tr>
          {{/users}}
          {{/user_list}}
        </table>
</script>


<script type="text/html" id="article_tpl">
 
    {{#user_data}}

        <div id="RC-body-header">
            {{#user}}
            <div>First Name: {{first_name}}</div>
            <div>Last Name: {{last_name}}</div> 
            </ br>
            <div>Set Permission:</div>
        </div> <!-- end rc-body-header -->
        
        
                            <div id="RC-body">
  
                            <div id="RC-img-cont">
                               
                                
                 <div id="articlecontain"> 
                 <div>  
                     <form>
                 <table border="0">
                 <tr>
                 <td><input type="checkbox" name="1" id="Article_checkbox"/></td>
                 <td>Article</td>
               
                 <td><input type="checkbox" name="1" id="Reviews_checkbox"/></td>
                 <td>Reviews</td>
                
                 
                 <td><input type="checkbox" name="1" id="Program_checkbox"/></td>
                 <td>Programs</td>
                 </tr>
                 <tr>
          
                 
                 <td><input type="checkbox" name="1" id="Program_checkbox"/></td>
                 <td>Provider</td>
                 
                 <td><input type="checkbox" name="1" id="Curriculum_checkbox"/></td>
                 <td>Curriculum</td>
                 
          
                 <td><input type="checkbox" name="1" id="Program_checkbox"/></td>
                 <td>Events</td>
                 
                 <td><input type="checkbox" name="1" id="Program_checkbox"/></td>
                 <td>POW</td>
                 
                 </tr>
                
             
                 </table>
                   </form>
                     
                  <tr>
                
                <td> Save  Cancel </td>
                
                </tr>
                 </div>         
                 </div>
                        
              
              
          </div>
   </div>
                             


{{/user}}
{{/user_data}}
</script>

<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        $('#preview').dialog({
            autoOpen: false,
            width: 500
        });
        
        $.get("cms_member/user_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.user_listing_tpl(data);
            $('#user-listing').html('');
            $('#user-listing').append(template);
            return false;
        });
        
  
    });
</script>


<script>

 function preview(user_id) {
            $('#preview').dialog('open');
//         echo ('Msg');
            $.get("set_permission/user_data/"+ user_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.article_tpl(data);
            $('#preview_container').html('');
            $('#preview_container').append(template);
            
            
            return false;
//            
            });
//            $('#preview').append('Msg');

}

       

</script>
