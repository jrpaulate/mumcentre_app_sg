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
						<?php if ($data['results']) :
						?>
						<h3 class="lblue custFontR">Latest Winners! <span>Congratulations!</span></h3>
						<ul class="all-winners">
						  
							<?php foreach ($data['results'] as $row) :
							?>
							<?php if ($row['token_id']) :
							?>
							<li>
								<p class="custFontR lblue">
									<a href="<?php echo site_url('pow/winners/' . $row['category_name']);?>" title="View"><?php echo $row['display_name'];?></a>
								</p>
								<a href="<?php echo site_url('pow/winners/' . $row['category_name']);?>" title="View"> <img src="<?php echo site_url('pow/entry_getphoto/' . $row['token_id']);?>/320" alt="Newborn" /></a>
							</li>
							<?php endif;?>
							<?php endforeach;?>
						</ul><!-- .all-winners -->
						<?php endif;?>
						<a href="<?php site_url('pow/join');?>" class="btn-rnd btn-pow-join custFontR" title="Join now!">click here to submit your entries and win great prizes</a>
					</div><!-- .pow-latest -->
					<div id="pow-entries-past">
						<div class="entries-past-head">
							<h4 class="lblue fleft custFontR">Past Entries</h4>
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
						</div><!-- .heading -->
						<div class="entries-past-body">
							<div class="scrollable">
								<div class="items">
									<div>
										<ul class="entries-list">
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-small.jpg" alt="John Lou" title="John Lou"/><span>Min Ling Nam</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-big.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>Lee Bag Kaba</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-small.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-big.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-small.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-ad1.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-ad1.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-big.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-ad1.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-small.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-big.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
										</ul>
									</div>
									<div>
										<ul class="entries-list">
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-small.jpg" alt="John Lou" title="John Lou"/><span>Min Ling Nam</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-big.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>Lee Bag Kaba</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-small.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-big.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-small.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-ad1.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-ad1.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-big.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-ad1.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-small.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-big.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
										</ul>
									</div>
									<div>
										<ul class="entries-list">
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-small.jpg" alt="John Lou" title="John Lou"/><span>Min Ling Nam</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-big.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>Lee Bag Kaba</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-small.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-big.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-small.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-ad1.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-ad1.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-big.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-ad1.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-small.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-dealday-big.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-pic.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
											<li>
												<a href="#"><img src="images/sample-winner.jpg" alt="John Lou" title="John Lou"/><span>John Lou</span></a>
											</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="entries-list-pagination">
								<a class="prev prev_entry" title="Previous">Prev</a>
								<a class="next next_entry" title="Next">Next</a>
							</div>
							<div class="entries-list-counter">
								<strong>Page 1 of 2</strong>
							</div>
						</div><!-- .entries-past-body -->
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
