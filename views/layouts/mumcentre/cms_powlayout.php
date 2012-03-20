<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <base href="<?php echo base_url() ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Mumcentre - CMS</title>
        <?= get_css(); ?>
        <link rel="shortcut icon" href="assets/img/system/favicon.ico" type="image/favicon"/>
        <link href="js/uploadify/uploadify.css" rel="stylesheet" type="text/css" />
        <link href="css/custom-theme/jquery-ui-1.8.17.custom.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>        
        <script type="text/javascript" language="javascript" src="js/jquery-1.6.4.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
        <script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/powcms.js"></script>        
        <script type="text/javascript" language="javascript" src="js/sorter.packed.js"></script>
        <script type="text/javascript" language="javascript" src="js/jquery-ui-timepicker-addon.js"></script>
</head>
    <body>
        <?= render_partial('cms/cms_nav'); ?>
        <?= render_content(); ?>
        <div class="variable" id=""></div>
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