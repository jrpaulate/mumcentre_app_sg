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
					<form id="powform" method="post" enctype="multipart/form-data">
						<fieldset>
							<legend>
								Step 1: Upload your Photo
							</legend>
							<label for="pow_category_id">Choose a category :</label>
							<select name="pow_category_id" id="pow_category_id">
								<option selected="selected" value="0">choose</option>
								<?php foreach ($data['categories_list'] as $categ) :
								?>
								<option value="<?php echo $categ['id']?>"><?php echo $categ['display_name']
									?></option>
								<?php endforeach;?>
							</select>
							<label for="filephoto">Browse to upload photo :</label>
							<input type="file" name="filephoto" id="filephoto" />
						</fieldset>
						<fieldset>
							<legend>
								Step 2: Complete Photo Profile Info
							</legend>
							<label for="name">Enter Nickname:</label>
							<input type="text" name="name" id="name" value=""/>
							<label for="caption">add caption for the photo :</label>
							<textarea name="caption" id="caption"></textarea>
							<div class="terms custFontB">
								<p>
									Terms & Conditions
								</p>
								<div class="terms-box">
									<p>
										Please read the terms and conditions of the Pic of the Week competition (“Competition”) carefully.
									</p>
									<p>
										A. Competition Schedule
									</p>
									<p>
										Competition is ongoing and runs on a weekly basis.
										Entries for each week’s contest close at 12 noon on the Friday before the week the contest begins.
										Entries received after 12 noon on Friday will be scheduled to enter the contest in the week after next.
									</p>
									<p>
										B. Screening Of Entries

										Entries will undergo a screening process to ensure all competition rules are met.
										MumCentre and its parent company BDMG Pte Ltd reserve the right at their sole discretion to reject and disqualify any photograph(s) which is determined to be unsuitable for publishing without revealing the reasons for doing so and without prior notice.
										Entries that pass the screening process will be published on the next Monday at 2pm.
									</p>
								</div>
								<!-- .terms-box -->
								<div>
									<input type="checkbox" name="accept-terms" id="accept-terms"/>
									<label for="accept-terms">I accept all terms and conditions</label>
								</div>
							</div>
							<!-- .terms -->
						</fieldset>
						<!--
						<fieldset>
						<legend>
						Step 3: Share and Invite your friends to Vote
						</legend>
						<div class="find-addbook">
						<p>
						Find your friends using your Address Book
						</p>
						<ul>
						<li>
						Hotmail
						</li>
						<li>
						Ymail
						</li>
						<li>
						Gmail
						</li>
						</ul>
						</div>
						<div class="gmail-login">
						asas
						</div>
						</fieldset>
						<div class="fb-postwall">
						<a href="#"><?= img('system/btn-fb-postwall.png');?></a>
						</div>
						<hr class="blue" />
						-->
						<input type="hidden" name="pow_contest_id" id="pow_contest_id" value="<?php echo $data['activecontest']['id'];?>" />
						<button type="submit" name="" class="btn-submit-entry" id="pow_enter_btnsubmit">
							Submit
						</button>
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
<script type="text/javascript">
	$(document).ready(function() {
		var powEnter = function(e) {
			var frm = $('#powform');
			var reqdflds = ['pow_category_id', 'filephoto', 'name', 'caption', 'accept-terms'];
			var fldLabels = ['Category', 'Entry photo', 'Name', 'Caption', 'Terms'];
			var hasError = false;

			$(reqdflds).each(function(idx, fld) {
				var val = $('#' + fld).val();

				switch (fld) {
					case 'pow_category_id':
						if(val < 1) {
							alert(fldLabels[idx] + ' is required!');
							$('#' + fld).focus();
							hasError = true;
							return false;
						}
						break;
					case 'accept-terms':
						if(!$('#accept-terms').get(0).checked) {
							alert("Terms and conditions must be accepted.");
							$('#' + fld).focus();
							hasError = true;
							return false;
						}
						break;
					default:
						if(!val) {
							alert(fldLabels[idx] + ' is required!');
							$('#' + fld).focus();
							hasError = true;
							return false;
						}
						break;
				}
			});
			return !hasError;
		}

		$('#pow_enter_btnsubmit').bind('click', powEnter);

	});

</script>