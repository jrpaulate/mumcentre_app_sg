<div id="content">
  <?php render_partial('pow/cmspow_nav');?>
  <div class="powcms-header">
    <h3>Email Logs</h3>
    <span></span>
  </div>
  <div class="powcms-table">
    <table id="table" class="sortable">
      <thead>
        <tr>
          <th class="nosort" ><h3>#</h3></th>
          <!--          <th></th> -->
          <th class="nosort"><h3>ID</h3></th>
          <th><h3>From</h3></th>
          <th><h3>Recipient</h3></th>
          <th><h3>Subject</h3></th>
          <th><h3>Message</h3></th>
          <th><h3>Date</h3></th>
          <th><h3>Result</h3></th>
        </tr>
      </thead>
      <tbody>
        <?php $cnt = 0;?>
        <?php foreach ($data['email_log'] as $row):
        ?>
        <tr>
          <td width="10"><?php echo ++$cnt;?></td>
          <!--
          <td width="15">
          <input type="checkbox" name="category_id" id="category_id<?php echo $cnt;?>" value="<?php echo $row['id']?>">
          </td>-->
          <td width="20"><?php echo $row['id']?></td>
          <td><?php echo $row['email_from']?></td>
          <td><?php echo $row['email_rcpt']?></td>
          <td><?php echo word_limit($row['email_subject'])?></td>
          <td><?php echo word_limit(htmlentities($row['email_message']), 100);?></td>
          <td nowrap="nowrap"><?php echo $row['email_date']
          ?></td>
          <td width="30%">
            <?php echo word_limit(htmlentities($row['email_result']), 150);?>
        </td>
        </tr>
        <?php endforeach;?>
      </tbody>
    </table>
    <div id="controls">
      <div id="perpage">
        <select onchange="sorter.size(this.value)">
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20" selected="selected">20</option>
          <option value="50">50</option>
          <option value="100">100</option>
        </select>
        <span>Entries Per Page</span>
      </div>
      <div id="navigation">
        <img src="images/sorter/first.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1,true)" />
        <img src="images/sorter/previous.gif" width="16" height="16" alt="First Page" onclick="sorter.move(-1)" />
        <img src="images/sorter/next.gif" width="16" height="16" alt="First Page" onclick="sorter.move(1)" />
        <img src="images/sorter/last.gif" width="16" height="16" alt="Last Page" onclick="sorter.move(1,true)" />
      </div>
      <div id="text">
        Displaying Page <span id="currentpage"></span> of <span id="pagelimit"></span>
      </div>
    </div>
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
  sorter.init("table");

</script>