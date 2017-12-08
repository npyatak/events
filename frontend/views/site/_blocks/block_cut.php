
<div class="why-block">
    <div class="why-block_inner">
        <h3><?=$block->title;?></h3>
        <div class="change-block">
            <div class="visible">
                <p><?=$block->preview;?></p>
            </div>
            <div class="hidden">
                <?=$block->text;?>
            </div>
            <div class="more" data-text-show=<?=$block->text_show ? $block->text_show : 'Показать';?>  data-text-hide=<?=$block->text_show ? $block->text_hide : 'Свернуть';?>>
                <span class="more-btn show tt-up">
                    <span class="more-text"><?=$block->text_show;?></span><i class="fa fa-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>
</div>