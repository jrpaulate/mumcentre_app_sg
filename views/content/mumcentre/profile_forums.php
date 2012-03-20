<div class="wrap">
<div style="Title">
<input type="hidden" id="smf_id" value="<?php echo $this->session->userdata('smf_id'); ?>" />   
<span class="title-1">My Profile</span> &nbsp; <img src="images/Header-Arrow.png"> &nbsp;&nbsp;<span class="sub-title">Forum Threads and Replies</span>
<div style="border-bottom: 2px solid #3399cc; width: 660px;"></div>
<table width="660" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="242" valign="top">
    <div class="profile-image"><img src="uploaded/user/avatar/<?php echo $this->session->userdata('avatar');?>"></div>
    <div style="padding-top: 30px; border-bottom: 1px solid #cecece; width: 242px;"></div>
    <?= render_partial('global/observer/profile_menu'); ?>
    </td>
    <td width="418" style="border-left: 1px solid #cecece;" valign="top">
    <div class="side-content">
    <div class="Profile-account-name"><?php echo $this->session->userdata('name')." ".$this->session->userdata('last_name');?></div>
    <div style="border-bottom: 1px dotted #59366c; width: 406px;"></div>
    <br />
    
     <div class="recent-alerts">Most Recent Treads <div class="edit-profile"></div></div>
    <div style="border-bottom: 1px dotted #59366c; width: 406px; padding-top: 12px;"></div>
    <ul id="forum-listing" class="ul-threads">
    </ul>
  
    </div>
    </td>
  </tr>
</table>

</div>

</div>

<div id="sidebar2">
    <div id="c3spacer"></div>
    <?= render_partial('global/observer/sidebar'); ?>
    <!-- end .container --></div>




<?= render_partial('global/default_footer'); ?>

<script type="text/html" id="forum_listing_tpl">
{{#forum_list}}
{{#forum}}
<li class="li-threads">
      <div class="most_recent">
        <div style="float:left; margin-right:5px;"><img src="assets/img/system/threan-icon.png" border="0"></div>
          <strong>
          <span class="globel_style">
          <a class="blue" href="<?php echo base_url(); ?>forum/index.php?topic={{id_topic}}" style="text-decoration: none; border:none; color: #39c;">{{subject}}</a>
          </span>
          </strong><br>{{{body}}}<br><span style="color:#666;">{{time_posted}}</span>
        </div>
        <div class="viewsbox"><br><a href="<?php echo base_url(); ?>forum/index.php?topic={{id_topic}}">{{num_views}}</a> views</div>
        <div class="repliesbox"><br><a href="<?php echo base_url(); ?>forum/index.php?topic={{id_topic}}">{{num_replies}}</a> replies</div>
        <div class="norepliesbox"><br>Last <a href="<?php echo base_url(); ?>forum/index.php?topic={{id_topic}}">post</a> by {{poster_name}}</div>
</li>
{{/forum}}
{{^forum}}
<li class="li-threads" style="padding-top: 5px;">
    <span>You haven't started any topics at the forums yet.</span>
</li>
{{/forum}}
{{/forum_list}}
</script>
<script type="text/javascript" language="javascript" src="js/ICanHaz.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        var smf_id = $('#smf_id').val();
        $.get("user/forum_list/"+smf_id, function(response){
            var data = JSON.parse(response);
            var template = ich.forum_listing_tpl(data);
            $('#forum-listing').html('');
            $('#forum-listing').append(template);
        });
    });
</script>

