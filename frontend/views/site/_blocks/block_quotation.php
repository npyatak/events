<div class="event-quote">
    <div class="quote-inner m-r-40">
        <div class="quote">
            <?=$block->text;?>
        </div>
        <?php if($block->author_image || $block->author_name):?>
        <div class="quote-author m-0 row justify-content-start align-items-center">
            <div class="image" style="background-image:url(<?=Yii::$app->image->getImageUrl($block->author_image, '75x75');?>)"></div>
            <div class="desc">
                <h6 class="name"><?=$block->author_name;?></h6>
                <div class="text"><p><?=$block->author_text;?></div>
            </div>
        </div>
        <?php endif;?>
    </div>
</div>



