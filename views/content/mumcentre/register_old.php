<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi?key=ABQIAAAAMhR58V4QNsdVy96Os_BDNhSlSGdp3IxvsPTYa9f_4IaFlS3_4xT2WP2oIsO4gnJe_QD5WOmJwbTatg
"></script>
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
            'folder'        : 'uploads/avatar',
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
       
//        $('#reg_account').click(function(e) {
//            var avatar;
//            given_name = $('#given_name').val();
//            family_name = $('#family_name').val();
//            var birthdate = $('#birthdate').val();
//            var gender = $('#gender').val();
//            var location = $('#location').val();
//            var email = $('#email').val();
//            var vemail = $('#vemail').val();
//            var password = $('#password').val();
//            var vpassword = $('#vpassword').val();
//            if ($('#hidden_avatar').val() == ""){
//             avatar = "reg-profile.png";
//            } else {
//            avatar = $('#hidden_avatar').val();}
////            alert(avatar);
//            
////                        if(given_name == "                    -Given Name-"){
////                            alert("Please type your given name");
////                        } else if(given_name.length == 0) {
////                            alert("Given name cannot be empty!");
////                        } else if(family_name == "                  -Family Name-") {
////                            alert("Please type in your family name");
////                        } else if(family_name.length == 0) {
////                            alert("Family name cannot be empty!");
////                        } else if(birthdate.length == 0) {
////                            alert("Birth date cannot be empty!");
////                        } else if(birthdate == "                    -Click to select date-") {
////                            alert("Please select your birthdate");
////                        } else if(location.length == 0) {
////                            alert("Current Location cannot be empty!");
////                        } else if(email.length == 0) {
////                            alert("Email address cannot be empty!");
////                        } else if(email != vemail) {
////                            alert("Email addresses doesn't match!");
////                        } else if(password.length == 0) {
////                            alert("Password cannot be empty!");
////                        } else if(password != vpassword) {
////                            alert("Passwords doesn't match!");
////                        } else if(fblike == 0) {
////                            alert("You haven't liked mumcentre yet! :)");
////                        } else {
//                
//            
//                            $.post("register/submit", {
//                                given_name: given_name,
//                                family_name: family_name,
//                                birthdate: birthdate,
//                                gender: gender,
//                                location: location,
//                                email: email,
//                                vemail: vemail,
//                                password: password,
//                                vpassword: vpassword,
//                                avatar: avatar
//                            },
//                            function(data){
//                                //                            alert(data);
//                                var rurl = data.split(":");
//                                var code = rurl[0];
//                                var msg = rurl[1];
//                                if (code < 0) {
//                                    alert(msg);
//                                } else {
//                                    alert(msg);
//                                }
//            
//                           });
//                           $('#reg-body-cont').css('display','none');
//                           $('#reg-body-cont2').css('display','block');
////                        }
//               
//            
//            e.preventDefault();
//        });
        $('#reg_account2').click(function(e) {
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
        
        $('#send_mail1').click(function(e) {
            var email1 = $('#email1').val();
            var email2 = $('#email2').val();
            var email3 = $('#email3').val();
            var email4 = $('#email4').val();
            var email5 = $('#email5').val();
            var email_subject = $('#email_subject').val();
            var email_body = $('#email_body').val();
//            alert(email1);
//            alert(email2);
//            alert(email3);
//            alert(email4);
//            alert(email5);
//            alert(email_subject);
//            alert(email_body);
                            $.post("register/manual_invite", {
                                email1: email1,
                                email2: email2,
                                email3: email3,
                                email4: email4,
                                email5: email5,
                                email_subject: email_subject,
                                email_body: email_body,
                                sender: given_name+" "+family_name
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
            
            e.preventDefault();
        });
        
        FB.Event.subscribe('edge.create', function(href, widget) {
            //            alert('Thanks for liking!');
            fblike = 1;
        });
        
        FB.Event.subscribe('edge.remove', function(href, widget) {
            //            alert('Thanks for liking!');
            fblike = 0;
        });
        
//        if(google.loader.ClientLocation)
//		{
//			visitor_lat = google.loader.ClientLocation.latitude;
//			visitor_lon = google.loader.ClientLocation.longitude;
//			visitor_city = google.loader.ClientLocation.address.city;
//			visitor_region = google.loader.ClientLocation.address.region;
//			visitor_country = google.loader.ClientLocation.address.country;
//			visitor_countrycode = google.loader.ClientLocation.address.country_code;
//			var loc = visitor_city + ', ' + visitor_region + ', ' + visitor_country + ' (' + visitor_countrycode + ')';
//                        $('#location').val('');
//                        $('#location').val(loc);
//                }
//		else
//		{
//			$('#location').val('wew');
//		}
//-------------------validation------------------------------
        $.tools.validator.addEffect("wall", function(errors, event) {

	// get the message wall
	var wall = $(this.getConf().container).fadeIn();
	
	// remove all existing messages
	wall.find("p").remove();
	
	// add new ones
	$.each(errors, function(index, error) {
		wall.append(
			"<p><strong>" +error.input.attr("name")+ "</strong> " +error.messages[0]+ "</p>"
		);		
	});
	
        // the effect does nothing when all inputs are valid	
        }, function(inputs)  {

        });
        
        $("#form_reg").validator({
           effect: 'wall', 
           container: '#errors',

           // do not validate inputs when they are edited
           errorInputEvent: null

        // custom form submission logic  
        }).submit(function(e)  { 

           // when data is valid 
           if (!e.isDefaultPrevented()) {

              // tell user that everything is OK
              $("#errors").html("<h2>All good</h2>");

              // prevent the form data being submitted to the server
              e.preventDefault();
           } 

        });
    		
    });
</script>
<style type="text/css">
    #errors {
	background-color:#163356;
	color:#9F7EA7;
	width:500px;
	padding-top:20px;
	margin:5px auto;
        float: left;
	display:none;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;			
    }
</style>
<div id="reg-body-cont">
    <div id="reg-header-container">
        <div id="reg-header-head"><?= img('system/registration.png'); ?></div>
        <div id="reg-header-page">Step 1 of 3</div>
    </div>
    <div id="reg-cont">
        <div id="reg-cont-body">
            <div id="reg-cont-body-toptext"><hr1>Basic Information</hr1><br>
                <hr2>Fields marked with an asterisk (*) are required</hr2>
            </div>
            <div id="reg-cont-body-body">
                <form id="form_reg" name="form_reg" method="post" action="register/submit">
                    <div id="column1-text">
                        <div class="text-space1L"><?php echo form_error('given_name'); ?>My Name is</div>
                        <div class="text-space1L"><?php echo form_error('birthdate'); ?>My Birthday</div>
                        <div class="text-space2L"><?php echo form_error('location'); ?>Current<br />Location</div>
                        <div class="text-space2L"><?php echo form_error('email'); ?>E-mail<br />Address</div>
                        <div class="text-space2L"><?php echo form_error('password'); ?>Enter your<br />Password</div>
                        <div class="text-space1LSp">Don't Forget*</div>
                    </div>
                    <div id="column2-formtext">
                        <div class="form-row">
                            <div id="basic-gname">
                                <div class="box-left"></div>
                                <div class="name"><label for="given_name"></label>
                                    <input type="text" name="given_name" id="given_name" class="name-textinput" value="<?php echo set_value('given_name'); ?>" /></div>
                                <div class="box-right"></div>
                            </div>    
                            <div id="basic-fname">
                                <div class="box-left"></div>
                                <div class="name"><label for="family_name"></label>
                                    <input type="text" name="family_name" id="family_name" class="name-textinput" value="<?php echo set_value('family_name'); ?>" /></div>
                                <div class="box-right"></div>   
                            </div><?php echo form_error('family_name'); ?>
                        </div>
                        <div class="form-row">
                            <div class="basic-ep">
                                <!--                                <div id="basic-bday-day">-->
                                <div class="box-left"></div>
                                <div class="text-ep"><label for="birthdate"></label>
                                    <input type="text" name="birthdate" id="birthdate" class="text-ep-textinput" value="<?php echo set_value('birthdate'); ?>"/></div>

                                <!--                                </div>-->
                                <div class="box-right"></div> 
                            </div>


                            <div class="text2-space1L">Gender</div>
                            <div id="basic-gender">
                                <div id="basic-box-gender">
                                    <select name="select" class="gender" id="gender">
                                        <option value="1">female</option>
                                        <option value="2">male</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div id="basic-cloc">
                                <div class="box-left"></div>
                                <div class="currentL">
                                    <label for="Location"></label>
                                    <input type="text" name="location" id="location" class="currentL-textinput" value="<?php echo set_value('location'); ?>"/>
                                </div>
                                <div class="box-right"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="basic-ep">
                                <div class="box-left"></div>
                                <div class="text-ep"><label for="email"></label>
                                    <input type="text" name="email" id="email" class="text-ep-textinput" value="<?php echo set_value('email'); ?>"/>
                                </div>
                                <div class="box-right"></div>
                            </div>
                            <div id="V-email">
                                <div class="text2-space2L"><?php echo form_error('vemail'); ?>Verify E-mail<br />Address</div> 
                                <div class="basic-Vep">
                                    <div class="box-left"></div>
                                    <div class="text-ep"><label for="vemail"></label>
                                        <input type="text" name="vemail" id="vemail" class="text-ep-textinput" value="<?php echo set_value('vemail'); ?>"/>
                                    </div>
                                    <div class="box-right"></div>
                                </div>
                            </div>
                        </div>   
                        <div class="form-row"> 
                            <div class="basic-ep">
                                <div class="box-left"></div>
                                <div class="text-ep"><label for="password"></label>
                                    <input type="password" name="password" id="password" class="text-ep-textinput" value="<?php echo set_value('password'); ?>"/>
                                </div>
                                <div class="box-right"></div>
                            </div>
                            <div class="text2-space2L"><?php echo form_error('vpassword'); ?>Verify your<br />
                                Password</div> 
                            <div class="basic-Vep">
                                <div class="box-left"></div>
                                <div class="text-ep"><label for="vpassword"></label>
                                    <input type="password" name="vpassword" id="vpassword" class="text-ep-textinput" <?php echo set_value('vpassword'); ?>/>
                                </div>
                                <div class="box-right"></div>
                            </div>
                        </div>
                        <div class="form-rowDF">
                            <div id="DF-LikeUs">
                                <div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=234749426571005&amp;xfbml=1"></script><fb:like href="https://www.facebook.com/MumCentre.Singapore" send="false" layout="" width="80" show_faces="false" font=""></fb:like>
                            </div>
                        </div>
                    </div>
                    <!-- Upload Photo -->
                    <div id="errors">
                        <h2>Oops...</h2>
                    </div>
                    <div id="pictureuploadContain">
                        <div class="upav-contain">	
                            <div id="upload-contain">
                                <div class="text3-space1L">Upload Picture</div>
                                <div id="avatar-container">
                                    <img src="assets/img/system/reg-profile.jpg" id="avatar" width="170" height="170"/>
                                </div>
                            </div>
                        </div>      
                        <div class="upav-contain">
                            <div id="text-intruction"><hr3>Select an image file on your computer (4MB max):</hr3></div>
                        </div>
                        <div class="upav-contain">
                            <div id="browse-but-cont">
                                <?php echo form_upload(array('name' => 'Filedata', 'id' => 'upload')); ?>
                                <a href="javascript:$('#upload').uploadifyUpload();">
                                    <?= img('system/btn_upload.png'); ?>
                                </a>

                            </div><div id="fileQueue"></div>
                            <input type="hidden" id="hidden_avatar"/>
                        </div>

                        <div class="upav-contain">
                            <div id="but-conti">
                                <input type="image" value="submit" src="assets/img/system/reg-conti.png"/>
<!--                                <a href="#" id="reg_account">
                                    <?= img('system/reg-conti.png'); ?>
                                </a>-->
                            </div>
                        </div>
                    </div> <!-- Upload Photo ends -->
                </form>
            </div>
        </div>
    </div>
</div>

<div id="reg-body-cont2" style="display: none">
    <div id="reg-header-container">
        <div id="reg-header-head">
            <?= img('system/registration.png'); ?>
        </div>
        <div id="reg-header-page">Step 2 of 3</div>
    </div>
    <div id="reg-cont">
        <div id="reg-cont-body">
            <div id="reg2-cont-body-toptext"><hr1>Children</hr1></div>
            <div id="reg2-cont-body-body">
                <form id="form_reg2" name="form_reg2" method="post" action="">
                    <div class="reg2-CBB-Row">
                        <div class="reg2-column1-text"> <!-- text -->
                            <div class="reg2-text-space1L">First Name</div>
                            <div class="reg2-text-space1L">Birthday</div>
                        </div> 
                        <div class="reg2-column2-formtext"> <!-- forms -->
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
                                        <input type="text" name="birthdate_kid" id="birthdate_kid" class="text-ep-textinput" value="                    -Click to select date-"/></div>

                                    <!--                                </div>-->
                                    <div class="box-right"></div> 
                                </div>
                            </div> <!-- Column row end -->
                            <div id="additional"></div>
                            <div class="form-row">
                                <div class="reg2-chilren-but">
                                    <a href="#" id="add_child">
                                        <?= img('system/reg-addChildren.png'); ?>
                                    </a>
                                </div>
                                <div class="reg2-chilren-but">
                                    <a href="#" id="remove_child">
                                        <?= img('system/reg-removeChild.png'); ?>
                                    </a>
                                </div>
                            </div> <!-- Column row end -->
                        </div> <!-- end reg2 column2 formtext -->
                    </div> <!-- end reg2 cbb row -->
                    <div class="reg2-CBB-Row"> 
                        <div class="reg2-column2-formtext">    
                            <div class="reg2-form-rowsp">
                                <div class="reg2-column1-text">
                                    <div class="reg2-text-space1L">Pregnant</div>
                                </div>
                                <div class="basic-ep">
                                    <div id="reg2-yes-no">
                                        <select name="selectpreg" class="reg2-yes-no-image" id="selectpreg">
                                            <option value="no">no</option>
                                            <option value="yes">yes</option>
                                        </select> 
                                    </div>
                                </div>
                                <div class="text2-space1L">Dute Date</div>
                                <div id="basic-gender">
                                        <div class="basic-ep">
                                            <div class="box-left"></div>
                                            <div class="text-ep"><label for="birthdate"></label>
                                                <input type="text" name="duedate" id="duedate" class="text-ep-textinput" value="                    -Click to select date-"/></div>
                                            <div class="box-right"></div> 
                                        </div>
                                </div>
                            </div>  <!-- Column row end -->
                        </div> <!-- end reg2-col-formtxt -->
                    </div> <!-- end reg2 cbb- row -->
                    <div class="reg2-CBB-Row">
                        <div id="reg2-cont-body-midtext"><hr1>Subscription Management</hr1></div>
                    </div> <!-- end reg2-cbb-row -->
                    <div class="reg2-CBB-Row">
                        <div class="reg2-column2-formtextsp">
                            <div class="reg2-form-row">
                                <div id="reg2-column1-Subscrpt">
                                    <div class="submana-text-contain"></div>
                                    <div class="submana-text-contain">Weekly Newsletter</div>
                                    <div class="submana-text-contain">Weekend Planner</div>
                                    <div class="submana-text-contain">Partner News</div>
                                    <div class="submana-text-contain">Pic of the Week Results</div>
                                    <div class="submana-text-containSP">Mum's Helper Email</div>
                                    <div class="submana-text-contain">Pregnancy Guide</div>
                                    <div class="submana-text-contain">Parent-Child Development Guide</div>
                                    <div class="submana-text-contain">Vacation Guide</div>
                                    <div class="submana-text-contain">Birthday Planner</div>
                                </div>
                                <div class="reg2-column-radio">
                                    <div class="reg2-column-radio-container">Subscribe</div>
                                    <div class="reg2-column-radio-container">
                                        <input name="weeklyNewsletter" type="radio" value="on" checked />
                                    </div>
                                    <div class="reg2-column-radio-container">
                                        <input name="weekendPlanner" type="radio" value="on" checked />
                                    </div>
                                    <div class="reg2-column-radio-container">
                                        <input name="partnerNews" type="radio" value="on" checked />
                                    </div>
                                    <div class="reg2-column-radio-container">
                                        <input name="PoWResults" type="radio" value="on" checked />
                                    </div>
                                    <div class="reg2-column-radioSP-container"></div>
                                    <div class="reg2-column-radio-container">
                                        <input name="PregnancyGuide" type="radio" value="on" checked />
                                    </div>
                                    <div class="reg2-column-radio-container">
                                        <input name="ParentChildDevelopmentGuide" type="radio" value="on" checked />
                                    </div>
                                    <div class="reg2-column-radio-container">
                                        <input name="VacationGuide" type="radio" value="on" checked />
                                    </div>
                                    <div class="reg2-column-radio-container">
                                        <input name="BirthdayPlanner" type="radio" value="on" checked />
                                    </div>
                                </div> <!-- reg2-colmn-radio end -->
                                <div class="reg2-column-radio">
                                    <div class="reg2-column-radio-container">Unsuscribe</div>
                                    <div class="reg2-column-radio-container">
                                        <input name="weeklyNewsletter" type="radio" value="off" />
                                    </div>
                                    <div class="reg2-column-radio-container">
                                        <input name="weekendPlanner" type="radio" value="off" />
                                    </div>
                                    <div class="reg2-column-radio-container">
                                        <input name="partnerNews" type="radio" value="off" />
                                    </div>
                                    <div class="reg2-column-radio-container">
                                        <input name="PoWResults" type="radio" value="off" />
                                    </div>
                                    <div class="reg2-column-radioSP-container"></div>
                                    <div class="reg2-column-radio-container">
                                        <input name="PregnancyGuide" type="radio" value="off" />
                                    </div>
                                    <div class="reg2-column-radio-container">
                                        <input name="ParentChildDevelopmentGuide" type="radio" value="off" />
                                    </div>
                                    <div class="reg2-column-radio-container">
                                        <input name="VacationGuide" type="radio" value="off" />
                                    </div>
                                    <div class="reg2-column-radio-container">
                                        <input name="BirthdayPlanner" type="radio" value="off" />
                                    </div>
                                </div> <!-- reg2-colmn-radio end -->
                            </div> <!-- reg2-form-row end --> 
                            <div class="reg2-form-row">
                                <div id="termscondicontainer">
                                    <div id="checkbox-container"><input name="Terms&amp;condition" id="terms" type="checkbox" value="IAgree" /></div>
                                    <div id="textchckbox-container">I agree to the <a href="#" class="blue">terms and conditions</a></div>
                                </div> <!-- termscondiconto end -->
                            </div> <!-- reg2-colmn-radio end -->
                            <div class="reg2-form-row">
                                <div id="but-conti-2"><a href="#" id="reg_account2">
                                        <?= img('system/reg-conti.png'); ?>
                                    </a>

                                </div>
                            </div> <!-- reg2-colmn-radio end -->
                            <!-- Column row end -->
                        </div> <!-- end column-form text -->
                    </div>
                </form>
            </div> <!--- end of reg-cont-body-body -->
            </form>
        </div> 
        <!--- end of reg-cont-body-body -->
    </div> <!--- end of reg-cont-body -->
</div> <!--- end of reg-cont -->
<!--</div>-->

<div id="reg-body-cont3" style="display: none">
    <div id="reg-header-container">
        <div id="reg-header-head">
            <?= img('system/registration.png'); ?>
        </div>
        <div id="reg-header-page">Step 3 of 3</div>
    </div>
    <div id="reg-cont">
        <div id="reg-cont-body3">
            <div id="reg2-cont-body-toptext"><hr1>Invite Friends</hr1></div>
            <div id="reg2-cont-body-body">
                <form id="form1" name="form1" method="post" action="">
                    <div class="reg3-container">
                        <div class="reg3-header"><strong>Send E-mail</strong></div>
                        <div class="reg3-row-spacer"></div>
                        <div class="reg3-row">
                            <div class="reg3columnL">
                                <div class="reg3column-row">
                                    <R3h><strong>Enter your friends' e-mail Adresses:</strong></R3h>
                                </div>
                                <div class="reg3column-row">
                                    <div class="reg3column-columnL">
                                        <div class="reg3column-column-boxL">Email 1</div>
                                        <div class="reg3column-column-boxL">Email 2</div>
                                        <div class="reg3column-column-boxL">Email 3</div>
                                        <div class="reg3column-column-boxL">Email 4</div>
                                        <div class="reg3column-column-boxL">Email 5</div>
                                    </div> <!--- end of reg3column-columnL -->
                                    <div class="reg3column-columnR">
                                        <div class="reg3column-column-boxR">
                                            <input id="email1" name="email1" type="text" value="" size="30" />
                                        </div> <!--- end of reg3column-column-box -->
                                        <div class="reg3column-column-boxR">
                                            <input id="email2" name="email2" type="text" value="" size="30" />
                                        </div> <!--- end of reg3column-column-box -->
                                        <div class="reg3column-column-boxR">
                                            <input id="email3" name="email3" type="text" value="" size="30" />
                                        </div> <!--- end of reg3column-column-box -->
                                        <div class="reg3column-column-boxR">
                                            <input id="email4" name="email4" type="text" value="" size="30" />
                                        </div> <!--- end of reg3column-column-box -->
                                        <div class="reg3column-column-boxR">
                                            <input id="email5" name="email5" type="text" value="" size="30" />
                                        </div> <!--- end of reg3column-column-box -->
                                    </div> <!--- end of reg3column-columnR -->
                                </div> <!--- end of reg3column-row -->
                            </div>  <!--- end of reg3columnL -->
                            <div class="reg3columnR">
                                <div class="reg3column-row">
                                    <R3h><strong>Set the e-mail message:</strong></R3h>
                                </div>
                                <div class="reg3column-row"></div>
                                <div class="reg3column-row">
                                    <div class="reg3column-columnL">
                                        <div class="reg3column-column-boxL">Subject</div>
                                        <div class="reg3column-column-boxL">Message</div>
                                    </div> <!--- end of reg3column-columnL -->
                                    <div class="reg3column-columnR">
                                        <div class="reg3column-column-boxR">
                                            <input id="email_subject" name="email_subject" type="text" value="Check out this neat website I came across" size="40" />
                                        </div> <!--- end of reg3column-column-box -->
                                        <div class="reg3column-column-boxR-chatbox">
                                            <textarea id="email_body" name="email_body" cols="30" rows="5" class="textbox-bg">Hello!

Check out this neat website I came across. You can find it <a href="http://www.mumcentre.com.sg" target="_blank">here</a>.

Truly,
your name</textarea>
                                        </div> <!--- end of reg3column-column-box -->
                                        <div class="reg3column-column-boxR">
                                            <input name="Email to me" type="checkbox" value="" checked />
                                    	Send a copy of this email to myself
                                        </div> 
                                        <!--- end of reg3column-column-box -->
                                        <div class="reg3column-column-boxR">
                                            <div class="reg3-sendE">
                                                <a href="#" id="send_mail1">
                                                    <?= img('system/reg-sendEmail.png'); ?>
                                                </a>
                                            </div>
                                        </div> 
                                        <!--- end of reg3column-column-box -->
                                    </div> <!--- end of reg3column-columnR -->
                                </div> <!--- end of reg3column-row -->
                            </div> <!--- end of reg3columnR -->
                        </div> <!--- end of reg3-row -->
                        <div class="reg3-row">
                            <div class="reg3-rowcenter-FBcontainer">
                                <a href="#">
                                    <?= img('system/reg-FBpost.png'); ?>
                                </a>
                            </div>
                        </div> <!--- end of reg3-row -->
                    </div>  <!--- end of reg3-container -->
                    <div class="reg3-container">
                        <div class="reg3-header"><strong>Use Address Book</strong></div>
                        <div class="reg3-row">
                            <div class="reg3-row-spacer"></div>
                            <div class="reg3columnL">
                                <div class="reg3column-row">
                                    <R3h><strong>Find your friends using your Address Book:</strong></R3h>
                                </div>
                                <div class="reg3column-row">
                                    <div class="reg3-Addresbook">
                                        <?= img('system/reg-temp-AB.png'); ?>
                                    </div>
                                </div>
                            </div>  <!--- end of reg3columnL -->
                            <div class="reg3columnR">
                                <div class="reg3column-row">
                                    <?= img('system/reg-temp-gmail.png'); ?>
                                </div>
                            </div> <!--- end of reg3columnR -->
                        </div> <!--- end of reg3-row -->
                        <div class="reg3-row">
                        </div> <!--- end of reg3-row -->
                    </div>  <!--- end of reg3-container -->
                    <div class="reg3-container">
                        <div id="finreg">
                            <a href="#" id="reg_account3">
                                <?= img('system/reg-finish.png'); ?>
                            </a>    
                        </div>
                    </div>  <!--- end of reg3-container -->
                </form>
            </div> 
            <!--- end of reg-cont-body-body -->
        </div> <!--- end of reg-cont-body -->
    </div> <!--- end of reg-cont -->
</div>

<div id="reg-body-cont4" style="display: none">
    <div id="reg-header-container">
        <div id="reg-header-head">
            <?= img('system/registration.png'); ?>
        </div>
    </div>
    <div id="reg4-cont">
        <div id="reg-cont-body">
            <div id="reg4-cont-cont">
                <div class="reg4-row-spacer"></div>
                <div class="reg4-row">
                    <div id="reg4-header">THANK YOU FOR REGISTERING!</div>
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
                </div> <!--- end of reg4-row --> 
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
                        </div> <!--- end of reg4-row-container-columnL -->
                        <div class="reg4-row-container-columnR">
                            <form action="" method="get">
                                <div class="reg4-mcol-cont-R-row">
                                    <div class="reg4-mcol-cont-R-cont">
                                        <div class="reg4-mcol-cont-R-col1">
                                            <div class="reg4-mcol-cont-R-col1-spacer"></div>
                                            <div class="reg4-mcol-cont-R-col1-text">Newsletter</div>
                                            <div class="reg4-mcol-cont-R-col1-text">Group forum member post</div>
                                            <div class="reg4-mcol-cont-R-col1-text2">New article published that is<br />
                                                related to your subscriptions</div>
                                            <div class="reg4-mcol-cont-R-col1-text2">New forum published that is<br />
                                                related to your subscriptions</div>
                                            <div class="reg4-mcol-cont-R-col1-text">Pic of the week entry vote</div>
                                            <div class="reg4-mcol-cont-R-col1-text">Pic of the week winner</div>
                                            <div class="reg4-mcol-cont-R-col1-text">Deal of the day</div>
                                            <div class="reg4-mcol-cont-R-col1-text">Mum coins update</div>
                                            <div class="reg4-mcol-cont-R-col1-text">New Events</div>
                                            <div class="reg4-mcol-cont-R-col1-text">New Courses</div>
                                            <div class="reg4-mcol-cont-R-col1-text">Latest Reviews</div>
                                        </div> <!-- end of col1 -->
                                        <div class="reg4-mcol-cont-R-col2">
                                            <div class="reg4-mcol-cont-R-col23-spacer">YES</div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" checked />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" checked />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox2">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" checked />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox2">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" checked />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" checked />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" checked />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" checked />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" checked />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" checked />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" checked />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" checked />
                                                </div>
                                            </div>
                                        </div> <!-- end of col2 -->
                                        <div class="reg4-mcol-cont-R-col3">
                                            <div class="reg4-mcol-cont-R-col23-spacer">NO</div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox2">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox2">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" />
                                                </div>
                                            </div>
                                            <div class="reg4-mcol-cont-R-col23-textbox">
                                                <div class="reg4-checkbox">
                                                    <input name="" type="checkbox" value="newsletter" />
                                                </div>
                                            </div>
                                        </div> <!-- end of col3 -->
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
                                                    <a href="#" class="reg4cs">Customize settings</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="reg4-mcol-cont-R-colSP">
                                            <div class="reg4-mcol-cont-R-colSP-icon">
                                                <?= img('system/Reg-check.png'); ?>
                                            </div>
                                            <div class="reg4-mcol-cont-R-colSP-text">This is your current settings</div>
                                        </div>
                                    </div> <!-- end of reg4-mcol-cont-R-contSP -->
                                </div> <!-- end of reg4-mcol-cont-R-row -->
                            </form>
                        </div> <!--- end of reg4-row-container-columnR -->
                    </div> <!--- end of reg4-row-container -->
                </div> <!--- end of reg4-row --> 
            </div> <!--- end of reg4-cont-cont -->       	
        </div> <!--- end of reg-cont-body -->
    </div> <!--- end of reg-cont -->
</div>
<?= render_partial('global/default_footer'); ?>
