<div id="content">
  <?php render_partial('pow/cmspow_nav');?>
  <h2 style="margin:0"><?php echo $data['page_title']
  ?> for <?php echo $data['contest_info']['name']
  ?><br/></h2>
  
  <br/><br/><a href="javascript:;" onclick="history.go(-1);">&lt;&lt; Go back</a>
  
    <div id="article-listing">
      <div class="powcms-imglist">
        <?php foreach ($data['results_list'] as $row) :
        ?>
        <div class="imgbox">
          <div class="imgcont">
            <a href="<?php echo get_entry_photo($row['token_id'], $row['photo_filepath']);?>" title="View full photo" target="_blank"> <img src="<?php echo get_entry_photo($row['token_id'], $row['photo_filepath'], 100);?>" / ></a>
          </div>
          <div class="imginfo">
            <h2><?php echo $data['awards'][$row['award_type_id'] ]?></h2>

            <h4><a href="<?php echo site_url("pow/entry/{$row['token_id']}");?>" target="_blank"><?php echo $row['name'];?></a></h4>
            <span><?php echo $row['caption'];?></span>
            <table>
              <tr>
                <td>Age/Group</td><td><?php echo $data['contest_info']['age_group'];?></td>
              </tr>
              <tr>
                <td>User</td><td><?php echo $row['first_name'];?> <?php echo $row['last_name'];?> (<?php echo $row['email_address'];?>)</td>
              </tr>
              <tr>
                <td>Votes</td><td><?php echo $row['total_vote'];?></td>
              </tr>
            </table>
          </div>
        </div><!-- #imgbox-->
        <?php endforeach;?>
      </div><!-- #imglist-->      
    </div>
</div>
