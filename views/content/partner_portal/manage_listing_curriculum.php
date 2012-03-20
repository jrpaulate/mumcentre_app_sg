<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        
        var provider_id = $('#provider_id').val();
        var provider_name = $('#provider_name').val();
        
    
        $.get("partner_content_curriculum/curriculum_data/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.curriculum_listing_tpl(data);
            $('#articleinfo').html('');
            $('#articleinfo').append(template);
            return false;
            $('#articlecontain').html('');
            $('#articlecontain').append(event_body);
        });
        
        
        
        
          $.get("partner_content_curriculum/provider_data/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#providerinfo').html('');
            $('#providerinfo').append(template);
            return false;
            $('#providercontain').html('');
            $('#providercontain').append(provider_body);
        });
 
        
       
          $('#txtarea').keydown(function() {
          var max_limit = 231;
          var chars_left;
          var txt = $('#txtarea').val();
//          alert(txt);
          if (txt.length > max_limit){
              txt = txt.substr(0, max_limit);
              $('#txtarea').val(txt);
          }
          chars_left = max_limit - txt.length;
          $('#chars_left').html('');
          $('#chars_left').append(chars_left);
//          e.preventDefault();
          });
          
         
        
        
        
              
    

});
</script>

<table width="917" border="0" cellspacing="0" cellpadding="0" align="center">

    <tr>
    <td>

    
    <div style="height:35px; background-color:#b0daef; float:right; width: 377px; border-right: 2px solid #FFF;"></div>
    
    
    
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="partner_content_profile/read/<?php echo $id; ?>">profile </a></div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="partner_content_event/read/<?php echo $id; ?>">events</a></div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="partner_content_program/read/<?php echo $id; ?>">programs</a></div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center; height:28px; background-color:#2281b1; float:left; width: 106px; border-right: 2px solid #FFF; color:#000;"><a href="partner_content_curriculum/read/<?php echo $id; ?>">curriculum</a>
    
    
    </div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="partner_content_review/read/<?php echo $id; ?>">reviews</a></div>
    </div>
   
    <div style="height:20px; background-color:#2281b1; float:left;  width: 921px; border-right: 2px solid #FFF;"></div>
   
    
    </td>
  </tr>
 
  
 
 
   
</table>




<br />

<input type="hidden" id="provider_id" value="<?php echo $id;?>" />
<table width="917" border="0" cellspacing="0" cellpadding="0">
    

    <tr class="provider">
        <td> <div id="providerinfo"></div></td>
         <td> <div id="provider-listing"></div></td>
    </tr>
  
  <tr class="bord2">
    
   
    <td> <div id="articleinfo"></div></td>
  
    <td> <div id="curriculum-listing"></div></td>
  </tr>
 
</table>


<script type ="text/html" id="provider_listing_tpl">
 <table width="917" border="0" cellspacing="0" cellpadding="0">
   {{#provider_data}}
     {{#provider}}
     <tr class="provider">
  
   <div><span class="fontcomfortaa">Partner Listing</span> &nbsp;&nbsp;<img src="images/Header-Arrow.png"> 
   <span style="font-size: 25px; color: #2490ce;">{{provider_name}}</span> &nbsp;&nbsp;<img src="images/Header-Arrow.png"> 
   <span style="font-size: 20px; color: #2490ce;">All Curriculum</span>
   <td align ="right"><a href="partner_content_curriculum/add_curriculum/<?php echo $id; ?>"><IMG src="images/btn-curriculum.png"></a></td>
   </tr>  
   {{/provider}}
   {{/provider_data}}
</table>
</script>

<script type="text/html" id="curriculum_listing_tpl">
    <table width="917" border="0" cellspacing="0" cellpadding="0">
       
        
   
        </br>
        
        <tr></tr>
       
        {{#curriculum_data}}

        <tr class="bord">
            <td width="70px"><span class="fontblue" style="font-size: 18px;">Id</td>
            <td width="150px"><span class="fontblue" style="font-size: 18px;">Image</td>
            <td width="150px"><span class="fontblue" style="font-size: 18px;">Age Group</td>
            <td width="200px"><span class="fontblue" style="font-size: 18px;">Title</td>
            <td width="100px"><span class="fontblue" style="font-size: 18px;">Status</td>
            <td width="100px"><span class="fontblue" style="font-size: 18px;">Preview</td>
            <td width="100px"><span class="fontblue" style="font-size: 18px;">Edit</td>
           
        </tr>
        
 
         {{#curriculum}}
       <tr class="bord2">
            
            <td ><span color="#ccc;"> {{id}} </td>
            <td ><a href=""><IMG src="uploaded/provider/curriculum/image/{{curriculum_image}}" width="80px" height="70px"></a></td>
            <td ><span color="#ccc;"> {{age_group_name}}</td>
            <td ><span color="#ccc;"> {{curriculum_title}} </td>
            <td ><span color="#ccc;"> {{curriculum_status}} </td>
            
           
            <td><img src="images/views.png"></td>
            <td><img src="images/edit.png"></td>
 
       
        </tr>
        
  
        {{/curriculum}}
        {{/curriculum_data}}
    </table>
</script>


