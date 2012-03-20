<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        
        $.get("partner_user_account/user_list/", function(response) {
            var data = JSON.parse(response);
            var template = ich.user_listing_tpl(data);
            $('#user-listing').html('');
            $('#user-listing').append(template);
            return false;
        });
    });
</script>




<div style="width:917px; margin:0 auto;">
<table width="917" border="0" cellspacing="0" cellpadding="0" align="center">
   <br />
    <tr>

     <td>
   
    <br />
     <br />
     <td align ="left"><div><span class="fontcomfortaa">Partner Listing</span> &nbsp;&nbsp;<img src="images/Header-Arrow.png"> 
     <span style="font-size: 25px; color: #2490ce;">All Users</span></td>
     <td align="right"><a href="partner/add_user_account"><IMG src="images/btn-user.png"></a></td>
   
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
     
      <td><div id="user-listing"></div></td>

     </tr>
   
   
 </table>
 
 

</div>


<script type="text/html" id="user_listing_tpl">
    <table width="917" border="0" cellspacing="0" cellpadding="0">
        {{#user_list}}
    
        
        
         <tr class="bord">
            <td width="70px"><span class="fontblue" style="font-size: 14px;">Id</td>
            <td width="120px"><span class="fontblue" style="font-size: 14px;">Image</td>
            <td width="200px"><span class="fontblue" style="font-size: 14px;">Name</td>
            <td width="200px"><span class="fontblue" style="font-size: 14px;">Email Address</td>
            <td width="110px"><span class="fontblue" style="font-size: 14px;">Access Content</td>
            <td width="50px"><span class="fontblue" style="font-size: 14px;">Preview</td>
            <td width="50px"><span class="fontblue" style="font-size: 14px;">Edit</td>
            <td width="50px"><span class="fontblue" style="font-size: 14px;">Delete</td>
        </tr>
        
       {{#user}}
       <tr class="bord2">
           
           <td><span style="font-size: 14px" color="#ccc;">{{id}}</td>
           <td ><a href=""><IMG src="uploaded/user/avatar/{{avatar}}" width="80px" height="70px"></a></td>
           <td><span style="font-size: 14px" color="#ccc;">{{first_name}} {{last_name}}</td>
           <td><span style="font-size: 14px" color="#ccc;">{{email_address}}</td>
           <td><span style="font-size: 14px" color="#ccc;">{{provider_name}}</td>
            <td><img src="images/views.png"></td>
            <td><img src="images/edit.png"></td>
            <td><img src="images/delete.png"></td>

        </tr>
        {{/user}}
        {{/user_list}}
    </table>
</script>


