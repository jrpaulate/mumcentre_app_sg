<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="https://www.facebook.com/2008/fbml">
    <head>
        <base href="<?php echo base_url(); ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta property="og:title" content="Mumcentre" />
        <meta property="og:description" content="Mumcentre - Best site for Mums!" />
        <meta property="og:type" content="website" />
        <meta property="og:url" content="https://www.facebook.com/MumCentre.Singapore" />
        <meta property="og:image" content="http://www.mumcentre.com.sg/images/mc-new/images/logo2.jpg" />
        <meta property="og:site_name" content="Mumcentre" />
        <meta property="fb:admins" content="100000506782479" />
        <meta property="fb:app_id" content="261024107269619"/>
        <title><?= $title; ?></title>
        <?= get_css(); ?>
        <link rel="shortcut icon" href="assets/img/system/favicon.ico" type="image/favicon"/>
        <link href="css/custom-theme/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
        <link href="js/uploadify/uploadify.css" rel="stylesheet" type="text/css" />    
        <script type="text/javascript" language="javascript" src="js/jquery-1.6.4.min.js"></script>
    <!--    <script type="text/javascript" language="javascript" src="js/jquery.tools.min.js"></script>-->
        <script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
        <script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
        <script type="text/javascript">
            var addthis_config = {
                //        data_track_addressbar: true
            };
        </script>
        <script tpye="text/javascript">
        (function() {
                    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                    po.src = 'https://apis.google.com/js/plusone.js';
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                })();
        </script>
        <script type="text/javascript">
            $(document).ready(function(){
                window.fbAsyncInit = function() {
                    FB.init({
                        appId      : '261024107269619', // App ID
                        channelURL : '//localhost/mumcentre/channel.html', // Channel File
//                        channelURL : '//www.mumcentre.com.au/channel.html',
                        status     : true, // check login status
                        cookie     : true, // enable cookies to allow the server to access the session
                        oauth      : true, // enable OAuth 2.0
                        xfbml      : true  // parse XFBML
                    });
                    FB.getLoginStatus(function(response) {
                        if (response.authResponse) {
                            // logged in and connected user, someone you know
                            //                                                    alert('logged in and connected');
                            $('#fb_log').val('1');
                            FB.api('/me', function(response) {
                                $('#fb_name').val(response.name);
                                $('#fb_avatar').val('http://graph.facebook.com/'+response.id+'/picture')
                            });
                        }
                    });
                    $('#fb_float').click(function(e){
                        FB.getLoginStatus(function(response) {
                            if (response.authResponse) {
                                FB.api('/me', function(response) {
                                    // logged in and connected user, someone you know
                                    //                    alert('logged in and connected');
                                    //                                alert(document.URL)
                                    $.post("user/fb_check/"+response.id, {
                                        fb_name : response.name
                                    },

                                    function(data){
                                        var code = data;
                                        if(code > 0) {
//                                            var profile = 'Welcome '+response.name;
//                                            $('#welcome').html('');
//                                            $('#welcome').append(profile);
                                            $.post("user/set_session/", {
                                                fb_name : response.name,
                                                fb_id : response.id
                                            },

                                            function(){
                                                window.location.reload();
                                            });
                                        
                                        }
                                    });
                                });
                                //                                window.location = 'user/register_fb';
                            } else {
                                FB.login(function(response) {
                                    if (response.authResponse) {
                                        FB.api('/me', function(response) {
                                    // logged in and connected user, someone you know
                                    //                    alert('logged in and connected');
                                    //                                alert(document.URL)
                                    $.post("user/fb_check/"+response.id, {
                                        fb_name : response.name
                                    },

                                    function(data){
                                        var code = data;
                                        if(code > 0) {
//                                            var profile = 'Welcome '+response.name;
//                                            $('#welcome').html('');
//                                            $('#welcome').append(profile);
                                            $.post("user/set_session/", {
                                                fb_name : response.name,
                                                fb_id : response.id
                                            },

                                            function(){
                                                window.location.reload();
                                            });
                                        
                                        } else {
                                             window.location = 'user/register_fb';
                                        }
                                    });
                                });
                                       
                                    } else {
                                        alert('User cancelled login or did not fully authorize.');
                                    }
                                }, {scope: 'email,user_birthday,user_location'});
                            }
                        });
                        e.preventDefault;
                    });
                    // Additional initialization code here
                };

                // Load the SDK Asynchronously
                (function(d){
                    var js, id = 'facebook-jssdk'; if (d.getElementById(id)) {return;}
                    js = d.createElement('script'); js.id = id; js.async = true;
                    js.src = "//connect.facebook.net/en_US/all.js";
                    d.getElementsByTagName('head')[0].appendChild(js);
                }(document));
                
                 $('#logout').click(function(e){
                      $.post("user/logout/", {
                        fb_name : '',
                        fb_id : ''
                        },

                        function(){
                        window.location.reload();
                        });
                 e.preventDefault;
                 });
            });
        </script>
    </head>
    <body>
        <!-- floating menu -->
        <div id="fb-root"></div>
        <input type="hidden" id="fb_log"/>
        <input type="hidden" id="fb_name"/>
        <input type="hidden" id="fb_avatar"/>
        <?php if($this->session->userdata('logged_in')== TRUE){
            render_partial('global/observer/floater_logged');
        } else {?>
        <?= render_partial('global/observer/floater'); }?>
        <div id="container">
            <?= render_partial('global/observer/header'); ?>
            <?= render_partial('global/observer/nav'); ?>
            <div id="body2com">
                <p>Forums here</p>
            </div>
            <div id="sidebar2">
                <div id="c3spacer"></div>
                <div class="cont-250">
                    <img src="img/ads/MREC.jpg" width="300" height="250"/>
                </div> <!-- end cont-250 -->
                <?= render_partial('global/pow'); ?>
                <?= render_partial('global/create_photoblog'); ?>
                <?= render_partial('global/mum_tools'); ?>
                <div class="cont-250">
                    <img src="img/ads/MREC.jpg" width="300" height="250"/>
                </div> <!-- end cont-250 -->
                <div class="cont-250">
                    <img src="img/ads/mini_ad.jpg" width="300" height="100"/>
                </div> <!-- end cont-250 -->
                <div class="cont-250">
                    <img src="img/ads/mini_ad.jpg" width="300" height="100"/>
                </div> <!-- end cont-250 -->
                <div class="cont-250">
                    <?= render_partial('global/fb_recent_activity'); ?>
                </div> <!-- end cont-250 -->
                <div class="cont-250">
                    <?= render_partial('global/deal_of_day'); ?>
                </div> <!-- end cont-250 -->
                <!-- end .container -->
            </div>
        </div>
    </body>
</html>