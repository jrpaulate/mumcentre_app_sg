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
    <div class="section_header cf">
        <?= img('system/registration.png'); ?>
    </div>
    <form action="" id="frm_member_reg" name="frm_member_reg" method="POST">
        <fieldset title="Step 1">
            <legend>Personal Information</legend>
            <div class="form_item">
                <span class="label">* My name is</span>
                <input name="given_name" id="given_name" type="text" placeholder="- Given Name -" class="ui-large" value=""/>
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
                <input name="email" id="email" type="text" class="ui-medium" value=""/>                        
            </div>                    
            <div class="form_item">
                <span class="multi_line">* Verify E-mail Address</span>
                <input name="email_verify" id="email_verify" type="text" class="ui-medium" value="" />                        
            </div>                    
            <div class="form_item">
                <span class="multi_line">* Enter your Password</span>
                <input name="password" id="password" type="password" class="ui-medium"/>                        
            </div>                    
            <div class="form_item">
                <span class="multi_line">* Verify your Password</span>
                <input name="password_verify" id="password_verify" type="password" class="ui-medium"/>                        
            </div>                                        
            <div class="avatar_upload_wrapper">
                <span class="multi_line">Upload Picture</span>
                <?= img('system/reg-profile.jpg', array('attributes' => array('id' => 'avatar', 'width' => '170'))); ?>
                <p>Select an image file on your computer (4MB max):</p>
                <div class="upload_form">
                    <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
                    <a href="javascript:$('#upload').uploadifyUpload();">
                        <?= img('system/btn_upload.png'); ?>
                    </a>
                </div>
                <div id="fileQueue"></div>                
            </div>
            <input type="hidden" id="user_avatar" name="user_avatar" value="reg-profile.jpg" />
            <input type="hidden" id="img-x1" name="img-x1" />
            <input type="hidden" id="img-x2" name="img-x2" />
            <input type="hidden" id="img-y1" name="img-y1" />
            <input type="hidden" id="img-y2" name="img-y2" />
            <input type="hidden" id="img-wd" name="img-wd" />
            <input type="hidden" id="img-ht" name="img-ht" />
        </fieldset>
        <fieldset title="Step 2">
            <legend>Company Information</legend>
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
                                </div><br/> <br/><br/>
        </fieldset>
        <fieldset title="Step 3">
            <legend>Product and Service Information</legend>
                        * Select Listing
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
                        <br/>
                        <div class="content_header">
                        <span class="header_text">Account and Payment Information</span>
                        <span>Fields marked with an asterisk (*) are required</span>
                    </div>
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
                        <br/><br/>
        </fieldset>
        <input type="submit" class="finish" value="Finish!" />
    </form>        
</div>
<input type="hidden" id="base_url" value="<?php echo base_url(); ?>"/>

<?= render_partial('global/default_footer'); ?>
<div id="cropping_modal" style="width: auto; height: auto;">
    <img id="avatar_crop"/>
    <p><a href="#" id="crop_button">Done cropping</a></p>
</div>
<div id="reg_errors" class="reveal-modal">
    <h1>Form Submission Errors</h1>
    <ul>
        <li><label for="pregnant" class="error">Male cannot be pregnant</label></li>
        <li><label for="child_dob1" class="error">Birthday of child 1 is required</label></li>
        <li><label for="child_dob2" class="error">Birthday of child 2 is required</label></li>
        <li><label for="child_dob3" class="error">Birthday of child 3 is required</label></li>
        <li><label for="due_date" class="error">Please provide a due date</label></li>
        <li><label for="tnc_agree" class="error">Please agree to the terms and conditions</label></li>
    </ul>     
    <a class="close-reveal-modal">&#215;</a>
</div>
<div id="thank_modal" style="display:none">
    <span style="align: center">Partner portal registration complete.</span>
    <br/><br/><br/>
    <span style="align: center">You will be redirected in 5 seconds...</span>
</div>
<link rel="stylesheet" href="js/uniform/css/uniform.default.css" type="text/css" media="screen">
<link rel="stylesheet" href="js/reveal/reveal.css" type="text/css">
<link rel="stylesheet" type="text/css" href="css/jquery.imgareaselect/imgareaselect-default.css" />
<script type="text/javascript" src="js/ajaxupload.js"></script>
<script type="text/javascript" src="js/jquery.imgareaselect.pack.js"></script>
<script type="text/javascript" src="js/jquery.placeheld.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript" src="js/jquery.stepy.js"></script>
<script type="text/javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" src="js/registration.js"></script>
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
        var alerts_status = 0;
        var $unique = $('input.week');
        $unique.click(function() {
            $unique.removeAttr('checked');
            $(this).attr('checked', true);
        });
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
        $('#frm_member_reg').stepy({
            backLabel:	'&#171; Back',
            block:	true,
            errorImage:	true,
            nextLabel:	'Next &#187;',
            titleClick:	true,
            validate:	true
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
                $.post('<?php echo site_url('member/uploadify'); ?>',{filearray: response},function(info){
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
        var container = $('div#reg_errors');
        
        $("form#frm_member_reg").validate({               
            rules: {
                given_name: "required",
                family_name: "required",
                dob: "required",
                loc: "required",
                company_name: "required",
                company_address: "required",
                company_country: "required",
                postcode: "required",
                city: "required",
                province: "required",
                email: {
                    required: true,
                    email: true
                },
                email_verify: {
                    required: true,
                    equalTo: "#email"
                },            
                password: {
                    required: true,
                    minlength: 6
                },
                password_verify: {
                    required: true,
                    equalTo: "#password"
                }              
            }, 
            messages: {
                pregnant:"Male cannot be pregnant",
                child_dob1:"Birthday of child 1 is required",
                child_dob2:"Birthday of child 2 is required",
                child_dob3:"Birthday of child 3 is required",
                due_date:"Please provide a due date",
                tnc_agree:"Please agree to the terms and conditions"
            },
            submitHandler: function(form) {
                $.post("partner/signup", $(form).serialize(),
                function(response) {
//                    alert(response);
                    var r = JSON.parse(response);
                    switch(r.error_code) {
                        case 0:
                            $('#thank_modal').dialog('open');
                            setTimeout(function() {window.location = "partner";}, 5000);
                            break;
                        case 2:   
                            alert('Email address is already registered!');    
                    }
                    return false;
                });
            }
        });
    });
</script>