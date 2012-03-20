<?php $entry = $data['entrydata'];?>
<div id="body2com">
	<div id="content1" class="clear1">
		<div id="content-main">
			<div id="section-head">
				<h2 class="custFontR">Pic of the Week</h2>
				<span class="sponsor-by">is Brought to you by:</span>
				<?php render_partial('pow/pow_navigation');?>
			</div><!-- #section-head -->
			<div id="section-body">
				<div id="pow-body-athan">
					<div id="pow-latest">
						<div class="img-wrapper">
							<img src="pow/entry_getphoto/<?php echo $entry['token_id']?>/320" alt="Photo Name" width="282"/>
						</div><!-- .img-wrapper -->
						<div class="info-wrapper">
							<div class="pow-badge">
								<p>
									<?php echo $entry['name'];?>
								</p>
							</div>
							<div class="pow-desc lblue">
								<p>
									<?php echo $entry['caption'];?>								</p>
							</div>
						</div><!-- .info-wrapper -->
						<div class="pow-share">
							<ul class="fleft">
								<li>
									<a href="#"><img src="assets/img/system/btn-twitter.png" alt="Twitter" /></a>
								</li>
								<li>
									<a href="#"><img src="assets/img/system/btn-stumbleupon.png" alt="StumbleUpon" /></a>
								</li>
								<li>
									<a href="#"><img src="assets/img/system/btn-email.png" alt="Email" /></a>
								</li>
								<li>
									<a href="#"><img src="assets/img/system/btn-fblike.jpg" alt="Like Us" /></a>
								</li>
							</ul>
							<div class="fright">
								View all comments
							</div>
						</div><!-- pow-share -->
						<div class="pow-userinfo clearfix">
							<img src="assets/img/system/sample-winner.jpg" alt="Winner Name" />
							<p>
								by <a href="#"><strong>Janet Lu</strong></a>
								<br/>
								<a href="#">http://www.facebook.com/janetLu</a>
								<br/>
								<span>Mom since 2001</span>
							</p>
						</div><!-- .winner-userinfo -->
						<div class="pow-past">
							<p class="lblue">		Past Winners: <?php echo $data['results']['display_name'];?>	</p>
							<ul class="entries-list">
							  <?php foreach ($data['pastwinners'] as $entry) :?>
								<li>
									<a href="<?php echo site_url('pow/entry/'.$entry['token_id']);?>?">
									   <img src="pow/entry_getphoto/<?php echo $entry['token_id']?>/100" alt="<?php echo $entry['name']?>" title="<?php echo $entry['name']?>"/><span><?php echo $entry["name"]?></span></a>
								</li>
								<?php endforeach;?>
							</ul>
							<div class="entries-list-pagination">
								<a href="#" class="prev" title="Previous">Prev</a>
								<a href="#" class="next" title="Next">Next</a>
							</div>
						</div>
					</div><!-- .pow-body -->
					<div id="pow-fbcomment-box">
						<img src="assets/img/system/sample-fbcomment.jpg" />
					</div><!-- #pow-fbcomment-box -->

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
                <strong>Page 1 of 2</strong>
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
				<div class="ads mini-two">
					<div class="ads-text box white fleft mini">
						<h4 class="violet">SportsKids</h4>
						<div class="img-wrapper fleft">
							<a href="#" title="Claim it now!"><img src="assets/img/system/sample-ad-logo.jpg" alt="SportsKids" title="SportsKids"/></a>
						</div>
						<div class="ad-promo">
							Enroll your kids before May 31 and get 25% Off on the June Holiday Program.
							<p>
								> <a href="#" title="Claim it now!">Claim your coupon.</a>
							</p>
						</div>
					</div><!-- .ads-text -->
					<div class="ads-text box white last fleft mini">
						<h4 class="violet">SportsKids</h4>
						<div class="img-wrapper fleft">
							<a href="#" title="Claim it now!"><img src="assets/img/system/sample-ad-logo.jpg" alt="SportsKids" title="SportsKids"/></a>
						</div>
						<div class="ad-promo">
							Enroll your kids before May 31 and get 25% Off on the June Holiday Program.
							<p>
								> <a href="#" title="Claim it now!">Claim your coupon.</a>
							</p>
						</div>
					</div><!-- .ads-text -->
				</div><!-- .ads .mini-two -->
				<div class="ads sponsors fleft">
					<div class="sponsor-box box white fleft width">
						<h4>Math Monkey</h4>
						<div>
							<a href="#" title="Deal"><img src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
							<p>
								The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.
								<br/>
								<a href="#">view details</a>
							</p>
						</div>
					</div><!-- .sponsor-box -->
					<div class="sponsor-box box white fleft last width">
						<h4>Children House</h4>
						<div>
							<a href="#" title="Deal"><img src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
							<p>
								The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.
								<br/>
								<a href="#">view details</a>
							</p>
						</div>
					</div><!-- .sponsor-box -->
					<div class="forum box white">
						<h4 class="lblue custFontR">Latest Forum Discussions</h4>
						<ul>
							<li>
								<a href="#">Fisher Price Linkadoos Kick and Play Piano</a>
							</li>
							<li>
								<a href="#">John Little Expo Fair</a>
							</li>
							<li>
								<a href="#">OG household fair</a>
							</li>
							<li>
								<a href="#">Unique Baby clothes - RARELY seen</a>
							</li>
							<li>
								<a href="#">Exchange $40 NTUC voucher to Capital land mall voucher</a>
							</li>
							<li>
								<a href="#">Gourmet Pizza</a>
							</li>
							<li>
								<a href="#">3-Day Multi Sports Boot Camp for your 3 - 6 Years Old Kids</a>
							</li>
							<li>
								<a href="#">Cute Children Furniture (Bookshelf, Storage Box etc)</a>
							</li>
						</ul>
					</div><!-- .forum -->
					<div class="sponsor-box box white fleft width">
						<h4>Math Monkey</h4>
						<div>
							<a href="#" title="Deal"><img src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
							<p>
								The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.
								<br/>
								<a href="#">view details</a>
							</p>
						</div>
					</div><!-- .sponsor-box -->
					<div class="sponsor-box box white fleft last width">
						<h4>Children House</h4>
						<div>
							<a href="#" title="Deal"><img src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
							<p>
								The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.
								<br/>
								<a href="#">view details</a>
							</p>
						</div>
					</div><!-- .sponsor-box -->
				</div><!-- .ads .sponsonrs -->
				<div class="ads features">
					<div class="feat-box box white">
						<h4>Featured Reviews</h4>
						<a class="feat-box-more-link fright" href="#" title="See more deals!">more</a>
						<hr />
						<div>
							<a href="#" title="Deal"><img class="fleft" src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
							<p>
								<strong>Learn Mathematics in a Systematic, Fun and Stress-Free Approach</strong>
								<br/>
								The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.
							</p>
						</div>
					</div><!-- .feat-box -->
					<div class="feat-box box white">
						<h4>Upcoming Event</h4>
						<a class="feat-box-more-link fright" href="#" title="See more deals!">more</a>
						<hr />
						<div>
							<a href="#" title="Deal"><img class="fleft" src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
							<p>
								<strong>Learn Mathematics in a Systematic, Fun and Stress-Free Approach</strong>
								<br/>
								The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.
							</p>
						</div>
					</div><!-- .feat-box -->
					<div class="feat-box box white">
						<h4>Featured Courses</h4>
						<a class="feat-box-more-link fright" href="#" title="See more deals!">more</a>
						<hr />
						<div>
							<a href="#" title="Deal"><img class="fleft" src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
							<p>
								<strong>Learn Mathematics in a Systematic, Fun and Stress-Free Approach</strong>
								<br/>
								The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.
							</p>
						</div>
					</div><!-- .feat-box -->
					<div class="feat-box box white">
						<h4>Featured Courses</h4>
						<a class="feat-box-more-link fright" href="#" title="See more deals!">more</a>
						<hr />
						<div>
							<a href="#" title="Deal"><img class="fleft" src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
							<p>
								<strong>Learn Mathematics in a Systematic, Fun and Stress-Free Approach</strong>
								<br/>
								The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.
							</p>
						</div>
					</div><!-- .feat-box -->
				</div><!-- .ads .features -->
			</div><!-- .section-body -->
		</div><!-- .content-main -->
	</div>
</div>
<div id="sidebar2">
	<?= render_partial('global/observer/sidebar'); ?>
</div>
<?= render_partial('global/default_footer');?>