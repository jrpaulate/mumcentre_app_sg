<script type="text/javascript">
    $(document).ready(function(){
     
         $("#upload_logo").uploadify({
            'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : 'js/uploadify/uploadify.php',
            'cancelImg'     : 'js/uploadify/cancel.png',
            'folder'        : 'uploads/provider/logo',
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
                $.post('<?php echo site_url('cms_provider/uploadify_logo'); ?>',{filearray: response},function(info){
                    $('#logo').attr('src', 'uploaded/provider/logo/'+info);
                    $('#hidden_logo').val(info);
//                                            alert(info);
                });
            }
        });
        $("#upload_image").uploadify({
            'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : 'js/uploadify/uploadify.php',
            'cancelImg'     : 'js/uploadify/cancel.png',
            'folder'        : 'uploads/provider/image',
            'buttonImg'     : 'assets/img/system/btn_browse.png',
            'wmode'         : 'transparent',
            'width'         : 83,
            'height'        : 25,
            'queueID'       : 'fileQueue2',
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
                $.post('<?php echo site_url('cms_provider/uploadify_image'); ?>',{filearray: response},function(info){
                    $('#image').attr('src', 'uploaded/provider/image/'+info);
                    $('#hidden_image').val(info);
//                                            alert(info);
                });
            }
        });        
        $('#create_provider_profile').click(function(e) {    
       
                    var name = $('#name').val();
                    name = name.replace("'", "`");
                    var details = tinyMCE.get('details').getContent();
                    details = details.replace("'","`");
                    var location = $('#location').val();
                    var email = $('#email').val();
                    var contact = $('#contact').val();
                    var logo = $('#hidden_logo').val();
                    var image = $('#hidden_image').val();
                    if(name.length == 0) {
                        alert("Provider name cannot be empty!");
                    } else if(details.length == 0) {
                        alert("Details cannot be empty!");
                    } else if(location.length == 0) {
                        alert("Location cannot be empty!");
                    } else if(email.length == 0) {
                        alert("Email cannot be empty!");
                    } else if(contact.length == 0) {
                        alert("Contact details cannot be empty!");
                    } else if(logo.length == 0) {
                        alert("Logo cannot be empty!");
                    } else if(image.length == 0) {
                        alert("Image cannot be empty!");
                    } else {
                        $.post("cms_provider/create_provider", {
                            name: name,
                            details: details,
                            location: location,
                            email: email,
                            contact: contact,
                            logo: logo,
                            image: image
                        },
                        function(data){
                            var rurl = data.split(":");
                            var code = rurl[0];
                            var msg = rurl[1];
                            if (code < 0) {
                              alert(msg);
                            } else {
                              alert(msg);
                              window.location = '/mumcentre/cms_provider';
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
            <li>Article CMS</li>
        </ul>
        <div id="content-box">
            <div id="addnew-holder">
                <h2>Add New Article</h2>

                <div id="articleinfo">
                    <p><i><font color="red">*</font> = Required Field</i></p>
                    <dl>
                        <dt><label for="name">Provider Name:</label></dt>
                        <dd><input type="text" id="name" name="name" /> <font color="red">*</font></dd>
                        <dt>Provider details: </dt>
                        <dd><textarea id="description" name="description"></textarea></dd>
                        <dt><label for="location">Location:</label></dt>
                        <dd><input type="text" name="location" id="location"/> <font color="red">*</font></dd>
                        <dt><label for="location">Location:</label></dt>
                        <dd><input type="text" name="location" id="location"/> <font color="red">*</font></dd>
                        <dt><label for="location">Location:</label></dt>
                        <dd><input type="text" name="location" id="location"/> <font color="red">*</font></dd>
                        <dt>Provider Logo</dt>
                        <dd><img id="logo" alt="" src="assets/img/system/ArticleImageMIA.jpg" style="width: 100px; height: 100px;"/></dd>
                        <dt class="empty"></dt>
                        <dd><div id="uploadContainer">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload_logo')); ?>
                                <a href="javascript:$('#upload_logo').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                            </div></dd>
                        <div id="fileQueue1"></div>
                        <br />
                        <input type="hidden" id="hidden_logo"/>
                        <dt>Provider Image</dt>
                        <dd><img id="image" alt="" src="assets/img/system/ArticleImageMIA.jpg" style="width: 100px; height: 100px;"/></dd>
                        <dt class="empty"></dt>
                        <dd><div id="uploadContainer">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload_image')); ?>
                                <a href="javascript:$('#upload_image').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                            </div></dd>
                        <div id="fileQueue2"></div>
                        <br />
                        <input type="hidden" id="hidden_image"/>
                        
                    </dl>
                </div>

            </div>
            <div class="clear floatright" style="margin-top:20px;">
                <div class="cssanchor"><a href="#" id="create_provider_profile" class="cssanchor">SUBMIT</a></div>
                <div class="cssanchor"><a href="<?php echo base_url(); ?>" class="cssanchor">BACK</a></div>
            </div>
        </div>
    </div>
    <div id="footer">
        <div class="container">
    	Mumcentre CMS.
        </div>
    </div>
</form>