<ul class="section-subaction">
	<?php foreach ($data['category_list'] as $agegroup) : ?>
	<li <?php echo $data['agegroup_id'] == $agegroup['id'] ?  'class="selected"':'' ?>>
		<a href="pow/entries/<?php echo $agegroup['id']?>" title="<?php echo $agegroup['age_group']?>"><?php echo $agegroup['name'] ?></a>
	</li>
	<?php endforeach;?>
</ul><!-- .section-subaction -->
