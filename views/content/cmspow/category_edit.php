<?php render_partial('pow/cmspow_nav');?>
<?php $info = $data['contest_info'];?>
<?php $cinfo = $data['category_info'];?>
<script type="text/javascript">
  $(document).ready(function() {
    $('#create_contest').click(function(e) {
      var flds = {
        'name' : 'Contest Name',
        'description' : 'Description'
      };
      var reqflds = ['name','description'];
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

      $.post("cms_pow/category/edit/<?php echo $cinfo['id']?>", postdata, function(data) {
          if (data.code < 0) {
            alert(data.message);            
          } else {
            alert(data.message);            
            location.href = '<?php echo site_url('/cms_pow/contest/categories/' . $info['id']);?>';            
          }
          return true; 
      },'json');
      
      e.preventDefault();
      return false;
    });
  });
</script>
<div id="content" class="pow-content">
  <form name="" action="<?php echo site_url('cms_pow/category/add');?>" method="POST">
  <div id="content-box">
    <div>
      <h2> Edit Category for <?php echo $info['name']?></h2>
      <div>
        <p>
          <i><font color="red">*</font> = Required Field</i>
        </p>
        <dl>
          <dt>
            <label for="name">Category Name:</label>
          </dt>          
          <dd>
            <input type="text" id="name" name="name" value="<?php echo $cinfo['name']?>"/>
            <font color="red">*</font>
          </dd>
                              
          <dt>
            <label for="description">Description:</label>
          </dt>                   
          <dd>
            <textarea id="description" name="description"><?php echo $cinfo['description']?></textarea>
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