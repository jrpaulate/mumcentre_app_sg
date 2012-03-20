<?php if( @issetNE($data['category_list']) ) : ?>
<ul class="section-subaction">
  <?php foreach ($data['category_list'] as $categ) : ?>
  <li <?php echo $data['category_id'] == $categ['id'] ?  'class="selected"':'' ?>>
    <a href="pow/entries/<?php echo url_title($categ['name'], "dash", true)?>" title="<?php echo $categ['name']?>"><?php echo $categ['name'] ?></a>
  </li>
  <?php endforeach;?>
 
</ul><!-- .section-subaction -->
<?php endif;?>