<div id="header">
    <div id="mumlogo">
        <a href="<?php 
        $this->load->library('mcox');
        $featban = $this->mcox->get_zone_invocation_code(1,'adjs');
        $featban =  str_replace("[removed]", "", $featban);
        echo base_url(); ?>">
            <?= img('system/mumcentre-logo.png', array('attributes' => array('alt' => 'MumCentre Logo'))); ?>
        </a>
    </div>
    <div id="country">
        <a href="#" id="country_sg" class="country-link">
            <?=
            img('system/flag-sg.png', array('attributes' => array('alt' => 'MumCentre Logo')));
            ?>            
        </a>
        <a href="#" id="country_mal" class="country-link">
            <?= img('system/flag-mal.png', array('attributes' => array('alt' => 'MumCentre Logo'))); ?>
        </a>
        <a href="#" id="country_ph" class="country-link">
            <?= img('system/flag-ph.png', array('attributes' => array('alt' => 'MumCentre Logo'))); ?>            
        </a>
        <a href="#" id="country_au" class="country-link">
            <?= img('system/flag-aus.png', array('attributes' => array('alt' => 'MumCentre Logo'))); ?>            
        </a>
    </div>
    <div id="featban">
    <?php  echo $featban; ?>  
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
