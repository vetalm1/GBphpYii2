<?php

?>

<h3><?=$dayTitle?></h3>

<div class="current-activity">
    <?php foreach ($activity as $item) : ?>
        <div class="col-md-3 day-activity">
            <h4 class="mt-4 text-primary"><?=$item['id']?> </h4>
            <h4 class="mt-4 text-primary"><?=$item['title']?> </h4>
            <h6 class="mt-4 text-primary"><?=$item['dateStart']?> </h6>
        </div>
    <?php endforeach ?>
</div>