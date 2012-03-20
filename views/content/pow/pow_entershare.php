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
						<legend>
							Complete Photo Profile Info
						</legend>
						<div class="powV2-Entry">
							<div class="powImageWrapper">
								<img src="pow/entry_getphoto/<?php echo $entry['token_id']?>/320" alt="Photo Name" width="320"/>
							</div>
							<div class="powInfo">
								<h2 class="powTitle"><?php echo $entry['name']
								?></h2>
								<h5 class="powCaption"><?php echo $entry['caption']
								?></h5>
							</div>
							<span class="clear"></span>
							<div class="powText">
								<h3>Direct Link to your entry</h3>
								<hr size=1 />
								<p>
									<a href="pow/entry/<?php echo $entry['token_id']?>"><?php echo site_url('pow/entry/' . $entry['token_id']);?></a>
								</p>
								<p>
									Copy and paste the above link
								</p>
							</div>
						</div>
						<span class="clear"></span>
						<div class="powShare" id="pow-share-facebook">
							<a href="http://www.facebook.com/sharer.php?u=<?php echo site_url("pow/entry/{$entry['token_id']}");?>"> <?php echo img('system/btn-fb-postwall.png');?></a>
							</a>
						</div>
					</fieldset>
					<form name="pow-share" method="post">
						<fieldset>
							<legend>
								Step 3: Share and Invite your friends to Vote
							</legend>
							<label>Email Message</label>
							<span class="powEntry-msg" style="overflow:auto;background-color:#FFF;display: inline-block; border: 1px solid #AAA; padding: 5px; margin:  0 0 10px 0;width: 300px;height: 180px;"> <?php echo $this -> pow -> entry_emailshare_message($entry['id']);?></span>
							<label for="emailnote">Personal Note</label>
							<textarea name="emailnote" id="emailnote" style="width:300px;height:100px;">
Hi, 
              
Please vote my entry for the MUMs' Pick of the Week. 
              </textarea>
							<label for="emaillist">Email Address</label>
							<textarea name="emaillist" id="emaillist" style="font-size:10px;width:300px;height:300px;"></textarea>
							<label>Import Gmail Contacts</label>
							<span style="display: inline-block;"> <span>Username</span>
								<br/>
								<input type="text" name="gmail-name" id="gmail-name" value=""/>
								<br/>
								<span>Password</span>
								<br/>
								<input type="password" name="gmail-pass" id="gmail-pass" value=""/>
								<input type="hidden" name="gmail-provider" id="gmail-provider" value="gmail"/>
								<br/>
								<button name="btn-gmail" id="btn-gmail">
									Get Contacts
								</button>
								<br/>
								<span id="gmail-contacts"></span> </span>
							<br/>
							<br/>
							<label>Import Yahoo!Mail Contacts</label>
							<span style="display: inline-block;"> <span>Username</span>
								<br/>
								<input type="text" name="ymail-name" id="ymail-name" value=""/>
								<br/>
								<span>Password</span>
								<br/>
								<input type="password" name="ymail-pass" id="ymail-pass" value=""/>
								<input type="hidden" name="ymail-provider" id="ymail-provider" value="yahoo"/>
								<br/>
								<button name="btn-yahoo" id="btn-yahoo">
									Get Contacts
								</button>
								<br/>
								<span id="yahoo-contacts"></span> </span>
							<br/>
							<br/>
							<label>&nbsp;</label>
							<span style="display: inline-block;">
								<button name="btnSubmit" id="btnSubmit" onclick="this.form.submit();">
									Send Message
								</button> </span>
						</fieldset>
					</form>
				</div><!-- .enter-form -->
			</div><!-- .section-body -->
		</div><!-- .content-main -->
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function() {
		var sendInviter = function(provider, username, password) {
			var postdata = {
				'provider' : provider,
				'username' : username,
				'password' : password
			};

			$('#btn-' + provider).attr('disabled', true).html('Please wait...');

			$.post('pow/fetch_contact', postdata, function(resp) {
				if(resp.code < 0) {
					$('#' + provider + '-contacts').html(resp.message);
				} else {
					var contacts = resp.message;
					var emails = [];
					$.each(contacts, function(email, name) {
						if(email) {
							//emails.push(name + "<" +email+ ">");
							emails.push(email);
						}
					});
					var emlval = $('#emaillist').val() + emails.join("\n");

					$('#emaillist').val(emlval);
				}
				$('#btn-' + provider).attr('disabled', false).html('Get Contacts');
			}, 'json').error(function() {
				alert("Error sending request!");
				$('#btn-' + provider).attr('disabled', false).html('Get Contacts');
			});
			return false;

		}

		$('#btn-gmail').bind('click', function() {
			var usr = $('#gmail-name').val();
			var pwd = $('#gmail-pass').val();
			var prov = $('#gmail-provider').val();

			return sendInviter(prov, usr, pwd);
		});

		$('#btn-yahoo').bind('click', function() {
			var usr = $('#ymail-name').val();
			var pwd = $('#ymail-pass').val();
			var prov = $('#ymail-provider').val();

			return sendInviter(prov, usr, pwd);
		});
	});

</script>
<div id="sidebar2">
	<?= render_partial('global/observer/sidebar'); ?>
</div>
<?= render_partial('global/default_footer');?>