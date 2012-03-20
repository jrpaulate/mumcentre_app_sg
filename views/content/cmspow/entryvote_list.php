<script type="text/javascript">
  $(document).ready(function(){    
    var im = {
      busy: function(){
        $('#loader').show();        
      },
      ready:function(){
        $('#loader').hide();        
      }
    }
    im.ready();
    $('#checkall').bind('click',function(){
      $('input[type=checkbox][name=vote_id]').attr('checked',this.checked);
      return true;      
    })
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
      
      im.busy();
      var jobs_done = 0;
      var imdone = function(data){
        jobs_done++;
        if(jobs_done == values.length) {
          location.reload();          
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
  <?php $info = $data['entry_info'];?>
  <?php render_partial('pow/cmspow_nav');?>
  <div class="powcms-header">
    <h3>Manage Vote for <?php echo $info['name']?></h3>
    <span></span>
    <div class="btnback"><a href="<?php echo site_url('cms_pow/contest');?>">Go Back to Contests List</a></div> 
  </div>
  <div class="powcms-table">    
    <div class="powcms-submenu">
      <ul>
        <li id="loader"><span><img src="/img/loading.gif"/>Please wait...</span></li>
        <li><a id="btndelete" title="Delete vote(s) ?" href="<?php echo site_url('cms_pow/entry/vote_delete');?>">Delete Vote</a></li>
      </ul>      
    </div>
  <?php if (@issetNE($data['vote_list'])) :?>
    <table id="table" class="sortable">
      <thead>
        <tr>
          <th class="nosort"><h3>#</h3></th>
          <th class="nosort">
            <h3><input type="checkbox" name="checkall" id="checkall"></h3>                        
          </th>
          <th><h3>Email Address</h3></th>
          <th><h3>IP Address</h3></th>
          <th><h3>Vote Code</h3></th>
          <th><h3>Date Voted</h3></th>
          <th><h3>Status</h3></th>
        </tr>
      </thead>
      <tbody>
        <?php $cnt=0;
        ?>
        <?php foreach ($data['vote_list'] as $row) :
        ?>
        <tr>
          <td><?php echo ++$cnt; ?></td>
          <td align="center">
            <input type="checkbox" name="vote_id" id="vote_id<?php echo $cnt;?>" value="<?php echo $row['id']?>">
          </td>
          <td><?php echo $row['email_address']?></td>
          <td align="center"><?php echo $row['ip_address']?></td>
          <td align="center"><?php echo @issetVal($row['vote_code'], '--');?></td>
          <td align="center"><?php echo out_datetime($row['date_voted']);?></td>
          <td align="center"><?php echo $this->pow->label_vote_status[$row['status'] ] ?></td>
        </tr>
        <?php endforeach;
        ?>
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
  sorter.init("table", 2);
</script>
