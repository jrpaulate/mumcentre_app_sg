<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript">
    
    $(document).ready(function(){
         $("#upload").uploadify({
            'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : '../js/uploadify/uploadify.php',
            'cancelImg'     : 'js/uploadify/cancel.png',
            'folder'        : '../uploaded/avatar',
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
                $.post('<?php echo site_url('cms_user_account/uploadify'); ?>',{filearray: response},function(info){
                    $('#avatar').attr('src', 'uploaded/avatar/'+info);
                    $('#hidden_avatar').val(info);
//                                            alert(info);
                });
            }
        });
        $('#add_user_account').click(function(e) {
                    var first_name = $('#first_name').val();
                    first_name = first_name.replace("'", "`");
                    
                    var last_name = $('#last_name').val();
                    last_name = last_name.replace("'", "`");
                    
                    var username = $('#username').val();
                    username = username.replace("'", "`");
                    
                    
                    var password = $('#password').val();
                    password = password.replace("'", "`");
                    //alert(name);


                    var email = $('#email').val();
                    email = email.replace("'", "`");

                    var avatar = $('#hidden_avatar').val();


                    if(first_name.length == 0) {
                        alert("First Name cannot be empty!");
                    } else if(last_name.length == 0) {
                        alert("Last Name cannot be empty!");
                    } else if(email.length == 0) {
                        alert("Email cannot be empty!");
                    } else {
                        $.post("cms_user_account/add_user_account", {
                            first_name: first_name,
                            last_name: last_name,
                            username: username,
                            password: password,  
                            email: email,
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
                              window.location = 'cms';
                            }
                        });
                    }
                    e.preventDefault();
                });


          
        
       
});
</script>



<form id="frmMain" name="frmMain">

    <div id="content">
        <ul class="ulsubnav">
            <li>User Account CMS</li>
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Add User Accounts</h2>

                <div id="articleinfo">
                    <p><i><font color="red">*</font> = Required Field</i></p>
                    <dl>

                        <dt>Avatar</dt>
                        <dd><img id="avatar" alt="" src="assets/img/system/ArticleImageMIA.jpg" style="width: 100px; height: 100px;"/></dd>
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
                        <dd><input type="text" id="first_name" name="first_name" /> <font color="red">*</font></dd>

                        <dt><label for="last_name">Last Name:</label></dt>
                        <dd><input type="text" id="last_name" name="last_name" /> <font color="red">*</font></dd>

                        <dt><label for="email">Email Address:</label></dt>
                        <dd><input type="text" name="email" id="email"/> <font color="red">*</font></dd>
                        
                        <dt><label for="username">User Name:</label></dt>
                        <dd><input type="text" id="username" name="username" /> <font color="red">*</font></dd>

                        <dt><label for="password">Password:</label></dt>
                        <dd><input type="text" name="password" id="password"/> <font color="red">*</font></dd>
                        
                        <dt><label for="select-gender">Role</label></dt>
                             <dd> <select name="select-gender" class="gender" id="gender">
                                <option value="1">CMS Admin</option>
                                <option value="2">Editor</option>
                                <option value="2">Custom</option>
                            </select>
                             </dd>
                        
                        
                        <dt><label for="Article">Permission:</label></dt>

                        <input type="checkbox" name="Events" id="Events"/> <font color="red">*</font>
                        <label for="Article">Programs</label>
                        
                        <input type="checkbox" name="Article" id="Article"/> <font color="red">*</font>
                        <label for="Article">Article:</label>

                        <input type="checkbox" name="Events" id="Events"/> <font color="red">*</font>
                        <label for="Article">Events</label>
                       
                      
                       
                        </br>
                        
                        <input type="checkbox" name="Events" id="Events"/> <font color="red">*</font>
                        <label for="Article">Providers</label>
                       <input type="checkbox" name="Events" id="Events"/> <font color="red">*</font>
                        <label for="Article">Reviews</label>
                        <input type="checkbox" name="Article" id="Article"/> <font color="red">*</font>
                        <label for="Article">Curriculum:</label>

                      
                       
                      
                      
                  
                    </dl>
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="cms_user_account/create" id="add_user_account" class="cssanchor">SUBMIT</a></div>
                <div class="cssanchor"><a href="<?php echo base_url(); ?>cms_member" class="cssanchor">BACK</a></div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
    	Mumcentre CMS.
        </div>
    </div>
</form>