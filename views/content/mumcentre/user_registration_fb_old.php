
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
                    <div class="avatar_section_items">
                        <div>Upload Picture</div>
                        <?= img('system/reg-profile.jpg', array('attributes' => array('id' => 'avatar'))); ?>
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
                    <input type="hidden" id="user_avatar" name="user_avatar" value="_default" />
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
                <input type="hidden" id="temp_id" name="temp_id" value="" />
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
                                <input id="email_subject" name="email_subject" type="text" value="Check out this neat website I came across" size="40">
                            </div>
                            <div>
                                <label>Message</label>
                                <textarea id="email_body" name="email_body" cols="30" rows="5" class="textbox-bg" style="">Hello!

Check out this neat website I came across. You can find it &lt;a href="http://www.mumcentre.com.sg" target="_blank"&gt;here&lt;/a&gt;.

Truly,
your name</textarea>
                            </div>
                            <div>
                                <input id="sendtoself" name="Email to me" type="checkbox" value="" checked="" />
                                <label class="email-copy">Send a copy of this email to myself</label>
                            </div>
                            <div id="sendbutton" class="aright">								
                                <a class="btn-submit" href="javascript::;" onclick="javascript:send_mail()"><?= img('system/reg-sendEmail.png'); ?></a>
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
                                <r4h>Set-up your Alerts now</r4h>
                            </div>
                        </div>
                    </div> <!--- end of reg4-row-columnR -->
                </div>
                <div class="reg4-row">
                    <div class="reg4-row-container">
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
                                        <div class="reg4-mcol-cont-R-col23-spacer">YES</div>
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
                                        <input name="" type="checkbox" value="newsletter" checked />
                                    </div>
                                </div>
                                <div class="reg4-mcol-cont-R-col2SP-text">Check All</div>
                                <div class="reg4-mcol-cont-R-col3SP">
                                    <div class="reg4-checkbox">
                                        <input name="" type="checkbox" value="newsletter" />
                                    </div>
                                </div>
                                <div class="reg4-mcol-cont-R-col3SP-text">Uncheck All</div>
                            </div> <!-- end of reg4-mcol-cont-R-row -->
                            <div class="reg4-mcol-cont-R-row">
                                <div class="reg4-mcol-cont-R-contSP">
                                    <div class="reg4-mcol-cont-R-col1SP">
                                        <div class="reg4-cS-container">
                                            <div class="reg4-cS-icon">
                                                <?= img('system/Reg-Pencil.png'); ?>
                                            </div>
                                            <div class="reg4-cS-text">
                                                <a id="save_alerts" href="#" class="reg4cs">Save settings</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="reg4-mcol-cont-R-colSP">
                                        <div class="reg4-mcol-cont-R-colSP-icon"><?= img('system/Reg-check.png'); ?>
                                        </div>
                                        <div class="reg4-mcol-cont-R-colSP-text">This is your current settings</div>
                                    </div>
                                </div> <!-- end of reg4-mcol-cont-R-contSP -->
                            </div> <!-- end of reg4-mcol-cont-R-row -->

                        </div>
                    </div>
                </div> 
            </form>    
        </div>
    </div>
</div>
<?= render_partial('global/default_footer'); ?>
<div id="ureg_step2_errors" class="reveal-modal">
    <h1>Form Submission Errors</h1>
    <ol>
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
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '261024107269619', // App ID
                channelURL : '//localhost/mumcentre/channel.html', // Channel File
                status     : true, // check login status
                cookie     : true, // enable cookies to allow the server to access the session
                oauth      : true, // enable OAuth 2.0
                xfbml      : true  // parse XFBML
            });
            FB.getLoginStatus(function(response) {
                if (response.authResponse) {
                    // logged in and connected user, someone you know
                    //                    alert('logged in and connected');
                    FB.api('/me', function(response) {
                        //                      alert('Good to see you, ' + response.name + '!');
                        ////                        $('#avatar').attr('src', '/'+response.id+'/picture');
                        if(response.gender == 'female') {
                            $('#gender').val(1);
                        } else {
                            $('#gender').val(2);
                        }
                        $('#given_name').val(response.first_name);
                        $('#family_name').val(response.last_name);
                        $('#dob').val(response.birthday);
                        $('#loc').val(response.location.name);
                        $('#email').val(response.email);
                        $('#email_verify').val(response.email);
                        $('#avatar').attr('src','http://graph.facebook.com/'+response.id+'/picture')
                    });
                }
            });
        };
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
            maxDate: '+0d',
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
            'uploader'      : '/mumcentre/js/uploadify/uploadify.swf',
            'script'        : '/mumcentre/js/uploadify/uploadify.php',
            'cancelImg'     : '/mumcentre/js/uploadify/cancel.png',
            'folder'        : '/mumcentre/uploaded/avatar',
            'buttonImg'     : '/mumcentre/assets/img/system/btn_browse.png',
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
                    $('#avatar').attr('src', 'uploaded/avatar/'+info);
                    $('#user_avatar').val(info);
                });
            }
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
        $("input:checkbox").uniform();
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
                events : $('#events').attr('checked')
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
    });
</script>