<div id="floating">
    <div id="floatmenu">
        <div id="log" class="fm_item_log">
            <a href="#">
                <?= img('system/login.png'); ?> 
            </a>
        </div>
        <div class="fm_item_log">
            <a href="member/register">
                <?= img('system/float-register.png'); ?>
            </a>
        </div>
        <div class="fm_item_log">
            <iframe src="//www.facebook.com/plugins/like.php?locale=en_US&href=https%3A%2F%2Fmumcentre.com.sg&amp;send=false&amp;layout=button_count&amp;width=450&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:46px; height:27px; position:relative; top:3px;" allowTransparency="true" width="50px" height="27px"></iframe>
            <!--                <fb:like data-href="http://www.facebook.com/MumCentre.Singapore" send="true" layout="button_count" width="80" show_faces="false" action="recommend"></fb:like>-->
        </div>
        <div class="fm_item_log">
            <a href="https://twitter.com/share" data-url="<?php base_url(); ?>" data-count="none" target="_blank">
                <img src="assets/img/system/float-tweet.png" style="padding: 0px 5px 0px 3px;"/>
                
            </a>
            <script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
        </div>
        <div class="fm_item_log">
            <g:plusone annotation="none"></g:plusone>
            <script type="text/javascript">
            </script>
        </div>
     
        
           
        <div class="fm_item_log">
            <a href="#" target="">
                <img src="assets/img/system/float-rss.png" style="margin: 0px 2px 0px 5px;"/>
            </a>
        </div>
        <div class="fm_item_right">
        <div style="float: right; margin-right: 59px;">
            <div style="position: absolute; margin-left: 144px;">
             <a href="#" id="subscriber"><img src="assets/img/system/subscribenow.png" width="70" height="26" border="0" /></a>
            </div>
            <input type="text" id="su_newsletter_email" value="Type in your email address" title="Type in your email address">
        </div>
    </div>
        <div class="fm_item_right">
            <?= img('system/float-getupdated.png'); ?>
          
        </div>
        
        
        <style>
            
            #su_newsletter_email {
 -webkit-border-radius: 10px;
 -moz-border-radius: 10px;
 border-radius: 10px;
 border: solid 1px #AAA;
 height: 22px;
 font-family: Arial, Helvetica, sans-serif;
 font-size: 11px;
 color: #999;
 width: 133px;
 padding-left: 5px;
 padding-right: 15px;
}
        </style> 
        
    
 
       
    </div>
</div>
<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
<link href="assets/css/pow.css" rel="stylesheet" type="text/css" />
<link href="assets/css/modal.css" rel="stylesheet" type="text/css" />
<div id="login_modal" style="display: none">
    <div class="wrapper">

        <div class="inner">
            <div class="reg-box fleft">
                <h4>Not yet registered?</h4>

                <p class="big">Join Now!</p>
                <p>Get member exclusive access and benefits.</p>
                <a href="user/register" title="Sign-up Now!" class="btn btn-rnd">Sign up</a>
            </div><!-- .reg-box -->
            <div class="login-box fright">
                <h4>Login | <a href="#" id="forgot_pass" >Forgot Password?</a></h4>
                <hr/>
                <form name="frm_login" id="frm_login" action="" method="post">
                    <label for="email" class="fleft">Email Address</label>
                    <input id="email_log" type="text" name="email" title="Type in your email address" class="fright" />
                    <label for="password" class="fleft">Password</label>
                    <input id="password_log" type="password" name="password"  title="Type in your password" class="fright" />
                    <button type="submit" class="btn btn-rnd fright clear">Login</button>
                </form>
            </div><!-- .login-box -->
        </div><!-- .wrapper -->
    </div><!-- .inner -->
</div>
<div id="reset_pass_modal" style="display: none">
    <table width="100%" cellpadding="5">
        <tr>
            <td width="100">Email Address : </td>
            <td><input id="email_add" name="email_add" style="width:100%;border:1px solid #abadb3;line-height:18px;" /></td>
        </tr>
        <tr>
            <td colspan="2"><a href="javascript:void(0);" id="reset" class="btn-rnd fright view-link"><small>SUBMIT</small></a></td>
        </tr>
    </table>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('#log').click(function(e){
            $('#login_modal').dialog('open');
            e.preventDefault();  
        })
        
        $('#reset').click(function(e){
            var email = $('#email_add').val();
            $.post('user/request_reset_pass',
            {
                email: email   
            },
            function(data){
                var rurl = data.split(":");
                var code = rurl[0];
                var msg = rurl[1];
                if (code < 0) {
                    alert(msg);
                } else {
                    alert(msg);
                    $('#reset_pass_modal').dialog('close');
                }
            });
            e.preventDefault();  
        })
        $('#login_modal').dialog({
            autoOpen: false,
            width: 730,
            height: 300,
            title: 'Login',
	    zIndex: 99999999999
        });
        $('#reset_pass_modal').dialog({
            autoOpen: false,
            width: 400,
            title: 'Reset Password'
        });
        $('#forgot_pass').click(function(e){
            $('#login_modal').dialog('close');
            $('#reset_pass_modal').dialog('open');
            e.preventDefault();
        });
        $('#frm_login').submit(function(e) {
            var email_address = $('#email_log').val();
            var password = $('#password_log').val();
            if(email_address.length == 0) {
                alert("Please type in email address to login");
            } else if(password.length == 0) {
                alert("Please type in password to login");
            } else {
                $.post("user/login", {
                    email_address: email_address,
                    password: password
                },
                function(data){
                    //                            alert(data);
                    var rurl = data.split(":");
                    var code = rurl[0];
                    var msg = rurl[1];
                    if (code < 0) {
                        alert(msg);
                    } else {
                        $.post("user/set_session_2/", {
                            email: email_address,
                            password: password
                        },

                        function(){
                            window.location.reload();
                        });
                    }

                });
            }
            e.preventDefault(); 
        });
        $('#su_newsletter_email').focus(function () {
            if ($(this).val() == $(this).attr("title")) {
                $(this).val("");
            }
        }).blur(function () {
            if ($(this).val() == "") {
                $(this).val($(this).attr("title"));
            }
        });
        
        $('#subscriber').click(function(e) {
            //            alert('subscribe method');
            var subadd = $('#su_newsletter_email').val();
            $.post('mailchimp/subscribe/'+subadd, {
                email: subadd
            },function(data){
                alert(data);       
            })
            e.preventDefault();
        });
    });
</script>
