<div id="header" style="z-index: 100000000006;">
    <div id="mumlogo">
        <a href="<?php 
        $this->load->library('mcox');
		$count = 1;
        $featban = $this->mcox->get_zone_invocation_code(27, "adjs", "3rdPartyServers:ox3rdPartyServers:max");
        $featban = preg_replace("/\[removed\]/", "<script type='text/javascript'>", $featban, $count);
        $featban = str_replace("escape([removed])", "escape(window.location)", $featban);
        $featban = str_replace("[removed]<noscript>", "</script><noscript>", $featban);
        $featban = str_replace("[removed]", "document.write", $featban);
        $featban = str_replace("INSERT_RANDOM_NUMBER_HERE", rand(0, 99999999999), $featban);
        $featban = html_entity_decode($featban);
        echo base_url(); ?>">
            <?= img('system/mumcentre-logo.png', array('attributes' => array('alt' => 'MumCentre Logo'))); ?>
        </a>
    </div>
    <div id="country">
        <a href="http://mc.xhiber-dynamic.com" id="country_sg" class="country-link">
            <?=
            img('system/flag-sg.png', array('attributes' => array('alt' => 'MumCentre Logo')));
            ?>            
        </a>
        <a href="http://mum_my.xhiber-dynamic.com" id="country_mal" class="country-link">
            <?= img('system/flag-mal.png', array('attributes' => array('alt' => 'MumCentre Logo'))); ?>
        </a>
        <a href="http://mum_ph.xhiber-dynamic.com" id="country_ph" class="country-link">
            <?= img('system/flag-ph.png', array('attributes' => array('alt' => 'MumCentre Logo'))); ?>            
        </a>
        <a href="http://mum_au.xhiber-dynamic.com" id="country_au" class="country-link">
            <?= img('system/flag-aus.png', array('attributes' => array('alt' => 'MumCentre Logo'))); ?>            
        </a>
    </div>
    <div style="position:relative;width:728px;height98px;float:right; z-index:-100000000000;">
    <div id="featban" style="position:absolute;clip:rect(0px 728px 98px 0px);"  onmouseover="setFlashHeight('featban', 200);"  onmouseout="setFlashHeight('featban', 98);">
        <?php echo $featban; ?>
    </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#country_sg').click(function(e){
            $.post("home/set_country/3", {
                    fb_name : '',
                    fb_id : ''
                },

                function(){
                    window.location.reload();
                });
            e.preventDefault(); 
        });
        $('#country_mal').click(function(e){
            $.post("home/set_country/5", {
                    fb_name : '',
                    fb_id : ''
                },

                function(){
                    window.location.reload();
                });
            e.preventDefault(); 
        });
        $('#country_ph').click(function(e){
            $.post("home/set_country/4", {
                    fb_name : '',
                    fb_id : ''
                },

                function(){
                    window.location.reload();
                });
            e.preventDefault(); 
        });
        $('#country_au').click(function(e){
            $.post("home/set_country/7", {
                    fb_name : '',
                    fb_id : ''
                },

                function(){
                    window.location.reload();
                });
            e.preventDefault(); 
        });
    });
    var html_data = $('#featban').text();
    $('#featban').text('');
    $('#featban').html(html_data);

</script>
<script language="JavaScript">
function setFlashHeight(id, newH) {
    document.getElementById(id).style.clip="rect(0px 728px " + newH + "px 0px)";
}
function retract() {
    document.getElementById("exp-banner").style.clip="rect(0px 728px 100px 0px)";
}

</script>
