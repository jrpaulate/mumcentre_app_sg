<!-- Modal Window -->

<div id="modal" class="access">

    <div class="wrapper">

        <div class="inner">
            <div class="logo">
                <img src="assets/img/system/mumcentre-logo.png" alt="MumCente" />
            </div>
            <hr />
            <div class="links-box fleft">
                <h4>MumCentre Links</h4>
                <ul>
                    <li><a href="#" title="#">MumCentre Main Site</a></li>
                    <li><a href="#" title="#">MumCentre Forum</a></li>
                    <li><a href="#" title="#">Partner Portal</a></li>
                </ul>
            </div><!-- .reg-box -->
            <div class="login-box fright">
                <h4>CMS Login</h4>
                <hr/>
                <form name="frmMain" id="frmMain" action="/" method="post">
                    <label for="email" class="fleft">Email Address</label>
                    <input type="text" id="email" name="email" title="Type in your email address" class="fright" />
                    <label for="password" class="fleft">Password</label>
                    <input type="password" id="password" name="password" title="Type in your password" class="fright" />
                    <a href="#" class="forgotpw clearfix" title="Recover your Password">Forgot password?</a>
                    <button type="submit" class="btn btn-rnd fright clear">Login</button>
                </form>
            </div><!-- .login-box -->
        </div><!-- .wrapper -->
    </div><!-- .inner -->
    <div class="footer">
    	Copyright &copy; 2011 MumCentre. All Rights Reserved.
    </div>
</div><!-- #modal -->
<script type="text/javascript">
    $(document).ready(function(){

        $('#frmMain').submit(function(e) {                   
            var email = $('#email').val();
            var password = $('#password').val();
            if(email.length == 0) {
                alert("Email cannot be empty!");
            } else if(password.length == 0) {
                alert("Password cannot be empty!");
            } else if(password.length < 8) {
                alert("Password must be atleast 8 characters!");
            } else {
                        
                $.post("cms/auth", {
                    email: email,
                    password: password
                },
                function(data){
//                    alert(data);
                    window.location = 'cms/article';
                });
            }
            e.preventDefault();
        });
    });
</script>