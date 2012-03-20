<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <base href="<?php echo base_url() ?>" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Mumcentre - Partner Portal</title>
        <?= get_css(); ?>
        <link rel="shortcut icon" href="assets/img/system/favicon.ico" type="image/favicon"/>
        <link href="js/uploadify/uploadify.css" rel="stylesheet" type="text/css" />
        <link href="css/custom-theme/jquery-ui-1.8.17.custom.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
         <script type="text/javascript" language="javascript" src="js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/swfobject.js"></script>
        <script type="text/javascript" language="javascript" src="js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
       
     
        
        <script type="text/javascript">
            tinyMCE.init({
                // General options
                width : "500",
                mode : 'exact',
                elements: 'tadescription,description',
                theme : "advanced",
                plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

                // Theme options
                theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
                theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink|,forecolor,backcolor",
                theme_advanced_buttons3 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft|,table,removeformat,code",
                theme_advanced_toolbar_location : "top",
                theme_advanced_toolbar_align : "left",
                theme_advanced_statusbar_location : "bottom",
                theme_advanced_resizing : false

                // Example word content CSS (should be your site CSS) this one removes paragraph margins
                //                content_css : "css/word.css"
            });
        </script>
        <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
</head>

    <body>
        <?= render_partial('partner_portal/partner_header'); ?>
        <?= render_partial('partner_portal/partner_nav'); ?>
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