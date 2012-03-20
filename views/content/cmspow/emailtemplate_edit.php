<?php $item = $data['item']; $itemdata = $data['itemdata'];?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#submit_button').click(function(e) {
      var flds = {
        'item':'item',
        '<?php echo $item?>_subject': 'Subject',
        '<?php echo $item?>_message': 'Message',
      };
      var reqflds = ['<?php echo $item?>_subject','<?php echo $item?>_message'];
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

      $.post("cms_pow/admin/emailtemplate_edit/" + postdata.item, postdata, function(data) {
        if(data.code < 0) {
          alert(data.message);
        } else {
          alert(data.message);
          location.href = 'cms_pow/admin/emailtemplate';
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
        <h2> Edit Notification - <?php echo $data['item'];?></h2>
        <span><?php echo $data['itemdata']['description'];?></span>
        <br/><br/>
        <div id="articleinfo">
          <table>
            <tr>
              <td colspan="2"><i><font color="red">*</font> = Required Field</i></td>
            </tr>
            <tr>
              <td colspan="2">
                <strong>Subject:</strong><font color="red">*</font>
                <br/>
                <input type="text" name="<?php echo $item?>_subject" id="<?php echo $item?>_subject" value="<?php echo $itemdata['subject'];?>">
                <input type="hidden" name="item" id="item" value="<?php echo $item;?>">
              </td>
            </tr>
            <tr valign="top">
              <td>
                <strong>Message:</strong><font color="red">*</font>
                <br/>
                <textarea class="mceEditor" name="<?php echo $item?>_message" id="<?php echo $item?>_message" style="width:760px;height:400px;"><?php echo $itemdata['message'];?></textarea></td>
              <td>
                <p>
                    
                    <table  border="0" width="100%" style="width:100%;margin: 10px;">
                      <tr><td colspan="2"><strong>Codes Guide</strong></td></tr>
                    <?php foreach ($data['emailguide'] as $emailcode=>$emaildesc) : ?>
                      <tr>
                        <td style="padding:5px; background-color:#CCC;"><strong><?php echo $emailcode;?></strong></td>
                        <td nowrap><?php echo $emaildesc;?></td>                        
                      </tr>
                    <?php endforeach;?>                      
                    </table>
                </p>
              </td>                
            </tr>
          </table>
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
    theme_advanced_buttons1 : "newdocument,|,bold,italic,underline,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,formatselect",
    theme_advanced_buttons2 : "cut,copy,paste,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,|,code,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "insertdate,inserttime,|,spellchecker,advhr,,removeformat,|,sub,sup,|,charmap,emotions",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resizing : true
  });
</script>
