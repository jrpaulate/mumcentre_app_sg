<div id="content">
  <?php render_partial('pow/cmspow_nav');?>
  <div class="powcms-table">
    <table id="table" class="sortable">
      <thead>
        <tr>
          <th><h3> Email Type </h3></th>
          <th><h3>Description</h3></th>
          <th><h3>Subject</h3></th>
          <th><h3>Message</h3></th>
        </tr>
      </thead>
      <tbody>
        <?php $cnt = 0;?>
        <?php foreach ($data['emailnotifications'] as $emailtype=>$email) :
        ?>
        <tr>
          <td><a href="cms_pow/admin/emailtemplate_edit/<?php echo $emailtype?>"><?php echo $emailtype;?></a></td>
          <td><a href="cms_pow/admin/emailtemplate_edit/<?php echo $emailtype?>"><?php echo $email['description'];?></a></td>
          <td><?php echo $email['subject'];?></td>
          <td><?php echo word_limit(htmlspecialchars( $email['message'],10) ) ?></td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
  </div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
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
    sorter.init("table", 0);
  });
</script>