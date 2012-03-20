<link rel="stylesheet" type="text/css" href="css/jquery.imgareaselect/imgareaselect-default.css" />
<script type="text/javascript" src="js/ajaxupload.js"></script>
<script type="text/javascript" src="js/jquery.imgareaselect.pack.js"></script>
<div id="body2com"><!-- end Head-cont -->
    <div id="profile"></div>
    <input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id');?>"/>
    <input type="hidden" id="img-x1" name="img-x1" />
            <input type="hidden" id="img-x2" name="img-x2" />
            <input type="hidden" id="img-y1" name="img-y1" />
            <input type="hidden" id="img-y2" name="img-y2" />
            <input type="hidden" id="img-wd" name="img-wd" />
            <input type="hidden" id="img-ht" name="img-ht" />
</div><!-- end body2com -->
<div id="sidebar2">
    <div id="c3spacer"></div>
    <?= render_partial('global/observer/sidebar'); ?>
    <!-- end .container --></div>
<?= render_partial('global/default_footer'); ?>
<div id="cropping_modal" style="width: auto; height: auto;">
    <img id="avatar_crop"/>
    <p><a href="#" id="crop_button">Done cropping</a></p>
</div>
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
    <div class="profile-image"><img src="uploaded/user/avatar/{{avatar_filepath}}"></div>
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
  
      <br /><br /> 
      <br />
      <table width="406" border="0">
          
 
  <tr>
    <td width="170" valign="middle" align="left">
    <span class="profile-q">
    Birthday:
    </span></td>
    <td width="245" valign="top" align="left">
    <input type="text" class="profile-a alerts-textbox" name="tb1" id="birth_date"  value="{{{birth_date}} "/>
    </td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
  <tr>
    <td width="170" valign="middle" align="left">
    <span class="profile-q">
    Gender:
    </span></td>
    <td width="245" valign="top" align="left">
    <table width="134" border="0">
  <tr>
    <td width="47" valign="middle"> 
    <select name="list1" id="gender" class="alerts-textbox2 profile-a">
    
                                <option value="1">Female</option>
                                <option value="2">Male</option>
                               
       </select>
        <input type="hidden" value="{{gender_number}}" id="gender_number" /> 
    </td>
    <td width="77">
    
    </td>
  </tr>
</table>
    </span></td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
 <tr>
    <td width="170" valign="middle" align="left">
    <span class="profile-q">
    Current Location:
    </span></td>
    <td width="245" valign="top" align="left">
    <input type="text" class="profile-a alerts-textbox" name="tb1" id="location"  value="{{{location}}}"/>
   </td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
  

  <tr>
    <td width="170" valign="middle" align="left">
    <span class="profile-q">
    Country:
    </span></td>
    <td width="245" valign="top" align="">
    <input type="text" class="profile-a alerts-textbox" name="tb1" id="country"  value="{{country}}"/>
    </td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
   <tr>
    <td width="170" valign="middle" align="left">
    <span class="profile-q">
    Contact Number:
    </span></td>
    <td width="245" valign="middle" align="left">
    <input type="text" class="profile-a alerts-textbox" name="tb1" id="celphone"  value="{{celphone}}"/>
    </td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
   <tr>
    <td width="170" valign="middle" align="left">
    <span class="profile-q">
    Landline:
    </span></td>
    <td width="245" valign="middle" align="left">
    <input type="text" class="profile-a alerts-textbox" name="tb1" id="landline"  value="{{landline}}"/>

    </td>
  </tr>
  
  <tr><td height="5"></td><td height="5"></td></tr>
   <tr>
    <td width="170" valign="middle" align="left">
    <span class="profile-q">
    Hobbies:
    </span></td>
    <td width="245" valign="top" align="left">
    <input type="text" class="profile-a alerts-textbox" name="tb1" id="hobbies" value="{{hobbies}}"/>
    </td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
   <tr>
    <td width="170" valign="middle" align="left">
    <span class="profile-q">
    Biography:
    </span></td>
    <td width="245" valign="top" align="left">
    <textarea id="biography" class="profile-a alerts-textbox4">
     {{biography}}
    </textarea>
 </td>
  </tr>
  <tr><td height="5"></td><td height="5"></td></tr>
   <tr>
    <td width="170" valign="middle" align="left">
    <span class="profile-q">
    Occupation:
    </span></td>
    <td width="245" valign="top" align="left">
    <input type="text" class="profile-a alerts-textbox" name="tb1" id="occupation" value="{{occupation}}"/>
    </td>
  </tr> 
  <tr><td height="5"></td><td height="5"></td></tr>
   <tr>
    <td width="170" valign="middle" align="left">
    <span class="profile-q">
    Edit Avatar:
    </span></td>
    <td width="245" valign="top" align="left">
    <img id="avatar" value="uploaded/user/avatar/{{avatar_filepath}}" src="uploaded/user/avatar/{{avatar_filepath}}"  style="width: 255px; height: 255px;"/>
    <br /> <br />
    <div id="uploadContainer">
    <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
    <a href="javascript:$('#upload').uploadifyUpload();">
    <?= img('system/btn_upload.png'); ?>
                                </a>
                            </div></dd>
                        <div id="fileQueue"></div>
                        <br />
    <input type="hidden" id="hidden_avatar" value="{{avatar_filepath}}"/>

    </td>
  </tr>  
</table>
<br /> <br />

<div style="float:right; padding-left: 12px; font-size: 21px; font-weight:bold; color: #39c;"><a href="<?php echo base_url(); ?>user/profile" id="" class="cssanchor">CANCEL</a></div> 
<div style="float:right;  font-size: 21px; font-weight:bold; color: #39c;" class="cssanchor"><a href="#" id="edit_profile" class="cssanchor">SAVE</a></div> 
      <br /><br /> 
      <br />
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
        $('#cropping_modal').dialog({
            autoOpen: false,
            resizable: false,
            modal: true,
            width: 'auto',
            position: 'center',
            close: function(event, ui){
                $('#avatar_crop').imgAreaSelect({remove: true});
            } 
        });
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
            $('#gender').val($('#gender_number').val());
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
            
            $("#upload").uploadify({
            'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : '/js/uploadify/uploadify.php',
            'cancelImg'     : '/js/uploadify/cancel.png',
            'folder'        : '/uploaded/user/avatar',
            'buttonImg'     : 'assets/img/system/btn_browse.png',
            'wmode'         : 'transparent',
            'width'         : 83,
            'height'        : 25,
            'queueID'       : 'fileQueue',
            'scriptAccess'  : 'always',
            'fileDesc'      : 'Image Files',
            'fileExt'       : '*.jpg;*.jpeg;*.png;*.gif',
            'onError' : function (a, b, c, d) {
                if (d.status == 404)
                    alert('Could not find upload script.');
                else if (d.type === "HTTP")
                    alert('error '+d.type+": "+d.status);
                else if (d.type ==="File Size")
                    alert(c.name+' '+d.type+' Limit: '+Math.round(d.sizeLimit/1024)+'KB');
                else
                    alert('error '+d.type+": "+d.text);
            },
            'onComplete'   : function (event, queueID, fileObj, response, data) { 
                $.post('<?php echo site_url('child_avatar/uploadify'); ?>',{filearray: response},function(info){
//                    $('#avatar').attr('src', 'uploaded/user/avatar/'+info);
                    $('#hidden_avatar').val(info);
                      $('#cropping_modal').dialog('open');
                    $('#avatar_crop').attr('src', 'uploaded/user/avatar/'+info); 
                    $('#avatar_crop').imgAreaSelect({
                        x1: 0,
                        y1: 0,
                        x2: 81,
                        y2: 108,
                        handles: true,
                        resizable: true,
                        aspectRatio: '3:4',
                        onSelectEnd: function(img, selection){
                            console.log( img, selection );
                            $('#img-x1').val( selection.x1 ); 
                            $('#img-x2').val( selection.x2 );
                            $('#img-y1').val( selection.y1 );
                            $('#img-y2').val( selection.y2 );
                            $('#img-wd').val( selection.width );
                            $('#img-ht').val( selection.height );
                        }
                    });
                });
            }
        });
            $('#crop_button').click(function(e){
            $.post('user/crop',{
                x1: $('#img-x1').val(),
                y1: $('#img-y1').val(),
                x2: $('#img-x2').val(),
                y2: $('#img-y2').val(),
                wd: $('#img-wd').val(),
                ht: $('#img-ht').val(),
                avatar: $('#hidden_avatar').val()
            },function(info){
                $('#cropping_modal').dialog('close');
                $('#avatar_crop').imgAreaSelect({remove: true});
                $('#avatar').attr('src', 'uploaded/user/avatar/'+info);
                $('#hidden_avatar').val(info);
                //                          alert(info);
            });
            e.preventDefault();
        });

            
            
            
             $('#edit_profile').click(function(e) {

                    //alert(name);
                    var birth_date = $('#birth_date').val();
                    

                    var gender = $('#gender').val();
                    
                                   
                    var location = $('#location').val();
                    
                     var celphone = $('#celphone').val();
                     
                   var landline = $('#landline').val();
                   
                   var country = $('#country').val();
                   
                   var hobbies = $('#hobbies').val();
                   
                   var biography = $('#biography').val();
                   
                    var occupation = $('#occupation').val();
                   
                   var avatar = $('#hidden_avatar').val();
//                    alert(avatar);

                   var id = $('#user_id').val();
                 

                    if(landline.length == 0) {
                        alert("landline cannot be empty!");
                   
                    } else {
                        $.post("child_avatar/update_profile/" + id, {
                                        
                            birth_date: birth_date,
                            gender: gender, 
                            avatar: avatar,
                           
                            landline: landline,
                            celphone: celphone,
                            biography: biography,
                            hobbies: hobbies,
                            country: country,
                            location: location,
                            occupation: occupation,
                            user_id: user_id
                        },
                        function(data){
                            var rurl = data.split(":");
                            var code = rurl[0];
                            var msg = rurl[1];
                            if (code < 0) {
                              alert(msg);
                            } else {
                              alert(msg);
                              window.location = 'user/profile';
                            }
                        });
                    }
                    e.preventDefault();
                });
            
            
            return false;
            });
            
            
            
            
          
           
        
    });     
</script>

