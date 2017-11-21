
<div class="big-image">
    <div class="big-image_inner">
        <img src="<?=$block->getImageUrl($block->source, '900x540');?>" alt="<?=$block->text;?>">
        <div class="caption">
            <?=$block->copyright_text;?>
        </div>
        <?php if($block->show_fullscreen):?>
        <a href="<?=$block->getImageUrl($block->source);?>" class="big-image_btn"></a>
        <?php endif;?>
    </div>
    <div class="title-wrap">
        <div class="container_inner">
            <div class="row justify-content-end m-0">
                <div class="big-image_title m-r-40"><h5><?=$block->text;?></h5></div>
            </div>
        </div>
    </div>
</div>