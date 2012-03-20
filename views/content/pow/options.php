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
  <!--
  <ul>
    <li><a href="cms_pow/options_add">Add New Category</a></li>        
  </ul>
  -->
  
  <div class="tableholder">
    <!--
    <div class='pager'>
    <span class='pageNumbers'></span>
    Page <span class='currentPage'></span> of <span class='totalPages'></span>
    </div>
    -->
    <table class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td width="3%">ID</td>
        <td width="20%">Option Item</td>
        <td width="">Value </td>
        <td width="17%">Command</td>
      </tr>
    </table>
    <div id="article-listing">
      <table id="myTable" class="datatable" width="100%" cellpadding="0" cellspacing="0" border="0" >
        <?php foreach ($data['options_all'] as $row) : ?>
          <?php if ($row['item'] !== '__current_version') : ?>
        <tr>
          <td width="3%"><?php echo $row['id'];?></td>
          <td width="20%"><?php echo $row['item'];?></td>
          <td width=""><?php echo json_decode($row['value']);?></td>
          <td width="17%">
             <a class="actionbtn" href="cms_pow/options_edit/<?php echo $row['item'];?>" id ="">Edit</a>          
             <!-- <a class="actionbtn" href="cms_pow/options_delete/<?php echo $row['id'];?>"> Delete </a> -->
          </td>
        </tr>
        <?php endif;?>  
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
