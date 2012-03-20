<div id="content">
	<ul class="ulsubnav">
    	<li><a href="cms_curriculum/add_curriculum">Add New Curriculum</a></li>
    </ul>

  <form id="frmSearch" name="frmMain">
                <div class="searchbar">
                    <ul>
                        <li><label for="keyword">Keyword:</label>
                        <input type="text" id="keyword" name="searchfield" class="lnksearch-textinput"/>
                        <input type="submit" alt="Submit button" id="searchbutton" style="visibility:hidden"/></li>
                    </ul>
          
                </div>
      
      
                    
                 <div class="searchbar">
                    <ul>
                        <li><label for="countries">Country Filter:</label></li>
                        <li><div id="country-listing"> </div> </li>
                                                
                        
                        <li><label for="age_group">Age Group Filter:</label></li>
                        <li><div id="age-group-listing"> </div> </li>
                   
                    
                        <li><label for="status">Status:</label><select name="status" id="status" onchange="">    
                        <option value="0"> All </option>
                        <option value="1">Published</option>
                        <option value="2">Unpublished</option>
                        </select></li>
                        
                        
                        <li><label for="filter_date">Date Filter:</label>
                        <input type="text" name="filter_date"  id="search_date"  value="<?php echo set_value('search_date'); ?>"/> </li>
                        
                       
                        
                        <li><a id="search_button" href="javascript:;;"  onclick="javascript:Search(); "><img src="assets/img/system/go-btn.gif" width="50px" height="35px" align="center"  /></a></li>
                         
                        
                    
                    
                    
                    
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
                <td width="3%">Country</td>
                <td width="5%">Curriculum Image</td>
                <td width="8%">Age Group</td>
                <td width="17%">Provider</td>
                <td width="15%">Curriculum Title</td>
                <td width="10%">Curriculum URL</td>     
                <td width="5%">Status</td>
                <td width="23%">Command</td>
        	</tr>
		</table>
        <div id="curriculum-listing"></div>

    
    </div>
    
       <div id="preview"><iframe id="frame" src="http://mumcentre.xhiber-dynamic.com" width="1250" height="550"></iframe></div>
    
</div>





<div id="forum_modal" >
  
     
    
     <div id="data-listing"></div>
  
</div> 
 
    
    
<div id="hotbox_modal" >
  

     <div id="hotbox-listing"></div>
  
</div> 
 


<script type="text/html" id="forum_listing_tpl">
    {{#forum_list}}
    {{#forum}}
    <li class="li-threads">
        <div class="most_recent">
            <strong><span class="globel_style"><a class="blue" href="<?php echo base_url(); ?>forum/index.php?topic={{id_topic}}">{{subject}}</a></span></strong><br/>{{body}} <a href="<?php echo base_url(); ?>forum/index.php?topic={{id_topic}}">read more</a></div>
    </li>
    {{/forum}}
    {{/forum_list}}
</script>


<script type="text/html" id="board_listing_tpl">
    {{#board_list}}
    {{#board}}
    
    
    <option value="{{id_board}}">{{name}}</option>
    {{/board}}
    {{/board_list}}
</script>


<script type="text/html" id="data_listing_tpl">
   
   <table width="100%" cellpadding="5">
     
         <tr>
            <td width="100">Board : </td>
            <td><select id="thread_board" name="thread_board" value="thread_board"></select></td>
      </tr>
    {{#curriculums_data}}
    {{#curriculums}}
        <tr>
            <td>Topic : </td>
            <td><input id="thread_topic" name="thread_topic" value="{{curriculum_title}}" style="width:100%;border:1px solid #abadb3;line-height:18px;"  /></td>
        </tr>
        <tr>
            <td>Message : </td>
            <td><textarea id="thread_msg" name="thread_msg" value="{{curriculum_summary}}" style="width:100%;resize:none;margin:0px;padding:0px;border:1px solid #abadb3;" rows="3">{{curriculum_summary}}</textarea></td>
        </tr>
        <tr>
            <td colspan="2"><a href="javascript:void(0);" onclick="createThread()" class="btn-rnd fright view-link"><small>POST</small></a></td>
        </tr>
        
    {{/curriculums}}
    {{/curriculums_data}}
    </table>
 
 
</script>




<script type="text/html" id="hotbox_listing_tpl">
   
   <table width="100%" cellpadding="5">
     
    {{#curriculums_data}}
    {{#curriculums}}
    
        <tr> 
        <td>Curriculum Image</td>
        <td><img id="avatar" value="uploaded/provider/curriculum/image/{{curriculum_image}}" src="uploaded/provider/curriculum/image/{{curriculum_image}}" style="width: 250px; height: 150px;"/></td>
                    
        </tr>
    
        <tr>
            <td>Curriculum Title : </td>
            <td><input id="title" name="title" value="{{curriculum_title}}" style="width:100%;border:1px solid #abadb3;line-height:18px;"  /></td>
        </tr>
        <tr>
            <td>Event Summary : </td>
            <td><textarea id="summary" name="summary" value="{{curriculum_summary}}" style="width:100%;resize:none;margin:0px;padding:0px;border:1px solid #abadb3;" rows="3">{{curriculum_summary}}</textarea></td>
        </tr>
        
        
         <input type="hidden" id="seo_url" value="ps_providers/curriculums/{{provider_id}}/{{curriculum_id}}"/> 
         
         <input type="hidden" id="country_id" value="{{country_id}}"/>   
     
        <tr>
            <td colspan="2"><a href="javascript:void(0);" onclick="publishHotbox()" class="btn-rnd fright view-link"><small>POST</small></a></td>
        </tr>
        
    {{/curriculums}}
    {{/curriculums_data}}
    </table>
 
 
</script>





<script type="text/html" id="curriculumAll_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
            {{#curriculumAll_list}}
            {{#curriculumAll}}
        	<tr>

        	  <td width="3%">{{id}}</td>
                  <td width="3%">{{country}}</td>
        	  <td width="5%"><img src="uploaded/provider/curriculum/image/{{curriculum_image}}" width="65" height="65" /></td>
        	  <td width="8%">{{age_group_name}}</td>
                  <td width="15%">{{provider_name}}</td>
                  <td width="15%">{{curriculum_title}}</td>
                  <td width="5%">{{url}}/ps_providers/curriculums/{{provider_id}}/{{id}}</td>
        	  <td width="5%">{{curriculum_status}}</td>
        	  <td width="23%"></br><a class="actionbtn" onclick="javascript:preview({{id}})" href="javascript:;;" id ="">Preview</a>| <a class="actionbtn" href="edit_curriculum/read/{{id}}">Edit</a> </br> </br><a class="actionbtn" onclick="javascript:publish({{id}})" href="javascript:;;" >Publish</a> | <a class="actionbtn" onclick="javascript:unpublish({{id}})" href="javascript:;;" >Unpublish </a> </br></br></br><a class="actionbtn" onclick="javascript:open_modal({{id}})" href="javascript:;;" id ="" >Publish to Forums </a>  |  <a class="actionbtn" onclick="javascript:open_hotbox({{id}})" href="javascript:;;" id ="" >Add to Hotbox </a></br> </br></br> <a class="actionbtn" onclick="javascript:remove({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>

      	  </tr>
          {{/curriculumAll}}
          {{/curriculumAll_list}}
        </table>
</script>


<script type="text/html" id="curriculum_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
            {{#curriculum_list}}
            {{#curriculum}}
        	<tr>

        	  <td width="3%">{{id}}</td>
                  <td width="3%">{{country}}</td>
        	  <td width="5%"><img src="uploaded/provider/curriculum/image/{{curriculum_image}}" width="65" height="65" /></td>
        	  <td width="8%">{{age_group_name}}</td>
                  <td width="15%">{{provider_name}}</td>
                  <td width="15%">{{curriculum_title}}</td>
                  <td width="5%">{{url}}/ps_providers/curriculums/{{provider_id}}/{{id}}</td>
        	  <td width="5%">{{curriculum_status}}</td>
        	  <td width="23%"></br><a class="actionbtn" onclick="javascript:preview({{id}})" href="javascript:;;" id ="">Preview</a>| <a class="actionbtn" href="edit_curriculum/read/{{id}}">Edit</a> </br> </br><a class="actionbtn" onclick="javascript:publish({{id}})" href="javascript:;;" >Publish</a> | <a class="actionbtn" onclick="javascript:unpublish({{id}})" href="javascript:;;" >Unpublish </a> </br></br></br><a class="actionbtn" onclick="javascript:open_modal({{id}})" href="javascript:;;" id ="" >Publish to Forums </a>  |  <a class="actionbtn" onclick="javascript:open_hotbox({{id}})" href="javascript:;;" id ="" >Add to Hotbox </a></br> </br></br> <a class="actionbtn" onclick="javascript:remove({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>

      	  </tr>
          {{/curriculum}}
          {{/curriculum_list}}
        </table>
</script>



<script type="text/html" id="curriculum_search_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
            {{#curriculum_list}}
            {{#curriculum}}
        	<tr>

        	  <td width="3%">{{id}}</td>
                  <td width="3%">{{country}}</td>
        	  <td width="5%"><img src="uploaded/provider/curriculum/image/{{curriculum_image}}" width="65" height="65" /></td>
        	  <td width="8%">{{age_group_name}}</td>
                  <td width="15%">{{provider_name}}</td>
                  <td width="15%">{{curriculum_title}}</td>
                  <td width="5%">{{url}}/ps_providers/curriculums/{{provider_id}}/{{id}}</td>
        	  <td width="5%">{{curriculum_status}}</td>
        	  <td width="23%"></br><a class="actionbtn" onclick="javascript:preview({{id}})" href="javascript:;;" id ="">Preview</a>| <a class="actionbtn" href="edit_curriculum/read/{{id}}">Edit</a> </br> </br><a class="actionbtn" onclick="javascript:publish({{id}})" href="javascript:;;" >Publish</a> | <a class="actionbtn" onclick="javascript:unpublish({{id}})" href="javascript:;;" >Unpublish </a> </br></br></br><a class="actionbtn" onclick="javascript:open_modal({{id}})" href="javascript:;;" id ="" >Publish to Forums </a>  |  <a class="actionbtn" onclick="javascript:open_hotbox({{id}})" href="javascript:;;" id ="" >Add to Hotbox </a></br> </br></br> <a class="actionbtn" onclick="javascript:remove({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>

      	  </tr>
          {{/curriculum}}
          {{/curriculum_list}}
        </table>
</script>



<script type="text/html" id="curriculum_tpl">
 
    {{#curriculum_data}}

            {{#curriculum}}
         
  <div id ="content">
          <div id="RC-body">
                 <h2>Title:{{curriculum_title}}</h2>
         
                <div class="RC-text-cont">
                        <div id="RC-img-cont">
                                 <img src="uploaded/provider/curriculum/image/{{curriculum_image}}" width="212" height="235" />
                </div>
                        </div><!-- end RC-img-cont -->
                <div id="curriculumcontain">{{curriculum_body}}</div>
               
                </div>
          </div>
                             

    </div>
{{/curriculum}}
{{/curriculum_data}}
</script>




<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        $('#search_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
               
              
        });
        
        
          $('#preview').dialog({
            autoOpen: false,
            width: 1300,
            height: 600
        });
        
        
        $('#forum_modal').dialog({
            autoOpen: false,
            width: 800,
            height: 500
            
            
        });
        
        
         $('#hotbox_modal').dialog({
            autoOpen: false,
            width: 800,
            height: 700
            
            
        });
        
    
          $('#open_modal').click(function(e){
              
            e.preventDefault();
        });
        
        
         $('#open_hotbox').click(function(e){
              
            e.preventDefault();
        });
        
        
        $.get("cms_curriculum/curriculumAll_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.curriculumAll_listing_tpl(data);
            $('#curriculum-listing').html('');
            $('#curriculum-listing').append(template);
            return false;
        });
        
        
        $.get("cms_curriculum/age_group_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.age_group_listing_tpl(data);
            $('#age-group-listing').html('');
            $('#age-group-listing').append(template);
            return false;
        });
        
        
        $.get("cms_curriculum/country_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.country_listing_tpl(data);
            $('#country-listing').html('');
            $('#country-listing').append(template);
            return false;
        });
        
        
        $('#frmSearch').submit(function(e) {
            var keyword = $('#keyword').val();
            $.get("cms_curriculum/search_curriculum/",{keyword:keyword},function(response) {
                var data = JSON.parse(response);
                var template = ich.curriculum_search_listing_tpl(data);
                $('#curriculum-listing').html('');
                $('#curriculum-listing').append(template); 
                return false;    });
            e.preventDefault();
        });
        
        
    });
</script>




<script>

 function preview (curriculum_id) {
//         echo ('Msg');
            $.post("cms_curriculum/get_curriculum_link", {
              curriculum_id: curriculum_id  
            },
            function(data) {
//                alert(data);
                $('#frame').attr('src', data);
                $('#preview').dialog('open');
            });
//            $('#preview').append('Msg');

}

       

</script>



<script>

 function unpublish (curriculum_id) {

           $.post("cms_curriculum/unpublish/"+ curriculum_id) 
           

           alert('Curriculum Successfully Unpublished')             
            
           
           window.location = 'cms_curriculum';   
          }
       

</script>


<script>

 function publish (curriculum_id) {

           $.post("cms_curriculum/force_publish/"+ curriculum_id) 
           

           alert('Curriculum Successfully Published')             
            
           
           window.location = 'cms_curriculum';   
          }
       

</script>





<script>
function createThread(){
            var topic = $('#thread_topic').val();
            var subject = $('#thread_msg').val();
            var board_id = $('#thread_board').val();
//            var base_url = $('#base_url').val();
            //            alert('topic: '+topic+'<br/>subject: '+subject+'<br/>board id: '+board_id)

            $.post("mm/createThreadMM", {subject: topic, content : subject, agegroupid : board_id},
            function(data) {
                if(data){
                    $('#thread_topic').val('');
                    $('#thread_msg').val('');
                    alert("Thread created.");
                    $('#forum_modal').dialog('close');
//                    window.location = base_url+'forum/index.php?topic='+data;
                }
                else
                {
                    alert('Error creating thread');
                }
            });
        }


</script>




<script>
 
 function open_modal(curriculum_id){
     
      

       $.get("cms_curriculum/curriculums_data/"+ curriculum_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.data_listing_tpl(data);
            $('#forum_modal').html('');
            $('#forum_modal').append(template);
            
             
            
            $.get("cms/board_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.board_listing_tpl(data);
            $('#thread_board').html('');
            $('#thread_board').append(template);
            return false;
        });
        });
     
          $('#forum_modal').dialog('open');
 }
    
</script>


<script>
 
 function open_hotbox(curriculum_id){
     
      
       $.get("cms_curriculum/curriculums_data/"+ curriculum_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.hotbox_listing_tpl(data);
            $('#hotbox_modal').html('');
            $('#hotbox_modal').append(template);
            
        });
     
          $('#hotbox_modal').dialog('open');
 }
    
</script>
     



<script>

 function publishHotbox() {
     
         var title = $('#title').val();
         var summary = $('#summary').val();
         var seo_url = $('#seo_url').val();
         var country_id = $('#country_id').val();
         var avatar = $('#avatar').attr('src');
               
           $.post("cms_curriculum/create_hotbox", {
               title:title, 
               avatar: avatar, 
               summary : summary,
               seo_url:seo_url,
               country_id: country_id
       
            },
            function(data) {
                if(data){
                    $('#title').val('');
                    $('#avatar').val('');
                    $('#summary').val('');
                    $('#seo_url').val('');
                    $('#country_id').val('');

                    alert("Hotbox Successfully Created.");
                    
                    $('#hotbox_modal').dialog('close');
//                    window.location = base_url+'forum/index.php?topic='+data;
                }
                else
                {
                    alert('Error creating thread');
                }
            });
        }
       

</script>


<script type="text/html" id="age_group_listing_tpl">
    {{#age_group_list}}
    <dd><select name="age_group" id="age_group" onchange="">
            <option value="0"> All </option>
            {{#age_groups}}
            <option value="{{age_group_id}}">{{age_group_name}}</option>
            {{/age_groups}}
        </select></dd>
  
    {{/age_group_list}}
</script>


<script type="text/html" id="country_listing_tpl">
    {{#country_list}}
           
   <dd><select name="countries" id="countries" onchange="">    
             
            <option value="0"> All </option>
           {{#countries}}
           
            <option value="{{country_id}}">{{country_name}}</option>
             {{/countries}}
   </select></dd>
   
    {{/country_list}}
</script>







<script>

        
     function Search(){
     var date = 0;
     var type =0;
     var status =0;
     var country_id = $('#countries').val();
     var age_group_id = $('#age_group').val();
     var status = $('#status').val();
     if($('#search_date').val()){date = $('#search_date').val();}
     if($('#type').val()){type = $('#type').val();}
     if($('#status').val()){type = $('#status').val();}
    
    
    
    $.get("cms_curriculum/curriculum_list/"+ country_id+"/"+ age_group_id+"/"  + status+"/" +date, function(response) {
            var data = JSON.parse(response);
            var template = ich.curriculum_listing_tpl(data);
            $('#curriculum-listing').html('');
            $('#curriculum-listing').append(template);
            return false;
            
            
        });
            
     
 
    
}
</script>




<script>

 function remove (curriculum_id) {

           $.post("cms_curriculum/force_delete/"+ curriculum_id) 
           

           alert('Curriculum Removed')             
            
           
           window.location = 'cms_curriculum';   
          }
       

</script>



