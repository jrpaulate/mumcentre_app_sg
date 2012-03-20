<div id="content">
  <?php render_partial('pow/cmspow_nav');?>
  <h3><?php echo $data['page_title'];?></h3>
  <a href="cms_pow/contest_create">Add New Contest Week</a>
  <div class="tableholder">
    <!--
    <div class='pager'>
    <span class='pageNumbers'></span>
    Page <span class='currentPage'></span> of <span class='totalPages'></span>
    </div>
    -->
    <?php $cnt = 0;?>
    <?php if (! @issetNE($data['contests_list']) || !is_array($data['contests_list']) ) : ?>
      -- empty --
    <?php else:?>
    <div id="article-listing">
      <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
        <thead>
          <tr>
            <th></th>
            <th>Name</th>
            <th>Age/Group</th>
            <th>Submission Period</th>
            <th>Voting Period </th>
            <th>Status</th>
            <th>Command</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data['contests_list'] as $row) :
          ?>
          <tr>
            <td><?php echo ++$cnt;?></td>
            <td><strong><?php echo $row['name'];?></strong><span>
              <br/>
              <?php echo $row['description'];?></span></td>
            <td align="center"><?php echo $row['age_group'];?></td>
            <td align="center"><?php echo out_date($row['submission_start_date'])
            ?>-<?php echo out_date($row['submission_end_date'])
            ?></td>
            <td align="center"><?php echo out_date($row['voting_start_date'])
            ?>-<?php echo out_date($row['voting_end_date'])
            ?></td>
            <td align="center"><?php echo strtoupper($row['status_name']);?></td>
            <td align="center">
              
            <?php if ($row['status'] == INACTIVE_CONTEST) :?>
            <a class="actionbtn btnactivate" href="cms_pow/contest_submitstart/<?php echo $row['id'];?>" id="acts<?php echo $row['id'];?>">Activate Submission</a> &nbsp;
            <a class="actionbtn" href="cms_pow/contest_edit/<?php echo $row['id'];?>" id =""> Edit </a>&nbsp; 
            <a class="actionbtn btndelete" href="cms_pow/contest_delete/<?php echo $row['id'];?>" id="del<?php echo $row['id'];?>"> Delete </a></td>             
            <?php endif;?>

            <?php if ($row['status'] == ACTIVESUBMIT_CONTEST ) :
            ?>
            <a class="actionbtn btnactivate" href="cms_pow/contest_votingstart/<?php echo $row['id'];?>" id="actv<?php echo $row['id'];?>">Activate Voting</a> &nbsp; 
            <a class="actionbtn" href="cms_pow/entries_pending/<?php echo $row['id'];?>"> View Pending Entries </a> &nbsp; 
            <a class="actionbtn" href="cms_pow/entries/<?php echo $row['id'];?>"> View Approved Entries </a> &nbsp;
            <a class="actionbtn" href="cms_pow/contest_edit/<?php echo $row['id'];?>" id =""> Edit </a>&nbsp; 
            <a class="actionbtn btndelete" href="cms_pow/contest_delete/<?php echo $row['id'];?>" id="del<?php echo $row['id'];?>"> Delete </a></td>                          
            <?php endif;?>

            <?php if ($row['status'] == ACTIVEVOTING_CONTEST ) :?>
            <a class="actionbtn" href="cms_pow/entries/<?php echo $row['id'];?>"> View Approved Entries </a> &nbsp; 
            <a class="actionbtn btnconclude" id="conc<?php echo $row['id'];?>" href="cms_pow/contest_conclude/<?php echo $row['id'];?>"> Conclude </a> &nbsp; 
            <?php endif;?>
            
            <?php if ($row['status'] == CONCLUDED_CONTENT ) :?>
            <a class="actionbtn" href="cms_pow/contest_conclude/<?php echo $row['id'];?>"> Publish Winners </a> &nbsp;            
            <?php endif;?>
            

            <?php if ($row['status'] == PUBLISHED_CONTENT ) :?>
            <a class="actionbtn" href="cms_pow/results_view/<?php echo $row['id'];?>"> View Results </a> &nbsp;            
            <?php endif;?>
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

      frmAct.conclude = function(e) {
        var href = this.href
        var id = parseInt(this.id.replace(/\D/g, ''), 10);
        if(! confirm("Are you sure you want to conlude this Contest Week and select the Winners?"))
          return false;

        $.post(href, {
          'id' : id
        }, function(data) {
          if(data.code < 0) {
            alert(data.message);
          } else {
            alert(data.message);
            location.href = href;
          }
          return true;
        }, 'json');
        return false;
      };

      frmAct.activate = function(e) {
        var href = this.href
        var id = parseInt(this.id.replace(/\D/g, ''), 10);
        if(! confirm("Are you sure you want to activate this Contest Week?"))
          return false;

        $.post(href, {
          'id' : id
        }, function(data) {

          if(data.code < 0) {
            alert(data.message);
          } else {
            alert(data.message);
            location.href = 'cms_pow/contests/active';
          }
          return true;
        }, 'json');
        return false;
      };

      frmAct.remove = function(e) {
        if(! confirm("Are you sure you want to delete this Contest Week?"))
          return false;
        var id = parseInt(this.id.replace(/\D/g, ''), 10);

        $.post("cms_pow/contest_delete/" + id, {
          'id' : id
        }, function(data) {
          if(data.code < 0) {
            alert(data.message);
          } else {
            alert(data.message);
            location.reload(true);
          }
          return true;
        }, 'json');
        return false;
      }
      return frmAct;
    })();

    $('.btndelete').bind('click', formActions.remove);
    $('.btnactivate').bind('click', formActions.activate);
    $('.btnconclude').bind('click', formActions.conclude);
  });

</script>
