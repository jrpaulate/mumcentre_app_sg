<input type="hidden" id="user_id" value="<?php echo $this->session->userdata('user_id'); ?>"/>


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
        $("#upload").uploadify({
            'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : '/mumcentre/js/uploadify/uploadify.php',
            'cancelImg'     : '/mumcentre/js/uploadify/cancel.png',
            'folder'        : '/mumcentre/uploaded/user/avatar',
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
                    $('#avatar').attr('src', 'uploaded/user/avatar/'+info);
                    $('#hidden_avatar').val(info);
                });
            }
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
            
        
        
            $.get("user/child_data/"+ user_id, function(response) {
                var data = JSON.parse(response);
                var template = ich.child_listing_tpl(data);
                $('#child-listing').html('');
                $('#child-listing').append(template);
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
        
        
        $('#delete_modal').dialog({
            autoOpen: false,
            width: 460,
            height: 575
                   
        });
        
        
        $('#add_modal').dialog({
            autoOpen: false,
            width: 551,
            height: 575
                   
        });
        
        
        
        $('#open_hotbox').click(function(e){
              
            e.preventDefault();
        });
        
        
        $('#delete_hotbox').click(function(e){
              
            e.preventDefault();
        });
        
        
        $('#add_hotbox').click(function(e){
              
            e.preventDefault();
        });
        
        
        
        
        $('#create_child').click(function(e) {
            
            var child_name = $('#child_name').val();
                   
                   
            //alert(name);
            var birth_date = $('#birth_date').val();
                    

            var gender = $('#gender').val();
                   

                  

            var avatar = $('#hidden_avatar').val();
            //                    alert(avatar);

                 

            if(child_name.length == 0) {
                alert("Name cannot be empty!");
                   
            } else {
                $.post("child_avatar/create_child", {
                    child_name: child_name,                      
                    birth_date: birth_date,
                    gender: gender, 
                    avatar: avatar,
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
                        window.location = 'user/profile_children';
                    }
                });
            }
            e.preventDefault();
        });

        
        
        
        

    });
</script>

<div id="change_pass_modal" style="display:none">
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

<div id="sidebar2">
    <div id="c3spacer"></div>
    <?= render_partial('global/observer/sidebar'); ?>
    <!-- end .container --></div>


<div class="wrap">

    <div style="Title">
        <span class="title-1">My Profile</span> &nbsp; <img src="images/Header-Arrow.png"> &nbsp;&nbsp;<span class="sub-title">My Children</span>
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

                        <table width="406" border="0" cellspacing="0" cellpadding="0" id="child-listing">

                        </table>
                        <div style="padding-top: 43px; float:right"><a class="actionbtn" onclick="javascript:add_hotbox()" href="javascript:;;" id ="" ><img src="assets/img/system/add-child-btn.png" width="70" height="30"></a></div>


                    </div>
                </td>
            </tr>
        </table>

    </div>

</div>



<div id="hotbox_modal" style="display:none">


    <div id="hotbox-listing"></div>

</div> 


<div id="delete_modal" style="display:none">


    <div id="hotbox-delete-listing"></div>

</div> 


<div id="add_modal" style="display:none">


    <div style="width: 525px; height: 474px; background: #ddf3fe;">
        <div style="padding-left: 20px; padding-right: 20px; padding-top: 23px;">
            <div class="recent-alerts">My Children <div class="edit-profile"><img src="images/my profile img/close-btn.png"></div></div>
            <div style="border-bottom: 1px dotted #59366c; width: 475px; padding-top: 12px;"></div>
            <br />
            <table width="475" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="116" valign="middle"><div class="profile-reg-font">First Name:</div></td>
                    <td width="4">&nbsp;</td>
                    <td width="355"><input type="text" class="alerts-textbox" name="child_name" id="child_name" /></td>
                </tr>
                <tr><td colspan="3" height="16"></td></tr>
                <tr>
                    <td valign="middle"><div class="profile-reg-font">Birthday:</div></td>
                    <td width="4">&nbsp;</td>
                    <td width="355"><input type="text" id="birth_date" class="alerts-textbox" name="birth_date" value="<?php echo set_value('birth_date'); ?>" /></td>
                </tr>
                <tr><td colspan="3" height="16"></td></tr>  
                <tr>
                    <td valign="middle"><div class="profile-reg-font">Gender:</div></td>
                    <td width="4">&nbsp;</td>
                    <td width="355"><div id="basic-box-gender">
                            <select name="select" class="gender" id="gender">
                                <option value="1">female</option>
                                <option value="2">male</option>
                            </select>
                        </div></select></td>
                </tr>
                <tr><td colspan="3" height="16"></td></tr>  
                <tr>
                    <td valign="middle"></td>
                    <td width="4">&nbsp;</td>

                    <td width="355"><img id="avatar" alt="" src="assets/img/system/ArticleImageMIA.jpg" style="width: 100px; height: 100px;"/>

                        <br /> <br />
                <dt class="empty"></dt>
                <div style="float:left; padding-left: 15px;"  id="uploadContainer">
                    <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
                    <a href="javascript:$('#upload').uploadifyUpload();">
                        <?= img('system/btn_upload.png'); ?>
                    </a>
                    <div id="fileQueue"></div>

                </div>

                <input type="hidden" id="hidden_avatar"/>

                <td>






                    </tr>
                <tr><td colspan="3" height="16"></td></tr>  
                <tr>
                    <td valign="middle"></td>

                    <td width="355">
                        <div style="float:right; font-size: 21px; font-weight:bold; color: #39c"><a href="#" id="create_child" class="cssanchor">Add</a></div>
                    </td>
                </tr>
            </table>
            <br /> <br />

        </div>

    </div>




</div>




<script type="text/html" id="child_listing_tpl">
    {{#child_data}}
    {{#child}}


    <tr>
        <td valign="top">
            <div style="width: 408px;">

                <div class="number-child"></div>
                <div class="child-pic">
                    <img src="uploaded/user/avatar/{{avatar_filepath}}" width="82" height="86">
                </div>
                <div class="child-info">
                    <input type="hidden" id="child_id" value="{{child_id}}">

                    <span class="child-name">{{name}} </span>
                    <br />
                    <span class="child-name2"> {{birth_date}}</span>
                    <br />
                    <span class="child-name2"> {{gender}}</span>
                </div>
                <div class="child-edit"><span style="color: #39c"> 
                        <a class="actionbtn" onclick="javascript:open_hotbox({{child_id}})" href="javascript:;;" id ="" >Edit </a>  
                        <a class="actionbtn" onclick="javascript:delete_hotbox({{child_id}})" href="javascript:;;" id ="" >Delete </a> 
                    </span></div>
            </div>
        </td>
    </tr>

    {{/child}} 
    {{^child}}
    <tr><span>You have no children registered.</span></tr>
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




<script>
 
    function open_hotbox(child_id){
     
      

        $.get("user/children_data/"+ child_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.hotbox_listing_tpl(data);
            
            
            $('#hotbox_modal').html('');
            $('#hotbox_modal').append(template);
            
            $("#upload1").uploadify({
                'uploader'      : 'js/uploadify/uploadify.swf',
                'script'        : '/mumcentre/js/uploadify/uploadify.php',
                'cancelImg'     : '/mumcentre/js/uploadify/cancel.png',
                'folder'        : '/mumcentre/uploaded/user/avatar',
                'buttonImg'     : 'assets/img/system/btn_browse.png',
                'wmode'         : 'transparent',
                'width'         : 83,
                'height'        : 25,
                'queueID'       : 'fileQueue1',
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
                        $('#edit_avatar').attr('src', 'uploaded/user/avatar/'+info);
                        $('#edit_hidden_avatar').val(info);
                    });
                }
            });
            
            $('#edit_gender').val($('#child_gender_edit').val());
            $('#edit_bday').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd'                             
            }); 
            $('#hotbox_modal').dialog('open');
            
            $('#close_edit').click(function(e){
                $('#hotbox_modal').dialog('close');
                e.preventDefault();
            });
            
            
            $('#update_child').click(function(e){
                var name = $('#edit_name').val();
                var bday = $('#edit_bday').val();
                var gender = $('#edit_gender').val();
                var avatar = $('#edit_hidden_avatar').val();
                
                $.post("child_avatar/update_child", {
                    child_id: child_id,
                    name: name,
                    bday: bday,
                    gender: gender,
                    avatar: avatar
                },
                function(data){
                    //                            alert(data);
                    var rurl = data.split(":");
                    var code = rurl[0];
                    var msg = rurl[1];
                    alert(msg);
                    window.location.reload();
                        
                    

                });
                e.preventDefault();
            });
            
        });
     
          
    }
    
</script>




<script>
 
    function delete_hotbox(child_id){
     
      

        $.get("user/children_data/"+ child_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.hotbox_delete_listing_tpl(data);
            
            $('#delete_modal').html('');
            $('#delete_modal').append(template);

        });
     
        $('#delete_modal').dialog('open');
    }
    
</script>




<script>
 
    function add_hotbox(){
     
   
        $('#add_modal').dialog('open');
          
          
          
          
          
        $('#birth_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'                             
        });  
          
          
    }
    
</script>



<script type="text/html" id="hotbox_listing_tpl">


    {{#children_data}}
    {{#children}}

    <div style="width: 450px; height: 500px; background: #ddf3fe;">
        <input type="hidden" id="child_id" value="{{child_id}}"/>
        <input type="hidden" id="child_gender_edit" value="{{gender_number}}"/>
        <div style="padding-left: 20px; padding-right: 20px; padding-top: 23px;">
            <div class="edit-profile"><img src="images/my profile img/close-btn.png"></div>
            <br /> <br /> <br />
            <table width="285" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="75" valign="middle"><span style="font-size:14px; color:#59366c;">Name:</span></td>
                    <td width="211" valign="top">
                        <input type="text" class="profile-a alerts-textbox5" name="edit_name" id="edit_name" value="{{{name}}}"/>
                    </td>
                </tr>
                <tr><td colspan="2" height="12"></td></tr>
                <tr>
                    <td width="75" valign="middle"><span style="font-size:14px; color:#59366c;">Birthday:</span></td>
                    <td width="211" valign="top"><input type="text" id="edit_bday" class="profile-a alerts-textbox5" name="edit_bday"  value="{{birth_date}}"/></td>
                </tr>
                <tr><td colspan="2" height="12"></td></tr>
                <tr>
                    <td width="75" valign="middle"><span style="font-size:14px; color:#59366c;">Gender:</span></td>
                    <td width="211" valign="top"><select id="edit_gender" name="edit_gender" class="alerts-textbox2 profile-a"><option value="2">Male</option><option value="1">Female</option></select></td>
                </tr>
                <tr><td colspan="2" height="12"></td></tr>
                <tr>
                    <td width="75" valign="top"></td>
                    <td width="211" valign="top"><img id="edit_avatar" src="uploaded/user/avatar/{{avatar_filepath}}" width="150" height="150">
                        <br /> <br />
                        <div style="float:left; padding-left: 15px;"  id="uploadContainer1">
                        <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload1')); ?>
                        <a href="javascript:$('#upload1').uploadifyUpload();">
                            <?= img('system/btn_upload.png'); ?>
                        </a>
                        <div id="fileQueue1"></div>

                    </div>
                        <input type="hidden" id="edit_hidden_avatar" value="{{avatar_filepath}}" />
                    </td>
                </tr>
                <tr><td colspan="2" height="12"></td></tr>
                <tr>
                    <td width="75" valign="top"></td>
                    <td width="150" valign="top"><div style="font-size: 21px; font-weight:bold; color: #39c"><a id="update_child" href="#">SAVE</a></div></td>
                    <td width="150" valign="top"><div style="font-size: 21px; font-weight:bold; color: #39c"><a id="close_edit" href="#">CANCEL</a></div></td>
                </tr>
            </table>


        </div>

    </div>

    {{/children}}
    {{/children_data}}



</script>







<script type="text/html" id="hotbox_delete_listing_tpl">

    {{#children_data}}
    {{#children}}

    <div style="width: 450px; height: 500px; background: #ddf3fe;">
        <input type="hidden" id="child_id" value="{{child_id}}">
        <div style="padding-left: 20px; padding-right: 20px; padding-top: 23px;">
            <div class="edit-profile"><img src="images/my profile img/close-btn.png"></div>
            <br /> <br /> <br />
            <table width="285" border="0" cellspacing="0" cellpadding="0">
                <tr>
                    <td width="75" valign="middle"><span style="font-size:14px; color:#59366c;">Name:</span></td>
                    <td width="211" valign="top">
                        <span class="profile-a">
                            {{name}}
                        </span>
                    </td>
                </tr>
                <tr><td colspan="2" height="12"></td></tr>
                <tr>
                    <td width="75" valign="middle"><span style="font-size:14px; color:#59366c;">Birthday:</span></td>
                    <td width="211" valign="top"><span class="profile-a">
                            {{birth_date}}
                        </span></td>
                </tr>
                <tr><td colspan="2" height="12"></td></tr>
                <tr>
                    <td width="75" valign="middle"><span style="font-size:14px; color:#59366c;">Gender:</span></td>
                    <td width="211" valign="top"><span class="profile-a">
                            {{gender}}
                        </span></td>
                </tr>
                <tr><td colspan="2" height="12"></td></tr>
                <tr>
                    <td width="75" valign="top"></td>
                    <td width="211" valign="top"><img src="uploaded/user/avatar/{{avatar_filepath}}">
                </tr>
                <tr><td colspan="2" height="12"></td></tr>
                <tr>
                    <td width="75" valign="top"></td>
                    <td width="211" valign="top"><div style="font-size: 21px; font-weight:bold; color: #39c"><a class="actionbtn" onclick="javascript:remove({{child_id}})" href="javascript:;;" id ="" >DELETE</a></div></td>
                </tr>
            </table>


        </div>

    </div>

    {{/children}}
    {{/children_data}}



</script>










<script>

    function remove (child_id) {
            
        var user_id = $('#user_id').val();
            
        $.post("user/force_delete/"+ child_id) 
           
        alert('Child Removed')    
           
           
        $.get("user/child_data/"+ user_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.child_listing_tpl(data);
            $('#child-listing').html('');
            $('#child-listing').append(template);
            return false;
        });
           
        $('#delete_modal').dialog('close');

           
          
          
    }
       

</script>