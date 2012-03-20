    <div id="reg-body-cont" class="form-basic">
        <div class="reg-header">
            <h1 class="fleft">Registration</h1>
            <div class="stepCount fright">Step 1 of 3</div>
        </div><!-- .reg-header -->
        <div class="reg-cont">
            <div class="reg-cont-form">
                <h2>Basic Information</h2><br/>
<!--                    <hr2>Fields marked with an asterisk (*) are required</hr2>-->
                </div>
                <div id="reg-cont-body-body">
                    <iframe src="https://www.facebook.com/plugins/registration.php?
                            client_id=261024107269619&
                            redirect_uri=http://localhost/mumcentre/register/fbsub/&
                            fields=name,first_name,last_name,birthday,gender,location,email,password"
                            scrolling="auto"
                            frameborder="no"
                            style="border:none"
                            allowTransparency="true"
                            width="100%"
                            height="450">
                    </iframe>
                </div>
            </div>
        </div>
<?= render_partial('global/default_footer'); ?>
