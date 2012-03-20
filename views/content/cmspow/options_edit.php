<script type="text/javascript">
  $(document).ready(function() {
    $('#submit_button').click(function(e) {
      var flds = {
        'item' : 'Item',
        'value' : 'Value'
      };
      var reqflds = ['value'];
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
      if(errorMsg) {
        alert(errorMsg);
        return false;
      }

      $.post("cms_pow/options_edit/" + postdata.item, postdata, function(data) {
        if(data.code < 0) {
          alert(data.message);
        } else {
          alert(data.message);
          location.href = 'cms_pow/options';
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
        <h2> Edit POW Options </h2>
        <div id="articleinfo">
          <table>
            <tr>
              <td colspan="2"><i><font color="red">*</font> = Required Field</i></td>
            </tr>
            <tr>
              <td colspan="2">
                <strong><?php echo @issetVal($this->pow->options_key[ $data['item']], $data['item']);?></strong>
              <input type="hidden" name="item" id="item" value="<?php echo $data['item']?>" />
              </td>
            </tr>
            <tr valign="top">
              <td>
              <?php
              preg_match('/(subject|message)/ims', $data['item'], $m);
              ?>
              <?php if (empty($m)):?>
              <input type="text" id="value" name="value" value="<?php echo $data['value']?>" />
              <?php else :?>
              <textarea name="value" id="value" style="width:760px;height:400px;"><?php echo $data['value']?></textarea>
              <?php endif;?>
              <font color="red">*</font>                
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
