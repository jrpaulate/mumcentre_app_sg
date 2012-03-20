<div id="body2com">
    <div class="wrap-pow">

        <div style="width: 660px;">
            <div id="section-head">
                <h2 class="custFontR">Pic of the Week</h2>
                <span class="sponsor-by">is Brought to you by:</span>
                <?php render_partial('pow/pow_navigation'); ?>
            </div><!-- #section-head -->

            <br />

            <div class="pow">
                <div class="winner-pow">
                    <?php if ($data['results']) : ?> 

                        <?php foreach ($data['results'] as $row) :
                            ?>
                            <?php if ($row['token_id']) :
                                ?>                                        
                                <div class="pow-1">
                                    <div style="height: 28px; background: #39c;"> <div align="center" class="pow-winner-text"><?php echo $row['category_name']; ?></div></div>
                                    <img src="<?php echo get_entry_photo($row['token_id'], $row['photo_filename'], 320); ?>" alt="<?php echo $row['category_name']; ?>" width="151" height="150"/></div>

                            <?php endif; ?>
                        <?php endforeach; ?>                                        
                    <?php endif; ?>
                </div>
            </div>

            <div class="pow-join">Wanna win Prizes too?   &nbsp;<a href="pow/join"><input type="image" src="pow-images/join-btn.png"></a>
            </div>
            <br />
            <div style="line-height:22px;">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>

            <div class="recent-alerts">Past Entries</div>


            <div class="pow-list">
                <div class="pow-pic"><img src="pow-images/pow-1.png"></div>
                <div class="pow-pic"><img src="pow-images/pow-2.png"></div>
                <div class="pow-pic"><img src="pow-images/pow-3.png"></div>
                <div class="pow-pic"><img src="pow-images/pow-4.png"></div>
                <div class="pow-pic"><img src="pow-images/pow-5.png"></div>
            </div>
            <div class="pow-list">
                <div class="pow-pic"><img src="pow-images/pow-1.png"></div>
                <div class="pow-pic"><img src="pow-images/pow-2.png"></div>
                <div class="pow-pic"><img src="pow-images/pow-3.png"></div>
                <div class="pow-pic"><img src="pow-images/pow-4.png"></div>
                <div class="pow-pic"><img src="pow-images/pow-5.png"></div>
            </div>
            <div class="pow-list">
                <div class="pow-pic"><img src="pow-images/pow-1.png"></div>
                <div class="pow-pic"><img src="pow-images/pow-2.png"></div>
                <div class="pow-pic"><img src="pow-images/pow-3.png"></div>
                <div class="pow-pic"><img src="pow-images/pow-4.png"></div>
                <div class="pow-pic"><img src="pow-images/pow-5.png"></div>
                <div class="pow-pic"><img src="pow-images/pow-5.png"></div>
            </div>
            <!--<div style="color: #212121; font-size: 14px;">Click Image to Delete</div>-->

        </div>
    </div>
</div> <!-- end body2com -->
<div id="sidebar2">
    <?= render_partial('global/observer/sidebar'); ?>
</div>
<?= render_partial('global/default_footer'); ?>