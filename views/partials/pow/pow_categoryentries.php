<p class="lblue">
  Category Participants: <?php echo $data['category_info']['display_name'];?>
</p>
<div class="scrollable">
  <div class="items">
    <div>
      <ul class="entries-list">
        <?php foreach ($data['contest_entries'] as $row) :
        ?>
        <li>
          <a href="pow/entry/<?php echo $row['token_id'] ?>"> <img src="pow/entry_getphoto/<?php echo $row['token_id'] ?>/100"
          alt="<?php echo $row['name']?>" title="<?php echo $row['name']?>"/><span><?php echo $row['name']
            ?></span></a>
        </li>
        <?php endforeach;?>
      </ul>
    </div>
  </div>
</div>
<div class="entries-list-pagination">
  <a class="prev prev_entry" title="Previous">Prev</a>
  <a class="next next_entry" title="Next">Next</a>
</div>
