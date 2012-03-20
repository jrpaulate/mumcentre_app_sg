<div class="nav clearfix">
    <ul class="clearfix" style="width:980px;height:50px;">
        <li class="selected"><a href="<?php echo base_url(); ?>">Home</a></li>
        <li class="dropnav cat-pregnancy"><a href="pregnancy">Pregnancy</a>
            <ul class="subnav sub-pregnancy">
                <li>
                    <div class="subnav-links clearfix">
                        <ul class="tabs" data-tabs="tabs">
                            <li class="active"><a href="#subcontent-home" class="mm_nav">Pregnancy Home</a></li>
                            <li><a href="#subcontent-forum" class="mm_nav">Forum</a></li>
                            <li><a href="#subcontent-pow" class="mm_nav">Pic of the Week</a></li>
                            <li><a href="#subcontent-products" class="mm_nav">Products & Services Updates</a></li>
                            <li><a href="#subcontent-articles" class="mm_nav">Articles, Partner Bloggers & Essentials</a></li>
                            <li><a href="#subcontent-events" class="mm_nav">Events & Programs</a></li>
                        </ul>
                    </div><!--.subnav-links -->							 
                    <div class="subnav-content tab-content">
                        <div id="subcontent-home" class="active tab-pane clearfix">
                            <h2>Top Pregnancy News</h2>
                            <div class="fleft col3">
                                <h4>Articles & Bloggers</h4>
                                <ul id="subcontent-home-ab">
                                </ul>
                            </div>
                            <div class="fleft col3">
                                <h4>Product & Service Updates</h4>
                                <ul id="subcontent-home-ps">
                                </ul>
                            </div>	
                            <div class="fleft col3">
                            <h4>Events & Programs</h4>
                            <ul id="subcontent-home-ep">
                            </ul>
                        </div>
                        </div><!-- .subcontent-home -->
                        <div id="subcontent-forum" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Pregnancy - Most Recent Forum Threads</h2>
                                <a href="forum/index.php?board=128" class="fright view-link"><small>view all</small></a>
                                <table id="sub-preg-entries-forum">
                                </table>
                            </div>
                            <div class="fleft col2">
	                            <h2>Pregnancy - Create a thread</h2>
                            	<?php if ($this->session->userdata("logged_in") == true) { ?>
                                
                                    <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="100">Topic : </td>
                                        <td><input id="preg_thread_topic" name="preg_thread_topic" style="width:100%;border:1px solid #abadb3;line-height:18px;" /></td>
                                    </tr>
                                    <tr>
                                        <td>Message : </td>
                                        <td><textarea id="preg_thread_msg" name="preg_thread_msg" style="width:100%;resize:none;margin:0px;padding:0px;border:1px solid #abadb3;" rows="3"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a href="javascript:void(0);" onclick="createThread('preg_thread_topic', 'preg_thread_msg', 2)" class="btn-rnd fright view-link"><small>POST</small></a></td>
                                    </tr>
                                    </table>
								<?php } else { ?>
                                	<table width="60%" cellpadding="5" align="center">
                                    	<tr valign="top">
                                        	<td width="50%"><a href="javascript:void(0);" onclick="callMMLogin();" title="Create a Thread">
                                            	<?= img('system/icon-forum-create.png'); ?>
                                            	<span class="block">You need to login<br />to create a thread</span></a></td>
                                            <td width="50%"><a href="user/register" title="Register">
                                            	<?= img('system/icon-forum-reg.png'); ?>
                                                <span class="block">No login? <br />Join us now!</span></a></td>
                                        </tr>
                                    </table>
                                <?php } ?>
                            </div>
                        </div><!-- .subcontent-forum -->
                        <div id="subcontent-pow" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Pic of the Week</h2>
                                <a href="#" class="btn-rnd fright view-link"><small>JOIN NOW</small></a>
                                    <ul class="clearfix">
                                        <li class="sub-pow-winner aCenter">
                                            <p class="aCenter">Last week's Winner</p>
                                            <a href="#" title="Archive Name">
                                            <div class="thumb t180x165" id="sub-pow-entries-cw"><!-- current winner pic --></div></a>
                                            <a href="#" title="View All Winners"><small>view all winners</small></a>
                                        </li>
                                        <li class="sub-pow-entries">
                                            <p class="aCenter">This week's entries</p>
                                            <ul class="clearfix" id="sub-pow-entries-ent">
                                                <!-- this week's entries -->
                                            </ul>
                                            <a href="#" class="view-link"><small>view all entries</small></a>
                                        </li>
                                    </ul>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Top Pic of the Week Archives</h2>
                                <a href="#" class="fright view-link"><small>view all</small></a>
                                <ul class="sub-pow-archive clearfix" id="sub-pow-entries-arc">
                                </ul>										
                            </div>
                        </div><!-- .subcontent-pow -->
                        <div id="subcontent-products" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Latest Products & Services</h2>
                                <a href="ps_providers" class="view-link"><small>view all</small></a>
                                <ul class="clearfix" id="sub-preg-entries-psu">
                                </ul>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Most Popular Products and Services</h2>
                                <ul class="clearfix" id="sub-preg-entries-mp">
                                </ul>										
                            </div>
                        </div><!-- .subcontent-products -->
                        <div id="subcontent-articles" class="tab-pane clearfix">
                            <div class="fleft col3 borderR">
                                <h2 class="fleft">Latest Articles</h2>
                                <ul class="clearfix" id="sub-preg-entries-art">
                                </ul>
                            </div>
                            <div class="fleft col3 borderR">
                                <h2 class="fleft">Latest Partner Bloggers</h2>
                                <ul class="clearfix" id="sub-preg-entries-pb">
                                </ul>									</div>
                            <div class="fleft col3 sub-essentials">
                                <h2 class="fleft">Pregnancy Essentials</h2>
                                <span class="stub-coming-soon"></span>
                                <ul class="clearfix">
                                    <li>
                                        <h3><em>Your Week by Week Guide</em></h3>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">1st Trimester</a>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">2nd Trimester</a>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">3rd Trimester</a>
                                        
                                    </li>
                                    <li>
                                        <h3><em>Vaccination Guide</em></h3>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="#"  class="inline" title="View">View</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .subcontent-articles -->
                        <div id="subcontent-events" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Select Date Range</h2>
                                <a href="#" class="view-link"><small>view all</small></a>
                                <form action="#" method="post" class="form-event-search">
                                    <ul class="clearfix" style="width:100%">
                                        <li class="col3">
                                            <span class="block">From:</span>
                                            <input type="text" name="mm_preg_from" id="mm_preg_from" readonly="readonly" onclick="setStickyMM(true);javascript:displayDatePicker('mm_preg_from')" placeholder="Select Date" />
                                            <a href="#" class="inline" onclick="setStickyMM(true);displayDatePicker('mm_preg_from');"><?= img('system/icon-calendar.jpg'); ?></a>
                                        </li>
                                        <li class="col3">
                                            <span class="block">To:</span>
                                            <input type="text" name="mm_preg_to" id="mm_preg_to"  value="" onclick="setStickyMM(true);javascript:displayDatePicker('mm_preg_to')" placeholder="Select Date"  />
                                            <a href="#" class="inline" onclick="setStickyMM(true);displayDatePicker('mm_preg_to');"><?= img('system/icon-calendar.jpg'); ?></a>
                                        </li>
                                        <li class="col3">
                                            <button class="btn-rnd" type="button" onclick="searchPregEvents(3);">Go</button>
                                        </li>
                                    </ul>
                                </form>
                                <h2 style="margin:0px;display:inline">Upcoming Courses &amp; Events</h2>
                                <a href="#" class="view-link" style="display:inline"><small>view all</small></a>
                                <dl class="clearfix" id="sub-preg-entries-event">
                                </dl>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Recommended Events &amp; Courses</h2>
                                <ul class="clearfix" id="sub-preg-entries-rnd">
                                </ul>										
                            </div>
                        </div><!-- .subcontent-events -->
                    </div><!-- .subnav-content -->
                    
                </li>
            </ul><!-- .subnav .sub-pregnancy -->			
        </li>
        <li class="dropnav cat-baby"><a href="baby">Baby</a>
            <ul class="subnav sub-baby">
                <li>
                    <div class="subnav-links clearfix">
                        <ul class="tabs" data-tabs="tabs">
                            <li class="active"><a href="#subcontent-baby-home" class="mm_nav">Baby Home</a></li>
                            <li><a href="#subcontent-baby-forum" class="mm_nav">Forum</a></li>
                            <li><a href="#subcontent-baby-pow" class="mm_nav">Pic of the Week</a></li>
                            <li><a href="#subcontent-baby-products" class="mm_nav">Products & Services Updates</a></li>
                            <li><a href="#subcontent-baby-articles" class="mm_nav">Articles, Partner Bloggers & Essentials</a></li>
                            <li><a href="#subcontent-baby-events" class="mm_nav">Events & Programs</a></li>
                        </ul>
                    </div><!-- .subnav-links -->
                    <div class="subnav-content tab-content">
                        <div id="subcontent-baby-home" class="active tab-pane clearfix">
                            <h2>Top Baby News</h2>
                            <div class="fleft col3">
                                <h4>Articles & Bloggers</h4>
                                <ul id="subcontent-baby-ab">
                                </ul>
                            </div>
                            <div class="fleft col3">
                                <h4>Product & Service Updates</h4>
                                <ul id="subcontent-baby-ps">
                                </ul>
                            </div>	
                            <div class="fleft col3">
                            <h4>Events & Programs</h4>
                            <ul id="subcontent-baby-ep">
                            </ul>
                        </div>
                        </div><!-- .subcontent-home -->
                        <div id="subcontent-baby-forum" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Baby - Most Recent Forum Threads</h2>
                                <a href="forum/index.php?board=129" class="fright view-link"><small>view all</small></a>
                                <table id="sub-baby-entries-forum">
                                </table>
                            </div>
                            <div class="fleft col2">
                                <h2>Baby - Create a thread</h2>
                            	<?php if ($this->session->userdata("logged_in") == true) { ?>
                                
                                    <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="100">Topic : </td>
                                        <td><input id="baby_thread_topic" name="baby_thread_topic" style="width:100%;border:1px solid #abadb3;line-height:18px;" /></td>
                                    </tr>
                                    <tr>
                                        <td>Message : </td>
                                        <td><textarea id="baby_thread_msg" name="baby_thread_msg" style="width:100%;resize:none;margin:0px;padding:0px;border:1px solid #abadb3;" rows="3"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a href="javascript:void(0);" onclick="createThread('baby_thread_topic', 'baby_thread_msg', 6)" class="btn-rnd fright view-link"><small>POST</small></a></td>
                                    </tr>
                                    </table>
								<?php } else { ?>
                                	<table width="60%" cellpadding="5" align="center">
                                    	<tr valign="top">
                                        	<td width="50%"><a href="javascript:void(0);" onclick="callMMLogin();" title="Create a Thread">
                                            	<?= img('system/icon-forum-create.png'); ?>
                                            	<span class="block">You need to login<br />to create a thread</span></a></td>
                                            <td width="50%"><a href="user/register" title="Register">
                                            	<?= img('system/icon-forum-reg.png'); ?>
                                                <span class="block">No login? <br />Join us now!</span></a></td>
                                        </tr>
                                    </table>
                                <?php } ?>
                            </div>
                        </div><!-- .subcontent-forum -->
                        <div id="subcontent-baby-pow" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Pic of the Week</h2>
                                <a href="#" class="btn-rnd fright view-link"><small>JOIN NOW</small></a>
                                    <ul class="clearfix">
                                        <li class="sub-pow-winner aCenter">
                                            <p class="aCenter">Last week's Winner</p>
                                            <a href="#" title="Archive Name">
                                            <div class="thumb t180x165" id="sub-baby-pow-entries-cw"></div></a>
                                            <a href="#" title="View All Winners"><small>view all winners</small></a>
                                        </li>
                                        <li class="sub-pow-entries">
                                            <p class="aCenter">This week's entries</p>
                                            <ul class="clearfix" id="sub-baby-pow-entries-ent">
                                            </ul>
                                            <a href="#" class="view-link"><small>view all entries</small></a>
                                        </li>
                                    </ul>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Top Pic of the Week Archives</h2>
                                <a href="#" class="fright view-link"><small>view all</small></a>
                                <ul class="sub-pow-archive clearfix" id="sub-baby-pow-arc">
                                    </ul>										
                            </div>
                        </div><!-- .subcontent-pow -->
                        <div id="subcontent-baby-products" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Latest Products & Services</h2>
                                <a href="ps_providers" class="view-link"><small>view all</small></a>
                                <ul class="clearfix" id="sub-baby-entries-psu">
                                </ul>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Most Popular Products and Services</h2>
                                <ul class="clearfix" id="sub-baby-entries-mp">
                                </ul>										
                            </div>
                        </div><!-- .subcontent-products -->
                        <div id="subcontent-baby-articles" class="tab-pane clearfix">
                            <div class="fleft col3 borderR">
                                <h2 class="fleft">Latest Articles</h2>
                                <ul class="clearfix" id="sub-baby-entries-art">
                                </ul>
                            </div>
                            <div class="fleft col3 borderR">
                                <h2 class="fleft">Latest Partner Bloggers</h2>
                                <ul class="clearfix" id="sub-baby-entries-pb">
                                </ul>									</div>
                            <div class="fleft col3 sub-essentials">
                                <h2 class="fleft">Baby Essentials</h2>
                                <span class="stub-coming-soon"></span>
                                <ul class="clearfix">
                                    <li>
                                        <h3><em>Your Week by Week Guide</em></h3>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">1st Trimester</a>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">2nd Trimester</a>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">3rd Trimester</a>
                                        
                                    </li>
                                    <li>
                                        <h3><em>Vaccination Guide</em></h3>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="#"  class="inline" title="View">View</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .subcontent-articles -->
                        <div id="subcontent-baby-events" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Select Date Range</h2>
                                <a href="#" class="view-link"><small>view all</small></a>
                                <form action="#" method="post" class="form-event-search">
                                    <ul class="clearfix">
                                        <li class="col3">
                                            <span class="block">From:</span>
                                            <input type="text" id="mm_baby_from" name="mm_baby_from" onclick="setStickyMM(true);displayDatePicker('mm_baby_from');" value="" placeholder="Select Date"  />
                                            <a href="javascript:void(0);" class="inline" onclick="setStickyMM(true);displayDatePicker('mm_baby_from');"><?= img('system/icon-calendar.jpg'); ?></a>
                                        </li>
                                        <li class="col3">
                                            <span class="block">To:</span>
                                            <input type="text" id="mm_baby_to" name="mm_baby_to" onclick="setStickyMM(true);displayDatePicker('mm_baby_to');" value="" placeholder="Select Date"  />
                                            <a href="javascript:void(0);" class="inline" onclick="setStickyMM(true);displayDatePicker('mm_baby_to');"><?= img('system/icon-calendar.jpg'); ?></a>
                                        </li>
                                        <li class="col3">
                                            <button class="btn-rnd" type="submit">Go</button>
                                        </li>
                                    </ul>
                                </form>
                                <h2 class="fleft">Upcoming Courses &amp; Events</h2>
                                <a href="#" class="view-link"><small>view all</small></a>
                                <dl class="clearfix" id="sub-baby-entries-event">
                                </dl>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Recommended Events &amp; Courses</h2>
                                <ul class="clearfix" id="sub-baby-entries-rnd">
                                </ul>										
                            </div>
                        </div><!-- .subcontent-events -->
                    </div><!-- .subnav-content -->
                </li>
            </ul>				
        </li>
        <li class="dropnav cat-toddler"><a href="toddler">Toddler</a>
            <ul class="subnav sub-toddler">
                <li>
                    <div class="subnav-links clearfix">
                        <ul class="tabs" data-tabs="tabs">
                            <li class="active"><a href="#subcontent-toddler-home" class="mm_nav">Toddler Home</a></li>
                            <li><a href="#subcontent-toddler-forum" class="mm_nav">Forum</a></li>
                            <li><a href="#subcontent-toddler-pow" class="mm_nav">Pic of the Week</a></li>
                            <li><a href="#subcontent-toddler-products" class="mm_nav">Products & Services Updates</a></li>
                            <li><a href="#subcontent-toddler-articles" class="mm_nav">Articles, Partner Bloggers & Essentials</a></li>
                            <li><a href="#subcontent-toddler-events" class="mm_nav">Events & Programs</a></li>
                        </ul>
                    </div><!-- .subnav-links -->
                    <div class="subnav-content tab-content">
                        <div id="subcontent-toddler-home" class="active tab-pane clearfix">
                            <h2>Top Toddler News</h2>
                            <div class="fleft col3">
                                <h4>Articles & Bloggers</h4>
                                <ul id="subcontent-toddler-ab">
                                </ul>
                            </div>
                            <div class="fleft col3">
                                <h4>Product & Service Updates</h4>
                                <ul id="subcontent-toddler-ps">
                                </ul>
                            </div>	
                            <div class="fleft col3">
                            <h4>Events & Programs</h4>
                            <ul id="subcontent-toddler-ep">
                            </ul>
                        </div>
                        </div><!-- .subcontent-home -->
                        <div id="subcontent-toddler-forum" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Toddler - Most Recent Forum Threads</h2>
                                <a href="forum/index.php?board=130" class="fright view-link"><small>view all</small></a>
                                <table id="sub-toddler-entries-forum">
                                </table>
                            </div>
                            <div class="fleft col2">
                                <h2>Toddler - Create a thread</h2>
                            	<?php if ($this->session->userdata("logged_in") == true) { ?>
                                
                                    <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="100">Topic : </td>
                                        <td><input id="toddler_thread_topic" name="toddler_thread_topic" style="width:100%;border:1px solid #abadb3;line-height:18px;" /></td>
                                    </tr>
                                    <tr>
                                        <td>Message : </td>
                                        <td><textarea id="toddler_thread_msg" name="toddler_thread_msg" style="width:100%;resize:none;margin:0px;padding:0px;border:1px solid #abadb3;" rows="3"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a href="javascript:void(0);" onclick="createThread('toddler_thread_topic', 'toddler_thread_msg', 7)" class="btn-rnd fright view-link"><small>POST</small></a></td>
                                    </tr>
                                    </table>
								<?php } else { ?>
                                	<table width="60%" cellpadding="5" align="center">
                                    	<tr valign="top">
                                        	<td width="50%"><a href="javascript:void(0);" onclick="callMMLogin();" title="Create a Thread">
                                            	<?= img('system/icon-forum-create.png'); ?>
                                            	<span class="block">You need to login<br />to create a thread</span></a></td>
                                            <td width="50%"><a href="user/register" title="Register">
                                            	<?= img('system/icon-forum-reg.png'); ?>
                                                <span class="block">No login? <br />Join us now!</span></a></td>
                                        </tr>
                                    </table>
                                <?php } ?>
                            </div>
                        </div><!-- .subcontent-forum -->
                        <div id="subcontent-toddler-pow" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Pic of the Week</h2>
                                <a href="#" class="btn-rnd fright view-link"><small>JOIN NOW</small></a>
                                    <ul class="clearfix">
                                        <li class="sub-pow-winner aCenter">
                                            <p class="aCenter">Last week's Winner</p>
                                            <a href="#" title="Archive Name">
                                            <div class="thumb t180x165" id="sub-toddler-pow-entries-cw"></div></a>
                                            <a href="#" title="View All Winners"><small>view all winners</small></a>
                                        </li>
                                        <li class="sub-pow-entries">
                                            <p class="aCenter">This week's entries</p>
                                            <ul class="clearfix" id="sub-toddler-pow-entries-ent">
                                            </ul>
                                            <a href="#" class="view-link"><small>view all entries</small></a>
                                        </li>
                                    </ul>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Top Pic of the Week Archives</h2>
                                <a href="#" class="fright view-link"><small>view all</small></a>
                                <ul class="sub-pow-archive clearfix" id="sub-toddler-pow-arc">
                                    </ul>										
                            </div>
                        </div><!-- .subcontent-pow -->
                        <div id="subcontent-toddler-products" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Latest Products & Services</h2>
                                <a href="ps_providers" class="view-link"><small>view all</small></a>
                                <ul class="clearfix" id="sub-toddler-entries-psu">
                                </ul>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Most Popular Products and Services</h2>
                                <ul class="clearfix" id="sub-toddler-entries-mp">
                                </ul>										
                            </div>
                        </div><!-- .subcontent-products -->
                        <div id="subcontent-toddler-articles" class="tab-pane clearfix">
                            <div class="fleft col3 borderR">
                                <h2 class="fleft">Latest Articles</h2>
                                <ul class="clearfix" id="sub-toddler-entries-art">
                                </ul>
                            </div>
                            <div class="fleft col3 borderR">
                                <h2 class="fleft">Latest Partner Bloggers</h2>
                                <ul class="clearfix" id="sub-toddler-entries-pb">
                                </ul>									</div>
                            <div class="fleft col3 sub-essentials">
                                <h2 class="fleft">Toddler Essentials</h2>
                                <span class="stub-coming-soon"></span>
                                <ul class="clearfix">
                                    <li>
                                        <h3><em>Your Week by Week Guide</em></h3>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">1st Trimester</a>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">2nd Trimester</a>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">3rd Trimester</a>
                                        
                                    </li>
                                    <li>
                                        <h3><em>Vaccination Guide</em></h3>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="#"  class="inline" title="View">View</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .subcontent-articles -->
                        <div id="subcontent-toddler-events" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Select Date Range</h2>
                                <a href="#" class="view-link"><small>view all</small></a>
                                <form action="#" method="post" class="form-event-search">
                                    <ul class="clearfix">
                                        <li class="col3">
                                            <span class="block">From:</span>
                                            <input type="text" id="mm_toddler_from" name="mm_toddler_from" onclick="setStickyMM(true);displayDatePicker('mm_toddler_from');" value="" placeholder="Select Date"  />
                                            <a href="javscript:void(0);" onclick="setStickyMM(true);displayDatePicker('mm_toddler_from');" class="inline"><?= img('system/icon-calendar.jpg'); ?></a>
                                        </li>
                                        <li class="col3">
                                            <span class="block">To:</span>
                                            <input type="text" id="mm_toddler_to" name="mm_toddler_to" onclick="setStickyMM(true);displayDatePicker('mm_toddler_to');" value="" placeholder="Select Date"  />
                                            <a href="javscript:void(0);" onclick="setStickyMM(true);displayDatePicker('mm_toddler_to');" class="inline"><?= img('system/icon-calendar.jpg'); ?></a>
                                        </li>
                                        <li class="col3">
                                            <button class="btn-rnd" type="submit">Go</button>
                                        </li>
                                    </ul>
                                </form>
                                <h2 class="fleft">Upcoming Courses &amp; Events</h2>
                                <a href="#" class="view-link"><small>view all</small></a>
                                <dl class="clearfix" id="sub-toddler-entries-event">
                                </dl>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Recommended Events &amp; Courses</h2>
                                <ul class="clearfix" id="sub-toddler-entries-rnd">
                                </ul>										
                            </div>
                        </div><!-- .subcontent-events -->
                    </div><!-- .subnav-content -->
                </li>
            </ul>				
        </li>
        <li class="dropnav cat-preschool"><a href="preschooler">Pre-schooler</a>
            <ul class="subnav sub-preschool">
                <li>
                    <div class="subnav-links clearfix">
                        <ul class="tabs" data-tabs="tabs">
                            <li class="active"><a href="#subcontent-preschool-home" class="mm_nav">Pre-Schooler Home</a></li>
                            <li><a href="#subcontent-preschool-forum" class="mm_nav">Forum</a></li>
                            <li><a href="#subcontent-preschool-pow" class="mm_nav">Pic of the Week</a></li>
                            <li><a href="#subcontent-preschool-products" class="mm_nav">Products & Services Updates</a></li>
                            <li><a href="#subcontent-preschool-articles" class="mm_nav">Articles, Partner Bloggers & Essentials</a></li>
                            <li><a href="#subcontent-preschool-events" class="mm_nav">Events & Programs</a></li>
                        </ul>
                    </div><!-- .subnav-links -->
                    <div class="subnav-content tab-content">
                        <div id="subcontent-preschool-home" class="active tab-pane clearfix">
                            <h2>Top Pre-Schooler News</h2>
                            <div class="fleft col3">
                                <h4>Articles & Bloggers</h4>
                                <ul id="subcontent-preschool-ab">
                                </ul>
                            </div>
                            <div class="fleft col3">
                                <h4>Product & Service Updates</h4>
                                <ul id="subcontent-preschool-ps">
                                </ul>
                            </div>	
                            <div class="fleft col3">
                            <h4>Events & Programs</h4>
                            <ul id="subcontent-preschool-ep">
                            </ul>
                        </div>
                        </div><!-- .subcontent-home -->
                        <div id="subcontent-preschool-forum" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">PreSchooler - Most Recent Forum Threads</h2>
                                <a href="forum/index.php?board=131" class="fright view-link"><small>view all</small></a>
                                <table id="sub-preschool-entries-forum">
                                </table>
                            </div>
                            <div class="fleft col2">
                                <h2>PreSchooler - Create a thread</h2>
                            	<?php if ($this->session->userdata("logged_in") == true) { ?>
                                
                                    <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="100">Topic : </td>
                                        <td><input id="preschool_thread_topic" name="preschool_thread_topic" style="width:100%;border:1px solid #abadb3;line-height:18px;" /></td>
                                    </tr>
                                    <tr>
                                        <td>Message : </td>
                                        <td><textarea id="preschool_thread_msg" name="preschool_thread_msg" style="width:100%;resize:none;margin:0px;padding:0px;border:1px solid #abadb3;" rows="3"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a href="javascript:void(0);" onclick="createThread('preschool_thread_topic', 'preschool_thread_msg', 8)" class="btn-rnd fright view-link"><small>POST</small></a></td>
                                    </tr>
                                    </table>
								<?php } else { ?>
                                	<table width="60%" cellpadding="5" align="center">
                                    	<tr valign="top">
                                        	<td width="50%"><a href="javascript:void(0);" onclick="callMMLogin();" title="Create a Thread">
                                            	<?= img('system/icon-forum-create.png'); ?>
                                            	<span class="block">You need to login<br />to create a thread</span></a></td>
                                            <td width="50%"><a href="user/register" title="Register">
                                            	<?= img('system/icon-forum-reg.png'); ?>
                                                <span class="block">No login? <br />Join us now!</span></a></td>
                                        </tr>
                                    </table>
                                <?php } ?>
                            </div>
                        </div><!-- .subcontent-forum -->
                        <div id="subcontent-preschool-pow" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Pic of the Week</h2>
                                <a href="#" class="btn-rnd fright view-link"><small>JOIN NOW</small></a>
                                    <ul class="clearfix">
                                        <li class="sub-pow-winner aCenter">
                                            <p class="aCenter">Last week's Winner</p>
                                            <a href="#" title="Archive Name">
                                            <div class="thumb t180x165" id="sub-preschool-pow-entries-cw"></div></a>
                                            <a href="#" title="View All Winners"><small>view all winners</small></a>
                                        </li>
                                        <li class="sub-pow-entries">
                                            <p class="aCenter">This week's entries</p>
                                            <ul class="clearfix" id="sub-preschool-pow-entries-ent">
                                            </ul>
                                            <a href="#" class="view-link"><small>view all entries</small></a>
                                        </li>
                                    </ul>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Top Pic of the Week Archives</h2>
                                <a href="#" class="fright view-link"><small>view all</small></a>
                                <ul class="sub-pow-archive clearfix" id="sub-preschool-pow-arc">
                                    </ul>										
                            </div>
                        </div><!-- .subcontent-pow -->
                        <div id="subcontent-preschool-products" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Latest Products & Services</h2>
                                <a href="ps_providers" class="view-link"><small>view all</small></a>
                                <ul class="clearfix" id="sub-preschool-entries-psu">
                                </ul>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Most Popular Products and Services</h2>
                                <ul class="clearfix" id="sub-preschool-entries-mp">
                                </ul>										
                            </div>
                        </div><!-- .subcontent-products -->
                        <div id="subcontent-preschool-articles" class="tab-pane clearfix">
                            <div class="fleft col3 borderR">
                                <h2 class="fleft">Latest Articles</h2>
                                <ul class="clearfix" id="sub-preschool-entries-art">
                                </ul>
                            </div>
                            <div class="fleft col3 borderR">
                                <h2 class="fleft">Latest Partner Bloggers</h2>
                                <ul class="clearfix" id="sub-preschool-entries-pb">
                                </ul>									</div>
                            <div class="fleft col3 sub-essentials">
                                <h2 class="fleft">Pre-Schooler Essentials</h2>
                                <span class="stub-coming-soon"></span>
                                <ul class="clearfix">
                                    <li>
                                        <h3><em>Your Week by Week Guide</em></h3>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">1st Trimester</a>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">2nd Trimester</a>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">3rd Trimester</a>
                                        
                                    </li>
                                    <li>
                                        <h3><em>Vaccination Guide</em></h3>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="#"  class="inline" title="View">View</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .subcontent-articles -->
                        <div id="subcontent-preschool-events" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Select Date Range</h2>
                                <a href="#" class="view-link"><small>view all</small></a>
                                <form action="#" method="post" class="form-event-search">
                                    <ul class="clearfix">
                                        <li class="col3">
                                            <span class="block">From:</span>
                                            <input type="text" id="mm_preschool_from" name="mm_preschool_from" onclick="setStickyMM(true);displayDatePicker('mm_preschool_from');" value="" placeholder="Select Date"  />
                                            <a href="javascript:void(0);" onclick="setStickyMM(true);displayDatePicker('mm_preschool_from');" class="inline"><?= img('system/icon-calendar.jpg'); ?></a>
                                        </li>
                                        <li class="col3">
                                            <span class="block">To:</span>
                                            <input type="text" id="mm_preschool_to" name="mm_preschool_to" onclick="setStickyMM(true);displayDatePicker('mm_preschool_to');" value="" placeholder="Select Date"  />
                                            <a href="javascript:void(0);" onclick="setStickyMM(true);displayDatePicker('mm_preschool_to');" class="inline"><?= img('system/icon-calendar.jpg'); ?></a>
                                        </li>
                                        <li class="col3">
                                            <button class="btn-rnd" type="submit">Go</button>
                                        </li>
                                    </ul>
                                </form>
                                <h2 class="fleft">Upcoming Courses &amp; Events</h2>
                                <a href="#" class="view-link"><small>view all</small></a>
                                <dl class="clearfix" id="sub-preschool-entries-event">
                                </dl>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Recommended Events &amp; Courses</h2>
                                <ul class="clearfix" id="sub-preschool-entries-rnd">
                                </ul>										
                            </div>
                        </div><!-- .subcontent-events -->
                    </div><!-- .subnav-content -->
                </li>
            </ul>				
        </li>
        <li class="dropnav cat-parents"><a href="parents">Parents</a>
            <ul class="subnav sub-parents">
                <li>
                    <div class="subnav-links clearfix">
                        <ul class="tabs" data-tabs="tabs">
                            <li class="active"><a href="#subcontent-parents-home" class="mm_nav">Parents Home</a></li>
                            <li><a href="#subcontent-parents-forum" class="mm_nav">Forum</a></li>
                            <li><a href="#subcontent-parents-pow" class="mm_nav">Pic of the Week</a></li>
                            <li><a href="#subcontent-parents-products" class="mm_nav">Products & Services Updates</a></li>
                            <li><a href="#subcontent-parents-articles" class="mm_nav">Articles, Partner Bloggers & Essentials</a></li>
                            <li><a href="#subcontent-parents-events" class="mm_nav">Events & Programs</a></li>
                        </ul>
                    </div><!-- .subnav-links -->
                    <div class="subnav-content tab-content">
                        <div id="subcontent-parents-home" class="active tab-pane clearfix">
                            <h2>Top Parents News</h2>
                            <div class="fleft col3">
                                <h4>Articles & Bloggers</h4>
                                <ul id="subcontent-parents-ab">
                                </ul>
                            </div>
                            <div class="fleft col3">
                                <h4>Product & Service Updates</h4>
                                <ul id="subcontent-parents-ps">
                                </ul>
                            </div>	
                            <div class="fleft col3">
                            <h4>Events & Programs</h4>
                            <ul id="subcontent-parents-ep">
                            </ul>
                        </div>
                        </div><!-- .subcontent-home -->
                        <div id="subcontent-parents-forum" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Parenting - Most Recent Forum Threads</h2>
                                <a href="forum/index.php?board=185" class="fright view-link"><small>view all</small></a>
                                <table id="sub-parents-entries-forum">
                                </table>
                            </div>
                            <div class="fleft col2">
                                <h2>Parenthing - Create a thread</h2>
                            	<?php if ($this->session->userdata("logged_in") == true) { ?>
                                
                                    <table width="100%" cellpadding="5">
                                    <tr>
                                        <td width="100">Topic : </td>
                                        <td><input id="parenting_thread_topic" name="parenting_thread_topic" style="width:100%;border:1px solid #abadb3;line-height:18px;" /></td>
                                    </tr>
                                    <tr>
                                        <td>Message : </td>
                                        <td><textarea id="parenting_thread_msg" name="parenting_thread_msg" style="width:100%;resize:none;margin:0px;padding:0px;border:1px solid #abadb3;" rows="3"></textarea></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><a href="javascript:void(0);" onclick="createThread('parenting_thread_topic', 'parenting_thread_msg', 19)" class="btn-rnd fright view-link"><small>POST</small></a></td>
                                    </tr>
                                    </table>
								<?php } else { ?>
                                	<table width="60%" cellpadding="5" align="center">
                                    	<tr valign="top">
                                        	<td width="50%"><a href="javascript:void(0);" onclick="callMMLogin();" title="Create a Thread">
                                            	<?= img('system/icon-forum-create.png'); ?>
                                            	<span class="block">You need to login<br />to create a thread</span></a></td>
                                            <td width="50%"><a href="user/register" title="Register">
                                            	<?= img('system/icon-forum-reg.png'); ?>
                                                <span class="block">No login? <br />Join us now!</span></a></td>
                                        </tr>
                                    </table>
                                <?php } ?>
                            </div>
                        </div><!-- .subcontent-forum -->
                        <div id="subcontent-parents-pow" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Pic of the Week</h2>
                                <a href="#" class="btn-rnd fright view-link"><small>JOIN NOW</small></a>
                                    <ul class="clearfix">
                                        <li class="sub-pow-winner aCenter">
                                            <p class="aCenter">Last week's Winner</p>
                                            <a href="#" title="Archive Name">
                                            <div class="thumb t180x165" id="sub-parents-pow-entries-cw"></div></a>
                                            <a href="#" title="View All Winners"><small>view all winners</small></a>
                                        </li>
                                        <li class="sub-pow-entries">
                                            <p class="aCenter">This week's entries</p>
                                            <ul class="clearfix" id="sub-parents-pow-entries-ent">
                                            </ul>
                                            <a href="#" class="view-link"><small>view all entries</small></a>
                                        </li>
                                    </ul>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Top Pic of the Week Archives</h2>
                                <a href="#" class="fright view-link"><small>view all</small></a>
                                <ul class="sub-pow-archive clearfix" id="sub-parents-pow-arc">
                                    </ul>										
                            </div>
                        </div><!-- .subcontent-pow -->
                        <div id="subcontent-parents-products" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Latest Products & Services</h2>
                                <a href="ps_providers" class="view-link"><small>view all</small></a>
                                <ul class="clearfix" id="sub-parents-entries-psu">
                                </ul>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Most Popular Products and Services</h2>
                                <ul class="clearfix" id="sub-parents-entries-mp">
                                </ul>										
                            </div>
                        </div><!-- .subcontent-products -->
                        <div id="subcontent-parents-articles" class="tab-pane clearfix">
                            <div class="fleft col3 borderR">
                                <h2 class="fleft">Latest Articles</h2>
                                <ul class="clearfix" id="sub-parents-entries-art">
                                </ul>
                            </div>
                            <div class="fleft col3 borderR">
                                <h2 class="fleft">Latest Partner Bloggers</h2>
                                <ul class="clearfix" id="sub-parents-entries-pb">
                                </ul>									</div>
                            <div class="fleft col3 sub-essentials">
                                <h2 class="fleft">Parents Essentials</h2>
                                <span class="stub-coming-soon"></span>
                                <ul class="clearfix">
                                    <li>
                                        <h3><em>Your Week by Week Guide</em></h3>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">1st Trimester</a>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">2nd Trimester</a>
                                        <a class="btn-rnd btn-gray" href="#" title="title link">3rd Trimester</a>
                                        
                                    </li>
                                    <li>
                                        <h3><em>Vaccination Guide</em></h3>
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. <a href="#"  class="inline" title="View">View</a>
                                    </li>
                                </ul>
                            </div>
                        </div><!-- .subcontent-articles -->
                        <div id="subcontent-parents-events" class="tab-pane clearfix">
                            <div class="fleft col2 borderR">
                                <h2 class="fleft">Select Date Range</h2>
                                <a href="#" class="view-link"><small>view all</small></a>
                                <form action="#" method="post" class="form-event-search">
                                    <ul class="clearfix">
                                        <li class="col3">
                                            <span class="block">From:</span>
                                            <input type="text" id="mm_parents_from" name="mm_parents_from" onclick="setStickyMM(true);displayDatePicker('mm_parents_from');" value="" placeholder="Select Date"  />
                                            <a href="javascript:void(0);" onclick="setStickyMM(true);displayDatePicker('mm_parents_from');" class="inline"><?= img('system/icon-calendar.jpg'); ?></a>
                                        </li>
                                        <li class="col3">
                                            <span class="block">To:</span>
                                            <input type="text" id="mm_parents_to" name="mm_parents_to" onclick="setStickyMM(true);displayDatePicker('mm_parents_to');" value="" placeholder="Select Date"  />
                                            <a href="javascript:void(0);" onclick="setStickyMM(true);displayDatePicker('mm_parents_to');" class="inline"><?= img('system/icon-calendar.jpg'); ?></a>
                                        </li>
                                        <li class="col3">
                                            <button class="btn-rnd" type="submit">Go</button>
                                        </li>
                                    </ul>
                                </form>
                                <h2 class="fleft">Upcoming Courses &amp; Events</h2>
                                <a href="#" class="view-link"><small>view all</small></a>
                                <dl class="clearfix" id="sub-parents-entries-event">
                                </dl>
                            </div>
                            <div class="fleft col2">
                                <h2 class="fleft">Recommended Events &amp; Courses</h2>
                                <ul class="clearfix" id="sub-parents-entries-rnd">
                                </ul>										
                            </div>
                        </div><!-- .subcontent-events -->
                    </div><!-- .subnav-content -->
                </li>
            </ul>				
        </li>
        <li><a href="forum">Forums</a></li>
        <li><a href="#" id="advertise">Advertise Now</a></li>
        <li class="search-wrap">
            <div class="search_new">
            <form name="frm_search" id="frm_search" method="post">
                <input type="text" id="q" name="searchfield" value="" placeholder="Search Mumcentre "/>
                <button type="submit" id="search_submit" style="display:none"></button>
            </form>
        </div><!-- .search -->
        </li>
    </ul>
    <script>
		var stickyMM = false;
		
		$(document).ready(function() {
                        $('#frm_adnow').submit(function(e){
				var compname = $("#compname").val();
				var contactname = $("#contactname").val();
				var industries = $("#industries").val();
				var budget = $("#budget").val();
				var emailadd = $("#emailadd").val();
				var contactnumber = $("#contactnumber").val();
				var message = $("#message").val();
				if(compname.length == 0){
					alert('Company name is required');
				}
				else if(contactname.length == 0){
					alert('Contact name is required');
				}
				else if(industries.length == 0){
					alert('Please select a industry');
				}
				else if(budget.length == 0){
					alert('Please select a budget');
				}
				else if(emailadd.length == 0){
					alert('Enter your valid email address');
				}
				else if(contactnumber.length == 0){
					alert('Enter your contact number');
				}
				else if(message.length == 0){
					alert('Enter your message');
				}
				else{
					var atpos=emailadd.indexOf("@");
					var dotpos=emailadd.lastIndexOf(".");
					if (atpos < 1 || dotpos < atpos+2 || dotpos+2 >= emailadd.length){
						alert("Your email address is not valid");
						return false;
					}
					else{
						//alert('sent');
						$.post("user/advertise_now/", {
                            comp_name: compname,
                            contact_name : contactname,
							industry : industries,
							budget : budget,
							email_add : emailadd,
							contact_number : contactnumber,
							msg : message
                        },
                        function(data){
                            alert(data);
                            $('#ad_modal').dialog('close');
                        });
						
					}
				}
				e.preventDefault(); 
			});
		
			$('#advertise').click(function(e){
				$('#ad_modal').dialog('open');
				e.preventDefault();  
			})
			$('#ad_modal').dialog({
				autoOpen: false,
				width: 730,
				height: 360,
				title: 'Advertise Now',
                                position: [295,241]
			});
			$(".cat-pregnancy").hover(
				function () {
					$('.sub-pregnancy').css("left", "15px");
					$('.sub-pregnancy').css("top", "60px");
				},
				function () {
					if (stickyMM == false) {
						$('.cat-pregnancy > a').removeClass('mm_nav_highlight_preg');
						$('.sub-pregnancy').css("left", "");
						$('.sub-pregnancy').css("top", "");
					} else {
						$('.cat-pregnancy > a').addClass('mm_nav_highlight_preg');
					}
				}
			);
			
			$(".cat-baby").hover(
				function () {
					$('.sub-baby').css("left", "15px");
					$('.sub-baby').css("top", "60px");
				},
				function () {
					if (stickyMM == false) {
						$('.cat-baby > a').removeClass('mm_nav_highlight_baby');
						$('.sub-baby').css("left", "");
						$('.sub-baby').css("top", "");
					} else {
						$('.cat-baby > a').addClass('mm_nav_highlight_baby');
					}
				}
			);
			
			$(".cat-toddler").hover(
				function () {
					$('.sub-toddler').css("left", "15px");
					$('.sub-toddler').css("top", "60px");
				},
				function () {
					if (stickyMM == false) {
						$('.cat-toddler > a').removeClass('mm_nav_highlight_toddler');
						$('.sub-toddler').css("left", "");
						$('.sub-toddler').css("top", "");
					} else {
						$('.cat-toddler > a').addClass('mm_nav_highlight_toddler');
					}
				}
			);
			
			$(".cat-preschool").hover(
				function () {
					$('.sub-preschool').css("left", "15px");
					$('.sub-preschool').css("top", "60px");
				},
				function () {
					if (stickyMM == false) {
						$('.cat-preschool > a').removeClass('mm_nav_highlight_preschool');
						$('.sub-preschool').css("left", "");
						$('.sub-preschool').css("top", "");
					} else {
						$('.cat-preschool > a').addClass('mm_nav_highlight_preschool');
					}
				}
			);
			
			$(".cat-parents").hover(
				function () {
					$('.sub-parents').css("left", "15px");
					$('.sub-parents').css("top", "60px");
				},
				function () {
					if (stickyMM == false) {
						$('.cat-parents > a').removeClass('mm_nav_highlight_parents');
						$('.sub-parents').css("left", "");
						$('.sub-parents').css("top", "");
					} else {
						$('.cat-parents > a').addClass('mm_nav_highlight_parents');
					}
				}
			);
                        
                        $('#frm_search').submit(function(e){
                           var keyword = $('#q').val();
                           location.href = "search/?q="+keyword;
                           e.preventDefault();
                        });
                        $('#q').focus(function () {
                            if ($(this).val() == $(this).attr("title")) {
                                $(this).val("");
                            }
                        }).blur(function () {
                            if ($(this).val() == "") {
                                $(this).val($(this).attr("title"));
                            }
                        });
		});
		
		function setStickyMM(val) {
			stickyMM = val;
		}
		
		function closeDropDownMM() {
			$('.sub-pregnancy').css("left", "");
			$('.sub-pregnancy').css("top", "");
			
			$('.sub-baby').css("left", "");
			$('.sub-baby').css("top", "");
			
			$('.sub-toddler').css("left", "");
			$('.sub-toddler').css("top", "");
			
			$('.sub-preschool').css("left", "");
			$('.sub-preschool').css("top", "");
			
			$('.sub-parents').css("left", "");
			$('.sub-parents').css("top", "");
		}
		
		$('.mm_nav').click(function(event) {
			event.preventDefault();
		});
		
		function callMMLogin() {
			$('#login_modal').dialog('open');
			
			
			$('#email_log').focus();
            e.preventDefault();  
		}
		
		function createThread(topicobj, msgobj, groupid) {
			var topic = document.getElementById(topicobj).value;
			var msg = document.getElementById(msgobj).value;

			$.post("mm/createThreadMM/", {subject: topic, content : msg, agegroupid : groupid},
			function(data) {
				document.getElementById(topicobj).value = "";
				document.getElementById(msgobj).value = "";
				alert("Thread created.");
			});
		}
	</script>
</div>

<link href="assets/css/menu.css" rel="stylesheet" rev="stylesheet" />
<link href="assets/css/main.css" rel="stylesheet" rev="stylesheet" />

<div id="ad_modal" style="display: none">
    <div>
        <div class="inner" style="width:500px;">
            <form name="frm_adnow" id="frm_adnow" action="" method="post">
                <table border="0" cellspacing="0">
                <tr>
                    <td>Company Name :</td>
                    <td><input type="text" style="width:380px" id="compname" class="txtfield_companyname" name="compname" /></td>
                </tr>
                <tr>
                	<td>Contact Name :</td>
                    <td><input type="text" style="width:380px" id="contactname" class="txtfield_contactname" name="contactname"></td>
                </tr>
                <tr>
                	<td>Industry :</td>
                    <td>
                    <select id="industries" class="list_industry" name="industries">
                        <option selected="selected">Select Industry</option>		
						<option value="Agency">Agency</option>
						<option value="Appliance">Appliance</option>
						<option value="Consumer Goods">Consumer Goods</option>
						<option value="Cosmetics">Cosmetics</option>
						<option value="Education">Education</option>
						<option value="Enrichment">Enrichment</option>
						<option value="Entertainment/Media">Entertainment/Media</option>
						<option value="Finance">Finance</option>
						<option value="Fitness">Fitness</option>
						<option value="Furniture">Furniture</option>
						<option value="Healthcare">Healthcare</option>
						<option value="Recreation">Recreation</option>
						<option value="Retail">Retail</option>
						<option value="Skincare/Spa/Wellness/Yoga">Skincare/Spa/Wellness/Yoga</option>
						<option value="Technology">Technology</option>
						<option value="Other">Other</option>
                    </select>
                    </td>
                </tr>
                <tr>
                	<td>Advertising Budget:</td>
                	<td>
                    <select onchange="other_options();" id="budget" class="list_industry" name="budget">
                        <option selected="selected" value="">Select Budget</option>		
                        <option value="1200SGD">$1,200</option>							
                        <option value="3000SGD">$3,000</option>
                        <option value="5000SGD">$5,000</option>
                        <option value="10000SGD">$10,000</option>
                        <option value="10000_PLUS_SGD">Greater than $10,000</option>
                        <option value="other">Other</option>
                    </select>
                    </td>
                </tr>
                <tr>
                	<td>Email Address :</td>
                    <td><input type="text" style="width:380px" id="emailadd" class="txtfield_email" name="emailadd"></td>
                </tr>
                <tr>
                	<td>Contact Number :</td>
                    <td><input type="text" style="width:380px" id="contactnumber" class="txtfield_contactnumber" name="contactnumber"></td>
                </tr>
                <tr>
                	<td>Message :</td>
                    <td><textarea id="message" class="txtarea_message" rows="5" cols="45" name="message"></textarea></td>
                </tr>
                <tr>
                	<td colspan="2"><button type="submit" name="send_btn" id="send_btn">Send</button></td>
                </tr>
                </table>
            </form>
        </div><!-- .wrapper -->
    </div><!-- .inner -->
</div>
