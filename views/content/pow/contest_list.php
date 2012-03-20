<div id="content">
  <?php render_partial('pow/cmspow_nav');?>
  <a href="cms_pow/contest_create">Add New Contest Week</a>
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
        <td width="20%">Name</td>
        <td width="30%">Description</td>
        <td width="">Contest Dates</td>
        <td width="5%">Status</td>
        <td width="10%">Command</td>
        <td width="25%">Command</td>
      </tr>
    </table>
    <?php $cnt=0;?>
    <div id="article-listing">
      <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
        <?php foreach ($data['contest_all'] as $row) :
        ?>
        <tr>
          <td width="1%"><?php echo ++$cnt;?></td>
          <td width="20%"><?php echo $row['name'];?></td>
          <td width="30%"><?php echo $row['description'];?></td>
          <td width=""><?php echo out_date($row['start_date'])?> - <?php echo out_date($row['end_date'])?></td>
          <td width="5%"><?php echo $row['status'];?></td>
          <td width="10%">
             <?php if ($row['status'] == 'archived') :?>
               <a class="actionbtn btnactivate" href="cms_pow/contest_activate/<?php echo $row['id'];?>" id="act<?php echo $row['id'];?>">Activate</a>
             <?php endif;?>

             <?php if ($row['status'] == 'active') :?>
               <a class="actionbtn btnconclude" href="cms_pow/contest_conclude/<?php echo $row['id'];?>" id="conclude<?php echo $row['id'];?>">Conclude</a>
             <?php endif; ?>            

             <?php if ($row['status'] == 'concluded') :?>
             <a class="actionbtn" href="cms_pow/contest_results/<?php echo $row['id'];?>" id =""> ViewResults</a>
             <?php endif;?>
          </td>
          <td width="25%">

             <a class="actionbtn" href="cms_pow/contest_entries/<?php echo $row['id'];?>" id =""> View Entries </a> |
             <a class="actionbtn" href="cms_pow/contest_edit/<?php echo $row['id'];?>" id ="">Edit</a> |
             <a class="actionbtn btndelete" href="cms_pow/contest_delete/<?php echo $row['id'];?>" id="del<?php echo $row['id'];?>"> Delete </a>


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
      
      frmAct.activate = function (e){
        if (! confirm("Are you sure you want to activate this Contest Week?")) return false;
        var id = parseInt(  this.id.replace(/\D/g,'') , 10);
        
        $.post("cms_pow/contest_activate/" + id , {'id':id}, function(data) {
          
            if (data.code < 0) {
              alert(data.message);            
            } else {
              alert(data.message);
              location.href = 'cms_pow/contest_list';            
            }
            return true; 
        },'json');
        return false;        
      };
      
      frmAct.remove = function ( e ){
        if (! confirm("Are you sure you want to delete this Contest Week?")) return false;
        var id = parseInt(  this.id.replace(/\D/g,'') , 10);
        
        $.post("cms_pow/contest_delete/" + id , {'id':id}, function(data) {
            if (data.code < 0) {
              alert(data.message);            
            } else {
              alert(data.message);
              location.href = 'cms_pow/contest_list';            
            }
            return true; 
        },'json');
        return false;
      } 
      return frmAct;
    })();
    
    
    $('.btndelete').bind('click',formActions.remove);
    $('.btnactivate').bind('click',formActions.activate);

  });
</script>