<?php render_partial('pow/cmspow_nav');?>
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#submit_button').click(function(e) {
      var flds = {
        'name'        : 'Name',
        'display_name' : 'Name',
        'description' : 'Description'
      };
      var reqflds = ['name', 'display_name'];
      var postdata = {};

      var errorMsg = false;

      $.each(flds, function(key, label) {
        var value = (key != 'description') ? $('#' + key).val() : tinyMCE.get('description').getContent();
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
      console.log("log", postdata);
      $.post("cms_pow/categories_add", postdata, function(data) {
          if (data.code < 0) {
            alert(data.message);            
          } else {
            alert(data.message);
            location.href = 'cms_pow/categories';            
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
      <li>POW Contest Categories      </li>
    </ul>
    <div id="content-box">
      <div id="addnew-holder">
        <h2> Create New Category </h2>
        <div id="articleinfo">
          <p>
            <i><font color="red">*</font> = Required Field</i>
          </p>
          <dl>
            <dt>
              <label for="title"> Name:</label>
            </dt>
            <dd>
              <input type="text" id="name" name="name" />
              <font color="red">*</font>
            </dd>
            <dt>
              <label for="author">Display Name:</label>
            </dt>
            <dd>
              <input type="text" name="display_name" id="display_name"/>
              <font color="red">*</font>
            </dd>
            <dt>
              <label for="title">Description:</label>
            </dt>
            <dd>
              <input type="text" id="description" name="description" />
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