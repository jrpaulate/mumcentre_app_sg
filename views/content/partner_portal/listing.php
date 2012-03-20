


<input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id'); ?>" />

<div style="width:917px; margin:0 auto;">
<table width="917" border="0" cellspacing="0" cellpadding="0" align="center">
   <br />
    <tr>

     <td>
   
    <br />
     <br />
     <td align ="left"><div><span class="fontcomfortaa">Partner Listing</span> &nbsp;&nbsp;<img src="images/Header-Arrow.png"> 
     <span style="font-size: 25px; color: #2490ce;">All Listing</span></td>
     <td align="right"><a href="partner/add_listing"><IMG src="images/add-listing.png"></a></td>
   
  </td>
  </tr>
  <tr>
    <td colspan="3">
    <div style="height:20px; background-color:#2281b1; float:left;  width: 921px; border-right: 2px solid #FFF;"></div>
   
    </td>
  </tr>
</table>

 <br />

 
 <table width="917" border="0" cellspacing="0" cellpadding="0"> 
      
     <tr>
     
      <td><div id="provider-listing"></div></td>

     </tr>
   
   
 </table>
 

</div>
         
         


<script type="text/html" id="provider_listing_tpl">
    <table width="917" border="0" cellspacing="0" cellpadding="0">
        {{#provider_list}}
        
        <tr class="bord">
            
            <td width="100px"><span class="fontblue" style="font-size: 14px;">Image</td>
            <td width="200px"><span class="fontblue" style="font-size: 14px;">Listing Name</td>
            <td width="50px"><span class="fontblue" style="font-size: 14px;"></td>
            <td width="40px"><span class="fontblue" style="font-size: 14px;"></td>
            <td width="40px"><span class="fontblue" style="font-size: 14px;">Preview</td>
            <td width="40px"><span class="fontblue" style="font-size: 14px;">Delete</td>
        </tr>
        
        
        
        {{#provider}}
       <tr class="bord2">

            <td><img src="uploaded/provider/image/{{provider_image}}" width="65" height="65" /></td>
            <td><span style="font-size: 14px" color="#ccc;">{{provider_name}}</td>
            <td><a href=""><IMG src="images/add-btn3.png"></a></td>
            <td><a href="partner_content_profile/read/{{id}}"><img src="images/add-btn4.png"><a></td>
            <td><img src="images/views.png"></td>
            <td><img src="images/delete.png"></td>

        </tr>
        {{/provider}}
        {{/provider_list}}
    </table>
</script>


<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        var user_id = $('#user_id').val();
        
        $.get("partner_content_listing/provider_list/"+ user_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#provider-listing').html('');
            $('#provider-listing').append(template);
            return false;
        });
    });
</script>