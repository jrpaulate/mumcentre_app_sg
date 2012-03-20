  <link rel="stylesheet" type="text/css" href="css/jquery.imgareaselect/imgareaselect-default.css" />
  <script type="text/javascript" src="js/ajaxupload.js"></script>
  <script type="text/javascript" src="js/jquery.imgareaselect.pack.js"></script>
  
  <script type="text/javascript">
  $(document).ready(function(){
    new AjaxUpload('btn-upload', {
      action: 'pow/join_ajaxupload',
      responseType: 'json',
      onSubmit : function(file , ext){
        // Allow only images. You should add security check on the server-side.
        if (ext && /^(<?php echo $this->pow->options_get('allowed_imagetypes'); ?>)$/i.test(ext)){
          this.setData({ 'token_id': "<?php echo $data['token_id']?>",
                         'pow_category_id': $('#pow_category_id').val()
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
          var imgsrc='<?php echo $data['upload_path'];?>/<?php echo $data['token_id']?>/' + response.file_name;//response.file_url;
          $('#powv2-imageholder').html(' <img src="'+imgsrc+'" width="320"/> ');
          $('#powv2-upload-div .text').text('');
          
          $('#token_id').val('<?php echo $data['token_id']?>');
          $('#img_filename').val( response.file_name );
          $('#img_filetype').val( response.file_type );
          
          $('#powv2-imageholder img').imgAreaSelect({
                handles: true,
                //aspectRatio: "<?php echo $this->pow->options_get('upload_image_aspect_ratio'); ?>",
                imageHeight: response.image_height,
                imageWidth: response.image_width,
                width: img_wd,
                x1: 0, y1: 0,
                x2: max_wd, y2: max_ht, 
                onInit: function (img, selection){
                  $('#img-x1').val( selection.x1 ); 
                  $('#img-x2').val( selection.x2 );
                  $('#img-y1').val( selection.y1 );
                  $('#img-y2').val( selection.y2 );
                  $('#img-wd').val( selection.width );
                  $('#img-ht').val( selection.height );                  
                },
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
  });
  </script>
  
  <div id="body2com">
  <div id="content1" class="clear1">
    <div id="content-main">
      <div id="section-head">
        <h2 class="custFontR">Pic of the Week </h2>
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
              <?php if (@issetNE($data['category_list'])) : ?>
              <select name="category_id" id="category_id" onchange="$('#pow_category_id').val( this.value );">
                <option selected="selected" value="0">choose</option>               
                <?php foreach ($data['category_list'] as $categ) :?>
                <option value="<?php echo $categ['id']?>"><?php echo $categ['name']?></option>
                <?php endforeach;?>
              </select>
              
              <?php endif;?>
              <div id="cat_desc"></div>
              <label for="filephoto">Browse to upload photo :</label>
              
              <div id="powv2-upload-div">
                <div id="powv2-imageholder"></div>
                <img src="img/loading.gif" id="img-loading" align="center" style="display:none;"/>                    
                <span style="display: block;">
                  <?php $maxmb = $this->pow->options_get('upload_max_kb') / 1000000; ?>
                  Maximum size of <?php echo  $maxmb ?>MB. 
                  Accepts <?php echo strtoupper($this->pow->options_get('allowed_imagetypes')); ?>.
                  
                </span>
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
            <fieldset>
              <legend>
                Step 2: Complete Photo Profile Info
              </legend>
              <label for="name">Enter Name:</label>
              <input type="text" name="name" id="name" value=""/>
              <label for="name">Date Of Birth:</label>
              <input type="text" name="birth_date" id="birth_date" value=""/>
              <label for="caption">Add caption for the photo :</label>
              <textarea name="caption" id="caption"></textarea>
              <div class="terms custFontB">
                <p><strong>Terms &amp; Conditions</strong></p>
                <div class="terms-box">
                  <?php if (@issetNE($data['contest_info'] ) ) : ?>
                    <?php echo $data['contest_info']['description']?>
                  <?php endif;?>
                </div>
                <!-- .terms-box -->
                <div>
                  <input type="checkbox" name="accept-terms" id="accept-terms"/>
                  <label for="accept-terms">I accept all terms and conditions</label>
                </div>
              </div>
              <!-- .terms -->
            </fieldset>

            <fieldset>
              <legend>
                Step 3: Share and Invite your friends to Vote
              </legend>
              <label for="email_list">Email Address</label>
              <span style="display: inline-block;">
                <textarea name="email_list" id="email_list" style="font-size:10px;width:300px;height:300px;"></textarea>
                <br/>
                <span>Email list separated by comma or new line</span>              
                <br/>
                <br/>
                <span><a href="javascript:;" id="btn-import-google">Import Gmail Contacts</a></span> | 
                <span><a href="javascript:;" id="btn-import-yahoo">Import Yahoo! Contacts</a></span>
              </span>                                
              <div class="import-contact" id="import-gmail">
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
              </div>
              <div class="import-contact" id="import-yahoo">
              <label>Import Yahoo! Contacts</label>
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
              </div>
              <br/>
            </fieldset>            
            <button type="submit" name="" class="btn-submit-entry" id="pow_enter_btnsubmit">Submit</button>
            <br/><br/><br/>

          </form>
        </div><!-- .enter-form -->
      

        </div><!-- .enter-form -->
      
      </div><!-- .section-body -->
      
    </div><!-- .content-main -->
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
      $('#' + provider + '-contacts').html('');

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
          var emlval = $('#email_list').val() + emails.join("\n");

          $('#email_list').val(emlval);
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
    
    $('#btn-import-google').bind('click', function(){
      $('#import-gmail').show();
      $('#import-yahoo').hide();
      return false;
    });
    
    $('#btn-import-yahoo').bind('click', function(){
      $('#import-gmail').hide();
      $('#import-yahoo').show();
      return false;
    });
  });

</script>
<div id="sidebar2">
  <?= render_partial('global/observer/sidebar'); ?>
</div>
<?= render_partial('global/default_footer');?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#category_id').change(function(e){
        $.get("pow/description/"+$(this).val(), function(response) {
                $('#cat_desc').html('');
                $('#cat_desc').append(response);
                return false;
            });
        e.preventDefault();
    })
    $('#birth_date').datepicker({
      changeMonth:true,changeYear:true,
      maxDate:"-D", yearRange:"c-75:"
      });  
    
    var powEnter = function(e) {
      var frm = $('#powform');
      var reqdflds = ['pow_category_id', 'img_filename', 'name', 'caption', 'accept-terms'];
      var fldLabels = ['Category ID', 'Entry photo', 'Name', 'Caption', 'Terms','Email List'];
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
