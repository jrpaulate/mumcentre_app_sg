<div id="body2com"><!-- end Head-cont -->
    <div id="profile"></div>
    <input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id');?>"/>
</div><!-- end body2com -->
<div id="sidebar2">
    <div id="c3spacer"></div>
    <?= render_partial('global/observer/sidebar'); ?>
    <!-- end .container --></div>
<?= render_partial('global/default_footer'); ?>

<div id="change_pass_modal">
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
<script type="text/html" id="profile_listing_tpl">
{{#profile_data}}
{{#profile}}
<div class="wrap">

<div style="Title">
<span class="title-1">My Profile</span> &nbsp; <img src="images/Header-Arrow.png"> &nbsp;&nbsp;<span class="sub-title">Profile</span>
<div style="border-bottom: 2px solid #3399cc; width: 660px;"></div>


<table width="660" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="222" valign="top">
    <div class="profile-image"><img src="uploaded/user/avatar/{{avatar_filepath}}" width="212px" height="230px"></div>
    <div style="padding-top: 30px; border-bottom: 1px solid #cecece; width: 222px;"></div>
    <div class="menu">
    <table width="222" border="0">
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
    <div class="Profile-account-name">{{first_name}} {{last_name}} </div>
    <div style="border-bottom: 1px dotted #59366c; width: 406px;"></div>
  
      <br />
      <div style="float:right; padding-right:12px;">
      <span style="font-family:Arial, Helvetica, sans-serif; font-size: 12px; color:#55a6de;"><a href="user/profile_edit">Edit Profile</a></span>
      </div> <br /> <br />
      <table width="406" border="0">
  <tr>
    <td width="170" valign="top" align="left">
    <span class="profile-q">
    Birthday:
    </span></td>
    <td width="245" valign="top" align="left">
    <span class="profile-a">
        {{birth_date}} 
    </span></td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
  <tr>
    <td width="170" valign="top" align="left">
    <span class="profile-q">
    Gender:
    </span></td>
    <td width="245" valign="top" align="left">
    <table width="134" border="0">
  <tr>
    <td width="47" valign="top"> 
    <span  class="profile-a">
    {{gender}}
    </span>
    </td>
    <td width="77">
    
    </td>
  </tr>
</table>
    </span></td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
 <tr>
    <td width="170" valign="top" align="left">
    <span class="profile-q">
    Current Location:
    </span></td>
    <td width="245" valign="top" align="left">
    <span  class="profile-a">
   {{location}}
    </span>

    </td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
  <tr>
    <td width="170" valign="top" align="left">
    <span class="profile-q">
    Country:
    </span></td>
    <td width="245" valign="top" align="left">
    <span  class="profile-a">
    {{country}}
    </span>

    </td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
   <tr>
    <td width="170" valign="top" align="left">
    <span class="profile-q">
    Contact Number:
    </span></td>
    <td width="245" valign="top" align="left">
    <span  class="profile-a">
    {{celphone}}
    </span>
    </td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
   <tr>
    <td width="170" valign="top" align="left">
    <span class="profile-q">
    Landline:
    </span></td>
    <td width="245" valign="top" align="left">
    <span  class="profile-a">
    {{landline}}
    </span>

    </td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
   <tr>
    <td width="170" valign="top" align="left">
    <span class="profile-q">
    Email:
    </span></td>
    <td width="245" valign="top" align="left">
    <span  class="profile-a">
    {{email_address}}
    </span>

    </td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
   <tr>
    <td width="170" valign="top" align="left">
    <span class="profile-q">
    Hobbies:
    </span></td>
    <td width="245" valign="top" align="left">
    <span  class="profile-a">
    {{hobbies}}
    </span>

    </td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
   <tr>
    <td width="170" valign="top" align="left">
    <span class="profile-q">
    Biography:
    </span></td>
    <td width="245" valign="top" align="left">
    <span  class="profile-a">
    {{{biography}}
    </span>

    </td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
   <tr>
    <td width="170" valign="top" align="left">
    <span class="profile-q">
    Occupation:
    </span></td>
    <td width="245" valign="top" align="left">
    <span class="profile-a">
    {{occupation}}
    </span>

    </td>
  </tr> 
</table>

      <br />  <div style="float:right; padding-right: 12px;">
     
      </div><br /> <br />
      </div>
        
    </div>
    </td>
  </tr>
</table>

</div>

</div>
{{/profile}} 
{{/profile_data}}   
</script>
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<script type="text/javascript">
    $(document).ready(function(){
        $('#change_pass_modal').dialog({
            autoOpen: false,
            width: 400,
            title: 'Change Password'
        });
        var user_id = $('#user_id').val();
        $.get("user/profile_data/"+user_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.profile_listing_tpl(data);
            $('#profile').html('');
            $('#profile').append(template);
            
            $('#change').click(function(e){
            $('#change_pass_modal').dialog('open');
            e.preventDefault();  
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

