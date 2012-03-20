<div id="body2com">
    <div id="Header-cont">
        <div id="HgryBr"></div>
        <div id="headtxt-cont">
            <div id="headerText">
                <h1 class="custFontR">Poll Results</h1>
            </div> 
            <!-- end headerText -->
            <div id="headerMid">
                <div class="ArrowBox">
                    <?= img('system/Header-Arrow.png'); ?>
                </div> <!-- end ArrowBox -->
                <div class="textBox">
                    <a href="poll" class="Lblue">Home</a>
                </div> <!-- end textBox -->
            </div> <!-- end headerMid -->
            <div id="headtext">
                <div class="socialshare">
                	Share
                </div> <!-- end socialbox -->
                <div class="socialbox">
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_toolbox addthis_default_style ">
                        <a class="addthis_button_facebook"></a>
                        <a class="addthis_button_twitter"></a>
                        <a class="addthis_button_stumbleupon"></a>
                        <a class="addthis_button_google_plusone" g:plusone:count="false"></a>
                        <a class="addthis_button_email"></a>
                    </div>
                    <!-- AddThis Button END -->
                </div> <!-- end socialbox -->
            </div> <!-- end headtext -->
        </div> <!-- end headtxt-cont -->
        <div id="HbleBr"></div>
    </div> <!-- end Head-cont -->
    <div id="RC3-body-cont">
        <div id="RC3body-container">
		
		<p style="font-size:18px;margin-top:20px;'"><?php echo ($poll[0]['question']); ?></p>	    
		<section id="pollwrapper">

			<ul id="chart">
			<?php 
		
				foreach ($poll as $polloption) {
					$percent = round((((int) $polloption['votes'] / (int) $polloption['TotalVotes']) * 100), 2);
					echo '<li>'.$polloption['option'].'</li>';
					echo '<li title="'.$percent.'" class="blue">';
					echo '<span class="bar"></span>';
					echo '<span class="percent"></span>';
					echo '</li>';
				}
			?>
			</ul>
		</section>
        </div> <!-- body-container -->
	<div>   <p style="font-size:18px;">View other polls</p>
		<select id="ddlPollList" name="ddlPollList" onchange="loadNewPoll();">
		<?php
			foreach ($pollentries as $pollentry) {
					$selected = ((int) $selectedpollid == (int) $pollentry['id'])?"selected":"";
                                        echo '<option '.$selected.' value="'.$pollentry['id'].'">'.$pollentry['question'].'</option>';
                                }
		?>
		</select>
	</div>
    </div> <!-- RC3-body-cont -->
    <div id="MD-area">
        <div class="MDad-cont">
            <img src="img/ads/mini_ad.jpg" width="300" height="100"/>
        </div>
        <div class="MDad-cont">
            <img src="img/ads/mini_ad.jpg" width="300" height="100"/>
        </div>
    </div> <!-- MD area -->
    <div id="MD-area">
        <div class="MDad-cont">
            <img src="img/ads/mini_ad.jpg" width="300" height="100"/>
        </div>
        <div class="MDad-cont">
            <img src="img/ads/mini_ad.jpg" width="300" height="100"/>
        </div>
    </div> <!-- MD area -->
    <!--
	<div id="Sponsor-cont">
        <div class="header-container">
            <div class="header-text-container">
                <hh2>Sponsors</hh2></div>
            <div class="header-line"></div>
        </div>
        <div class="spon-row">
            <div class="spon-col">
                <div class="ad180"><img src="img/ads/ad_word4.jpg" width="180" height="290"/></div>
            </div> 
            <div class="spon-colSP">
                <div class="ad180"><img src="img/ads/ad_word4.jpg" width="180" height="290"/></div>
            </div>
            <div class="spon-col">
                <div class="ad180"><img src="img/ads/ad_word3.gif" width="180" height="290"/></div>
            </div>
        </div>
    </div>
	-->
</div> <!-- end body2com -->
<div id="sidebar2">
    <div id="c3spacer"></div>
    <div class="cont-250">
        <img src="img/ads/mrec.jpg" width="300" height="250"/>
    </div> <!-- end cont-250 -->
    <?= render_partial('global/pow'); ?>
    <?= render_partial('global/create_photoblog'); ?>
    <?= render_partial('global/mum_tools'); ?>
    <div class="cont-250">
        <img src="img/ads/mrec.jpg" width="300" height="250"/>
    </div> <!-- end cont-250 -->
    <div class="cont-250">
        <img src="img/ads/mini_ad.jpg" width="300" height="100"/>
    </div> <!-- end cont-250 -->
    <div class="cont-250">
        <img src="img/ads/mini_ad.jpg" width="300" height="100"/>
    </div> <!-- end cont-250 -->
    <div class="cont-250">
        <?= render_partial('global/fb_recent_activity'); ?>
    </div> <!-- end cont-250 -->
    <div class="cont-250">
        <?= render_partial('global/deal_of_day'); ?>
    </div> <!-- end cont-250 -->
    <!-- end .container --></div>
<?= render_partial('global/default_footer'); ?>

<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
$(document).ready(function(){
});
</script>
<script src="js/core.js" type="text/javascript"></script>
<script type="text/javascript">
function loadNewPoll() {
	var val = $("#ddlPollList").val();
	location.href = 'poll/index/' + val;
}
</script>
