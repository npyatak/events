<div class="why-block" id="cut_<?=$block->id;?>">
    <div class="why-block_inner">
        <h3><?=$block->title;?></h3>
        <div class="change-block">
            <div class="">
                <p><?=$block->preview;?></p>
            </div>
            <div class="hidden">
                <?=$block->text;?>
            </div>
            <div class="more block_cut_more" data-text-show="<?=$block->text_show ? $block->text_show : 'Показать';?>"  data-text-hide="<?=$block->text_show ? $block->text_hide : 'Свернуть';?>">
                <span class="more-btn show-cut tt-up">
                    <span class="more-text"><?=$block->text_show;?></span><i class="fa fa-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>
</div>


<?php 
$script = "
    $(document).ready(function () {
        var elems;
        var blockCut".$block->id." = $('#cut_".$block->id."').closest('.block_cut');
        console.log(blockCut".$block->id.");
        if($('.block_cut_end').length) {
            var cutEnd = blockCut".$block->id.".nextAll('.block_cut_end:first');
            console.log(cutEnd);
            elems".$block->id." = blockCut".$block->id.".nextUntil(cutEnd, '.block');
        } else {
            elems".$block->id." = blockCut".$block->id.".nextAll('.block');
        }
        console.log(elems".$block->id.".length);
        elems".$block->id.".hide();

        $(document)
            .on('click','.block_cut_more .show-cut',function () {
                $(this).parent().parent().find('.hidden').slideDown(500);
                $(this).toggleClass('show-cut hide-cut rotate');
                $(this).find('.more-text').text($(this).parent().data('text-hide'));
                elems".$block->id.".show();
                $(this).closest('.more').insertAfter(elems".$block->id.".last());
            })
            .on('click','.block_cut_more .hide-cut',function () {
                $(this).parent().parent().find('.hidden').slideUp(500);
                $(this).toggleClass('show-cut hide-cut rotate');
                $(this).find('.more-text').text($(this).parent().data('text-show'));
                elems".$block->id.".hide();
                $(this).closest('.more').appendTo($(this).closest('.block_cut .change-block'));
            });
    });
";?>

<?php $this->registerJs($script, yii\web\View::POS_END);?>