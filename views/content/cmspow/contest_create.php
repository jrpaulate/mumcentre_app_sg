<?php render_partial('pow/cmspow_nav');?>
<script type="text/javascript">
  $(document).ready(function() {

    $('.date_ff').datetimepicker({
      'minDate' : 0
    });

    $('#create_contest').click(function(e) {
      var flds = {
        'name' : 'Contest Name',
        'description' : 'Description',
        'country_id' : 'Country',
        'submission_start_date' : 'Submission Start Date',
        'submission_end_date' : 'Submission End Date',
        'voting_start_date' : 'Voting Start Date',
        'voting_end_date' : 'Voting End Date',
      };
      var reqflds = ['name', 'description', 'age_group_id', 'submission_start_date', 'submission_end_date', 'voting_start_date', 'voting_end_date'];
      var postdata = {};

      var errorMsg = false;

      $.each(flds, function(key, label) {
        var value = (key == 'description') ? tinyMCE.activeEditor.getContent() : $('#' + key).val();
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

      $.post("cms_pow/contest/create", postdata, function(data) {
        if(data.code < 0) {
          alert(data.message);
        } else {
          alert(data.message);
          location.href = 'cms_pow/contest/list';
        }
        return true;
      }, 'json');

      e.preventDefault();
      return false;
    });
  });
</script>
<?php $info = @issetVal($data['contest_info']);?>
<div id="content" class="pow-content">
  <form name="" action="<?php echo site_url('cms_pow/contest_create');?>" method="POST">
    <div id="content-box">
      <div>
        <h2> Create New Contest </h2>
        <div>
          <p>
            <i><font color="red">*</font> = Required Field</i>
          </p>
          <dl>
            <dt>
              <label for="name">Contest Name:</label>
            </dt>
            <dd>
              <input type="text" id="name" name="name" value="<?php echo @issetVal($info['name']);?>" />
              <font color="red">*</font>
            </dd>
            <dt>
              <label for="name"Display in Country:</label>
              </dt>
              <dd>
              <select name="country_id" id="country_id">
              <option value=""></option>
              
              <?php foreach ($data['country_list'] as $cc) :?>
              <?php if (@issetNE($info['country_id'])) {
                $issel = $info['country_id'] == $cc['id'] ? " selected " : "";                
              } else {
                $issel = CC_CODE == $cc['code'] ? " selected " : '';                
              }?>
              <option value="<?php echo $cc['id']?>" <?php echo $issel?>>
              <?php echo $cc['name'];?>
              </option>
              <?php endforeach;?>
              </select>
              <font color="red">*</font>
              </dd>

              <dt>
              <label for="description">Description / Terms :</label>
              </dt>
              <dd>
              <textarea id="description" name="description" class="mceEditor"><?php echo @issetVal($info['description']);?></textarea>
              </dd>

              <dt>
              <label for="submission_start_date">Submission Start/End Date:</label>
              </dt>
              <dd>
              <input type="text" name="submission_start_date" id="submission_start_date"  
                    value="<?php echo @issetNE($info['submission_start_date']) ? out_date($info['submission_start_date'], "m/d/Y"):'';?>" class="date_ff"/> to
              <input type="text" name="submission_end_date" id="submission_end_date"  
                    value="<?php echo @issetNE($info['submission_end_date']) ? out_date($info['submission_end_date'], "m/d/Y"):'';?>" class="date_ff"/>
              <font color="red">*</font>
              </dd>

              <dt>
              <label for="voting_start_date">Voting Period Start/End Date:</label>
              </dt>
              <dd>
              <input type="text" name="voting_start_date" id="voting_start_date"  
                value="<?php echo @issetNE($info['voting_start_date']) ? out_date($info['voting_start_date'], "m/d/Y"):'';?>" class="date_ff"/> to
              <input type="text" name="voting_end_date" id="voting_end_date" 
                value="<?php echo @issetNE($info['voting_end_date']) ? out_date($info['voting_end_date'], "m/d/Y"):'';?>" class="date_ff"/>
              <font color="red">*</font>
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
