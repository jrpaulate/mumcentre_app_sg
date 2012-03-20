<div id="content">
  <?php render_partial('pow/cmspow_nav');?>
  <h2>All Active Entries</h2>
  <div class="tableholder">
    <!--
    <div class='pager'>
    <span class='pageNumbers'></span>
    Page <span class='currentPage'></span> of <span class='totalPages'></span>
    </div>
    -->
    <?php $cnt = 0;?>
    <div id="article-listing">
      <div class="powcms-imglist">
        <?php foreach ($data['entries_list'] as $row) :
        ?>
        <div class="imgbox">
          <div class="imgcont">
            <a href="<?php echo get_entry_photo($row['token_id'], $row['photo_filepath']);?>" title="View full photo" target="_blank"> <img src="<?php echo get_entry_photo($row['token_id'], $row['photo_filepath'], 100);?>" / ></a>
          </div>
          <div class="imginfo">
            <h4><a href="<?php echo site_url("pow/entry/{$row['token_id']}");?>" target="_blank"><?php echo $row['name'];?></a></h4>
            <span><?php echo $row['caption'];?></span>
            <table>
              <tr>
                <td class="imginfo-label">Age/Group</td><td><?php echo $row['age_group_name']
                ?></td>
              </tr>
              <tr>
                <td class="imginfo-label">Contest</td><td><?php echo anchor("cms_pow/entries_pending/{$row['pow_contest_id']}", $row['contest_name']);?></td>
              </tr>
              <tr>
                <td class="imginfo-label">User</td><td><?php echo $row['first_name'];?> <?php echo $row['last_name'];?> (<?php echo $row['email_address'];?>)</td>
              </tr>
              <tr>
                <td class="imginfo-label">Status</td><td><?php echo strtoupper($row['status_name']);?></td>
              </tr>
              <tr>
                <td class="imginfo-label">Votes</td><td><?php if ($row['status'] == APPROVED_ENTRY) :
                ?>
                <?php echo $row['points'];?>
                <?php else:?>
                N/A
                <?php endif;?></td>
              </tr>
              <tr>
                <td colspan="2" align="center"><?php if ($row['status'] == PENDING_ENTRY) :
                ?>
                <a class="actionbtn btnapprove" href="cms_pow/entry_approve/<?php echo $row['id'];?>"> Approve Entry </a> &nbsp; <a class="actionbtn btnreject" href="cms_pow/entry_reject/<?php echo $row['id'];?>"> Reject Entry </a> &nbsp; <?php endif;?>

                <?php if ($row['status'] == APPROVED_ENTRY) :
                ?>
                <!-- <a class="actionbtn btnreject" href="cms_pow/entry_reject/<?php echo $row['id'];?>"> Reject Entry </a> &nbsp; --><a class="actionbtn" href="cms_pow/entry_votes/<?php echo $row['id'];?>">View Votes</a> &nbsp; <?php endif;?>

                <!--
                <a class="actionbtn" href="cms_pow/entry_edit/<?php echo $row['id'];?>">Edit Entry</a> &nbsp;--><a class="actionbtn btndelete" href="cms_pow/entry_delete/<?php echo $row['id'];?>">Delete Entry</a> &nbsp; </td>
              </tr>
            </table>
          </div>
        </div><!-- #imgbox-->
        <?php endforeach;?>
      </div><!-- #imglist-->
    </div>
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
      frmAct.entrydelete = function(e) {
        var href = this.href
        var id = parseInt(this.id.replace(/\D/g, ''), 10);
        var box = $(this).parents('div.imgbox')
        $(box).addClass('loading');
        if(! confirm("Are you sure you want to delete this Entry?") ) {
          $(box).removeClass('loading');
          return false;          
        }

        $.post(href, {
          'id' : id
        }, function(data) {

          if(data.code < 0) {
            alert(data.message);
          } else {
            alert(data.message);
            // remove this box
            $(box).fadeOut(1000);
          }
          return true;
        }, 'json');
        return false;
      };

      frmAct.approve = function(e) {
        var href = this.href
        var id = parseInt(this.id.replace(/\D/g, ''), 10);
        var box = $(this).parents('div.imgbox');
        
        $(box).addClass('loading');
        if(! confirm("Are you sure you want to approve this Entry?") ) {
          $(box).removeClass('loading');
          return false;          
        }

        $.post(href, {
          'id' : id
        }, function(data) {

          if(data.code < 0) {
            alert(data.message);
          } else {
            alert(data.message);
            $(box).fadeOut(1000);
          }
          return true;
        }, 'json');
        return false;
      };

      frmAct.reject = function(e) {
        var href = this.href
        var id = parseInt(this.id.replace(/\D/g, ''), 10);
        var box = $(this).parents('div.imgbox');
        $(box).addClass('loading');
        if(! confirm("Are you sure you want to reject this Entry?") ) {
          $(box).removeClass('loading');
          return false;          
        }

        $.post(href, {
          'id' : id
        }, function(data) {

          if(data.code < 0) {
            alert(data.message);
          } else {
            alert(data.message);
            $(box).fadeOut(1000);
          }
          return true;
        }, 'json');
        return false;
      };
      return frmAct;
    })();

    $('.btnapprove').bind('click', formActions.approve);
    $('.btnreject').bind('click', formActions.reject);
    $('.btndelete').bind('click', formActions.entrydelete);

  });

</script>