
<div id="content" style="background-color: #fff;  ">
   
  


<div id="main" style="margin:0 auto; background-color: #fff;">

 <ul class="ulsubnav">   
 <div style="border-top: 2px solid #2490ce; width: 1170px; margin:0px 90px; "></div>  
     </br>
 <span style="font-family:Comfortaa; font-size: 48px; color: #2490ce; width:800px; margin:0px 90px;"><?php echo $this->session->userdata('name');?>'s CMS Dashboard</span>
 <div style="border-bottom: 2px solid #2490ce; width: 1170px; margin:0px 90px; "></div> 
 </ul>
 

   
<div id="avatar" style="float:left;  border-right: 1px solid #bfbfbf;  width:20px;  background-color: #fff;  margin:0px 200px;  ">
<tr>   
<td> <img src="uploaded/user/avatar/<?php echo $this->session->userdata('avatar');?>" width="210px" height="200px"> </td>   
</tr>
</div>


    
<div style="float:left; width:720px; height:980px;  background-color:#fff ;">
       <div class="tableholder">

 	<table class="datatable" width="710px" height="40px" cellpadding="0" cellspacing="0" border="0">
        	<tr>
            	<td width="100%">Recent Activity</td>
            
        	</tr> 
                
		</table>

        <div id="alerts-listing"></div>

       </div>

</div>

</div>
 
</div>
    


<script type="text/html" id="alerts_listing_tpl">
    <table id="myTable" class="datatable" width="680px" cellpadding="0" cellspacing="0" border="0" >
            {{#alerts_list}}
            {{#alerts}}
        	<tr>
                    
       
        	  <td width="80%">{{content_title}}</td>
         
     
        	
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


