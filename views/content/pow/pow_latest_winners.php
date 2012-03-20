<div id="body2com">
	<div id="content1" class="clear1">
		<div id="content-main">
			<div id="section-head">
				<h2 class="custFontR">Pic of the Week</h2>
				<span class="sponsor-by">is Brought to you by:</span>
				<?php render_partial('pow/pow_navigation');?>
			</div><!-- #section-head -->
			<div id="section-body">
				<div id="pow-body-athan" >
					<div id="pow-latest">
						<?php if ($data['results']) :	?>
						<h3 class="lblue custFontR">Latest Winners! <span>Congratulations!</span></h3>
						<ul class="all-winners">
						  
							<?php foreach ($data['results'] as $row) :
							?>
							<?php if ($row['token_id']) :
							?>
							<li>
								<p class="custFontR lblue">
                <a href="<?php echo site_url('pow/entry/'.$row['token_id']);?>" title="View">
									  <?php echo $row['category_name'];?></a>
								</p>
								<a href="<?php echo site_url('pow/entry/'.$row['token_id']);?>" title="View">
								  <img src="<?php echo get_entry_photo($row['token_id'], $row['photo_filename'],320); ?>" 
								        alt="<?php echo $row['category_name'];?>" /></a>
							</li>
							<?php endif;?>
							<?php endforeach;?>
						</ul><!-- .all-winners -->
						<?php endif;?>
						<a href="<?php site_url('pow/join');?>" class="btn-rnd btn-pow-join custFontR" title="Join now!">click here to submit your entries and win great prizes</a>
					</div><!-- .pow-latest -->
					<div id="pow-entries-past">
						<div class="entries-past-head">
							<h4 class="lblue fleft custFontR">Past Winners</h4>
							<!--
							<ul class="entries-count fleft">
								<li>
									<a class="lblue" href="#">All Entries</a><span>17,910 photos</span>
								</li>
								<li>
									<a class="lblue" href="#">Last Month</a><span>229 photos</span>
								</li>
								<li>
									<a class="lblue" href="#">Last Week</a><span>44 photos</span>
								</li>
							</ul>
							<form class="entries-search lblue fright" action="" method="post">
								<label for="from">From</label>
								<input type="text" name="from" value="" />
								<label for="from">To</label>
								<input type="text" name="to" value="" />
							</form>
							-->
						</div><!-- .heading -->
						<div class="entries-past-body">
							<div class="scrollable">
								<div class="items">
										<ul class="entries-list">
										  <?php $cnt=0;?>
										  <?php foreach ($data['results_all'] as $row) :?>
											<li>
												<a href="<?php echo site_url('pow/entry/'.$row['token_id']);?>">
												  <img src="<?php echo get_entry_photo($row['token_id'], $row['photo_filename'],100);?>" alt="<?php echo $row['name'];?>" title="<?php echo $row['name'];?>"/>
												  <span> <?php echo $row['name'];?></span></a>
											</li>
                      <?php if (++$cnt%36 == 0) :?>
                      </ul><ul class="entries-list">  
                      <?php endif;?>
											
											<?php endforeach;?>
										</ul>
									
									<!--
									<div>
										<ul class="entries-list">
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
                    </ul>
									</div>
									-->
								</div>
							</div>
							<div class="entries-list-pagination">
								<a class="prev prev_entry" title="Previous">Prev</a>
								<a class="next next_entry" title="Next">Next</a>
							</div>
							<div class="entries-list-counter">
								<strong>Page 1 of n</strong>
							</div>							
						</div><!-- .entries-past-body -->
<script type="text/javascript">
$(document).ready(function(){
  $('.entries-list').hide().first().show();
  var count = $('.entries-list').length;
  var curpage = 1;

  $('.entries-list-counter strong').html('Page ' + curpage + ' of ' + count);  
  var scroller = window.scroller = (function(){
    var fn = {};
    var  cnt = 0;
    
    fn.next = function(){
      var cur = $('.entries-list:visible');
      var nxt = cur.next();
      if (!nxt.length) return false;
      
      $(nxt).show();$(cur).hide();
      curpage++;
      $('.entries-list-counter strong').html('Page ' + curpage + ' of ' + count);  
        
      return false;
    }
    fn.prev = function (){
      var cur = $('.entries-list:visible');
      var prv = cur.prev();
      if (!prv.length) return false;
      
      $(prv).show();$(cur).hide();
      curpage--;
      $('.entries-list-counter strong').html('Page ' + curpage + ' of ' + count);  
      return false;
    }    
    return fn;
  })();  
  $('.entries-list-pagination .prev_entry').bind('click', scroller.prev);
  $('.entries-list-pagination .next_entry').bind('click', scroller.next);
})
</script>
						
					</div><!-- #pow-entries-past -->
				</div><!-- #pow-winners -->
			</div><!-- .section-body -->
		</div><!-- .content-main -->
	</div>
</div>
<div id="sidebar2">
	<?= render_partial('global/observer/sidebar'); ?>
</div>
<?= render_partial('global/default_footer');?>