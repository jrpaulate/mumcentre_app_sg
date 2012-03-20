<?php render_partial('pow/cmspow_nav');?>
<?php $info = $data['contest_info'];?>
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#create_contest').click(function(e) {
      var flds = {
        'name' : 'Contest Name',
        'description' : 'Description',
        'start_date' : 'Start Date',
        'end_date' : 'End Date'
      };
      var reqflds = ['name', 'start_date', 'end_date'];
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

      $.post("cms_pow/contest_edit/<?php echo $info['id']?>", postdata, function(data) {
          if (data.code < 0) {
            alert(data.message);            
          } else {
            alert(data.message);
            location.href = 'cms_pow/contest_list';            
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
        POW Contest
      </li>
    </ul>
    <div id="content-box">
      <div id="addnew-holder">
        <h2> Create New Contest </h2>
        <div id="articleinfo">
          <p>
            <i><font color="red">*</font> = Required Field</i>
          </p>
          <dl>
            <dt>
              <label for="title">Contest Name:</label>
            </dt>
            <dd>
              <input type="text" id="name" name="name" value="<?php echo $info['name']?>"/>
              <font color="red">*</font>
            </dd>
            <dt>
              <label for="title">Description:</label>
            </dt>
            <dd>
              <input type="text" id="description" name="description"  value="<?php echo $info['description']?>"/>
            </dd>
            <dt>
              <label for="author">Start Date <br/>(MM/DD/YYYY):</label>
            </dt>
            <dd>
              <input type="text" name="start_date" id="start_date" value="<?php echo $info['start_date']?>"/>
              <font color="red">*</font>
            </dd>
            <dt>
              <label for="author">End Date <br/>(MM/DD/YYYY):</label>
            </dt>
            <dd>
              <input type="text" name="end_date" id="end_date" value="<?php echo $info['end_date']?>"/>
              <font color="red">*</font>
            </dd>
          </dl>
        </div>
      </div>
      <div class="clear floatright" style="margin-top:20px;">
        <div class="cssanchor">
          <a href="#" id="create_contest" class="cssanchor">SUBMIT</a>
        </div>
        <div class="cssanchor">
          <a href="<?php echo base_url();?>cms_pow" class="cssanchor">BACK</a>
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