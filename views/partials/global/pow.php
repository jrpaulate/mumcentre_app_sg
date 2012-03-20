<?php
$CI =& get_instance();
$pow = $CI->load->model('Pow_model','pow',true); // no need to autoload the database library
$latest_winners =  $CI -> pow -> contest_latest_winners();
?>
<div class="cont-250">
        <div id="PoW">
            <div id="pow-cont">
                <div id="pow-head">
                          Pic of the Week <red>Winners!</red>
                </div> <!-- end pow-head-->
                <div id="pow-text">
                          These members won great prizes through their photos. <br /><lnkbig>
                            <a href="<?php echo site_url('pow');?>">Join the competition now!</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo site_url('pow/winners');?>">View past Winners.</a></lnkbig>
                </div> <!-- end pow text -->
                <div id="pow-body">
                    <ul class="PoW3-ul">
                  <?php foreach ($latest_winners as $row) :?>                   
                        <li class="PoW3-li">
                            <div class="pow-Rcont">
                                <div class="pow-img">
                                    <a href="<?php echo site_url('pow/entry/'.$row['token_id']);?>">
                                        <img src="<?php echo get_entry_photo($row['token_id'], $row['photo_filename'],320); ?>" alt="<?php echo $row['category_name'];?>" title="<?php echo $row['category_name'];?>" width="50" height="65"/>
                                    </a>
                                </div> <!-- end pow img -->
                                <div class="pow-Rctx">
                                    <a href="<?php echo site_url('pow/entry/'.$row['token_id']);?>"><?php echo $row['category_name'];?></a>
                                </div> <!-- end pow Rctx -->
                            </div> <!-- end pow Rcont-->
                        </li>
                 <?php endforeach;?>

                    </ul>
                </div> <!-- end pow body-->
            </div> <!-- end pow-cont -->
        </div> <!-- end PoW -->
    </div> <!-- end cont-250 -->