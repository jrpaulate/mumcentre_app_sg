<?php render_partial('pow/cmspow_nav');?>
<script type="text/javascript">
  $(document).ready(function() {

    $('.date_ff').datepicker({'minDate':0});  
    
    
    $('#create_contest').click(function(e) {
      var flds = {
        'name' : 'Contest Name',
        'description' : 'Description',
        'age_group_id' : 'Age/Group',
        'submission_start_date' : 'Submission Start Date',
        'submission_end_date' : 'Submission End Date',
        'voting_start_date' : 'Voting Start Date',
        'voting_end_date' : 'Voting End Date',
      };
      var reqflds = ['name','description','age_group_id','submission_start_date','submission_end_date','voting_start_date','voting_end_date'];
      var postdata = {};

      var errorMsg = false;

      $.each(flds, function(key, label) {
        console.log(key);
        var value = $('#' + key).val();
        value = value.replace("'", "`");
        console.log(value);

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

      $.post("cms_pow/contest_create", postdata, function(data) {
          if (data.code < 0) {
            alert(data.message);            
          } else {
            alert(data.message);
            location.href = 'cms_pow/contests/new';            
          }
          return true; 
      },'json');
      
      e.preventDefault();
      return false;
    });
  });

</script>
<div id="content" class="pow-content">
  <ul class="ulsubnav">
    <li>Entry Approval</li>
  </ul>
  <form name="" action="<?php echo site_url('cms_pow/entry_approve');?>" method="POST">
  <div id="content-box">
    <div>
      <h2>Approve Entry</h2>
      <div>
        <p>
          <i><font color="red">*</font> = Required Field</i>
        </p>
        <dl>
          <dt>
            <label for="name">Contest Name:</label>
          </dt>          
          <dd>
            <input type="text" id="name" name="name" />
            <font color="red">*</font>
          </dd>
          
          <dt>
            <label for="name">Age/Group:</label>
          </dt>          
          <dd>
            <select name="age_group_id" id="age_group_id">
              <?php foreach ($data['agegroup_list'] as $ag) :?>
              <option value="<?php echo $ag['id'];?>"><?php echo $ag['name'];?></option>
              <?php endforeach; ?>
            </select>
            <font color="red">*</font>
          </dd>          
                    
          <dt>
            <label for="description">Description:</label>
          </dt>                   
          <dd>
            <textarea id="description" name="description"></textarea>
          </dd>
          
          <dt>
            <label for="submission_start_date">Submission Start/End Date:</label>
          </dt>
          <dd>
            <input type="text" name="submission_start_date" id="submission_start_date" class="date_ff"/> to 
            <input type="text" name="submission_end_date" id="submission_end_date" class="date_ff"/> 
            <font color="red">*</font>
          </dd>
          
          <dt>
            <label for="voting_start_date">Voting Period Start/End Date:</label>
          </dt>
          <dd>
            <input type="text" name="voting_start_date" id="voting_start_date" class="date_ff"/> to 
            <input type="text" name="voting_end_date" id="voting_end_date" class="date_ff"/> 
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
