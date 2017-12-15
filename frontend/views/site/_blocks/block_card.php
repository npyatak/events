<div class="facts">
    <div class="row justify-content-end">
        <div class="fact_inner m-r-20">
            <div class="title"><?=$block->title;?></div>

            <?php if($block->blockCardItems):?>
            	<?php foreach ($block->blockCardItems as $item):?>
            		<span class="icon_<?=$item->icon;?>"></span>
		            <h3><?=$item->title;?></h3>
		            <?=$item->text;?>
		        <?php endforeach;?>
		    <?php endif;?>
        </div>
    </div>
</div>