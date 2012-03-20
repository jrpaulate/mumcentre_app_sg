<?php $entry = $data['entry_info'];?>
<div id="body2com">
  <div id="content1" class="clear1">
    <div id="content-main">
      <div id="section-head">
        <h2 class="custFontR">Pic of the Week</h2>
        <span class="sponsor-by">is Brought to you by:</span>
        <?php render_partial('pow/pow_navigation');?>
        <?php render_partial('pow/pow_categorylist');?>

      </div><!-- #section-head -->
      <div id="section-body">
        <div id="pow-body-athan">
          <div id="pow-latest">
            
            <?php render_partial('pow/pow_entry');?>
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
              <img src="assets/img/system/sample-winner.jpg" alt="Winner Name" width="50" height="50"/>
              <p>
                by <a href="#"><strong>Janet Lu</strong></a>
                <br/>
                <a href="#">http://www.facebook.com/janetLu</a>
                <br/>
                <span>Mom since 2001</span>
              </p>
            </div><!-- .winner-userinfo -->
            <div class="pow-past">
              <?php render_partial('pow/pow_contestentries.php');?>
            </div><!-- .pow-past -->
            <div class="ads">
              <div class="ads mini-one">
                <div id="pow_vote_mini_1" class="ads-text box white mini">
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
                <div id="pow_vote_mini_2" class="ads-text box white last mini">
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
              </div><!-- .ads .mini-one -->
            </div><!-- .ads -->
          </div><!-- .pow-body -->
          <div id="pow-fbcomment-box">
            <div id="fb-root"></div>
            <script>
              ( function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if(d.getElementById(id)) {
                  return;
                }
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
                fjs.parentNode.insertBefore(js, fjs);
              }(document, 'script', 'facebook-jssdk'));

            </script>
            <div class="fb-comments" data-href="<?php echo current_url();?>" data-num-posts="0" data-width="660"></div>
          </div><!-- #pow-fbcomment-box -->
        </div><!-- #pow-winners -->
        <div class="ads sponsors fleft">
          <div id="pow_vote_adword_1" class="sponsor-box box white fleft width">
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
          <div id="pow_vote_adword_2" class="sponsor-box box white fleft last width">
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
          <div id="pow_vote_adword_3" class="sponsor-box box white fleft width">
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
          <div id="pow_vote_adword_4" class="sponsor-box box white fleft last width">
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
            <div id="pow_vote_feat_item_1">
              <a class="next feat-box-more-link fright" title="See more deals!">more</a>
              <hr />
              <div class="reviews_scrollable">
                <div id="reviews-list" class="reviews_items">
                  <div>
                    <a href="#" title="Deal"><img class="fleft" src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
                    <p>
                      <strong>1 Learn Mathematics in a Systematic, Fun and Stress-Free Approach</strong>
                      <br/>
                      The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.
                    </p>
                  </div>
                  <div>
                    <a href="#" title="Deal"><img class="fleft" src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
                    <p>
                      <strong>2 Learn Mathematics in a Systematic, Fun and Stress-Free Approach</strong>
                      <br/>
                      The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.
                    </p>
                  </div>
                  <div>
                    <a href="#" title="Deal"><img class="fleft" src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
                    <p>
                      <strong>3 Learn Mathematics in a Systematic, Fun and Stress-Free Approach</strong>
                      <br/>
                      The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- .feat-box -->
          <div id="pow_vote_feat_item_2" class="feat-box box white">
            <h4>Upcoming Event</h4>
            <div>
              <a class="next feat-box-more-link fright" title="See more deals!">more</a>
              <hr />
              <div class="reviews_scrollable">
                <div class="reviews_items">
                  <div>
                    <a href="#" title="Deal"><img class="fleft" src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
                    <p>
                      <strong>4 Learn Mathematics in a Systematic, Fun and Stress-Free Approach</strong>
                      <br/>
                      The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.
                    </p>
                  </div>
                  <div>
                    <a href="#" title="Deal"><img class="fleft" src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
                    <p>
                      <strong>5 Learn Mathematics in a Systematic, Fun and Stress-Free Approach</strong>
                      <br/>
                      The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.
                    </p>
                  </div>
                  <div>
                    <a href="#" title="Deal"><img class="fleft" src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
                    <p>
                      <strong>6 Learn Mathematics in a Systematic, Fun and Stress-Free Approach</strong>
                      <br/>
                      The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo.
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div><!-- .feat-box -->
          <div id="pow_vote_feat_item_3" class="feat-box box white">
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
          <div id="pow_vote_feat_item_4" class="feat-box box white">
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

<script type="text/javascript">
  $(document).ready(function() {
    $(".scrollable").scrollable();
    $(".reviews_scrollable").scrollable({
      circular : true
    });
    $.get("pow/review_data", function(response) {
      var data = JSON.parse(response);
      var template = ich.review_listing_tpl(data);
      $('#reviews-list').html('');
      $('#reviews-list').append(template);
      return false;
    });
  });

</script>
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/html" id="review_listing_tpl">
  <div class="cloned"><a href="#" title="Deal"><img class="fleft" src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
  <p><strong>Learn Mathematics in a Systematic, Fun and Stress-Free Approach</strong><br/>
  The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo. </p></div>
  {{#review_data}}
  {{#review}}
  <div>
  <a href="#" title="Deal"><img class="fleft" src="uploads/provider/review/image/{{review_image}}" alt="" width="98" height="75"/></a>
  <p><strong>{{review_title}}</strong><br/>
  {{review_summary}}
  </p>
  </div>
  {{/review}}
  {{/review_data}}
  <div class="cloned"><a href="#" title="Deal"><img class="fleft" src="assets/img/system/sample-dealday-small.jpg" alt="" /></a>
  <p><strong>Learn Mathematics in a Systematic, Fun and Stress-Free Approach</strong><br/>
  The Montessori approach is based on learning through experiences and working with concrete materials. This approach allo. </p></div>
</script>