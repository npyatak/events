<?php if($block->blockGalleryImages):?>
<div class="slider-container">
    <div id="owl-events" class="owl-carousel owl-theme">
        <?php foreach ($block->blockGalleryImages as $item):?>
        <div class="item">
            <div class="image">
                <img src="<?=$block->getImageUrl($item->image, '900x540');?>" alt="<?=$item->title;?>">
                <div class="caption">
                    <?=$item->copyright;?>
                </div>
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
</div>
<?php endif;?>