<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
         var provider_id = $('#provider_id').val();
        
        
        $.get("partner_my_alerts/alert_list/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.alert_listing_tpl(data);
            $('#alert-listing').html('');
            $('#alert-listing').append(template);
            return false;
        });
    });
</script>

<input type="hidden" id="provider_id" value="<?php echo $this->session->userdata('provider_id'); ?>" />


<div style="width:917px; margin:0 auto;">
<table width="917" border="0" cellspacing="0" cellpadding="0" align="center">
   <br />
    <tr>

     <td>
   
    <br />
     <br />
     <td align ="left"><div><span class="fontcomfortaa">Partner Listing</span> &nbsp;&nbsp;<img src="images/Header-Arrow.png"> 
     <span style="font-size: 25px; color: #2490ce;">My Alerts</span></td>

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
     
      <td><div id="alert-listing"></div></td>

     </tr>
   
   
 </table>
 
 

</div>


<script type="text/html" id="alert_listing_tpl">
    <table width="917" border="0" cellspacing="0" cellpadding="0">
        {{#alert_list}}
    
        
        
         <tr class="bord">
            <td width="10px"><span class="fontblue" style="font-size: 14px;">Id</td>
            <td width="200px"><span class="fontblue" style="font-size: 14px;">Message</td>
            
         
            <td width="50px"><span class="fontblue" style="font-size: 14px;">Delete</td>
        </tr>
        
       {{#alert}}
       <tr class="bord2">
           
           <td><span style="font-size: 14px" color="#ccc;">{{id}}</td>
           <td><span style="font-size: 14px" color="#ccc;">{{message}}</td>
          
          
            <td><img src="images/delete.png"></td>

        </tr>
        {{/alert}}
        {{/alert_list}}
    </table>
</script>


