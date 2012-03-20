<ul class="section-action">
	<li <?php echo ($data['activenav']=='vote') ? ' class="selected"' :'' ?>>
		<a href="pow/vote" title="Vote Now">Vote Now</a>
	</li>
	<li <?php echo ($data['activenav']=='join') ? ' class="selected"' :'' ?>>
		<a href="pow/join" title="Enter the Contest" id="pow_enter_contest">Enter the Contest</a>

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

	</li>
	<li <?php echo ($data['activenav']=='winners') ? ' class="selected"' :'' ?>>
		<a href="pow/winners" title="Past Entries/Winners">Past Entries/Winners</a>
	</li>
	<li <?php echo ($data['activenav']=='about') ? ' class="selected"' :'' ?>>
		<a href="pow/about" title="About POW">About POW</a>
	</li>
</ul><!-- .section-action -->
<?php if (@issetNE($data['error'])) : ?>
	<div class="powv2-errors">
		<strong>ERROR:</strong>
  <?php foreach ($data['error'] as $err) : ?>
  	<span class="powv2-error-msg"><?php echo $err?></span>
	<?php endforeach; ?>
	</div>
<?php endif;?>