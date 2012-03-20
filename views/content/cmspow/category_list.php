  <?php $info = $data['contest_info'];?>
<script type="text/javascript">
  $(document).ready(function(){    
    var frm = {};
    frm.checkedValues = function(){
      var values = [];      
      $('input[type=checkbox]:checked').each(function(idx, elem){
        values.push( $(elem).val() );
      });      
      return values;
    } 
    
    frm.action = function (){      
      var values = frm.checkedValues();
      if (!values.length) return false;
      
      var msg = $(this).attr('title');
      var href =$(this).attr('href');
      if (! confirm(msg) ) return false;
      
      var jobs_done = 0;
      var imdone = function(data){
        jobs_done++;
        if(jobs_done == values.length) {
          //location.reload();          
        }
      }
      $(values).each(function(idx, val){
        //var href = href;
        var act=href + '/' + val;
        var postdata = {id:val};
        $.post(act, postdata,function(data){
          imdone();
          //console.log(data);
        });
      });
      return false;
    }
    
    $('#btndelete').bind('click', frm.action);
  });    
</script>
<div id="content">
  <?php render_partial('pow/cmspow_nav');?>
  <div class="powcms-header">
    <h3>Manage Category for <?php echo $info['name']?></h3>
    <span></span>
  </div>
  <div class="powcms-table">
    <div class="powcms-submenu">
      <ul>
        <li>
          <a href="<?php echo site_url('cms_pow/category/add/' . $info['id']);?>">Add New</a>
        </li>
        <li>
          <a id="btndelete" title="COnfirm delete categories?" href="<?php echo site_url('cms_pow/category_delete/' . $info['id']);?>">
            Delete</a>
        </li>
      </ul>
    </div>
    <table id="table" class="sortable">
      <thead>
        <tr>
          <th class="nosort" ><h3>#</h3></th>
          <th></th>
          <th class="nosort"><h3>ID</h3></th>
          <th><h3>Name</h3></th>
          <th class="nosort"><h3>Description</h3></th>
          <th class="nosort"><h3>Ordering</h3></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php $cnt = 0;?>
        <?php foreach ($data['category_list'] as $row):
        ?>
        <tr>
          <?php $cnt = $row['order'];?>
          <td width="10"><?php echo $row['order'];?></td>
          <td width="15">
          <input type="checkbox" name="category_id" id="category_id<?php echo $cnt;?>" value="<?php echo $row['id']?>">
          </td>
          <td width="20"><?php echo $row['id']?></td>
          <td><?php echo $row['name']
          ?></td>
          <td><?php echo $row['description']
          ?></td>
          <td><?php if ($cnt > 1) {
          ?>
          <a href="<?php echo site_url('cms_pow/category/up/' . $row['id']);?>" class="tblcmd">UP</a><?php }?>

          <?php if ($cnt < sizeof($data['category_list'])) {
          ?>
          <a href="<?php echo site_url('cms_pow/category/down/' . $row['id']);?>" class="tblcmd">DOWN</a><?php }?></td>
          
          <td><a href="<?php echo site_url('cms_pow/category/edit/' . $row['id']);?>" class="tblcmd">Edit</a></td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  var sorter = new TINY.table.sorter("sorter");
  sorter.head = "head";
  sorter.asc = "asc";
  sorter.desc = "desc";
  sorter.even = "evenrow";
  sorter.odd = "oddrow";
  sorter.evensel = "evenselected";
  sorter.oddsel = "oddselected";
  sorter.paginate = true;
  sorter.currentid = "currentpage";
  sorter.limitid = "pagelimit";
  sorter.init("table", 0);

</script>
