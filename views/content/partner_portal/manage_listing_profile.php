<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        
        var provider_id = $('#provider_id').val();
       
        
    
        $.get("partner_content_profile/provider_data/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#articleinfo').html('');
            $('#articleinfo').append(template);
            
            var html_data = $('#provider_details').text();
                $('#provider_details').text('');
                $('#provider_details').html(html_data);
            
            return false;
            $('#articlecontain').html('');
            $('#articlecontain').append(provider_body);
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
    <div style="padding-top: 7px; text-align: center; height:28px; background-color:#2281b1; float:left; width: 106px; border-right: 2px solid #FFF; color:#000;"><a href="partner_content_profile/read/<?php echo $id; ?>">Profile </a></div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="partner_content_event/read/<?php echo $id; ?>">Events</a></div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="partner_content_program/read/<?php echo $id; ?>">Programs</a></div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="partner_content_curriculum/read/<?php echo $id; ?>">Curriculum</a>
    
    
    </div>
    </div>
    <div class="submenu">
    <div style="padding-top: 7px; text-align: center;"><a href="partner_content_review/read/<?php echo $id; ?>">Reviews</a></div>
    </div>
   
    <div style="height:20px; background-color:#2281b1; float:left;  width: 921px; border-right: 2px solid #FFF;"></div>
   
    
    </td>
  </tr>
  
</table>







<br />
<input type="hidden" id="provider_id" value="<?php echo $id;?>" />
<table width="917" border="0" cellspacing="0" cellpadding="0">
    
  
    <tr><td align="right"><a href="partner_content_event/add_event/<?php echo $id; ?>"><IMG src="images/btn-event.png"></a></td>
 </tr>
  
   <tr>
    <td> <div id="articleinfo">
            
            
        </div></td>
    
    <td> <div id="provider-listing"></div></td>
  </tr>
 
</table>






<script type="text/html" id="provider_listing_tpl">
<table width="917" border="0" cellspacing="0" cellpadding="0">
        {{#provider_data}}
        {{#provider}}
        
  <tr class="provider">
  
   <div style="border-bottom: 2px solid #2490ce; width: 917px;"><span class="fontcomfortaa">Partner Listing</span> &nbsp;&nbsp;<img src="images/Header-Arrow.png"> 
   <span style="font-size: 25px; color: #2490ce;">Provider Profile</span>
   <span style="font-size: 25px; color: #2490ce;">
   </span>
  </div>
  
  
   </tr>
        
 
   </br>
   
    <tr>
    <td width="309" valign="top">
   <a href=""><img src="uploaded/provider/image/{{provider_image}}"></a>
    </td>
    <td width="18">&nbsp;</td>
    <td width="608" valign="top">
    <div style="line-height:29px;">
    <span style="font-size: 24px; color: #2490ce;"> {{provider_name}}</span>
    <br />
    {{provider_location}} <br /> Tel no. : 6475 7688
    <br />
    <span style="color:#60296c;"> {{provider_email}} </span>
    <br/>
    <span style="color:#60296c;">info@artzgraine.com.sg</span>
    <br /> 
     <a href=""><img src="uploaded/provider/logo/{{provider_logo}}"></a>
    </div>
    </td>
  </tr>
</table>
<br />
<div style="border-bottom: 1px dotted #666;"></div>
<br />
<span style="font-size: 24px; color: #2490ce;">Provider Details</span>
<br />
<div id="provider_details" align="justify" style="line-height: 29px;">
<span style="color: #2490ce;"> {{provider_details}} </br> </span>
    
    

</div>
<!--------------------------------------------------------------------------------------------->
<br />
<span style="font-size: 24px; color: #2490ce;">Location</span>
<br />
<div>
<img src="images/big-map.png">
</div>
        
        
        
    
  
        {{/provider}}
        {{/provider_data}}
    </table>
</script>

