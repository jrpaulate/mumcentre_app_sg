<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#submit_button').click(function(e) {
      var flds = {'item':'Item','value' : 'Value'};
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

      console.log(postdata);
      $.post("cms_pow/options_edit/" + postdata.item , postdata, function(data) {
          if (data.code < 0) {
            alert(data.message);            
          } else {
            alert(data.message);
            location.href = 'cms_pow/options';            
          }
          return true; 
      },'json');
      
      e.preventDefault();
      return false;
    });
  });

</script>
<form id="frmMain" name="frmMain">
  <div id="content">
    <ul class="ulsubnav">
      <li>
        POW Options
      </li>
    </ul>
    <div id="content-box">
      <div id="addnew-holder">
        <h2> Edit POW Options </h2>
        <div id="articleinfo">
          <p>
            <i><font color="red">*</font> = Required Field</i>
          </p>
          <dl>
            <dt>
              <label for="title"><?php echo $data['item']?>:</label>
              <input type="hidden" name="item" id="item" value="<?php echo $data['item']?>" />
            </dt>
            <dd>
              <input type="text" id="value" name="value" value="<?php echo $data['value']?>" />
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
          <a href="<?php echo base_url();?>cms" class="cssanchor">BACK</a>
        </div>
      </div>
    </div>
  </div>
  <div id="footer">
    <div class="container">
      Mumcentre CMS.
    </div>
  </div>
</form>