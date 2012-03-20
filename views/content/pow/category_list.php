<div id="content">
  <?php render_partial('pow/cmspow_nav');?>
  <!--
  <form id="frmMain" name="frmMain">
  <div class="searchbar">
  <ul>
  <li>
  <label for="search_key">Search by title:</label>
  <input type="text" id="search_key" name="search_key" />
  </li>
  <li>
  <a href="#" id="search_member">
  <input type="image" src="assets/img/system/img_search.png" />
  </a>
  </li>
  </ul>
  </div>
  </form>
  -->
  <div class="tableholder">
    <!--
    <div class='pager'>
    <span class='pageNumbers'></span>
    Page <span class='currentPage'></span> of <span class='totalPages'></span>
    </div>
    -->
  <a href="cms_pow/categories_add">Add New Category</a>
    <table class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td width="3%"></td>
        <td width="20%">Name</td>
        <td width="20%">Display Name</td>
        <td width="">Description</td>
        <td width="17%">Command</td>
      </tr>
    </table>
    <?php $cnt=0;?>
    <div id="article-listing">
      <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
        <?php foreach ($data['category_all'] as $row) :
        ?>
        <tr>
          <td width="3%"><?php echo ++$cnt;?></td>
          <td width="20%"><?php echo $row['name'];?></td>
          <td width="20%"><?php echo $row['display_name'];?></td>
          <td width=""><?php echo $row['description'];?></td>
          <td width="17%">
             <a class="actionbtn" href="cms_pow/categories_edit/<?php echo $row['id'];?>" id ="">Edit</a> |             
             <a class="actionbtn btndelete" href="cms_pow/categories_delete/<?php echo $row['id'];?>" id="id<?php echo $row['id'];?>"> Delete </a>
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
        if (! confirm("Are you sure you want to delete this Category?")) return false;
        var id = parseInt(  this.id.replace(/\D/g,'') , 10);
        
        $.post("cms_pow/categories_delete/" + id , {'id':id}, function(data) {
            if (data.code < 0) {
              alert(data.message);            
            } else {
              alert(data.message);
              location.href = 'cms_pow/categories';            
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


