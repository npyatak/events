<?php if($block->blockGalleryImages):?>
<h3><?=$block->title;?></h3>
<div class="slider-container">
    <div id="owl-events" class="owl-carousel owl-theme">
        <?php foreach ($block->blockGalleryImages as $item):?>
        <div class="item">
            <div class="image">
                <img src="<?=Yii::$app->image->getImageUrl($item->image, '900x540');?>" alt="<?=$item->title;?>">
                <div class="caption">
                    <?=$item->copyright;?>
                </div>
                <a href="" class="big-image_btn"></a>
            </div>
            <div class="title-wrap">
                <div class="container_inner">
                    <div class="row justify-content-end m-0">
                        <div class="title m-r-40"><h5><?=$item->title;?></h5></div>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach;?>
    </div>
    <div id="info"></div>
</div>
<?php endif;?>