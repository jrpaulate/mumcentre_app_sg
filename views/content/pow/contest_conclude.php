<div id="content">
  <?php render_partial('pow/cmspow_nav');?>
  <h2>POW Results - <?php echo $data['contest_info']['name']?></h2>
  <div class="tableholder">
    <!--
    <div class='pager'>
    <span class='pageNumbers'></span>
    Page <span class='currentPage'></span> of <span class='totalPages'></span>
    </div>
    -->
    <table class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td width="1%"></td>
        <td width="10%">User</td>
        <td width="15%">Category</td>
        <td width="15%">Name</td>
        <td width="20%">Caption</td>
        <td width="10%">Photo</td>        
        <td width="5%">Total Votes</td>        
      </tr>
    </table>
    <?php $cnt=0;?>
    <div id="article-listing">
      <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
        <?php foreach ($data['category_list'] as $row ) :?>
        <tr>
          <td width="1%"><?php echo ++$cnt;?></td>
          <td width="10%">
            <?php if ( @issetNE( $data['winners'][ $row['name'] ]['token_id']) ) : ?>
              <?php echo @issetVal( $data['winners'][ $row['name'] ]['first_name'] ,'--');?>
              <?php echo @issetVal( $data['winners'][ $row['name'] ]['last_name'] ,'--');?> 
              (<?php echo @issetVal( $data['winners'][ $row['name'] ]['email_address'] ,'--');?>)
            <?php endif; ?>            
            </td>
          <td width="15%"><?php echo $row['display_name']?></td>
          <td width="15%"><?php echo @issetVal( $data['winners'][ $row['name'] ]['name'] ,'--');?></td>
          <td width="20%"><?php echo @issetVal( $data['winners'][ $row['name'] ]['caption'],'--');?></td>
          <td width="10%">
            <?php if ( @issetNE( $data['winners'][ $row['name'] ]['token_id']) ) : ?>
            <a href="pow/entry/<?php echo $data['winners'][ $row['name'] ]['token_id'];?>" target="_blank" class="popup-link">
              <img src="pow/entry_getphoto/<?php echo $data['winners'][ $row['name'] ]['token_id'];?>/100" width="50"/></a>              
            <?php endif; ?>            
          </td>        
          <td width="5%"><?php echo @issetVal($data['winners'][ $row['name'] ]['points'], '');?></td>                  
        </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</div>
<form id="frmMain" name="frmMain">
  <div id="content">
    <div id="content-box">
      <div id="addnew-holder">
        <h2>Conclude POW Contest - <?php echo $data['contest_info']['name']?> </h2>
        <div id="articleinfo">
          <p>
            <i><font color="red">*</font> = Required Field</i>
          </p>
          <dl>
            <dt>
              <label for="title">Notification Subject :</label>
            </dt>
            <dd>
              <input type="text" id="mail_subject" name="mail_subject" value="<?php echo $this->pow->options_get('winner_default_mail_subject');?>" />
              <font color="red">*</font>
            </dd><br/>
            <dt>
              <label for="title">Notification Message:</label>
            </dt>
            <dd>
              <textarea id="mail_msg" name="mail_msg" rows="10" cols="80"><?php echo $this->pow->options_get('winner_default_mail_msg');?></textarea>
            </dd>
          </dl>
        </div>
      </div>
      <div class="clear floatright" style="margin-top:20px;">
        <div class="cssanchor">
          <a href="javascript:;" id="contest_conclude" class="cssanchor">SUBMIT</a>
        </div>
        <div class="cssanchor">
          <a href="<?php echo base_url();?>/cms_pow" class="cssanchor">BACK</a>
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
<script type="text/javascript">
  $(document).ready(function() {
    $('#contest_conclude').click(function(e) {
      var flds = {
        'mail_subject' : 'Contest Name',
        'mail_msg' : 'Description',
      };
      var reqflds = ['mail_subject', 'mail_msg'];
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

      $.post("cms_pow/contest_conclude", postdata, function(data) {
          if (data.code < 0) {
            alert(data.message);            
          } else {
            alert(data.message);
            location.href = 'cms_pow/';            
          }
          return true; 
      },'json');
      
      e.preventDefault();
      return false;
    });
  });

</script>
