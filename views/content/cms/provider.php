<div id="content">
    <ul class="ulsubnav">
        <li><a href="cms_provider/add_provider">Add New Provider</a></li>
         <li><a href="cms_provider_content/content">Provider Content</a></li>
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
                        <option value="1">Activated</option>
                        <option value="2">De-Activated</option>
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
                <td width="5%">Logo</td>
                <td width="20%">Provider Name</td>
                <td width="10%">Age Group</td>
             
                <td width="5%">Status</td>
                <td width="15%">Command</td>
            </tr>
        </table>
        <div id="provider-listing"></div>
        <!--        <div class='pager'>
                              <span class='pageNumbers'></span>
                              Page <span class='currentPage'></span> of <span class='totalPages'></span>
                            </div>-->
    </div>

    <div id="preview"><iframe id="frame" src="http://mumcentre.xhiber-dynamic.com" width="1250" height="550"></iframe></div>
</div>


<script type="text/html" id="providerAll_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
        {{#providerAll_list}}
        {{#providerAll}}
        <tr>

            <td width="3%">{{id}}</td>
            <td width="3%">{{country}}</td>
            <td width="5%"><img src="uploaded/provider/logo/{{provider_logo}}" width="65" height="65" /></td>
            <td width="20%">{{provider_name}}</td>
            <td width="10%">{{age_group_name}}</td>
          
            <td width="5%">{{provider_status}}</td>
            <td width="15%"></br><a class="actionbtn" onclick="javascript:preview({{id}})" href="javascript:;;" >Preview</a> | <a class="actionbtn" href="edit_provider/read/{{id}}">Edit</a> </br> </br> <a class="actionbtn" onclick="javascript:advertise({{id}})" href="javascript:;;"> Add as Advertiser </a> </br> </br> <a class="actionbtn" onclick="javascript:activated({{id}})" href="javascript:;;" >Activate</a> | <a class="actionbtn" onclick="javascript:deactivated({{id}})" href="javascript:;;" >Deactivate</a>   </br> </br></br> <a class="actionbtn" onclick="javascript:remove({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>

        </tr>
        {{/providerAll}}
        {{/providerAll_list}}
    </table>
</script>





<script type="text/html" id="provider_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
        {{#provider_list}}
        {{#provider}}
        <tr>

            <td width="3%">{{id}}</td>
            <td width="3%">{{country}}</td>
            <td width="5%"><img src="uploaded/provider/logo/{{provider_logo}}" width="65" height="65" /></td>
            <td width="20%">{{provider_name}}</td>
            <td width="10%">{{age_group_name}}</td>
           
            <td width="5%">{{provider_status}}</td>
            <td width="15%"></br><a class="actionbtn" onclick="javascript:preview({{id}})" href="javascript:;;" >Preview</a> | <a class="actionbtn" href="edit_provider/read/{{id}}">Edit</a> </br> </br> <a class="actionbtn" onclick="javascript:advertise({{id}})" href="javascript:;;"> Add as Advertiser </a> </br> </br> <a class="actionbtn" onclick="javascript:activated({{id}})" href="javascript:;;" >Activate</a> | <a class="actionbtn" onclick="javascript:deactivated({{id}})" href="javascript:;;" >Deactivate</a>  </br> </br></br> <a class="actionbtn" onclick="javascript:remove({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>

        </tr>
        {{/provider}}
        {{/provider_list}}
    </table>
</script>


<script type="text/html" id="provider_search_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
        {{#provider_list}}
        {{#provider}}
        <tr>

            <td width="3%">{{id}}</td>
            <td width="3%">{{country}}</td>
            <td width="5%"><img src="uploaded/provider/logo/{{provider_logo}}" width="65" height="65" /></td>
            <td width="20%">{{provider_name}}</td>
            <td width="10%">{{age_group_name}}</td>
          
            <td width="5%">{{provider_status}}</td>
            <td width="15%"></br><a class="actionbtn" onclick="javascript:preview({{id}})" href="javascript:;;" >Preview</a> | <a class="actionbtn" href="edit_provider/read/{{id}}">Edit</a> </br> </br> <a class="actionbtn" onclick="javascript:advertise({{id}})" href="javascript:;;"> Add as Advertiser </a> </br> </br> <a class="actionbtn" href=""> Deactivate </a>   |   <a class="actionbtn" href="">Upgrade </a></br> </br></br> <a class="actionbtn" onclick="javascript:remove({{id}})" href="javascript:;;" id ="" >Delete This Content </a></br></br></td>

        </tr>
        {{/provider}}
        {{/provider_list}}
    </table>
</script>

<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        
        $('#preview').dialog({
            autoOpen: false,
            width: 1300,
            height: 600
        });
        
        $.get("cms_provider/providerAll_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.providerAll_listing_tpl(data);
            $('#provider-listing').html('');
            $('#provider-listing').append(template);
            return false;
        });
        
    
        $.get("cms_provider/age_group_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.age_group_listing_tpl(data);
            $('#age-group-listing').html('');
            $('#age-group-listing').append(template);
            return false;
        });
        
        
        $.get("cms_provider/country_list", function(response) {
            var data = JSON.parse(response);
            var template = ich.country_listing_tpl(data);
            $('#country-listing').html('');
            $('#country-listing').append(template);
            return false;
        });
        
        
        
        
        $('#frmSearch').submit(function(e) {
            var keyword = $('#keyword').val();
            $.get("cms_provider/search_provider/",{keyword:keyword},function(response) {
                var data = JSON.parse(response);
                var template = ich.provider_search_listing_tpl(data);
                $('#provider-listing').html('');
                $('#provider-listing').append(template); 
                return false;    });
            e.preventDefault();
        });
    });
</script>



<script>

    function preview (provider_id) {
        //         echo ('Msg');
        $.post("cms_provider/get_provider_link", {
            provider_id: provider_id  
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

    function advertise (provider_id) {

        
            
        $.post('cms_provider/make_advertiser/'+provider_id,
        {
            provider_id: provider_id
        },
        function(data){
            var rurl = data.split(":");
            var code = rurl[0];
            var msg = rurl[1];
            if (code != 0) {
                alert('error: '+data);
            } else {
                alert(msg);
//                window.location = 'cms/cms';
                           
            }
        });
        //           window.location = 'cms_provider';   
    }
       

</script>



<script>

 function remove (provider_id) {

           $.post("cms_provider/force_delete/"+ provider_id) 
           

           alert('Provider Content Removed')             
            
           
           window.location = 'cms_provider';   
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
     var status =0;
     var country_id = $('#countries').val();
     var age_group_id = $('#age_group').val();
     var status = $('#status').val();
     if($('#search_date').val()){date = $('#search_date').val();}
     
     if($('#status').val()){type = $('#status').val();}
    
    
    
    $.get("cms_provider/provider_list/"+ country_id+"/"+ age_group_id+"/"  + status+"/" +date, function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#provider-listing').html('');
            $('#provider-listing').append(template);
            return false;
            
            
        });
            
     
 
    
}
</script>




<script>

 function deactivated (provider_id) {

           $.post("cms_provider/deactivated/"+ provider_id) 
           

           alert('Provider Deactivated')             
            
           
           window.location = 'cms_provider';   
          }
       

</script>


<script>

 function activated (provider_id) {

           $.post("cms_provider/activated/"+ provider_id) 
           

           alert('Provider Activated')             
            
           
           window.location = 'cms_provider';   
          }
       

</script>