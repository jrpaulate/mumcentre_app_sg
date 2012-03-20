<?php if ( @issetNE($data['contest_entries']) ) :?>
<p class="lblue">
  Category Participants: <?php echo $data['category_info']['name'];?>
</p>
<div class="scrollable">
  <div class="items">
    <div>      
      <ul class="entries-list">
        <?php $cnt=0;?>
        <?php foreach ($data['contest_entries'] as $row) : ?>          
        <li>
          <a href="<?php echo site_url('pow/entry/' . $row['token_id']); ?>"> <img src="<?php echo get_entry_photo($row['token_id'], $row['photo_filename'],100); ?>"
          alt="<?php echo $row['name']?>" title="<?php echo $row['name']?>"/><span>
            <?php echo $row['name']?></span></a>
        </li>
        <?php if (++$cnt%20 == 0) :?>
        </ul><ul class="entries-list">  
        <?php endif;?>
        
        <?php endforeach;?>

      </ul>
      
    </div>
  </div>
</div>
<div class="entries-list-pagination">
  <a class="prev prev_entry" title="Previous">Prev</a>
  <a class="next next_entry" title="Next">Next</a>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('.entries-list').hide().first().show();    
  var scroller = window.scroller = (function(){
    var fn = {};
    var  cnt = 0;
    
    fn.next = function(){
      var cur = $('.entries-list:visible');
      var nxt = cur.next();
      if (nxt.length) {
        $(nxt).show();$(cur).hide();
      }
      return false;
    }
    fn.prev = function (){
      var cur = $('.entries-list:visible');
      var prv = cur.prev();
      if (prv.length) {
        $(prv).show();$(cur).hide();
      }
      return false;
    }    
    return fn;
  })();  
  $('.entries-list-pagination .prev_entry').bind('click', scroller.prev);
  $('.entries-list-pagination .next_entry').bind('click', scroller.next);
})
</script>
<?php endif;?>
