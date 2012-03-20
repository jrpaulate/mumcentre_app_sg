<?php
$this->load->library('mcox');

		$mini_ad1 = $this->mcox->get_zone_invocation_code(41, "adjs", "3rdPartyServers:ox3rdPartyServers:max");
        $mini_ad1 = preg_replace("/\[removed\]/", "<script type='text/javascript'>", $mini_ad1, $count);
        $mini_ad1 = str_replace("escape([removed])", "escape(window.location)", $mini_ad1);
        $mini_ad1 = str_replace("[removed]<noscript>", "</script><noscript>", $mini_ad1);
        $mini_ad1 = str_replace("[removed]", "document.write", $mini_ad1);
        $mini_ad1 = str_replace("INSERT_RANDOM_NUMBER_HERE", rand(0, 99999999999), $mini_ad1);
        $mini_ad1 = html_entity_decode($mini_ad1);
		
		
		$mini_ad2 = $this->mcox->get_zone_invocation_code(42, "adjs", "3rdPartyServers:ox3rdPartyServers:max");
        $mini_ad2 = preg_replace("/\[removed\]/", "<script type='text/javascript'>", $mini_ad2, $count);
        $mini_ad2 = str_replace("escape([removed])", "escape(window.location)", $mini_ad2);
        $mini_ad2 = str_replace("[removed]<noscript>", "</script><noscript>", $mini_ad2);
        $mini_ad2 = str_replace("[removed]", "document.write", $mini_ad2);
        $mini_ad2 = str_replace("INSERT_RANDOM_NUMBER_HERE", rand(0, 99999999999), $mini_ad2);
        $mini_ad2 = html_entity_decode($mini_ad2);
		
		
		$mini_ad3 = $this->mcox->get_zone_invocation_code(43, "adjs", "3rdPartyServers:ox3rdPartyServers:max");
        $mini_ad3 = preg_replace("/\[removed\]/", "<script type='text/javascript'>", $mini_ad3, $count);
        $mini_ad3 = str_replace("escape([removed])", "escape(window.location)", $mini_ad3);
        $mini_ad3 = str_replace("[removed]<noscript>", "</script><noscript>", $mini_ad3);
        $mini_ad3 = str_replace("[removed]", "document.write", $mini_ad3);
        $mini_ad3 = str_replace("INSERT_RANDOM_NUMBER_HERE", rand(0, 99999999999), $mini_ad3);
        $mini_ad3 = html_entity_decode($mini_ad3);

?>
<div id="prefoot">
	<div id="preftop">
	  <div id="ftlnkr">
      </div>
  </div>
	<div id="preft"></div>
      <div id="prefads"> 
      <div id="bminiAd-left" class="bminiAd"><?php echo $mini_ad1; ?></div>
      <div id="bminiAd-SP"><?php echo $mini_ad2; ?></div>
      <div id="bminiAd-right" class="bminiAd"><?php echo $mini_ad3; ?></div>
      </div>
        <div id="prefb"></div>
        <div id="backtop"><a href="#"><?= img('system/bttop.png'); ?></a></div>
</div>
</div>
<div id="footer">
	<div id="footbox">
    <div id="cftb-1">
    	<div id="botsearch">
    		<div id="botsearch-cont">
        		<div class="botsearch-searchbox">
            		<form name="frm_search2" id="frm_search2" method="post">
                        <input type="text" id="q2" name="searchfield" class="botsearch-textinput" value="" placeholder="Search Mumcentre "/>
                        <button type="submit" id="search_submit" style="display:none"></button>
                        </form>
           		</div>
       		</div>
        </div>
        <div id="cftb-1-c1">
        	<b>Quick Navigation</b><br />
			<a href="<?php echo base_url(); ?>">Home</a><br />
			<a href="<?php echo base_url(); ?>/forum">Forum</a><br />
			<a href="<?php echo base_url(); ?>/pow">Pic of The Week</a><br />
                       	<a href="#">About MumCentre</a><br />
        </div>
        <div id="cftb-1-c2">
        	<b>Resource Articles</b><br />
			<a href="<?php echo base_url(); ?>pregnancy">Pregnancy</a><br />
			<a href="<?php echo base_url(); ?>baby">Baby</a><br />
			<a href="<?php echo base_url(); ?>toddler">Toddlers</a><br />
			<a href="<?php echo base_url(); ?>preschooler">Preschoolers</a><br />
			<a href="<?php echo base_url(); ?>parents">Parents</a><br />
        </div>
    </div>
    <div id="cftb-2">
   	  <div id="gotQNH"><?= img('system/GotQ-NH.png'); ?>
    	</div>
      <div id="contactsUN"><div id="contactsUN-but">
      	<a href="#"><?= img('system/ContactUsNow.png'); ?></a></div>
        </div>
    	<div id="cftb-2-c1"><b></b><br />
                       <a href="<?php echo base_url(); ?>partner">Partner Portal</a> </br>
			<a href="<?php echo base_url(); ?>ps_providers">Product & Service Providers</a><br />
                        <a href="">Products & Services Updates</a><br />
			<a href="<?php echo base_url(); ?>">Events</a><br />
                        <a href="">Programs</a><br />
            </div>
    	<div id="cftb-2-c2">
        	<b>MumCentre</b><br />
			<a href="#" id="advertise">Advertise Here</a><br />
			<a href="#">What is MumCentre</a><br />
			<a href="#">Contact Us</a><br />
			<a href="#">Tell Us To Your Friends </a><br />
			<a href="#">Privacy Policy </a><br />
    	</div>
    </div>
    <div id="cftb-3">
<!--    <div id="bot-FB-app"><script src="http://connect.facebook.net/en_US/all.js#appId=234749426571005&amp;xfbml=1"></script><fb:like href="https://www.facebook.com/MumCentre.Singapore" send="false" layout="" width="80" show_faces="false" font=""></fb:like></div>-->
    <div id="bot-google-app"><g:plusone></g:plusone>Recommend Us on Google</div>
    <div id="bot-IconCont">
    <div id="bot-FBIcon"><a href="https://www.facebook.com/MumCentre.Singapore" target="_blank"><?= img('system/SI-FB.png'); ?></a></div>
    <div id="bot-TwitIcon"><a href="http://twitter.com/share" data-url="www.mumcentre.com.sg" data-count="none" target="_blank"><?= img('system/SI-Twit.png'); ?></a></div>
    <div id="bot-RSSIcon"><?= img('system/SI-RSS.png'); ?></div>
    </div>
    <div id="bot-SelectCountry">Choose Your Location: <br />
     <strong><a href="<?php echo base_url(); ?>">Singapore</a> | <a href="http://my.mumcentre.com">Malaysia</a> | <a href="http://ph.mumcentre.com">Philippines</a> | <a href="http://au.mumcentre.com">Australia</a></strong></div>
    </div>
    	<div id="copyright">Copyright © 2011 MumCentre. All Rights Reserved.</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        var html_data = $('#bminiAd-left').text();
        $('#bminiAd-left').text('');
        $('#bminiAd-left').html(html_data);
        var html_data = $('#bminiAd-SP').text();
        $('#bminiAd-SP').text('');
        $('#bminiAd-SP').html(html_data);
        var html_data = $('#bminiAd-right').text();
        $('#bminiAd-right').text('');
        $('#bminiAd-right').html(html_data);
        $('#frm_search2').submit(function(e){
                           var keyword = $('#q2').val();
                           location.href = "search/?q="+keyword;
                           e.preventDefault();
                        });
                        $('#q2').focus(function () {
                            if ($(this).val() == $(this).attr("title")) {
                                $(this).val("");
                            }
                        }).blur(function () {
                            if ($(this).val() == "") {
                                $(this).val($(this).attr("title"));
                            }
                        });
    });
</script>
