<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" xml:lang="en" lang="en" itemscope itemtype="http://schema.org/">
  <head>
    <base href="<?php echo base_url(); ?>" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <!--FB meta tags-->
    <meta property="og:title" content="<?= $title; ?>" />
    <meta property="og:description" content="<?= $description;?>" />
    <meta property="og:type" content="<?= $og_type; ?>" />
    <meta property="og:url" content="<?= $og_url; ?>" />
    <meta property="og:image" content="<?= $og_image; ?>" />
    <meta property="og:site_name" content="Mumcentre" />
    <meta property="og:locale" content="en_US" />
    <meta property="fb:admins" content="100000506782479" />
    <meta property="fb:app_id" content="261024107269619"/>
    <!--Google+ meta tags-->
    <meta itemprop="name" content="<?= $title; ?>">
    <meta itemprop="description" content="<?= $description; ?>">
    <meta itemprop="image" content="<?= $og_image; ?>">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta property="description" content="<?= $description; ?>"/>
    <meta property="title" content="<?= $title; ?>"/>
    <title><?= $title; ?></title>
    <?= get_css(); ?>
    <link rel="shortcut icon" href="assets/img/system/favicon.ico" type="image/favicon"/>
    <link href="css/custom-theme/jquery-ui-1.8.17.custom.css" rel="stylesheet" type="text/css" />
    <link href="css/core.css" rel="stylesheet" type="text/css" />
    <link href="js/uploadify/uploadify.css" rel="stylesheet" type="text/css" />    
    <script type="text/javascript" language="javascript" src="js/jquery-1.7.1.min.js"></script>
<!--    <script type="text/javascript" language="javascript" src="js/jquery.tools.min.js"></script>-->
    <script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
    <script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
    <script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<!--    <script type="text/javascript" language="javascript" src="js/tabs.js"></script>-->
    <script type="text/javascript"
    src="http://maps.googleapis.com/maps/api/js?sensor=false">
</script>
    <script type="text/javascript">
    var addthis_config = {
//        data_track_addressbar: true
    };
    </script>
    
    <!-- added for mega menu begin -->
		<script src="js/tabs.js"></script>
        <script src="js/jquery.placeholder.js"></script>
        <script>
            $('input[placeholder], textarea[placeholder]').placeholder();
        </script>
		<!-- added for mega menu end -->
    
    <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4e72c7d97e2d14f7"></script>
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
                                        
                                        } else {
                                             window.location = 'user/register_fb';
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
                        e.preventDefault();
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
                      
                  alert('out');
                      $.post("user/logout/", {
                        fb_name : '',
                        fb_id : ''
                        },

                        function(){
                        window.location.reload();
                        });
                 e.preventDefault();
                 });
                 
            });
        </script>
  </head>
  <body>


 <div id="skinnerleft" style="height: 1650px; cursor: pointer;  position: fixed; background-repeat: repeat-y; float: left; width: 11%; background-position: left top;margin-top: -3px;">
            
         <!--/* OpenX Javascript Tag v2.8.8 */-->

<!--/*
  * The backup image section of this tag has been generated for use on a
  * non-SSL page. If this tag is to be placed on an SSL page, change the
  *   'http://50.19.248.24/openx/www/delivery/...'
  * to
  *   'https://50.19.248.24/openx/www/delivery/...'
  *
  * This noscript section of this tag only shows image banners. There
  * is no width or height in these banners, so if you want these tags to
  * allocate space for the ad before it shows, you will need to add this
  * information to the <img> tag.
  *
  * If you do not want to deal with the intricities of the noscript
  * section, delete the tag (from <noscript>... to </noscript>). On
  * average, the noscript tag is called from less than 1% of internet
  * users.
  */-->

<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://50.19.248.24/openx/www/delivery/ajs.php':'http://50.19.248.24/openx/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=207");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script><noscript><a href='http://50.19.248.24/openx/www/delivery/ck.php?n=a061cbd5&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://50.19.248.24/openx/www/delivery/avw.php?zoneid=207&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a061cbd5' border='0' alt='' /></a></noscript>

            
        </div>
        
        <div id="skinnerright" style="height: 1650px; cursor: pointer; position: fixed; background-repeat: repeat-y; float: right; background-position: right top; margin-left: 89%; width: 13%;margin-top: -3px;">
            
        <!--/* OpenX Javascript Tag v2.8.8 */-->

<!--/*
  * The backup image section of this tag has been generated for use on a
  * non-SSL page. If this tag is to be placed on an SSL page, change the
  *   'http://50.19.248.24/openx/www/delivery/...'
  * to
  *   'https://50.19.248.24/openx/www/delivery/...'
  *
  * This noscript section of this tag only shows image banners. There
  * is no width or height in these banners, so if you want these tags to
  * allocate space for the ad before it shows, you will need to add this
  * information to the <img> tag.
  *
  * If you do not want to deal with the intricities of the noscript
  * section, delete the tag (from <noscript>... to </noscript>). On
  * average, the noscript tag is called from less than 1% of internet
  * users.
  */-->

<script type='text/javascript'><!--//<![CDATA[
   var m3_u = (location.protocol=='https:'?'https://50.19.248.24/openx/www/delivery/ajs.php':'http://50.19.248.24/openx/www/delivery/ajs.php');
   var m3_r = Math.floor(Math.random()*99999999999);
   if (!document.MAX_used) document.MAX_used = ',';
   document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);
   document.write ("?zoneid=208");
   document.write ('&amp;cb=' + m3_r);
   if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);
   document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));
   document.write ("&amp;loc=" + escape(window.location));
   if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));
   if (document.context) document.write ("&context=" + escape(document.context));
   if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
   document.write ("'><\/scr"+"ipt>");
//]]>--></script><noscript><a href='http://50.19.248.24/openx/www/delivery/ck.php?n=a8e576d6&amp;cb=INSERT_RANDOM_NUMBER_HERE' target='_blank'><img src='http://50.19.248.24/openx/www/delivery/avw.php?zoneid=208&amp;cb=INSERT_RANDOM_NUMBER_HERE&amp;n=a8e576d6' border='0' alt='' /></a></noscript>
    
            
        </div>




    <!-- floating menu -->
    <div id="fb-root"></div>
    <input type="hidden" id="fb_log"/>
    <input type="hidden" id="fb_name"/>
    <input type="hidden" id="fb_avatar"/>
    <?php if($this->session->userdata('logged_in')== TRUE){
            if($this->session->userdata('fb_id')){
            render_partial('global/observer/floater_logged');
            } else {
                render_partial('global/observer/floater_logged_2');
            }
        } else {?>
        <?= render_partial('global/observer/floater'); }?>
    <div id="container">
      <?= render_partial('global/observer/header'); ?>
      <?= render_partial('global/observer/newnav'); ?>
      <?= render_content(); ?>
    </div>
	<!-- Piwik -->
	<script type="text/javascript">
	var pkBaseURL = (("https:" == document.location.protocol) ? "https://50.19.248.24/piwik/" : "http://50.19.248.24/piwik/");
	document.write(unescape("%3Cscript src='" + pkBaseURL + "piwik.js' type='text/javascript'%3E%3C/script%3E"));
	</script><script type="text/javascript">
	try {
	var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", 2);
	piwikTracker.trackPageView();
	piwikTracker.enableLinkTracking();
	} catch( err ) {}
	</script><noscript><p><img src="http://50.19.248.24/piwik/piwik.php?idsite=2" style="border:0" alt="" /></p></noscript>
	<!-- End Piwik Tracking Code -->
        <script type="text/javascript">
 
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29340236-1']);
  _gaq.push(['_setDomainName', 'mumcentre.com.sg']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);
 
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
 
</script>
        <!-- Begin comScore Tag -->
<script>
  var _comscore = _comscore || [];
  _comscore.push({ c1: "2", c2: "13509838" });
  (function() {
    var s = document.createElement("script"), el = document.getElementsByTagName("script")[0]; s.async = true;
    s.src = (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js";
    el.parentNode.insertBefore(s, el);
  })();
</script>
<noscript>
  <img src="http://b.scorecardresearch.com/p?c1=2&c2=13509838&cv=2.0&cj=1" />
</noscript>
<!-- End comScore Tag -->
  </body>
</html>
