<script type="text/javascript">
  $(document).ready(function() {
    $('#submit_button').click(function(e) {
      var flds = {'value' : 'Value'};
      var reqflds = ['value'];
      var postdata = {};

      var errorMsg = false;

      $.each(flds, function(key, label) {
        var value = $('#' + key).hasClass('mceEditor') ? 
                      tinyMCE.activeEditor.getContent() : 
                      $('#' + key).val();
        value = value.replace("'", "`");

        if($.inArray(key, reqflds) >= 0 && !value.length) {
          errorMsg = label + " cannot be empty!";
          return false;
        }

        postdata[key] = value;
      });
      if(errorMsg) {
        alert(errorMsg);
        return false;
      }

      $.post("cms_pow/admin/aboutpow", postdata, function(data) {
        if(data.code < 0) {
          alert(data.message);
        } else {
          alert(data.message);
          location.href = 'cms_pow/admin/aboutpow';
        }
        return true;
      }, 'json');

      e.preventDefault();
      return false;
    });
  });

</script>
<div id="content" class="pow-content">
  <?php render_partial('pow/cmspow_nav');?>
  <form id="frmMain" name="frmMain">
    <div id="content-box">
      <div id="addnew-holder">
        <h2> Edit About POW Content </h2>
        <div id="articleinfo">
          <p>
            <i><font color="red">*</font> = Required Field</i>
          </p>
          <dl>
            <dd>
              <textarea name="value" id="value" style="width:760px;height:400px;" class="mceEditor"><?php echo $data['value']?></textarea>
              <font color="red">*</font>
            </dd>
          </dl>
        </div>
      </div>
      <div class="clear floatright" style="margin-top:20px;">
        <div class="cssanchor">
          <a href="#" id="submit_button" class="cssanchor">SUBMIT</a>
        </div>
        <div class="cssanchor">
          <a href="javascript:;" onclick="history.go(-1);" class="cssanchor">BACK</a>
        </div>
      </div>
    </div>
  </form>
</div>
<div id="footer">
  <div class="container">
    Mumcentre CMS.
  </div>
</div>
<script type="text/javascript">
  tinyMCE.init({
    mode : "specific_textareas",
    editor_selector : "mceEditor",
    theme : "advanced",
    width : "640",
    height : "480",
    plugins : "paste",
    paste_auto_cleanup_on_paste : true,
    theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,formatselect",
    theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions",
    theme_advanced_buttons3_add : "pastetext,pasteword,selectall",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true
  }); 
 </script>