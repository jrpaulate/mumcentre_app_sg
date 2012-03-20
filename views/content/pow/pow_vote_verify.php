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
							<fieldset>
								<legend>
									Enter the vote code that was sent to your email address
								</legend>
								<div style="text-align:center;">
									<label for="name">Vote verification code </label>
									<input type="text" name="vote_code" id="vote_code" value="<?php echo @issetVal($data['vote_code'])?>"/>
									<p>
										<br/>
										<br/>
										<button onclick="this.form.submit();">
											Submit Verification Code
										</button>
									</p>
								</div>
							</fieldset>
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

