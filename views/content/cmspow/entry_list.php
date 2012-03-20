<?php $info = $data['contest_info'];?>
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
      $('input[type=checkbox][name=entry_id]').attr('checked',this.checked);
      return true;      
    })

    $('#viewcat').bind('change', function(){
      im.busy();
      var cat = $('#viewcat').val();
      cat = cat ? "/" + cat : '';
      location.href='<?php echo site_url("/cms_pow/contest/entries/{$info['id']}");?>/' + cat;
      return false;
    });
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
    
    frm.movetocategory = function (){
      var values = frm.checkedValues();
      var categid = $('#movetocategory').val();
      if (!values.length && categid) return false;
      
      var msg = "Are you sure you want to move the following entries?";
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
        var act= "/cms_pow/entry/moveto/" + val;
        var postdata = {id:val,categid:categid};
        $.post(act, postdata,function(data){
          imdone();
        });
      });
      return false;
    }
    
    
    $('#btndelete').bind('click', frm.action);
    $('#btnapprove').bind('click', frm.action);
    $('#btnreject').bind('click', frm.action);
    $('#btnpickwinner').bind('click', frm.action);
    $('#movetocategory').bind('change', frm.movetocategory)
  });    
</script>
<div id="content">
  <?php render_partial('pow/cmspow_nav');?>
  <div class="powcms-header">
    <h3>Manage Entries for <?php echo $info['name']?></h3>
    <span></span>
    <div class="btnback"><a href="<?php echo site_url('cms_pow/contest');?>">Go Back to Contests List</a></div> 
  </div>
  <div class="powcms-table">    
    <div class="powcms-submenu">
      <ul>
        <li id="loader"><span><img src="/img/loading.gif"/>Please wait...</span></li>
        <li><a id="btnapprove" title="Approve this entry?" href="<?php echo site_url('cms_pow/entry_approve');?>">Approve</a></li>
        <li><a id="btnreject" title="Reject this entry?" href="<?php echo site_url('cms_pow/entry_reject');?>">Reject</a></li>
        <li><a id="btndelete" title="Delete this entry?" href="<?php echo site_url('cms_pow/entry_delete');?>">Delete</a></li>
        <li><a id="btnpickwinner" title="Pick Entry as winner?" href="<?php echo site_url('cms_pow/entry_winner/'.$info['id']);?>">Pick as Winner?</a></li>
        <li>
          <select name="viewcat" id="viewcat">
          <option value="0" selected="selected">All Categories</option>
          <?php foreach ($data['category_list'] as $cat) :?> 
          <?php $issel = ($data['category_id'] == $cat['id']) ? " selected " :''; ?>                     
          <option value="<?php echo $cat['id']?>" <?php echo $issel;?>><?php echo $cat['name']?></option>
          <?php endforeach;?>
        </select></li>
        <li>
        <select name="movetocategory" id="movetocategory">
          <option>Move to Category...</option>
          <?php foreach ($data['category_list'] as $cat) :?> 
          <?php $issel = ($data['category_id'] == $cat['id']) ? " selected " :''; ?>                     
          <option value="<?php echo $cat['id']?>" <?php echo $issel;?>><?php echo $cat['name']?></option>
          <?php endforeach;?>
        </select></li>
        <!--
        <li><select name="movetocontest">
          <option>Move to contest...</option>
          <option>Contest #1</option>
          <option>Contest #2</option>
          <option>Contest #3</option>
        </select></li>-->
      </ul>      
    </div>
  <?php if (@issetNE($data['entry_list'])) :?>
    <table id="table" class="sortable">
      <thead>
        <tr>
          <th class="nosort"><h3>#</h3></th>
          <th class="nosort">
            <h3>
            <input type="checkbox" name="checkall" id="checkall">  
            </h3>                        
          </th>
          <th class="nosort"><h3>Pic</h3></th>
          <th><h3>Name / Caption </h3></th>
          <th><h3>D O B</h3></th>
          <th><h3>Category</h3></th>
          <th><h3>Submitted By</h3></th>
          <th><h3>Submission Date</h3></th>
          <th><h3>Votes</h3></th>
          <th><h3>Status</h3></th>
        </tr>
      </thead>
      <tbody>
        <?php $cnt=0;
        ?>
        <?php foreach ($data['entry_list'] as $row) :
        ?>
        <tr>
          <td><?php echo ++$cnt; ?></td>
          <td>
          <input type="checkbox" name="entry_id" id="entry_id<?php echo $cnt;?>" value="<?php echo $row['id']?>">
          </td>
          <td align="center">
          <div class="tbl-imgbox">
            <img src="<?php echo get_entry_photo($row['token_id'], $row['photo_filename'],100);?>" />
          </div></td>
          <td>
            <a href="<?php echo site_url('cms_pow/entry/edit/' . $row['id']);?>"> 
            <strong><?php echo $row['name'] ?></strong> / <?php echo $row['caption'] ?></a>
            <?php if (in_array($row['id'], $data['winning_ids'])) : ?>
              <span class="pow-winner">POW WINNER</span>
            <?php endif; ?>
          </td>
          <td>
            <?php echo out_date($row['birth_date']); ?></td>
          <td><?php echo $row['category_name']; ?></td>
          <td>
            <?php echo $row['first_name'] ?> 
            <?php echo $row['last_name'] ?>(<?php echo $row['email_address'] ?>)
          </td>
          <td align="center">
            <?php echo out_datetime($row['created_date']); ?></td>
          <td align="center">
            <?php if ($row['points']) :?>
            <a href="<?php echo site_url('cms_pow/entry/votes/' . $row['id']);?>"><?php echo $row['points'] ?> vote/s</a>
            <?php else:?>
            <?php echo $row['points'] ?> vote/s
            <?php endif;?>
          </td>
          <td align="center"><?php echo $this->pow->label_entry_status[$row['status'] ] ?></td>
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
  sorter.init("table", 8);

</script>
