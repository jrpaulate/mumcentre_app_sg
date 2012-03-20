<input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id');?>"/>


<div id="sidebar2">
    <div id="c3spacer"></div>
    <?= render_partial('global/observer/sidebar'); ?>
    <!-- end .container --></div>

    
<div style="width: 356px; height: 446px; background: #ddf3fe;">

<div style="padding-left: 20px; padding-right: 20px; padding-top: 23px;">
     <div class="edit-profile"><img src="images/my profile img/close-btn.png"></div>
    <br /> <br /> <br />
    <table width="285" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="75" valign="middle"><span style="font-size:14px; color:#59366c;">Title:</span></td>
    <td width="211" valign="top">
    <input type="text" class="profile-a alerts-textbox5" name="tb1"  value="My baby's 1st month"/>
    </td>
  </tr>
  <tr><td colspan="2" height="12"></td></tr>
  <tr>
    <td width="75" valign="middle"><span style="font-size:14px; color:#59366c;">Brithday:</span></td>
    <td width="211" valign="top"><input type="text" class="profile-a alerts-textbox5" name="tb1"  value="August 12 2012"/></td>
  </tr>
  <tr><td colspan="2" height="12"></td></tr>
  <tr>
    <td width="75" valign="middle"><span style="font-size:14px; color:#59366c;">Gender:</span></td>
    <td width="211" valign="top"><select name="list1" class="alerts-textbox2 profile-a"><option>Male</option><option>Female</option></select></td>
  </tr>
  <tr><td colspan="2" height="12"></td></tr>
  <tr>
    <td width="75" valign="top"></td>
    <td width="211" valign="top"><img src="images/my profile img/child-pic-3.png">
    <br /> <br />
    <div style="float:left"><img src="images/my profile img/browse.png"></div>
    <div style="float:left; padding-left: 15px;"><img src="images/my profile img/UPLOAD.png"></div>
    </td>
  </tr>
   <tr><td colspan="2" height="12"></td></tr>
  <tr>
    <td width="75" valign="top"></td>
    <td width="211" valign="top"><div style="font-size: 21px; font-weight:bold; color: #39c">SAVE</div></td>
  </tr>
</table>


 </div>
 
</div>
 
 
 
 

    
<script type="text/html" id="child_listing_tpl">
 {{#child_data}}
   {{#child}}
   
   
  <tr>
    <td valign="top">
    <div style="width: 408px;">
   
    <div class="number-child">First Child</div>
    <div class="child-pic">
    <img src="uploaded/user/avatar/{{avatar_filepath}}">
    </div>
    <div class="child-info">
    <span class="child-name">{{name}} </span>
    <br />
    <span class="child-name2"> {{birth_date}}</span>
    <br />
    <span class="child-name2"> {{gender}}</span>
    </div>
    <div class="child-edit"><span style="color: #39c"> 
    <a href="#" style="text-decoration: none; color: #39c;">Edit</a> | 
    <a href="#" style="text-decoration: none; color: #39c;">Delete </a>
    </span></div>
    </div>
    </td>
 </tr>

  {{/child}} 
{{/child_data}}   
</script>

<?= render_partial('global/default_footer'); ?>




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
   
    <div class="profile-image"><img src="uploaded/user/avatar/{{avatar_filepath}}"></div>
    
    
{{/profile}} 
{{/profile_data}}   
</script> 

<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<script type="text/javascript">
    $(document).ready(function(){
        var user_id = $('#user_id').val();
        
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
            
        
        
        $.get("user/child_data/"+user_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.child_listing_tpl(data);
            $('#child-listing').html('');
            $('#child-listing').append(template);
            return false;
        });
        
        
        
        
        $('#change_pass_modal').dialog({
            autoOpen: false,
            width: 400,
            title: 'Change Password'
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
        
        
        

    });
</script>

