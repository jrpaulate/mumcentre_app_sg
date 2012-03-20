<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAMhR58V4QNsdVy96Os_BDNhSlSGdp3IxvsPTYa9f_4IaFlS3_4xT2WP2oIsO4gnJe_QD5WOmJwbTatg
"></script>
<script src="http://cdn.jquerytools.org/1.2.6/form/jquery.tools.min.js"></script>
<script type="text/html" id="additional_child_tpl">
    <div class="reg2-column2-formtext">
        <div class="form-row">
            <div class="basic-ep">
                <div class="box-left"></div>
                <div class="text-ep"><label for="Email"></label>
                    <input type="text" name="Email" id="Email" class="text-ep-textinput"/>
                </div>
                <div class="box-right"></div>
            </div>    
            <div class="text2-space1L">Gender</div>
            <div id="basic-gender">
                <div id="basic-box-gender">
                    <select name="select" class="gender">
                        <option value="female">female</option>
                        <option value="male">male</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="basic-ep">
                <!--                                <div id="basic-bday-day">-->
                <div class="box-left"></div>
                <div class="text-ep"><label for="birthdate"></label>
                    <input type="text" name="birthdate_kid" id="birthdate_kid1" class="text-ep-textinput" value="                    -Click to select date-"/></div>

                <!--                                </div>-->
                <div class="box-right"></div> 
            </div>
        </div> <!-- Column row end -->
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            var childlimit = 1;
            var fblike;
            var given_name;
            var family_name;
            var email = '';
            $('#reg-body-cont2').css('display','none');
            $('#reg-body-cont3').css('display','none');
            $('#reg-body-cont4').css('display','none');
            //            $('#c1').append('<div class="reg2-text-space1L">First Name</div><div class="reg2-text-space1L">Birthday</div>');
            //            $('#c2').append('<div class="text-ep"><label for="childname"></label><input type="text" name="childname" id="childname" class="text-ep-textinput"/></div>');
            //        
            //        $('#addchild').click(function(e) {
            //            childlimit = childlimit + 1;
            //            $('#c1').append('<div class="reg2-text-space1L">First Name</div><div class="reg2-text-space1L">Birthday</div>');
            //            $('#c2').append('<div class="text-ep"><label for="childname"></label><input type="text" name="childname" id="childname" class="text-ep-textinput"/></div>');
            ////            alert(childlimit);
            //        e.preventDefault();
            //        });
            $('#birthdate').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                // dateFormat: 'MM dd, yy',
                maxDate: '+0d',
                yearRange: '1800:2011'
            });
            $('#birthdate_kid').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                // dateFormat: 'MM dd, yy',
                maxDate: '+0d',
                yearRange: '1800:2011'
            });
            $('#duedate').datepicker({
                changeMonth: true,
                changeYear: true,
                dateFormat: 'yy-mm-dd',
                // dateFormat: 'MM dd, yy',
                maxDate: '+0d',
                yearRange: '1800:2011'
            });
            $("#upload").uploadify({
                'uploader'      : 'js/uploadify/uploadify.swf',
                'script'        : 'js/uploadify/uploadify.php',
                'cancelImg'     : 'js/uploadify/cancel.png',
                'folder'        : 'uploaded/user/avatar',
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
                    $.post('<?php echo site_url('register/uploadify'); ?>',{filearray: response},function(info){
                        $('#avatar').attr('src', 'uploaded/user/avatar/'+info);
                        $('#hidden_avatar').val(info);
                        //                        alert(info);
                    });
                }
            });
            $('#add_child').click(function(e) {
                //            alert('add child');
                var template = ich.additional_child_tpl();
                $('#additional').append(template);
                e.preventDefault();
            });
        
            $('#remove_child').click(function(e) {
                //            alert('remove child');
                $('#additional').html('');
                e.preventDefault();
            });
       
            function reg_sub() {
                var avatar;
                given_name = $('#given_name').val();
                family_name = $('#family_name').val();
                var birthdate = $('#birthdate').val();
                var gender = $('#gender').val();
                var location = $('#location').val();
                email = $('#email').val();
                var vemail = $('#vemail').val();
                var password = $('#password').val();
                var vpassword = $('#vpassword').val();
                if ($('#hidden_avatar').val() == ""){
                    avatar = "reg-profile.png";
                } else {
                    avatar = $('#hidden_avatar').val();}
                //            alert(avatar);
            
                //                        if(given_name == "                    -Given Name-"){
                //                            alert("Please type your given name");
                //                        } else if(given_name.length == 0) {
                //                            alert("Given name cannot be empty!");
                //                        } else if(family_name == "                  -Family Name-") {
                //                            alert("Please type in your family name");
                //                        } else if(family_name.length == 0) {
                //                            alert("Family name cannot be empty!");
                //                        } else if(birthdate.length == 0) {
                //                            alert("Birth date cannot be empty!");
                //                        } else if(birthdate == "                    -Click to select date-") {
                //                            alert("Please select your birthdate");
                //                        } else if(location.length == 0) {
                //                            alert("Current Location cannot be empty!");
                //                        } else if(email.length == 0) {
                //                            alert("Email address cannot be empty!");
                //                        } else if(email != vemail) {
                //                            alert("Email addresses doesn't match!");
                //                        } else if(password.length == 0) {
                //                            alert("Password cannot be empty!");
                //                        } else if(password != vpassword) {
                //                            alert("Passwords doesn't match!");
                //                        } else if(fblike == 0) {
                //                            alert("You haven't liked mumcentre yet! :)");
                //                        } else {
                
            
                $.post("register/submit", {
                    given_name: given_name,
                    family_name: family_name,
                    birthdate: birthdate,
                    gender: gender,
                    location: location,
                    email_add: email,
                    vemail: vemail,
                    password: password,
                    vpassword: vpassword,
                    avatar: avatar
                },
                function(data){
                    //                            alert(data);
                    var rurl = data.split(":");
                    var code = rurl[0];
                    var msg = rurl[1];
                    if (code < 0) {
                        alert(msg);
                    } else {
                        alert(msg);
                    }
            
                });
                $('#reg-body-cont').css('display','none');
                $('#reg-body-cont2').css('display','block');
                //                        }
               
            }
            $('#form_reg2').submit(function(e) {
                //            var chkterms = 0;
                //            if(document.form_reg2.terms.checked == true){
                //                chkterms = 1;
                //            }
                //            if (chkterms == 0) {
                //                alert("You must accept the terms and conditions to continue");
                //            }      
                //            //            alert(chkterms);
                //            else {
                $('#reg-body-cont2').css('display','none');
                $('#reg-body-cont3').css('display','block');
                //                location.href="#";
                e.preventDefault();
                //            }
            });
            $('#reg_account3').click(function(e) {
                $('#reg-body-cont3').css('display','none');
                $('#reg-body-cont4').css('display','block');
                //            location.href="#";
                e.preventDefault();
            });
            //-----------------custom mail sender-------------------------        
            $('#send_mail1').click(function(e) {
                //            var email1 = $('#email1').val();
                //            var email2 = $('#email2').val();
                //            var email3 = $('#email3').val();
                //            var email4 = $('#email4').val();
                //            var email5 = $('#email5').val();
                $('#sendbutton').html('');
                $('#sendbutton').append('<img src="assets/img/system/loading.gif" alt="Loading" id="loading" /> Sending...');
                var email_adds = $('#email_adds').val();
                var email_subject = $('#email_subject').val();
                var email_body = $('#email_body').val();
                var em = '';
                if ($('#sendtoself:checked').val() !== undefined) {
                    em = $('#email').val();
                }
                //            alert(email_adds);
                //            alert(email1);
                //            alert(email2);
                //            alert(email3);
                //            alert(email4);
                //            alert(email5);
                //            alert(email_subject);
                //            alert(email_body);
                $.post("register/manual_invite", {
                    sender_email: em,
                    email_adds: email_adds,
                    email_subject: email_subject,
                    email_body: email_body,
                    sender: given_name+" "+family_name
                },
                function(data){
                    //                                                            alert(data);
                    var rurl = data.split(":");
                    var code = rurl[0];
                    var msg = rurl[1];
                    if (code < 0) {
                        alert(msg);
                    } else {
                        alert(msg);
                    }
                    $('#sendbutton').html('');
                    $('#sendbutton').append('<a href="#" id="send_mail1"><img src="assets/img/system/reg-sendEmail.png" alt="Loading" id="loading" /></a>');
                });
            
                e.preventDefault();
            });
            //-----------------custom mail sender end-------------------------


            //-------------------FB Like validator------------------------------        
            FB.Event.subscribe('edge.create', function(href, widget) {
                //            alert('Thanks for liking!');
                fblike = 1;
            });
        
            FB.Event.subscribe('edge.remove', function(href, widget) {
                //            alert('Thanks for liking!');
                fblike = 0;
            });
            //-------------------FB Like validator end------------------------------    

            //-------------------Google IP locator------------------------------                   
                    if(google.loader.ClientLocation)
            		{
            			visitor_lat = google.loader.ClientLocation.latitude;
            			visitor_lon = google.loader.ClientLocation.longitude;
            			visitor_city = google.loader.ClientLocation.address.city;
            			visitor_region = google.loader.ClientLocation.address.region;
            			visitor_country = google.loader.ClientLocation.address.country;
            			visitor_countrycode = google.loader.ClientLocation.address.country_code;
            			var loc = visitor_city + ', ' + visitor_region + ', ' + visitor_country + ' (' + visitor_countrycode + ')';
                                    $('#location').val('');
                                    $('#location').val(loc);
                            }
            		else
            		{
            			$('#location').val('wew');
                    	}
            //-------------------Google IP locator------------------------------

				
            //-------------------validation------------------------------
//            $.tools.validator.addEffect("wall", function(errors, event) {
//
//                // get the message wall
//                var wall = $(this.getConf().container).fadeIn();
//
//                // remove all existing messages
//                wall.find("p").remove();
//
//                // add new ones
//                $.each(errors, function(index, error) {
//                    wall.append(
//                    "<p><strong>" +error.input.attr("name")+ "</strong> " +error.messages[0]+ "</p>"
//                );		
//                });
//
//                // the effect does nothing when all inputs are valid	
//            }, function(inputs)  {
//
//            });

            $("#form_reg").validator(
            {
//                effect: 'wall', 
//                container: '#errors',
//
                // do not validate inputs when they are edited
//                errorInputEvent: null
//
                // custom form submission logic  
            }
            ).submit(function(e)  { 
//                // when data is valid 
                if (!e.isDefaultPrevented()) {
                    // tell user that everything is OK
//                    //                          $("#errors").html("<h2>All good</h2>");
//                    //                          reg_sub();
                    $('#reg-body-cont').css('display','none');
                    $('#reg-body-cont3').css('display','block');
                    // prevent the form data being submitted to the server
                    e.preventDefault();
                } 
//
            }
            );
            //-------------------------validation end----------------------------------------    		
        });
    </script>
    <script type="text/javascript">
            
        function send_mail(){
//            alert('potek');
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
                $.post("register/manual_invite", {
                    sender_email: em,
                    email_adds: email_adds,
                    email_subject: email_subject,
                    email_body: email_body,
                    sender: given_name+" "+family_name
                },
                function(data){
                    //                                                            alert(data);
                    var rurl = data.split(":");
                    var code = rurl[0];
                    var msg = rurl[1];
                    if (code < 0) {
                        alert(msg);
                    } else {
                        alert(msg);
                    }
                    $('#sendbutton').html('');
                    $('#sendbutton').append('<a href="#" id="send_mail1"><img src="assets/img/system/reg-sendEmail.png" alt="Loading" id="loading" /></a>');
                });
        }

    </script>
    <style type="text/css">
        .error {
        font-style: italic;
        margin: 0 0 10px;
        font-family: 'ComfortaaRegular', Arial, Helvetica, sans-serif;
	color: #9F7EA7;
	font-weight: normal;

	/* CSS3 spicing for mozilla and webkit */
/*	-moz-border-radius:4px;
	-webkit-border-radius:4px;
	-moz-border-radius-bottomleft:0;
	-moz-border-radius-topleft:0;
	-webkit-border-bottom-left-radius:0;
	-webkit-border-top-left-radius:0;

	-moz-box-shadow:0 0 6px #ddd;
	-webkit-box-shadow:0 0 6px #ddd;*/
}
    </style>

    <div id="reg-body-cont" class="form-basic">
        <div class="reg-header">
            <h1 class="fleft">Registration</h1>
            <div class="stepCount fright">Step 1 of 3</div>
        </div><!-- .reg-header -->
        <div class="reg-cont">
            <div class="reg-cont-form">
                <h2>Basic Information</h2>
                <p class="note">Fields marked with an asterisk (*) are required</p>

                <form id="form_reg" name="form_reg">
                    <fieldset>
                        <p>
                            <label for="given_name">My Given Name is</label>
                            <input type="text" name="given_name" id="given_name" class="" required="required">
                        </p>
                        <p>
                            <label for="family_name">My Family Name is</label>
                            <input type="text" name="family_name" id="family_name" class="" required="required">
                        </p>
                        <p>
                            <label for="birthdate">My Birthday</label>
                        <div><input type="text" name="birthdate" id="birthdate" required="required"></div>
                        </p>
                        <p>
                            <label for="select-gender">My Gender</label>
                            <select name="select-gender" class="gender" id="gender">
                                <option value="1">female</option>
                                <option value="2">male</option>
                            </select>
                        </p>
                        <p>
                            <label for="location">Current Location</label>
                            <input type="text" name="location" id="location" class="" required="required">
                        </p>
                        <p>
                            <label for="email">Email Address</label>
                            <input type="text" name="email" id="location" class="" required="required">
                        </p>
                        <p>
                            <label for="vemail">Verify Email Address</label>
                            <input type="text" name="vemail" id="vemail" class="" required="required">
                        </p>
                        <p>
                            <label for="password">Enter Your Password</label>
                            <input type="password" name="password" id="password" class="" required="required">
                        </p>
                        <p>
                            <label for="vpassword">Verify Your Password</label>
                            <input type="password" name="vpassword" id="vpassword" class="" required="required">
                        </p>
                        <div class="clear">
                            <p class="label">Don't Forget</p>
                            <div id="DF-LikeUs">
                                <div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=234749426571005&amp;xfbml=1"></script><fb:like href="https://www.facebook.com/MumCentre.Singapore" send="false" layout="" width="80" show_faces="false" font=""></fb:like>
                            </div>
                        </div>
                        <div class="clear">
                            <p class="label">Upload Photo</p>

                            <div class="upav-contain">
                                <img id="avatar" src="assets/img/system/reg-profile.jpg" id="avatar" width="170" height="170"/>
                                <p class="note">Select an image file on your computer (4MB max):</p>
                                <div id="browse-but-cont">
                                    <input type="file" name="Filedata" value="" id="upload" style="display: none; " width="83" height="25" />

                                    <a href="javascript:$('#upload').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>
                                </div>
                                <div id="fileQueue"></div>
                                <input type="hidden" id="hidden_avatar" />
                            </div>
                        </div>
                    </fieldset>
                    <p class="clear"><input type="submit" value="submit" /></p>
                </form>

            </div><!-- .reg-cont-form -->
        </div><!-- .reg-cont -->
    </div><!-- .reg-body-cont -->
    <div id="reg-body-cont2" class="form-child">
        <div class="reg-header">
            <h1 class="fleft">Registration</h1>
            <div class="stepCount fright">Step 2 of 3</div>
        </div><!-- .reg-header -->
        <div class="reg-cont">
            <div class="reg-cont-form">
                <h2>Children</h2>

                <form id="form_reg2" name="form_reg2" method="post" action="/">
                    <fieldset>
                        <div>
                            <label for="Email">First Name</label>
                            <input type="text" name="Email" id="Email" class="" />
                        </div>
                        <div>
                            <label for="select">Gender</label>
                            <select name="select" class="">
                                <option value="female">female</option>
                                <option value="male">male</option>
                            </select>
                        </div>
                        <div>
                            <label for="birthdate_kid">Birthday</label>
                            <input type="text" name="birthdate_kid" id="birthdate_kid" class="hasDatepicker" value="-Click to select date-"/>
                        </div>
                        <div>
                            <div id="additional"></div>
                            <div class="reg2-chilren-but">
                                <a href="http://www.mumcentre.com.au/newmc/mumcentre/#" id="add_child"><?= img('system/reg-addChildren.png'); ?></a> 
                                <a href="http://www.mumcentre.com.au/newmc/mumcentre/#" id="remove_child">
                                    <?= img('system/reg-removeChild.png'); ?> </a>
                            </div>
                        </div>
                        <div>
                            <label for="selectpreg">Pregnant</label>
                            <select name="selectpreg" class="reg2-yes-no-image" id="selectpreg">
                                <option value="no">no</option>
                                <option value="yes">yes</option>
                            </select> 
                        </div>
                        <div>
                            <label for="birthdate">Due Date</label>
                            <input type="text" name="duedate" id="duedate" class="text-ep-textinput hasDatepicker" value="-Click to select date-">
                        </div>
                    </fieldset>
                    <fieldset>
                        <h3>Subscription Management</h3>
                        <div>
                            <label>&nbsp;</label>
                            <p class="option">Subscribe</p>
                            <p class="option">Unsubscribe</p>
                        </div>
                        <div>
                            <label>Weekly Newsletter</label>
                            <p class="option"><input name="weeklyNewsletter" type="radio" value="on" checked=""></p>
                            <p class="option"><input name="weeklyNewsletter" type="radio" value="off"></p>
                        </div>
                        <div>
                            <label>Weekend Planner</label>
                            <p class="option"><input name="weekendPlanner" type="radio" value="on" checked=""></p>
                            <p class="option"><input name="weekendPlanner" type="radio" value="off"></p>
                        </div>
                        <div><label>Partner News</label>
                            <p class="option"><input name="partnerNews" type="radio" value="on" checked=""></p>
                            <p class="option"><input name="partnerNews" type="radio" value="off"></p>
                        </div>
                        <div><label>Pic of the Week Results</label>
                            <p class="option"><input name="PoWResults" type="radio" value="on" checked=""></p>
                            <p class="option"><input name="PoWResults" type="radio" value="off"></p>
                        </div>
                        <div class="cat"><label>Mum's Helper Email&nbsp;&nbsp;</label>
                            <p class="option"></p>
                            <p class="option"></p>
                        </div>
                        <div><label>Pregnancy Guide</label>
                            <p class="option"><input name="PregnancyGuide" type="radio" value="on" checked=""></p>
                            <p class="option"><input name="PregnancyGuide" type="radio" value="off"></p>
                        </div>
                        <div><label>Parent-Child Development Guide</label>
                            <p class="option"><input name="ParentChildDevelopmentGuide" type="radio" value="on" checked=""></p>
                            <p class="option"><input name="ParentChildDevelopmentGuide" type="radio" value="off"></p>
                        </div>
                        <div><label>Vacation Guide</label>
                            <p class="option"><input name="VacationGuide" type="radio" value="on" checked=""></p>
                            <p class="option"><input name="VacationGuide" type="radio" value="off"></p>
                        </div>
                        <div><label>Birthday Planner</label>
                            <p class="option"><input name="BirthdayPlanner" type="radio" value="on" checked=""></p>
                            <p class="option"><input name="BirthdayPlanner" type="radio" value="off"></p>
                        </div>	
                    </fieldset>
                    <div class="terms">
                        <input name="Terms&amp;condition" id="terms" type="checkbox" value="IAgree">&nbsp; I agree to the <a href="http://www.mumcentre.com.au/newmc/mumcentre/#" class="blue">terms and conditions</a>
                    </div>
                    <p class="clear"><input type="submit" value="submit" /></p>
                </form>

            </div><!-- .reg-cont-form -->
        </div><!-- .reg-cont -->
    </div><!-- #reg-body-cont2 -->
    <div id="reg-body-cont3" class="form-invite">
        <div class="reg-header">
            <h1 class="fleft">Registration</h1>
            <div class="stepCount fright">Step 3 of 3</div>
        </div><!-- .reg-header -->
        <div class="reg-cont">
            <div class="reg-cont-form">
                <h2>Invite Friends</h2>

                <form id="form1" name="form1" method="post" action="">
                    <fieldset>
                        <h3>Send E-mail</h3>

                        <div class="row">
                            <div class="col-half fleft">
                                <p><strong>Enter your friends' e-mail Addresses separated by a comma:</strong></p>
                                <textarea id="email_adds" name="email_adds" style="height: 270px; " class="textbox-bg"></textarea>
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
                        <div class="row acenter">
                            <a href="http://www.mumcentre.com.au/newmc/mumcentre/#">
                                <?= img('system/reg-FBpost.png'); ?></a>
                        </div> <!--- end of row -->
                    </fieldset>
                    <fieldset>
                        <h3>Use Address Book</h3>
                        <div class="row">
                            <div class="col-half fleft">
                                <p>Find your friends using your Address Book:</p>
                                <div class="reg3column-row">
                                    <?= img('system/reg-temp-AB.png'); ?>
                                </div>
                            </div>
                            <div class="col-half fleft">
                                <?= img('system/reg-temp-gmail.png'); ?>
                            </div>
                        </div> <!--- end of row -->
                    </fieldset>
                    <div class="acenter">
                        <a href="http://www.mumcentre.com.au/newmc/mumcentre/#" id="reg_account3"><?= img('system/reg-finish.png'); ?></a>    
                    </div>
                </form>

            </div><!-- .reg-cont-form -->
        </div><!-- .reg-cont -->
    </div><!-- #reg-body-cont3 -->
    <div id="reg-body-cont4" class="form-thanks">
        <div class="reg-header">
            <h1 class="fleft">Registration</h1>
        </div><!-- .reg-header -->
        <div class="reg-cont">
            <div class="reg-cont-form">
                <div class="row acenter">
                    <h2 class="huge">THANK YOU FOR REGISTERING!</h2>
                </div>	
                <div class="row">
                    <div class="row-container">
                        <div class="columnL fleft">
                            <h3 class="acenter">What would you like to do on MumCentre now?</h3>
                            <ul>
                                <li>
                                    <a href="http://www.mumcentre.com.au/newmc/mumcentre/#" class="regLF">Return to Entry Page</a>
                                </li>
                                <li>
                                    <a href="http://www.mumcentre.com.au/newmc/mumcentre/#" class="regLF">Enter Pic of the Week</a>
                                </li>
                                <li>
                                    <a href="http://www.mumcentre.com.au/newmc/mumcentre/#" class="regLF">Create a Photo Blog</a>
                                </li>
                                <li>
                                    <a href="http://www.mumcentre.com.au/newmc/mumcentre/#" class="regLF">Go to Forums</a>
                                </li>
                                <li>
                                    <a href="http://www.mumcentre.com.au/newmc/mumcentre/#" class="regLF">Home Page</a>
                                </li>
                            </ul>	
                        </div> <!--- end of reg4-row-container-columnL -->
                        <div class="columnR fleft">
                            <h3 class="acenter"><?= img('system/reg-alert.png'); ?>&nbsp;Set-up your Alerts now</h3>
                            <form action="" method="get">
                                <div>
                                    <label>&nbsp;</label>
                                    <p class="option">Yes</p>
                                    <p class="option">No</p>
                                </div>
                                <div>
                                    <label>Newsletter</label>
                                    <p class="option"><input name="" type="checkbox" value="newsletter" checked=""></p>
                                    <p class="option"><input name="" type="checkbox" value="newsletter"></p>
                                </div>
                                <div>
                                    <label>Group forum member post</label>
                                    <p class="option"><input name="" type="checkbox" value="newsletter" checked=""></p>
                                    <p class="option"><input name="" type="checkbox" value="newsletter"></p>
                                </div>
                                <div>
                                    <label>New article published that is related to your subscriptions</label>
                                    <p class="option"><input name="" type="checkbox" value="newsletter" checked=""></p>
                                    <p class="option"><input name="" type="checkbox" value="newsletter"></p>
                                </div>
                                <div>
                                    <label>New forum published that is related to your subscriptions</label>
                                    <p class="option"><input name="" type="checkbox" value="newsletter" checked=""></p>
                                    <p class="option"><input name="" type="checkbox" value="newsletter"></p>
                                </div>
                                <div>
                                    <label>Pic of the week entry vote</label>
                                    <p class="option"><input name="" type="checkbox" value="newsletter" checked=""></p>
                                    <p class="option"><input name="" type="checkbox" value="newsletter"></p>
                                </div>
                                <div>
                                    <label>Pic of the week winner</label>
                                    <p class="option"><input name="" type="checkbox" value="newsletter" checked=""></p>
                                    <p class="option"><input name="" type="checkbox" value="newsletter"></p>
                                </div>
                                <div>
                                    <label>Deal of the day</label>
                                    <p class="option"><input name="" type="checkbox" value="newsletter" checked=""></p>
                                    <p class="option"><input name="" type="checkbox" value="newsletter"></p>
                                </div>
                                <div>
                                    <label>Mum coins update</label>
                                    <p class="option"><input name="" type="checkbox" value="newsletter" checked=""></p>
                                    <p class="option"><input name="" type="checkbox" value="newsletter"></p>
                                </div>
                                <div>
                                    <label>New Events</label>
                                    <p class="option"><input name="" type="checkbox" value="newsletter" checked=""></p>
                                    <p class="option"><input name="" type="checkbox" value="newsletter"></p>
                                </div>
                                <div>
                                    <label>New Courses</label>
                                    <p class="option"><input name="" type="checkbox" value="newsletter" checked=""></p>
                                    <p class="option"><input name="" type="checkbox" value="newsletter"></p>
                                </div>
                                <div>
                                    <label>Latest Reviews</label>
                                    <p class="option"><input name="" type="checkbox" value="newsletter" checked=""></p>
                                    <p class="option"><input name="" type="checkbox" value="newsletter"></p>
                                </div>
                                <div>
                                    <label>&nbsp;</label>
                                    <p class="option"><input name="" type="checkbox" value="newsletter" checked="">&nbsp;Check All</p>
                                    <p class="option"><input name="" type="checkbox" value="newsletter">Uncheck All</p>
                                </div>
                                <div>
                                    <p class="col-half fleft"><?= img('system/Reg-Pencil.png'); ?>&nbsp;<a href="http://www.mumcentre.com.au/newmc/mumcentre/#">Customize settings</a></p>
                                    <p class="col-half"><?= img('system/Reg-check.png'); ?>&nbsp;This is your current settings</p>
                                </div>
                            </form>
                        </div> <!--- end of reg4-row-container-columnR -->
                    </div> <!--- end of row-container -->
                </div> <!--- end of row -->      	
            </div>
        </div> <!--- end of reg-cont -->
    </div>
    <?= render_partial('global/default_footer'); ?>
