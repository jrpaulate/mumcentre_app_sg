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
					<form name="pow_vote" method="post">
						<div id="pow-latest">
							<?php render_partial('pow/pow_entry');?>
							<br/>
							<br/>
            <?php if ($entry['contest_status'] == ACTIVEVOTING_CONTEST) : ?>
                <?php if ($data['has_error']) :?>
                  <p><h5><?php echo $data['error_message']?></h5></p>
                  
                <?php else:?>


              <?php if ( true == $this -> session -> userdata('logged_in') ) :?>
              <fieldset>
                <legend>Please confirm your vote for this entry</legend>
                <div style="text-align:center;">
                  <input type="hidden" name="user_id" id="user_id" value="<?php echo @issetVal($this -> session -> userdata('user_id'))?>"/>
                  <p>
                    <button onclick="this.form.submit();">Confirm your vote</button>
                  </p>
                </div>
              </fieldset>
              <?php else:?>
							<fieldset>
								<legend>
									Enter your email address to validate your vote
								</legend>
								<div style="text-align:center;">
									<label for="name">Valid Email Address</label>
									<input type="text" name="email_address" id="email_address" value="<?php echo @issetVal($data['email_address'])?>"/>
									<p>
										<br/>
										<br/>
										<button onclick="this.form.submit();">Submit Email Address</button>
									</p>
								</div>
							</fieldset>
						  <?php endif;?>
                <?php endif;?>
						<?php else:?>						  
						  <p>This entry is not part of the active Pick of the Week contest.</p>						  
						  
						<?php endif;?>
						</div>
					</form>
				</div><!-- .enter-form -->
			</div><!-- .section-body -->
		</div><!-- .content-main -->
	</div>
</div>
<div id="sidebar2">
	<?= render_partial('global/observer/sidebar'); ?>
</div>
<?= render_partial('global/default_footer');?>

