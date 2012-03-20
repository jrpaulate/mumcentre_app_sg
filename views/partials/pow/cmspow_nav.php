<?php if (@issetNE($data['error'])) :
?>
<div class="cms-pow-errors">
  <strong>ERROR:</strong>
  <?php foreach ($data['error'] as $err) :
  ?>
  <span class="cms-pow-error-msg"><?php echo $err
    ?></span>
  <?php endforeach;?>
</div>
<?php endif;?>
<div>
  Build <?php echo $data['__pow_version'];?>
  <!--<?php echo $data['__current_version'];?>-->
</div>
<?php
$admin_links = array(
/*
  'entry/currentcontest'  => 'Current Contest',
  'entry/upcoming'        => 'Upcoming Contest',*/ 
  'contest'               => 'Manage Contests',
  //'category/manage'       => 'Manage Categories',
  'options'               => 'Options',
  'admin/aboutpow'        => 'Edit About POW',  
  'admin/emailtemplate'   => 'Email Templates',
  'admin/emaillog'        => 'Email Logs', 
  
  
/*

  'options' => 'POW Options', 
  'contests/new' => 'New Contests', 
  'contests/active' => 'Active Contests', 
  'contests/concluded' => 'Concluded Contests', 
  'contests/archived' => 'Archived Contests',*/
//'past_winners'    => 'Past Winners',
//'entries_allrejected'  => 'Rejected Entries',
);
?>
<ul class="ulsubnav">
  <?php foreach ($admin_links as $lnk=>$label) :
  ?>
  <li>
    <a href="<?php echo site_url('cms_pow/' . $lnk);?>"><?php echo $label;?></a>
  </li>
  <?php endforeach;?>
</ul>