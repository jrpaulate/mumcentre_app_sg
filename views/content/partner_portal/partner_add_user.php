<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
<script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
  
  $("#upload").uploadify({
            'uploader'      : '/mumcentre/js/uploadify/uploadify.swf',
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
                $.post('<?php echo site_url('cms_user_account/uploadify'); ?>',{filearray: response},function(info){
                    $('#avatar').attr('src', 'uploaded/user/avatar/'+info);
                    $('#hidden_avatar').val(info);
//                                            alert(info);
                });
            }
        });
        
        
        
        
        var provider_id = $('#provider_id').val();
        var provider_name = $('#provider_name').val();
        
        $.get("partner_content_event/provider_data/"+ provider_id, function(response) {
            var data = JSON.parse(response);
            var template = ich.provider_listing_tpl(data);
            $('#providerinfo').html('');
            $('#providerinfo').append(template);
            return false;
            $('#providercontain').html('');
            $('#providercontain').append(provider_body);
        });
     

    
        
        
        $('#create_user').click(function(e) {
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

                   // var provider_id = $('#provider_id').val();
                    
                    if(first_name.length == 0) {
                        alert("First Name cannot be empty!");
                    } else if(last_name.length == 0) {
                        alert("Last Name cannot be empty!");
                    } else if(email.length == 0) {
                        alert("Email cannot be empty!");
                    } else {
                        $.post("partner_user_account/create_user", {
                            first_name: first_name,
                            last_name: last_name,
                            username: username,
                            password: password,  
                            email: email,
                            avatar: avatar
                          //  provider_id: provider_id
                        },
                        function(data){
                            var rurl = data.split(":");
                            var code = rurl[0];
                            var msg = rurl[1];
                            if (code < 0) {
                              alert(msg);
                            } else {
 
                            window.location = 'partner/user_account';
                        
                       
                              
                            }
                        });
                    }
                    e.preventDefault();
                });
       
       
});      
</script>

<script type ="text/html" id="provider_listing_tpl">
 <table width="917" border="0" cellspacing="0" cellpadding="0">
   {{#provider_data}}
     {{#provider}}
     <tr class="provider">
  
   <div><span class="fontcomfortaa">Partner Listing</span> &nbsp;&nbsp;<img src="images/Header-Arrow.png"> 
   <span style="font-size: 25px; color: #2490ce;">Add New User</span> &nbsp;&nbsp;<img src="images/Header-Arrow.png"> 
   <span style="font-size: 20px; color: #2490ce;">{{provider_name}}</span>
  
   </div>
   </tr>  
   {{/provider}}
   {{/provider_data}}
</table>
</script>

<input type="hidden" id="provider_id" value="<?php echo $this->session->userdata('provider_id'); ?>" />
<form id="frmMain" name="frmMain">

    <div style="border-bottom: 2px solid #2490ce; width: 917px;">
        <tr class="provider">
        <td> <div id="providerinfo"></div></td>
        <td> <div id="provider-listing"></div></td>
    </tr>
    </div>
    <!--------------------------------------------------------------------------------------------->   
    <br />

    <div class="event-form" align="center">
        <br /> <br />
        <table width="600" border="0" cellspacing="4px" cellpadding="0">
      
            
            <tr>
                <td align="right" class="fontcomfortaa2">
                    User Avatar:
                </td>
                <td>&nbsp;</td>
                <td>
                    <img id="avatar" alt="" src="assets/img/system/ArticleImageMIA.jpg" style="width: 250px; height: 200px;"/>
                    <br /><br />
                   <div id="uploadContainer">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
                                <a href="javascript:$('#upload').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                  </div>
                    
                     <div id="fileQueue"></div>
                     <input type="hidden" id="hidden_avatar"/>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td align="right" class="fontcomfortaa2">Email Address:</td>
                <td></td>
                <td>
                    <input type="text" class="textbox" id="email" name="email"/>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
             <tr>
                <td align="right" class="fontcomfortaa2">Username:</td>
                <td></td>
                <td>
                    <input type="text" class="textbox" id="username" name="username"/>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
              <tr>
                <td align="right" class="fontcomfortaa2">Password:</td>
                <td></td>
                <td>
                    <input type="text" class="textbox" id="password" name="password"/>
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
        
            <tr>
                <td align="right" class="fontcomfortaa2">First Name:</td>
                <td></td>
                <td>
                    <input type="text" class="textbox" id="first_name" name="first_name"/>
                </td>
            </tr>
            
            
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
             <tr>
                <td align="right" class="fontcomfortaa2">Last Name:</td>
                <td></td>
                <td>
                    <input type="text" class="textbox" id="last_name" name="last_name"/>
                </td>
            </tr>
            
            
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>

            
        
            
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            
 
            <tr>
                <td align="right" class="fontcomfortaa2">
                </td>
                <td>&nbsp;</td>
                <td>
                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="95"><a href="#" id="create_user" class="cssanchor"><img src="images/submit.png"></a></td>
                            <td width="474"><a href=""> <img src="images/CANCEL.png"></a></td>
                        </tr>
                          <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
                    </table>

                </td>
            </tr>
        </table>


        <!--------------------------------------------------------------------------------------------->       
    </div>

</form>


