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
            <span>Step 1 of 3</span>
        </div>
        <div id="ureg_step1" class="section_body">
            <div class="content_header">
                <span class="header_text">Basic Information</span>
                <span>Fields marked with an asterisk (*) are required</span>
            </div>
            <div class="registration_form">
                <form id="form_step1" class="cf">
                    <div class="form_item">
                        <span class="label">* My name is</span>
                        <input name="given_name" id="given_name" type="text" placeholder="- Given Name -" class="ui-large" value="<?php if($this->session->userdata('temp_name')){echo $this->session->userdata('temp_name');} ?>"/>
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
                        <input name="email" id="email" type="text" class="ui-medium" value="<?php if($this->session->userdata('temp_email')){echo $this->session->userdata('temp_email');} ?>"/>                        
                    </div>                    
                    <div class="form_item">
                        <span class="multi_line">* Verify E-mail Address</span>
                        <input name="email_verify" id="email_verify" type="text" class="ui-medium" value="<?php if($this->session->userdata('temp_email')){echo $this->session->userdata('temp_email');} ?>" />                        
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
                        <?= img('system/reg-profile.jpg', array('attributes' => array('id' => 'avatar', 'width' => '170'))); ?>
                        <p>Select an image file on your computer (4MB max):</p>
                        <div class="upload_form">
                            <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
                            <a href="javascript:$('#upload').uploadifyUpload();">
                                <?= img('system/btn_upload.png'); ?>
                            </a>
                        </div>
                        <div id="fileQueue"></div>
                        <input id="do_step1" type="submit" value="Continue" class="custom_button medium mumcolor do_step"/>
                    </div>
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
                <div class="content_header">
                    <span class="header_text">Children</span>
                </div>
                <div class="registration_form">
                    <div class="child_section">
                        <div id="child_item1">
                            <h1>First Child</h1>
                            <div class="form_item">
                                <span class="label">First Name</span>
                                <input name="child_fname1" id="child_fname1" type="text" class="ui-medium"/>                        
                            </div>
                            <div class="form_item">
                                <span class="label">Gender</span>
                                <select name="child_gender1" id="child_gender1" class="ui-cbo-medium form_elem">
                                    <option value="1">Female</option>
                                    <option value="2">Male</option>
                                </select>                        
                            </div>                    
                            <div class="form_item">
                                <span class="label">Birthday</span>
                                <input name="child_dob1" id="child_dob1" type="text" class="ui-medium"/>                        
                            </div>
                            <div class="cf"></div>
                        </div>
                    </div>
                    <div class="child_section_control">
                        <span id="add_child_item" class="custom_button medium mumcolor">Add Child +</span>
                        <span id="remove_child_item" class="custom_button medium mumcolor">Remove Child -</span>
                    </div>
                    <div class="form_item">
                        <span class="label">Pregnant</span>
                        <select name="pregnant" id="pregnant" class="ui-cbo-medium form_elem">
                            <option value="">No</option>
                            <option value="1">Yes</option>
                        </select>                        
                    </div>                                        
                    <div class="form_item">
                        <span class="label">Due Date</span>
                        <input name="due_date" id="due_date" type="text" class="ui-medium"/>                        
                    </div>
                    <div class="cf"></div>
                </div>
                <div class="content_header underlined">
                    <span class="header_text">Subscription Management</span>
                </div>
                <div class="subscription_section">
                    <div class="ss_item">
                        <span>Weekly Newsletter</span><input name="newsletter" type="checkbox" checked="checked"/>
                    </div>
                    <div class="ss_item">
                        <span>Weekend Planner</span><input name="weekend_planner" type="checkbox" checked="checked"/>
                    </div>
                    <div class="ss_item">
                        <span>Partner News</span><input name="partner_news" type="checkbox" checked="checked"/>
                    </div>
                    <div class="ss_item">
                        <span>Pic of the Week Results</span><input name="pow_results" type="checkbox" checked="checked"/>
                    </div>                    
                    <span class="ss_header">Mum's Helper Email</span>
                    <div class="ss_item">
                        <span>Pregnancy Guide</span><input name="preg_guide" type="checkbox" checked="checked"/>
                    </div>
                    <div class="ss_item">
                        <span>Parent-Child Development Guide</span><input name="pc_dev_guide" type="checkbox" checked="checked"/>
                    </div>
                    <div class="ss_item">
                        <span>Vacation Guide</span><input name="vacation_guide" type="checkbox" checked="checked"/>
                    </div>
                    <div class="ss_item">
                        <span>Birthday Planner</span><input name="bday_planner" type="checkbox" checked="checked"/>
                    </div>
                    <div class="ss_item tnc">
                        <input name="tnc_agree" type="checkbox" /><h1>I agree to the <a href="">terms and conditions</a></h1>
                    </div>                    
                    <input id="do_step2" type="submit" value="Continue" class="custom_button medium mumcolor do_step"/>
                </div>
            </form>
        </div>
        <div id="ureg_step3" class="section_body">
            <div class="content_header">
                <span class="header_text">Invite Friends</span>
            </div>
            <div class="invitation_section">
                <div class="manual_section">
                    <span class="is_item_header">Send Email</span>
                    <div class="row">
                        <div class="col-half fleft">
                            <p><strong>Enter your friends' e-mail Addresses separated by a comma:</strong></p>
                            <textarea id="email_adds" name="email_adds" style="height: 180px; " class="textbox-bg"></textarea>
                        </div>  <!--- end of reg3columnL -->
                        <div class="col-half fleft">
                            <p><strong>Set the e-mail message:</strong></p>
                            <div>
                                <label>Subject</label>
                                <input id="email_subject" name="email_subject" type="text" value="Check out Mumcentre!" size="40">
                            </div>
                            <div>
                                <label>Message</label>
                                <textarea id="email_body" name="email_body" cols="30" rows="5" class="textbox-bg"></textarea>
                            </div>
                            <div>
                                <input id="sendtoself" name="Email to me" type="checkbox" value="" checked="" />
                                <label class="email-copy">Send a copy of this email to myself</label>
                            </div>
                            <div id="sendbutton" class="aright">								
                                <a class="btn-submit" href="#"><?= img('system/reg-sendEmail.png'); ?></a>
                            </div> 
                        </div> <!--- end of reg3columnR -->
                    </div> <!--- end of -row -->
                </div>
                <div class="openinviter_section">
                    <span class="is_item_header">Use Addressbook</span>
                </div>
                <input id="do_step3" type="submit" value="Finish Registration" class="custom_button medium mumcolor do_step"/>
            </div>            
        </div>
        <div id="ureg_step4" class="section_body">
            <form id="form_step3">
                <div class="reg4-row">
                    <div class="content_header">
                        <span class="header_text">THANK YOU FOR REGISTERING!</span>
                    </div>
                </div> <!--- end of reg4-row -->
                <div class="reg4-row">
                    <div class="reg4-row-columnL">
                        <div id="reg4-colcont-L">
                            <r4h>What would you like<br />to do on MumCentre now?</r4h>
                        </div> <!--- end of reg4-colcont-L -->
                    </div> <!--- end of reg4-row-columnL -->
                    <div class="reg4-row-columnR">
                        <div id="reg4-colcont-R">
                            <div id="reg4-colcont-R-icon">
                                <?= img('system/reg-alert.png'); ?>
                            </div>
                            <div id="reg4-colcont-R-text">
                                <r4h class="custFontR set_alert">SET UP YOUR ALERTS NOW!</r4h>
                            </div>
                        </div>
                    </div> <!--- end of reg4-row-columnR -->
                </div>
                <div class="reg4-row">
                    <div class="reg4-row-container">
                        <div style="line-height:28px; width: 639px;float: right;padding-top: 13px;">
                    <span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color: #5a5a5a;">
                    Alerts are an excellent way to receive the latest information from MumCentre based on your profile and children’s ages.  Why not                    try it out and see, it takes less than a minute: </span>
                    </div>
                        <div class="reg4-row-container-columnL">
                            <div class="reg4-mcol-cont-L">
                                <div class="reg4-mcol-cont-L-spacer"></div>
                                <div class="reg4-mcol-cont-L-box">
                                    <div class="reg4-mcol-cont-L-arrow">
                                        <?= img('system/Reg-arrow.png'); ?>
                                    </div>
                                    <div class="reg4-mcol-cont-L-text">
                                        <a href="#" class="regLF">Return to Entry Page</a>
                                    </div>
                                </div> <!--- end of reg4-mcol-cont-L-box -->
                                <div class="reg4-mcol-cont-L-box">
                                    <div class="reg4-mcol-cont-L-arrow">
                                        <?= img('system/Reg-arrow.png'); ?>
                                    </div>
                                    <div class="reg4-mcol-cont-L-text">
                                        <a href="#" class="regLF">Enter Pic of the Week</a>
                                    </div>
                                </div> <!--- end of reg4-mcol-cont-L-box -->
                                <div class="reg4-mcol-cont-L-box">
                                    <div class="reg4-mcol-cont-L-arrow">
                                        <?= img('system/Reg-arrow.png'); ?>
                                    </div>
                                    <div class="reg4-mcol-cont-L-text">
                                        <a href="#" class="regLF">Create a Photo Blog</a>
                                    </div>
                                </div> <!--- end of reg4-mcol-cont-L-box -->
                                <div class="reg4-mcol-cont-L-box">
                                    <div class="reg4-mcol-cont-L-arrow">
                                        <?= img('system/Reg-arrow.png'); ?>
                                    </div>
                                    <div class="reg4-mcol-cont-L-text">
                                        <a href="#" class="regLF">Go to Forums</a>
                                    </div>
                                </div> <!--- end of reg4-mcol-cont-L-box -->
                                <div class="reg4-mcol-cont-L-box">
                                    <div class="reg4-mcol-cont-L-arrow">
                                        <?= img('system/Reg-arrow.png'); ?>
                                    </div>
                                    <div class="reg4-mcol-cont-L-text">
                                        <a href="#" class="regLF">Home Page</a>
                                    </div>
                                </div> <!--- end of reg4-mcol-cont-L-box -->
                            </div> <!--- end of reg4-mcol-cont-L -->
                        </div> 
                        <div class="reg4-row-container-columnR">

                            <div class="reg4-mcol-cont-R-row">
                                <div class="reg4-mcol-cont-R-cont">
                                    <div class="reg4-mcol-cont-R-col1">
                                        <div class="reg4-mcol-cont-R-col1-spacer"></div>
                                        <div class="reg4-mcol-cont-R-col1-text">Articles</div>
                                        <div class="reg4-mcol-cont-R-col1-text">Reviews</div>
                                        <div class="reg4-mcol-cont-R-col1-text2">Programs</div>
                                        <div class="reg4-mcol-cont-R-col1-text2">Curriculum</div>
                                        <div class="reg4-mcol-cont-R-col1-text">Events</div>
                                    </div> <!-- end of col1 -->
                                    <div class="reg4-mcol-cont-R-col2">
                                        <div class="reg4-mcol-cont-R-col23-spacer"></div>
                                        <div class="reg4-mcol-cont-R-col23-textbox">
                                            <div class="reg4-checkbox">
                                                <input id="articles" name="articles" type="checkbox" checked="checked"/>
                                            </div>
                                        </div>
                                        <div class="reg4-mcol-cont-R-col23-textbox">
                                            <div class="reg4-checkbox">
                                                <input id="reviews" name="reviews" type="checkbox" checked="checked" />
                                            </div>
                                        </div>
                                        <div class="reg4-mcol-cont-R-col23-textbox2">
                                            <div class="reg4-checkbox">
                                                <input id="programs" name="programs" type="checkbox" checked="checked" />
                                            </div>
                                        </div>
                                        <div class="reg4-mcol-cont-R-col23-textbox2">
                                            <div class="reg4-checkbox">
                                                <input id="curriculum" name="curriculum" type="checkbox" checked="checked" />
                                            </div>
                                        </div>
                                        <div class="reg4-mcol-cont-R-col23-textbox">
                                            <div class="reg4-checkbox">
                                                <input id="events" name="events" type="checkbox" checked="checked" />
                                            </div>
                                        </div>
                                    </div> <!-- end of col2 -->

                                </div> <!-- end reg4-mcol-cont-R-cont -->
                            </div> <!-- end of reg4-mcol-cont-R-row -->
                            <div class="reg4-mcol-cont-R-row">
                                <div class="reg4-mcol-cont-R-col2SP">
                                    <div class="reg4-checkbox">
                                        <input id="checkall" name="checkall" type="checkbox" value="newsletter" checked />
                                    </div>
                                </div>
                                <div class="reg4-mcol-cont-R-col2SP-text">Check All</div>
                                <div class="reg4-mcol-cont-R-col3SP">
                                    <div class="reg4-checkbox">
                                        <input id="uncheckall" name="uncheckall" type="checkbox" value="newsletter" />
                                    </div>
                                </div>
                                <div class="reg4-mcol-cont-R-col3SP-text"><a href="#" id="uncheckall_link">Uncheck All</a></div>
                            </div> <!-- end of reg4-mcol-cont-R-row -->
                            <table border="0">
                                <form>
                                    <tr></tr> 
                                    <tr>Choose your alerts schedule:</tr>
                                    <tr></tr>
                              <tr>
                                <td><input type="radio" name="mon_checkbox" id="mon_checkbox" class="week"></td>
                                <td>Monday</td>
                              </tr>
                              <tr>
                               <td><input type="radio" name="tue_checkbox" id="tue_checkbox" class="week"></td>
                                <td>Tuesday</td>
                                </tr>
                                <tr>
                                <td><input type="radio" name="wed_checkbox" id="wed_checkbox" class="week"></td>
                                <td>Wednesday</td>
                                </tr>
                                <tr>
                                <td><input type="radio" name="thur_checkbox" id="thur_checkbox" class="week"></td>
                                <td>Thursday</td>
                              </tr>
                              <tr><td></td><td></td><td></td></tr>
                              <tr>
                                 <td><input type="radio" name="fri_checkbox" id="fri_checkbox" class="week"></td>
                                <td>Friday</td>
                                </tr>
                                <tr>
                               <td><input type="radio" name="sat_checkbox" id="sat_checkbox" class="week"></td>
                                <td>Saturday</td>
                                </tr>
                                <tr>
                                <td><input type="radio" name="sun_checkbox" id="sun_checkbox" class="week"></td>
                                <td>Sunday</td>
                              </tr>
                              <tr>
                                <td><input type="radio" name="sun_checkbox" id="daily_checkbox" class="week"></td>
                                <td>Daily</td>
                              </tr>
                              </form>
                                </table>
                            <div class="reg4-mcol-cont-R-row">
                                <div class="reg4-mcol-cont-R-contSP">
                                    <div class="reg4-mcol-cont-R-col1SP">
                                        <div class="reg4-cS-container">
                                            <div class="reg4-cS-icon">
                                                <?= img('system/save-setting-icon.png'); ?>
                                            </div>
                                            <div class="set_alert">
                                                <a id="save_alerts" href="#" style="font-family: 'ComfortaaRegular', Arial, sans-serif;">SAVE SETTINGS</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="reg4-mcol-cont-R-colSP">
                                        <div class="reg4-mcol-cont-R-colSP-icon"><?= img('system/8723958.png'); ?>
                                        </div>
                                        <div class="reg4-mcol-cont-R-colSP-text custFontR">This is your current settings</div>
                                    </div>
                                    <br/>
                                    
                                </div> <!-- end of reg4-mcol-cont-R-contSP -->
                                <div style="line-height:28px; width: 639px;float: right;padding-top: 13px;">
                    <span style="font-family:Arial, Helvetica, sans-serif; font-size:16px; color: #5a5a5a;"><br/>
                    If you chose daily, all the latest content that has been published in the last 24 hours matching your profile and children’s age will be sent to you every day.  The weekly schedule provides you links to the same content but consolidated for the last seven days.
If at any time you wish to stop receiving the alerts, it is a very easy process to unsubscribe.  And we take your privacy very seriously, check out our privacy policy.
 </span>
                    </div>
                            </div> <!-- end of reg4-mcol-cont-R-row -->

                        </div>
                    </div>
                </div> 
            </form>    
        </div>
    </div>
</div>
<input type="hidden" id="base_url" value="<?php echo base_url();?>"/>
<?= render_partial('global/default_footer'); ?>
<div id="cropping_modal" style="width: auto; height: auto;">
    <img id="avatar_crop"/>
    <p><a href="#" id="crop_button">Done cropping</a></p>
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
        init_step1();
        init_step2();        
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
                sun : $('#sun_checkbox').attr('checked'),
                daily : $('#daily_checkbox').attr('checked')
            },
            function(response) {
//                                    alert(response);
                var r = JSON.parse(response);

                switch(r.error_code) {
                    case 0:
                        alert('Your alerts are saved.');
                        var base_url = $('#base_url').val();
                        window.location = base_url;
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