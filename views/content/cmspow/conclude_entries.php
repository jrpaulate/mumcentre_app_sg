<?php $info = $data['contest_info'];?>
<script type="text/javascript">
  $(document).ready(function(){
    $('#viewcat').bind('change', function(){
      var cat = $('#viewcat').val();
      cat = cat ? "/" + cat : '';
      location.href='<?php echo site_url("/cms_pow/contest/conclude/{$info['id']}");?>' + cat;
      return false;
    });
  });
</script>
<div id="content">
  <?php render_partial('pow/cmspow_nav');?>
  <div class="powcms-header">
    <h3>Winning Entries for <?php echo $info['name']
    ?></h3>
    <span></span>
    <div class="btnback"><a href="<?php echo site_url('cms_pow/contest');?>">Go Back to Contests List</a></div>     
  </div>
  <div class="powcms-table">
    <div class="powcms-submenu">
      <ul>
        <li>
          <select name="viewcat" id="viewcat">
            <option value="">All Categories</option>
            <?php foreach ($data['category_list'] as $cat) :
            ?>
            <?php $issel = ($data['category_id'] == $cat['id']) ? " selected " : '';?>
            <option value="<?php echo $cat['id']?>" <?php echo $issel;?>><?php echo $cat['name']
              ?></option>
            <?php endforeach;?>
          </select>
        </li>
      </ul>
    </div>
    <?php if (@issetNE($data['entry_list'])) :
    ?>
    <table id="table" class="sortable">
      <thead>
        <tr>
          <th class="nosort"><h3>#</h3></th>
          <th class="nosort"><h3>Pic</h3></th>
          <th><h3>Name / Caption </h3></th>
          <th><h3>D O B</h3></th>
          <th><h3>Category</h3></th>
          <th><h3>Submitted By</h3></th>
          <th><h3>Submission Date</h3></th>
          <th><h3>Votes</h3></th>
        </tr>
      </thead>
      <tbody>
        <?php $cnt = 0;?>
        <?php foreach ($data['entry_list'] as $row) :
        ?>
        <tr>
          <td><?php echo ++$cnt;?></td>
          <td align="center">
          <div class="tbl-imgbox">
            <img src="<?php echo get_entry_photo($row['token_id'], $row['photo_filename'], 100);?>" />
          </div></td>
          <td><strong><?php echo $row['name']
          ?></strong> / <?php echo $row['caption']
          ?></td>
          <td><?php echo input_date($row['birth_date']);?></td>
          <td><?php echo $row['category_name'];?></td>
          <td><?php echo $row['first_name']
          ?> <?php echo $row['last_name']
          ?> (<?php echo $row['email_address']?>) </td>
          <td><?php echo input_date($row['concluded_date']);?></td>
          <td><?php echo $row['total_vote']
          ?> vote/s</td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
    <?php endif;?>
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
  sorter.init("table", 1);

</script>