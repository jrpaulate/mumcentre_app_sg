<input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id');?>"/>


<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<script type="text/javascript">
    $(document).ready(function(){
        var user_id = $('#user_id').val();
        $('#change_pass_modal').dialog({
            autoOpen: false,
            width: 400,
            title: 'Change Password'
        });
        
        $.get("user/profile_data/"+user_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.profile_listing_tpl(data);
            $('#profile-listing').html('');
            $('#profile-listing').append(template);
            
            $('#change').click(function(e){
            $('#change_pass_modal').dialog('open');
            e.preventDefault();  
            });
            
            
            $.get("user/profile_data/"+user_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.profileImage_listing_tpl(data);
            $('#profileImage-listing').html('');
            $('#profileImage-listing').append(template);
            return false;
            });
            
        
      
   
        
        
        
        
       
        
            $('#submit_pass').click(function(e){
                var new_pass = $('#new_pass').val();
                var confirm_new_pass = $('#confirm_new_pass').val();
                if (new_pass.length == 0){
                    alert('Please enter new password');
                } 
                else if (confirm_new_pass != new_pass){
                    alert('Passwords don\'t match!');
                }
                else {
//                         alert('Password changed.');
                    $.post('user/change_pass',
                    {
                        new_pass: new_pass,
                        user_id: user_id
                    },
                    function(data){
                        alert(data);
                    });
                }
                e.preventDefault(); 
            });
            return false;
        });
        
        
        
         $('#hotbox_modal').dialog({
            autoOpen: false,
            width: 460,
            height: 575
            
            
        });
        
        
     
        $.get("user/user_alerts_check/"+user_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.hidden_listing_tpl(data);
            $('#hidden-listing').html('');
            $('#hidden-listing').append(template);
            
            if ($('#has_article').val() == 1){
                $('#article_checkbox').attr('checked','checked');
                $.get("user/load_alerts/1", function(response) {
                var data = JSON.parse(response);
                var template = ich.alerts_listing_tpl(data);
                $('#alerts-listing').append(template);
                return false;
                 });
            }
            if ($('#has_events').val() == 1){
                $('#events_checkbox').attr('checked','checked');
                $.get("user/load_alerts/2", function(response) {
                var data = JSON.parse(response);
                var template = ich.alerts_listing_tpl(data);
                $('#alerts-listing').append(template);
                return false;
                 });
            }
            
            if ($('#has_curriculum').val() == 1){
                $('#curriculum_checkbox').attr('checked','checked');
                $.get("user/load_alerts/3", function(response) {
                var data = JSON.parse(response);
                var template = ich.alerts_listing_tpl(data);
                $('#alerts-listing').append(template);
                return false;
                 });
            }
            
            if ($('#has_reviews').val() == 1){
                $('#review_checkbox').attr('checked','checked');
                $.get("user/load_alerts/4", function(response) {
                var data = JSON.parse(response);
                var template = ich.alerts_listing_tpl(data);
                $('#alerts-listing').append(template);
                return false;
                 });
            }
            
            if ($('#has_programs').val() == 1){
                $('#program_checkbox').attr('checked','checked');
                $.get("user/load_alerts/5", function(response) {
                var data = JSON.parse(response);
                var template = ich.alerts_listing_tpl(data);
                $('#alerts-listing').append(template);
                return false;
                 });
            }
            
            if ($('#has_products').val() == 1){
                $('#provider_checkbox').attr('checked','checked');
                $.get("user/load_alerts/6", function(response) {
                var data = JSON.parse(response);
                var template = ich.alerts_listing_tpl(data);
                $('#alerts-listing').append(template);
                return false;
                 });
            }    
        
        
        });

    });
</script>


<div id="change_pass_modal" style="display: none">
    <table width="100%" cellpadding="5">
        <tr>
            <td width="100">New Password : </td>
            <td><input type="password" id="new_pass" name="new_pass" style="width:100%;border:1px solid #abadb3;line-height:18px;" /></td>
        </tr>
        <tr>
            <td>Confirm New Password : </td>
            <td><input type="password" id="confirm_new_pass" name="confirm_new_pass" style="width:100%;border:1px solid #abadb3;line-height:18px;" /></td>
        </tr>
        <tr>
            <td colspan="2"><a href="javascript:void(0);" id="submit_pass" class="btn-rnd fright view-link"><small>SUBMIT</small></a></td>
        </tr>
    </table>
</div>

<div id="body2com"><!-- end Head-cont -->
    <div id="profile"></div>
    <input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id');?>"/>
</div><!-- end body2com -->




<div class="wrap">

<div style="">
<span class="title-1">My Profile</span> &nbsp; <img src="images/Header-Arrow.png"> &nbsp;&nbsp;<span class="sub-title">Alerts and Subscriptions</span>
<div style="border-bottom: 2px solid #3399cc; width: 660px;"></div>
<table width="660" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="242" valign="top">
    <div class="profile-image" id="profileImage-listing"></div>
    <div style="padding-top: 30px; border-bottom: 1px solid #cecece; width: 242px;"></div>
    <div class="menu">
     <table width="242" border="0">
      <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'" bgcolor="#f0ecef">
         <td valign="middle" height="25">
              
              
        <a href="user/profile" style="border:none; text-decoration:none;">
        <span class="menu-font">Profile</span>
        </a>
        </td>
      </tr>
       <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
        
        <td valign="middle" height="25">
        <a href="user/profile_alerts" style="border:none; text-decoration:none;">
        <span class="menu-font">My Alerts and Subscriptions</span>
        </td>
      </tr>
       <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
        <td valign="middle" height="25">
        <a href="user/profile_pow" style="border:none; text-decoration:none;">       
        <span class="menu-font">Pic of the Week Activity</span>
        </td>
      </tr>
       <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'" >
        <td valign="middle" height="25">
        <a href="user/profile_forums" style="border:none; text-decoration:none;">
        <span class="menu-font">Forum Threads and Replies</span>
        </a>
        </td>
      </tr>
       <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
        <td valign="middle" height="25">
        <a href="Subscriptions.html" style="border:none; text-decoration:none;">
        <span class="menu-font">Groups</span>
        </a>
        </td>
      </tr>
       <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
        <td valign="middle" height="25">
        <a href="user/profile_children" style="border:none; text-decoration:none;"> 
        <span class="menu-font">My Children</span>
        </td>
      </tr>
       <tr onMouseOver="this.style.backgroundColor='#f0ecef'"; onMouseOut="this.style.backgroundColor='transparent'">
        <td valign="middle" height="25">
        
        <a href="#" id="change" name="change" style="border:none; text-decoration:none;">
        <span class="menu-font">Change Password</span>
        </a>
        </td>
      </tr>
    </table>
    </div>
    </td>
    <td width="418" style="border-left: 1px solid #cecece;" valign="top">
    <div class="side-content">
    <div class="Profile-account-name" id="profile-listing"></div>
    <div style="border-bottom: 1px dotted #59366c; width: 406px;"></div>
    <div class="recent-alerts">Recent Alerts </div>
    <div style="border-bottom: 1px dotted #59366c; width: 406px; padding-top: 12px;"></div>
    <img src="images/pagination.jpg">
    <div class="alerts">
        <div id="alerts-listing"> </div>
    </div>
    <div class="alert-schedule">Alert Schedule: Everyday  <a href="#" style="text-decoration:none; border: none; color: #39c;">(Edit)</a></div>
    
    <div class="subscriptions">
    <div class="recent-alerts">My Subscriptions <div class="edit-profile">Edit</div></div>
    <div style="border-bottom: 1px dotted #59366c; width: 406px; padding-top: 12px;"></div>
    
    <div class="subscr-menu">
    <ul class="subscr-style">
    <li><div class="dib-list" ><form>
        <input type="checkbox" name="12" id="article_checkbox"/>
      </form>Articles</div></li>
    <li><div class="dib-list"><span style="color: #59366c; font-weight:bold;">Programs</span></div></li>
    <li><div class="dib-list"><span style="color: #59366c; font-weight:bold;">Reviews</span></div></li>
    <li><div class="dib-list"><span style="color: #59366c; font-weight:bold;">Curriculum</span></div></li>
    <li><div class="dib-list"><span style="color: #59366c; font-weight:bold;">Events</span></div></li>
    <li><div class="dib-list2"><span style="color: #59366c; font-weight:bold;">Product and Services Providers</span></div></li>
    </ul>
    </div>
    </div>
    </div>
    </td>
  </tr>
</table>

</div>

</div>



<div id="sidebar2">
    <div id="c3spacer"></div>
    <?= render_partial('global/observer/sidebar'); ?>
    <!-- end .container --></div>
<?= render_partial('global/default_footer'); ?>
    




<script type="text/html" id="alerts_listing_tpl">
    <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
            {{#load_alerts}}
           
             <ul>
                  {{#alerts}}
                 <li> <img src="assets/img/system/L2.png"> &nbsp; &nbsp; <a href="{{alert_url}}" id="">{{alert_title}}</a> </li>
                 <li>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; {{alert_summary}} </li>
                 
                 </br> </br>
           
            {{/alerts}}
            </ul>  
          {{/load_alerts}}
        </table>
</script>

<script type="text/html" id="hidden_listing_tpl">
{{#user_alerts}}  
{{#alerts}}
<input type="hidden" id="has_article" value="{{has_article}}"/>
<input type="hidden" id="has_events" value="{{has_events}}"/>
<input type="hidden" id="has_curriculum" value="{{has_curriculum}}"/>
<input type="hidden" id="has_reviews" value="{{has_reviews}}"/>
<input type="hidden" id="has_programs" value="{{has_programs}}"/>
<input type="hidden" id="has_products" value="{{has_products}}"/>
<input type="hidden" id="has_forums" value="{{has_forums}}"/>
<input type="hidden" id="week_day" value="{{week_day}}"/>
{{/alerts}}
{{/user_alerts}}
</script>      
<link rel="stylesheet" type="text/css" href="mystyle.css">







<script type="text/html" id="profile_listing_tpl">
{{#profile_data}}
{{#profile}}
   
    <div class="Profile-account-name">{{first_name}} {{last_name}}</div>
   
 
{{/profile}} 
{{/profile_data}}   
</script> 


<script type="text/html" id="profileImage_listing_tpl">
{{#profile_data}}
{{#profile}}
   
    <div class="profile-image"><img src="{{avatar_filepath}}"></div>
    
    
{{/profile}} 
{{/profile_data}}   
</script> 
