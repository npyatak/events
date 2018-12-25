<div class="big-image">
    <div class="big-image_inner">
        <img src="<?=Yii::$app->image->getImageUrl($block->source, '900x540');?>" alt="<?=$block->text;?>">
        <div class="caption">
            <?=$block->copyright_text;?>
        </div>
        <?php if($block->show_fullscreen):?>
        <a href="" class="big-image_btn"></a>
        <?php endif;?>
    </div>
    <?php if($block->text):?>
    <div class="title-wrap">
        <div class="container_inner">
            <div class="row justify-content-end m-0">
                <div class="big-image_title m-r-40"><h5><?=$block->text;?></h5></div>
            </div>
        </div>
    </div>
    <?php endif;?>
</div>