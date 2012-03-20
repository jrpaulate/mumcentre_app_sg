<?php $entry = $data['entry_info'];?>
<div class="img-wrapper">
  <img src="<?php echo get_entry_photo($entry['token_id'], $entry['photo_filename'],320); ?>" alt="Photo Name" width="320"/>
</div><!-- .img-wrapper -->
<div class="info-wrapper">
    <div class="pow-badge pow-vote" id="pow-vote-name">
        <p><?php echo $entry['name'] ?></p>
    </div>
    <div class="pow-desc lblue">
        <p>"<?php echo $entry['caption']?>"</p>
    </div>
</div><!-- .info-wrapper -->
<script type="text/javascript">
$(document).ready(function(){
  $('#pow-vote-name p')
    .css('cursor','pointer')
    .bind('click', function(e){
<?php if ($entry['contest_status'] == ACTIVEVOTING_CONTEST) : ?>
      location.href = 'pow/vote/<?php echo $entry['token_id']?>';
      return false;
<?php else: ?>
      alert("This entry is not part of the active Pick of the Week contest.");      
<?php endif;?>
    });
});
</script>