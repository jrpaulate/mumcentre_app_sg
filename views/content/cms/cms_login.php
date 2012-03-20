<div id="modal" class="access">

	<div class="wrapper">
    	
		<div class="inner">
        	<div class="logo">
        		<img src="images/logo.png" alt="MumCentre <?php echo $this->session->userdata('cms_logged');?>" />
        	</div>
            <hr />
    		<div class="links-box fleft">
            <h4>MumCentre Links</h4>
            <ul>
            	<li><a href="<?php echo base_url();?>" title="#">MumCentre Main Site</a></li>
                <li><a href="<?php echo base_url();?>forum" title="#">MumCentre Forum</a></li>
                <li><a href="#" title="#">Partner Portal</a></li>
            </ul>
            </div><!-- .reg-box -->
            <div class="login-box fright">
                <h4>CMS Login</h4>
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
    <div class="footer">
    	Copyright &copy; 2011 MumCentre. All Rights Reserved.
    </div>
</div><!-- #modal -->
<script type="text/javascript" language="javascript" src="js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#frm_login').submit(function(e) {
            var email_address = $('#email_log').val();
            var password = $('#password_log').val();
            if(email_address.length == 0) {
                alert("Please type in email address to login");
            } else if(password.length == 0) {
                alert("Please type in password to login");
            } else {
                $.post("cms/log", {
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
                        $.post("cms/set_session_2/", {
                            email: email_address,
                            password: password
                        },

                        function(){
                            window.location = 'cms';
                        });
                    }

                });
            }
            e.preventDefault(); 
        });
    });
</script>