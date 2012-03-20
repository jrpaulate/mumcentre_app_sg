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
        <?php foreach ($data['contest_results'] as $row) :
        ?>
        <tr>
          <td width="1%"><?php echo ++$cnt;?></td>
          <td width="10%"><?php echo @issetVal($row['user_id'],'');?> <!-- TODO: change this to user --></td>
          <td width="15%"><?php echo $row['display_name'];?></td>
          <td width="15%"><?php echo @issetVal($row['name'],'--');?></td>
          <td width="20%"><?php echo @issetVal($row['caption'],'--');?></td>
          <td width="10%">
            <?php if ($row['token_id']) : ?>
            <a href="pow/entry/<?php echo $row['token_id'];?>" target="_blank" class="popup-link">
              <img src="pow/entry_getphoto/<?php echo $row['token_id'];?>/100" width="50"/></a>              
            <?php endif; ?>            
          </td>        
          <td width="5%"><?php echo @issetVal($row['total_vote'], '');?></td>                  
        </tr>
        <?php endforeach; ?>
      </table>
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
  $(document).ready(function (){
    window.formActions = (function(){      
      var frmAct = {};
      
      frmAct.remove = function ( e ){
        if (! confirm("Are you sure you want to delete this Entry?")) return false;
        var id = parseInt(  this.id.replace(/\D/g,'') , 10);
        
        $.post("cms_pow/entry_delete/" + id , {'id':id}, function(data) {
            if (data.code < 0) {
              alert(data.message);            
            } else {
              alert(data.message);
              location.href = 'cms_pow/active_contest';            
            }
            return true; 
        },'json');
        return false;
      } 
      return frmAct;
    })();      
    $('.btndelete').bind('click',formActions.remove);
  });
</script>