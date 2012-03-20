<div id="content">
  <?php render_partial('pow/cmspow_nav');?>
  <h2>POW Entries - <?php echo $data['contest_info']['name']?></h2>
  <?php foreach ($data['category_all'] as $categ) :?>
    <?php if ($data['pow_category_id'] == $categ['id']) : ?>      
      <strong><?php echo $categ['display_name'];?> (<?php echo $categ['entrycount'];?>)</strong>       
    <?php else: ?>
      [<a href="cms_pow/contest_entries/<?php echo $data['contest_info']['id'];?>/<?php echo $categ['id'];?>"><?php echo $categ['display_name'];?> (<?php echo $categ['entrycount'];?>)</a>]     
    <?php endif;?>    
  <?php endforeach;?>
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
        <td width="15%">Name</td>
        <td width="20%">Caption</td>
        <td width="10%">Photo</td>        
        <td width="5%">Total Votes</td>        
        <td width="25%">Command</td>
      </tr>
    </table>
    <?php $cnt=0;?>
    <div id="article-listing">
      <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
        <?php foreach ($data['entries'] as $row) :
        ?>
        <tr>
          <td width="1%"><?php echo ++$cnt;?></td>
          <td width="10%"><?php echo $row['user_id'];?> <!-- TODO: change this to user --></td>
          <td width="15%"><?php echo $row['name'];?></td>
          <td width="20%"><?php echo $row['caption'];?></td>
          <td width="10%">
            <a href="pow/entry_getphoto/<?php echo $row['token_id'];?>/320" target="_blank" class="popup-link">
              <img src="pow/entry_getphoto/<?php echo $row['token_id'];?>/100" width="50"/></a>            
          </td>        
          <td width="5%"><?php echo $row['points']?></td>                  
          <td width="25%">
             <a class="actionbtn" href="pow/entry/<?php echo $row['token_id'];?>" target="_blank">View Entry</a> |             
             <a class="actionbtn" href="cms_pow/entry_votes/<?php echo $row['id'];?>" id ="">View Detailed Votes </a> |             
             <a class="actionbtn btndelete" href="cms_pow/entry_delete/<?php echo $row['id'];?>" id ="">Delete</a>        
          </td>
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