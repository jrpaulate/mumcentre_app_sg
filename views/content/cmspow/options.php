<div id="content">
  <?php render_partial('pow/cmspow_nav');?>

  <div class="powcms-table">
    <table id="table" class="sortable">
      <thead>
        <tr>
          <th><h3>Option</h3></th>
          <th><h3>Value</h3></th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['options_all'] as $row) :
        ?>
        <?php if ($row['item'] !== '__current_version') :
        ?>
        <tr>
          <td width="20%">
            <?php
            $label = @issetVal($this->pow->options_key[ $row['item'] ]);
            $label = $label ? "<strong>{$label}</strong><br/><em>[{$row['item']}]</em>" : $row['item'];
            echo $label;?>
          </td>
          <td width=""><?php
          $value = htmlspecialchars(json_decode($row['value']));
          echo strlen($value) > 100 ? substr($value, 0, 100) . '...<em>(more)</em>' : $value;
          ?></td>
          <td width="17%"><a class="actionbtn" href="cms_pow/options_edit/<?php echo $row['item'];?>" id ="">Edit</a><!-- <a class="actionbtn" href="cms_pow/options_delete/<?php echo $row['id'];?>"> Delete </a> --></td>
        </tr>
        <?php endif;?>
        <?php endforeach;?>
      </tbody>
    </table>
    <!--
    <div class='pager'>
    <span class='pageNumbers'></span>
    Page <span class='currentPage'></span> of <span class='totalPages'></span>
    </div>
    -->
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  var sorter = window.sorter = new TINY.table.sorter("sorter");
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
  sorter.init("table",0);
});
</script>