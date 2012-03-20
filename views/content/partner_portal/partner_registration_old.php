<div id="fb-root"></div>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '261024107269619',
            channelURL : '//locahost/mumcentre/fb-channel.php',
            status     : true,
            cookie     : true,
            oauth      : true,
            xfbml      : true
        });
    };
    (function(d){
        var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
        js = d.createElement('script'); js.id = id; js.async = true;
        js.src = "//connect.facebook.net/en_US/all.js";
        d.getElementsByTagName('head')[0].appendChild(js);
    }(document));
</script>

<div class="section_wrapper">
    <div id="reg_step1">
        <div class="section_header cf">
            <?= img('system/registration.png'); ?>
            <span>Step 1 of 2</span>
        </div>
        <div id="ureg_step1" class="section_body">
            
            <div class="registration_form">
                <form id="form_step1" class="cf">
                    <div id="basic_info">
                        <div class="content_header">
                            <span class="header_text">Basic Information</span>
                            <span>Fields marked with an asterisk (*) are required. (login to skip this section)</span>
                        </div>
                        <div class="form_item">
                            <span class="label">* My name is</span>
                            <input name="given_name" id="given_name" type="text" placeholder="- Given Name -" class="ui-large"/>
                        </div>
                        <div class="form_item">
                            <input name="family_name" id="family_name" type="text" placeholder="- Family Name -" class="ui-large"/>
                        </div>
                        <div class="form_item">
                            <span class="label">* My Birthday</span>
                            <input name="dob" id="dob" type="text" class="ui-medium"/>                        
                        </div>
                        <div class="form_item">
                            <span class="label">* Gender</span>
                            <select name="gender" id="gender" class="ui-cbo-medium form_elem">
                                <option value="1">Female</option>
                                <option value="2">Male</option>
                            </select>                        
                        </div>
                        <div class="form_item">
                            <span class="multi_line">* Current Location</span>
                            <input name="loc" id="loc" type="text" class="ui-xl"/>                        
                        </div>
                        <div class="form_item">
                            <span class="multi_line">* E-mail Address</span>
                            <input name="email" id="email" type="text" class="ui-medium"/>                        
                        </div>                    
                        <div class="form_item">
                            <span class="multi_line">* Verify E-mail Address</span>
                            <input name="email_verify" id="email_verify" type="text" class="ui-medium"/>                        
                        </div>                    
                        <div class="form_item">
                            <span class="multi_line">* Enter your Password</span>
                            <input name="password" id="password" type="password" class="ui-medium"/>                        
                        </div>                    
                        <div class="form_item">
                            <span class="multi_line">* Verify your Password</span>
                            <input name="password_verify" id="password_verify" type="password" class="ui-medium"/>                        
                        </div>                                        
                        <div class="avatar_section_items">
                            <div>Upload Picture</div>
                            <?= img('system/reg-profile.jpg', array('attributes' => array('id' => 'avatar', 'width' => '170', 'height' => '170'))); ?>
                            <p>Select an image file on your computer (4MB max):</p>
                            <div class="upload_form">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
                                <a href="javascript:$('#upload').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                            </div>
                            <div id="fileQueue"></div>
                        </div>
                    </div>    
                    <table width="0" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td>
                                <div class="content_header">
                                    <span class="header_text">Business Information</span>
                                    <span>Fields marked with an asterisk (*) are required</span>
                                </div>
                                <div class="form_item">
                                    <input type="hidden" name="user_id" id="user_id" value="<?php echo $this->session->userdata('user_id'); ?>"/>
                                </div>
                                <div class="form_item">
                                    <span class="multi_line">* Company Name:</span>
                                    <input name="company_name" id="company_name" type="text" class="ui-xl">                        
                                </div>
                                <div class="form_item">
                                    <span class="multi_line">* Company Address::</span>
                                    <input name="company_address" id="company_address" type="text" class="ui-xl">                        
                                </div>

                                <div class="form_item">
                                    <span class="multi_line">* Country</span>
                                    <input name="company_country" id="company_country" type="text" class="ui-medium">                        
                                </div>                    
                                <div class="form_item">
                                    <span class="multi_line">* Post Code</span>
                                    <input name="postcode" id="postcode" type="text" class="ui-medium">                        
                                </div>                    
                                <div class="form_item">
                                    <span class="multi_line">* City</span>
                                    <input name="city" id="city" type="text" class="ui-medium">                        
                                </div>                    
                                <div class="form_item">
                                    <span class="multi_line">* State/Province</span>
                                    <input name="province" id="province" type="text" class="ui-medium">                        
                                </div>            


                            </td>
                        </tr>
                        <tr>
                            <td align="right"></td>
                        </tr>
                    </table><br /><br /><br />
                    <input id="do_step1" type="submit" value="Continue" class="custom_button medium mumcolor do_step"/>
                    <input type="hidden" id="user_avatar" name="user_avatar" value="reg-profile.jpg" />
                    <input type="hidden" id="img-x1" name="img-x1" />
                    <input type="hidden" id="img-x2" name="img-x2" />
                    <input type="hidden" id="img-y1" name="img-y1" />
                    <input type="hidden" id="img-y2" name="img-y2" />
                    <input type="hidden" id="img-wd" name="img-wd" />
                    <input type="hidden" id="img-ht" name="img-ht" />
                </form>
            </div>
        </div>
        <div id="ureg_step2" class="section_body">
            <form id="form_step2" class="cf">
                <div id="ureg_step2" class="section_body" style="display: block; ">
                    <div class="content_header">
                        <span class="header_text">Product and Service Information</span>
                        <span>Fields marked with an asterisk (*) are required</span>
                    </div>
                    <div class="registration_form" style="padding-left: 215px; font-family:Arial, Helvetica, sans-serif;">
                        * Select Listing
                        <br /> <br />
                        <div style="margin-left:93px;">
                            <input name="1" type="radio" value="" /> General Listing (*Free Listing)
                            <br />
                            <div style="margin-left:28px; margin-top:12px;">
                                <span style="font-size:14px;">-Create and Manage a Company Page and Profile </span>
                            </div>

                            <div style="margin-left:28px; margin-top: 9px;">
                                <span style="font-size:14px;">-Limited Partnet Access </span>
                            </div>

                        </div>
                        <br /><br /><br />
                        <div style="margin-left:93px;">
                            <input name="1" type="radio" value="" /> Premium Listing (*Paid Listing)
                            <br />
                            <div style="margin-left:28px; margin-top:12px;">
                                <span style="font-size:14px;">-Create and Manage a Company Page and Profile </span>
                            </div>

                            <div style="margin-left:28px; margin-top: 9px;">
                                <span style="font-size:14px;">-Get Full Partner Access and Benefots from MumCentre </span>
                            </div>

                            <div style="margin-left:28px; margin-top: 9px;">
                                <span style="font-size:14px;">-Add and manage your Branches </span>
                            </div>

                            <div style="margin-left:28px; margin-top: 9px;">
                                <span style="font-size:14px;">-Manage Reviews, Events, Programs </span>
                            </div>

                            <div style="margin-left:28px; margin-top: 9px;">
                                <span style="font-size:14px;">-Manage your Ads. </span>
                            </div>

                            <div style="margin-left:28px; margin-top: 9px;">
                                <span style="font-size:14px;">
                                    <a href="#" style="text-decoration:none; border:none; color:#F00">
                                        Click to view Premium Bundle/Package.
                                    </a> </span>
                            </div>

                        </div>

                        <br /><br />
                    </div>

                    <div class="content_header">
                        <span class="header_text">Account and Payment Information</span>
                        <span>Fields marked with an asterisk (*) are required</span>
                    </div>

                    <div class="registration_form" style="padding-left: 215px; font-family:Arial, Helvetica, sans-serif;">
                        * Select Payment Type
                        <br /> <br />
                        <div style="margin-left:93px;">
                            <input name="1" type="radio" value="" /> <span style="font-size:14px;">
                                Invoiced (Invoice will be sent to your email or to your Company Address.)
                            </span>
                            <br />
                            <input name="1" type="radio" value="" /> 
                            <span style="font-size:14px;">
                                Paypal
                            </span>
                            <br />
                            <input name="1" type="radio" value="" /> 
                            <span style="font-size:14px;">
                                Free
                            </span>
                            <br />
                        </div>
                    </div>

                    <br /><br />

                    <input type="submit" value="Continue" class="custom_button medium mumcolor do_step" style="float:right; margin-right: 192px;">
                    <br /><br /> <br /> <br />
                </div>
            </form>
        </div>
    </div>
</div>
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>"/>
<?= render_partial('global/default_footer'); ?>
<div id="cropping_modal" style="width: auto; height: auto;">
    <img id="avatar_crop"/>
    <p><a href="#" id="crop_button">Done cropping</a></p>
</div>
<div id="thank_modal">
    <span style="align: center">Partner portal registration complete.</span>
    <br/><br/><br/>
    <span style="align: center">You will be redirected in 5 seconds...</span>
</div>
<div id="ureg_step2_errors" class="reveal-modal">
    <h1>Form Submission Errors</h1>
    <ol>
        <li><label for="pregnant" class="error">Male cannot be pregnant</label></li>
        <li><label for="child_dob1" class="error">Birthday of child 1 is required</label></li>
        <li><label for="child_dob2" class="error">Birthday of child 2 is required</label></li>
        <li><label for="child_dob3" class="error">Birthday of child 3 is required</label></li>
        <li><label for="due_date" class="error">Please provide a due date</label></li>
        <li><label for="tnc_agree" class="error">Please agree to the terms and conditions</label></li>
    </ol>     
    <a class="close-reveal-modal">&#215;</a>
</div>
<link rel="stylesheet" href="js/uniform/css/uniform.default.css" type="text/css" media="screen">
<link rel="stylesheet" href="js/reveal/reveal.css" type="text/css">
<link rel="stylesheet" type="text/css" href="css/jquery.imgareaselect/imgareaselect-default.css" />
<script type="text/javascript" src="js/ajaxupload.js"></script>
<script type="text/javascript" src="js/jquery.imgareaselect.pack.js"></script>
<script type="text/javascript" src="js/jquery.placeheld.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" src="js/partner_register.js"></script>
<script type="text/javascript" src="js/reveal/jquery.reveal.js"></script>
<script type="text/javascript" src="js/uniform/jquery.uniform.min.js" charset="utf-8"></script>
<script type="text/html" id="child_item_tpl">
    <div id="child_item{{index}}">
        <h1>{{item_header}}</h1>
        <div class="form_item">
            <span class="label">First Name</span>
            <input name="child_fname{{index}}" id="child_fname{{index}}" type="text" class="ui-medium"/>                        
        </div>
        <div class="form_item">
            <span class="label">Gender</span>
            <select name="child_gender{{index}}" id="child_gender{{index}}" class="ui-cbo-medium form_elem">
                <option value="1">Female</option>
                <option value="2">Male</option>
            </select>                        
        </div>                    
        <div class="form_item">
            <span class="label">Birthday</span>
            <input name="child_dob{{index}}" id="child_dob{{index}}" type="text" class="ui-medium"/>                        
        </div>
        <div class="cf"></div>
    </div>
</script>
<script type="text/javascript">
    $(document).ready(function(){
        var $unique = $('input.week');
        var user_id = $('#user_id').val();
        $unique.click(function() {
            $unique.removeAttr('checked');
            $(this).attr('checked', true);
        });
        if(user_id){
            $('#basic_info').remove();
        }
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
        $('#thank_modal').dialog({
            autoOpen: false,
            modal: true,
            width: 400,
            height: 250
        });
        $.validator.addMethod("male_pregnant", function(value, element, param) {
            return ((value === "1") && ($(param).val() === "2")) ? false : true;
        }, "");
        
        $.validator.addMethod("due_date_required", function(value, element, param) {            
            return (($("select#pregnant").val() === "1") && ($(param).val() === "1") && ($("input#due_date").val().length == 0)) ? false : true;
        }, "");       
        
        var d = new Date();
        var curr_year = d.getFullYear();
        var year_range = '1800:'+ curr_year;
        $('#dob').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            maxDate: '-18Y',
            yearRange: year_range
        });
        $('#child_dob1').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            minDate: '-18Y',
            maxDate: '+0D',
            yearRange: year_range            
        });        
        $('#due_date').datepicker({
            changeMonth: true,
            changeYear: true,
            dateFormat: 'yy-mm-dd',
            minDate: '+0',
            maxDate: '+9M'
        });        
        
        $("input[placeholder]").placeHeld();
        $("#upload").uploadify({
            'uploader'      : 'js/uploadify/uploadify.swf',
            'script'        : '../js/uploadify/uploadify.php',
            'cancelImg'     : 'js/uploadify/cancel.png',
            'folder'        : '../uploaded/user/avatar',
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
                $.post('<?php echo site_url('user/uploadify'); ?>',{filearray: response},function(info){
                    $('#user_avatar').val(info);
                    $('#cropping_modal').dialog('open');
                    $('#avatar_crop').attr('src', 'uploaded/user/avatar/'+info); 
                    $('#avatar_crop').imgAreaSelect({
                        x1: 0,
                        y1: 0,
                        x2: 81,
                        y2: 108,
                        handles: true,
                        resizable: true,
                        //                        maxWidth: 170, 
                        //                        maxHeight: 170,
                        //                        minWidth: 170, 
                        //                        minHeight: 170,
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
                avatar: $('#user_avatar').val()
            },function(info){
                $('#cropping_modal').dialog('close');
                $('#avatar_crop').imgAreaSelect({remove: true});
                $('#avatar').attr('src', 'uploaded/user/avatar/'+info);
                $('#user_avatar').val(info);
                //                          alert(info);
            });
            e.preventDefault();
        });
        init_step1(user_id);
        init_step2(user_id);        
        $("div#ureg_step1").show();
        $("#add_child_item").bind("click", function(e){
            if(child_item_index < MAX_CHILD_ITEMS) {
                child_item_index+=1;                
                var header = "";
                switch(child_item_index) {
                    case 2:
                        header = "Second Child";
                        break;
                    case 3:
                        header = "Third Child";
                        break;                        
                }
                var template_data = {index: child_item_index, item_header:header};                
                var child_item = ich.child_item_tpl(template_data);
                $('.child_section').append(child_item);
                $('#child_dob'+child_item_index).datepicker({
                    changeMonth: true,
                    changeYear: true,
                    dateFormat: 'yy-mm-dd',
                    minDate: '-18Y',
                    maxDate: '+0D',
                    yearRange: year_range
                });
            }

            e.preventDefault();
            return false;
        });
        $("#remove_child_item").bind("click", function(e){
            if(child_item_index > 1) {                
                $('#child_item' + child_item_index).remove();
                $('#child_dob'+child_item_index).datepicker("destroy");
                child_item_index-=1;
            }
            e.preventDefault();
            return false;
        });
        $("input#do_step3").bind("click", function(e){
            $.post("user/signup", {
                register: "finish"
            },
            function(response) {
                var r = JSON.parse(response);
                switch(r.error_code) {
                    case 0:
                        $("div#ureg_step3").hide();
                        $("div#ureg_step4").show();
                        $("div.section_header span").html('');
                        break;
                }
                e.preventDefault();
                return false;
            });            
        });
        //        $("input:checkbox").uniform();
        $('#save_alerts').click(function(e){
            //            if ($('#articles').attr('checked')){
            //                alert($('#articles').attr('checked'));
            //            } else {
            //                alert('articles unchecked');
            //            }
            //            alert('save alerts');
            $.post("user/alerts", {
                articles : $('#articles').attr('checked'),
                reviews : $('#reviews').attr('checked'),
                programs : $('#programs').attr('checked'),
                curriculum : $('#curriculum').attr('checked'),
                events : $('#events').attr('checked'),
                mon : $('#mon_checkbox').attr('checked'),
                tue : $('#tue_checkbox').attr('checked'),
                wed : $('#wed_checkbox').attr('checked'),
                thur : $('#thur_checkbox').attr('checked'),
                fri : $('#fri_checkbox').attr('checked'),
                sat : $('#sat_checkbox').attr('checked'),
                sun : $('#sun_checkbox').attr('checked')
            },
            function(response) {
                //                    alert(response);
                var r = JSON.parse(response);

                switch(r.error_code) {
                    case 0:
                        alert('Your alerts are saved.');
                        break;

                }
                return false;
            });
            e.preventDefault();
        });
        $('#sendbutton').click(function(e){
            var given_name = $('#given_name').val();
            var family_name = $('#family_name').val();
            $('#sendbutton').html('');
            $('#sendbutton').append('<img src="assets/img/system/loading.gif" alt="Loading" id="loading" /> Sending...');
            var email_adds = $('#email_adds').val();
            var email_subject = $('#email_subject').val();
            var email_body = $('#email_body').val();
            var em = '';
            if ($('#sendtoself:checked').val() !== undefined) {
                em = $('#email').val();
            }
            $.post("user/manual_invite", {
                sender_email: em,
                email_adds: email_adds,
                email_subject: email_subject,
                email_body: email_body,
                sender: given_name+" "+family_name
            },
            function(data){
                var rurl = data.split(":");
                var code = rurl[0];
                var msg = rurl[1];
                if (code < 0) {
                    alert(msg);
                } else {
                    alert(msg);
                }
                $('#sendbutton').html('');
                $('#sendbutton').append('<a class="btn-submit" href="javascript::;" onclick="javascript:send_mail()"><img src="assets/img/system/reg-sendEmail.png" alt="Loading" id="loading" /></a>');
            }); 
            e.preventDefault();
        });
        var base = $('#base_url').val();
        $('#email_body').val('<p>Hello!<br /><br />Check out this neat website I came across. You can find it <a href="'+base+'" target="_blank">here</a></p>');
    });
</script>