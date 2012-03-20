<?php $info = $data['entry_info'];?>
<?php render_partial('pow/cmspow_nav');?>
<script type="text/javascript">
  $(document).ready(function() {
    $('.date_ff').datepicker();

  $('#create_contest').click(function(e) {
    var flds = {
        'name' : 'Name',
        'caption' : 'Caption',
        'birth_date' : 'DOB'
    };
    var reqflds = ['name','caption','birth_date'];
    var postdata = {};

    var errorMsg = false;

    $.each(flds, function(key, label) {
      var value = $('#' + key).val();
      value = value.replace("'", "`");
      if($.inArray(key, reqflds) >= 0 && !value.length) {
        errorMsg = label + " cannot be empty!";
        return false;
      }
      postdata[key] = value;
    });
  
    if(errorMsg) { alert(errorMsg);return false;}

    $.post("cms_pow/entry/edit/<?php echo $info['id']?>", 
      postdata, function(data) {
        alert(data.message);
        if (data.code >= 0) {
          location.href = '<?php echo $_SERVER['HTTP_REFERER'];?>';
        }        
        return true;
        },'json');
    e.preventDefault();
    return false;
  });    
    
    
  });

</script>
<div id="content" class="pow-content">
  <form name="" action="<?php echo site_url('cms_pow/contest_create');?>" method="POST">
    <div id="content-box">
      <div>
        <h2> Edit Entry </h2>
        <div>
          <p>
            <i><font color="red">*</font> = Required Field</i>
          </p>
          <dl>
            <dt>
              <label for="name">Name:</label>
            </dt>
            <dd>
              <input type="text" id="name" name="name" value="<?php echo $info['name'];?>" />
              <font color="red">*</font>
            </dd>
            <dt>
              <label for="caption">Caption:</label>
            </dt>
            <dd>
              <textarea type="text" id="caption" name="caption" /><?php echo $info['caption'];?></textarea> <font color="red">*</font>
            </dd>
            <dt>
              <label for="birth_date">Date of Birth:</label>
            </dt>
            <dd>
              <input type="text" id="birth_date" name="birth_date" class="date_ff" value="<?php echo out_date($info['birth_date'], "m/d/Y");?>"/>
              <font color="red">*</font>
            </dd>
            <dt>
              <label for="photo">Photo:
                <span>
                  <a href="javascript:;" title="90" class="btnrotate"> Rotate Left </a>
                  <a href="javascript:;" title="-90" class="btnrotate"> Rotate Right </a>
                </span>
                </label>
            </dt>
            <dd>
              <div class="rotatephoto">
                <img id="userphoto" src="<?php echo get_entry_photo($info['token_id'], $info['photo_filename'], 240);?>" />
              </div>
            </dd>
          </dl>
        </div>
      </div>
      <div class="clear floatright" style="margin-top:20px;">
        <div class="cssanchor">
          <a href="javascript:;" id="create_contest" class="cssanchor">SUBMIT</a>
        </div>
        <div class="cssanchor">
          <a href="javascript:;" class="cssanchor" onclick="history.go(-1);">BACK</a>
        </div>
      </div>
    </div>
  </form>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    var img = $('#userphoto');
    var src = $(img).attr('src');
    $('.btnrotate').bind('click', function() {
      var postdata = {entry_id:'<?php echo $info['id']?>'};
      postdata.angle =$(this).attr('title'); 
      
      $.post("cms_pow/entry_imagerotate/<?php echo $info['id']?>", 
        postdata, function(data) {
          var nusrc = src + '?rnd=' + (new Date().getTime());
          $(img).attr('src', nusrc);     
        });      
      return false;
    });
  });

</script>