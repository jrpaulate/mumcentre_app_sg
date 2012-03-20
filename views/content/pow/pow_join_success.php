<?php $entry = $data['entry_info'];?>
<div id="body2com">
  <div id="content1" class="clear1">
    <div id="content-main">
      <div id="section-head">
        <h2 class="custFontR">Pic of the Week</h2>
        <span class="sponsor-by">is Brought to you by:</span>
        <?php render_partial('pow/pow_navigation');?>
      </div><!-- #section-head -->
      <div id="section-body">
        <div class="enter-form">
          <fieldset>
            <div class="powV2-Entry">
              <div class="powText">
                <?php echo $this->pow->options_get('message_successful_submit');?> 
<!--                  notify-user-new-entry_subject-->
              </div>
            </div>
            <span class="clear"></span>
          </fieldset>
        </div><!-- .enter-form -->
      </div><!-- .section-body -->
    </div><!-- .content-main -->
  </div>
</div>
<div id="sidebar2">
  <?= render_partial('global/observer/sidebar'); ?>
</div>
<?= render_partial('global/default_footer');?>