<div class="pow-menu">
                <a href="pow/home" <?php echo ($data['activenav']=='home') ? ' class="selected"' :'' ?> ><div class="pow-menu-1">Home</div></a>
		<a href="pow/vote" <?php echo ($data['activenav']=='vote') ? ' class="selected"' :'' ?> title="Vote Now"><div class="pow-menu-1">Vote Now</div></a>
		<a href="pow/join" <?php echo ($data['activenav']=='join') ? ' class="selected"' :'' ?> title="Enter the Contest" id="pow_enter_contest"><div class="pow-menu-1">Enter the Contest</div></a>

  <?php if($this->session->userdata('logged_in')!== TRUE) : ?>
<script type="text/javascript">
$('document').ready(function(){
    $('#pow_enter_contest').click(function(e){
        $('#login_modal').dialog('open');
        e.preventDefault();
        return false;
     });
});
</script>
  <?php endif; ?>
		<a href="pow/winners" <?php echo ($data['activenav']=='winners') ? ' class="selected"' :'' ?> title="Past Entries/Winners"><div class="pow-menu-1">Past Entries/Winners</div></a>
		<a href="pow/about" <?php echo ($data['activenav']=='about') ? ' class="selected"' :'' ?> title="About POW"><div class="pow-menu-1">About POW</div></a>
</div>
<?php if (@issetNE($data['error'])) : ?>
	<div class="powv2-errors">
		<strong>ERROR:</strong>
  <?php foreach ($data['error'] as $err) : ?>
  	<span class="powv2-error-msg"><?php echo $err?></span>
	<?php endforeach; ?>
	</div>
<?php endif;?>