<div id="content">
  <?php render_partial('pow/cmspow_nav');?>
  <h2>POW Entry Votes - <?php echo $data['entry_info']['name'] ?></h2>
  <p><a href="pow/entry/<?php echo $data['entry_info']['token_id']?>" target="_blank">Entry Link</a>  
  <br/><br/><a href="javascript:;" onclick="history.go(-1);">&lt;&lt; Back </a>
    
  </p>
  <p>
    
  </p>
  <div class="tableholder">
    <!--
    <div class='pager'>
    <span class='pageNumbers'></span>
    Page <span class='currentPage'></span> of <span class='totalPages'></span>
    </div>
    -->
    <?php $cnt = 0;?>
    <?php if (! @issetNE($data['entry_votes']) || !is_array($data['entry_votes']) ) : ?>
      -- empty --
    <?php else:?>    
    <div id="article-listing">
      <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
        <thead>
          <tr>
            <th></th>
            <th>Email Address</th>
            <th>Status</th>
            <th>VoteCode</th>
            <th>IP Address</th>
            <th>Date Voted</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['entry_votes'] as $row) :?>
          <tr>
            <td><?php echo ++$cnt;?></td>
            <td><?php echo $row['email_address']?></td>
            <td><?php echo strtoupper( $row['status_name'] )?></td>
            <td><?php echo $row['vote_code']?></td>
            <td><?php echo $row['ip_address']?></td>
            <td><?php echo out_datetime($row['date_voted']);?></td>
          </tr>
          <?php endforeach;?>
        </tbody>
      </table>
    </div>
    <?php endif;?>
    <!--
    <div class='pager'>
    <span class='pageNumbers'></span>
    Page <span class='currentPage'></span> of <span class='totalPages'></span>
    </div>
    -->
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    window.formActions = (function() {
      var frmAct = {};

      frmAct.remove = function(e) {
        if(! confirm("Are you sure you want to delete this Entry?"))
          return false;
        var id = parseInt(this.id.replace(/\D/g, ''), 10);

        $.post("cms_pow/entry_delete/" + id, {
          'id' : id
        }, function(data) {
          if(data.code < 0) {
            alert(data.message);
          } else {
            alert(data.message);
            location.href = 'cms_pow/active_contest';
          }
          return true;
        }, 'json');
        return false;
      }
      return frmAct;
    })();
    $('.btndelete').bind('click', formActions.remove);
  });

</script>