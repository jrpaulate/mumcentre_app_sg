  <link rel="stylesheet" type="text/css" href="css/jquery.imgareaselect/imgareaselect-default.css" />
  <script type="text/javascript" src="js/ajaxupload.js"></script>
  <script type="text/javascript" src="js/jquery.imgareaselect.pack.js"></script>
  
  <script type="text/javascript">/*<![CDATA[*/
  $(document).ready(function(){
    new AjaxUpload('btn-upload', {
      action: 'pow/join_ajaxupload',
      responseType: 'json',
      onSubmit : function(file , ext){
        // Allow only images. You should add security check on the server-side.
        if (ext && /^(<?php echo $this->pow->options_get('allowed_imagetypes'); ?>)$/i.test(ext)){
          this.setData({ 'token_id': "<?php echo $data['token_id']?>",
                         'pow_contest_id': "<?php echo $data['activecontest']['id']?>" 
                        });
          $('#powv2-upload-div .text').text('Uploading ' + file);
          $('#img-loading').show();
          
          this.disable();
        } else {
          $('#powv2-upload-div .text').text('Error: only images are allowed');
          $('#img-loading').hide();
          return false;
        }
      },
      onComplete : function(file, response){
        
        if (response && /^(success)/i.test(response.status)) {
          var aspect = '<?php echo $this->pow->options_get('upload_image_aspect_ratio'); ?>';
          var wd = parseInt( aspect.split(":")[0],10 );
          var ht = parseInt( aspect.split(":")[1],10 );
          var img_wd = response.image_width;
          var img_ht = response.image_height;
          var max_wd, max_ht = 0;
          
          if (img_wd > img_ht) {
            max_ht = img_ht; // image is landscape, get the max height
            max_wd = Math.floor( max_ht * wd / ht);
          } else {
            max_wd = img_wd;
            max_ht = Math.floor( max_wd * ht / wd );
          }
          var imgsrc="pow/tempphoto/<?php echo $data['token_id']?>/" + response.file_name + '/' + response.image_type;
          $('#powv2-imageholder').html(' <img src="'+imgsrc+'" width="320"/> ');
          $('#powv2-upload-div .text').text('');
          
          $('#token_id').val('<?php echo $data['token_id']?>');
          $('#img_filename').val( response.file_name );
          $('#img_filetype').val( response.file_type );
          
          $('#powv2-imageholder img').imgAreaSelect({
                handles: true,
                aspectRatio: "<?php echo $this->pow->options_get('upload_image_aspect_ratio'); ?>",
                imageHeight: response.image_height,
                imageWidth: response.image_width,
                width:640,
                x1: 0, y1: 0,
                x2: max_wd, y2: max_ht, 
                //x2: max_wd, y2: max_ht,               
                onSelectEnd: function(img, selection){
                  $('#img-x1').val( selection.x1 ); 
                  $('#img-x2').val( selection.x2 );
                  $('#img-y1').val( selection.y1 );
                  $('#img-y2').val( selection.y2 );
                  $('#img-wd').val( selection.width );
                  $('#img-ht').val( selection.height );
                }
            });          
           
          $('#img-loading').hide();
          this.enable();
        } else {
          alert('Error uploading file ('+file+')! \n'+ response.issue);
          $('#powv2-upload-div .text').text('Upload FAILED. Please try again');
          this.enable(); 
        }
      }
    });
  });/*]]>*/</script>
  
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
								Step 1: Upload your Photo
							</legend>
							<label for="category_id">Choose a category :</label>
							<select name="category_id" id="category_id" onchange="$('#pow_category_id').val( this.value );">
								<option selected="selected" value="0">choose</option>
								<?php foreach ($data['categories_list'] as $categ) :
								?>
								<option value="<?php echo $categ['id']?>"><?php echo $categ['display_name']
									?></option>
								<?php endforeach;?>
							</select>
							<label for="filephoto">Browse to upload photo :</label>
							
							<div id="powv2-upload-div">
							  <div id="powv2-imageholder">
							  </div>
                <img src="img/loading.gif" id="img-loading" align="center" style="display:none;"/>                    
							  <button id="btn-upload" class="btn-upload">Select Photo</button><br/>
                <span class="text" style="display: inline-block;"></span>
							</div>
							
							
						</fieldset>
          <form id="powform" method="post">
            <input type="hidden" name="token_id" id="token_id" value="<?php echo $data['token_id']?>" />
            <input type="hidden" name="img_filename" id="img_filename" value="" />            						
            <input type="hidden" name="img_filetype" id="img_filetype" value="" />  
            <input type="hidden" name="pow_category_id" id="pow_category_id" value="" />
            
            <input type="hidden" name="img-x1" id="img-x1" value=""/>
            <input type="hidden" name="img-y1" id="img-y1" value=""/>
            <input type="hidden" name="img-x2" id="img-x2" value=""/>
            <input type="hidden" name="img-y2" id="img-y2" value=""/>
            <input type="hidden" name="img-wd" id="img-wd" value=""/>
            <input type="hidden" name="img-ht" id="img-ht" value=""/>
            <inpu          
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
	<div class="cont-250">
		<img src="img/ads/mrec.jpg" width="300" height="250"/>
	</div>
	<!-- end cont-250 -->
	<?= render_partial('global/pow');?>
	<?= render_partial('global/create_photoblog');?>
	<?= render_partial('global/mum_tools');?>
	<div class="cont-250">
		<img src="img/ads/mrec.jpg" width="300" height="250"/>
	</div>
	<!-- end cont-250 -->
	<div class="cont-250">
		<img src="img/ads/mini_ad.jpg" width="300" height="100"/>
	</div>
	<!-- end cont-250 -->
	<div class="cont-250">
		<img src="img/ads/mini_ad.jpg" width="300" height="100"/>
	</div>
	<!-- end cont-250 -->
	<div class="cont-250">
		<?= render_partial('global/fb_recent_activity');?>
	</div>
	<!-- end cont-250 -->
	<div class="cont-250">
		<?= render_partial('global/deal_of_day');?>
	</div>
	<!-- end cont-250 -->
</div>
<?= render_partial('global/default_footer');?>
<script type="text/javascript">
	$(document).ready(function() {
		var powEnter = function(e) {
			var frm = $('#powform');
			var reqdflds = ['pow_category_id', 'img_filename', 'name', 'caption', 'accept-terms'];
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
