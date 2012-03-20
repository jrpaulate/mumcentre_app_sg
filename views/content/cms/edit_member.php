<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        
        
         $('#birth_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd'
     
          });
    
         var user_id = $('#user_id').val();
          var user_body = $('#last_name').val();
          
        $.get("edit_member/user_data/"+ user_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.user_listing_tpl(data);
            $('#articleinfo').html('');
            $('#articleinfo').append(template);
            return false;
            $('#articlecontain').html('');
            $('#articlecontain').append(user_body);
        });
 
        
         $("#upload").uploadify({
            'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : '../js/uploadify/uploadify.php',
            'cancelImg'     : 'js/uploadify/cancel.png',
            'folder'        : '../uploaded/avatar/',
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
                $.post('<?php echo site_url('edit_member/uploadify'); ?>',{filearray: response},function(info){
                    $('#avatar').attr('src', 'uploaded/avatar/'+info);
                    $('#hidden_avatar').val(info);
//                                            alert(info);
                });
            }
        });
        
        $('#update_member').click(function(e) {
                    var first_name = $('#first_name').val();
                    first_name = first_name.replace("'", "`");
                    var last_name = $('#last_name').val();
                    last_name = last_name.replace("'", "`");
                    var password = $('#password').val();
                    password = password.replace("'", "`");
                    //alert(name);
                    var birth_date = $('#birth_date').val();
                    birth_date = birth_date.replace("'", "`");

                    var gender = $('#gender').val();
                    gender = gender.replace("'", "`");

                    var email = $('#email').val();
                    email = email.replace("'", "`");

                    var avatar = $('#hidden_avatar').val();
//                    alert(avatar);

                    var location = $('#location').val();
                    location = location.replace("'", "`");

                    if(first_name.length == 0) {
                        alert("First Name cannot be empty!");
                    } else if(last_name.length == 0) {
                        alert("Last Name cannot be empty!");
                    } else if(email.length == 0) {
                        alert("Email cannot be empty!");
                    } else if(location.length == 0) {
                        alert("Location cannot be empty!");
                    } else {
                        $.post("edit_member/update_member", {
                            first_name: first_name,
                            last_name: last_name,
                            password: password,
                            birth_date: birth_date,
                            gender: gender,
                            email: email,
                            location: location,
                            avatar: avatar
                        },
                        function(data){
                            var rurl = data.split(":");
                            var code = rurl[0];
                            var msg = rurl[1];
                            if (code < 0) {
                              alert(msg);
                            } else {
                              alert(msg);
                              window.location = 'cms_member';
                            }
                        });
                    }
                    e.preventDefault();
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



<script type="text/html" id="user_listing_tpl">
    {{#user_data}}
    {{#user}}
<p><i><font color="red">*</font> = Required Field</i></p>
        <dl>
            
            
                        <dt>Avatar</dt>
                        <dd><img id="avatar" alt="" src="uploaded/avatar/{{avatar_filepath}}" style="width: 100px; height: 100px;"/></dd>
                        <dt class="empty"></dt>
                        <dd><div id="uploadContainer">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
                                <a href="javascript:$('#upload').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                            </div></dd>
                        <div id="fileQueue"></div>
                        <br />
                        <input type="hidden" id="hidden_avatar"/>


                        <dt><label for="first_name">First Name:</label></dt>
                        <dd><input type="text" id="first_name" name="first_name" value="{{first_name}}" /> <font color="red">*</font></dd>

                        <dt><label for="last_name">Last Name:</label></dt>
                        <dd><input type="text" id="last_name" name="last_name"  value="{{last_name}}"/> <font color="red">*</font></dd>

                         <dt><label for="gender">Gender</label></dt>
                        <dd><div id="basic-box-gender">
                                    <select name="select" class="gender" id="gender" value="{{gender}}">
                                        <option value="1">female</option>
                                        <option value="2">male</option>
                                    </select>
                       </div></dd>

                       <dt><label for="birth_date">Birth Date</label></dt>
                       <dd><input type="text" name="birth_date" id="birth_date" class="text-ep-textinput" value="{{birth_date}}"/></dd>


                        <dt><label for="email">Email Address:</label></dt>
                        <dd><input type="text" name="email" id="email" value="{{email}}"/> <font color="red">*</font></dd>

                        <dt><label for="password">Password:</label></dt>
                        <dd><input type="text" name="password" id="password" value="{{password}}"/> <font color="red">*</font></dd>
                  

                        <dt><label for="location">Location:</label></dt>
                        <dd><input type="text" name="location" id="location" value="{{location}}"/> <font color="red">*</font></dd>

 
            
             </dl>
{{/user}}
{{/user_data}}
</script>


<form id="frmMain" name="frmMain">
<input type="hidden" id="user_id" value="<?php echo $id;?>" />


    <div id="content">
        <ul class="ulsubnav">
            <li>Member CMS</li>
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Edit Member</h2>
               
                <div id="articleinfo">
               
                        <input type="hidden" id="hidden_avatar"/>
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="#" id="update_member" class="cssanchor">SUBMIT</a></div>
                <div class="cssanchor"><a href="<?php echo base_url(); ?>cms/cms_member" class="cssanchor">BACK</a></div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
    	Mumcentre CMS.
        </div>
    </div>
</form>